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

      <h1 class="mt-5 text-4xl md:text-5xl font-extrabold text-slate-900">
        Layanan Kebersihan Profesional yang Bisa Anda Percaya —
        <span class="text-[#20cfff]">Asha Clean</span>
      </h1>

      <p class="mt-4 text-lg text-slate-600">
        Ruangan bersih dan nyaman tanpa ribet. Tenaga kebersihan ramah dan berpengalaman.
        Jadwal fleksibel, harga transparan, dan kepuasan terjamin.
      </p>

      <div class="mt-6 flex flex-wrap gap-3">
        <a href="/booking" class="bg-[#20cfff] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#006eb7]">
          Pesan Sekarang
        </a>
        <a href="/services" class="px-6 py-3 rounded-lg font-semibold border border-slate-300 text-slate-700 hover:bg-slate-50">
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
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-14">
      <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
        Layanan Kami
      </h2>
      <p class="mt-3 text-slate-600 max-w-2xl mx-auto">
        Berbagai layanan kebersihan profesional untuk rumah, kantor, dan kendaraan Anda.
      </p>
    </div>

    <!-- Service Cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- 1. Cuci Kasur & Springbed -->
      <a href="{{ url('/services/cuci-springbed') }}"
         class="group bg-white border rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col">

        <img src="{{ asset('images/services1.png') }}"
             alt="Cuci Kasur"
             class="h-44 w-full object-cover group-hover:scale-105 transition duration-300">

        <div class="p-7 flex flex-col h-full">
          <h3 class="text-xl font-bold text-slate-800">Cuci Kasur & Springbed</h3>
          <p class="text-slate-600 mt-2">
            Bebas tungau, bakteri, dan bau tidak sedap dengan deep cleaning profesional.
          </p>
          <span class="mt-auto text-sm font-semibold text-blue-600 group-hover:underline">
            Lihat detail →
          </span>
        </div>
      </a>

      <!-- 2. Cuci Sofa & Kursi -->
      <a href="{{ route('services.sofa') }}"
         class="group bg-white border rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col">

        <img src="{{ asset('images/services2.png') }}"
             alt="Cuci Sofa"
             class="h-44 w-full object-cover group-hover:scale-105 transition duration-300">

        <div class="p-7 flex flex-col h-full">
          <h3 class="text-xl font-bold text-slate-800">Cuci Sofa & Kursi</h3>
          <p class="text-slate-600 mt-2">
            Aman untuk kain, kulit, dan artificial. Warna tetap terjaga.
          </p>
          <span class="mt-auto text-sm font-semibold text-blue-600 group-hover:underline">
            Lihat detail →
          </span>
        </div>
      </a>

      <!-- 3. Karpet & Gorden -->
      <a href="{{ route('services.karpet') }}"
         class="group bg-white border rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col">

        <img src="{{ asset('images/services3.png') }}"
             alt="Cuci Karpet"
             class="h-44 w-full object-cover group-hover:scale-105 transition duration-300">

        <div class="p-7 flex flex-col h-full">
          <h3 class="text-xl font-bold text-slate-800">Karpet & Gorden</h3>
          <p class="text-slate-600 mt-2">
            Cuci bersih karpet dan gorden untuk udara ruangan yang lebih sehat.
          </p>
          <span class="mt-auto text-sm font-semibold text-blue-600 group-hover:underline">
            Lihat detail →
          </span>
        </div>
      </a>

      <!-- 4. Baby Care Cleaning -->
      <a href="{{ route('services.baby') }}"
         class="group bg-white border rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col">

        <img src="{{ asset('images/services4.png') }}"
             alt="Baby Care Cleaning"
             class="h-44 w-full object-cover group-hover:scale-105 transition duration-300">

        <div class="p-7 flex flex-col h-full">
          <h3 class="text-xl font-bold text-slate-800">Baby Care Cleaning</h3>
          <p class="text-slate-600 mt-2">
            Layanan khusus perlengkapan bayi dengan cairan aman & non-toxic.
          </p>
          <span class="mt-auto text-sm font-semibold text-blue-600 group-hover:underline">
            Lihat detail →
          </span>
        </div>
      </a>

      <!-- 5. General Cleaning -->
      <a href="{{ route('services.general') }}"
         class="group bg-white border rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col">

        <img src="{{ asset('images/services5.png') }}"
             alt="General Cleaning"
             class="h-44 w-full object-cover group-hover:scale-105 transition duration-300">

        <div class="p-7 flex flex-col h-full">
          <h3 class="text-xl font-bold text-slate-800">General Cleaning</h3>
          <p class="text-slate-600 mt-2">
            Pembersihan ruangan menyeluruh sesuai kebutuhan Anda.
          </p>
          <span class="mt-auto text-sm font-semibold text-blue-600 group-hover:underline">
            Lihat detail →
          </span>
        </div>
      </a>

      <!-- 6. Interior Mobil -->
      <a href="{{ route('services.mobil') }}"
         class="group bg-white border rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col">

        <img src="{{ asset('images/services6.png') }}"
             alt="Interior Mobil"
             class="h-44 w-full object-cover group-hover:scale-105 transition duration-300">

        <div class="p-7 flex flex-col h-full">
          <h3 class="text-xl font-bold text-slate-800">Interior Mobil</h3>
          <p class="text-slate-600 mt-2">
            Jok, karpet, dan dashboard bersih untuk kenyamanan berkendara.
          </p>
          <span class="mt-auto text-sm font-semibold text-blue-600 group-hover:underline">
            Lihat detail →
          </span>
        </div>
      </a>

    </div>
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
<section class="py-20 bg-gradient-to-b from-white to-[#f5fbff]">
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
<section class="py-20 bg-[#72e0ff] relative overflow-hidden mt-10">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid md:grid-cols-2 gap-12 items-center">

        <!-- Gambar HP -->
        <div class="flex justify-center">
            <div class="relative w-[300px] md:w-[360px]">
                <img 
                    src="/images/mockup-app.png" 
                    alt="Mockup App" 
                    class="rounded-3xl shadow-2xl border border-gray-300"
                >
            </div>
        </div>

        <!-- Step -->
        <div class="text-white">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-8">
                Cara Memesan Layanan di <span class="text-white-300">AshaClean</span>
            </h2>

            <div class="space-y-6">

                <!-- Step 1 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#98e9ff] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">1</span>
                    <div>
                        <h3 class="text-xl font-bold">Pilih Layanan</h3>
                        <p class="text-white/90">Pilih layanan sesuai kebutuhanmu.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#98e9ff] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">2</span>
                    <div>
                        <h3 class="text-xl font-bold">Lengkapi Detail Pesanan</h3>
                        <p class="text-white/90">Isi data diri, durasi, dan jadwalkan pengerjaan.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#98e9ff] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">3</span>
                    <div>
                        <h3 class="text-xl font-bold">Lakukan Pembayaran</h3>
                        <p class="text-white/90">Pilih metode pembayaran dan selesaikan transaksi.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex items-start space-x-4">
                    <span class="bg-white text-[#98e9ff] w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg">4</span>
                    <div>
                        <h3 class="text-xl font-bold">Helper Siap Membantu!</h3>
                        <p class="text-white/90">Tim datang sesuai jadwal yang kamu pilih.</p>
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

      <!-- TESTIMONIALS -->
<section class="py-24 bg-[#eaf6f4]">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-slate-800">
                Hear What Our Customers Have To Say
            </h2>
            <p class="mt-4 text-slate-600 max-w-3xl mx-auto">
                Trusted by both local & expat communities, we are rated 
                <span class="font-semibold text-[#20cfff]">4.7 stars</span> on Google review by over 
                <span class="font-semibold">2,000+</span> users!
            </p>
        </div>

        <!-- Cards -->
        <div class="grid md:grid-cols-3 gap-10">

            <!-- Card 1 -->
            <div class="group relative bg-white rounded-2xl shadow-lg p-8 pt-14
                        transition-all duration-300
                        hover:-translate-y-2 hover:shadow-2xl hover:bg-[#f7fdff]">

                <img
                    src="https://images.unsplash.com/photo-1544006659-f0b21884ce1d"
                    class="w-16 h-16 rounded-full absolute -top-8 left-1/2 -translate-x-1/2
                           border-4 border-white shadow
                           transition-all duration-300
                           group-hover:-top-10 group-hover:shadow-lg"
                >

                <p class="text-slate-600 leading-relaxed text-center">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia magnam nam a dolorum optio, dicta cumque at aliquid officiis deserunt illo eveniet alias dolorem voluptates, nobis voluptatum soluta ea nemo.
                </p>

                <p class="mt-5 text-center font-semibold text-slate-800">
                    @midiforreal
                </p>

                <div class="mt-3 text-center text-yellow-400 transition group-hover:scale-110">
                    ★★★★★
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group relative bg-white rounded-2xl shadow-lg p-8 pt-14
                        transition-all duration-300
                        hover:-translate-y-2 hover:shadow-2xl hover:bg-[#f7fdff]">

                <img
                    src="https://images.unsplash.com/photo-1529665253569-6d01c0eaf7b6"
                    class="w-16 h-16 rounded-full absolute -top-8 left-1/2 -translate-x-1/2
                           border-4 border-white shadow
                           transition-all duration-300
                           group-hover:-top-10 group-hover:shadow-lg"
                >

                <p class="text-slate-600 leading-relaxed text-center">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam voluptas sunt dicta tempore! Ab porro mollitia, adipisci voluptas placeat tempore cumque? Tempora doloribus tempore iste at beatae eius nihil est.
                </p>

                <p class="mt-5 text-center font-semibold text-slate-800">
                    @keweitay
                </p>

                <div class="mt-3 text-center text-yellow-400 transition group-hover:scale-110">
                    ★★★★★
                </div>
            </div>

            <!-- Card 3 -->
            <div class="group relative bg-white rounded-2xl shadow-lg p-8 pt-14
                        transition-all duration-300
                        hover:-translate-y-2 hover:shadow-2xl hover:bg-[#f7fdff]">

                <img
                    src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c"
                    class="w-16 h-16 rounded-full absolute -top-8 left-1/2 -translate-x-1/2
                           border-4 border-white shadow
                           transition-all duration-300
                           group-hover:-top-10 group-hover:shadow-lg"
                >

                <p class="text-slate-600 leading-relaxed text-center">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto delectus quam quisquam, repudiandae sint nam eaque laborum sequi quo? Reiciendis maxime sapiente molestias? Provident, vero! Nemo maiores consequatur debitis temporibus!
                </p>

                <p class="mt-5 text-center font-semibold text-slate-800">
                    @miss_luxe
                </p>

                <div class="mt-3 text-center text-yellow-400 transition group-hover:scale-110">
                    ★★★★★
                </div>
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
            <a href="{{ route('login') }}"
               class="mt-10 block w-full md:w-3/4 mx-auto px-6 py-4 rounded-xl
                      border border-slate-300 text-slate-500 text-left
                      hover:border-[#20cfff] hover:ring-2 hover:ring-[#20cfff]/30 transition">
              Tulis ulasan kamu di sini...
            </a>

            <!-- Button -->
            <a href="{{ route('login') }}"
               class="inline-block mt-6 bg-[#20cfff] text-white px-10 py-3 rounded-xl font-semibold
                      hover:bg-[#006eb7] transition">
              Login & Kirim Ulasan
            </a>

          </div>
        </section>

    </div>
</section>




@endsection
