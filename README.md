# Irene Paramitha — Art Shop

A Laravel + Breeze commerce site (shop, cart, checkout, admin product
management) built as a university project, adapted here for local
development and portfolio deployment.

## Local development

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Pick a database — SQLite is the fastest way to get running locally:

```bash
touch database/database.sqlite
```

then in `.env` set:

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

(or point `DB_CONNECTION=mysql` at a local MySQL server instead).

```bash
php artisan migrate --seed
php artisan storage:link
npm run dev        # Vite dev server (separate terminal)
php artisan serve  # http://127.0.0.1:8000
```

The seeder (`database/seeders/DatabaseSeeder.php`) creates two demo
accounts and six sample products with placeholder photos:

| Role  | Email             | Password |
|-------|-------------------|----------|
| Admin | admin@example.com | password |
| User  | user@example.com  | password |

## Deploying

The app ships with a `Dockerfile` (Vite asset build + PHP-Apache
runtime) so it can run on any container host. Two ready-made configs
are included:

### Railway (MySQL)

1. Push this repo to GitHub.
2. On [railway.app](https://railway.app), "New Project" → "Deploy from
   GitHub repo" → pick this repo. Railway detects the `Dockerfile`
   automatically (`railway.json` pins the builder).
3. Add a MySQL plugin to the project (Railway wires `DB_*` env vars
   for you automatically — Laravel reads `MYSQL*`/`DB_*` from the
   environment).
4. Add these environment variables on the web service:
   - `APP_KEY` — generate one locally with `php artisan key:generate --show`
     and paste the `base64:...` value
   - `APP_ENV=production`, `APP_DEBUG=false`
   - `APP_URL=https://<your-railway-domain>`
   - `SESSION_DRIVER=database`, `CACHE_DRIVER=database`
5. Deploy. The container's `docker/entrypoint.sh` runs migrations on
   boot. After the first successful deploy, run once (Railway shell or
   a one-off command): `php artisan db:seed --force` to load demo data.

### Render (Postgres)

`render.yaml` defines a Docker web service plus a free Postgres
database and wires the `DB_*` env vars between them automatically.

1. Push this repo to GitHub.
2. On [render.com](https://render.com), "New" → "Blueprint" → point it
   at this repo; it reads `render.yaml`.
3. Set the `APP_KEY` env var on the web service (same as above).
4. Deploy, then run `php artisan db:seed --force` once via the Render shell.

### Notes

- Product photos uploaded through the admin panel are written to
  `storage/app/public`, which is **not** persisted across deploys on
  either platform's free tier (no attached disk). For a portfolio
  demo this is fine — the seeded sample products ship baked into the
  Docker image. For real persistent uploads, add an S3-compatible
  disk (e.g. Cloudflare R2) to `config/filesystems.php`.
- Outgoing mail (order confirmation) defaults to the `log` driver
  locally. Set `MAIL_MAILER` and the `MAIL_*` credentials in
  production if you want real emails sent.

## Original setup notes (id-ID)

1. `composer install`, `npm install`, `php artisan key:generate`,
   `php artisan storage:link`.
2. Copy `.env.example` to `.env`, configure the database/email, then
   `php artisan migrate`.
3. Untuk penyesuaian email bisa lihat video berikut,
   https://www.youtube.com/watch?v=GKFbicONxLk&t=774s mulai menit 19.00.
4. Alamat tujuan email checkout diatur di method `thanks()` pada
   `UserController.php`.
5. Foto statis (logo, banner, dsb.) sekarang berada di `public/images`
   — foto produk tetap otomatis tersimpan lewat halaman "Add Product"
   admin.
6. Untuk menjadi admin: register lebih dulu, lalu ubah `role_id`
   user tersebut menjadi `'1'` di database.
