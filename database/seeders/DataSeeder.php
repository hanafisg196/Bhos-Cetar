<?php

namespace Database\Seeders;

use App\Models\Ranham;
use App\Models\TrackingPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             for ($i = 1; $i <= 80; $i++) {
                  $ranham = Ranham::create([
                      'code' => 'LAH' . $i,
                      'link' => 'https://github.com/' . $i,
                      'name' => 'Test 13',
                      'user_id' => 1,
                      'nip' => '196809301996032002',
                      'kkp_id' => 1,
                  ]);
                  $ranham->refresh();
                  TrackingPoint::create([
                      'lah_id' => $ranham->id,
                      'status' => $ranham->status,
                      'nama_pemohon' => $ranham->verifikator_name,
                  ]);
              }
    }
}
