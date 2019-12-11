
# Quête: Page Mailing

Prise en charge le 10.12.19, par Diogo Vieira

## Analyse

### Fonctionnement actuel

Si nous souhaitons savoir quelle entreprise souhaite continuer à avoir des
stagiaires pour les prochains stages, nous sommes obligés de faire le même
mail autant de fois que nécessaire sans utiliser le site.

### Description du problème ou de la demande

Actuellement le site larasta ne propose pas de moyen de contacter les entreprises afin de
savoir si elles souhaitent continuer de prendre des stagiaires.

De ce fait, nous souhaitons pouvoir les contacter en une seule fois.

### Description de la solution

```
/**
* Décrire les changements proposés pour pallier aux manques.
* Exemple:
*  - Ajouter la date du dernier contrôle
*  - Ajouter la date dans les listings de véhicules
*  - Permettre de filtrer la liste de véhicule sur la date
*  - Générer une alerte pour chaque véhicule quand la date est plus de deux ans dans le passé
*/
```
- Créer une nouvelle page
- Afficher une liste d'entreprises
 - Avec les responsables
 - Triées par date de dernier stages au sein de celle-ci
- Pouvoir choisir le responsable à qui nous souhaitons envoyer le mail
- Pourvoir enlever les entreprises dont nous ne souhaitons pas contacter
- Quand nous avons choisis les entreprises et les responsables:
    - Afficher une page pour envoyer un mail
    - Envoyer le mail

(Terminé, le 11.12.19)

## Réalisation
### Plan d'intervention

- Créer une maquette et la valider

- Créer une route
- Créer un nouveau layout
- Afficher toutes les entreprises disponibles sur larasta
- Mettre des champs clicables représentant les responsables à côté de chaque entreprise
- Mettre des icones de suppresion pour supprimer les entreprises et les responsables
- Faire une page pour rédiger un mail
- Envoyer le mail à chaque responsable
- Faire une policy pour n'autoriser que les profs à accéder cette page

(Terminé, le 11.12.2019)

### Exécution

```
/**
* Description de ce qui s'est vraiment passé. On repart du plan d'intervention.
* Exemple
*  - Ajout du champ 'lastTechnicalCheck' dans la table vehicles -> 15min
*  - Regénération du modèle -> 10min
*  - Ajout d'une méthode 'isDueForCheck' au modèle -> 30min
*  - Modification de la vue qui liste les véhicules -> 10 min
*  - La période de validité du contrôle technique dépend de l'année de
*    mise en service du véhicule ! -> il faut aussi gérer l'année -> +2 heures
*/
```

### Tests

Cette section sera remplie dès que le wireframe sera validé

```
/**
* Description des tests effectués
* ATTENTION !!! Il est vivement recommandé d'écrire cette section AVANT le plan
* d'intervention, car les tests permettent au développeur de bien saisir les
* détails de ce qui est attendu par le client
* Exemple
*   - J'introduis une date de dernier contrôle qui est dans le futur -> rejeté
*/
```

(Terminés, le ...)

### Commit

```
/**
* URL menant à la page du commit qui contient le code réalisé
*/
```

(Fait, le ...)

