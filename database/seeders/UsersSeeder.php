<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Grimzy\LaravelMysqlSpatial\Types\Point;

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
        
        /*
        User::create([
            'name'        => 'estabelecimento teste 1',
            'location'    => new Point(40.767864, -73.971732),
            'status'      => '1',
        ]);

        User::create([
            'name'        => 'estabelecimento teste 2',
            'location'    => new Point(40.767664, -73.971271),
            'status'      => '1',
        ]);

        User::create([
            'name'        => 'estabelecimento teste 3',
            'location'    => new Point(40.761434, -73.977619),
            'status'      => '1',
        ]); */
    }
}
