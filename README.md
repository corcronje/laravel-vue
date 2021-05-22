# Vue SPA and Laravel API Boilerplate

## Getting Started

This application is a Vue SPA and Laravel API boilerplate using Sanctum for user authentication.

### Directory Structure

    .
    ├── web                     # The Vue SPA
    ├── api                     # The Laravel API
    └── README.md

### The API

The minimal Laravel API includes methods Sanctum for user registration and authentication. After cloning this repo to your machine, drop into the ./api directory and install the necessary dependencies using Composer.

```
composer install
```

Setup a .env file by copying the .env.example file, and customize the settings to suite your environment. Be sure to generate a new APP_KEY and set the APP_URL and DB_CONNECTION options.

```
cp .env.example .env            # Create a new .env file
php artisan key:generate        # Generate a new encryption key
nano .env                       # Edit the file, set your APP_URL and DB_CONNECTION options
php artisan migrate             # Scaffold the database
```

Once the .env options has been set and the database has been scaffolded, a local development server can be used for running the API.

```
php artisan serve
```

Checkout the Laravel documentation [here](https://laravel.com/docs/master).

### The SPA

The Vue SPA employ [AXIOS](https://github.com/axios/axios) for making HTTP requests to the Laravel API. After cloning this repo to your machine, drop into the ./web directory and install the necessary dependencies using NPM.

```
npm install
```

Create a .env file by copying the .env.example file, and customize the settings to suite your environment. Be sure to set the API_URL option.

```
cp .env.example .env            # Create a new .env file
nano .env                       # Edit the file, set your API_URL option
```

Once the .env options has been set, a local development server can be started for serving the SPA.

```
npm run serve
```

Checkout the Vue.js documentation [here](https://vuejs.org/v2/guide/).

## License

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

More [The MIT License](https://opensource.org/licenses/MIT)
