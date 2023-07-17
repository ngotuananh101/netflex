<p><a href="https://pontas.dev" target="_blank"><img src="https://i.ibb.co/ssD0wwG/logo.png" width="400" alt="NetFlex Logo"></a></p>

<p>
<a href="#"><img src="https://img.shields.io/badge/license-MIT%2FApache--2.0-brightgreen" alt="license"></a>
<a href="#"><img src="https://img.shields.io/badge/Laravel-10-orange?logo=laravel&logoColor=orange" alt="Laravel"></a>
<a href="#"><img src="https://img.shields.io/badge/Vue.JS-3-brightgreen?logo=vuedotjs&logoColor=brightgreen" alt="Vue.Js"></a>
<a href="#"><img src="https://img.shields.io/badge/PHP-8.1-blue?logo=php&logoColor=blue" alt="PHP"></a>
</p>

## About NetFlex

NetFlex is a streaming platform that allows you to watch a variety of movies and series, as well as create your own content. It is a project developed by [Ponta](https://pontas.dev) for the purpose of learning and improving skills in the development of web applications.

## Features
- Landing Page
- Change Language (English, Vietnamese)
### Authentication
- Register
- Send email verification
- Resend email verification
- Verify email
- Login
- Forgot password
- Reset password
### Home Page
#### Profile
- View profile


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
Clone the repository using Git Bash or Command Prompt (Windows) or Terminal (Linux)
```bash
git clone https://github.com/pontadevv/netflex.git
```

### Install dependencies
Install dependencies using Composer and NPM (or Yarn)
```bash
composer install
npm install
```

### Create .env file
Copy .env.example file and rename it to .env and update the information with your own
```bash
cp .env.example .env
```

### Generate application key
Generate application key using the following command
```bash
php artisan key:generate
```

### Create symbolic link
Link the storage folder to the public folder using the following command
```bash
php artisan storage:link
```

### Create database
Create a database and add database credentials to .env file and update the following lines
```bash
DB_CONNECTION=mysql
DB_HOST=database host
DB_PORT= database port (default 3306)
DB_DATABASE= database name
DB_USERNAME= database username
DB_PASSWORD= database password
```


### Migrate database
Create tables in the database using the following command
```bash
php artisan migrate
```

### Seed database
Seed default data to the database using the following command
```bash
php artisan db:seed
```

### Compile assets (for production) or dev (for development)
Build assets for production using the following command
```bash
npm run build
```
or watch for development using the following command
```bash
npm run dev
```

### Run the server (optional for development) 
Run the server for development using the following command
```bash
php artisan serve
```

## License

NetFlex is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

- [Ponta](https://pontas.dev)
- [Laravel](https://laravel.com)
- [VueJS](https://vuejs.org)
- [Bootstrap](https://getbootstrap.com)
- [Font Awesome](https://fontawesome.com)
- [SweetAlert2](https://sweetalert2.github.io)
