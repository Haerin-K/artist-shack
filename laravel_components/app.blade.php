{{-- ===== LARAVEL LAYOUT TEMPLATE ===== --}}
{{-- This is a sample main layout file for Laravel --}}
{{-- Path: resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Fumo Store')</title>

    <!-- ===== STYLESHEET LINKS ===== -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- ===== COMPONENT STYLES ===== -->
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/carousel.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @stack('styles')
</head>
<body>

    <!-- ===== HEADER NAVIGATION ===== -->
    @include('components.header')

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    @include('components.footer')

    <!-- ===== JAVASCRIPT LIBRARIES ===== -->
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- ===== COMPONENT SCRIPTS ===== -->
    <script src="{{ asset('js/components/header.js') }}"></script>
    <script src="{{ asset('js/components/footer.js') }}"></script>
    <script src="{{ asset('js/components/carousel.js') }}"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')

</body>
</html>
