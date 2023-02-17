up:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down

build:
	docker-compose up --build -d

migrate:
	docker-compose run --rm backend yii migrate

seed:
	docker-compose run --rm backend yii seed

nuxt-dev:
	yarn dev
