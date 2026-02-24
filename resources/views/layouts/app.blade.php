<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Artist Shack</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        <nav class="bg-white shadow-md p-4 flex justify-between">
            <a href="/" class="text-xl font-bold">The Artist Shack</a>
            <div>
                <a href="/admin/products" class="text-gray-600 px-4">Admin Dashboard</a>
                <span class="bg-blue-500 text-white px-3 py-1 rounded-full">Cart: 0</span>
            </div>
        </nav>

        <main class="container mx-auto mt-8 px-4">
            @yield('content')
        </main>
    </body>
</html>