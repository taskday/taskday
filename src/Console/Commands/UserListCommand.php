<?php

namespace Taskday\Console\Commands;

use Illuminate\Console\Command;
use Taskday\Models\User;

class UserListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->table([ 'id', 'name', 'email' ], User::query()->select('id', 'username', 'email')->get());

        return Command::SUCCESS;
    }
}
