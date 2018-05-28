# lara-ore-user

[![Build Status](https://travis-ci.org/railken/lara-ore-user.svg?branch=master)](https://travis-ci.org/railken/lara-ore-user)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A laravel package to handle users

# Requirements

PHP 7.1 and later.

## Installation

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/lara-ore-user
```

The package will automatically register itself.

You can publish the migration with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\UserServiceProvider" --tag="migrations"
```

After the migration has been published you can create the migration-table by running the migrations:

```bash
php artisan migrate
```
You can publish the config-file with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\UserServiceProvider" --tag="config"
```
