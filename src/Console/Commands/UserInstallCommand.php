<?php

namespace Amethyst\Console\Commands;

use Illuminate\Console\Command;

class UserInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amethyst:user:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install amethyst-user package';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('db:seed', ['--class' => 'Amethyst\Database\Seeds\UserSeeder']);
    }
}
