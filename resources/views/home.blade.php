@extends('layouts.app')

@section('content')


<!-- hero -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#98e9ff] via-white to-[#EAF6FF]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <span class="inline-block px-3 py-1 rounded-full bg-[#E8FFF6] text-[#20cfff] border border-[#20cfff] text-sm font-medium">
                Dipercaya oleh rumah & kantor yang sibuk
            </span>

            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                {{ $setting->hero_title ?? 'Layanan Kebersihan Profesional' }}
            </h1>

            <p class="mt-4 text-lg text-slate-600">
                {{ $setting->hero_description ?? 'Solusi kebersihan terbaik untuk hunian dan kantor Anda. Pesan sekarang dengan mudah.' }}
            </p>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="/booking" class="bg-[#20cfff] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#006eb7] transition shadow-lg shadow-blue-200/50">
                    Pesan Sekarang
                </a>
                <a href="#services" class="px-6 py-3 rounded-lg font-semibold border border-slate-300 text-slate-700 hover:bg-slate-50 transition">
                    Lihat Layanan
                </a>
            </div>

      <div class="mt-6 flex items-center gap-4 text-sm text-slate-500">
  <div class="flex -space-x-2">
    <img src="https://images.unsplash.com/photo-1544006659-f0b21884ce1d" class="w-8 h-8 rounded-full border-2 border-white">
    <img src="https://images.unsplash.com/photo-1529665253569-6d01c0eaf7b6" class="w-8 h-8 rounded-full border-2 border-white">
    <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c" class="w-8 h-8 rounded-full border-2 border-white">
  </div>
  <p>
    <span class="font-semibold text-slate-700">1.200+ pelanggan puas</span>
    dari rumah dan perkantoran
  </p>
</div>
</div>

<div>
  <div class="relative">
    <img
      class="rounded-2xl shadow-2xl ring-1 ring-black/5 block"
      src="{{ asset('images/foto_utama.png') }}"
      alt="layanan kebersihan profesional"
    />
    <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-lg p-4 ring-1 ring-black/5">
      <p class="text-sm font-semibold text-slate-700">
        Tersedia layanan di hari yang sama
      </p>
      <p class="text-xs text-slate-500">
        Pagi, siang, dan malam
      </p>
    </div>
  </div>
</div>
</div>
</section>

<!-- SERVICES -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($services as $service)
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition
                  border border-slate-100 group flex flex-col h-full">

        <!-- IMAGE -->
        <div class="relative h-56 overflow-hidden">
    <img src="{{ asset('storage/' . $service->image) }}"
         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
</div>

<div class="p-5 flex flex-col flex-1">
    <h3 class="text-lg font-bold text-slate-800 mb-1 leading-tight">
        {{ $service->name }}
    </h3>

    <p class="text-slate-500 text-sm mb-2 leading-snug line-clamp-2">
        {{ $service->short_description }}
    </p>

    <div class="flex items-center justify-between mt-auto">
        <span class="text-blue-600 font-bold text-sm">
            Mulai Rp {{ number_format($service->price, 0, ',', '.') }}
        </span>

        <a href="{{ route('services.show', $service->slug) }}"
           class="text-sm font-semibold text-slate-700 hover:text-blue-600">
            Lihat detail →
        </a>
    </div>
</div>
        </div>
      @endforeach
    </div>

  </div>
</section>



<!-- promo -->

<section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
    
    <div class="mb-8 flex items-center gap-3">
        <div class="h-8 w-1 bg-blue-500 rounded-full"></div>
        <h2 class="text-2xl font-bold text-slate-800">🔥 Promo Hari Ini</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        @foreach ([
            ['text' => $setting->promo_1_text, 'image' => $setting->promo_1_image],
            ['text' => $setting->promo_2_text, 'image' => $setting->promo_2_image],
            ['text' => $setting->promo_3_text, 'image' => $setting->promo_3_image]
        ] as $index => $promo)

            @if($promo['text']) 
                <div class="group relative h-48 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100">
                    
                    @if($promo['image'])
                        <img src="{{ asset('storage/' . $promo['image']) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-400 to-slate-600"></div>
                    @endif

                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <span class="inline-block px-2 py-1 mb-2 text-[10px] font-bold uppercase tracking-wider text-white bg-blue-600/80 rounded backdrop-blur-sm">
                            Promo {{ $index + 1 }}
                        </span>
                        <h3 class="text-xl font-bold text-white leading-tight drop-shadow-md">
                            {{ $promo['text'] }}
                        </h3>
                    </div>
                </div>

            @else
                <div class="h-48 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                    </svg>
                    <span class="text-sm font-medium">Slot Kosong</span>
                </div>
            @endif

        @endforeach

    </div>
</section>



<!-- Bersih & Nyaman dengan 1 Klik -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-14 items-center">

        <!-- LEFT: IMAGE GRID -->
        <div class="grid grid-cols-2 gap-4 h-[520px]">
            
            <!-- Gambar besar -->
            <div class="col-span-1 row-span-2">
                <img
                    src="https://images.unsplash.com/photo-1581578731548-c64695cc6952"
                    alt="Cleaning service"
                    class="w-full h-full object-cover rounded-2xl shadow-lg"
                >
            </div>

            <!-- Gambar kecil atas -->
            <div>
                <img
                    src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2"
                    alt="Clean room"
                    class="w-full h-[248px] object-cover rounded-2xl shadow-md"
                >
            </div>

            <!-- Gambar kecil bawah -->
            <div>
                <img
                    src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
                    alt="Clean kitchen"
                    class="w-full h-[248px] object-cover rounded-2xl shadow-md"
                >
            </div>

        </div>

        <!-- RIGHT: CONTENT -->
        <div>
            <h2 class="text-4xl font-extrabold text-slate-800 mb-6">
                Bersih & Nyaman dengan <span class="text-[#20cfff]">1 Klik</span>
            </h2>

            <p class="text-slate-600 mb-10 leading-relaxed">
                Di balik komitmen kami terhadap keunggulan, terdapat beberapa atribut utama
                yang mendefinisikan siapa kami dan apa yang membuat kami berbeda dari yang lain.
            </p>

            <div class="space-y-8">

                <!-- Pesan -->
                <div class="flex gap-4">
                    <span class="mt-2 w-3 h-3 bg-yellow-400 rounded-sm"></span>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Pesan</h3>
                        <p class="text-slate-600 mt-1">
                            Pesan berbagai layanan jasa kebersihan langsung melalui aplikasi
                            <strong>AshaClean</strong>.
                        </p>
                    </div>
                </div>

                <!-- Chat -->
                <div class="flex gap-4">
                    <span class="mt-2 w-3 h-3 bg-yellow-400 rounded-sm"></span>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Chat</h3>
                        <p class="text-slate-600 mt-1">
                            Chat langsung dengan helper melalui aplikasi tanpa ribet.
                        </p>
                    </div>
                </div>

                <!-- Enjoy -->
                <div class="flex gap-4">
                    <span class="mt-2 w-3 h-3 bg-yellow-400 rounded-sm"></span>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Enjoy</h3>
                        <p class="text-slate-600 mt-1">
                            Helper profesional datang tepat waktu dengan hasil maksimal.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Kenapa Harus KliknClean -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Title -->
        <div class="text-center mb-14">
            <h2 class="text-4xl font-extrabold text-slate-800">
                Kenapa Harus <span class="text-[#20cfff]">KliknClean</span>
            </h2>
            <p class="mt-3 text-slate-600 max-w-2xl mx-auto">
                Solusi kebersihan modern yang aman, fleksibel, dan terpercaya.
            </p>
        </div>

        <!-- Cards -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Card 1 -->
            <div class="rounded-2xl p-6 text-white bg-[#20cfff] shadow-lg relative overflow-hidden">
                <h3 class="text-xl font-bold mb-3">Tersebar Luas di Indonesia</h3>
                <p class="text-white/90 text-sm leading-relaxed">
                    Hadir di Jakarta, Tangerang, Depok, Bekasi, Bogor, Bandung, Medan, Surabaya, dan Denpasar.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="rounded-2xl p-6 text-white bg-[#ffab2d] shadow-lg relative overflow-hidden">
                <h3 class="text-xl font-bold mb-3">Bisa Pilih bantu Sesuka Kamu</h3>
                <p class="text-white/90 text-sm leading-relaxed">
                    Sistem prepaid memungkinkan kamu memilih helper favorit dengan tenang dan nyaman.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="rounded-2xl p-6 text-white bg-[#41c17d] shadow-lg relative overflow-hidden">
                <h3 class="text-xl font-bold mb-3">Privasi Kamu Aman!</h3>
                <p class="text-white/90 text-sm leading-relaxed">
                    Semua komunikasi dilakukan di aplikasi. Aman, transparan, dan bebas penipuan.
                </p>
            </div>

            <!-- Card 4 -->
            <div class="rounded-2xl p-6 text-white bg-[#0b2d4d] shadow-lg relative overflow-hidden">
                <h3 class="text-xl font-bold mb-3">Bayar Pakai Apa Aja Bisa!</h3>
                <p class="text-white/90 text-sm leading-relaxed">
                    Tersedia e-wallet, virtual account, hingga kartu kredit favoritmu.
                </p>
            </div>

        </div>

    </div>
</section>


<!-- Cara Memesan -->
<section class="py-20 bg-[#e3faff] relative overflow-hidden mt-10">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid md:grid-cols-2 gap-12 items-center">

        <!-- Gambar HP -->
        <div class="flex justify-center">
            <div class="relative w-[300px] md:w-[360px]">
                <img 
                    src="/images/mock-up.png" 
                    alt="Mockup App" 
                    class="rounded-3xl shadow-2xl border border-gray-300"
                >
            </div>
        </div>

        <!-- Step -->
        <div class="text-slate-800">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-8">
                Cara Memesan Layanan di <span class="text-slate-800">AshaClean</span>
            </h2>

            <div class="space-y-6">

                <!-- Step 1 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#47899b] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">1</span>
                    <div>
                        <h3 class="text-xl font-bold">Pilih Layanan</h3>
                        <p class="text-slate-800">Pilih layanan sesuai kebutuhanmu.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#47899b] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">2</span>
                    <div>
                        <h3 class="text-xl font-bold">Lengkapi Detail Pesanan</h3>
                        <p class="text-slate-800">Isi data diri, durasi, dan jadwalkan pengerjaan.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#47899b] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">3</span>
                    <div>
                        <h3 class="text-xl font-bold">Lakukan Pembayaran</h3>
                        <p class="text-slate-800">Pilih metode pembayaran dan selesaikan transaksi.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#47899b] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">4</span>
                    <div>
                        <h3 class="text-xl font-bold">Helper Siap Membantu!</h3>
                        <p class="text-slate-800">Tim datang sesuai jadwal yang kamu pilih.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-[#f5f8fa]">
    <div class="max-w-5xl mx-auto px-6">

        <h2 class="text-4xl font-extrabold text-center text-slate-800 mb-12">
            Paling Sering Ditanyakan di <span class="text-[#20cfff]">AshaClean</span>
        </h2>

        <div class="space-y-6">

            <!-- ITEM FAQ -->
            @foreach([
                [
                    'q' => 'Apa itu AshaClean?',
                    'a' => 'AshaClean adalah platform penyedia layanan jasa kebersihan untuk rumah dan kantor Anda.'
                ],
                [
                    'q' => 'Jenis bangunan apa saja yang dapat menggunakan layanan General Cleaning?',
                    'a' => 'General Cleaning cocok untuk rumah, apartemen, kantor, ruko, dan tempat usaha lainnya.'
                ],
                [
                    'q' => 'Apa jadwal yang sudah dipesan dapat diubah?',
                    'a' => 'Tentu, Anda dapat mengubah jadwal minimal 2 jam sebelum jam layanan dimulai.'
                ],
                [
                    'q' => 'Apakah ada garansi untuk layanan AC Cleaning?',
                    'a' => 'Ya, kami memberikan garansi 3 hari apabila terjadi kendala setelah layanan.'
                ]
            ] as $faq)

            <div 
                x-data="{ open: false }" 
                class="bg-white rounded-xl shadow border overflow-hidden"
            >
                <!-- Header FAQ -->
                <button 
                    @click="open = !open" 
                    class="w-full flex justify-between items-center px-6 py-5 text-left"
                >
                    <span class="font-semibold text-lg text-slate-800">{{ $faq['q'] }}</span>

                    <svg 
                        class="w-6 h-6 text-slate-600 transform transition-transform duration-300"
                        :class="open ? 'rotate-180' : ''" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Content FAQ -->
                <div 
                    x-show="open" 
                    x-transition.duration.300ms 
                    class="px-6 pb-5 text-slate-600"
                >
                    {{ $faq['a'] }}
                </div>
            </div>

            
            @endforeach

        </div>
    </div>
</section>
    
<section id="review-preview" class="pt-12 pb-8 bg-[#e3faff]">
  <div class="max-w-7xl mx-auto px-4">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center">

      @forelse($reviewsPreview as $review)
      
        {{-- 2. KARTU TETAP PUTIH (bg-white) AGAR KONTRAS --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition w-full max-w-md flex flex-col">

          <div class="flex items-center gap-4 mb-3">
            <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold uppercase">
              {{ substr($review->name, 0, 1) }}
            </div>

            <div>
              <h4 class="font-semibold text-slate-800 leading-tight">
                {{ $review->name }}
              </h4>
              <p class="text-xs text-slate-500">
                Menggunakan Layanan:
                <span class="text-blue-600 font-medium">
                  {{ $review->service->name ?? 'Pelanggan Setia' }}
                </span>
              </p>
            </div>
          </div>

          <div class="flex text-yellow-400 mb-2">
            @for($i = 1; $i <= 5; $i++)
              <svg class="h-4 w-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200 fill-current' }}" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
              </svg>
            @endfor
          </div>

          <p class="text-slate-600 italic text-sm leading-relaxed mt-auto">
            “{{ $review->content }}”
          </p>

        </div>

      @empty
        {{-- EMPTY STATE JUGA DISESUAIKAN (Bg putih transparan agar bagus di biru) --}}
        <div class="col-span-full text-center py-8 bg-white/10 rounded-2xl border border-dashed border-white/30 w-full max-w-xl mx-auto">
            <p class="text-white font-medium">Belum ada ulasan</p>
            <p class="text-sm text-blue-100">Jadilah yang pertama memberikan ulasan!</p>
        </div>
      @endforelse

    </div>

    @if($reviewsAll->count() > 3)
      <div class="flex justify-end mt-4 px-1">
        {{-- 3. LINK MENJADI PUTIH (text-white) SUPAYA KELIHATAN --}}
        <a href="#all-reviews" 
           class="group inline-flex items-center gap-1 text-white font-semibold text-sm hover:text-blue-100 transition-colors">
          Lihat Ulasan Lainnya
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
               class="w-4 h-4 transform group-hover:translate-x-1 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
          </svg>
        </a>
      </div>
    @endif

  </div>

</div>

        <!-- CTA REVIEW -->
        <section class="py-16">
          <div class="max-w-4xl mx-auto px-4 text-center">

            <h3 class="text-3xl md:text-4xl font-extrabold text-slate-800">
              Sekarang waktunya kamu buat
              <span class="text-[#20cfff]">ngasih ulasan!</span>
            </h3>

            <p class="mt-4 text-slate-600 max-w-2xl mx-auto">
              Ceritakan pengalamanmu menggunakan layanan AshaClean
              dan bantu orang lain menemukan layanan kebersihan terbaik.
            </p>

            <!-- Input dummy -->
            <div class="mt-8 text-center">
    @guest
        <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-300 transition">
            Login untuk Memberi Ulasan
        </a>
    @else
        <a href="{{ route('reviews.create') }}" class="inline-block px-6 py-3 bg-[#20cfff] text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
            Tulis Pengalaman Anda
        </a>
    @endauth
</div>
</div>
</section>

    </div>
</section>

    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- BRAND --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-9 h-9 rounded-full bg-[#20cfff] text-white 
                                flex items-center justify-center font-bold">
                        <img 
                src="{{ asset('images/logo-ashaclean.png') }}" 
                alt="Asha Clean Logo"
                class="h-9 w-auto object-contain"
            >
                    </div>
                    <span class="text-lg font-semibold text-gray-800">Asha Clean</span>
                </div>

                <p class="text-sm text-gray-600 leading-relaxed">
                    Layanan kebersihan profesional untuk rumah dan bisnis Anda.
                    Praktis, terpercaya, dan berkualitas.
                </p>
            </div>

            {{-- MENU --}}
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="/" class="text-gray-600 hover:text-[#20cfff] transition">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/services" class="text-gray-600 hover:text-[#20cfff] transition">
                            Services
                        </a>
                    </li>
                    <li>
                        <a href="/booking" class="text-gray-600 hover:text-[#20cfff] transition">
                            Booking
                        </a>
                    </li>
                    <li>
                        <a href="/faq" class="text-gray-600 hover:text-[#20cfff] transition">
                            FAQ
                        </a>
                    </li>
                </ul>
            </div>

            {{-- LAYANAN --}}
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Layanan</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>Deep Clean Rumah</li>
                    <li>Service AC</li>
                    <li>General Cleaning</li>
                    <li>Move In / Move Out</li>
                </ul>
            </div>

            {{-- KONTAK --}}
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>📍 Jakarta, Indonesia</li>
                    <li>📞 0812-3456-7890</li>
                    <li>✉️ support@ashaclean.id</li>
                </ul>
            </div>

        </div>

        {{-- COPYRIGHT --}}
        <div class="border-t border-gray-200 mt-10 pt-6 flex flex-col md:flex-row 
                    justify-between items-center text-sm text-gray-500">
            <p>
                © {{ date('Y') }} <span class="font-medium text-gray-700">Asha Clean</span>.
                All rights reserved.
            </p>

            <div class="flex gap-4 mt-3 md:mt-0">
                <a href="#" class="hover:text-[#20cfff] transition">Privacy Policy</a>
                <a href="#" class="hover:text-[#20cfff] transition">Terms</a>
            </div>
        </div>

    </div>
</footer>

@if($setting->show_quick_support && $setting->whatsapp_number)
    
    <a href="https://wa.me/{{ $setting->whatsapp_number }}?text=Halo%20Admin%20Asha%20Clean,%20saya%20ingin%20bertanya%20tentang%20layanan%20kebersihan..." 
       target="_blank"
       class="fixed bottom-8 right-8 z-50 group flex items-center justify-center">

        <div class="absolute right-20 top-1/2 -translate-y-1/2 bg-white px-4 py-2 rounded-xl shadow-xl border border-slate-100 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none transform translate-x-2 group-hover:translate-x-0">
            <p class="text-sm font-bold text-slate-700 whitespace-nowrap">Chat Admin Sekarang 👋</p>
            <div class="absolute top-1/2 -right-2 -translate-y-1/2 w-3 h-3 bg-white transform rotate-45 border-r border-t border-slate-100"></div>
        </div>

        <div class="relative w-16 h-16 bg-[#25D366] rounded-full shadow-2xl flex items-center justify-center transition-transform duration-300 hover:scale-110 hover:rotate-6">
            
            
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="#ffffff">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487 2.106.91 2.946.729 3.492.68.618-.055 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
        </div>
    </a>

@endif
@endsection