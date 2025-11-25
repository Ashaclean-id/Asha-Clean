@extends('layouts.app')

@section('content')
<section class="py-20 max-w-6xl mx-auto px-6">
    <h1 class="text-4xl font-bold mb-10">Layanan Kebersihan Asha Clean</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="p-6 bg-white rounded-2xl shadow">
            <h2 class="text-xl font-semibold mb-3">General Cleaning</h2>
            <p class="text-gray-700">Pembersihan rutin untuk rumah & kantor.</p>
        </div>

        <div class="p-6 bg-white rounded-2xl shadow">
            <h2 class="text-xl font-semibold mb-3">Deep Cleaning</h2>
            <p class="text-gray-700">Pembersihan menyeluruh hingga ke area tersembunyi.</p>
        </div>

        <div class="p-6 bg-white rounded-2xl shadow">
            <h2 class="text-xl font-semibold mb-3">Office Cleaning</h2>
            <p class="text-gray-700">Kebersihan area kerja yang rapi & higienis.</p>
        </div>

    </div>
</section>
@endsection
