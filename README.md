# 🛒 Web Dinámica de Gestión de Compras

Este proyecto es una aplicación web dinámica desarrollada con **PHP**, **MySQL** y **JavaScript**, que permite gestionar compras, usuarios, productos y perfiles, siguiendo el patrón de arquitectura **MVC** (Modelo - Vista - Controlador). La interfaz es **responsive** y se separa la lógica de la UI utilizando la librería **Handlebars.js**.

## 🧱 Tecnologías utilizadas

- **PHP**: Lógica del backend y conexión con la base de datos.
- **MySQL**: Base de datos relacional para almacenar la información.
- **JavaScript (Vanilla)**: Manipulación de la interfaz y validaciones.
- **Handlebars.js**: Separación de la lógica y la presentación (UI dinámica).
- **jQuery Validator**: Validaciones en formularios del lado del cliente.
- **CSS + Responsive Design**: Adaptado a múltiples dispositivos.
- **Composer**: Gestión de dependencias.
- **Autoloading**: Carga automática de clases con PSR-4.
- **Whoops**: Manejo de errores en desarrollo.
- **QRCode**: Generación de códigos QR.

## 📁 Estructura del proyecto

```plaintext
src/
├── Control/              # Lógica del controlador (abm*)
├── Modelo/               # Clases del modelo (entidades y acceso a datos)
├── Vista/                # Archivos JS, Handlebars y CSS
├── Utils/                # Funciones utilitarias
├── Documentacion/        # Scripts y documentación técnica
├── sql/                  # Script de creación de base de datos
vendor/                   # Librerías instaladas con Composer
config.php                # Configuración principal
index.php                 # Punto de entrada
