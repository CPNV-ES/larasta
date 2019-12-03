Prise en charge le 19.11.2019, par DJ

# Analyse du problème

## Fonctionnement actuel

Il n'y a pas de seeder pour les souhaits.

## Description du problème

Cela force à créer manuellement les données de test, faisant perdre du temps aux dévelopeurs.

## Description de la solution

- Création d'un seeder pour les souhaits
- Création d'une factory

(Terminé, le ...)

# Plan d'intervention

- Seeder
    - Creation
    - Respect des clés étrangères
- Factory
    - Creation

(Terminé, le ...)

# Exécution

- Factory WishFactory
    - Creation
    - Respect des clés étrangères
    - Génération aléatoire du rank
- Seeder WishSeeder
    - Creation
    - Appel à la factory

# Tests
Utilisation du seeder. 
L'exécution ne gènère pas d'erreurs. 
La base de données contient 50 nouveaux souhaits. 
Les souhaits sont visibles dans la vue des souhaits.

(Terminés, le ...)

# Commit / Merge

https://github.com/CPNV-ES/larasta/commit/96dd7f2c03254361524eaad290b1edf0c8b9a9d7

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

Factory :
- Sert à créer de nouveaux souhaits (table wishes)
- Valeurs :
    - internships_id : id d'un stage ayant lieu cette année, afin de rester cohérent avec le fonctionnement de la page de souhaits, 
    qui ne permet pas d'autres souhaits
    - persons_id : id d'un élève (role = 0)
    - rank : 1-3
    - workPlaceDistance : valeur par défaut (null), 
    au moment de la création de la factory il ne s'agit pas d'une valeur utile
    - application : valeur par défaut (0), 
    au moment de la création de la factory il ne s'agit pas d'une valeur utile
    
Seeder :
- Utilisation 'php artisan db:seed --class=WishSeeder'
- Fait appel à la factory
- Nombre d'entrées créées : 50, nombre choisi afin de créer une quantité de données suffisant afin de tester l'application,
tout en limitant le risque de données incohérentes.

Améliorations possibles :
* limiter à 3 souhaits par élève
* limiter chaque rank à une utilisation/élève (actuellement l'élève peut avoir 3 souhaits avec le même rank)
* empêcher un élève de souhaiter deux fois le même stage

(Mise à jour, le ...)