Prise en charge le 4.10.2019, par Diogo Vieira

# Analyse du problème

## Fonctionnement actuel

Actuellement, le code pour générer un contrat ne fait aucune requête éloquent et utilise une méthode annexe pour récupérer les données du contrat.
Il y a des erreurs sur les données mises dans le contract.

## Description du problème

Pas de requêtes éloquent et une méthode qui contient seulement les requêtes pour le contrat .
A la génération du contrat, la vue n'affiche pas la date de génération.

## Description de la solution

(Terminé, le 14.10.19)

Création des différents liens éloquent sur les models `Person`, `Contract`, `Internship`.

Supression de la méthode annexe `getContract()` servant seulement à faire des requêtes du type `Query Builder`.

Mise à jour de la méthode `visualizeContract()`:
   - les requêtes de `getContract()` se cituent maintenant dans la même méthode et le tout en `Eloquent`.
   - correction des différents champs à remplacer dans notre contrat.
   
Correction de `generateContract()`, `cancelContract()`, `saveContract()` afin qu'ils soient en `Eloquent`.

Correction de la vue `contractVisualize.blade`, car j'ai modifié le lien et la variable contract est maintenant un objet unique. 

Modifications sur la vue `contractGenerate.blade`, la variable retournée n'est plus la même et le lien a été modifié.


# Plan d'intervention

(Terminé, le 4.10.19)

Faire que tout le controleur `contractController` soit entièrement en éloquent.

# Tests

(Terminés, le 14.10.19)
 
Afficher la valeur de chaque requête éloquent, afin de confirmer le bon fonctionnement de la requête.

Vérification étape par étape que le contrat est bien généré au masculin si le/la stagiaire est un homme, inversemment si c'est une femme.

Sur la page `contractVisualize.blade`, les données sont bien visible.

Cliquer sur le bouton générer pdf, génére bien le bon contrat au format pdf.


# Commit / Merge

Dernier commit le 31.10.19 (numero du commit: 33f97db378bf4a71aca9b0ca066fb45d5ad6ba89)

# Revue de code

(Effectuée, le ...)

# Documentation

Le 10.10.2019, création d'un document explicant l'utilisation Eloquent dans `docs`.

