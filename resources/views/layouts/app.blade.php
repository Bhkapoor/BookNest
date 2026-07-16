<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="bn-navbar navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand bn-logo" href="{{ url('/') }}">
                    📚 Book<span>Nest</span>
                    <small>Share Books, Share Knowledge</small>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#booknestNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="booknestNavbar">
                    <ul class="navbar-nav mx-auto gap-lg-4">
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == url('/') ? 'active' : '' }}"
                                href="{{ url('/') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('books.browse') ? 'active' : '' }}"
                                href="{{ route('books.browse') }}">
                                Browse Books
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pyq.index') ? 'active' : '' }}"
                                href="{{ route('pyq.index') }}">
                                PYQ Papers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#about-us') }}">About Us</a>
                        </li>
                    </ul>

                    <div class="d-flex gap-2">
                        @guest
                            <a href="{{ route('login') }}" class="btn bn-login-btn">Login</a>
                            <a href="{{ route('register') }}" class="btn bn-register-btn">Register</a>
                        @else
                            <a href="{{ url('/home') }}" class="btn bn-login-btn">Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
</body>

</html>
