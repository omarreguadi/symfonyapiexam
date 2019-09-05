

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them?
- Composer 
- [Docker CE](https://www.docker.com/community-edition)
- [Docker Compose](https://docs.docker.com/compose/install)

### Install

- (optional) Create your `docker-compose.override.yml` file

```bash
cp docker-compose.override.yml.dist docker-compose.override.yml
```
> Notice : Check the file content. If other containers use the same ports, change yours.

#### Init

```bash
cp .env.dist .env
docker-compose up -d
docker-compose exec --user=application web composer install
docker-compose exec web bash -c "php bin/console d:s:u --force"
	docker-compose exec web bash -c "php bin/console hautelook:fixtures:load --purge-with-truncate -q"
	docker-compose exec web bash -c "php bin/console app:create-admin "adresse de l'admin""
```

book: 
	# API: http://127.0.0.1:81
	# phpMyAdmin: http://127.0.0.1:8081
	#
#### api doc 
127.0.0.1:81/api.doc

