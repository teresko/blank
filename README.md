# Blank project

This is a template/example of a basic project layout, set up for use with following packages:

- symfony/dependency-injection
- symfony/routing
- twig/twig
- teresko/palladium

You will need to run `composer install` to acquire these dependencies.

It contains code for simplified login/registration + landing pages. To run this on localhost, in the project's directory run command:  

`php -S localhost:8000 ./public/built-in.php`

## Structure

- `public/built-in.php` is a meant to only be used with php built-in server. It's there to make sure, that the SQLite DB file is set up and that there are no varning about missing favicon generated in standard output. It should be removed, if you have a proper webserver.

- `docs/db.sqlite` is a blank SQLite DB file, which is is copied to `tmp/` for persistence. The matching DB schema for MySQL can be found in `docs/schema.sql` file.

- `src/bootstrap.php`  is the entry point for the application. It contains the code for setup of DI container, routing and dispatching.

- `src/Application/` is a directory, that contains all of the UI layer code. In this particular case itis controllers, views and templates for those views.

- `src/Model/` is a directory, that contains all of the business logic code. The notable parts being services, mappers and domain entities.
