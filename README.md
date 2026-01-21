## 📂 Installation du projet

1️⃣ Cloner le projet depuis GitHub

git clone https://github.com/Walidanadif/security-app.git
cd security-app

2️⃣ Installer les dépendances Laravel

composer install

3️⃣ Configuration de l’environnement

cp .env.example .env
php artisan key:generate

4️⃣ Créer la base de données MySQL 

mysql -u root -p

CREATE DATABASE security_app;

---- Configurer .env :

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=security_app
DB_USERNAME=laravel
DB_PASSWORD=Laravel@123

5️⃣ Migrations

php artisan migrate

6️⃣ Lancer l’application

php artisan serve

🧪 Commandes Laravel utiles
php artisan serve             # Lancer le serveur
php artisan migrate          # Créer les tables
php artisan migrate:fresh    # Réinitialiser la base
php artisan tinker           # Tester les modèles
php artisan optimize:clear   # Nettoyer le cache

7
pour tester les absences: php artisan schedule:work     
