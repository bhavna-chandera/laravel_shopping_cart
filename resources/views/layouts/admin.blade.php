<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <!-- Include CSS files (Bootstrap, custom CSS, etc.) -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Example for Vite in Laravel 9+ -->
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar content include -->
        <!-- include('includes.sidebar') -->

        <!-- Main content area -->
        <div id="content" class="col-md-8">
            <!-- Top Navbar (optional) -->
            <!-- include('includes.header') -->

            <main class="py-4">
                @yield('content') <!-- Placeholder for individual page content -->
            </main>
        </div>
    </div>
    <!-- Include JS files (Bootstrap JS, custom JS, etc.) -->
</body>

</html>