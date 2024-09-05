<?php

namespace Database\Seeders;

use App\Models\Kkp;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'username' => 'test@example.com',
            'password' => 'rahasia',
            'role'=>1
        ]);

        Kkp::create([
            'name'=> 'Hak Atas Informasi',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Pemerintahan',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Bantuan Hukum',
        ]); Kkp::create([
            'name'=> 'Hak Atas Keberagaman dan Pluralisme',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Kesehatan',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Pendidikan',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Perempuan',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Pekerjaan',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Perumahan dan Lingkungan',
        ]);
        Kkp::create([
            'name'=> 'Hak Atas Kependudukan',
        ]);


    }
}
