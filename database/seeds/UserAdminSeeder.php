<?php

use App\User;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $office = Offices::where('acronym', '=', 'TSS')->firstOrFail();
        // $roles  = Role::where('name', 'System Administrator')->firstOrFail();
        $users = [
            [
		        'firstname' 	=> 'admin',
		        'lastname' 		=> 'account',
		        'username' 		=> 'admin',
		        'email' 		=> 'ict.dostcaraga@gmail.com',
        		'birthday'		=> date("Y-m-d"),
		        'password' 		=> bcrypt('dostcaraga'),
		        'position' 		=> 'System Administrator',
		        'isActive' 		=> true,
		        'isAdmin' 		=> true,
            ],
        ];

        foreach ($users as $user) {
            $u = User::create($user);
            // $u->roles()->sync($roles);
        }
    }
}
