Symfony Standard Edition
========================

This is a test project at the Symfony 3.4
This project work with docker.

Install the project:

You must have install Docker CE.
0. Run build and run docker containers
   
```bash
   cp .env.dist .env
```

1. Build container

```bash
docker-compose build
```
2. Run container

```bash
docker-compose up
```
3.  Open container 
```bash
docker exec -it name_your_container bash
```
4. Run composer
```bash
composer install
```
5. Run doctrine migrations
```bash
./bin/console doc:mi:mi
```

6. Add in /etc/hosts domain name
```bash
crud-test.loc
```