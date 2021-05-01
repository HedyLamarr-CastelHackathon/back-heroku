# back-herroku
## Installation en local


### Environnement du Host Local:

- Installer php7.4 sur le host local/ Voir selon 
- Installer Composer / https://getcomposer.org/doc/00-intro.md
- Installer Symfony CLI sur le host local / https://symfony.com/download
- Installer Docker sur le host local / https://docs.docker.com/get-docker/
- Clone du Dépôt / $ git clone https://github.com/HedyLamarr-CastelHackathon/back-herroku.git

### A la racine du Projet:

- Installer les dépendances avec composer / $ composer install
- Lancer  la creation et le démarrage des conteneurs pour postgreSQL grace au docker-compose.yml / $ docker-compose up -d
- Vérifier que les conteurs sont démarrés / $ docker ps
- Configurer la bdd dans  le .env / DATABASE_URL="postgresql://postgres:changeme@127.0.0.1:5432/HedyLamarr?serverVersion=13&charset=utf8"
- Créer la base de données / $ symfony console doctrine:database:create
- Migrer la base de données / $ symfony console doctrine:migrations:migrate
- Binder les variables d'environnement du conteneur postgreSQL avec le projet  / $ docker-compose exec database psql postgres
- Démarrer le server local avec Symfony cli /$ symfony serve


### Configurer pgAdmin:

- se rendre dans pgadmin http://localhost:5050/browser/
- clique droit sur server puis create>server...
    - name: HedyLamarr
    - Host: postgres
    - Port: 5432
    - Maintenance Database: postgres
    - Username: postgres
    - Password : chamgeme
    - server > HedyLamarr > Databases > schemas > public > tables


### Gestion de l'application en local

-  application: https://127.0.0.1:8000
-  documentation:  https://127.0.0.1:8000/api        
-  base de données: http://localhost:5050/browser/ (password: admin)




