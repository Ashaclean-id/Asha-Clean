@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Detail Layanan</h1>
        <p class="text-sm text-slate-500">Buat layanan baru untuk ditampilkan di halaman depan.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 font-bold text-sm hover:bg-slate-50 transition">
            Batal
        </a>
        <button type="submit" form="service-form" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
            Simpan Perubahan
        </button>
    </div>
</div>

<form id="service-form" action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="grid grid-cols-12 gap-6">
        
        <div class="col-span-12 lg:col-span-8 space-y-6">
            
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-slate-800">Informasi Dasar</h3>
                    
                    <div class="flex items-center gap-3" x-data="{ active: true }">
                        <span class="text-xs font-bold uppercase" :class="active ? 'text-green-600' : 'text-slate-400'" x-text="active ? 'Status Layanan: Aktif' : 'Status Layanan: Nonaktif'"></span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked @click="active = !active">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Layanan</label>
                        <input type="text" name="name" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700" placeholder="Contoh: Residential Cleaning">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi Singkat</label>
                        <input type="text" name="short_description" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700" placeholder="Ringkasan pendek untuk kartu layanan...">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-800">Galeri Layanan</h3>
                    <button type="button" class="text-blue-600 text-sm font-bold hover:underline flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        Upload Foto
                    </button>
                </div>
                
                <div class="grid grid-cols-4 gap-4">
                    <div class="aspect-square bg-slate-100 rounded-lg border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 cursor-pointer hover:bg-slate-50 transition relative overflow-hidden group">
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        <span class="text-xs font-medium">Tambah Foto</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4">Deskripsi Lengkap</h3>
                <div class="flex gap-2 mb-2 border-b border-slate-100 pb-2">
                    <button type="button" class="p-1 hover:bg-slate-100 rounded text-slate-600 font-bold">B</button>
                    <button type="button" class="p-1 hover:bg-slate-100 rounded text-slate-600 italic">I</button>
                    <button type="button" class="p-1 hover:bg-slate-100 rounded text-slate-600 underline">U</button>
                </div>
                <textarea name="full_description" rows="6" class="w-full p-2 focus:outline-none text-slate-600 text-sm leading-relaxed" placeholder="Jelaskan detail layanan di sini..."></textarea>
            </div>
            
        </div>

        <div class="col-span-12 lg:col-span-4 space-y-6">
            
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4">Detail Layanan</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Harga (Mulai Dari)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 font-bold text-sm">Rp</span>
                            <input type="number" name="price" class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700 font-medium" placeholder="0">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Durasi (Jam)</label>
                            <input type="text" name="duration" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="2 - 4 Jam">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Jumlah Tim</label>
                            <input type="number" name="team_size" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" value="1">
                        </div>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm mt-6">
    <h3 class="font-bold text-slate-800 mb-4">Apa yang Anda Dapatkan?</h3>
    <p class="text-[10px] text-slate-400 mb-4">Edit teks poin keunggulan di sini.</p>

    @foreach(range(1, 4) as $i)
    <div class="mb-4 border-b border-slate-100 pb-4 last:border-0">
        <label class="block text-[10px] font-bold text-blue-500 uppercase mb-1">Poin {{ $i }}</label>
        <input type="text" name="benefit_{{ $i }}_title" 
               class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm mb-2 font-bold" 
               placeholder="Judul Poin {{ $i }}">
        <textarea name="benefit_{{ $i }}_desc" rows="2" 
                  class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" 
                  placeholder="Deskripsi singkat..."></textarea>
    </div>
    @endforeach
</div>
                    
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-200">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase">Rating (Read-Only)</label>
                        <div class="flex items-center gap-1 mt-1">
                            <span class="font-bold text-lg text-slate-800">0.0</span>
                            <div class="flex text-slate-300 text-sm">★★★★★</div>
                            <span class="text-xs text-slate-400 ml-1">(Belum ada ulasan)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm" x-data="{ showBtn: true, label: 'Pesan Sekarang' }">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-800">Pengaturan Pemesanan</h3>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="show_booking" value="1" class="sr-only peer" checked @click="showBtn = !showBtn">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Label Tombol</label>
                        <input type="text" name="booking_label" x-model="label" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Pesan Sekarang">
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <p class="text-[10px] text-center text-slate-400 mb-2">Preview Tampilan User</p>
                        <button type="button" class="w-full py-2 rounded-lg bg-blue-500 text-white font-bold text-sm shadow-md transition-opacity" 
                                :class="showBtn ? 'opacity-100' : 'opacity-50 cursor-not-allowed'" 
                                x-text="label">
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
@endsection