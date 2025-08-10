# Documents Vault Web App 

### required before run

```bash
    php artisan key:generate
    php artisan migrate
    php artisan db:seed 
    php artisan storage:link
```

daatabased used is sqlite 
got to .env file , find and change this section 
```env
    DB_CONNECTION=sqlite
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=laravel
    # DB_USERNAME=root
    # DB_PASSWORD=
```