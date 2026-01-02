@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-20">
    <div class="max-w-2xl mx-auto px-6">
        
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            
            <div class="bg-blue-600 px-8 py-6 text-center">
                <p class="text-blue-100 text-sm font-medium uppercase tracking-wider mb-1">Total Tagihan</p>
                <h1 class="text-4xl font-extrabold text-white">
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </h1>
            </div>

            <div class="p-8">
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between border-b border-slate-100 pb-4">
                        <span class="text-slate-500">ID Pesanan</span>
                        <span class="font-mono font-bold text-slate-700">#{{ $booking->id }}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-4">
                        <span class="text-slate-500">Layanan</span>
                        <span class="font-bold text-slate-800">{{ $booking->service->name }}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-4">
                        <span class="text-slate-500">Jadwal</span>
                        <span class="font-bold text-slate-800">
                            {{ date('d M Y', strtotime($booking->booking_date)) }} • {{ $booking->booking_time }}
                        </span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-4">
                        <span class="text-slate-500">Nama Pemesan</span>
                        <span class="font-bold text-slate-800">{{ $booking->name }}</span>
                    </div>
                </div>

                <button id="pay-button" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-lg shadow-lg shadow-blue-200 transition transform active:scale-95 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    Bayar Sekarang
                </button>
                
                <p class="text-center text-xs text-slate-400 mt-4">
                    Pembayaran aman diproses oleh Midtrans.
                </p>
            </div>
        </div>

    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    
    payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $booking->snap_token }}', {
            
            // 1. Jika Sukses Bayar
            onSuccess: function(result){
                // Redirect ke halaman Nota Sukses
                window.location.href = "{{ route('booking.success', $booking->id) }}";
            },
            
            // 2. Jika Pending (Misal: User pilih Indomaret tapi belum bayar)
            onPending: function(result){
                alert("Menunggu pembayaran Anda!");
                window.location.href = "{{ route('home.landing') }}";
            },
            
            // 3. Jika Error
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            },

            // 4. Jika User Tutup Popup tanpa bayar
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>
@endsection