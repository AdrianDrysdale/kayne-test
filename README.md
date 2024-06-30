# Kayne Test Setup
Welcome to Kayne api.

### Prerequisites
You must have the following set up on a machine
* PHP 8.2 or higher
* Mysql
* Composer 2.x 
* Git


### Install
First clone the repo to your machine.

Next run the standard steps for setting up an existing laravel project

```shell
cp .env.example .env
composer install
php artisan key:generate
```

**Note:** Before running the next step you may need to set a mysql user and/or db. 
You can set these within the .env file as follows changing the defaults

```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Next you can run
```shell
php artisan migrate
```

You can then spin up a server
```shell
php artisan serve
```

You can run the test suite via artisan by doing the following

```shell
php artisan test
```

### Generating an access token
To access the endpoints you will need  an access token. You can run the following artisan command to generate a token.

```shell
php artisan make:apiToken
```
The output will contain the token you need to access the api similar to the following

```shell
Token: c7cduwIsObqH4mcP0dIoKMPlJn5hHvAupBIQiWAhwIpVpFlWoIwHka77IP6X
```

**Note:** Running the test suite will wipe any tokens you generate.

### Using the application
To access a list of five kayne quotes.

```shell
http://127.0.0.1:8002/api/kayne?api_token=c7cduwIsObqH4mcP0dIoKMPlJn5hHvAupBIQiWAhwIpVpFlWoIwHka77IP6X```
```
**Note:** Replace api_token with the token you generated. You many need to replace http://127.0.0.1:8002 with the correct port

Once you ran that endpoint once, any subsequent calls will only return a cached copy of the quotes it previously obtained.
To obtain a fresh list of quotes

```shell
http://127.0.0.1:8002/api/kayne/fresh?api_token=c7cduwIsObqH4mcP0dIoKMPlJn5hHvAupBIQiWAhwIpVpFlWoIwHka77IP6X```
```
