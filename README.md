## pasos para configuracion local

# clonar el proyecto desde la rama testing git 
    git clone https://gitlab.com/faunoco/solicitudesapi.git .

# cambiar a rama testing o una rama nueva creada a partir de testing

# instalar dependencias
    composer install 

# crear el archivo .env a partir del archivo .env.example (el archivo ya esta configurado para local)

# ajustar las propiedades del archivo .env de acuerdo al puerto usado en el front end
    FRONTEND_URL=http://localhost:5173
    SANCTUM_STATEFUL_DOMAINS=localhost:5173

# para ambientes de testing o produccion se utilizan subdominios como en el siguiente ejemplo:
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:1yCmFm8VrZPgOItUyQ/hRZpcxnAG2aZlWNLw1vuIDUE=
    APP_DEBUG=true
    APP_URL=https://caudata-test.xyz
    FRONTEND_URL=https://app.caudata-test.xyz
    SESSION_DOMAIN=caudata-test.xyz
    SANCTUM_STATEFUL_DOMAINS=app.caudata-test.xyz

# crear base de datos, usuario y password "solicitudes" o el nombre de preferencia
    create database solicitudes;
    create user solicitudes@localhost identified by 'solicitudes';
    grant all privileges on solicitudes.* to solicitudes@localhost;

# generar tablas de la base de datos
    php artisan migrate:fresh --seed

# habilitar storage para cargar archivos
    php artisan storage:link

# por defecto se crea el usuario admin@gmail.com con igual password

# iniciar el servidor local
    php artisan serve

# si en ambiente de testing o priduccion las rutas api devuelven error 404 se debe limpiar la cache de rutas:
     sudo php artisan route:clear

# configurar el archivo /etc/apache2/apache2.conf agregando el siguiente codigo (reiniciar apache despues de la edicion del archivo):
    <Directory /var/www/html/>
        RewriteEngine On
        RewriteBase /
        RewriteRule ^index\.html$ - [L]
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . /index.html [L]
    </Directory>

