@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 mt-10">

    <div class="bg-white rounded-2xl shadow-sm border p-8">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-8">
            <div class="w-2 h-2 bg-[#20cfff] rounded-full"></div>
            <h2 class="text-lg font-semibold text-slate-800">
                Profile
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- AVATAR --}}
            <div class="flex flex-col items-center">
                <div class="relative">
                    <img
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=20cfff&color=fff"
                        class="w-32 h-32 rounded-xl shadow"
                    >
                    <button
                        class="absolute bottom-2 right-2 bg-white p-2 rounded-lg shadow hover:bg-gray-100">
                        📷
                    </button>
                </div>

                <div class="mt-6 flex gap-4">
                    <div class="border-2 border-dashed rounded-xl w-24 h-20 flex flex-col items-center justify-center text-xs text-slate-500">
                        LOGO
                    </div>

                    <div class="border-2 border-dashed rounded-xl w-32 h-20 flex flex-col items-center justify-center text-xs text-slate-500">
                        VENDOR<br>DOCUMENTS
                    </div>
                </div>
            </div>

            {{-- INFO --}}
            <div class="md:col-span-2 space-y-5">

                <div>
                    <p class="text-sm text-slate-500">Name:</p>
                    <p class="font-medium">{{ Auth::user()->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Email:</p>
                    <p class="font-medium">{{ Auth::user()->email }}</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Role:</p>
                    <span class="inline-block px-3 py-1 text-xs rounded-full
                        {{ Auth::user()->role === 'admin'
                            ? 'bg-red-100 text-red-600'
                            : 'bg-emerald-100 text-emerald-600' }}">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Phone Number:</p>
                    <p class="font-medium">-</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Address:</p>
                    <p class="font-medium">-</p>
                </div>

                <div class="pt-4">
                    <a href="#"
                       class="inline-flex items-center gap-2 px-6 py-2 rounded-lg
                              border border-[#20cfff] text-[#20cfff]
                              hover:bg-[#20cfff] hover:text-white transition">
                        ✏️ Edit Profile
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
