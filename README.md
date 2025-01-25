# ACL - Access Control List

This project implements an Access Control List (ACL) to manage permissions, groups, and users within a Laravel application. Permissions are tied to controllers and their public methods, and these permissions can be assigned either to user groups or directly to individual users.

## Features

- **Permissions**: Control what actions can be performed on specific controllers and methods.
- **Groups**: Permissions are assigned to groups, which users can belong to.
- **Direct User Permissions**: Users can have permissions assigned directly, giving more fine-grained control.

## Getting Started

Follow these steps to set up and run the project locally:

### 1. Clone the repository

```bash
git clone https://github.com/AhmedGamal905/ACL-AccessControlList
cd ACL-AccessControlList
```

### 2. Install PHP dependencies

Run the following command to install the required PHP dependencies:

```bash
composer install
```

### 3. Set up environment variables

Create a `.env` file in the root directory if it doesn't already exist. Add the necessary configuration values for your environment. Ensure that the database connection is correctly set up in the `.env` file.

### 4. Configure the database

Set up your database credentials in the `.env` file:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Run migrations and seed the database

After configuring the database, run the following commands to migrate the database and seed it with default data:

```bash
php artisan migrate
```

### 6. Run the seeders

To populate your database with necessary initial data, including default credentials, run:

```bash
php artisan db:seed
```

After running the seeders, you’ll have the following default credentials for logging in as an admin:

- **Email**: admin@admin.com
- **Password**: admin@admin.com

### 7. Start the development server

You can now start the development server with the following command:

```bash
php artisan serve
npm run dev
```