<?php

namespace Railken\LaraOre\Permission\Console\Commands;

use Illuminate\Console\Command;
use Railken\LaraOre\Permission\Permission;
use Railken\LaraOre\Permission\Role;

class FlushPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lara-ore:permission:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all permission';

    /**
     * Create a new command instance.
     *
     * @return void
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

        // Retrieve all managers and create relative permissions

        $managers = config('ore.permission.managers', []);

        foreach ($managers as $manager) {
            $manager = new $manager();
            $this->updatePermissions($manager->getAuthorizer()->getPermissions());
            foreach ($manager->getAttributes() as $attribute) {
                $this->updatePermissions($attribute->getPermissions());
            }
        }

        $admin = (new Role())->newQuery()->firstOrCreate(['name' => 'admin']);
        $admin->fill(['display_name' => 'Administrator', 'description' => '*'])->save();
        $admin->detachPermissions();
        $admin->attachPermissions((new Permission())->newQuery()->get());

        return 1;
    }

    public function updatePermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $permission = (new Permission())->newQuery()->firstOrCreate(['name' => $permission]);
        }
    }
}
