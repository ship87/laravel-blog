# Laravel blog

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status](https://img.shields.io/travis/ship87/laravel-blog/master.svg)](https://travis-ci.org/ship87/laravel-blog)
[![GitHub stars](https://img.shields.io/github/stars/ship87/laravel-blog.svg)](https://github.com/ship87/laravel-blog/stargazers)
[![GitHub license](https://img.shields.io/github/license/ship87/laravel-blog.svg)](https://raw.githubusercontent.com/ship87/laravel-blog/master/LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

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

Generate a new JWT authentication secret key

    php artisan jwt:generate

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
    cd laravel-realworld-example-app
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:generate 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeds/DummyDataSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

## API Specification

This application adheres to the JSON:API specifications https://jsonapi.org/. This helps mix and match any backend with any other frontend without conflicts.

----------
