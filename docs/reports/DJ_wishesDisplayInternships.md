Prise en charge le 19.11.2019, par DJ

# Analyse du problème

## Fonctionnement actuel

La page de souhaits affiche les compagnies.

## Description du problème

Une compagnie peut avoir proposer plusieurs stages différents ou identiques.

## Description de la solution

Afficher tous les stages. Permettre de distinguer les stages d'une même entreprise.

Idéalement, les stages identiques sont regroupés et indiquent le nombre de places.

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

Vue wishesMatrix
* Utilisation des stages plutôt ques compagnies
* Ajout d'un lien vers le stage

Vue internshipview
* Utilisation d'Eloquent pour afficher les stages
* Correction d'un bug qui empêchait les stages auxquels l'élève n'a pas été attribué de s'afficher

Vue internshipedit
* Utilisation d'Eloquent pour afficher les stages
* Correction d'un bug qui empêchait les stages auxquels l'élève n'a pas été attribué de s'afficher

A faire
* Vue des stages : 
    * ATTENDRE : Fonctionnement correct des filtres
    * afficher tous les stages, y compris ceux qui n'ont pas de stagiaire attribué
* BD :
    * ATTENDRE : MAJ BD
    * séparer internship en internship+internshipFamily
    * Mettre company_id, description, salary, begin_date, end_date in the internshipFamily
    * Remarque : une famille ne regroupe que les stages ayant lieu en même temps (un stage reconduit appartient à une nouvelle famille)
* Matrice de souhaits : regrouper les stages de la même famille (afficher les familles ayant au moins un stage actuel)
* Modification de stage :
    * Possibilité de modifier la famille
* Création de stage :
    * Créer nouvelle famille par défaut
    * Possibilité de sélectionner une famille existante

# Tests

Affichage de la page de souhaits.
Les entreprises ayant plusieurs stages sont affichées plusieurs fois.
Les stages ayant un stage précédent sont clicables et redirigent vers la description du stage précédent.
Cela permet, de manière certes très peu pratique, d'identifier les stages identiques.

(Terminés, le ...)

# Commit / Merge

[commit](https://github.com/CPNV-ES/larasta/commit/8f5d7a13ee967a26e7684e9dece0808d95084ff3) sur git, 
branche Damien-Jakob

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)