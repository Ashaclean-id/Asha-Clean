@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-4">Cuci Sofa, Kasur & Karpet</h1>

    <div class="bg-white shadow-md p-6 rounded-xl border">
        <p class="text-gray-700 mb-6">
            Layanan Cuci Sofa, Kasur & Karpet kami mencakup pencucian mendalam, pengangkatan noda dan debu, serta pengeringan hingga lembap aman dan siap digunakan.
        </p>

        {{-- ALERT STYLE PERSIS SEPERTI GAMBAR --}}
        <div class="border p-6 rounded-xl space-y-6">

            {{-- Efektif Untuk --}}
            <div>
                <h3 class="font-semibold text-lg mb-3">Efektif Untuk</h3>
                <div class="flex space-x-3">
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Noda</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Debu</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Bau</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Tungau</span>
                </div>
            </div>

            {{-- Benda --}}
            <div>
                <h3 class="font-semibold text-lg mb-3">Benda yang Dibersihkan</h3>
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Kasur</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Sofa</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Bantal</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Karpet</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Kursi</span>
                </div>
            </div>

            {{-- Alat --}}
            <div>
                <h3 class="font-semibold text-lg mb-3">Alat yang Disediakan</h3>
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Hydro Vacuum</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Water Tank</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Filter</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Cairan Pembersih</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-lg">Blower</span>
                </div>
            </div>

        </div>

        <div class="flex justify-between mt-6">
            <a href="/"
             class="px-6 py-3 border rounded-xl">Kembali</a>
            <a href="{{ route('pesan.index', 'sofa_kain') }}"
   class="px-6 py-3 bg-slate-800 text-white rounded-xl">
    Pesan Sekarang
</a>
        </div>

    </div>

</div>
@endsection
