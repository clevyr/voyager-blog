# Voyager Blog

## Install Instructions

- Create a new laravel project

- Install & Setup Laravel Voyager

- Add the following to your composer.json file

```
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:clevyr/voyager-blog.git"
        }
    ],
```

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
