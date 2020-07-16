# LaraVuetify

<p>
  <a href="https://laravel.com">
    <img src="https://img.shields.io/badge/laravel-6.18-brightgreen.svg" alt="vue">
  </a>
  <a href="https://vuejs.org">
    <img src="https://img.shields.io/badge/vue-2.6.11-brightgreen.svg" alt="vue">
  </a>
  <a href="https://github.com/wirgen/laravuetify/blob/master/LICENSE">
    <img src="https://img.shields.io/badge/license-MIT-brightgreen.svg" alt="license">
  </a>
</p>

Simple clean SPA without CSS frameworks and other libraries.
This repository can use as start-point for adapt any CSS/Vue framework.

## Info

- Backend: [Laravel 6](https://laravel.com/docs/6.x/releases)
- Frontend: [VueJS 2](https://vuejs.org/v2/guide/)

## Prerequiries

- PHP 7.2
- MySQL/MariaDB
- Composer
- NodeJS
- Yarn

## Installation

- Clone the repository
- Installer back dependencies with `composer install`
- Install front dependencies with `npm i`/`yarn install`
- Copy file `.env.example` in `.env` and add following information:
    - Database credentials (`DB_HOST`, `DB_PORT`, ...)
    - Application url (`APP_URL`)
    - Base application path (`BASE_PATH`)
    - Base api path (`MIX_BASE_API`)
- Generate application key with `php artisan key:generate`
- Generate JWT key with `php artisan jwt:secret`
- Launch migrations with `php artisan migrate --seed`.
- Build front with `npm run dev`
- Create first account with `php artisan init-admin`

## Configuration

You can change the length of time (in minutes) that the token will be valid for by changin the `JWT_TTL` value in the `.env` file.
