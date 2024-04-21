<p align="center"> <a href="https://www.ingenieria.unam.mx/unica/"><img src="./public/img/mg-font.png" width="400"></a></p>

# magenta

Management and control system in updating activities for the training and professional development of teachers.

## Dependencies
For this project you will need:

1. [PHP 7](https://windows.php.net/download/) 
2. [Composer](https://getcomposer.org)
3. [magenta-DB](https://github.com/MauRamos334455/magenta-db)
## Deploy
### Connect 
Connect this Laravel project to a database created via [magenta-DB](https://github.com/MauRamos334455/magenta-db) with the .env file.

Example
```shell
DB_CONNECTION = pgsql
DB_HOST = <ip address or hosting URL>
DB_PORT = 5432
DB_DATABASE = magenta
DB_USERNAME = magenta
DB_PASSWORD = <your password>
```

### Execute
Install dependencies
```shell
php composer install
```

Initialize the server with the next commands

```shell
php artisan serve --port=<port_number> --host=<ip_address>
```
## Build with
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

<p align="center"> <a href="https://www.ingenieria.unam.mx/unica/"><img src="./public/img/unica.png" width="200"></a></p>