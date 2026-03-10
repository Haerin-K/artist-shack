<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Artist Shack') - Merchandise Shop</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="min-h-screen">
        @if($message = session('success'))
            <div class="container mt-4">
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            </div>
        @endif

        @if($message = session('error'))
            <div class="container mt-4">
                <div class="alert alert-error">
                    {{ $message }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')
</body>
</html>