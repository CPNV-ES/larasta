# LARASTA

"Stage" application with laravel.

## Requirement
* composer
* npm
* PHP 7.4 or later
* On php.ini you must have to enable the following modules :
  * curl
  * fileinfo
  * gd2
  * mbstring
  * exif
  * pdo_mysql

## Set up development

### 1. Clone the repository
Clone https://github.com/CPNV-ES/larasta.git on your local machine.

### 2. Install dependencies
Go to your project folder and run the installation of laravel dependencies.

```bash
cd /path/to/your/local/clone/of/larasta

# install composer dependencies
composer i

# install the npm dependencies
npm i
```

To create all js and css files

```bash
# install the npm dependencies
npm run dev
```

### 3. Create .env file
When the dependencies are installed you must duplicate the ``.env.example`` file and rename it to ``.env``.

Then open your ``.env`` file and complete the information four our specific development environment.

This information can be found in the CPNV's private server : 

``N:\COMMUN\ELEVE\INFO\SI-T1a\LARASTA_ENV_DATA\ENV_DATA.xlsx``

### 4. Set up your application key
Finally, for laravel to work properly, you must generate the application key.

```bash
cd /path/to/your/local/clone/of/larasta

php artisan key:generate
```

### 5. Create and seed the database

#### 5.1 Minimal database

In terminal, use the next command to create database with required data:
```
php artisan mysql:createdb larasta
php artisan migrate --seed
```

#### 5.2 Test data 

if you want add test data:
```
php artisan db:seed --class="TestDataSeeder"
```

#### 5.3 Using test data from the Legacy internships application

If you want to test the app with real data, you can work with the legacy internship application's data

First, create the larasta db and run the seeder for required data (the two commands specified above)

Then, you need to import the legacy database on your SQL server. The snapshots are located at `database/seeds/testData/snapshot_*.sql`
\
The database needs to be named `app_internships`

Finally, run the migration script located at `database/migrations/app_internships_to_larasta.sql`

The database larasta should now be populated with data from the legacy internships application 

Please note that the migration script may not be up to date if larasta's database table structure has changed in the meantime 
### 6. Login
To get the information of the authentified user use this method `Auth::user()` in your code.

The github authentication only work on the swisscenter server.

### 7. PHP version
There are some issues between the version of Laravel used in this project and the most recents PHP versions. The PHP version used with the project should be PHP 7.4.

### Ready for development
```
php artisan serve
```

If your have problems, you can check the laravel documentation :  
[Installation](https://laravel.com/docs/5.5/installation)  
[Configuration](https://laravel.com/docs/5.5/configuration)
