## Laravel API TodoList

The purpose of the project is to present a list of tasks, where the user needs to register first, the system will be able to register a task, visualize it, edit, delete, or mark it as completed.

## Installation

1. run `compose up -d` inside de main folder of the project;

Once the project creation procedure will be completed, run the `php artisan migrate` command to install the required tables.

## Main Features

Create a new user, log in, CRUD of the task, mark task as completed. 

### How to Use

* `POST api/auth/register`, to create a new user into your application;
* `POST api/auth/login`, to do the login and get your access token;
* `POST api/auth/logout`, to log out the user by invalidating the passed token;
* `GET api/tasks/`, to list all tasks;
* `POST api/tasks/create`, to create a new task;
* `GET api/tasks/id`, to show details of a task;
* `DELETE api/tasks/id`, to delete a task;
* `POST api/tasks/update/id`, to update a task;
* `POST api/tasks/complete_task/id`, to mark a task as completed;


## Feedback

I currently made this project for the test of Buzzvel. I hope to have a feedback as soon as possible :)
