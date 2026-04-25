# Coffee Shop

Coffee Shop is a Laravel application for browsing coffee items, managing a cart, and handling authenticated user and admin flows.

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js and npm
- SQLite enabled in PHP

## Local Setup

1. Install the PHP dependencies.

	```bash
	composer install
	```

2. Install the frontend dependencies.

	```bash
	npm install
	```

3. Create your local environment file.

	```bash
	copy .env.example .env
	```

	If you are using PowerShell and the file already exists, you can skip this step.

4. Generate the application key.

	```bash
	php artisan key:generate
	```

5. Make sure the SQLite database file exists.

	```bash
	New-Item -ItemType File database/database.sqlite -Force
	```

6. Run the database migrations.

	```bash
	php artisan migrate
	```

## Run The Project

Open two terminals and run the following commands:

```bash
php artisan serve
```

```bash
npm run dev
```

Then open the app in your browser at:

```text
http://127.0.0.1:8000
```

## How to Use It

Once the application is running, you can access the following features:

1. **Browsing Items:** On the homepage, you can view the available coffee items and their details.
2. **Managing Cart:** Add items to your cart, update quantities, or remove items as needed before checking out.
3. **User Accounts:** Register a new account or log in to keep track of your orders and profile.
4. **Admin Dashboard:** If your user has admin privileges, you can access the admin panel to manage products, categories, and view customer orders.

## Helpful Scripts

- `composer run setup` installs dependencies, creates the environment file if needed, generates the key, runs migrations, and builds assets.
- `composer run dev` starts the Laravel server, queue listener, log viewer, and Vite dev server together.
- `composer run test` clears cached config and runs the test suite.

## Notes

- The default environment uses SQLite.
- If you change database settings in `.env`, update the migration step accordingly.