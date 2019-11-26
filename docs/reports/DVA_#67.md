Prise en charge le 12.11.19, par Diogo Vieira Ferreira

# Analyse du problème
Actuellement la page de modification d'un stage n'a pas de gestion au niveau des remarques, il faut les faire manuellement.
Nous souhaitons faire que quand nous modifions un champ, de manière dynamique un champ texte apparaîsse à côté de la zone 
modifiée demandant à l'utilisateur pourquoi il a changé le stage.
Au moment de sauvegarder les données, le back-end met à jour les différents champs en ajoutant les différentes remarques (si disponibles).

## Fonctionnement actuel
- Possibilité de modifier les champs sans avoir à ajouter des remarques
- Aucun système de remarques automatiques

## Description du problème
- Après la modification d'un champ, aucune remarque est générée `exemple: modification des dates du stage (12.11.2019 - 31.12.2020)`
- L'utilisateur doit créer manuellement une remarque s'il souhaite en ajouter une.

## Description de la solution
- Créer au changement d'une donnée une nouvelle colonne avec un nouveau champ de type text
- quand on remet les mêmes données, nous n'avons pas de nouvelle colonne
- A la validation envoyer toutes les données visibles et l'enregistrer

(Terminé, le 21.11.19)

# Plan d'intervention
1. Création d'une méthode générique de type foreach en Javascript
2. Création d'une méthode de création d'éléments du DOM dans d'autre éléments sur my.js
3. Création d'un JS internshipsEdit pour la page ayant le même nom
4. Dans le premier form de la page, je prends tous les champs de type input et select
5. Je leur donne un évènement qui crée une colonne au changements de données
6. Ajout d'une condition qui cache la nouvelle colonne si finalement nous remettons les données de bases
7. Modification de la méthode AddRemarks afin qu'elle utilise la méthode se trouvant dans RemarksController
8. Modification de la route pour l'ajout manuel de remarques
9. Ajout dans la méthode `update` une gestion dynamique pour les remarques reçues par la page internshipsEdit
10. Remplacement d'une requête en Query Builder vers Eloquent

(Terminé, le 26.11.2019)

# Tests
1. Modification d'un input, une nouvelle colonne apparaît demandant "pourquoi?"
2. Remmettre la valeur d'avant cache la nouvelle colonne
3. Valider les informations envoie toutes les informations dans la base de donnée
4. Dans la zone remarques, nous voyons nos précédents changements
5. Ajouter manuellement une remarque, elle est bien visible dans la zone remarques
6. les différents boutons validations redirigent sur la page d'édition après avoir envoyé les données.

(Terminés, le 26.11.2019

# Commit / Merge
- Avant dernier commit e10613dbfa8f4848d71c8d2ef42bcea9f6fb0f2d
(Fait, le 25.11.19)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)

