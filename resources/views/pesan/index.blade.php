@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 mb-6 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Detail Layanan
        </a>

        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6">
            <p class="font-bold">Ada data yang belum lengkap:</p>
            <ul class="list-disc list-inside text-sm mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('error'))
<div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <div>
        <p class="font-bold">Gagal Memproses:</p>
        <p class="text-sm">{{ session('error') }}</p>
    </div>
</div>
@endif

        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
                    <h1 class="text-2xl font-bold text-slate-800 mb-2">Lengkapi Pesanan</h1>
                    <p class="text-slate-500 text-sm mb-8">Isi data diri Anda agar tim kami dapat segera meluncur ke lokasi.</p>

                    <form action="{{ route('pesan.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nomor WhatsApp</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold text-sm">+62</span>
                                <input type="number" name="phone" value="{{ old('phone') }}" class="w-full pl-14 pr-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="81234567890" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Tanggal Booking</label>
                                <input type="date" name="booking_date" value="{{ old('booking_date') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-600" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Jam Kedatangan</label>
                                <select name="booking_time" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-600 bg-white" required>
                                    <option value="">Pilih Jam</option>
                                    <option value="08:00" {{ old('booking_time') == '08:00' ? 'selected' : '' }}>08:00 WIB</option>
                                    <option value="09:00" {{ old('booking_time') == '09:00' ? 'selected' : '' }}>09:00 WIB</option>
                                    <option value="10:00" {{ old('booking_time') == '10:00' ? 'selected' : '' }}>10:00 WIB</option>
                                    <option value="11:00" {{ old('booking_time') == '11:00' ? 'selected' : '' }}>11:00 WIB</option>
                                    <option value="13:00" {{ old('booking_time') == '13:00' ? 'selected' : '' }}>13:00 WIB</option>
                                    <option value="14:00" {{ old('booking_time') == '14:00' ? 'selected' : '' }}>14:00 WIB</option>
                                    <option value="15:00" {{ old('booking_time') == '15:00' ? 'selected' : '' }}>15:00 WIB</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Alamat Lengkap</label>
                            <textarea name="address" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Nama Jalan, Nomor Rumah..." required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Misal: Pagar warna hitam...">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition flex items-center justify-center gap-2">
                            <span>Konfirmasi Pemesanan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sticky top-8">
                    <h3 class="font-bold text-slate-800 mb-4 border-b border-slate-100 pb-4">Ringkasan Pesanan</h3>
                    
                    <div class="flex gap-4 mb-6">
                        <div class="w-16 h-16 rounded-lg bg-slate-100 shrink-0 overflow-hidden border border-slate-200">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm leading-tight mb-1">{{ $service->name }}</h4>
                            <p class="text-xs text-slate-500">{{ $service->duration ?? '-' }} • {{ $service->team_size }} Orang</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm text-slate-600 mb-6">
                        <div class="border-t border-dashed border-slate-200 my-2 pt-2 flex justify-between items-center text-slate-800">
                            <span class="font-bold">Total Estimasi</span>
                            <span class="font-extrabold text-xl text-blue-600">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-xl flex gap-3 items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Lanjutkan untuk memilih metode pembayaran (QRIS, GoPay, BCA, dll).
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection