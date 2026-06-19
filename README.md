# Expense Tracker

A simple Expense Tracker application built with Laravel that helps users manage their income and expenses while providing an admin panel for category and user management.

## Features

### User Features

* User Registration & Login
* Add, Edit, and Delete Income Entries
* Add, Edit, and Delete Expense Entries
* Category-based Expense Tracking
* Monthly Reports
* Dashboard with Financial Summary

### Admin Features

* Secure Admin Login
* User Management
* Category Management
* Dashboard Overview

---

## Requirements

* PHP 8.2+
* Composer
* Node.js & NPM
* MySQL
* Laravel 12

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/afnanafnu/expense-tracker.git
cd expense-tracker
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Configure Environment

Copy the environment file:

```bash
cp .env.example .env
```

Update your database credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expense_tracker
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

### 7. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

### 8. Compile Assets

```bash
npm run dev
```

### 9. Start the Application

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## User Access

Visit:

```text
http://127.0.0.1:8000
```

Register a new account or log in using an existing account.

---

## Admin Access

Before accessing the admin panel, make sure you are logged out from the user section.

Admin URL:

```text
http://127.0.0.1:8000/admin
```

### Default Admin Credentials

```text
Email: admin@example.com
Password: password123
```

---

## Development Commands

Clear application cache:

```bash
php artisan optimize:clear
```

Run migrations:

```bash
php artisan migrate
```

Refresh database:

```bash
php artisan migrate:fresh --seed
```

Build production assets:

```bash
npm run build
```

---

## Tech Stack

* Laravel
* MySQL
* Blade Templates
* jQuery
* Select2
* DataTables
* SweetAlert2
* Vite

---

## License

This project is open-source and available for learning and development purposes.
