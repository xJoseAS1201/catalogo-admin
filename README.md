# Catálogo Web Administrable

Sistema web desarrollado con Laravel para negocios que necesitan mostrar productos o servicios en forma de catálogo digital. El sistema permite que el cliente final busque, filtre y consulte productos por WhatsApp, mientras que el negocio puede administrar su propio catálogo desde un panel privado.

## Objetivo del proyecto

El objetivo de este proyecto es ofrecer una solución sencilla, segura y administrable para negocios que no necesitan una tienda en línea completa, pero sí desean mostrar sus productos de forma profesional y actualizada.

El sistema está pensado para negocios como:

- Tiendas de accesorios
- Repuestos
- Boutiques
- Autodecoración
- Servicios con catálogo
- Comercios locales

## Funcionalidades principales

### Catálogo público

- Página de inicio del negocio
- Catálogo de productos
- Búsqueda por nombre
- Filtro por categoría
- Filtro por disponibilidad
- Página de detalle de producto
- Botón de WhatsApp por producto
- Botón flotante de WhatsApp
- Sección de contacto
- Diseño responsive para móvil y computadora

### Panel administrativo

- Login privado
- Dashboard con estadísticas del catálogo
- Accesos rápidos
- Gestión de productos
- Gestión de categorías
- Configuración del negocio
- Gestión de usuarios
- Roles básicos: Super Admin, Owner y Staff

### Productos

- Crear productos
- Editar productos
- Activar o desactivar productos
- Marcar productos como destacados
- Subir imagen principal
- Asignar categoría
- Definir precio
- Definir estado: disponible, agotado o bajo pedido
- Generación automática de slug para URL amigable

### Categorías

- Crear categorías
- Editar categorías
- Activar o desactivar categorías
- Generación automática de slug

### Configuración del negocio

- Nombre del negocio
- Logo
- WhatsApp
- Instagram
- Facebook
- Dirección
- Google Maps
- Horario
- Colores principales del sitio
- Texto del footer

## Roles del sistema

### Super Admin

Usuario principal del sistema. Puede administrar productos, categorías, configuración y usuarios.

### Owner

Usuario del dueño del negocio. Puede administrar productos, categorías y configuración del negocio.

### Staff

Usuario colaborador. Puede administrar productos y categorías, pero no puede modificar configuración ni usuarios.

## Tecnologías utilizadas

- Laravel
- PHP
- MySQL
- Filament
- Blade
- HTML
- CSS
- JavaScript
- Composer
- Git / GitHub

## Seguridad considerada

El proyecto contempla buenas prácticas básicas de seguridad desde el desarrollo:

- Rutas administrativas protegidas por login
- Roles y permisos por tipo de usuario
- Usuarios activos/inactivos
- Contraseñas encriptadas
- Validaciones en formularios
- Protección CSRF de Laravel
- Restricción de tipos de archivo en imágenes
- Archivo `.env` excluido del repositorio
- Productos inactivos ocultos del catálogo público
- Categorías inactivas ocultas del catálogo público

## Estado del proyecto

MVP funcional en entorno local.

Actualmente el sistema permite administrar un catálogo completo desde el panel privado y mostrarlo públicamente con búsqueda, filtros, detalle de producto y contacto por WhatsApp.

## Instalación local

Clonar el repositorio:

```bash
git clone https://github.com/xJoseAS1201/catalogo-admin.git
