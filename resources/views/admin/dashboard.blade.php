@extends('layouts.app')

@section('content')
<div class="bg-[#eaf6f4] min-h-screen p-10">

    <h1 class="text-3xl font-extrabold text-slate-800 mb-10">
        Dashboard Admin
    </h1>

    <!-- STATS -->
    <div class="grid md:grid-cols-4 gap-6 mb-10">
        @foreach ([
            ['Total Ulasan', '245'],
            ['Rating Rata-rata', '4.7 ⭐'],
            ['Ulasan Pending', '12'],
            ['Total User', '1.204']
        ] as $stat)
        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-500">{{ $stat[0] }}</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stat[1] }}</h3>
        </div>
        @endforeach
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow p-8">
        <h2 class="text-xl font-bold text-slate-800 mb-6">
            Ulasan Terbaru
        </h2>

        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-500 border-b">
                    <th class="py-3">User</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-4 font-semibold">Waode</td>
                    <td>★★★★★</td>
                    <td class="max-w-md">
                        Sangat puas dengan layanan AshaClean!
                    </td>
                    <td>
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                            Pending
                        </span>
                    </td>
                    <td class="space-x-2">
                        <button class="px-4 py-2 bg-[#20cfff] text-white rounded-lg">
                            Approve
                        </button>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
