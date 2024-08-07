# Project Name: Phone Numbers APP

[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable)](https://packagist.org/packages/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license)](https://packagist.org/packages/laravel/framework)

## Note

Check out the SPA version of this application using Vue.js [here](https://github.com/HannaKamil/phone-numbers-app-vue).

## Screenshot

![Phone Numbers App Screenshot](public/images/phone-numbers.png)

## Requirements

- PHP >= 8.2
- Composer
- Laravel

## Installation

### Clone the repository and set up the application

```sh
git clone https://github.com/HannaKamil/phone-numbers-app-jquery.git
```

```sh
cd phone-numbers-app-jquery
```

```sh
composer install
```

```sh
cp .env.example .env
```

```sh
php artisan key:generate
```

```sh
php artisan migrate --seed
```

```sh
php artisan serve
```

Visit `http://localhost:8000` to see your application in action.
