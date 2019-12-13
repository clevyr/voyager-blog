<?php

namespace Clevyr\VoyagerBlog\Console\Commands;

use Clevyr\VoyagerBlog\Database\Seeds\VoyagerBlogSeeder;
use Illuminate\Console\Command;

/**
 * Class VoyagerBlogInstall
 *
 * @package Clevyr\VoyagerBlog\Console\Commands
 */
class VoyagerBlogInstall extends Command
{
    /**
     * @var string $name
     */
    protected $name = 'voyagerblog:install';

    /**
     * @var string $description
     */
    protected $description = 'Runs required seeders';

    /**
     * Fire
     *
     * @return void
     */
    public function fire()
    {
        return $this->handle();
    }

    /**
     * Handle
     */
    public function handle()
    {
        // Run migrations
        $this->info('Running Migrations');
        $this->call('migrate');

        // Run seeder
        $this->info('Seeding data');
        $this->call('db:seed', ['--class' => VoyagerBlogSeeder::class]);
    }
}
