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

@endsection
