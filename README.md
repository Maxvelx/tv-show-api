<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

You need open terminal inside project dir

- Fisrt step - copy file .env.example to .env

```Terminal
cp .env.example .env
```

- Second step - run composer

```Terminal
composer install
```

- Third step - up doker container

```Docker
docker compose up -d
```

- Last steps - php artisan commands

```Terminal
docker exec test-app php /var/www/artisan key:generate
```
```Terminal
echo "yes" | docker exec -i test-app php /var/www/artisan jwt:secret
```
```Terminal
docker exec test-app php /var/www/artisan migrate
```


Api Documentation: https://docs.google.com/document/d/1tkl_djSjswjbC1cW64tDgf_FQm-K2o69TCq1W5SA0V0/edit?usp=sharing



