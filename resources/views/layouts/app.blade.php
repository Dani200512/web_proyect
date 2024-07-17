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
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation" aria-expanded="false">
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


    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-logo">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Ayuemplen" class="logo">
                <div class="ayuemplen">Ayuemplen</div>
            </div>
            <div class="footer-about">
                <h3>Sobre Nosotros</h3>
                <p>Ayuemplen es una plataforma que conecta a personas en busca de oportunidades laborales con empleadores y servicios. Nuestra misión es facilitar el acceso al empleo y promover el crecimiento profesional.</p>
            </div>
            <div class="footer-social">
                <h3>Síguenos</h3>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-copyright">
            <div class="container">
                &copy; {{ date('Y') }} Ayuemplen. Todos los derechos reservados.
            </div>
        </div>

    </footer>

    <script>
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            const navbarMenu = document.querySelector('.navbar-menu');
            navbarMenu.classList.toggle('show');
            this.setAttribute('aria-expanded', navbarMenu.classList.contains('show'));

            if (navbarMenu.classList.contains('show')) {
                navbarMenu.style.maxHeight = navbarMenu.scrollHeight + "px";
            } else {
                navbarMenu.style.maxHeight = "0px";
            }
        });
    </script>
</body>
</html>
