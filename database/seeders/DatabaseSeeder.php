<?php

namespace Database\Seeders;

use App\Models\CategoryRanhamn;
use App\Models\Document;
use App\Models\Ecorrection;
use App\Models\Kkp;
use App\Models\OpdList;
use App\Models\Ranham;
use App\Models\Role;
use App\Models\Rule;
use App\Models\RuleType;
use App\Models\Schedule;
use App\Models\TrackingPoint;
use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  $token = Str::uuid();
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Abdul Haris',
            'username' => '199101052015031001',
            'nip' => '199101052015031001',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-1',
        ]);
        User::factory()->create([
            'name' => 'Test 2',
            'username' => '197711272007012005',
            'nip' => '197711272007012005',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-2',
        ]);
        User::factory()->create([
            'name' => 'Test 3',
            'username' => '196802121997032003',
            'nip' => '196802121997032003',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-3',
        ]);
        User::factory()->create([
            'name' => 'Test 4',
            'username' => '198011262008031010',
            'nip' => '198011262008031010',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-4',
        ]);
        User::factory()->create([
            'name' => 'Test 5',
            'username' => '198011262008031002',
            'nip' => '198011262008031002',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-5',
        ]);
        User::factory()->create([
            'name' => 'Test 6',
            'username' => '198011262008031005',
            'nip' => '198011262008031005',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-6',
        ]);
        User::factory()->create([
            'name' => 'Test 7',
            'username' => '198011262008031012',
            'nip' => '198011262008031012',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-7',
        ]);
        User::factory()->create([
            'name' => 'Test 8',
            'username' => '198011262008031015',
            'nip' => '198011262008031015',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-8',
        ]);
        User::factory()->create([
            'name' => 'Test 9',
            'username' => '196706171989031007',
            'nip' => '196706171989031007',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-9',
        ]);

        User::factory()->create([
            'name' => 'Test 10',
            'username' => '197004242000032006',
            'nip' => '197004242000032006',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-10',
        ]);

        User::factory()->create([
            'name' => 'Test 11',
            'username' => '197208091999031005',
            'nip' => '197208091999031005',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-11',
        ]);

        User::factory()->create([
            'name' => 'Test 12',
            'username' => '196809301996032002',
            'nip' => '196809301996032002',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-12',
        ]);

        User::factory()->create([
            'name' => 'Test 13',
            'username' => '196903132002121005',
            'nip' => '196903132002121005',
            'password' => 'rahasia',
            'jabatan' => 'Pranata Komputer',
            'token' => 'test-13',
        ]);

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
            'data' => [
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
                    'Sekretariat DPRD',
                ],
                'kode' => ['01.01.', '37.01.', '05.01.', '04.01.', '48.01.', '06.01.', '07.01.', '08.01.', '09.01.', '10.01.', '11.01.', '12.01.', '13.01.', '14.01.', '15.01.', '16.01.', '17.01.', '18.01.', '19.01.', '20.01.', '21.01.', '49.01.', '22.01.', '23.01.', '24.01.', '25.01.', '26.01.', '27.01.', '28.01.', '29.01.', '30.01.', '31.01.', '32.01.', '33.01.', '34.01.', '35.01.', '36.01.', '38.01.', '39.01.', '02.01.', '03.01.'],
            ],
        ];
        for ($i = 0; $i < count($data['data']['nama']); $i++) {
            OpdList::create([
                'nama' => $data['data']['nama'][$i],
                'kode_jabatan' => $data['data']['kode'][$i],
            ]);
        }

        $user = User::find(1);
        $user->rules()->attach(1);
        $user = User::find(2);
        $user->rules()->attach(2);
        $user = User::find(3);
        $user->rules()->attach(4);
        $user = User::find(4);
        $user->rules()->attach(6);
        $user = User::find(5);
        $user->rules()->attach(5);
        $user = User::find(6);
        $user->rules()->attach(6);
        $user = User::find(7);
        $user->rules()->attach(3);
        $user = User::find(id: 11);
        $user->rules()->attach(4);
        $user = User::find(id: 12);
        $user->rules()->attach(3);
        $user = User::find(id: 13);
        $user->rules()->attach(5);

        for ($i = 1; $i <= 100; $i++) {
            $schedule = Schedule::create([
                'code' => 'LBH' . $i,
                'nama' => 'Abdul Haris' . $i,
                'nip' => '199101052015031001',
                'alamat' => 'test' . $i,
                'email' => 'test@gmail.com',
                'wa' => '0852631111688',
                'kronologi' => 'test' . $i,
                'user_id' => 1,
            ]);

            Document::create([
                'schedule_id' => $schedule->id,
                'file' => 'test ' . $i . '.pdf',
            ]);
            $schedule->refresh();
            TrackingPoint::create([
                'lbh_id' => $schedule->id,
                'status' => $schedule->status,
                'verifikator_nip' => $schedule->verifikator_nip,
            ]);
        }

        for ($i = 1; $i <= 80; $i++) {
            $ranham = Ranham::create([
                'code' => 'LAH' . $i,
                'link' => 'https://github.com/' . $i,
                'name' => 'Test 13',
                'user_id' => 12,
                'kkp_id' => 1,
            ]);
            $ranham->refresh();
            TrackingPoint::create([
                'lah_id' => $ranham->id,
                'status' => $ranham->status,
                'verifikator_nip' => $ranham->verifikator_nip,
            ]);
        }

        for ($i = 1; $i <= 100; $i++) {
            $ecor = Ecorrection::create([
                'code' => 'ECOR' . $i,
                'nip' => '198011262008031010',
                'nama' => 'Test 4',
                'title' => 'Test' . $i,
                'user_id' => 4,
            ]);

            Document::create([
                'ecorrection_id' => $ecor->id,
                'file' => 'test ' . $i . '.pdf',
            ]);
            $ecor->refresh();
            TrackingPoint::create([
                'ecor_id' => $ecor->id,
                'status' => $ecor->status,
                'verifikator_nip' => $ecor->verifikator_nip,
            ]);
        }
    }
}
