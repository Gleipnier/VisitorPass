<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your App Name')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: hsl(150, 7.69%, 94.9%);
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
        }
    </style>
</head>
<body>
    <header>
        @include('partials.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Add your footer content here -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>