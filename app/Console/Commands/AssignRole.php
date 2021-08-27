<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:role {role} {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign role for user';

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
     * @return int
     */
    public function handle()
    {
        $slug = $this->argument('role');
        $user_id= $this->argument('user_id');

        $role= Role::where('slug',$slug)->first();
        if(!$role){
            $this->error('Invalid role');
        }

        $user = User::where('id',$user_id)->first();
        if(!$user){
            $this->error('Invalid user_id');
        }
        $user->roles()->attach($role);
        $this->info('SUCCESS');
    }
}
