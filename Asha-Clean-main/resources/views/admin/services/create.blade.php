@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Tambah Layanan</h2>
        <p class="text-sm text-slate-500 mt-1">Buat layanan baru untuk ditampilkan di halaman depan.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 font-bold text-sm hover:bg-slate-50 transition">
            Batal
        </a>
        <button type="submit" form="service-form" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-200">
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
                        <span class="text-[10px] font-bold uppercase tracking-wider" 
                              :class="active ? 'text-green-600' : 'text-slate-400'" 
                              x-text="active ? 'Status: Aktif' : 'Status: Nonaktif'"></span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked @click="active = !active">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Layanan</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700 font-bold" placeholder="Contoh: Residential Cleaning" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi Singkat</label>
                        <input type="text" name="short_description" value="{{ old('short_description') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700" placeholder="Ringkasan pendek untuk kartu layanan...">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-800">Galeri Layanan</h3>
                    <span class="text-xs text-slate-400">*Format: JPG, PNG, WEBP (Max 2MB)</span>
                </div>
                
                <div class="border-2 border-dashed border-slate-300 rounded-xl p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:bg-slate-50 transition relative group">
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700">Klik untuk upload gambar</p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4">Deskripsi Lengkap</h3>
                <div class="flex gap-2 mb-2 border-b border-slate-100 pb-2">
                    <button type="button" class="p-1 hover:bg-slate-100 rounded text-slate-600 font-bold">B</button>
                    <button type="button" class="p-1 hover:bg-slate-100 rounded text-slate-600 italic">I</button>
                    <button type="button" class="p-1 hover:bg-slate-100 rounded text-slate-600 underline">U</button>
                </div>
                <textarea name="full_description" rows="6" class="w-full p-2 focus:outline-none text-slate-600 text-sm leading-relaxed" placeholder="Jelaskan detail layanan di sini...">{{ old('full_description') }}</textarea>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <div class="mb-4">
                    <h3 class="font-bold text-slate-800">Apa yang Anda Dapatkan?</h3>
                    <p class="text-sm text-slate-500">Poin-poin keunggulan layanan ini (Peralatan, Chemical, Staf, dll).</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(range(1, 4) as $i)
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-xs font-bold text-blue-600 uppercase">Poin Keunggulan {{ $i }}</label>
                            <span class="text-[10px] text-slate-400 font-mono">#{{ $i }}</span>
                        </div>
                        
                        <input type="text" name="benefit_{{ $i }}_title" 
                               value="{{ old('benefit_'.$i.'_title') }}"
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm font-bold mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Judul (ex: Peralatan Lengkap)">
                        
                        <textarea name="benefit_{{ $i }}_desc" rows="3" 
                                  class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                  placeholder="Deskripsi singkat...">{{ old('benefit_'.$i.'_desc') }}</textarea>
                    </div>
                    @endforeach
                </div>
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
                            <input type="number" name="price" value="{{ old('price') }}" class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700 font-bold" placeholder="0" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Durasi</label>
                            <input type="text" name="duration" value="{{ old('duration') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="2 - 4 Jam">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Jumlah Tim</label>
                            <input type="number" name="team_size" value="{{ old('team_size', 1) }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
                        </div>
                    </div>

                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 mt-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase">Rating Awal</label>
                        <div class="flex items-center gap-1 mt-1">
                            <span class="font-bold text-lg text-slate-800">5.0</span>
                            <div class="flex text-yellow-400 text-sm">★★★★★</div>
                            <span class="text-xs text-slate-400 ml-1">(Baru)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-2">Daftar Harga Lengkap</h3>
                <p class="text-[10px] text-slate-400 mb-4">Isi variasi harga (Contoh: "Sofa 1 Dudukan"). Kosongkan jika tidak perlu.</p>

                <div class="space-y-3 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach(range(1, 10) as $i)
                    <div class="flex gap-2 items-center">
                        <span class="text-[10px] font-bold text-slate-400 w-4 text-center">{{ $i }}.</span>
                        
                        <input type="text" name="price_name_{{ $i }}" 
                               value="{{ old('price_name_'.$i) }}"
                               class="flex-1 px-3 py-2 border border-slate-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Item (ex: Cuci Karpet)">
                        
                        <div class="relative w-32 shrink-0">
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-slate-400 text-xs">Rp</span>
                            <input type="number" name="price_value_{{ $i }}" 
                                   value="{{ old('price_value_'.$i) }}"
                                   class="w-full pl-7 pr-2 py-2 border border-slate-300 rounded-lg text-xs font-bold text-right focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="0">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm" x-data="{ showBtn: true, label: 'Pesan Sekarang' }">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-800">Pengaturan Booking</h3>
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

                    <div class="pt-4 border-t border-slate-100">
                        <p class="text-[10px] text-center text-slate-400 mb-2 uppercase tracking-wide">Preview Tombol User</p>
                        <div class="w-full py-2 rounded-lg bg-blue-600 text-white font-bold text-sm shadow-md text-center transition-opacity duration-300" 
                             :class="showBtn ? 'opacity-100' : 'opacity-50 cursor-not-allowed'">
                            <span x-text="label"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9; 
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1; 
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8; 
    }
</style>

@endsection