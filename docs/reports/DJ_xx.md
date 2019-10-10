Prise en charge le 25.09.2019, par DJ

# Analyse du problème

## Fonctionnement actuel

Les requêtes SQL de la page de souhaits n'utilisent pas Eloquent.

## Description du problème

Eloquent permet une gestion plus simple des interactions avec la base de données, 
sans avoir besoin d'écrire manuellement les requêtes SQL.
Cela permet une maintenance plus simple du code.

## Description de la solution

Remplacement des requêtes SQL, afin d'utiliser Eloquent.

(Terminé, le ...)

# Plan d'intervention

- Création des classes manquantes pour les tables de la base de données
- Ajout des relations manquantes dans les classes de la base de données
- Utilisation des classes plutôt des fonctions de la page de souhaits
- Suppression des fonctions désormais inutiles

(Terminé, le ...)

# Exécution

- Correction d'un bug effectuant une erreur au lieu d'afficher la page de souhaits
- Ajout du .env.example, afin de faciliter la prise en main du projet par un nouveau dévelopeur
- Classe Company : 
    - renommé de Companies à Company
    - simplification de la méthode internships
- Classe Contractstate : 
    - renommé de Contractstates à Contractstate
- Classe Internship : 
    - simplification de la méthode contractstate
- Classe Person :
    - renommé de Persons à Person
    - ajout du lien à la table (pour Laravel, le pluriel de Person est People)
- Classe Wish :
    - renommé de wishes à Wish
    - ajout du lien vers Internship
- Controleur WishesMatrixController :
    - renommé certaines fonctions privées
    - utilisation d'Eloquent dans les requêtes
- Vue wishesMatrix :
    - affichage des données en utilisant Eloquent
- Eloquent :
    - travail de recherche sur la fonction whereHas
    - transmission du savoir auprès de Diogo et Killian
    - Détection et documentation d'un bug faisant que la fonction whereHas ne fonctionne pas 
    avec une version trop récente de PHP

# Tests

(Terminés, le ...)

# Commit / Merge

Dernier commit : branche Damien, 04 octobre 2019

https://github.com/CPNV-ES/larasta/commit/d596283f84187a57eded8a8b2e569d0a1fbaba31

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

Important : La dernière version 7.3 de PHP n'est pas supportée par la version installée de Laravel (5.5.32).
En particulier, la méthode whereHas d'Eloquent ne fonctionne pas avec php7.3.

(Mise à jour, le ...)