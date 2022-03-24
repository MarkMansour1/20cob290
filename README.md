# Team 5: Infrastructure

## Developing locally

#### Initial setup

1. Install PHP version 7.4 or above.

2. (On Windows) Ensure the PHP installation is [on your PATH](https://www.php.net/manual/en/faq.installation.php#faq.installation.addtopath).

3. Install composer for dependency management.

4. Generate vendor folder (The vendor folder is where all the installed packages go) write the command in terminal `composer install`.

5. Clone `.env.example` file and rename to `.env` this file store all the environment variables

6. Regenerate artisan key write the command in terminal `php artisan key:generate`

#### Local database setup

1. Install MYSQL or use (xampp)

2. (On Windows) Ensure the MYSQL installation is [on your PATH]

3. Create new database (e.g instant_support) you could use the commands:

1. `mysql -u root` where root is default username

2. `create database instant_support` where instant_support is the database name

4. Change database credentials in `.env` file (e.g `DB_DATABASE=instant_support`)

#### Creating and populating tables

1. Use the command `php artisan migrate` to create tables from migration file

2. Use the command `php artisan migrate:fresh` whenever the migration files change (so schema updates)

3. Use the command `php artisan db:seed` to populate tables

#### Dealing with errors

If you encounter errors while migrating (so creating tables in your database) it might be because of your MYSQL version (lower than 5.7.7 causes the error).

To fix this edit your `AppServiceProvided.php` file and inside the `boot` method set a default string length:

```php

use Illuminate\Support\Facades\Schema;

public function boot()

{

Schema::defaultStringLength(191);

}

```
