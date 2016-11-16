#INSTALLATION GUIDE

## 1
Download app via SSH

```
git clone git@github.com:roynes/car-service-corp-exam.git
```

or Download

## 2.
Download needed vendor and node_modules(optional)

```
composer install
```

This command is optional since the public css and js are all minified(though if an error occurs during runtime run this command)
```
npm install
```

## 3.
Rename the `.env.example` to `.env` and modify its contents especially the `DB` configs.

Type in command

```
php artisan key:generate
php artisan config:clear
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




