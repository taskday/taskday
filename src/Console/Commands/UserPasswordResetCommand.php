<?php

namespace Taskday\Console\Commands;

use Illuminate\Console\Command;
use Taskday\Models\User;

class UserPasswordResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:password-reset {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset password of given user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = $this->argument('userId');

        if (! is_numeric($userId)) {
            $this->warn('Given ID format not valid');
        }

        $user = User::find($userId);

        if (! $user) {
            $this->warn('Given user ID not found.');
            return Command::INVALID;
        }

        do {
            $password = $this->secret('new password');
            $passwordConfirm = $this->secret('confirm new password');
        } while ($password != $passwordConfirm);

        $user->update([ 'password' => bcrypt($password) ]);

        $this->info("Update password of user $user->name");

        return Command::SUCCESS;
    }
}
