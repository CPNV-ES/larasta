# Creation

Pour commencer avec éloquent, il nous faut premièrement identifier les tables afin de créer des models de celles-ci, puis faire la liaison entre le code et la base de données et enfin faire les requêtes.

# Tables

Nous avons les tables suivantes:

    Contracts, Un contrat appartient à une ou plusieurs entreprises
    Companies, Une entreprise possède 1 seul contrat et appartient à un ou plusieurs stages
    Internships, Un stage se passe dans une seule entreprise
    
## schéma
```
     _____________________________             _____________________________             _____________________________
    |                             |           |                             |           |                             |
    |          Contracts          |-||------|<|          Companies          |-||------|<|         Internships         |
    |_____________________________|           |_____________________________|           |_____________________________|
```
Pour commencer nos requêtes Eloquente, il va nous falloir créer les différents models liées à nos tables

# Models

Tout d'abord, nous allons commencer par créer le model de la table `Contracts`.
Depuis un terminal, il faut aller sur votre projet et écrire la commande suivante:
    php artisan make:model Contract

Ensuite, on refait la même étape pour Compagnies et Internship.
Je rappel que les models sont au singulier, maintenant que nous avons créé nos différents models,
c'est à dire `Contract`, `Company` et `Internship` à la racine de `larasta/app/`,
nous pouvons commencer nos requêtes

# Realtions entre le code et la DB

Pour faire une requête sur larasta il faut identifier la façon dont nous allons contacter la DB.

Prenons l'exemple pour la table contrat, nous voulons avoir le contrat d'une entreprise, pour
identifier le type de liaison, nous allons dire que le contrat a plusieurs entreprises et que
celui-ci n'appartient qu'à une seule entreprise.

En éloquent, nous allons donc devoir le mettre dans les models créé précédemment afin que
Laravel puisse le savoir.

- Donc pour montrer qu'un contrat appartient à plusieurs entreprises, nous allons sur le model
  `Contract` (larasta/app/Contract.php) et ajoutons la méthode suivante:

    ```php
         /**
         * @description A contract has many companies
         * @return All companies with our contract
         */
        public function companies()  //ici, idéalement utiliser un terme pour votre liaison, pour notre cas on souhaite avoir les entreprises d'où le choix de companies
        {
            return $this->hasMany("App\Company","contracts_id");
        }
    ```

    Ici j'ai le nom `companies` a été défini au pluriel pour nous montrer que nous attendons comme
    retour plusieurs compagnies.

    Explication du `hasMany()`:
     - Il sert à faire la liaison `1-n`, comme illustré plus tôt "un contrat peut avoir plusieurs entreprises".
     - Le premier paramètre est la classe qui pointe sur notre table `companies` donc on met `App\Company`
     - Le deuxième paramètre correspond au nom de la clé étrangère dans la table companies


- Maintenant nous allons faire l'autre liaison. Une entreprise possède un seul et unique contrat.
  Pour ce faire, nous allons sur le model `Company` (larasta/app/Company.php) et ajoutons la méthode suivante:

    ```php
        /**
         * @description A contract belong to company
         * @return the contract of company
         */
        public function contract()
        {
            return $this->belongsTo('App\Contract');
        }
    ```

    Explication du `belongsTo()`:
     - Il sert à faire la liaison `n-1`, comme illustré plus tôt "une entreprise possède un seul et unique contrat".
     - Le premier paramètre est la classe qui pointe sur notre table `contracts` donc on met `App\Contract`
     - Le deuxième paramètre correspond au nom de l'id, à mettre dès que le nom de l'id de la table est différent du mot `id`

- Maintenant ajoutons la lisaison entre la table `companies` et `internships`.
  Une entreprise à un ou plusieurs stages, ce qui signifie que nous allons avoir une liaison `HasMany()` dans le
  model `company`.

    ```php
        /**
         * @description A company has many internships
         * @return All internships of our company
         */
        public function internships()
        {
            return $this->hasMany('App\Internship');
        }
    ```

- Il nous reste une dernière liaison entre la table `internships` et `companies`, celle `n-1`
  "Un stage appartient à une entreprise" ce qui nous donne une requête `belongsTo()`.

    ```php
        /**
         * @description An internships belongs to a company
         * @return data of internship
         */
        public function company()
        {
            return $this->belongsTo('App\Companies', 'companies_id');
        }
    ```

 Maintenant nous avons toutes nos relations entre le code et la base de données!

# Requêtes

Pour faire nos requêtes, après avoir créé nos relations, nous avons plusieurs manières de le faire...

Imaginons les requêtes suivantes:

 - Je souhaites avoir le contrat de stage de l'entreprise avec l'id 5:
   Nous identifier ce que nous souhaitons avoir, pour notre cas c'est un contrat.
   donc nous débutons la requête avec le nom de notre model qui pointe sur la table contrat

    `Contract`

   Ensuite, nous voulons savoir le stage au quel appartient notre contrat, pour ce faire nous allons utiliser
   une méthode statique de Laravel, WhereHas() nous permet de récupérer directement les informations de notre entreprise.
   Pour ce faire, dans les paramètres nous devons mettre le parcours à éffectuer depuis `contracts` pour atteindre
   la table `internships`.
   Pour notre cas il faut passer par la table companies pour atteindre internships. cequi nous donne:

    `Contract::WhereHas('companies.internships',`

   Enfin, il nous faut mettre le deuxième paramètre, pour nous c'est une fonction qui doit récupérer les données
   de l'entreprise.
   Il faut donc faire une fonction qui garde notre requête et qui utilise notre id fournis plus tôt.

    ```php
        //Get contract of specific internships
        $contract = Contract::whereHas('companies.internships',function ($query)use ($id){
            $query->where('internships.id', $id);
        })->first();
    ```

   la méthode first récupère que la première ligne reçue et la transforme en une collection.

 - Je souhaite savoir le nombre d'entreprises utilisant un certain contrat.
   Il nous suffit d'utiliser notre méthode créée précédemment, `hasMany()` qui se se situe dans la méthode `companies`.
   ensuite il nous suffit d'utiliser la méthode where qui va récupérer toutes les entreprises ayant le contrat X.

    ```php
        $value = contract->companies->where("contracts.id",$id)
    ```