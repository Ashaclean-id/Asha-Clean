<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Layanan</title>

    <!-- Tailwind CDN (bisa diganti mix/vite jika ingin) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Wrapper -->
    <div class="max-w-3xl mx-auto p-4">
        @yield('content')
    </div>

    <!-- GOOGLE MAPS AUTOCOMPLETE SCRIPT -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    </script>

    <script>
        function initAutocomplete() {
            var input = document.getElementById('location');
            if (!input) return;

            var autocomplete = new google.maps.places.Autocomplete(input);
        }

        window.onload = initAutocomplete;
    </script>

</body>
</html>
