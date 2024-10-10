<?php

namespace Database\Seeders;

use App\Models\CategoryRanhamn;
use App\Models\Kkp;
use App\Models\Role;
use App\Models\Rule;
use App\Models\RuleType;
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

        CategoryRanhamn::create([
            'nama' => "B-04"
        ]);
        CategoryRanhamn::create([
            'nama' => "B-08"
        ]);
        CategoryRanhamn::create([
            'nama' => "B-012"
        ]);

        RuleType::create([
            'nama'=> 'KABAG',
        ]);
        RuleType::create([
            'nama'=> 'SEKRETARIS',
        ]);
        RuleType::create([
            'nama'=> 'VERIFIKATOR',
        ]);
        RuleType::create([
            'nama'=> 'BIDANG',
        ]);
        Rule::create([
            'nama'=> 'Abdul Haris',
            'nip'=>'199101052015031001',
            'rule_id' => 1,
            'id_opd' => 9
        ]);

    }
}
