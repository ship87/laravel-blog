# Laravel blog

[![Latest Stable Version](https://poser.pugx.org/ship87/laravel-blog/version)](https://packagist.org/packages/ship87/laravel-blog)
[![Build Status](https://img.shields.io/travis/ship87/laravel-blog/master.svg)](https://travis-ci.org/ship87/laravel-blog)
[![License](https://poser.pugx.org/ship87/laravel-blog/license.svg)](https://packagist.org/packages/ship87/laravel-blog)
[![GitHub stars](https://img.shields.io/github/stars/ship87/laravel-blog.svg)](https://github.com/ship87/laravel-blog/stargazers)
[![Total Downloads](https://poser.pugx.org/ship87/laravel-blog/downloads.svg)](https://packagist.org/packages/ship87/laravel-blog)

> ### Example blog on PHP using Laravel framework, JSON:API, Elasticsearch, RabbitMQ.

This repo is functionality complete — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.5/installation#installation)


Clone the repository

    git clone git@github.com:/ship87/laravel-blog.git

Switch to the repo folder

    cd laravel-blog

Install all the dependencies using composer

    composer install
    
Install all the dependencies using npm

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server


    php artisan serve
    

You can now access the server at http://localhost:8000

Start the local development server using docker (PHP-FPM + Xdebug + Nginx)

http://localhost:8070/ - PHP 7.0\
http://localhost:8071/ - PHP 7.1\
http://localhost:8072/ - PHP 7.2

**TL;DR command list**

    git clone git@github.com:ship87/laravel-blog.git
    cd laravel-blog
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


## API Specification

This application adheres to the JSON:API specifications https://jsonapi.org/. This helps mix and match any backend with any other frontend without conflicts.

## License

This project is released under the [MIT](http://opensource.org/licenses/MIT) license.
