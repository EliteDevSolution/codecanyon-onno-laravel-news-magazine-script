<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::find(1);


        // Start superadmin
        $superAdmin = User::create([
            'first_name'        => 'Super',
            'last_name'         => 'Admin',
            'email'             => 'superadmin@admin.com',
            'password'          => bcrypt(123456),
            'newsletter_enable' => '0',
        ]);

        $activation = Activation::create($superAdmin);
        Activation::complete($superAdmin, $activation->code); 
        $superAdminRole->users()->attach($superAdmin);
         
    }
    
}
