<!DOCTYPE html>
<html>
<head>
    <title>Keanggotaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tambahan jika kamu pakai style dinamis --}}
    @stack('styles')
</head>
<body>

    {{-- Bagian konten utama --}}
    @yield('content')

    {{-- JavaScript --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')

</body>
</html>
