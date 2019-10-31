Prise en charge le 31.10.2019, par DJ

# Analyse du problème

## Fonctionnement actuel

La page de souhaits affiche uniquement les souhaits de la classe de l'enseignant.

## Description du problème

La classe de l'enseignant est mal déterminée, empêchant de voir les résultats attendus.
De plus, on souhaite que l'enseigant puisse sélectionner l'année à voir.

## Description de la solution

- Ajout d'une liste déroulante sur la page de souhaits dans la vue des enseignants, 
permettant de sélectionner l'année.
- Les élèves sont affichés par ordre alphabétique
- L'année sélectionnée doit être sauvegardée, et est commune à tout le monde
- Idéalement, les différentes classes sont visuellement distinctes

(Terminé, le ...)

# Plan d'intervention

- Base de données :
    - Ajout d'une entité contenant l'année sélectionnée
    - Modification du script de construction de la base de données pour contenir la nouvelle entité
- Controleur :
    - utilisation de l'année afin de récupérer les classes à afficher dans la vue
    - obtenir dans la base de données les années à afficher dans la liste déroulante
    - modification de l'année sélectionnée selon les informations reçues du formulaire
- Vue :
    - Ajout d'un formulaire, avec la liste déroulante
    - Affichage distinct des classes

(Terminé, le ...)

# Exécution

# Tests

(Terminés, le ...)

# Commit / Merge

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)