<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'dieisson',
            'email'     => 'dieisson.martins.santos@gmail.com',
            'password'  =>  Hash::make('12345678'),
        ]); 

        DB::table('roles')->insert([
            'id'            => '1',
            'name'          => 'admin',
            'guard_name'    => 'web',
        ]);

        DB::table('roles')->insert([
            'id'            => '2',
            'name'          => 'establishment',
            'guard_name'    => 'web',
        ]);

        DB::table('roles')->insert([
            'id'            => '3',
            'name'          => 'client',
            'guard_name'    => 'web',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id'       => '1',
            'model_type'    => 'App\Models\User',
            'model_id'      => '1',
        ]);
    }
}
