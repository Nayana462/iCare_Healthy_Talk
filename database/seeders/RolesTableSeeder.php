<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            array(
                'name'=>'admin',
            ),
            array(
                'name'=>'doctor',
            ),

            array(
                'name'=>'user',
            ),
        );

        DB::table('roles')->insert($data);
    }
}
