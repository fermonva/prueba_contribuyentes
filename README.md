<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Ejecutar en desarrollo

### 1. Clone el repositorio:

```
git clone https://github.com/fermonva/prueba_contribuyentes.git
```

### 2. Ingresar en el directorio para instalar las dependencias:

```
composer install
npm install
```

### 3. Modificar la base de datos en el archivo `.env` ejemplo:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contribuyentes
DB_USERNAME=root
DB_PASSWORD=123456789
```

### 4. Ejecutar las migraciones:

```
php artisan migrate
```

### 5. Ejecutar el seeder:

```
php artisan db:seed
```

### 6. Ingresar a la aplicación frontend desde el navegador

```
Administrador:
            'email'=> 'admin@gmail.com',
            'password' => '123456789',

Super Usuario:
            'email'=> 'correo@correo.com',
            'password' => '123456789',
```
