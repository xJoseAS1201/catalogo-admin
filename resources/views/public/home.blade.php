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
@endsection
