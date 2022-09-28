<?php

namespace Taskday\Console\Commands;

use Illuminate\Console\Command;
use Taskday\Models\User;

class UserResetPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password {user}';

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
        $user = $this->argument('user');

        if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $user)->first();
        } elseif (is_numeric($user)) {
            $user = User::find($user);
        } else {
            $this->warn('Given ID format not valid');
        }

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
