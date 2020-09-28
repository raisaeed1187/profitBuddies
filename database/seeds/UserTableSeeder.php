<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin'),
            'admin'=>1,
            'contact_no'=>'12313453',
            'type'=>'admin'
        ]);
        App\User::create([
            'name'=>'Saeed Anwar',
            'email'=>'saeed@gmail.com',
            'password'=>bcrypt('saeed123'),
            'admin'=>0,
            'address'=>'FaisalaBad,Punjab',
            'number'=>'12313453',
            

        ]);
    }
}
