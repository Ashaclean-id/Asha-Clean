@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10 flex items-center justify-center">
    <div class="max-w-md w-full px-4">
        
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
            
            <div class="bg-blue-600 p-8 text-center text-white">
                <p class="text-blue-100 text-xs font-bold uppercase tracking-wider mb-1">Total Tagihan</p>
                <h1 class="text-4xl font-extrabold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</h1>
            </div>

            <div class="p-8">
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between py-3 border-b border-slate-100">
                        <span class="text-slate-500">ID Pesanan</span>
                        <span class="font-bold text-slate-800">#{{ $booking->id }}</span>
                    </div>
                    
                    <div class="flex justify-between py-3 border-b border-slate-100">
                        <span class="text-slate-500">Layanan Utama</span>
                        <span class="font-bold text-slate-800 text-right">{{ $booking->service->name }}</span>
                    </div>

                    @if($booking->items->count() > 0)
                    <div class="py-3 border-b border-slate-100">
                        <span class="text-slate-500 block mb-2">Rincian Item:</span>
                        <ul class="space-y-1 text-right">
                            @foreach($booking->items as $item)
                            <li class="flex justify-between text-xs">
                                <span class="text-slate-600">{{ $item->item_name }}</span>
                                <span class="font-medium">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="flex justify-between py-3 border-b border-slate-100">
                        <span class="text-slate-500">Jadwal</span>
                        <span class="font-bold text-slate-800">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }} • {{ $booking->booking_time }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between py-3 border-b border-slate-100">
                        <span class="text-slate-500">Nama Pemesan</span>
                        <span class="font-bold text-slate-800 uppercase">{{ $booking->name }}</span>
                    </div>
                </div>

                <button id="pay-button" class="w-full mt-8 py-4 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span>Bayar Sekarang</span>
                </button>
                
                <p class="text-center text-xs text-slate-400 mt-4">Pembayaran aman diproses oleh Midtrans.</p>
            </div>
        </div>

    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $booking->snap_token }}', {
            // Callback jika sukses
            onSuccess: function(result){
                window.location.href = "{{ route('pesan.success', $booking->id) }}";
            },
            // Callback jika pending
            onPending: function(result){
                alert("Menunggu pembayaran!");
                console.log(result);
            },
            // Callback jika error
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            }
        });
    };
</script>
@endsection