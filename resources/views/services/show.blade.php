@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

        {{-- TEXT --}}
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900">
                {{ $service->title }}
            </h1>

            <p class="mt-4 text-slate-600 leading-relaxed">
                {{ $service->description }}
            </p>

            <h3 class="mt-10 text-xl font-bold text-slate-800">
                Alat yang Digunakan
            </h3>

            @if($service->tools->count())
                <div class="grid sm:grid-cols-2 gap-6 mt-6">
                    @foreach($service->tools as $tool)
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-xl">
                                {{ $tool->icon ?? '🧰' }}
                            </div>
                            <div>
                                <p class="font-semibold">{{ $tool->name }}</p>
                                <p class="text-sm text-slate-600">
                                    {{ $tool->description }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mt-4 italic text-slate-500">
                    Belum ada tools untuk layanan ini.
                </p>
            @endif
            <a href=(
               class="inline-block mt-10 bg-[#20cfff] text-white px-8 py-3 rounded-xl font-semibold hover:bg-[#006eb7] transition">
                Pesan Sekarang
            </a>
        </div>

        {{-- IMAGE --}}
        <div>
            <img src="{{ asset('storage/'.$service->image) }}"
                 class="rounded-3xl shadow-lg w-full object-cover">
        </div>

    </div>
</section>
@endsection
