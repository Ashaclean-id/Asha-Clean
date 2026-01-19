<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ServicePageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan Foreign Key agar bisa truncate (kosongkan data lama)
        Schema::disableForeignKeyConstraints();
        DB::table('service_prices')->truncate();
        DB::table('service_pages')->truncate();
        Schema::enableForeignKeyConstraints();

        // ==========================================
        // 1. CUCI KASUR & SPRINGBED (Services 1)
        // ==========================================
        $springbedId = DB::table('service_pages')->insertGetId([
            'title' => 'Cuci Kasur & Springbed',
            'slug' => 'cuci-springbed',
            'description' => '<p>Layanan deep cleaning springbed Asha Clean dirancang untuk mengangkat debu, tungau, dan noda membandel. Metode kami aman dan higienis.</p>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Menghilangkan bau apek dan keringat.</li>
                <li>Mencegah alergi tungau.</li>
                <li>Pengeringan cepat dengan mesin blower.</li>
            </ul>',
            'price' => 150000,
            'duration' => '1.5 - 2 Jam',
            'team_size' => '2 Orang',
            'rating' => 4.9,
            'image' => 'images/services1.png', // Pastikan nama file sesuai
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('service_prices')->insert([
            ['service_page_id' => $springbedId, 'name' => 'Super King (200x200)', 'price' => 250000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $springbedId, 'name' => 'King Size (180x200)', 'price' => 230000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $springbedId, 'name' => 'Queen Size (160x200)', 'price' => 200000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $springbedId, 'name' => 'Single Size (120x200)', 'price' => 150000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==========================================
        // 2. CUCI SOFA & KURSI (Services 2)
        // ==========================================
        $sofaId = DB::table('service_pages')->insertGetId([
            'title' => 'Cuci Sofa & Kursi',
            'slug' => 'cuci-sofa',
            'description' => '<p>Kembalikan keindahan sofa Anda. Kami membersihkan noda makanan, debu, dan kusam pada sofa kain, kulit, maupun sintetik.</p>
             <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Cocok untuk sofa tamu dan kursi makan.</li>
                <li>Chemical khusus yang tidak merusak serat kain.</li>
            </ul>',
            'price' => 75000,
            'duration' => '2 - 3 Jam',
            'team_size' => '2 Orang',
            'rating' => 4.8,
            'image' => 'images/services2.png',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('service_prices')->insert([
            ['service_page_id' => $sofaId, 'name' => 'Sofa Standar (per dudukan)', 'price' => 75000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $sofaId, 'name' => 'Sofa Bed', 'price' => 200000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $sofaId, 'name' => 'Kursi Makan / Kantor', 'price' => 45000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $sofaId, 'name' => 'Bantalan Sofa', 'price' => 15000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==========================================
        // 3. KARPET & GORDEN (Services 3)
        // ==========================================
        $karpetId = DB::table('service_pages')->insertGetId([
            'title' => 'Cuci Karpet & Gorden',
            'slug' => 'cuci-karpet',
            'description' => '<p>Karpet bersih membuat ruangan lebih sehat. Layanan kami mengangkat debu tebal di karpet bulu dan gorden tanpa perlu dicopot (bisa pengerjaan di tempat).</p>',
            'price' => 15000,
            'duration' => '2 - 4 Jam',
            'team_size' => '2 - 3 Orang',
            'rating' => 4.7,
            'image' => 'images/services3.png',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('service_prices')->insert([
            ['service_page_id' => $karpetId, 'name' => 'Karpet Kantor (per m2)', 'price' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $karpetId, 'name' => 'Karpet Bulu Tebal (per m2)', 'price' => 20000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $karpetId, 'name' => 'Karpet Masjid (per m2)', 'price' => 12000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $karpetId, 'name' => 'Gorden Tebal (per m2)', 'price' => 18000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==========================================
        // 4. BABY CARE CLEANING (Services 4)
        // ==========================================
        $babyId = DB::table('service_pages')->insertGetId([
            'title' => 'Baby Care Cleaning',
            'slug' => 'baby-care',
            'description' => '<p>Perlindungan ekstra untuk si kecil. Kami menggunakan 100% Eco-Friendly Chemical yang aman (Food Grade) untuk membersihkan perlengkapan bayi.</p>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Mensterilkan stroller dan car seat.</li>
                <li>Bebas residu kimia berbahaya.</li>
            </ul>',
            'price' => 100000,
            'duration' => '1 - 1.5 Jam',
            'team_size' => '1 Orang',
            'rating' => 5.0,
            'image' => 'images/services4.png',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('service_prices')->insert([
            ['service_page_id' => $babyId, 'name' => 'Stroller (Small/Medium)', 'price' => 100000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $babyId, 'name' => 'Stroller (Large/Double)', 'price' => 150000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $babyId, 'name' => 'Car Seat', 'price' => 120000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $babyId, 'name' => 'Baby Box / Crib', 'price' => 150000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==========================================
        // 5. GENERAL CLEANING (Services 5)
        // ==========================================
        $generalId = DB::table('service_pages')->insertGetId([
            'title' => 'General Cleaning',
            'slug' => 'general-cleaning',
            'description' => '<p>Pembersihan menyeluruh untuk rumah, apartemen, atau pasca renovasi. Tim kami akan membersihkan lantai, kaca, kamar mandi, hingga debu di furnitur.</p>',
            'price' => 350000,
            'duration' => '4 - 6 Jam',
            'team_size' => '3 - 4 Orang',
            'rating' => 4.9,
            'image' => 'images/services5.png',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('service_prices')->insert([
            ['service_page_id' => $generalId, 'name' => 'Apartemen Studio (Full)', 'price' => 350000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $generalId, 'name' => 'Apartemen 2BR (Full)', 'price' => 500000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $generalId, 'name' => 'Kamar Mandi (Deep Clean)', 'price' => 150000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $generalId, 'name' => 'Pasca Renovasi (per m2)', 'price' => 25000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==========================================
        // 6. INTERIOR MOBIL (Services 6)
        // ==========================================
        $mobilId = DB::table('service_pages')->insertGetId([
            'title' => 'Interior Mobil',
            'slug' => 'interior-mobil',
            'description' => '<p>Mobil bersih, berkendara jadi nyaman. Kami membersihkan jok, plafon, dashboard, dan karpet dasar mobil Anda dari noda dan bau apek.</p>',
            'price' => 300000,
            'duration' => '2 - 3 Jam',
            'team_size' => '2 Orang',
            'rating' => 4.8,
            'image' => 'images/services6.png',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('service_prices')->insert([
            ['service_page_id' => $mobilId, 'name' => 'City Car (Agya/Brio/Jazz)', 'price' => 300000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $mobilId, 'name' => 'Small MPV (Avanza/Xpander)', 'price' => 350000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $mobilId, 'name' => 'Large SUV (Pajero/Fortuner)', 'price' => 450000, 'created_at' => now(), 'updated_at' => now()],
            ['service_page_id' => $mobilId, 'name' => 'Luxury (Alphard/Vellfire)', 'price' => 550000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}