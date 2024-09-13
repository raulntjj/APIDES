CONTAINER_NAME=api-de
APP_VERSION=latest
PATH_CODE=./
NETWORK=net-db

build:
	docker build -f ./infrastructure/Dockerfile --progress plain -t $(CONTAINER_NAME):$(APP_VERSION) .

build-no-cache:
	docker build -f ./infrastructure/Dockerfile --no-cache --progress plain -t $(CONTAINER_NAME):$(APP_VERSION) .

start:
	docker run --rm -d \
		--name $(CONTAINER_NAME) \
		-p 8082:80 \
		-v $(PATH_CODE):/var/www/html \
		--network $(NETWORK) \
		$(CONTAINER_NAME):$(APP_VERSION)

bash:
	docker exec -it $(CONTAINER_NAME) /bin/sh

migrate:
	docker exec -it $(CONTAINER_NAME) /bin/sh php artinsa migrate

stop:
	docker stop $(CONTAINER_NAME)