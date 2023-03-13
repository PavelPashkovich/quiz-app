
# Quiz app

Application for creating and playing Quiz


## Installation

Follow these steps to install the quiz-app application:

- Clone the project
```bash
  git clone https://github.com/PavelPashkovich/quiz-app.git
  or
  git@github.com:PavelPashkovich/quiz-app.git
```

- Go to the project directory
```bash
  cd quiz-app
```    

- Create .env file from .env.example file
```bash
  cp .env.example .env
```    

- Configure .env file (you can change 'db_name', 'db_username', and 'db_password' with yours)
```bash
  DB_HOST=mysql
  DB_DATABASE=db_name
  DB_USERNAME=db_username
  DB_PASSWORD=db_password

  CACHE_DRIVER=redis
  REDIS_HOST=redis
```    

- Install all dependencies via composer
```bash
  composer install
``` 

- Generate the application key
```bash
  php artisan key:generate
``` 

- Remove named volumes declared in the volumes section of the Compose file and anonymous volumes attached to containers.
```bash
  sail down -v
``` 

- Start containers
```bash
  sail up -d
``` 

- Install and run npm
```bash
  npm install
  npm run dev
```  

- Run migrations and seeders
```bash
  sail artisan migrate
  sail artisan db:seed
```  

Application is available on 'localhost'

## Authors

- [@pashko](https://github.com/PavelPashkovich)

