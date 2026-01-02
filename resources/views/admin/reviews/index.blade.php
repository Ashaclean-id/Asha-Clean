@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Reviews & Testimonials</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola masukan dan ulasan pelanggan.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-500 font-medium mb-1">Total Ulasan</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalReviews) }}</h3>
        </div>
        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-500 font-medium mb-1">Rata-rata Rating</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ number_format($avgRating, 1) }}</h3>
        </div>
        <div class="p-3 bg-yellow-50 text-yellow-500 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-500 font-medium mb-1">Perlu Persetujuan</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $pendingReviews }}</h3>
            @if($pendingReviews > 0)
                <p class="text-xs text-orange-500 font-bold mt-1">Butuh perhatian!</p>
            @endif
        </div>
        <div class="p-3 bg-orange-50 text-orange-500 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs border-b border-slate-100">
            <tr>
                <th class="px-6 py-4">Customer</th>
                <th class="px-6 py-4">Rating</th>
                <th class="px-6 py-4 w-1/3">Ulasan</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($reviews as $review)
            <tr class="hover:bg-slate-50 transition group">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold uppercase border border-slate-200">
                            {{ substr($review->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">{{ $review->name }}</p>
                            <p class="text-xs text-slate-400">{{ $review->email ?? 'No Email' }}</p>
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4">
                    <div class="flex text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ★
                            @else
                                <span class="text-slate-200">★</span>
                            @endif
                        @endfor
                    </div>
                    @if($review->service)
                        <p class="text-[10px] text-slate-400 mt-1">Layanan: {{ $review->service->name }}</p>
                    @endif
                </td>

                <td class="px-6 py-4">
                    <p class="text-slate-600 leading-relaxed text-sm line-clamp-2 group-hover:line-clamp-none transition-all">
                        "{{ $review->content }}"
                    </p>
                    <p class="text-[10px] text-slate-400 mt-2">{{ $review->created_at->format('d M Y, H:i') }}</p>
                </td>

                <td class="px-6 py-4">
                    @if($review->status == 'approved')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                            Active
                        </span>
                    @elseif($review->status == 'pending')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                            Pending
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-800 border border-slate-200">
                            Hidden
                        </span>
                    @endif
                </td>

                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        @if($review->status == 'pending' || $review->status == 'hidden')
                            <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition shadow-sm">
                                    Approve
                                </button>
                            </form>
                        @endif

                        @if($review->status == 'approved')
                            <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="hidden">
                                <button type="submit" class="p-2 text-slate-400 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition" title="Sembunyikan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini permanen?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                    <p>Belum ada ulasan yang masuk.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection