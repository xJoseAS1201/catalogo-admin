@extends('layouts.public')

@section('content')
@php
    $phone = preg_replace('/\D/', '', $settings->whatsapp_number ?? '');
    $message = rawurlencode(
        "Hola, me interesa este producto:\n\n" .
        "Producto: {$product->name}\n" .
        "Precio: " . ($product->price ? '₡' . number_format($product->price, 0) : 'Consultar') . "\n" .
        "Categoría: " . ($product->category->name ?? 'Sin categoría') . "\n\n" .
        "¿Está disponible?"
    );

    $whatsappUrl = $phone ? "https://wa.me/506{$phone}?text={$message}" : '#';
@endphp

<section class="section">
    <div class="container">
        <a href="{{ route('catalog') }}" class="back-link">← Volver al catálogo</a>

        <div class="product-detail">
            <div class="detail-image">
                @if($product->main_image)
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                @else
                    <div class="image-placeholder large">Sin imagen</div>
                @endif
            </div>

            <div class="detail-info">
                <span class="product-category">{{ $product->category->name ?? 'Sin categoría' }}</span>

                <h1>{{ $product->name }}</h1>

                <p class="detail-price">
                    {{ $product->price ? '₡' . number_format($product->price, 0) : 'Consultar precio' }}
                </p>

                <p class="stock {{ $product->stock_status }}">
                    @if($product->stock_status === 'available')
                        Disponible
                    @elseif($product->stock_status === 'out_of_stock')
                        Agotado
                    @else
                        Bajo pedido
                    @endif
                </p>

                @if($product->description)
                    <div class="description">
                        <h2>Descripción</h2>
                        <p>{{ $product->description }}</p>
                    </div>
                @endif

                @if($phone)
                    <a target="_blank" href="{{ $whatsappUrl }}" class="btn btn-primary">
                        Consultar por WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
