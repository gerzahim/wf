# WF App

Marketplace Application to sell media content Online.


## Installation

Clone the repo locally:

```sh
git clone https://github.com/rasce88/wf.git wf
cd src/wf
```

Building UP Docker Container and Images:
```sh
# Install Docker Desktop App

# Find the docker-compose.yml File and Build 
cd src/wf
docker-compose up -d --build
docker-compose up -d --build --force-recreate
```

Install PHP dependencies:
```sh
# Enter to wf_app_container 
docker exec -it wf_app_container bash

cd /var/www
composer install
```

Install NPM dependencies:

```sh
npm install && npm run dev
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```


To run the Ping CRM tests, run:
```
phpunit
```

You're ready to go! Visit Ping CRM in your browser, and login with:
http://localhost:8070/
- **Username:** admin@admin.com
- **Password:** secret


## Setting New Project 

Build and Init your Docker Images :

```sh
docker-compose up -d --build
docker-compose up -d --build --force-recreate

# Enter to wf_app_container 
docker exec -it wf_app_container bash
```

Working in the Container :

```sh
docker exec -it wf_app_container bash
```

Create New Project 
```sh
cd /var/www
composer create-project --prefer-dist laravel/laravel wf

cp -Rf wf/. .
rm -Rf /wf
```

Set .ENV file
```shell script
# can copy from .env_template or set 
DB_CONNECTION=mysql
DB_HOST=wf_mysql_container
DB_PORT=3306
DB_DATABASE=sf4
DB_USERNAME=sf4
DB_PASSWORD=sf4
``` 
Verify Laravel Version 
```shell script
php artisan --version 
```

Installing JetStream 
```shell script
composer require laravel/jetstream

php artisan jetstream:install livewire

php artisan jetstream:install inertia --teams

npm install && npm run dev

php artisan migrate
```

Publish Blade Components 
```shell script
# Livewire, 
# if you are using the Livewire stack, you should first publish the Livewire stack's Blade components:
# Next, you should customize the SVGs located in the 
# resources/views/vendor/jetstream/components/application-logo.blade.php, 
# resources/views/vendor/jetstream/components/authentication-card-logo.blade.php, and 
# resources/views/vendor/jetstream/components/application-mark.blade.php components.

php artisan vendor:publish --tag=jetstream-views

# Inertia
# If you are using the Inertia stack, you should first publish Jetstream's Blade components. These components are used by the authentication templates:

php artisan vendor:publish --tag=jetstream-views
# action: Copied Directory [/vendor/laravel/jetstream/resources/views] To [/resources/views/vendor/jetstream]

# Next, you should customize the SVGs located in 
# resources/views/vendor/jetstream/components/authentication-card-logo.blade.php, 
# resources/js/Jetstream/ApplicationLogo.vue,
# resources/js/Jetstream/ApplicationMark.vue. 
# After customizing these components, you should rebuild your assets:

npm run dev
```



## Deploy with Cpanel and winSCP

- update/replace src/public (file by file) don't touch .htaccess
- update/replace src/resources

- update/replace src/app
- update/replace src/routes

- descomprim node_modules
- descomprim vendor

- any new variable on .ENV
- import .sql
