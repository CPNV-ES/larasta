# Seeder

Un seeder est un moyen dans le framework laravel de rentrer des données de test facilement et rapidement dans la base de donnée.

# Fichiers

Les fichiers concernant un seeder se trouve dans les dossier `seeds` et `factories` qui ceux-ci se trouve dans le dossier `database`.
```
database/
├── seeds/
│   └── exempleSeeder.php
└── factories/
    └── exempleFactory.php
```

Le seeder se compose de deux fichiers.
 - ExempleFactory.php
 - ExempleSeeder.php

Pour générer le fichier `ExempleSeeder.php` utilisez la commande:
```php
php artisan make:seeder ExempleSeeder
```
>Cette commande va automatiquement générer le fichier dans le dossier `seeds`.

Pour générer le fichier `ExempleFactory.php` utilisez la commande:
```php
php artisan make:factory ExempleFactory
```
>Cette commande va automatiquement générer le fichier dans le dossier `factories`.

le fichier `ExempleSeeder.php` nous permet d'appeler notre factory et de spécifier le nombre de données à ajouter.

le fichier `ExempleFactory.php` contient les informations définit à ajouter dans les champs de la table dans la base de données.

# Exemple

Pour illuster ces fichiers voici un exemple.

- VisitSeeder
```php
public function run()
    {
        $visit = factory(App\Visit::class, 3)->create();
    }
```
>Dans factory on définit le model de la table Visit et le nombre de donnée qui vont être générer 

- VisitFactory
```php
$factory->define(App\Visit::class, function (Faker $faker) {

    return [
        'moment' => $faker->dateTimeBetween('now','+1 month'),
        'confirmed' => 1,
        'number' => $faker->randomNumber(1),
        'grade' => $faker->randomFloat(0,1,6),
        'mailstate' => 1,
        'internships_id' => function () {
            $internships=App\Internship::all()->random()->id;
            return $internships;
        },
        'visitsstates_id' => function (){
            $visitsstates=App\Visitsstate::all()->random()->id;
            return $visitsstates;
        },
    ];
});
```
>Le fichier Factory utilise la librairie Faker pour permettre de générer des données aléatoire 
>
>La factory se definit par la model de la table où les données vont être ajoutées et une fonction qui retourne toutes les données générées pour chaque champs.
>
>On passe Faker à la fonction pour permettre de l'utilisé. Dans le return de la fonction tout les champs de la table sont définit. Chaque champs utilise une méthode différente de Faker pour pouvoir générer les bonnes données par rapport à celui-ci.

# Utilisation

Quand la création de votre seeder est terminé, il faut regénérer le composer :
```
composer dump-autoload
```
Dans le dossier `seeds`, le fichier `DatabaseSeeder.php` est présent par défaut, il va nous permettre de définir les seeder à appeler quand on utilise la commande qui permet de générer les données:

- DatabaseSeeder.php
```php

public function run()
{
    $this->call([
        VisitsSeeder::class,
        Exemple2::class,
        Exemple3::class,
    ]);
}
``` 
>Dans la function run, on ajoute la fonction call qui viendra appeler les différents seeder qui seront précisé dedans.

Pour appeler tout les seeders présent dans le fichier `DatabaseSeeder.php` et générer les données utilisez la commande :

```
php artisan db:seed
```
Pour appeler un seeder spécifique préciser après la commande la class à utiliser :
```
php artisan db:seed --class=VisitsSeeder
```



