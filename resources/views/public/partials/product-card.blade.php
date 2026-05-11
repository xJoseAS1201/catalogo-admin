@php
    $phone = preg_replace('/\D/', '', $settings->whatsapp_number ?? '');

    if (strlen($phone) === 8) {
        $phone = '506' . $phone;
    }

    $message = rawurlencode(
        "Hola, me interesa este producto:\n\n" .
        "Producto: {$product->name}\n" .
        "Precio: " . ($product->price ? '₡' . number_format($product->price, 0) : 'Consultar') . "\n" .
        "Categoría: " . ($product->category->name ?? 'Sin categoría') . "\n\n" .
        "¿Está disponible?"
    );

    $whatsappUrl = $phone ? "https://wa.me/{$phone}?text={$message}" : '#';
@endphp

<article class="product-card">
    <a href="{{ route('products.show', $product) }}" class="product-image">
        @if($product->is_featured)
            <span class="featured-badge">Destacado</span>
        @endif

        @if($product->main_image)
            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
        @else
            <div class="image-placeholder">Sin imagen</div>
        @endif
    </a>

    <div class="product-info">
        <div class="product-meta">
            <span class="product-category">{{ $product->category->name ?? 'Sin categoría' }}</span>

            <span class="stock {{ $product->stock_status }}">
                @if($product->stock_status === 'available')
                    Disponible
                @elseif($product->stock_status === 'out_of_stock')
                    Agotado
                @else
                    Bajo pedido
                @endif
            </span>
        </div>

        <h3>
            <a href="{{ route('products.show', $product) }}">
                {{ $product->name }}
            </a>
        </h3>

        <p class="price">
            {{ $product->price ? '₡' . number_format($product->price, 0) : 'Consultar precio' }}
        </p>

        <div class="product-actions">
            <a href="{{ route('products.show', $product) }}" class="btn-small">
                Ver detalle
            </a>

            @if($phone)
                <a target="_blank" rel="noopener noreferrer" href="{{ $whatsappUrl }}" class="btn-small whatsapp">
                    Consultar
                </a>
            @endif
        </div>
    </div>
</article>
