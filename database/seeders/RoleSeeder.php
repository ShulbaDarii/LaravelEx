<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Role::create([
            'name'=>'Author',
            'slug' => 'author' ,
            'permissions' => json_encode([
                'create-post'=>true
            ])
        ]);

        $admin = Role::create([
            'name'=>'Admin',
            'slug' => 'admin' ,
            'permissions' => json_encode([
                'edit-post'=>true,
                'delete-post'=>true
            ])
        ]);
    }
}
