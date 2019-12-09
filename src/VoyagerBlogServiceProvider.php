<?php

namespace Clevyr\VoyagerBlog;

use Clevyr\VoyagerBlog\Console\Commands\VoyagerBlogInstall;
use Illuminate\Support\ServiceProvider;

/**
 * Class VoyagerBlogServiceProvider
 *
 * @package Clevyr\VoyagerBlog
 */
class VoyagerBlogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/voyager-blog.php', 'voyager');
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                VoyagerBlogInstall::class,
            ]);
        }

        $this->publishes([
            // Config
            __DIR__ . '/config/voyager-blog.php' => config_path('voyager-blog.php'),

            // Views
            __DIR__ . '/resources/views' => resource_path('views'),

            // Models
            __DIR__ . '/models' => app_path('.'),

            // Controllers
            __DIR__ . '/app/Http/Controllers' => app_path('Http/Controllers'),

            // Fields
            __DIR__ . '/app/Fields' => app_path('Fields'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
