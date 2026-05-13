# 📚 Library Management System

A comprehensive **library management application** built with Laravel 12 for managing books, members, and borrowing transactions. Features a complete CRUD interface, advanced filtering, and RESTful API endpoints.

## ✨ Features

### Book Management
- Add, edit, delete, and search books
- Track inventory (total and available copies)
- Associate books with authors, publishers, and categories
- Book status tracking (available/borrowed/archived)
- ISBN tracking for unique identification
- Soft delete functionality preserves history

### Member Management
- View and manage library members
- Track membership status (active/inactive)
- Monitor borrowing history per member
- Record member contact information
- Automatic membership duration calculation

### Borrowing System
- Record book borrowing transactions
- Track due dates and return status
- Identify overdue books automatically
- Monitor current borrowing activity
- Dashboard with borrowing statistics

### Dashboard Analytics
- Total books and members count
- Currently borrowed books indicator
- Overdue items tracking
- Recent borrowing transactions
- Real-time library statistics

### Advanced Features
- Author management with biography
- Publisher database
- Category/Genre classification
- Book reviews with ratings (polymorphic)
- Advanced filtering and search
- RESTful API with Sanctum authentication

## 🛠️ Tech Stack

- **Backend**: Laravel 12, PHP 8.2, Eloquent ORM
- **Frontend**: Blade, Tailwind CSS 4, JavaScript
- **Database**: MySQL/PostgreSQL
- **API**: RESTful with Laravel Sanctum
- **Build**: Vite, Composer
- **Testing**: Pest PHP

## 🚀 Quick Start

```bash
# Installation
composer install
npm install

# Setup
cp .env.example .env
php artisan key:generate
php artisan migrate

# Run development server
php artisan serve
npm run dev
