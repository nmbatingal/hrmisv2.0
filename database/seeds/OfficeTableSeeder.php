<?php

use App\Office;
use Illuminate\Database\Seeder;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            [
		        'division_name' => 'Office of the Regional Director', 
        		'div_acronym'   => 'ORD',
        		'div_head_id'   => ,
        		'receiver_id'   => ,
            ],
        ];

        foreach ($users as $user) {
            $u = User::create($user);
            // $u->roles()->sync($roles);
        }
    }
}
