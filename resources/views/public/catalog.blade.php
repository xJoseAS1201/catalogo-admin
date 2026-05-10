@extends('layouts.public')

@section('content')
<section class="page-title">
    <div class="container">
        <h1>Catálogo</h1>
        <p>Busca, filtra y consulta productos directamente por WhatsApp.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <form method="GET" action="{{ route('catalog') }}" class="filters">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar producto..."
            >

            <select name="category">
                <option value="">Todas las categorías</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="stock_status">
                <option value="">Todos los estados</option>
                <option value="available" @selected(request('stock_status') === 'available')>Disponible</option>
                <option value="out_of_stock" @selected(request('stock_status') === 'out_of_stock')>Agotado</option>
                <option value="on_request" @selected(request('stock_status') === 'on_request')>Bajo pedido</option>
            </select>

            <button type="submit" class="btn btn-primary">Filtrar</button>

            <a href="{{ route('catalog') }}" class="btn btn-secondary">Limpiar</a>
        </form>

        <div class="product-grid">
            @forelse($products as $product)
                @include('public.partials.product-card', ['product' => $product, 'settings' => $settings])
            @empty
                <p class="empty-message">No se encontraron productos con esos filtros.</p>
            @endforelse
        </div>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
