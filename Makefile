IMAGE = short-link
VERSION = 1.0
WORK_DIR = /var/www

.PHONY: vendor logs

build:
	@docker build -t $(IMAGE):$(VERSION) ./.docker/
up:
	@docker compose up -d
down:
	@docker compose down
logs:
	@docker compose logs -f
vendor:
	docker run -it --rm -w $(WORK_DIR) -v .:$(WORK_DIR) --user 1000:1000 $(IMAGE):$(VERSION) composer install

bash:
	@docker compose exec php-short-link bash

env:
	@cp .env.example .env
key-generate:
	@docker run -it --rm -w $(WORK_DIR) -v .:$(WORK_DIR) --user 1000:1000 $(IMAGE):$(VERSION) php artisan key:generate
migrate:
	@docker compose exec php-short-link bash -c "php artisan migrate"
