# Taskler - A Task Management System

## Demo Quick Start

Download the repository locally and in the folder run the commands:

```bash
php artisan migrate --seed
php artisan serve
```

Open a web browser to http://localhost:8000

All the seeded users have the super secure password of `password`.

4 users are set up with each set of permissions with the login email addresses:

* admin@example.com - Has access to the Filament control panel and can view and edit users and tasks
* editor@example.com - Can view and edit any tasks
* viewer@example.com - Can view any task but only edit tasks created by or assigned to them
* self@example.com - Can only view and edit assigned to them
