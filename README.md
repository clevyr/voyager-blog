# Voyager Blog

This ia a blog package for Laravel Voyager using the Laravel Gutenberg package Laraberg.

Voyager - https://github.com/the-control-group/voyager

Laraberg - https://github.com/VanOns/laraberg

## Install Instructions

- Create a new laravel project

- Install & Setup Laravel Voyager
    - https://voyager-docs.devdojo.com/getting-started/installation

- Add the following to your composer.json file
    - Run `composer require clevyr/voyager-blog`
    - Run `php artisan voyagerblog:install`

- Add the following to your voyager.php configuration file

```
    'additional_css' => [
        'vendor/laraberg/css/laraberg.css'
    ],

    'additional_js' => [
        'https://unpkg.com/react@16.8.6/umd/react.production.min.js',
        'https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js',
        'vendor/laraberg/js/laraberg.js',
    ],
```

- Add the following to your AppServiceProvider.php `Voyager::addFormField(GutenburgField::class)`

- login to Voyager and set your role permissions for the Voyager Blog
