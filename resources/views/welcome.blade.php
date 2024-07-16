<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuemplen</title>
    <link rel="stylesheet" href="{{ asset('css/home1.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="header">
        <div class="menu container">
            <div class="logo-container">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Ayuemplen" class="logo">
                <div class="ayuemplen">Ayuemplen</div>
            </div>
            <nav class="navbar">
                @if (Route::has('login'))
                    <div class="auth-buttons">
                        @auth
                            <a href="{{ url('/home') }}" class="button">Inicio</a>
                        @else
                            <a href="{{ route('login') }}" class="button">Iniciar sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="button">Registrarse</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </div>
        <div class="header-content container">
            <div class="header-txt">
                <h1>Las Oportunidades</h1>
                <h1>Te Están Esperando</h1>
            </div>
            <div class="header-image">
                <img src="{{ asset('imagenes/image.png') }}" alt="Oportunidades laborales">
            </div>
        </div>
    </header>

    <div class="publish-container">
        <button href="{{ route('login') }}"  class="publish-button">Publicar</button>
        <p class="publish-description">Publica tu oferta de empleo o de encontrar para que lo visualicen muchas personas</p>
    </div>
    <div class="features-container">
        <div class="feature">
            <h2>Qué puedes encontrar en Ayuemplen</h2>
            <ul>
                <li>Encontrar Nuevo Empleo</li>
            <li>Encontrar Un Servicio Que Requieras</li>
            <li>Que muchas Personas Te Conozcan</li>
            </ul>
        </div>
        <div class="feature">
            <h2>Oportunidades para todos</h2>
    <ul>
        <li>Oficios varios (jardinería, limpieza, mantenimiento)</li>
        <li>Trabajos temporales y de medio tiempo</li>
        <li>Empleos para personas sin experiencia</li>
        <li>Oportunidades para emprendedores</li>
    </ul>
        </div>
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

    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
