# INSTALLATION
- Install dependencies ```composer install``` & ```npm i```
- copy .env.example to .env
- generate project key : ```php artisan key:generate```
- Fill out .env values (database, mailjet...)
- Create storage symlink : ```php artisan storage:link```
- Run migrations : ```php artisan migrate```

## TO RUN THE PROJECT LOCALLY
- ```php artisan serve```
- ```npm run watch``` to recompile assets automatically

## DEPLOYMENT
- Make sure to run ```php artisan config:cache```
- Compile and minimy assets : ```npm run production```

# USAGE
## ADMIN INTERFACE
The interface is located on /admin, to generate access credentials run this custom artisan command :
```php artisan user:create {{username}} {{password}}```
