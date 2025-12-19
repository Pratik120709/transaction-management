# Transaction Management System

A Laravel-based transaction management system with dashboard and reporting features.

## Features

- Transaction listing with server-side pagination
- Filtering by Transaction ID and Status
- Dashboard with daily success transaction totals
- Background job for calculating yesterday's total
- RESTful API for transactions

## Setup Instructions


### Step 1: Clone the Repository

```bash
git clone <repository-url>
cd transaction-management


Step 2: Install PHP Dependencies

composer install

php artisan key:generate

Step 3: setup env

Step 4: Database Setup

# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed

Step 5: Run Development Server

# Start the Laravel server
php artisan serve
