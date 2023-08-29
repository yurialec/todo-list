## Laravel API TodoList

INFORMATIONS OF THE PROJECT

## Installation

1. run `composer create-project francescomalatesta/laravel-api-boilerplate-jwt myNextProject`;

Once the project creation procedure will be completed, run the `php artisan migrate` command to install the required tables.

## Usage

USAGE

## Main Features

MAIN FEATUES

### How to Use

* `POST api/auth/login`, to do the login and get your access token;
* `POST api/auth/refresh`, to refresh an existent access token by getting a new one;
* `POST api/auth/signup`, to create a new user into your application;
* `POST api/auth/recovery`, to recover your credentials;
* `POST api/auth/reset`, to reset your password after the recovery;
* `POST api/auth/logout`, to log out the user by invalidating the passed token;
* `GET api/auth/me`, to get current user data;

### Separate File for Routes

All the API routes can be found in the `routes/api.php` file. This also follow the Laravel 5.5 convention.

### Secrets Generation

Every time you create a new project starting from this repository, the _php artisan jwt:generate_ command will be executed.

## Configuration

CONFIGURATION

## Tests

If you want to contribute to this project, feel free to do it and open a PR. However, make sure you have tests for what you implement.

In order to run tests:

* be sure to have the PDO sqlite extension installed in your environment;
* run `php vendor/bin/phpunit`;

## Feedback

I currently made this project for personal purposes. I decided to share it here to help anyone with the same needs. If you have any feedback to improve it, feel free to make a suggestion, or open a PR!
