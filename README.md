## Requisitos

Asegúrate de tener las siguientes herramientas instaladas:

- [PHP](https://www.php.net/downloads) (Versión recomendada: 7.4 o superior)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/downloads/) (o cualquier otro gestor de base de datos compatible)
- [Node.js](https://nodejs.org/) (para la gestión de activos front-end)

## Configuración del Entorno


_________________________
### Clonar el proyecto
git clone https://github.com/AlejoWally666/picoPlacaBack
cd picoPlacaBack

### Instalar Dependencias PHP
composer install

### Configurar el Archivo de Entorno

Copia el archivo de ejemplo .env.example a .env y configura tus variables de entorno, especialmente las relacionadas con la base de datos:

cp .env.example .env

Abre el archivo .env y edita las siguientes líneas para que coincidan con la configuración de tu base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

### Migrar la Base de Datos
php artisan migrate

### Iniciar el Servidor de Desarrollo
php artisan serve
