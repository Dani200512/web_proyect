<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuemplen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" class="navbar-logo">
                <span>Ayuemplen</span>
            </div>
            <button class="navbar-toggler" type="button">
                <i class="fas fa-bars"></i>
            </button>
            <div class="navbar-menu">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.form') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.form') }}">
                                <i class="fas fa-user-plus"></i>
                                <span>Register</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show') }}">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('job-offers.index') }}">
                                <i class="fas fa-briefcase"></i>
                                <span>Mis Ofertas</span>
                            </a>
                        </li>
                        <li class="nav-item logout-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="py-4">
        @yield('content')
    </div>

    <script>
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            document.querySelector('.navbar-menu').classList.toggle('show');
        });
    </script>
</body>
</html>
