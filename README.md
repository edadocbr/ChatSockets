# Chat Sockets - Sistema de Mensajería en Tiempo Real

Sistema de chat en tiempo real desarrollado como proyecto académico para la Facultad de Ingeniería de Sistemas - UNMSM.

## Características

- **Mensajería en tiempo real** mediante WebSockets (Laravel Reverb)
- **Autenticación completa** con registro, inicio de sesión y cierre de sesión
- **Interfaz de chat** con lista de contactos y en tiempo real
- **Panel de configuración** de perfil, seguridad y apariencia

## Stack Tecnológico

| Capa | Tecnología |
|------|------------|
| Backend | Laravel 13 (PHP 8.2+) |
| Frontend | Livewire 4, Blade Templates |
| CSS | Tailwind CSS 4, Bootstrap (Phoenix Admin) |
| Base de datos | SQLite |
| WebSockets | Laravel Reverb |
| Autenticación | Laravel Fortify |
| Build | Vite 8 |

## Instalación

### Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm

### Pasos

1. Clonar el repositorio:
```bash
git clone <url-del-repositorio>
cd chat-fisi
```

2. Instalar dependencias:
```bash
composer install
npm install
```

3. Configurar el archivo `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar la base de datos SQLite:
```bash
touch database/database.sqlite
php artisan migrate
```

5. Compilar assets:
```bash
npm run build
```

6. Iniciar el servidor WebSocket (Reverb):
```bash
php artisan reverb:start
```

7. Iniciar el servidor de desarrollo:
```bash
php artisan serve
```