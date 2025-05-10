<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to Gestion RH</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="text-center">
        <h1 class="mb-4">Welcome to <span class="text-primary">Gestion RH</span></h1>
        <p class="lead mb-4">Your trusted HR management solution.</p>
        @auth
        <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">Go to Dashboard</a>
        <!-- test  -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        <!-- test  -->
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        @endauth

    </div>

    <!-- Bootstrap JS (optional for components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>