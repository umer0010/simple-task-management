# simple-task-management

A Laravel Livewire application for managing tasks with tags, import/export functionality, and real-time updates. I used the laravel breeze and livewire package to implement this functionality. 

## Features

- Task CRUD operations
- Tag management (many-to-many relationship)
- CSV/Excel import functionality
- Task filtering and sorting
- Responsive design with Tailwind CSS
- Authentication system
- Queued task completion handling

## Requirements

- PHP 8.3.14+
- Node.js 22+ (22+ recommended)
- Composer 2.0+
- MySQL 5.7+ or MariaDB 10.3+
- 512MB+ RAM
- 1GB+ disk space

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/umer0010/simple-task-management.git
   cd task-management-systemimplemented in livewire and laravel, basic crud operations and some advance functionality 
2: Install the node modules using npm install command.
3: Install the composer using  composer install command.

Once node modules ins installed then use command npm run build and finally run npm run dev, you are redirected to application. 

Run: 
please create the database with the name: stms
then run php artisan:migrate command to migrate your database.

then use this command to seed the credentails in db: php artisan db:seed

credentails are: 

test@example.com
password

For jobs: 
you have to run this command: php  artisan queue:work 
Once your application is run go to login and enter credentials here, you are login to dashboard.

