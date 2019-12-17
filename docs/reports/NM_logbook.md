Prise en charge le 26.11.2019, par Nicolas Maitre

# Analyse du problème

## Fonctionnement actuel
- Affichage de la liste des jours dans le journal
    - Le compte d'heure total du jour est affiché
    - Une couleur est appliquée en fonction du nombre d'heures et du nombre de mots (si insuffisant).
        => le nombre d'heures est ignoré si l'activité est de type "absence".
- Affichage de la liste des activités dans un jour
    - Affichage de la durée par activité
    - Affichage d'une catégorie prédéfinie
- Ajout et modification d'activités dans un jour
    - Ajout d'un texte décrivant l'activité
    - Spécification d'une durée possible
    - Selection d'une des catégories prédéfinies.
- Ajout automatique des jours ouvré entre le début et la fin du stage
- Suppression des activités possible.

(Terminé, le 03.12.2019)

## Description des problèmes
- Affichage extremement lent
    - Dû à la construction d'un formulaire distinct par activité.
    - L'affichage de tous les jours du stage
    - La gestion des évenements javascript
    - Le rechargement systématique de la page lors de la modification ou l'ajout d'une activité
- Affichage peu ergonomique
    - L'entrée des heures se fait uniquement en heures en non heures et minutes, 
      rendant difficile de rentrer des activités inférieures à 1 heure en durée.
    - Les activités sont limitées aux catégories prédéfinies.
    - Les catégories sont hardcodées et donc non modifiables facilement par un administrateur.
    - La référence au journal sur la page est passée en POST, rendant difficile l'accès à un journal par un lien.
- Sécurité
    - Accès non sécurisé en modification aux journaux de bords des autres étudiants (aucune gestion des droits)
    - Pas de sécurisation des champs. Il est par exemple possible d'insérer une date en dehors du stage ou encore d'insérer une durée négative.
    - Pas de protection contre l'injection HTML. Celà ouvre une grosse faille au niveau du XSS, le journal étant hébergé sur l'intranet. Il est donc actuellement possible d'écrire un script récupérant les identifiants d'un professeur et de les enregistrer sur un autre serveur par exemple.

(Terminé, le 03.12.2019)

## Description de la solution
Les idées:
- Délégation d'une partie de construction de l'interface à du JavaScript
    - Permet de ne pas charger l'intégralité de la liste d'un coup
    - Permet de ne pas recharger la page à chaque action
    - Empêcher l'injection HTML très facilement.
- Sécurisation des droits
    - Affichage possible par tous, mais modification controlée -> Gestion des droits
    - Vérification des données
- Ergonomie
    - Ajout d'une page d'administration du journal de stages (permettant par exemple de modifier les catégories par défaut)
    - Accès au journal par une route + id, rendant possible la copie du lien.
    - Amélioration de l'interface d'ajout d'activité
        - Possibilité d'ajouter une activité avec une catégorie libre
        - Possibilité d'intégrer des liens dans le texte
        - Ajout de la durée simplifié

Étapes principales:
- Wireframe interface graphique
- Création des routes + gestion des droits d'accès aux journaux
- API logbook -> GET
- Construction de l'interface / début de la structure JS.
- Appel API et affichage des données (V1)
- Interface d'ajout/modification des données
- API logbook -> POST/PUT + gestion des droits  
Étapes Supplémentaires
- Page d'administration des stages
(Terminé, le 03.12.2019)

# Plan d'intervention  
**26.11.2019**  
- Added web route + Controller + view  

**10.12.2019**  
- Added get api routes + call for `/api/internships/-internshipId-/logbooks` and `/api/internships/logbook/activity/-activityId-`  
- Added post api route for `/internships/-internshipId-/logbook/activities`  
- Added put api route for `/api/internships/logbook/activity/-activityId-`  

**17.12.2019**  
- Added put data getter + call for `/api/internships/logbook/activity/-activityId-`
- Added post api call for `/internships/-internshipId-/logbook/activities`  
- Added delete api route + call for `/api/internships/logbook/activity/-activityId-`
- Started addition of the callApi method in utils.js

# Exécution

## Tests

(Terminés, le ...)

# Commit / Merge

(Fait, le ...)

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)

