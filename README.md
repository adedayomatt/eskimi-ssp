# Eskimi SSP
### Adedayo Matthews

This a submission of a task for the role of Senior full-stack PHP developer at [Eskimi](https://www.eskimi.com/). 
Task description can be found [here](https://docs.google.com/document/d/1t3bEAhCUEc52BB-plKa19DDGXPvHF4hHMtJf2VuZg9o/edit).

## Features
- Create and edit advertising campaign
- List all created advertising campaigns: name, date, daily budget, total budget
- Multiple image upload with the advertising campaign
- Preview of each advertising campaign
- API endpoint to list campaigns
- API endpoint to create new campaign

## Stack

- [Laravel](https://laravel.com) - PHP framework
- [Vue3](https://v3.vuejs.org/) - Javascript frontend framework
- [Nginx](https://nginx.com/) - An open source web server
- [MySQL](https://mysql.com/) - Database service

## Dependencies

In addition to the Laravel framework, the following dependencies were also used in the application:
- [InertiaJS](https://inertiajs.com/) - A library that allows you to render single-file Vue components from your Laravel backend.
- [Jetstream](https://jetstream.laravel.com/) - Application starter kit for Laravel.
- [Sanctum](https://laravel.com/docs/8.x/sanctum) - Laravel package that provides a featherweight authentication system.
- [Ziggy](https://github.com/tighten/ziggy) - Provides helper functions to access all of our named Laravel routes from the frontend.

## Installation and deployment

[Docker](https://docker.com/) containers were used to setup the environment, thanks to [Laradock](http://laradock.io/).

> Docker version used: Docker Desktop version 20.10.8

Follow the instructions to set up the app in Docker.

#### Clone repo with submodules

```
git clone --recursive https://github.com/adedayomatt/eskimi-ssp.git
```

#### Navigate to eskimi-ssp dir

```
cd eskimi-ssp
```

#### Make a copy of the app .env 
```
copy .env.example .env
```

#### Navigate to laradock dir
```
cd laradock
```

#### Make a copy of Laradock .env 
```
copy .env.example .env
```

#### Create and start the containers

We need nginx, mysql and workspace containers running. The workspace container already contains necessary softwares requires to successfully run a Laravel project, e.g PHP CLI, Composer, Node, e.t.c.

```
docker-compose up -d nginx mysql workspace
```

#### Open workspace bash

```
docker-compose exec workspace bash
```

Continue running the following commands In the workspace bash...

#### Install composer depencies

```
composer install
```

#### Set App key

```
php artisan key:generate
```

#### Migrate database

```
php artisan migrate
```

#### Seed Database

This create a user account to login in with and some sample campaigns

```
php artisan db:seed
```

#### Create storage symlink

```
php artisan storage:link
```

#### Install Javascript depencies

```
npm install
```

#### Build resources for production

```
npm run prod
```

#### Update App .env
In app .env file, set the following...
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=default
DB_USERNAME=root
DB_PASSWORD=root
```
The app should now be running at the address:
```
http://localhost
```
#### Login credentials
Login to the system with the credentials already seeded
> **Email:** adedayomatthews@eskimi-ssp.test
> **Password:** eskimi

## Testing
The following tests are available:
- User authentication
- Creating of API token
- Deleting of API token
- Password reset and update
- Updating of Profile information
- Listing campaigns via web and api
- Creating new campaign via web and api
- Updating campaign via web an api

Run test:
```
php artisan test
```

## Design Structure

To ensure the code extensibility and maintainablility, the code base was designed in modules such that other features can be built in as separate modules and be maintained independently. To achieve this, the `modules` directly was added to Laravel file structure which would house different modules. The campaign module was created and structured to contain models, controllers, routes, migrations, requests, views and components for campaign.
The [campaign service provider](https://github.com/adedayomatt/eskimi-ssp/blob/main/modules/Campaign/CampaignServiceProvider.php) was created to configure the module and is registered to the application in [`config/app`](https://github.com/adedayomatt/eskimi-ssp/blob/79e118a97fa77e1d39984bd405bf8b1de5d62f85/config/app.php#L184)

> The modules directory was added to the psr-4 autoload with a namespace [here](https://github.com/adedayomatt/eskimi-ssp/blob/79e118a97fa77e1d39984bd405bf8b1de5d62f85/composer.json#L31)
> 

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
