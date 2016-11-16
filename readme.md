<p align="center"><a href="https://laravel.com" target="_blank"><img width="150"src="https://laravel.com/laravel.png"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 1
Download app via SSH

```
git@github.com:roynes/car-service-corp-exam.git
```

or Download

## 2.
Download needed node_modules

```
npm install
```

## 3.
Rename the `.env.example` to `.env` and modify its contents especially the `DB` configs.

Type in command

```
php artisan key:generate
php artisan cache:clear
php artisan migrate
php artisan db:seed
```

## 4.

Type in command

```
php artisan serve --host 127.0.0.1 or php artisan serve
```

go to browser and type `127.0.01:8000` or `localhost:8000`


>Make sure Nginx is turned off




