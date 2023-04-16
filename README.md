<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/c5vargas/default_laravel_api/main/public/assets/img/logo-devs.png" width="400"></a></p>

## About Laravel API Server

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## How works repository pattern arquitecture

The Pattern Repository architecture in Laravel is a design pattern used to separate the business logic from the data access layer of an application.

In this architecture, the data model is treated as a collection of objects, which are used to interact with the database. The Repository Pattern acts as an interface between the business layer and the data access layer. Instead of the business layer interacting directly with the data access layer, it does so through a repository that implements a defined interface.

## How to install

The first thing to do is to clone the repository from this git repository.

Once you have the software downloaded, you will need to configure the .env file. This file is important because it contains the settings needed to connect to the database and other important services.

Composer is a package manager for PHP that is used to install software dependencies. Run the command in the terminal in the directory of the downloaded software. Composer will install all the dependencies necessary for the software to function properly.

```
composer install
```

This command is used to migrate the database and load the test data. Run the command in the terminal in the downloaded software directory. This will create the necessary tables in the database and load the initial data.

```
php artisan migrate --seed
```

Run php artisan serve: Finally, run the command in the terminal in the directory of the downloaded software. This command will start a local server so you can access the software from your web browser.

 ```
 php artisan serve
 ```

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
