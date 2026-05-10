<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->business_name ?? 'Catálogo Web' }}</title>

    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a href="{{ route('home') }}" class="brand">
                @if(!empty($settings?->logo))
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->business_name ?? 'Logo' }}">
                @else
                    <span>{{ $settings->business_name ?? 'Mi Catálogo' }}</span>
                @endif
            </a>

            <nav class="main-nav">
                <a href="{{ route('home') }}">Inicio</a>
                <a href="{{ route('catalog') }}">Catálogo</a>

                @if(!empty($settings?->whatsapp_number))
                    <a class="nav-whatsapp" target="_blank" href="https://wa.me/506{{ preg_replace('/\D/', '', $settings->whatsapp_number) }}">
                        WhatsApp
                    </a>
                @endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <p>© {{ date('Y') }} {{ $settings->business_name ?? 'Nombre del negocio' }}. Todos los derechos reservados.</p>
            <p class="powered">Catálogo digital desarrollado por TuMarca.</p>
        </div>
    </footer>
</body>
</html>
