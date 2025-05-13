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

⚙️ Requisitos y configuración
Activar MySQL desde tu servidor local (ej. XAMPP o MAMP).

Clonar el repositorio.

Ejecutar el archivo SQL que se encuentra en la carpeta /sql/ para crear la base de datos.

Configurar el archivo config.php con los datos de conexión a tu base de datos.

Ejecutar composer install para instalar las dependencias.

Acceder vía navegador a http://localhost/ruta-del-proyecto/


🔐 Funcionalidades principales
Registro y login de usuarios.

Gestión de productos y compras.

Sistema de roles y permisos.

Registro histórico de acciones.

Generación de códigos QR para elementos.

Validaciones robustas en formularios.

✅ Validaciones
Todos los formularios están validados con jQuery Validator, asegurando que los datos cumplan con los requisitos antes de ser enviados al servidor.

📸 Capturas
![image](https://github.com/user-attachments/assets/c3ede4a3-0469-40cd-8b0f-4cffab82a653)
![image](https://github.com/user-attachments/assets/2d25a719-d3f9-4a95-9f7f-953b92fe5c86)
![image](https://github.com/user-attachments/assets/5c574568-e6b7-48d3-9509-43bfcd534cd4)
![image](https://github.com/user-attachments/assets/ac0c9b2a-d5b4-4361-8e6a-b6c84466b883)
![image](https://github.com/user-attachments/assets/66bc9fab-0673-4714-b961-18506a149996)
![image](https://github.com/user-attachments/assets/58f5faeb-df86-48e3-8f7b-234e34a7650f)
![image](https://github.com/user-attachments/assets/1897669b-5ce8-4138-ba17-82703dc75e89)
![image](https://github.com/user-attachments/assets/e76e3181-930c-4a73-90d1-af254a5fc605)
![image](https://github.com/user-attachments/assets/f21ce700-0b4d-4cfa-9567-385293a6990a)
![image](https://github.com/user-attachments/assets/67c8732a-0e52-4f11-b90a-0623b4f6595c)
![image](https://github.com/user-attachments/assets/6b4e142e-8791-4794-832f-05143b5ab68f)
![image](https://github.com/user-attachments/assets/27ff0ce8-050e-4e4a-bab8-a411ec35b19c)
![image](https://github.com/user-attachments/assets/0a9aec77-911e-4888-8d13-432537fd9d42)
![image](https://github.com/user-attachments/assets/b74110c8-649f-4df9-a102-6b8b40e5df23)
![image](https://github.com/user-attachments/assets/88494bca-e652-44f7-b267-6894742e6d89)
![image](https://github.com/user-attachments/assets/ebb31e54-4591-4902-8116-a374da903f89)
![image](https://github.com/user-attachments/assets/c39230c1-8048-402e-a447-115eddee08a0)

🧑‍💻 Autores
<p>https://github.com/Diiegorios46</p>
<p>https://github.com/Balenbv</p>
<p>https://github.com/juancruzgw</p>

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


