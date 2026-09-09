# Laboratory Exercise No. 5 - Setup Guide

CRUD Application with Authentication using LavaLust, Aiven MySQL and Render.

This adds a **Product Management** module on top of the existing project. None
of the existing Student/Users/Welcome code was changed.

## Files added

| File | Purpose |
|---|---|
| `app/migrations/003_create_products_table.php` | Migration for the `products` table |
| `products.sql` | Plain SQL version of the same table, for pasting into the Aiven console |
| `app/models/ProductModel.php` | Model for the `products` table |
| `app/controllers/ProductController.php` | Create / Read / Update / Delete logic |
| `app/views/products/index.php` | Product list (Read) |
| `app/views/products/create.php` | Add product form (Create) |
| `app/views/products/edit.php` | Edit product form (Update) |
| `app/controllers/AuthController.php` | Login / Logout |
| `app/views/auth/login.php` | Login form |
| `app/middlewares/AuthMiddleware.php` | Session-based route guard (same pattern as `StudentMiddleware`) |
| `app/config/routes.php` | Added `/login`, `/logout`, and the `/products/*` route group (updated, not replaced) |
| `app/config/middleware.php` | Registered the `auth.access` middleware (updated, not replaced) |
| `render.yaml` | Optional Render blueprint for one-click deploy from the existing `Dockerfile` |

Protected routes (require login): `/products`, `/products/create`,
`/products/edit/{id}`, `/products/delete/{id}`. Unauthenticated visitors are
redirected to `/login`.

## 1. Create the database on Aiven MySQL

1. Create a MySQL service on Aiven and create/select your database.
2. Open the Aiven console's **SQL query editor** (or connect with the
   `mysql` client using the connection details Aiven gives you) and run the
   contents of `products.sql` in this repo. It creates the `products` table
   with the exact columns required by the lab and a few sample rows.
3. This project already ships with a `users` table migration
   (`app/migrations/001_create_users_table.php`), used for login. If it
   hasn't been created yet on your Aiven database, either:
   - enable migrations (`$config['migration_enabled'] = TRUE;` in
     `app/config/migration.php`) and run `php lava migrate`, or
   - create it manually with the same columns
     (`id, username, email, password, role, is_active, created_at, updated_at`).
4. Create at least one login account. Since there's no self-service register
   page (not required by the lab), generate a password hash locally and
   insert it directly:

   ```bash
   php -r "echo password_hash('YourPassword123!', PASSWORD_DEFAULT), PHP_EOL;"
   ```

   Then, on Aiven:

   ```sql
   INSERT INTO users (username, email, password, role, is_active)
   VALUES ('admin', 'admin@example.com', '<paste the generated hash here>', 'admin', 1);
   ```

## 2. Configure local/deployed environment variables

Copy `.env.example` to `.env` and fill in the Aiven credentials (never commit
`.env` - it's already in `.gitignore`):

```
APP_NAME=Lavalust
APP_KEY=            # generate with: php lava key:generate
APP_ENV=development

DB_HOST=<your-service>-<project>.aivencloud.com
DB_PORT=<aiven port, e.g. 12345>
DB_USER=avnadmin
DB_PASSWORD=<your Aiven password>
DB_NAME=<your database name>
```

## 3. Run locally

```bash
php lava serve
```

Visit `http://127.0.0.1:3000/login`, sign in with the account you created,
then go to `http://127.0.0.1:3000/products` to test Create / Read / Update /
Delete. Visiting `/products` while logged out should redirect you back to
`/login`.

## 4. Push to GitHub and deploy to Render

1. Commit and push this project to a GitHub repository (`.env` stays out of
   the repo).
2. In Render, create a new **Web Service** from that repo. Render will detect
   the root `Dockerfile` (or use the included `render.yaml` blueprint).
3. Under the service's **Environment** tab, add the same variables listed in
   step 2 above (`APP_NAME`, `APP_KEY`, `APP_ENV=production`, `DB_HOST`,
   `DB_PORT`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`) using your Aiven
   credentials. Do not commit these values to GitHub.
4. Deploy, then verify the Render URL: login works, `/products` is blocked
   when logged out, and all CRUD operations work against Aiven MySQL.

## 5. What to submit

Per the lab instructions: GitHub repo URL, Render app URL, screenshots of
login, product list, add/edit/delete, and the `products` table in Aiven.
