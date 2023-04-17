<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/c5vargas/default_laravel_api/main/public/assets/img/logo-devs.png" width="400"></a></p>

## About Laravel API Server

A collection of Laravel API starter kits using the repository pattern. Very flexible and useful when developing medium to large scale applications.

An Application Programming Interface, denoted as API, enables applications to access data and other external software functionalities. APIs are gaining popularity among developers since they save time and resources. Companies do not need to develop complex systems from scratch.

They can opt to consume data from other existing frameworks. An API is responsible in returning the appropriate response whenever an application sends a request.
That is why this GIT repository exists, to facilitate the creation of applications and start with a previously configured and robust API server. 

All you have to do is start creating your own Models and Controllers!

## How works repository pattern arquitecture

The Pattern Repository architecture in Laravel is a design pattern used to separate the business logic from the data access layer of an application.

In this architecture, the data model is treated as a collection of objects, which are used to interact with the database. The Repository Pattern acts as an interface between the business layer and the data access layer. Instead of the business layer interacting directly with the data access layer, it does so through a repository that implements a defined interface.

## Ready to use:
- Fully prepared authentication system.
- [Events](https://laravel.com/docs/9.x/events), [Listeners](https://laravel.com/docs/9.x/events#registering-events-and-listeners) and [Observers](https://laravel.com/docs/9.x/eloquent#observers) when users sign up.
- [Seeders](https://laravel.com/docs/9.x/seeding#writing-seeders) and [Model Factories](https://laravel.com/docs/9.x/eloquent-factories#main-content) to import test data.
- Responsive mail template.
- Controller to manage all json responses.
- Model Transformers to include the fields to be returned from a model.
- [Validations in Requests](https://laravel.com/docs/9.x/validation#form-request-validation) to return error messages in json format in a more flexible and easier way.
- EventServiceProvider and RepositoryServiceProvider initialized.
- [Language-ready](https://laravel.com/docs/9.x/localization#main-content): Prepared for use in another language.
- [Passport](https://laravel.com/docs/9.x/passport#main-content) installed and ready to run.

## System Requeriments
- PHP 8.0 - 8.2
Laravel 9.x requires a minimum PHP version of 8.0.

## How to install

The first thing to do is to download the package from composer.

Composer is a package manager for PHP that is used to install software dependencies. Execute the command in the terminal in the directory where you want to create the project. Composer will install all the dependencies necessary for the software to function properly.

You can do this by performing the following command.

```
composer create c5vargas/laravel-api-server
```

Once you have the software downloaded, you will need to configure the .env file. This file is important because it contains the settings needed to connect to the database and other important services. Copy the .env.example file and name it .env

```
cp .env-example .env
```

This command is used to migrate the database and load the test data. Run the command in the terminal in the downloaded software directory. This will create the necessary tables in the database and load the initial data.

```
php artisan migrate:refresh --seed
```

Finally, run the command in the terminal in the directory of the downloaded software. This command will start a local server so you can access the software from your web browser.

 ```
 php artisan serve
 ```

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<small>Updated at 17.04.23</small>
