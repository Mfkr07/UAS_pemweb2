<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Viewer / Kepala Desa
        User::factory()->create([
            'name' => 'Kepala Desa',
            'email' => 'kepala@desa.com',
            'password' => bcrypt('password'),
            'role' => 'viewer',
        ]);

        // Categories
        $categories = collect([
            ['name' => 'Gedung', 'description' => 'Fasilitas berupa bangunan dan gedung'],
            ['name' => 'Kendaraan', 'description' => 'Kendaraan operasional desa'],
            ['name' => 'Jalan & Jembatan', 'description' => 'Infrastruktur jalan dan jembatan desa'],
        ]);

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }

        // Assets
        $gedungId = \App\Models\Category::where('name', 'Gedung')->first()->id;
        $kendaraanId = \App\Models\Category::where('name', 'Kendaraan')->first()->id;
        $jalanId = \App\Models\Category::where('name', 'Jalan & Jembatan')->first()->id;

        $asset1 = \App\Models\Asset::create([
            'category_id' => $gedungId,
            'name' => 'Balai Desa',
            'description' => 'Gedung utama untuk administrasi dan pelayanan masyarakat.',
            'condition' => 'baik',
            'acquisition_date' => '2020-01-15',
            'location' => 'Jalan Utama Desa No. 1',
        ]);

        $asset2 = \App\Models\Asset::create([
            'category_id' => $kendaraanId,
            'name' => 'Mobil Siaga',
            'description' => 'Kendaraan untuk pelayanan kesehatan dan darurat warga.',
            'condition' => 'baik',
            'acquisition_date' => '2022-05-10',
            'location' => 'Garasi Balai Desa',
        ]);

        $asset3 = \App\Models\Asset::create([
            'category_id' => $jalanId,
            'name' => 'Jalan Dusun Mekar',
            'description' => 'Jalan aspal penghubung dusun sepanjang 2 KM.',
            'condition' => 'rusak_ringan',
            'acquisition_date' => '2019-08-20',
            'location' => 'Dusun Mekar',
        ]);

        // Maintenance Logs
        \App\Models\MaintenanceLog::create([
            'asset_id' => $asset3->id,
            'maintenance_date' => now()->subDays(5)->toDateString(),
            'cost' => 5000000,
            'description' => 'Penambalan lubang jalan di 3 titik.',
            'status' => 'completed',
        ]);

        \App\Models\MaintenanceLog::create([
            'asset_id' => $asset2->id,
            'maintenance_date' => now()->addDays(2)->toDateString(),
            'cost' => 1500000,
            'description' => 'Servis rutin berkala dan ganti oli.',
            'status' => 'planned',
        ]);
    }
}
