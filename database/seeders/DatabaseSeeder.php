<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new \App\Models\User();
        $user->name = 'webdev';
        $user->email = 'webdev2030@gmail.com';
        $user->password = Hash::make('IAmWebDev6000$!');
        $user->save();
    }
}
