<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BookNest</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="bn-layout">

    @auth
    @include('partials.sidebar')
      @endauth

    <div class="bn-main">

        @include('partials.navbar')

        <main class="bn-content">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
