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

- Base de données :
    - Ajout d'une entité contenant l'année sélectionnée
- Controleur WishesMatrixController :
    - Ajout de fonctions pour interagir avec la base de données
    - Envoi à la vue des années affichables, de l'année sélectionnée, et des classes à afficher
- Vue wishesMatrix
    - Affichage des classes de l'année sélectionnée
    - Ajout du menu déroulant pour sélectionner l'année, avec comme valeur par défaut l'année actuellement sélectionnée
    - Affichage des classes
- Script js wishesMatrix
    - Modification de la requête POST pour envoyer l'année sélectionée
- Classe Flock :
    - Modification de l'attribut students afin de retourner les élèves par ordre alphabétique des initiales
- Classe Internship :
    - Renommé la relation 'companies' en 'company'

Remarques 
    - La requête POST envoyée avec le script js retourne une erreur. Le problème était déjà présent initialement.
    - Pour l'instant, modifier l'année à afficher ne rafraichit pas automatiquement la page

Modifications potentielles
 - N'afficher que les élèves de la classe au lieu de toutes les personnes de la classe
 - Distinguer visuellement les différentes classes
 - Rafraichir automatiquement la page une fois l'année à afficher modifiée

# Tests

(Terminés, le ...)

# Commit / Merge

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)