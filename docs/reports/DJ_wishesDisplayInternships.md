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

Controleur WishMatrixController
* ...

Vue wishesMatrix
* Utilisation des stages plutôt ques compagnies
* Ajout d'un lien vers le stage précédent s'il existe

A faire :
* Vue d'un stage : fonctionner avec les stages non attribués
* Vue des stages : afficher tous les stages, y compris ceux qui n'ont pas de stagiaire attribué
* Matrice de souhait : lien vers stage actuel
* Implémenter regroupement de stage 
(nouvelle table : intershipFamily, possibilité de rejoindre une internshipFamily à la création d'un stage 
(ou rejoint automatiquement celle du stage précédent ), puis regrouper stage dans la matrice selon la famille)

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

* La page d'affichage d'un souhait ne fonctionne pas avec des stages dont l'élève est null. 
C'est pour cela que le lien pointe vers le stage précédent plutôt que le stage actuel. 
Une modification de la page de stage serait utile afin de consulter les informations du stage.
* Le regroupement de stages selon le stage précédent est plus compliqué qu'anticipé. 
Ajouter simplement un 'group by' ne marche pas, 
il faudrait aussi ajouter un 'select' ne prenant que 
les caractéristiques du stage que l'on s'attend à retrouver de manière identique.
Et si accidentellement deux stages que l'on souhaite regrouper diffèrent dans ces caractéristiques, la requête échouera.
La meilleure solution serait de séparer les stages en deux tables : 
une page d'instance de stage et une page de description de stage. 
Cependant, le travail nécessaire pour adapter l'application est conséquent et n'en vaut peut-être pas la peine. 
Pour cette raison, le regroupement des stages est pour l'instant abandonné 
en attendant de pouvoir aborder le sujet avec monsieur Carrel.

(Mise à jour, le ...)