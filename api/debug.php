<?php
header('Content-Type: text/plain');

$secret = getenv('DEBUG_ENDPOINT_SECRET');
if (!$secret || ($_GET['key'] ?? '') !== $secret) {
    http_response_code(404);
    echo "Not found";
    exit;
}

echo "PHP version: " . phpversion() . "\n\n";

echo "Loaded extensions:\n";
echo implode(', ', get_loaded_extensions()) . "\n\n";

echo "pdo_pgsql loaded: " . (extension_loaded('pdo_pgsql') ? 'YES' : 'NO') . "\n";
echo "pgsql loaded: " . (extension_loaded('pgsql') ? 'YES' : 'NO') . "\n";
echo "Available PDO drivers: " . implode(', ', class_exists('PDO') ? PDO::getAvailableDrivers() : ['PDO class missing']) . "\n\n";

echo "DB env vars present:\n";
foreach (['DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DATABASE_URL'] as $key) {
    $val = getenv($key);
    echo "$key: " . ($val ? '(set, length ' . strlen($val) . ')' : '(NOT SET)') . "\n";
}

echo "\nAttempting raw PDO connection...\n";
try {
    $dsn = sprintf(
        'pgsql:host=%s;port=%s;dbname=%s;sslmode=require',
        getenv('DB_HOST'),
        getenv('DB_PORT') ?: 5432,
        getenv('DB_DATABASE')
    );
    $pdo = new PDO($dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    echo "PDO connection: SUCCESS\n";
    $stmt = $pdo->query('SELECT 1');
    echo "Query result: " . json_encode($stmt->fetchAll()) . "\n";
} catch (\Throwable $e) {
    echo "PDO connection FAILED: " . get_class($e) . ": " . $e->getMessage() . "\n";
}

echo "\nAttempting to boot Laravel app...\n";
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "Laravel booted: SUCCESS\n";
    echo "APP_KEY set: " . (config('app.key') ? 'YES' : 'NO') . "\n";
    try {
        $count = \Illuminate\Support\Facades\DB::table('users')->count();
        echo "DB query via Laravel: SUCCESS, users count = $count\n";
    } catch (\Throwable $e) {
        echo "DB query via Laravel FAILED: " . get_class($e) . ": " . $e->getMessage() . "\n";
    }
} catch (\Throwable $e) {
    echo "Laravel boot FAILED: " . get_class($e) . ": " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
