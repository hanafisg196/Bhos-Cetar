<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeedRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user  = User::find(1);
        $user->rules()->attach(1);

        $user  = User::find(2);
        $user->rules()->attach(2);

        $user  = User::find(3);
        $user->rules()->attach(4);

        $user  = User::find(4);
        $user->rules()->attach(6);

    }
}
