import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/Hero-Clean-images.css',
                'resources/css/bootstrap.min.css',
                'resources/css/home.css',
                'resources/css/loginregister.css',
                'resources/css/style.css',
                'resources/css/thankyou.css',
                'resources/js/bold-and-bright.js',
                'resources/js/bootstrap.min.js',
            ],
            refresh: true,
        }),
    ],
});
