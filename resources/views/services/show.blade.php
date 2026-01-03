@extends('layouts.app')

@section('content')
<div class="bg-[#f8faff] min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">{{ $service->name }}</h1>
                @if($service->is_active)
                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Aktif</span>
                @endif
            </div>
            <p class="text-lg text-slate-600 max-w-3xl">{{ $service->short_description }}</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Durasi</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">{{ $service->duration ?? '-' }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Harga Mulai</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Tim</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">{{ $service->team_size }} Orang</p>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Rating</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">5.0/5.0</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg text-slate-800">Galeri Pengerjaan</h3>
                    </div>
                    <div class="h-64 md:h-80 rounded-xl overflow-hidden bg-slate-100 relative group">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-lg text-slate-800 mb-4">Deskripsi Layanan</h3>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-sm">
                        {!! nl2br(e($service->description ?? $service->full_description)) !!}
                    </div>
                </div>

                <form action="{{ route('pesan.index', $service->id) }}" method="GET" id="booking-form">
                    <div class="mt-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-1 h-8 bg-blue-600 rounded-full"></div>
                            <h3 class="text-xl font-bold text-slate-900">Pilih Paket / Ukuran</h3>
                        </div>

                        @if(!empty($service->pricelist) && count($service->pricelist) > 0)
                            <div class="space-y-4">
                                @foreach($service->pricelist as $item)
                                    @if(!empty($item['name']) && isset($item['price']))
                                    <div class="flex items-center justify-between p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-blue-500 hover:shadow-md transition group relative overflow-hidden select-none"
                                         onclick="addItem('{{ $item['name'] }}', {{ $item['price'] }})">
                                        
                                        <div>
                                            <h4 class="font-bold text-slate-700 group-hover:text-blue-600 transition uppercase">{{ $item['name'] }}</h4>
                                            <span class="text-blue-600 font-bold">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                        </div>
                                        
                                        <div class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition">
                                            + Tambah
                                        </div>
                                        
                                        <div class="absolute inset-0 bg-blue-50 opacity-0 active:opacity-20 transition-opacity"></div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
                                <div>
                                    <h4 class="font-bold text-slate-800">Paket Standar</h4>
                                    <p class="text-sm text-slate-500">Harga sesuai deskripsi layanan</p>
                                </div>
                                <span class="text-xl font-bold text-slate-900">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                <input type="hidden" name="default_service" value="1">
                            </div>
                        @endif

                        <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Harga dapat berubah sewaktu-waktu tergantung kondisi noda/kesulitan.
                        </p>
                    </div>
                    
                    <div id="hidden-inputs-container"></div>
                </form>

            </div>

            <div class="space-y-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-lg text-slate-800 mb-6">Apa yang Anda Dapatkan</h3>
                    <ul class="space-y-6">
                        @php
                            $defaults = [
                                ['title' => 'Peralatan Lengkap', 'desc' => 'Vacuum cleaner, steam mop, dll.'],
                                ['title' => 'Bahan Kimia Aman', 'desc' => 'Aman untuk anak & hewan peliharaan.'],
                                ['title' => 'Staf Terlatih', 'desc' => 'Melalui proses pelatihan ketat.'],
                                ['title' => 'Garansi Kepuasan', 'desc' => 'Pengerjaan ulang gratis 24 jam.']
                            ];
                            $benefits = $service->benefits ?? $defaults;
                        @endphp

                        @foreach($benefits as $index => $benefit)
                        <li class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">{{ $benefit['title'] }}</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $benefit['desc'] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-lg text-slate-800 mb-6">Alur Pengerjaan</h3>
                    <div class="relative pl-2">
                         <div class="absolute left-[15px] top-2 bottom-4 w-0.5 bg-slate-200"></div>
                        <div class="flex gap-4 mb-6 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shrink-0 ring-4 ring-white">1</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs uppercase text-blue-600 mb-1">Langkah 1</h4>
                                <h5 class="font-bold text-slate-800 text-sm">Persiapan & Inspeksi</h5>
                            </div>
                        </div>
                        <div class="flex gap-4 mb-6 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold shrink-0 ring-4 ring-white">2</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs uppercase text-slate-400 mb-1">Langkah 2</h4>
                                <h5 class="font-bold text-slate-800 text-sm">Proses Pembersihan</h5>
                            </div>
                        </div>
                         <div class="flex gap-4 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold shrink-0 ring-4 ring-white">3</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs uppercase text-slate-400 mb-1">Langkah 3</h4>
                                <h5 class="font-bold text-slate-800 text-sm">Finishing & Cek Hasil</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 sticky top-8 z-10">
                    <h3 class="font-bold text-slate-800 mb-4 pb-4 border-b flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Ringkasan Pilihan
                    </h3>
                    
                    <ul id="summary-list" class="space-y-3 text-sm text-slate-600 mb-6 max-h-40 overflow-y-auto">
                        <li class="text-slate-400 italic text-center py-2 bg-slate-50 rounded-lg">Belum ada layanan dipilih</li>
                    </ul>

                    <div class="flex justify-between items-center mb-6 pt-4 border-t border-dashed">
                        <span class="font-bold text-slate-600 text-sm">Total Estimasi</span>
                        <span class="font-extrabold text-2xl text-blue-600" id="total-display">Rp 0</span>
                    </div>

                    <button type="submit" form="booking-form" class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <span>Lanjut Pemesanan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                    <p class="text-[10px] text-center text-slate-400 mt-3">Lanjutkan untuk isi data diri & jadwal.</p>
                </div>

                <div class="bg-slate-900 rounded-2xl p-6 text-white text-center mt-6">
                    <h3 class="font-bold mb-2">Butuh Bantuan?</h3>
                    <p class="text-xs text-slate-400 mb-4">Hubungi manajer operasional untuk pertanyaan teknis.</p>
                    <a href="https://wa.me/{{ $setting->whatsapp_number ?? '' }}" class="inline-block px-4 py-2 bg-white text-slate-900 font-bold text-sm rounded-lg hover:bg-slate-100 transition">
                        Hubungi Support
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<div id="toast" class="fixed bottom-5 right-5 bg-slate-800 text-white px-6 py-3 rounded-xl shadow-2xl transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-3 pointer-events-none">
    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center shrink-0">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </div>
    <span id="toast-message" class="text-sm font-bold">Layanan ditambahkan</span>
</div>

<script>
    // Variable global untuk menyimpan item yang dipilih
    // Format: { 'NamaLayanan|Harga': Jumlah }
    let selectedItems = {}; 
    let basePrice = {{ (!empty($service->pricelist) && count($service->pricelist) > 0) ? 0 : $service->price }};

    function showToast(message) {
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-message');
        toastMsg.innerText = message;
        toast.classList.remove('translate-y-20', 'opacity-0');
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
        }, 1500);
    }

    // Fungsi Utama: Tambah Item (Dipanggil saat klik tombol paket)
    function addItem(name, price) {
        const key = name + '|' + price;
        
        // Tambah jumlah
        if (selectedItems[key]) {
            selectedItems[key]++;
        } else {
            selectedItems[key] = 1;
        }

        updateUI();
        showToast(name + ' ditambahkan');
    }

    // Fungsi Kurang Item (Dipanggil dari list ringkasan)
    function removeItem(name, price) {
        const key = name + '|' + price;
        
        if (selectedItems[key]) {
            selectedItems[key]--;
            if (selectedItems[key] <= 0) {
                delete selectedItems[key];
            }
        }
        updateUI();
    }

    // Update Tampilan (Ringkasan & Total & Input Hidden)
    function updateUI() {
        const summaryList = document.getElementById('summary-list');
        const totalDisplay = document.getElementById('total-display');
        const hiddenInputsContainer = document.getElementById('hidden-inputs-container');

        summaryList.innerHTML = '';
        hiddenInputsContainer.innerHTML = ''; // Reset input hidden
        
        let total = basePrice;
        let hasItem = false;

        // Loop item yang ada di keranjang
        for (const [key, qty] of Object.entries(selectedItems)) {
            hasItem = true;
            const [name, priceStr] = key.split('|');
            const price = parseFloat(priceStr);
            const subtotal = price * qty;
            total += subtotal;

            // 1. Tampilkan di List Ringkasan
            const li = document.createElement('li');
            li.className = 'flex justify-between items-center border-b border-slate-50 pb-2 last:border-0';
            li.innerHTML = `
                <div class="flex-1">
                    <div class="flex justify-between">
                        <span class="font-medium text-slate-700">${name}</span>
                        <span class="font-bold text-slate-800">Rp ${(price * qty).toLocaleString('id-ID')}</span>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <button type="button" onclick="removeItem('${name}', ${price})" class="w-5 h-5 rounded bg-slate-100 text-slate-500 hover:bg-red-100 hover:text-red-600 flex items-center justify-center font-bold text-xs">-</button>
                        <span class="text-xs text-slate-500">x${qty}</span>
                        <button type="button" onclick="addItem('${name}', ${price})" class="w-5 h-5 rounded bg-slate-100 text-slate-500 hover:bg-blue-100 hover:text-blue-600 flex items-center justify-center font-bold text-xs">+</button>
                    </div>
                </div>
            `;
            summaryList.appendChild(li);

            // 2. Buat Input Hidden (Agar terkirim ke server)
            // Kita loop sebanyak QTY agar controller menerima array item terpisah
            // Atau kirim qty-nya (tergantung controller kamu).
            // Agar aman dengan controller sebelumnya, kita kirim item terpisah (berulang).
            for(let i=0; i<qty; i++) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'custom_items[]';
                input.value = key; // Kirim "Nama|Harga"
                hiddenInputsContainer.appendChild(input);
            }
        }

        // Tampilan Kosong
        if (!hasItem) {
            if (basePrice > 0) {
                 summaryList.innerHTML = '<li class="flex justify-between items-center"><span class="font-medium">Paket Standar</span> <span class="font-bold text-slate-800">Rp '+basePrice.toLocaleString('id-ID')+'</span></li>';
            } else {
                summaryList.innerHTML = '<li class="text-slate-400 italic text-center py-2 bg-slate-50 rounded-lg">Belum ada layanan dipilih</li>';
            }
        }

        totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Init saat load (siapa tahu ada harga dasar)
    document.addEventListener("DOMContentLoaded", function() {
        updateUI();
    });
</script>
@endsection