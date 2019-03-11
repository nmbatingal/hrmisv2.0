<?php

use App\Office;
use App\Models\Settings\OfficeGroups;
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
		        'group_name' => 'Office of the Regional Director', 
        		'acronym'   => 'ORD',
            ],
        ];

        foreach ($offices as $office) {
            $office = Office::create($office);
            $group  = OfficeGroups::create($office);
            // $u->roles()->sync($roles);
        }
    }
}
