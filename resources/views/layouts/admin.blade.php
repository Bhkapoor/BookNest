<!DOCTYPE html>
<html>
<head>
    <title>BookNest Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://jsdelivr.net"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body>

<div class="admin-wrapper">

    @include('partials.adminsidebar')

    <main class="admin-main">
        @include('partials.adminnavbar')

        <section class="admin-content">
            @yield('content')
        </section>
    </main>

</div>

</body>
</html>