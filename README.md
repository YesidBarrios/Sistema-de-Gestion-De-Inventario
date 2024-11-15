
# Sistema de Inventario y Gestión de Productos

## 📋 Descripción
Sistema web desarrollado en PHP para la gestión integral de inventarios empresariales. Permite llevar un control detallado de productos, realizar seguimiento de stock, generar reportes personalizados y exportar datos a Excel para análisis avanzados.


### Características principales:
• Control de entrada y salida de productos
• Gestión de categorías y proveedores
• Alertas de stock mínimo
• Reportes detallados de movimientos
• Exportación de datos a Excel
• Interfaz intuitiva y responsiva
• Búsqueda avanzada de productos
• Historial de transacciones

## ✨ Funcionalidades Técnicas
• Exportación a Excel usando PHPSpreadsheet
• Generación de reportes en PDF
• Sistema de búsqueda optimizado
• Gestión de usuarios y permisos
• Respaldos automáticos de datos

## 🔧 Requisitos
• PHP 8.0 o superior
• MySQL o MariaDB
• Servidor web con soporte para PHP y MySQL (Apache, Nginx, etc.)
• Extensiones PHP requeridas:

```68:81:vendor/phpoffice/phpspreadsheet/composer.json
        "php": "^8.1",
        "ext-ctype": "*",
        "ext-dom": "*",
        "ext-fileinfo": "*",
        "ext-gd": "*",
        "ext-iconv": "*",
        "ext-libxml": "*",
        "ext-mbstring": "*",
        "ext-simplexml": "*",
        "ext-xml": "*",
        "ext-xmlreader": "*",
        "ext-xmlwriter": "*",
        "ext-zip": "*",
        "ext-zlib": "*",
```

## 📥 Instalación

1. Instalar dependencias:
```bash
composer install
```

2. Configurar la base de datos:

   • Copiar `config.example.php` a `config.php`
   • Editar las credenciales de la base de datos en `config.php`