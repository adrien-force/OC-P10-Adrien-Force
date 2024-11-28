<h1 align="center">Ajout d'un systeme d'authentification : TaskLinker</h1>
<p align="center"><i>Projet N°10 de la formation Développeur d'application PHP Symfony
@OpenClassrooms <br> <a href="https://github.com/adrien-force/OC-P10-Adrien-Force/commits?author=adrien-force"><img src="https://img.shields.io/badge/Auteur_:-Adrien_FORCE-orange"></a></i></p>

Autres langues : [English](./README.en.md)

## 🎯 Table des matières
- [Description du projet](#-description)
- [Installation du projet](#-installation)
- [Prérequis](#-prérequis)
- [Utilisation du projet](#-utilisation)


## 📄 Description
<br>

Ce projet consiste à continuer le developpement d'un site web pour une association nommée TaskLinker, pour y ajouter un système d'authentification par utilisateur.
Le code se base sur le projet N°8 de la formation Développeur d'application PHP Symfony @OpenClassrooms, où la base du travail a été réalisée en PHP sans framework.
Ce site web a pour but d'apporter une solution CRM permettant la creation de projets, de tâches et une gestion des utilisateurs.

Durant ce projet, j'ai ajouté un système d'authentification par utilisateur, permettant de sécuriser l'accès aux différentes fonctionnalités du site.
<br> <br>


## 🔧 Prérequis

- Symfony ^7.0
- Symfony CLI
- Composer
- PHP ^8.0
- Docker

## 🛠️ Installation

1. Cloner le projet sur votre machine
```bash
git clone https://github.com/adrien-force/OC-P10-Adrien-Force.git
```

2. Mettez à jour vos dépendances avec Composer
```bash
composer install
```

3. Lancer le container pour la base de données
```bash
docker-compose up -d
```

4. Créer la base de données et mettre à jour le schéma
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Modifier votre .env
Lancer la commande :
```bash
docker ps
```
Récuperer les ports de votre container MySQL et les ajouter dans votre fichier .env `DATABASE_URL`

6. Lancer le serveur
```bash
symfony serve -d
```

7. Creer les fixtures
```bash
php bin/console doctrine:fixtures:load
```

## 🔥️ Utilisation

Le projet est un site web développé en PHP, HTML, CSS.

Pour commencer à utiliser rendez-vous sur l'url local de votre serveur symfony, généralement <a href=127.0.0.1:8000/>127.0.0.1:8000/</a>.

Il est possible de s'inscrire, ou de se connecter avec un compte utilisateur déjà existant.
Dans les différents comptes créés avec les fixtures, il y a un compte administrateur :
- email : admin@tasklinker.com
- mot de passe : password

Tous les utilisateurs créés avec les fixtures ont le mot de passe "password".

Les administrateurs peuvent ajouter des projets, des tâches et des utilisateurs.
Les utilisateurs peuvent consulter les projets et les tâches qui leur sont assignées.
<br> <br>
