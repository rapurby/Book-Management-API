<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Book Management API

A simple RESTful API for book management built with Laravel.

## Features
- Create, Read, Update, Delete books
- Search books by title or description
- Pagination support (4 items per page)
- Validation for duplicate books
- Clean OOP architecture with Service Layer pattern

## Requirements
- PHP 8.1+
- Composer
- MySQL/PostgreSQL

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy .env.example to .env and configure database
4. Generate key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. (Optional) Seed database: `php artisan db:seed --class=BookSeeder`
7. Start server: `php artisan serve`

## API Documentation

See API Endpoints Documentation section above for detailed endpoints.

## Testing

Run `php artisan test` to execute the test suite.

## License

MIT
