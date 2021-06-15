# Documentation technique

### Utilité et fonctionnement de Larasta
Larasta est une application web qui a pour but de gérer les stages des classes de 4ème année d'informatique CFC.

L'application est utilisée par les maîtres de classe pour assigner les places de stage, puis, lorsque le stage est en cours assurer son bon déroulement.
L'application est aussi utilisée par les élèves lors de leur stage, afin d'y rapporter leur travail.
A la fin du stage, le stagiaire et le responsable du stage évaluent le stage et la note est reportée dans l'application.

### Environnement de fonctionnement
L'application tourne sur un serveur Web, ce serveur peut tant être local que publique.
Pour tourner l'application en local il faut suivre [les instructions de mise en place de l'environnement de développement](https://github.com/CPNV-ES/larasta#set-up-development)


### Accéder à l'application
La version de production de Larasta est disponible à l'adresse *https://larasta.mycpnv.ch/*

Le repository Github *https://github.com/CPNV-ES/larasta*


### Données manipulées
L'application manipule des données internes au CPNV telles que le salaire du stagiaire, les contrats des stages, les rapport, etc...

Toute extraction de ces données est à faire avec attention car certaines d'entre-elles sont confidentielles.


### Technologies utilisées
Larasta est une application codée en **PHP**.
Larasta utilise [Laravel](http://laravel.com). Laravel est un framework PHP qui permet de créer des applications web en se basant sur [le design pattern MVC](http://fr.wikipedia.org/wiki/Modèle-vue-contrôleur).

Côté front-end, le framework [Bootstrap v4](https://getbootstrap.com/docs/4.6/getting-started/introduction/) est utilisé afin de simplifier le développement de l'UX.
Le projet utilise aussi [scss](https://sass-lang.com/), une extension de css qui permet d'écrire moins de code grâce à des fonctionnalités avancées comme les variables, le nesting ou de l'héritage

#### Composants et librairies
L'application utilise quelques packages:
* Composer
    * [socialiteproviders/microsoft-azure](http://github.com/socialiteproviders/microsoft-azure): Permet l'authentification oauth avec Azure. Utilise [laravel/socialite](http://github.com/laravel/socialite)
    * [spatie/laravel-medialibrary](http://github.com/spatie/laravel-medialibrary): Permet d'upload des fichiers et de les associer à des modèles afin de pouvoir les récupérer facilement
* NPM / Javascript
    * [Axios](http://github.com/axios/axios): Permet d'effectuer des requêtes HTTP de manière plus poussée que la librairie *fetch* disponible de base avec JS
    * [JQuery](http://github.com/jquery/jquery): Librairie JS qui facilite les actions liées au DOM
    * [SimpleMDE](https://simplemde.com/): Librairie JS qui permet d'éditer du markdown

### Mise en place de l'application

La marche à suivre pour mettre en place l'application se trouve sur Github sous la forme d'un [Readme](https://github.com/CPNV-ES/larasta#readme).

### Bonnes pratiques
L'idéal est d'utiliser les conventions de nommage du language PHP : *https://www.mediawiki.org/wiki/Manual:Coding_conventions/PHP*

Les versions du code sont gérées via Github avec le workflow GitFlow.

## Design technique

### Grilles d'évaluations - structure
Il y a 4 tables liées aux évaluations:

#### **evaluations**
Table "principale" qui contient un enregistrement pour chaque évaluation remplie. Contient aussi les évaluations "templates", c'est à dire des évaluations "vides" qui serviront de modèles lorsque l'on va remplir une évaluation de visite

| Colonne | Utilité |
| -------- | -------- |
| editable | *Pas utilisé* |
| visit_id | La visite qui est évaluée. NULL si évaluation template |
| template_name | Si défini, cette évaluation est une grille d'évaluation template. Cette colonne contient le nom unique avec lequel sera identifié ce template |

#### **evaluationsections**
Une section correspond à un groupe de critères. Chaque critère dans une section aura la même structure dans la grille, définis par le type de section.

| Colonne | Utilité |
| -------- | -------- |
| hasGrade | 1 si les critères de cette section doivent pouvoir être évalués par une note |
| sectionName | Le nom de section affiché |
| sectionType | Le type de section. Les spécificités de chaque type de section sont gérées dans le code. Tous les types de sections utilisent les 4 tables définies dans cette section |


#### **criteria**
Contient les définitions des critères d'une grille d'évaluation. Chaque critère est lié à une section (evaluationsection).
Un enregistrement dans cette table ne contient que les données "fixes" d'un critère, c'est à dire les données qui qui sont communes à toutes les évaluations remplies prenant la grille d'évaluation qui contient ce critère comme modèle

| Colonne | Utilité |
| -------- | -------- |
| criteriaName     | Le nom du critère qui sera affiché dans la grille     |
| criteriaDetails | Des détails supplémentaires qui peuvent être affichés pour certains types de critères|
| maxPoints | Pour les critères d'une section notée, contient les points max qui peuvent être entrés lors d'une évaluation |
| evaluationSection_id | La section à laquelle est liée ce critère |

#### **criteriavalues**
Contient les valeurs remplies pour chaque critère d'une évaluation

| Colonne | Utilité |
| -------- | -------- |
| evaluation_id | L'évaluation dont cette valeur de critère fait partie |
| criteria_id | Le critère qui est "rempli" par cette valeur de critère |
| points | Si le critère lié est noté, contient les points entrés lors de l'évaluation |
| studentComments | La grille dispose d'un champs qui permet au stagiaire de commenter chaque critère |
| managertComments | La grille dispose d'un champs qui permet au responsable du stage en entreprise de commenter chaque critère |
| contextSpecifics | Certains critères peuvent avoir un champs textuel supplémentaire. Sa valeur est stockée dans cette colonne|


### Rapports de stage (base de données)
Il y a 3 tables utilisées pour générer un rapport de stage.

#### **internshipreports**
| Colonne | Utilité |
| -------- | -------- |
| status_id | Contient l'id de l'état du rapport |

#### **reportsections**
| Colonne | Utilité |
| -------- | -------- |
| report_id | Contient l'id du rapport |
| name | Contient le titre de la section |
| text | Contient le contenu texte de la section (peut contenir du markdown) |

#### **reportstatus**
| Colonne | Utilité |
| -------- | -------- |
| status | Contient les différents états que peut avoir un rapport (Brouillon, Livré, Evalué) |