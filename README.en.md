<h1 align="center">Adding an Authentication System: TaskLinker</h1>
<p align="center"><i>Project No. 10 from the PHP Symfony Application Developer course @OpenClassrooms <br> <a href="https://github.com/adrien-force/OC-P10-Adrien-Force/commits?author=adrien-force"><img src="https://img.shields.io/badge/Author_:-Adrien_FORCE-orange"></a></i></p>

Other languages: [French](./README.md)
## 🎯 Table of Contents
- [Project Description](#-description)
- [Project Installation](#-installation)
- [Prerequisites](#-prerequisites)
- [Project Usage](#-usage)
- 
## 📄 Description
<br>

This project focuses on continuing the development of a website for an association called TaskLinker by adding a user authentication system.
The code is based on Project No. 8 from the PHP Symfony Application Developer course @OpenClassrooms, where the initial work was done in PHP without a framework.
The website's purpose is to provide a CRM solution for creating projects, tasks, and user management.
During this project, I added a user authentication system to secure access to the various functionalities of the site.
<br> <br>
## 🔧 Prerequisites
- Symfony ^7.0
- Symfony CLI
- Composer
- PHP ^8.0
- Docker
## 🛠️ Installation
1. Clone the project to your machine
```bash
git clone https://github.com/adrien-force/OC-P10-Adrien-Force.git
```
2. Update your dependencies with Composer
```bash
composer install
```
3. Start the container for the database
```bash
docker-compose up -d
```
4. Create the database and update the schema
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
5. Modify your .env file
Run the command:
```bash
docker ps
```
Retrieve the ports of your MySQL container and add them to your .env file under `DATABASE_URL`
6. Start the server
```bash
symfony serve -d
```
7. Create the fixtures
```bash
php bin/console doctrine:fixtures:load
```
## 🔥️ Usage

The project is a website developed in PHP, HTML, and CSS.
To start using it, visit the local URL of your Symfony server, typically <a href="127.0.0.1:8000/">127.0.0.1:8000/</a>.
You can sign up or log in with an already existing user account.
Among the different accounts created with the fixtures, there is an administrator account:
- email: admin@tasklinker.com
- password: password)
All users created with the fixtures have the password "password".

Administrators can add projects, tasks, and users.
Users can view the projects and tasks assigned to them.
<br> <br>
