init: start install
	docker-compose exec php bin/console doctrine:migration:migrate --no-interaction

start:
	docker-compose up -d

stop:
	docker-compose stop

restart: stop start

install:
	docker-compose exec php composer install
