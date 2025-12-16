@extends('layouts.app')

@section('content')


<!-- hero -->
<section class="relative overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-br from-[#98e9ff] via-white to-[#EAF6FF]"></div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <span class="inline-block px-3 py-1 rounded-full bg-[#E8FFF6] text-[#20cfff] border border-[#20cfff] text-sm font-medium">
        Trusted by busy homes & offices
      </span>

      <h1 class="mt-5 text-4xl md:text-5xl font-extrabold text-slate-900">
        Professional Cleaning Service You Can Trust —
        <span class="text-[#20cfff]">Asha Clean</span>
      </h1>

      <p class="mt-4 text-lg text-slate-600">
        Sparkling spaces without the stress. Friendly, vetted professionals. Flexible scheduling. Clear pricing. Guaranteed satisfaction.
      </p>

      <div class="mt-6 flex flex-wrap gap-3">
        <a href="/booking" class="bg-[#20cfff] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#006eb7]">
          Book Now
        </a>
        <a href="/services" class="px-6 py-3 rounded-lg font-semibold border border-slate-300 text-slate-700 hover:bg-slate-50">
          Get a Quote
        </a>
      </div>

      <div class="mt-6 flex items-center gap-4 text-sm text-slate-500">
        <div class="flex -space-x-2">
          <img src="https://images.unsplash.com/photo-1544006659-f0b21884ce1d" class="w-8 h-8 rounded-full border-2 border-white">
          <img src="https://images.unsplash.com/photo-1529665253569-6d01c0eaf7b6" class="w-8 h-8 rounded-full border-2 border-white">
          <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c" class="w-8 h-8 rounded-full border-2 border-white">
        </div>
        <p><span class="font-semibold text-slate-700">1,200+ happy clients</span> across homes and offices</p>
      </div>
    </div>

    <div>
      <div class="relative">
        <img class="rounded-2xl shadow-2xl ring-1 ring-black/5"
          src="https://images.unsplash.com/photo-1581578731548-c64695cc6952" alt="Clean living room" />
        <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-lg p-4 ring-1 ring-black/5">
          <p class="text-sm font-semibold text-slate-700">Same-day slots available</p>
          <p class="text-xs text-slate-500">Morning, afternoon, and evening</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- service -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Services we offer</h2>
      <p class="mt-2 text-slate-600 max-w-2xl mx-auto">
        Choose the cleaning service that fits your needs.
      </p>
    </div>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
      <a href="{{ route('services.cuci') }}"
      class="p-6 bg-white shadow rounded-xl border hover:shadow-md hover:bg-gradient-to-b from-[#98e9ff] via-white to-[#ffffff]">
    <h3 class="text-xl font-bold text-slate-800">Cuci Sofa, Kasur & Karpet</h3>
    <p class="text-slate-600 mt-2">Steam + Shampoo + Vacuum</p></a>

    <a href="/services/sofa-carpet-cleaning"class="p-6 bg-white shadow rounded-xl border hover:shadow-md hover:bg-gradient-to-b from-[#98e9ff] via-white to-[#ffffff]">
        <h3 class="text-xl font-bold text-slate-800">Sofa & Carpet</h3>
        <p class="text-slate-600 mt-2">Fabric-safe steam and shampoo</p>
      </a>


      <a href="/services/sofa-carpet-cleaning"class="p-6 bg-white shadow rounded-xl border hover:shadow-md hover:bg-gradient-to-b from-[#98e9ff] via-white to-[#ffffff]">
        <h3 class="text-xl font-bold text-slate-800">Sofa & Carpet</h3>
        <p class="text-slate-600 mt-2">Fabric-safe steam and shampoo</p>
      </a>

      <a href="/services/sofa-carpet-cleaning"class="p-6 bg-white shadow rounded-xl border hover:shadow-md hover:bg-gradient-to-b from-[#98e9ff] via-white to-[#ffffff]">
        <h3 class="text-xl font-bold text-slate-800">Sofa & Carpet</h3>
        <p class="text-slate-600 mt-2">Fabric-safe steam and shampoo</p>
      </a>

      <a href="/services/sofa-carpet-cleaning"class="p-6 bg-white shadow rounded-xl border hover:shadow-md hover:bg-gradient-to-b from-[#98e9ff] via-white to-[#ffffff]">
        <h3 class="text-xl font-bold text-slate-800">Sofa & Carpet</h3>
        <p class="text-slate-600 mt-2">Fabric-safe steam and shampoo</p>
      </a>

      <a href="/services/sofa-carpet-cleaning"class="p-6 bg-white shadow rounded-xl border hover:shadow-md hover:bg-gradient-to-b from-[#98e9ff] via-white to-[#ffffff]">
        <h3 class="text-xl font-bold text-slate-800">Sofa & Carpet</h3>
        <p class="text-slate-600 mt-2">Fabric-safe steam and shampoo</p>
      </a>
      </a>
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
                Cara Memesan Layanan di <span class="text-yellow-300">AshaClean</span>
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


@endsection
