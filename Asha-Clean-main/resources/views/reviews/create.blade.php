@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-20">
    <div class="max-w-2xl mx-auto px-6">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h1 class="text-2xl font-bold text-slate-800 mb-2">Bagikan Pengalaman Anda</h1>
            <p class="text-slate-500 mb-8">Ulasan Anda sangat berarti bagi kami untuk terus meningkatkan kualitas layanan.</p>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Layanan yang digunakan</label>
                    <select name="service_id" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">-- Pilih Layanan (Opsional) --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6" x-data="{ rating: 5 }">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Berikan Rating</label>
                    <div class="flex gap-2">
                        <input type="hidden" name="rating" x-model="rating">
                        
                        @foreach(range(1, 5) as $i)
                        <button type="button" @click="rating = {{ $i }}" class="focus:outline-none transition transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" 
                                 :class="rating >= {{ $i }} ? 'text-yellow-400 fill-current' : 'text-slate-300'" 
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.784.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </button>
                        @endforeach
                    </div>
                    <p class="text-sm text-slate-400 mt-2" x-text="rating + ' dari 5 Bintang'"></p>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Ceritakan Pengalaman Anda</label>
                    <textarea name="content" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Pelayanannya ramah, hasil bersih banget..." required></textarea>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('home.landing') }}" class="w-1/3 py-3 rounded-xl border border-slate-300 text-slate-600 font-bold text-center hover:bg-slate-50 transition">Batal</a>
                    <button type="submit" class="w-2/3 py-3 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition">
                        Kirim Ulasan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection