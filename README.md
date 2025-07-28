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


4: Then do this: cp .env.example .env
5: php artisan key:generate


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stms
DB_USERNAME=root
DB_PASSWORD=




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


Project Structure:
app/
  Livewire/
    Tasks/          # All task-related components
  Models/          # Database models
  Jobs/            # Queue jobs
database/
  migrations/      # Database schemas
  seeders/         # Test data
resources/
  views/           # Blade templates
  js/              # JavaScript files
routes/
  web.php          # Application routes


1: On dashboard you will be able to create task, you will be able to edit and delete task using modals.
2: then there is import data button, where you click it and upload the csv file that will render it, you have refresh it to see the results i tried to do this with out page reload , but unable so filters all things need to refresh the page to see the results.

i will provide you the csv file.
