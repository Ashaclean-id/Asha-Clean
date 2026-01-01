@extends('layouts.admin')

@section('content')

<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-800">Dashboard Content Management</h2>
    <p class="text-slate-500 text-sm mt-1 max-w-2xl">
        Customize the layout, hero messaging, and visible modules for the customer-facing dashboard. Changes are saved as drafts until published.
    </p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        Hero Section Configuration
                    </h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-slate-400 font-medium">Visibility</span>
                        <div class="w-10 h-5 bg-blue-500 rounded-full relative"><div class="w-3 h-3 bg-white rounded-full absolute right-1 top-1"></div></div>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2">Hero Headline</label>
                        <input type="text" name="hero_title" value="{{ $setting->hero_title ?? '' }}" class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-blue-500 outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-2">Description Subtext</label>
                        <textarea name="hero_description" rows="3" class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-blue-500 outline-none bg-slate-50/50 leading-relaxed">{{ $setting->hero_description ?? '' }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-3">Tambahkan Promo Today</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="p-3 border border-slate-200 rounded-xl bg-slate-50">
                                <span class="text-[10px] font-bold text-blue-500 mb-1 block">SLOT 1</span>
                                <input type="text" name="promo_1_text" value="{{ $setting->promo_1_text ?? '' }}" placeholder="Judul..." class="w-full px-2 py-1 mb-2 rounded border text-sm">
                                <input type="file" name="promo_1_image" class="text-[10px] w-full">
                            </div>
                            <div class="p-3 border border-slate-200 rounded-xl bg-slate-50">
                                <span class="text-[10px] font-bold text-orange-500 mb-1 block">SLOT 2</span>
                                <input type="text" name="promo_2_text" value="{{ $setting->promo_2_text ?? '' }}" placeholder="Judul..." class="w-full px-2 py-1 mb-2 rounded border text-sm">
                                <input type="file" name="promo_2_image" class="text-[10px] w-full">
                            </div>
                            <div class="p-3 border border-slate-200 rounded-xl bg-slate-50">
                                <span class="text-[10px] font-bold text-purple-500 mb-1 block">SLOT 3</span>
                                <input type="text" name="promo_3_text" value="{{ $setting->promo_3_text ?? '' }}" placeholder="Judul..." class="w-full px-2 py-1 mb-2 rounded border text-sm">
                                <input type="file" name="promo_3_image" class="text-[10px] w-full">
                            </div>
                        </div>
                        <p class="mt-2 text-[10px] text-slate-400">*Tips: Kosongkan teks jika slot tidak ingin ditampilkan.</p>
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
    <h3 class="font-bold text-slate-800 mb-1">Dashboard Sections</h3>
    <p class="text-xs text-slate-400 mb-6">Control which modules appear on the user dashboard.</p>

    <div class="space-y-4">
        
        <div class="flex items-center justify-between p-4 border border-slate-100 rounded-xl bg-white hover:bg-slate-50/50 transition">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Ulasan Pelanggan</h4>
                    <p class="text-xs text-slate-400">Section testimoni di halaman utama</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3" x-data="{ on: {{ $setting->show_ulasan ? 'true' : 'false' }} }">
                <span class="px-2 py-1 text-[10px] font-bold rounded uppercase tracking-wide transition-colors"
                      :class="on ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500'">
                    <span x-text="on ? 'Active' : 'Inactive'"></span>
                </span>
                
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="show_ulasan" value="1" class="sr-only peer" 
                           @click="on = !on" {{ $setting->show_ulasan ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 transition-colors"></div>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-between p-4 border border-slate-100 rounded-xl bg-white hover:bg-slate-50/50 transition">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Promotions Banner</h4>
                    <p class="text-xs text-slate-400">Seasonal discount offers</p>
                </div>
            </div>

            <div class="flex items-center gap-3" x-data="{ on: {{ $setting->show_promotions ? 'true' : 'false' }} }">
                <span class="px-2 py-1 text-[10px] font-bold rounded uppercase tracking-wide transition-colors"
                      :class="on ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500'">
                    <span x-text="on ? 'Active' : 'Inactive'"></span>
                </span>
                
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="show_promotions" value="1" class="sr-only peer" 
                           @click="on = !on" {{ $setting->show_promotions ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 transition-colors"></div>
                </label>
            </div>
        </div>

        <div class="p-4 border border-slate-100 rounded-xl bg-white hover:bg-slate-50/50 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center text-rose-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-800">Quick Support</h4>
                        <p class="text-xs text-slate-400">Direct chat widget</p>
                    </div>
                </div>

                <div class="flex items-center gap-3" x-data="{ on: {{ $setting->show_quick_support ? 'true' : 'false' }} }">
                    <span class="px-2 py-1 text-[10px] font-bold rounded uppercase tracking-wide transition-colors"
                          :class="on ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500'">
                        <span x-text="on ? 'Active' : 'Inactive'"></span>
                    </span>
                    
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="show_quick_support" value="1" class="sr-only peer" 
                               @click="on = !on" {{ $setting->show_quick_support ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 transition-colors"></div>
                    </label>
                </div>
            </div>

            <div class="bg-slate-50 p-3 rounded-lg border border-slate-200">
                <label class="block text-[10px] font-bold text-slate-500 mb-1 uppercase">Nomor WhatsApp Admin</label>
                <div class="flex items-center">
                    <span class="bg-slate-200 text-slate-600 text-sm px-3 py-2 rounded-l-lg border border-r-0 border-slate-300 font-bold">62</span>
                    <input type="number" name="whatsapp_number" value="{{ $setting->whatsapp_number }}" placeholder="812xxxxxxx" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700 font-medium">
                </div>
                <p class="text-[10px] text-slate-400 mt-1">*Masukkan nomor tanpa awalan 0 atau 62.</p>
            </div>
        </div>

    </div>
</div>
            </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm sticky top-28">
                <h3 class="font-bold text-slate-800 mb-4">Publish Status</h3>
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-sm font-semibold text-slate-700">Live Version 2.4</span>
                </div>
                <div class="space-y-3">
                    <button type="submit" class="w-full py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-bold text-sm transition shadow-md shadow-blue-200">Publish Changes</button>
                    <button type="reset" class="w-full py-3 border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-lg font-bold text-sm transition">Cancel</button>
                </div>
            </div>
        </div>
        
    </div>
</form>

@endsection