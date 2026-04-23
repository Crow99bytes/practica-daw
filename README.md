# practica-daw

Proyecto de fin de curso del ciclo de DAW. Es una aplicación web desarrollada con **Symfony 7.4** y **PHP 8.2**, con base de datos gestionada mediante **Doctrine ORM** y vistas renderizadas con **Twig**.

## Tecnologías usadas

- **PHP 8.2** + **Symfony 7.4**
- **Doctrine ORM** + **Doctrine Migrations**
- **Twig** para las plantillas
- **Symfony UX** (Stimulus + Turbo)
- **Asset Mapper** para los assets del frontend
- **PHPUnit** para los tests
- **MySQL** (configurado mediante variables de entorno)

## Estructura del proyecto

```
practica-daw/
├── assets/         # CSS y JS del frontend
├── config/         # Configuración de Symfony
├── migrations/     # Migraciones de base de datos
├── public/         # Punto de entrada (index.php)
├── src/            # Código fuente (controladores, entidades, etc.)
├── templates/      # Plantillas Twig
├── tests/          # Tests de la aplicación
└── translations/   # Archivos de traducción
```

## Instalación

```bash
# Clonar el repositorio
git clone https://github.com/Crow99bytes/practica-daw.git
cd practica-daw

# Instalar dependencias
composer install

# Configurar variables de entorno
cp .env .env.local
# Editar .env.local con tu configuración de base de datos

# Crear la base de datos y ejecutar migraciones
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Instalar assets
php bin/console importmap:install

# Arrancar el servidor de desarrollo
symfony server:start
```

## Variables de entorno

Copia el archivo `.env` a `.env.local` y ajusta los valores:

```env
DATABASE_URL="mysql://usuario:contraseña@127.0.0.1:3306/practica_daw"
```

## Tests

```bash
php bin/phpunit
```

## Autor

Manuel Darío González Patón — [Crow99bytes](https://github.com/Crow99bytes)
