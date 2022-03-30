
## Mapon test task

to start the environment setup, clone this repository

## Setup

#### 1. cd into docker directory and run `docker-compose up -d`

```
cd docker
docker-compose up -d
```

#### 2. Create a `.env` file in project root directory by copying variables from `.env.example`. Fill in those values in `.env` file.`DB_HOST` should be set to `db`.

#### 3. SSH into db container from docker directory

```
cd docker
docker exec -it mapon-db bash
```

#### 4. Log in to mysql

```
mysql -u root
```

#### 5. Create new database

```
CREATE DATABASE {db_name};
```

#### 6. From host run these commands to import data into database

```
docker cp ./database.sql mapon-db:/
docker exec mapon-db /bin/sh -c 'mysql -u root -proot {db_name} </database.sql'  
```

#### 7. SSH into app container from docker directory and run `composer install`

```
cd docker
docker exec -it mapon-app bash
composer install
```
