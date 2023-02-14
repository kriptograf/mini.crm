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

uperm:
	sudo chown ${USER}:${USER} backend -R
	sudo chmod -R 777 backend
	sudo chown ${USER}:${USER} console -R
	sudo chmod -R 777 console
	sudo chown ${USER}:${USER} common -R
	sudo chmod -R 777 common
	sudo chown ${USER}:${USER} frontend -R
	sudo chmod -R 777 frontend
	sudo chown ${USER}:${USER} .data -R
	sudo chmod -R 777 .data
