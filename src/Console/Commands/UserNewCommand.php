<?php

namespace Taskday\Console\Commands;

use Illuminate\Console\Command;
use Taskday\Models\User;

class UserNewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:new';

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
            'name' => $this->ask('name'),
            'email' => $this->ask('email'),
            'password' => bcrypt($this->secret('password')),
        ]);

        return Command::SUCCESS;
    }
}
