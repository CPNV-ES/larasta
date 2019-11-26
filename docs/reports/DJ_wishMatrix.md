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
    - Redirection après réception des données vers la page de souhaits
- Vue wishesMatrix
    - Affichage des classes de l'année sélectionnée
    - Affichage des élèves sans initiales, représentés par '???'
    - Distinction entre plusieurs classes
    - Ajout du menu déroulant pour sélectionner l'année, avec comme valeur par défaut l'année actuellement sélectionnée
    - Ajout d'un formulaire pour envoyer les données entrées par POST
- Script js wishesMatrix
    - Suppression de la fonction ajax de POST
- Classe Flock :
    - Modification de l'attribut students afin de retourner les élèves par ordre alphabétique des initiales
- Classe Internship :
    - Renommé la relation 'companies' en 'company'

Modification :
- Controleur WishesMatrixController :
    - Modification de la méthode getFlockYears afin de récupérer ses données de manière plus propre

Remarques 
 - La sélection des entreprises à afficher est peut-être à revoir

Améliorations à faire dans de nouvelles tâches
-  Afficher les stages plutôt que les entreprises (toujour afficher le nom de l'entreprise)
       - regrouper les stages identiques, en indiquant le nombre de places
       - une entreprise peut avoir 2 stages identiques et un différent
 - Meilleure distinction visuelle entre les deux classes



# Tests
Création de nouvelles classes avec des étudiants dans une nouvelle année.
- La nouvelle année apparait dans le menu déroulant
- Les élèves sont affichés triés par classe et par ordre alphabétique

Création de nouveaux souhaits
- Les souhaits sont affichés, s'ils sont associés à une entreprise affichée

Modification des données du formulaire
- Les nouvelles données sont soumises
- La page est rafraichie
- L'affichage est modifié en conséquence

(Terminés, le ...)

# Commit / Merge

commit 251dd32950b846c22bafa38557f6676c62ec2596, branche Damien

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)