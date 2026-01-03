<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;        // <--- Jangan lupa ini
use App\Models\ServiceOption;  // <--- Jangan lupa ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. JALANKAN SEEDER BAWAAN DULU (Biar layanan dasar terbuat)
        $this->call([
            ServicePageSeeder::class,
        ]);

        // ---------------------------------------------------------
        // 2. TAMBAHKAN LOGIKA VARIAN HARGA (KODE BARU)
        // ---------------------------------------------------------

        // Cari layanan "Cuci Sofa Basah" (atau buat baru jika belum ada dari seeder di atas)
        $serviceSofa = Service::firstOrCreate(
            ['name' => 'Cuci Sofa Basah'], 
            [
                'slug' => 'cuci-sofa-basah',
                'price' => 0, 
                'short_description' => 'Layanan cuci sofa deep clean.',
                'description' => 'Membersihkan noda membandel pada sofa.',
                'image' => 'services/sofa.jpg', // Pastikan gambar ada atau null
                'is_active' => true,
            ]
        );

        // Hapus opsi lama biar gak duplikat (kalau di-seed berulang kali)
        ServiceOption::where('service_id', $serviceSofa->id)->delete();

        // Masukkan Varian Harga (Anak-anaknya)
        ServiceOption::create([
            'service_id' => $serviceSofa->id, 
            'name' => 'Sofa Kain - Ukuran S', 
            'price' => 60000
        ]);
        
        ServiceOption::create([
            'service_id' => $serviceSofa->id, 
            'name' => 'Sofa Kain - Ukuran M', 
            'price' => 70000
        ]);

        ServiceOption::create([
            'service_id' => $serviceSofa->id, 
            'name' => 'Sofa Kulit - Ukuran S', 
            'price' => 50000
        ]);

        ServiceOption::create([
            'service_id' => $serviceSofa->id, 
            'name' => 'Sofa Kulit - Ukuran M', 
            'price' => 60000
        ]);
        
        // --- SELESAI ---
    }
}