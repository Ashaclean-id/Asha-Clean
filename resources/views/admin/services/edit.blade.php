@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Edit Layanan</h2>
        <p class="text-sm text-slate-500 mt-1">Perbarui informasi layanan: <span class="font-bold text-blue-600">{{ $service->name }}</span></p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 font-bold text-sm hover:bg-slate-50 transition">
            Batal
        </a>
        <button type="submit" form="edit-service-form" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-200">
            Simpan Perubahan
        </button>
    </div>
</div>

<form id="edit-service-form" action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <div class="grid grid-cols-12 gap-6">
        
        <div class="col-span-12 lg:col-span-8 space-y-6">
            
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-slate-800">Informasi Dasar</h3>
                    
                    <div class="flex items-center gap-3" x-data="{ active: {{ $service->is_active ? 'true' : 'false' }} }">
                        <span class="text-[10px] font-bold uppercase tracking-wider" 
                              :class="active ? 'text-green-600' : 'text-slate-400'" 
                              x-text="active ? 'Status: Aktif' : 'Status: Nonaktif'"></span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $service->is_active ? 'checked' : '' }} @click="active = !active">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Layanan</label>
                        <input type="text" name="name" value="{{ old('name', $service->name) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700 font-medium" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi Singkat</label>
                        <input type="text" name="short_description" value="{{ old('short_description', $service->short_description) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-800">Galeri Layanan</h3>
                    <span class="text-xs text-slate-400">*Biarkan kosong jika tidak ingin mengganti gambar</span>
                </div>
                
                <div class="flex gap-6 items-start">
                    @if($service->image)
                    <div class="w-32 h-32 shrink-0 rounded-xl overflow-hidden border border-slate-200 relative group">
                        <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-white text-xs opacity-0 group-hover:opacity-100 transition">
                            Gambar Saat Ini
                        </div>
                    </div>
                    @endif

                    <div class="flex-1 border-2 border-dashed border-slate-300 rounded-xl p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:bg-slate-50 transition relative group h-32">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 mb-2 group-hover:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span class="text-xs font-bold text-slate-500 group-hover:text-blue-600">Klik untuk ganti gambar baru</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4">Deskripsi Lengkap</h3>
                <textarea name="full_description" rows="6" class="w-full p-4 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-600 text-sm leading-relaxed">{{ old('full_description', $service->full_description) }}</textarea>
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
                            <input type="number" name="price" value="{{ (int) $service->price }}" class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700 font-bold" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Durasi</label>
                            <input type="text" name="duration" value="{{ old('duration', $service->duration) }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Jml Tim</label>
                            <input type="number" name="team_size" value="{{ old('team_size', $service->team_size) }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm" x-data="{ showBtn: {{ $service->show_booking ? 'true' : 'false' }}, label: '{{ $service->booking_label }}' }">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-800">Pengaturan Booking</h3>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="show_booking" value="1" class="sr-only peer" {{ $service->show_booking ? 'checked' : '' }} @click="showBtn = !showBtn">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Label Tombol</label>
                        <input type="text" name="booking_label" x-model="label" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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

@endsection