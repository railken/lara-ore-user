<?php

namespace Amethyst\Console\Commands;

use Illuminate\Console\Command;
use Amethyst\Managers\UserManager;

class UserRefreshTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amethyst:user:refresh-token {--force} {--ignoreErrors}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh users token';

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
        $manager = new UserManager();

        $repository = $manager->getRepository();

        foreach ($repository->findAllToRefreshToken((bool) $this->option('force')) as $user) {
            $token = $repository->generateToken();
            $result = $manager->update($user, ['token' => $token]);

            if ($result->ok()) {
                $this->info(sprintf('Updated user #%s with token %s', $user->id, $token));
            } else {
                $this->error(sprintf('Error while updating user #%s with token %s', $user->id, $token));

                if (!$this->option('ignoreErrors')) {
                    return;
                }
            }
        }
    }
}
