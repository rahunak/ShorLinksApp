# ShorLinksApp

Laravel Framework 12.1.1  

1.clone laravel from official repo, placed into application folder
Copyed .env.sample to .env
Adapted .env configs for my own needs.

1.docker-compose up --build

2. Go into php container:
docker-compose exec php sh
cd /var/www/html
composer install

3.php artisan key:generate


Additional steps for fresh installation:  
Go into DB container:  
docker-compose exec mysql sh  

Go into MySql:  
mysql -uroot -proot  
create database laravel;  
php artisan migrate  

Permissions in UNIX:  
sudo setfacl -R -m u:evgenyzaiko:rwx .  


## Useful algorithms for fresh devs

Create controllers:
php artisan make:controller DashboardController

Create models:
1. php artisan make:model ShortLink -m  
2. modify model  
3. php artisan migrate  

Rollback migration:
php artisan migrate:rollback