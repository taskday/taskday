<?php

namespace Taskday\Console\Commands;

use Illuminate\Console\Command;
use Taskday\Models\User;

class UserCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::create([
            'first_name' => $this->ask('First name'),
            'last_name' => $this->ask('Last name'),
            'username' => $this->ask('Username'),
            'email' => $this->ask('Email'),
            'password' => bcrypt($this->secret('Password')),
        ]);

        return Command::SUCCESS;
    }
}
