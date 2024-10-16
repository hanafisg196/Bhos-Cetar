<?php

namespace Database\Seeders;

use App\Models\CategoryRanhamn;
use App\Models\Kkp;
use App\Models\OpdList;
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

        //   User::factory()->create([
        //       'name' => 'Test User',
        //       'username' => 'email@example.com',
        //       'password' => 'rahasia',
        //       'role' => 1,
        //   ]);

        Kkp::create([
            'name' => 'Hak Atas Informasi',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Pemerintahan',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Bantuan Hukum',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Keberagaman dan Pluralisme',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Kesehatan',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Pendidikan',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Perempuan',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Pekerjaan',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Perumahan dan Lingkungan',
        ]);
        Kkp::create([
            'name' => 'Hak Atas Kependudukan',
        ]);

        CategoryRanhamn::create([
            'nama' => 'B-04',
        ]);
        CategoryRanhamn::create([
            'nama' => 'B-08',
        ]);
        CategoryRanhamn::create([
            'nama' => 'B-012',
        ]);

        Rule::create([
            'nama' => 'ADMIN',
        ]);
        Rule::create([
            'nama' => 'KABAG',
        ]);
        Rule::create([
            'nama' => 'SEKRETARIS',
        ]);
        Rule::create([
            'nama' => 'KABID',
        ]);
        Rule::create([
            'nama' => 'VERIFIKATOR 1',
        ]);
        Rule::create([
            'nama' => 'VERIFIKATOR 2',
        ]);

        $data = [
         'data' =>[
            'nama' => [
               'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',
               'Badan Kesatuan Bangsa dan Politik',
               'Badan Penanggulangan Bencana Daerah',
               'Badan Pengelolaan Keuangan Daerah',
               'Badan Pengelolaan Pendapatan Daerah',
               'Badan Perencanaan Pembangunan Daerah, Penelitian Dan Pengembangan',
               'Dinas Kependudukan Dan Pencatatan Sipil',
               'Dinas Kesehatan',
               'Dinas Komunikasi Dan Informatika',
               'Dinas Koperasi UKM dan Perdagangan',
               'Dinas Pangan dan Perikanan',
               'Dinas Pariwisata, Pemuda Dan Olahraga',
               'Dinas Pekerjaan Umum, Penataan Ruang dan Pertanahan',
               'Dinas Pemberdayaan Masyarakat Desa, Pengendalian Penduduk Dan Keluarga Berencana',
               'Dinas Penanaman Modal, Pelayanan Terpadu Satu Pintu',
               'Dinas Pendidikan Dan Kebudayaan',
               'Dinas Perhubungan',
               'Dinas Perpustakaan Dan Kearsipan',
               'Dinas Pertanian',
               'Dinas Perumahan Rakyat, Kawasan Pemukiman Dan Lingkungan Hidup',
               'Dinas Sosial, Pemberdayaan Perempuan Dan Perlindungan Anak',
               'Dinas Tenaga Kerja dan Perindustrian',
               'Inspektorat',
               'Kantor Camat Batipuh',
               'Kantor Camat Batipuh Selatan',
               'Kantor Camat Lima Kaum',
               'Kantor Camat Lintau Buo',
               'Kantor Camat Lintau Buo Utara',
               'Kantor Camat Padang Ganting',
               'Kantor Camat Pariangan',
               'Kantor Camat Rambatan',
               'Kantor Camat Salimpaung',
               'Kantor Camat Sungai Tarab',
               'Kantor Camat Sungayang',
               'Kantor Camat Tanjung Baru',
               'Kantor Camat Tanjung Emas',
               'Kantor Camat X Koto',
               'RSUD M.A Hanafiah SM Batusangkar',
               'Satuan Polisi Pamong Praja Dan Pemadam Kebakaran',
               'Sekretariat Daerah',
               'Sekretariat DPRD'
            ],
            'kode' =>[
               '01.01.',
               '37.01.',
               '05.01.',
               '04.01.',
               '48.01.',
               '06.01.',
               '07.01.',
               '08.01.',
               '09.01.',
               '10.01.',
               '11.01.',
               '12.01.',
               '13.01.',
               '14.01.',
               '15.01.',
               '16.01.',
               '17.01.',
               '18.01.',
               '19.01.',
               '20.01.',
               '21.01.',
               '49.01.',
               '22.01.',
               '23.01.',
               '24.01.',
               '25.01.',
               '26.01.',
               '27.01.',
               '28.01.',
               '29.01.',
               '30.01.',
               '31.01.',
               '32.01.',
               '33.01.',
               '34.01.',
               '35.01.',
               '36.01.',
               '38.01.',
               '39.01.',
               '02.01.',
               '03.01.'
            ]
         ]
      ];

      // Menggabungkan data nama dan kode lalu menyimpannya ke database
      for ($i = 0; $i < count($data['data']['nama']); $i++) {
          OpdList::create([
              'nama' => $data['data']['nama'][$i],
              'kode_jabatan' => $data['data']['kode'][$i]
          ]);
      }



    }
}


