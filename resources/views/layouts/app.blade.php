<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'The Artist Shack')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Component Styles -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-to-top.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @stack('styles')
</head>
<body>

    <!-- Header Navigation -->
    @include('components.header', ['categories' => $categories ?? \App\Models\Category::all()])

    <!-- Main Content -->
    <main class="main-content">
        @if($message = session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if($message = session('error'))
            <div class="container mt-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer', ['categories' => $categories ?? \App\Models\Category::all()])

    <!-- Scroll to Top Button -->
    <div id="scroll-to-top" class="scroll-to-top">
        <i class="fa fa-chevron-up"></i>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Component Scripts -->
    <script src="{{ asset('js/header.js') }}"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
    <script src="{{ asset('js/scroll-to-top.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>