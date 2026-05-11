<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->business_name ?? 'Catálogo Web' }}</title>

   <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
    @php
    $primaryColor = '#111827';
    $secondaryColor = '#f59e0b';

    if (!empty($settings?->primary_color) && preg_match('/^#[0-9A-Fa-f]{6}$/', $settings->primary_color)) {
        $primaryColor = $settings->primary_color;
    }

    if (!empty($settings?->secondary_color) && preg_match('/^#[0-9A-Fa-f]{6}$/', $settings->secondary_color)) {
        $secondaryColor = $settings->secondary_color;
    }
@endphp

<style>
    :root {
        --primary-color: {{ $primaryColor }};
        --secondary-color: {{ $secondaryColor }};
    }
</style>
</head>
<body>
    @php
    $whatsappPhone = preg_replace('/\D/', '', $settings->whatsapp_number ?? '');

    if (strlen($whatsappPhone) === 8) {
        $whatsappPhone = '506' . $whatsappPhone;
    }

    $generalWhatsappMessage = rawurlencode(
        'Hola, quiero más información sobre el catálogo de productos.'
    );

    $generalWhatsappUrl = $whatsappPhone
        ? "https://wa.me/{$whatsappPhone}?text={$generalWhatsappMessage}"
        : null;
@endphp
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

@if($generalWhatsappUrl)
    <a class="nav-whatsapp" target="_blank" rel="noopener noreferrer" href="{{ $generalWhatsappUrl }}">
        WhatsApp
    </a>
@endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    @if($generalWhatsappUrl)
    <a
        href="{{ $generalWhatsappUrl }}"
        target="_blank"
        rel="noopener noreferrer"
        class="floating-whatsapp"
        aria-label="Contactar por WhatsApp"
    >
        WhatsApp
    </a>
@endif

    <footer class="site-footer">
        <div class="container footer-content">
            <p>© {{ date('Y') }} {{ $settings->business_name ?? 'Nombre del negocio' }}. Todos los derechos reservados.</p>
            <p class="powered">{{ $settings->footer_text ?? 'Catálogo digital desarrollado por TuMarca.' }}</p>
        </div>
    </footer>
</body>
</html>
