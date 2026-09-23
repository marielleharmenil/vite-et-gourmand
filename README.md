# Vite & Gourmand



Projet réalisé dans le cadre de l'ECF du Graduate Développeur Web et Web Mobile de STUDI.



Vite & Gourmand est une application web destinée à une entreprise de traiteur bordelaise. Elle permet aux visiteurs de consulter les menus proposés et aux clients de créer un compte et de passer une commande.



## Technologies utilisées



- PHP 8.2

- Symfony 6.4 LTS

- MySQL 8

- Doctrine ORM

- Twig

- HTML5 / CSS / JavaScript

- Git et GitHub

- Railway pour le déploiement en ligne



## Fonctionnalités principales



L'application permet notamment :



- de consulter les menus et leurs détails ;

- de filtrer les menus selon plusieurs critères ;

- de créer un compte et de se connecter ;

- de passer une commande ;

- de consulter l'historique de ses commandes ;

- de modifier ses informations personnelles ;

- d'annuler une commande lorsqu'elle est encore en attente ;

- pour un employé, de consulter et filtrer les commandes et de modifier leur statut ;

- pour un administrateur, d'accéder également aux fonctionnalités employé ;

- de consulter les pages Contact, Mentions légales et Conditions générales de vente.



Certaines fonctionnalités prévues dans le cahier des charges restent partielles ou non implémentées, notamment les statistiques avec une base NoSQL, la gestion des avis, certaines fonctions d'administration et l'envoi réel des emails par SMTP.



## Installation du projet en local



### 1. Cloner le dépôt



```bash

git clone https://github.com/marielleharmenil/vite-et-gourmand.git

cd vite-et-gourmand

```



### 2. Installer les dépendances PHP



```bash

composer install

```



### 3. Configurer la base de données



Créer un fichier `.env.local` et y renseigner la connexion à votre base MySQL avec la variable `DATABASE_URL`.



Exemple :



```env

DATABASE_URL="mysql://UTILISATEUR:MOT_DE_PASSE@127.0.0.1:3306/vite_gourmand"

```



Le fichier `.env.local` contient des informations propres à l'environnement local et ne doit pas être envoyé sur GitHub.



### 4. Créer la base de données



```bash

php bin/console doctrine:database:create

```



### 5. Exécuter les migrations



```bash

php bin/console doctrine:migrations:migrate

```



Des fichiers SQL de création de la structure et d'intégration des données sont également disponibles dans le dossier `database/`.



### 6. Charger les données de démonstration



```bash

php bin/console doctrine:fixtures:load

```



Attention : cette commande remplace les données présentes dans la base locale.



### 7. Installer les assets nécessaires



```bash

php bin/console importmap:install

```



### 8. Lancer le serveur Symfony



```bash

symfony server:start

```



L'application est ensuite accessible en local à l'adresse :



`http://127.0.0.1:8000/`



Le terminal dans lequel le serveur Symfony est lancé doit rester ouvert pendant l'utilisation de l'application.



## Structure principale



- `src/Controller/` : contrôleurs de l'application

- `src/Entity/` : entités utilisées avec Doctrine

- `templates/` : pages Twig

- `public/` : fichiers accessibles publiquement, notamment CSS et images

- `migrations/` : migrations de la base de données

- `database/` : fichiers SQL demandés pour la livraison

- `config/` : configuration de Symfony



## Gestion du code avec Git



Le projet utilise plusieurs types de branches :



- `main` : version destinée à la production ;

- `develop` : branche de développement ;

- `feature/*` : branches utilisées pour développer les différentes fonctionnalités.



Les fonctionnalités ont été développées puis intégrées progressivement dans `develop`, avant la préparation de la version finale sur `main`.



## Déploiement



L'application est déployée sur Railway.



Application en ligne :



https://vite-et-gourmand-production-c909.up.railway.app/



Le déploiement utilise notamment :



- le dépôt GitHub comme source du code ;

- une base MySQL sur Railway ;

- `DATABASE_URL` pour la connexion à la base ;

- `APP_SECRET` configuré comme variable d'environnement ;

- les migrations Doctrine pour créer et mettre à jour la structure de la base.



## Dépôt GitHub



https://github.com/marielleharmenil/vite-et-gourmand



## Remarque



Le projet a été développé dans le cadre d'une évaluation et certaines fonctionnalités du cahier des charges n'ont pas pu être finalisées. Les fonctionnalités indiquées comme disponibles ont été testées au cours du développement.


