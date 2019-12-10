Prise en charge le 19.11.2019, par DJ

# Analyse du problème

## Fonctionnement actuel

La page de souhaits affiche les compagnies.

## Description du problème

Une compagnie peut avoir proposer plusieurs stages différents ou identiques.

## Description de la solution

Afficher tous les stages. Permettre de distinguer les stages d'une même entreprise.

Regrouper les stages identiques et indiquer le nombre de places disponibles.

(Terminé, le ...)

# Plan d'intervention

Controleur :
* Au lieu de sélectionner les compagnie, sélectionner les stages.
* Regrouper les stages ayant le même stage précédent.

Vue :
* Utilisation des stages plutot que des compagnies
* Mettre un lien vers la page de description du stage dans la première colonne du tableau

(Terminé, le ...)

# Exécution

Controleur WishesMatrixController
* Création d'une méthode récupérant tous les stages, les triant par ordre alphabétique de l'entreprise
* Supression de l'ancienne méthode récupérant les entreprises

Controleur InternshipsController
* Remplacement de quelques dbquerries par des requetes Eloquent

Controleur PeopleControlleur
* Remplacement d'une dbquerry par une requete Eloquent
* Correction d'un bug empechant les personnes avec des stages d'etre affichées
* Correction d'un bug faisant que, pour un responsable, 
seuls les stages dont il est responsable administratif sont affichés

Vue wishesMatrix
* Utilisation des stages plutôt ques compagnies
* Ajout d'un lien vers le stage

Vue internshipview
* Utilisation d'Eloquent pour afficher les stages
* Correction d'un bug qui empêchait les stages auxquels l'élève n'a pas été attribué de s'afficher

Vue internshipedit
* Utilisation d'Eloquent pour afficher les stages
* Correction d'un bug qui empêchait les stages auxquels l'élève n'a pas été attribué de s'afficher

## A FAIRE
Modification de stage :
    * Possibilité de modifier le stage root
    
Création de stage :
    * Par défaut est son propre stage root
    * Possibilité de sélectionner un autre stage racine

## A ETE ABANDONNE
Database
* Déplacement dans un dossier old les scripts SQL n'étant pas d'actualité
* Mise à jour du schéma pour séparer la table internship en internship/internshipfamily
* Mise à jour du script de création de la BD pour ajouter la nouvelle table et séparer les données de stage selon les deux tables

Controleur InternshipsController
* Modification de dbquerries pour être compatible avec les stages séparés en deux tables

Controleur PeopleControlleur
* Modification d'une dbquerry d'un filtre 
pour etre compatible avec les stages séparés en deux tables
* Ajout d'une requete Eloquent pour etre compatible avec la liste des stages

Controleur EntrepriseCOntrolleur
* Modification d'une requete Eloquent pour être compatible avec les stages séparés en deux tables

Vue internshipslist
* Modification des requetes Eloquent pour être compatible avec les stages séparés en deux tables

Vue peopleEdit
* Modification des requetes Eloquent pour être compatible avec les stages séparés en deux tables

Vue visits
* Modification des requetes Eloquent pour être compatible avec les stages séparés end eux tables

Modèle Intership
* Suppression des champs déplacés dan la BD

Modèle InternshipFamily
* Création du modèle
* Ajout des éléments déplacés depuis Intership

# Tests


(Terminés, le ...)

# Commit / Merge

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation
Pour regrouper de manière propre les stages, 
il faudrait séparer la table des stages en deux tables (internships et internshipGroup).
Cependant, les stages étant un élément central de l'application, 
cette modification demanderait de modifier pratiquement toutes les pages afin d'être compatibles avec la nouvelle structure des données.
Si Eloquent avait été implémenté partout, cela pourrait être fait facilement en modifiant les modèles, 
mais la plupart des requetes sont des dbquerries, et doivent donc toutes être odifiées manuellement.
Pour cette raison, après consultation avec Monsieur Carrel, 
il a été décidé simplement de rajouter un champ indiquant l'id du stage 'maitre'. 
Bien que permettant la redondance de données, il été estimé que c'était la meilleure manière de résoudre le problème.

Comportements anormaux détectés :
* Générer le contrat (depuis la page stage) : erreur, ne trouve pas App\Companies
* Visites : qui est sélectionné par défaut ? (affiche Carrel dans la liste, mais n'affiche pas les visites de Carrel)
* Page personnes : n'affiche pas toutes les personnes
* Page personne : ne fonctionne pas avec les enseignants (cas non defini)
* Filtres : bouton illisible

(Mise à jour, le ...)