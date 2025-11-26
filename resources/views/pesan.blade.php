
@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white min-h-screen flex flex-col">

    {{-- HEADER --}}
    <div class="flex items-center gap-3 p-4 border-b">
        <img src="/images/asha-clean-logo.png" class="w-10 h-10" alt="Asha Clean Logo">
        <h1 class="text-xl font-bold text-slate-800">Pesan Layanan</h1>
    </div>

    <div class="p-4 flex-1 overflow-y-auto pb-40">

        {{-- NAMA LAYANAN --}}
        <div class="mb-5">
            <h2 class="text-lg font-semibold">Cuci Sofa / Kasur / Karpet</h2>
            <p class="text-sm text-slate-600">Pilih ukuran dan jenis layanan yang kamu butuhkan.</p>
        </div>

        {{-- FORM PEMESAN --}}
        <div class="bg-slate-50 p-4 rounded-xl border mb-5">
            <h3 class="text-md font-bold mb-3">Data Pemesan</h3>

            <label class="text-sm font-semibold">Nama Lengkap</label>
            <input type="text" class="w-full mt-1 mb-3 px-3 py-2 border rounded-lg" placeholder="Masukkan nama lengkap">

            <label class="text-sm font-semibold">Nomor HP</label>
            <input type="text" class="w-full mt-1 mb-3 px-3 py-2 border rounded-lg" placeholder="08xxxxxxxxxx">

            <input type="text" id="lokasi" name="lokasi"
            class="w-full p-3 border rounded-xl"
            placeholder="Masukkan lokasi secara manual atau pilih dari Maps" />
        </div>

        {{-- DETAIL PEMESANAN --}}
        <div class="bg-slate-50 p-4 rounded-xl border mb-5">
            <h3 class="text-md font-bold mb-3">Detail Pemesanan</h3>

            {{-- Layanan Sofa Kain --}}
            <label class="block text-sm font-semibold mb-1">Sofa Kain</label>
            <select id="sofa_kain" class="w-full px-3 py-2 border rounded-lg mb-3">
                <option value="">Pilih ukuran</option>
                <option value="60000">Ukuran S - Rp 60.000</option>
                <option value="70000">Ukuran M - Rp 70.000</option>
                <option value="80000">Ukuran L - Rp 80.000</option>
            </select>

            {{-- Sofabed Kain --}}
            <label class="block text-sm font-semibold mb-1">Sofabed Kain</label>
            <select id="sofabed_kain" class="w-full px-3 py-2 border rounded-lg mb-3">
                <option value="">Pilih ukuran</option>
                <option value="200000">Ukuran S - Rp 200.000</option>
                <option value="250000">Ukuran M - Rp 250.000</option>
                <option value="300000">Ukuran L - Rp 300.000</option>
            </select>

            {{-- Sofa Kulit --}}
            <label class="block text-sm font-semibold mb-1">Sofa Kulit / Artificial</label>
            <select id="sofa_kulit" class="w-full px-3 py-2 border rounded-lg mb-3">
                <option value="">Pilih ukuran</option>
                <option value="50000">Ukuran S - Rp 50.000</option>
                <option value="60000">Ukuran M - Rp 60.000</option>
                <option value="70000">Ukuran L - Rp 70.000</option>
            </select>

            {{-- Sofabed Kulit --}}
            <label class="block text-sm font-semibold mb-1">Sofabed Kulit / Artificial</label>
            <select id="sofabed_kulit" class="w-full px-3 py-2 border rounded-lg mb-3">
                <option value="">Pilih ukuran</option>
                <option value="175000">Ukuran S - Rp 175.000</option>
                <option value="225000">Ukuran M - Rp 225.000</option>
                <option value="275000">Ukuran L - Rp 275.000</option>
            </select>

            {{-- Sofa Relax --}}
            <label class="block text-sm font-semibold mb-1">Sofa Relax / Cherrs</label>
            <select id="sofa_relax" class="w-full px-3 py-2 border rounded-lg mb-3">
                <option value="">Pilih jenis</option>
                <option value="125000">Fabric - Rp 125.000</option>
                <option value="100000">Kulit / Artificial - Rp 100.000</option>
            </select>

                        {{-- RINCIAN HARGA --}}
            <div class="bg-slate-50 p-4 rounded-xl border mb-5">
                <h3 class="text-md font-bold mb-3">Rincian Harga</h3>
                <div id="ringkasan" class="text-sm text-slate-700 mb-2">
                    Belum ada layanan yang dipilih.
                </div>
                <div id="rincian_harga" class="text-sm font-bold text-slate-800">
                    Rp 0
                </div>
            </div>

                    <div class="sticky bottom-0 bg-white p-4 border-t mt-3">
            <div class="flex justify-between mb-2">
                <span class="font-semibold text-slate-700">Total</span>
                <span id="total_harga" class="font-bold text-blue-600">Rp 0</span>
            </div>

            <button class="w-full py-3 rounded-xl font-semibold text-white 
                bg-blue-300 hover:bg-[#006eb7] active:scale-[0.98] transition shadow-md">
                Pesan Sekarang
            </button>
        </div>

        </div>
    </div>





{{-- SCRIPT UNTUK HITUNG HARGA --}}
<script>
function updateSummary() {
    let layanan = [
        { id: "sofa_kain", nama: "Sofa Kain" },
        { id: "sofabed_kain", nama: "Sofabed Kain" },
        { id: "sofa_kulit", nama: "Sofa Kulit / Artificial" },
        { id: "sofabed_kulit", nama: "Sofabed Kulit / Artificial" },
        { id: "sofa_relax", nama: "Sofa Relax / Cherrs" },
    ];

    let ringkasan = "";
    let total = 0;

    layanan.forEach(item => {
        let value = document.getElementById(item.id).value;
        if (value) {
            ringkasan += `${item.nama} - Rp ${Number(value).toLocaleString()} <br>`;
            total += Number(value);
        }
    });

    document.getElementById("ringkasan").innerHTML = ringkasan || "Belum ada layanan yang dipilih.";

    document.getElementById("rincian_harga").innerHTML = "Rp " + total.toLocaleString();
    document.getElementById("total_harga").innerHTML = "Rp " + total.toLocaleString();
}

document.querySelectorAll("select").forEach(el => {
    el.addEventListener("change", updateSummary);
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_REAL_API_KEY&libraries=places"></script>

<script>
function initAutocomplete() {
    const input = document.getElementById("lokasi");

    const autocomplete = new google.maps.places.Autocomplete(input, {
        fields: ["formatted_address", "geometry", "name"],
        types: ["geocode"]
    });

    autocomplete.addListener("place_changed", function () {
        const place = autocomplete.getPlace();
        input.value = place.formatted_address || place.name;
    });
}

window.addEventListener("load", initAutocomplete);
</script>


@endsection
