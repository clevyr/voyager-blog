<?php

namespace Clevyr\VoyagerBlog;

use App\BlogTag;
use App\Observers\BlogTagObserver;
use Clevyr\VoyagerBlog\Console\Commands\VoyagerBlogInstall;
use Clevyr\VoyagerBlog\Fields\GutenburgField;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Voyager;

/**
 * Class VoyagerBlogServiceProvider
 *
 * @package Clevyr\VoyagerBlog
 */
class VoyagerBlogServiceProvider extends ServiceProvider
{
    /**
     * Register
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/voyager-blog.php', 'voyager');

        if (class_exists(Voyager::class)) {
            Voyager::addFormField(GutenburgField::class);
        }
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                VoyagerBlogInstall::class,
            ]);
        }

        // Published files
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

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Blog Tag Observer
        if (class_exists(BlogTag::class) && class_exists(BlogTagObserver::class)) {
            BlogTag::observe(BlogTagObserver::class);
        }
    }
}
