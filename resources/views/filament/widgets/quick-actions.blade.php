<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Accesos rápidos
        </x-slot>

        <x-slot name="description">
            Acciones principales para administrar el catálogo.
        </x-slot>

        <style>
            .quick-actions-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
                gap: 14px;
            }

            .quick-action-card {
                display: block;
                padding: 18px;
                border-radius: 16px;
                border: 1px solid rgba(148, 163, 184, 0.25);
                background: rgba(255, 255, 255, 0.03);
                transition: all 0.2s ease;
                text-decoration: none;
            }

            .quick-action-card:hover {
                transform: translateY(-2px);
                border-color: rgba(59, 130, 246, 0.65);
                background: rgba(59, 130, 246, 0.08);
            }

            .quick-action-icon {
                width: 38px;
                height: 38px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 12px;
                background: rgba(59, 130, 246, 0.15);
                color: #60a5fa;
                font-size: 18px;
                font-weight: 700;
            }

            .quick-action-title {
                font-weight: 700;
                color: white;
                margin-bottom: 4px;
            }

            .quick-action-description {
                font-size: 13px;
                color: #94a3b8;
                line-height: 1.4;
            }
        </style>

        <div class="quick-actions-grid">
            <a href="{{ url('/admin/products/create') }}" class="quick-action-card">
                <div class="quick-action-icon">+</div>
                <div class="quick-action-title">Crear producto</div>
                <div class="quick-action-description">Agregar un nuevo producto al catálogo.</div>
            </a>

            <a href="{{ url('/admin/products') }}" class="quick-action-card">
                <div class="quick-action-icon">P</div>
                <div class="quick-action-title">Ver productos</div>
                <div class="quick-action-description">Administrar productos, precios e imágenes.</div>
            </a>

            <a href="{{ url('/admin/categories') }}" class="quick-action-card">
                <div class="quick-action-icon">C</div>
                <div class="quick-action-title">Categorías</div>
                <div class="quick-action-description">Organizar los productos del catálogo.</div>
            </a>

            @if(auth()->user()?->isSuperAdmin() || auth()->user()?->isOwner())
                <a href="{{ url('/admin/settings') }}" class="quick-action-card">
                    <div class="quick-action-icon">⚙</div>
                    <div class="quick-action-title">Configuración</div>
                    <div class="quick-action-description">Editar datos, redes y colores del negocio.</div>
                </a>
            @endif

            <a href="{{ url('/catalogo') }}" target="_blank" class="quick-action-card">
                <div class="quick-action-icon">↗</div>
                <div class="quick-action-title">Ver catálogo</div>
                <div class="quick-action-description">Abrir la página pública del catálogo.</div>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
