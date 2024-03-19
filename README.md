# Taskler - A Task Management System

This is a simple task management system that I made to learn how to use Laravel Filament which 
making use of Livewire gives a modern looking and feeling UI, allowing for pages to be updated 
without a full page reload.

The application is purely for my own learning and is not intended to be used in a live environment!

## Demo Quick Start

To download and install run the following commands in a terminal:

```bash
git clone https://github.com/mattwells/taskler.git
cd taskler
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Open a web browser to http://localhost:8000

## Authentication and Authorization

All the seeded users have the super secure password of `password`.

4 users are set up with each set of permissions, implemented with Laravel Policies, with the 
login email addresses:

* admin@example.com - Has access to the user control panel and can view and edit users and tasks
* editor@example.com - Can view and edit any tasks
* viewer@example.com - Can view any task but only edit tasks created by or assigned to them
* self@example.com - Can only view and edit assigned to them

## Event Usage

The `Task` model has an observer that is listening for a  created or updated. If the task
is updated with a new person assigned to it that user will be sent an email, which can be 
viewed in the log. I have set the default queue driver to sync for testing but will work 
with any queue service.
