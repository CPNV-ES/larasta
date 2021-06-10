# Bilan du projet en juin 2021

## Fonctionalités ajoutées

### Filtrage de la liste des stages

- Les stages peuvent être triés en fonction de leur état

### Création de la grille d'évaluation

- Permet de créer de nouvelles sections et critères, et de remplir des informations dans ces critères.
- Par défaut, la grille d'évaluation actuelle est chargée comme 'template'
- Lorsque la nouvelle grille est sauvée, elle sera automatiquement utilisée lors des futures évaluations d'une visite de
  stage

### Remplissage de la grille d'évaluation

Permet de remplir une évaluation de visite de stage

- Les évaluations sont modifiables tant que la visite n'est pas close
- Pour un élève, permet de s'auto-évaluer
- Pour un responsable de stage, permet d'évaluer le stagiaire

*A terme, la note d'une visite devrait être calculée automatiquement à partir des points d'une évaluation lorsque l'on
clôture la visite. Elle doit pour le moment être écrite manuellement.*

### Gestion des visites

- L'interface de la vue manage a été mise à jour afin de rendre son contenu plus lisible
- Les visites sont groupées par état sur la page de liste des visites
- La date d'une visite peut être définie dans le passé
- La note d'une visite ne peut être que donnée si l'état est *Effectuée*
- Une visite doit avoir une note et une évaluation remplie avant de pouvoir être passée en *Bouclée*

### Liste des volées

- Affiche une simple liste des différentes classes par volées et des élèves qui en font partie
- Les volées sont affichées par ordre de date croissante
- Les élèves sont affichés sous une menu accordéon pour chaque classe

### Ajout d'une page pour modifier les paramètres de l'application

- Permet aux administrateurs de paramétrer l'application en live depuis l'application
- Chaque paramètre est affiché avec un champ d'entrée approprié à son type (texte, booléen ou nombre)

### CRUD du rapport de stage

- Le stagiaire peut créer son rapport de stage
- Les sections par défaut sont automatiquement créées
- Les sections peuvent être créées, modifiées et supprimées
- L'état du rapport de stage peut être modifié

### Ajout d'un dashboard personnel

La page home a été remplacée afin de rendre disponible les données concernant l'utilisateur, Pour un enseignant :

- Un tableau des visites non bouclées
- Un tableau des stages en cours
- Un tableau caché des stages terminés s'affiche si l'on clique sur le bouton "Voir les stages passés"

Pour un élève :

- Chaqu'un des ces stages sont affiché sous forme de bloc contenant les details du stage et un tableau des visites non
  bouclée lui concernant.

*Les tableaux permettent d'accéder au pages de détails d'un stage ou la page manage d'une visite.*

### Harmonisation de l'interface utilisateur

- Unification du formulaire d'ajout d'une remarque dans un template blade
- Les tableaux ont tous le même style
- Update des alerts et messages de retour à l'utilisateur afin qu'ils soient plus lisibles et qu'ils restent affichés si
  on ne les fermes pas

### Améliorations du journal de stage

Le "review mode" du journal permet maintenant :

- au maître de classe :
    - de faire des retours sur chaque description d'activité
    - de quittancer chaque jour via une checkbox
- à l'élève :
    - de voir les retours du maître de classe
    - de voir les quittancements "Lu" ou "Non lu" sur les jours du journal

### Résolution de divers petits problèmes

- Problèmes traitant de l'UX, cleanup de features plus utilisées, rapportés par issue GitHub
- Ajout d'un middleware dans les routes pour accéder aux pages d'administrateur
- Ajout de nouveaux états pour les visites

## Bilan de la marche du projet

Le projet s'est globalement bien déroulé, la communication en équipe était claire et tous les membres étaient informés
de l'avancement des tâches du projet.

Les tâches étaient distribuées en fonction de la charge de travail de chacun, l'équipe n'a pas souhaité prendre en
compte les affinités car l'objectif principal était de se former plus que d'être productif.

Ainsi, une personne qui a des difficultés dans un certain domaine peut combler ses lacunes.

## Améliorations possibles

- Améliorations du système de droits/rôles
    - Laravel possède un système de *policies* qui serait adapté à ce problème
- Remplacer les routes par des Resources pour les controlleurs qui le permettraient afin de rendre l'application restful
- La note d'une visite devrait être calculée à partir de l'évaluation lorsque l'on clôture la visite
- Consulter l'évaluation d'une visite une fois la visite bouclée
- Continuer le refresh UI
- Cacher les liens du menu dont l'utilisateur n'a pas accès (adapter le menu à l'utilisateur)
    - Exemple: je suis connecté en tant qu'élève mais je ne peux pas accéder au lien *Visites*, le lien devrait alors ne
      pas être affiché

## Problèmes connus

- Le rôle d'utilisateur avec l'Id 2 est parfois interprété dans le code comme "Admin" et parfois comme "Membre d'une
  entreprise"
- Seulement les utilisateurs d'une entreprise ont accès à la page pour évaluer une visite, cependant les responsables
  des stages n'intéragissent pas avec l'application (Les users de type "Entreprise" sont des users "statiques" qui ne
  sont jamais utilisés pour se connecter)
- L'upload de fichiers de stages ne semble pas fonctionner sur certaines installations. Le code est fonctionnel, mais il
  y a sûrement un détail de configuration (niveau PHP ou applicatif) qui semble poser problème