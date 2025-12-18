@extends('layouts.app')

@section('content')
<section class="py-20 max-w-6xl mx-auto px-6">
    <h1 class="text-4xl font-extrabold text-slate-800 mb-4">
        Cuci Kasur
    </h1>

    <p class="text-slate-600 mb-6">
        Layanan cuci kasur profesional menggunakan steam, vacuum, dan shampoo
        untuk menghilangkan tungau, debu, dan bakteri.
    </p>

    <a href="{{ route('pesan.index', 'kasur') }}"
       class="inline-block bg-[#20cfff] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#006eb7]">
        Pesan Sekarang
    </a>
</section>
@endsection
