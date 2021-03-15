<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    }
}
