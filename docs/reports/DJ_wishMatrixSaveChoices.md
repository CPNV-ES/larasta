Prise en charge le 17.12.2019 par DJ

# Analyse du problème

## Fonctionnement actuel

Les modifications apportées à la matrice de souhaits, qu'elles soient effectuées par les enseignants ou les élèves,
 ne sont pas sauvegardées

## Description du problème

On souhaite que les choix effectés par les utilisateurs soient persistants. 

## Description de la solution

* Ajout d'un bouton proposant d'enregistrer les modifications.
* Traiter les informations du formulaire associé au bouton afin d'enregistrer les modifications 
et d'en garder la trace dans les remarques.
    * Pour les élèves : ajouts de remarques sur l'élève et le stage
    * Pour les enseignants : ajouts de remarques sur le stage, l'élève et l'enseigant
* Mettre en évidence la colonne de l'élève
* Limiter à un seul état donné par l'enseigant

(Terminé, le ...)

# Plan d'intervention

Vue de la liste de souhaits :
* Distinguer l'élève connecté, en affichant sa colonne d'une couleur différente
* Ajout d'un formulaire caché avec un champ input envoyant un fichier JSON des modifications effectuées
* Ajout d'un bouton permettant d'envoyer les données du formailre

Routes :
* Définitions de routes pour traiter les données des formulaires

Controlleur de la liste de souhaits :
* Ajout de méthodes traitant les modifications avnt de rediriger vers la page
* Extraction, validation, et vérification des droits sur la modification
* Pour les enseignants : ajouts de remarques sur le stage, l'élève et le stage
* Pour les élèves : ajouts de remarques sur l'élève et le stage

Controlleur des personnes :
* Récupération des remarques associées à la personne
* Afficher les enseignants

Vue des personnes :
* Affichage des remarques

(Terminé, le ...)

# Exécution
Etat au 17.12.2019 :
* Discussion avec XCL des objectifs à atteindre et des moyens à utiliser
* Etablissement de la fiche de quête

# Tests

(Terminés, le ...)

# Commit / Merge

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)