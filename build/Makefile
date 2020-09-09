.PHONY: start stop bash logs status

MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))

TTY_PARAM := $(shell tty > /dev/null && echo "" || echo "-T")
WINPTY := $(shell command -v winpty && echo "winpty " ||  echo "")
COMPOSE_NETWORK := $(shell docker network ls | grep default | awk '{print $$2}')

start: stop
	docker-compose up -d
	$(WINPTY)docker-compose exec $(TTY_PARAM) app bash -c "composer install --no-plugins --no-scripts"
	docker-compose ps

stop:
	docker-compose down

bash:
	$(WINPTY)docker-compose exec $(TTY_PARAM) app bash

logs:
	docker-compose logs app

followlogs:
	docker-compose logs -f app

status:
	docker-compose ps

composer:
	$(WINPTY)docker-compose exec $(TTY_PARAM) app bash -c "composer dump-autoload"