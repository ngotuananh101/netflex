<p align="center"><a href="https://pontas.dev" target="_blank"><img src="https://i.ibb.co/ssD0wwG/logo.png" width="400" alt="NetFlex Logo"></a></p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/license-MIT%2FApache--2.0-brightgreen" alt="license"></a>
<a href="#"><img src="https://img.shields.io/badge/Laravel-10-orange?logo=laravel&logoColor=orange" alt="Laravel"></a>
<a href="#"><img src="https://img.shields.io/badge/VueJS-3-brightgreen?logo=vuedotjs&logoColor=brightgreen" alt="Vue.Js"></a>
<a href="#"><img src="https://img.shields.io/badge/PHP-8.1-blue?logo=php&logoColor=blue" alt="PHP"></a>
</p>

## About NetFlex

NetFlex is a streaming platform that allows you to watch a variety of movies and series, as well as create your own content. It is a project developed by [Pontas Agency](https://pontas.dev) for the purpose of learning and improving skills in the development of web applications.

## Features
- Landing Page
#### Authentication
- Register
- Verify Email
- Login


## Installation

### Requirements
#### Server
- [PHP](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [Laravel](https://laravel.com/docs/8.x/installation)
- [NodeJS](https://nodejs.org/en/download/)
- [NPM](https://www.npmjs.com/get-npm)
- [MySQL](https://dev.mysql.com/downloads/installer/)
- [Git](https://git-scm.com/downloads)
- [Redis](https://redis.io/download)
- [Nginx](https://www.nginx.com/resources/wiki/start/topics/tutorials/install/) or [Apache](https://httpd.apache.org/docs/2.4/install.html)

#### Client
- [VueJS](https://vuejs.org/v2/guide/installation.html)
- [Vue Router](https://router.vuejs.org/installation.html)
- [Vuex](https://vuex.vuejs.org/installation.html)
- [Axios](https://axios-http.com/docs/intro)
- [Bootstrap](https://getbootstrap.com/docs/5.1/getting-started/download/)
- [Font Awesome](https://fontawesome.com/v5.15/how-to-use/on-the-web/setup/using-package-managers)
- [SweetAlert2](https://sweetalert2.github.io/#download)

### Clone the repository
```bash
git clone https://github.com/pontadevv/netflex.git
```

### Install dependencies
```bash
composer install
npm install
```

### Create .env file
```bash
cp .env.example .env
```

### Generate application key
```bash
php artisan key:generate
```

### Create symbolic link
```bash
php artisan storage:link
```

### Create database
```bash
touch database/database.sqlite
```

### Migrate database
```bash
php artisan migrate
```

### Seed database
```bash
php artisan db:seed
```

### Compile assets
```bash
npm run build
```

### Run the server
```bash
php artisan serve
```

## License

NetFlex is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

- [Pontas Agency](https://pontas.dev)
- [Laravel](https://laravel.com)
- [VueJS](https://vuejs.org)
- [Bootstrap](https://getbootstrap.com)
- [Font Awesome](https://fontawesome.com)
- [SweetAlert2](https://sweetalert2.github.io)
