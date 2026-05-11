@extends('layouts.public')

@section('content')
<section class="hero">
    <div class="container hero-content">
        <div>
            <span class="eyebrow">Catálogo digital</span>
            <h1>{{ $settings->business_name ?? 'Nombre del negocio' }}</h1>
            <p>
                Encuentra nuestros productos disponibles y consúltalos directamente por WhatsApp.
            </p>

            <div class="hero-actions">
                <a href="{{ route('catalog') }}" class="btn btn-primary">Ver catálogo</a>

                @if(!empty($settings?->whatsapp_number))
                    <a target="_blank" class="btn btn-secondary" href="https://wa.me/506{{ preg_replace('/\D/', '', $settings->whatsapp_number) }}">
                        Contactar por WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <h2>Categorías</h2>
            <p>Explora nuestros productos por categoría.</p>
        </div>

        <div class="category-grid">
            @forelse($categories as $category)
                <a href="{{ route('catalog', ['category' => $category->slug]) }}" class="category-card">
                    <h3>{{ $category->name }}</h3>
                    @if($category->description)
                        <p>{{ $category->description }}</p>
                    @else
                        <p>Ver productos disponibles.</p>
                    @endif
                </a>
            @empty
                <p class="empty-message">Aún no hay categorías activas.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="section-heading">
            <h2>Productos destacados</h2>
            <p>Una selección de productos recomendados.</p>
        </div>

        <div class="product-grid">
            @forelse($featuredProducts as $product)
                @include('public.partials.product-card', ['product' => $product, 'settings' => $settings])
            @empty
                <p class="empty-message">Aún no hay productos destacados.</p>
            @endforelse
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-heading">
            <h2>Contacto</h2>
            <p>Comunícate con nosotros o visita nuestras redes sociales.</p>
        </div>

        <div class="contact-grid">
            <div class="contact-card">
                <h3>Información del negocio</h3>

                @if(!empty($settings?->whatsapp_number))
                    <p><strong>WhatsApp:</strong> {{ $settings->whatsapp_number }}</p>
                @endif

                @if(!empty($settings?->address))
                    <p><strong>Dirección:</strong> {{ $settings->address }}</p>
                @endif

                @if(!empty($settings?->schedule))
                    <p><strong>Horario:</strong> {{ $settings->schedule }}</p>
                @endif
            </div>

            <div class="contact-card">
                <h3>Enlaces rápidos</h3>

                <div class="contact-actions">
                    @if(!empty($settings?->whatsapp_number))
                        <a
                            target="_blank"
                            href="https://wa.me/506{{ preg_replace('/\D/', '', $settings->whatsapp_number) }}"
                            class="btn btn-primary"
                        >
                            Escribir por WhatsApp
                        </a>
                    @endif

                    @if(!empty($settings?->instagram_url))
                        <a target="_blank" href="{{ $settings->instagram_url }}" class="btn btn-secondary">
                            Instagram
                        </a>
                    @endif

                    @if(!empty($settings?->facebook_url))
                        <a target="_blank" href="{{ $settings->facebook_url }}" class="btn btn-secondary">
                            Facebook
                        </a>
                    @endif

                    @if(!empty($settings?->google_maps_url))
                        <a target="_blank" href="{{ $settings->google_maps_url }}" class="btn btn-secondary">
                            Ver ubicación
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
