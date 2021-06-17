# LARASTA

![](https://github.com/CPNV-ES/larasta/blob/master/docs/logos/LarastaLogo.png)
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

Go to your project folder and run the installation of laravel dependencies.

```bash
cd /path/to/your/local/clone/of/larasta

# install composer dependencies
composer i

# install the npm dependencies
npm i
```

All the javascript and scss assets are in the ressource/assets folder.

These assets need to be compiled in the public folder, laravel-mix provide an easy way to do the job.

All the tasks are defined in the webpack.mix.js file. 
\
When you create new scss or js files, you need to declare them in the webpack.mix.js file or they won't be included during compilation.

To compile the assets, use:
```bash
# development tasks: transpile, compile and generate maps in the public folder
npm run dev

# optimized for prod tasks: traspile, compile and minify output
npm run prod
```

Instead of running `npm run dev` everytime you make changes to asset files, you can automatically compile modified files with:
```bash
# watches for changes and compiles on the fly
npm run watch
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

First, create the larasta db with the minimal data required (the two commands specified above in point *5.1*)

Then, you need to import the legacy database on your SQL server. Get the latest snapshot at `database/seeds/testData/snapshot_*.sql` and run it
\
The database that was just created should be named *app_internships*, rename it if it isn't the case

Finally, run the migration script located at `database/migrations/app_internships_to_larasta.sql`. This will take the data from *app_internship* and insert it into *larasta*

The database *larasta* should now be populated with data from the legacy internships application 

Please note that the migration script may not be up to date if larasta's database table structure has changed in the meantime 

### 6. A few more required steps

The project needs a few directories to store files locally. 
\
To create these directories, run `php artisan make:tree`

### 7. Login
To get the information of the authentified user use this method `Auth::user()` in your code.

The github authentication only work on the swisscenter server.

### 8. PHP version
There are some issues between the version of Laravel used in this project and the most recents PHP versions. The PHP version used with the project should be PHP 7.4.

### 9. Ready for development
```
php artisan serve
```

If your have problems, you can check the laravel documentation :  
[Installation](https://laravel.com/docs/5.5/installation)  
[Configuration](https://laravel.com/docs/5.5/configuration)
