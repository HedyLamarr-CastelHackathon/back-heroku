# back-heroku

## INFORMATION STACK

Stack: Symfony4.4 LTS avec api-platform connecté à postgreSQL en CI/CD 
Type: API REST niveau 3 Driving-Hypermedia en JSON-LD
url de l'api :  http://api-hedy-lamarr.herokuapp.com/
url du backoffice: http://api-hedy-lamarr.herokuapp.com/admin

## CREATION DU PROJET

Création du dépôt sur github: HedyLamarr-CastelHackathon/back-heroku
```
$ composer create-project symfony/website-skeleton:"^4.4" back-heroku // Symfony4.4 full
$ composer require api // Api Platform
$ git init
$ git add .
$ git commit -m "initial commit"
$ git remote add origin https://github.com/HedyLamarr-CastelHackathon/back-heroku.git
$ git push -u origin --all
```


## INSTALLATION EN LOCAL


### Environnement du Host Local:

- Installer php7.4 / Selon système
- Installer apache2 / Selon système
- Installer Composer / https://getcomposer.org/doc/00-intro.md
- Installer Symfony CLI / https://symfony.com/download
- Installer Heroku CLI  /  https://devcenter.heroku.com/articles/heroku-cli
- Installer Docker  / https://docs.docker.com/get-docker/
- Clone du Dépôt / $ git clone https://github.com/HedyLamarr-CastelHackathon/back-herroku.git

### A la racine du Projet:

- Installer les dépendances avec composer
- Lancer  la création et/ou le démarrage des conteneurs pour postgreSQL grace au docker-compose.yml du projet
- Vérifier que les conteneurs sont démarrés
- Configurer la bdd dans dans .env, pour la création et la migration de la base de données
- Créer la base de données avec doctrine (S'assurer que le driver extension pdo_pgsql est installé sur php7.4 );
- Migrer la base de données 
- "Binder" les variables d'environnement du conteneur postgreSQL avec le projet  
- Démarrer le server local avec Symfony cli /$ symfony serve

```
$ composer install
$ docker-compose up -d
$ docker ps
```

DATABASE_URL="postgresql://postgres:changeme@127.0.0.1:5432/Hakathon?serverVersion=13&charset=utf8"

```
$ symfony console doctrine:database:create
$ symfony console doctrine:migrations:migrate
$ docker-compose exec database psql postgres
$ symfony serve
```


### Configurer pgAdmin fourni par le conteneur:

- se rendre dans pgadmin http://localhost:5050 ou  http://localhost:5050/browser/
- clique droit sur "server" puis create > server...
    - name: Hakathon
    - Host: postgres
    - Port: 5432
    - Maintenance Database: Hakathon //ou "postgres" si la base de données n'est pas encore créé par symfony (bdd initiale fournie dans le conteneur)
    - Username: postgres
    - Password : chamgeme
    - server > HedyLamarr > Databases > schemas > public > tables

### Gestion de l'application en local

-  application: https://127.0.0.1:8000
-  documentation:  https://127.0.0.1:8000/api        
-  base de données: http://localhost:5050/browser/ (password: admin)


## HEROKU

Liste des commandes Heroku CLI: https://devcenter.heroku.com/articles/heroku-cli-commands

### CAS - 1: Le projet Heroku n'existe pas sur la plateforme Heroku


```
$ heroku update // make sure Heroku CLi is on last version
$ heroku login  // Appelle le navigateur pour faire l'authentification
    - cyrilvssll31@gmail.com
    - H@k@thon2021
$ heroku create hedyLamarr // créer le projet sur le server distant de Heroku
$ echo 'web: heroku-php-apache2 public/' > Procfile // Permet d'amener l'adresse racine du domaine vers le dossier public de symfony
$ heroku addons:create heroku-postgresql:hobby-dev  // ajout de l'addon postgreSQL
$ heroku config:set APP_ENV=prod
```

Dans composer.json prévoir les scripts à executer sur le server d'Heroku à chaque déploiement, comme par exemple:
  - la migration de base de la données, 
  - les jeux de fausses données

    exemple:
    ```
    (...),
    "scripts": {
            (...),
            "compile": [
                "php bin/console doctrine:migrations:migrate"
            ]
        },
    (...)
    ```

    Générer le htaccess du projet Symfony dans le dossier public pour les ré-écriture d'url sur server notamment éviter de d'avoir à écrire index.php dans l'url
    ```
    $ composer require symfony/apache-pack
    ```
### Cas- 2: Le projet Heroku existe déjà sur la plateforme Heroku
    ```
    $ heroku update // make sure Heroku CLi is on last version
    $ heroku login  // Appelle le navigateur pour faire l'authentification
        - cyrilvssll31@gmail.com
        - H@k@thon2021
    $ heroku git:remote -a api-hedy-lamarr // Connecte Heroku CLI au projet distant
    ```

### Deployer les modification de l'api sur le serveur distant Heroku CI/CD

Lorsque vous apportez des modification à l'application

1 - Mettre à jour le dépôt
```
$ git add .
$ git commit -m"ma modification"
$ git push
```

2 - Lancer le déploiement sur Heroku
```
$ git push Heroku master   
```


