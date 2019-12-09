<?php

namespace Clevyr\VoyagerBlog\Console\Commands;

use Clevyr\VoyagerBlog\Database\Seeds\VoyagerBlogSeeder;
use Illuminate\Console\Command;

class VoyagerBlogInstall extends Command
{
    protected $name = 'voyagerblog:install';

    protected $description = 'Runs required seeders';

    public function fire()
    {
        return $this->handle();
    }

    public function handle()
    {
        $this->info('Running Migrations');

        $this->call('migrate');

        $this->info('Seeding data');

        $this->call('db:seed', ['--class' => VoyagerBlogSeeder::class]);
    }
}
