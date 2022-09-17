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
    protected $signature = 'taskday:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install taskday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        

        return Command::SUCCESS;
    }
}
