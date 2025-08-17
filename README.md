# Documents Vault Web App 

### Config .env

it's full depend on Eloquent ORM , feel free to use change to any DBMS .

tested with SQlite ; got to .env file , find and change this section :

```env
    DB_CONNECTION=sqlite
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=laravel
    # DB_USERNAME=root
    # DB_PASSWORD=
```

### Install

```bash
    cd documents_vault
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed 
    php artisan storage:link
```

### Run  

```bash
    php artisan serv 
```


for wildcard and custom port : 

```bash
    php artisan serv  --host 0.0.0.0 --port <port number>
```