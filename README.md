# online-store-laravel

Run app with Docker for development
````
cp .env.example .env
docker run --rm -v $(pwd):/app composer install --ignore-platform-reqs
sail up -d
sail artisan key:generate
````

Test app
````
sail artisan test
````
