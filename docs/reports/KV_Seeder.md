Prise en charge le 25.09.2019, par Killian Viquerat

# Analyse du problème

La base de donnée manque de données pour tester les différentes fonctionnalité de l'application larasta. Rentrer des données prend du temps et n'est pas très éfficace manuellement.

## Fonctionnement actuel

Données rentrées manuellement dans la base de données pour tester les différentes fonctionalités 

## Description du problème


## Description de la solution

Changer toute les requètes de QueryBuilder à Eloquent.

(Terminé, le ...)

# Plan d'intervention

1. Ajout d'un nouveau model Visitsstate avec la relation sur la table visits.
2. Ajout de la relation Visit à Visitsstates dans le model Visit.
3. Ajout d'une relation Persons à Contactinfos dans le model Contactinfos.
4. Ajout d'une relation Contactinfos à Persons dans le model Persons.
5. Modification des requètes dans le controlleur VisitsController.
6. Changement dans la vue manage de visit.
7. Changement dans la vue visits de visit.

(Terminé, le ...)

# Exécution

1. 10 minutes
2. 5 minutes
3. 5 minutes
4. 5 minutes
5. 30 minutes
6. 15 minutes
7. 15 minutes

# Tests

- Affichage de la page visite avec des données de test.
- Affichage de la page de management d'une visite avec les données de la visite.
- Test des différent bouton de la page manage pour être sur de leur fonctionnement.

(Terminés, le ...)

# Commit / Merge

Commit title 
- Eloquent Visit

Commit Date
- 5/10/2019 at 17:38

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)
