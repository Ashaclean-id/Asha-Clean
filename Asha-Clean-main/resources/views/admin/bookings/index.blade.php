@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Data Pesanan Masuk</h2>
        <p class="text-sm text-slate-500 mt-1">Pantau semua booking layanan dari customer.</p>
    </div>
</div>

@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
    <span class="font-medium">Sukses!</span> {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                <tr>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Layanan</th>
                    <th class="px-6 py-4">Jadwal</th>
                    <th class="px-6 py-4">Alamat</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($bookings as $booking)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $booking->name }}</div>
                        <div class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            {{ $booking->phone }}
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold border border-blue-100">
                            {{ $booking->service->name ?? 'Layanan Dihapus' }}
                        </span>
                        <div class="text-xs text-slate-500 mt-1 font-mono">
                            ID: #{{ $booking->id }}
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-700">
                            {{ date('d M Y', strtotime($booking->booking_date)) }}
                        </div>
                        <div class="text-xs text-slate-500">
                            Jam: {{ $booking->booking_time }}
                        </div>
                    </td>

                    <td class="px-6 py-4 max-w-xs">
                        <p class="truncate text-slate-600" title="{{ $booking->address }}">
                            {{ Str::limit($booking->address, 30) }}
                        </p>
                        @if($booking->notes)
                            <p class="text-[10px] text-orange-500 italic mt-1">Note: {{ Str::limit($booking->notes, 20) }}</p>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" 
                                class="text-xs font-bold px-3 py-1 rounded-full border-0 cursor-pointer focus:ring-0
                                {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $booking->status == 'confirmed' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $booking->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                                ">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Konfirmasi</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </form>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="https://wa.me/{{ $booking->phone }}" target="_blank" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="Chat Customer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            </a>

                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Hapus data pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus Data">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        <p>Belum ada pesanan masuk.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection