<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Создание мини CRM системы:
Должно быть реализовано на Yii2 advanced
### Backend часть
1. Авторизация в CRM системе

      1.1   Поля для входа на форме (Email, пароль)

2. Модуль для отображения пользователей системы

      2.1 Отображение списка пользователей

      2.2   Возможность выставление прав пользователям, список (Администратор, менеджер)

      2.3   Поля пользователя (email, пароль, статус)

      2.4   Удаление и редактирование пользователей

      2.5   Смена статуса пользователям, Активный или неактивный

      2.6   Редактировать список может только пользователи с правами администратор

3. Раздел отображение заявок

      3.1   Вывод списка заявок

      3.2   Поля у заявки (Имя клиента, Наименование заявки, наименование товар, телефон, время создания заявки, статус, комментарий, цена)

      3.3   Смена статуса заявки (Принята, отказана, брак)

###      Frontend часть
1.      Создать простую форму для отправки заявки

    1.1   Поля формы (Имя клиента, телефон, комментарий, товар)

    1.2   Список товаров (яблоки, апельсины, мандарины)


----
Опционально, не обязательно к выполнению, но приветствуется:
1. Раздел истории изменения заявок

      1.1   Каким пользователям были изменены поля у заявки (Имя клиента, Наименование заявки, наименование товара,  телефон, время подачи заявки, статус, комментарий, цена)

2. Добавить возможность выгрузки в CSV списка заявок, поля в CSV (Наименование заявки, товар, цена, телефон)

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)



Install the application dependencies
```shell
docker-compose run --rm backend composer install
```

Initialize the application by running the init command within a container
```shell
docker-compose run --rm backend php /app/init
```

Adjust the components['db'] configuration in common/config/main-local.php accordingly.
```php
'dsn' => 'pgsql:host=pgsql;dbname=yii2advanced',
'username' => 'yii2advanced',
'password' => 'secret'
```

Build application
```shell
docker-compose build
```

Start the application
```shell
docker-compose up -d
```

Docker application url
Access it in your browser by opening

```
    frontend: http://127.0.0.1:20080
    backend: http://127.0.0.1:21080
```

```shell
docker-compose run --rm backend yii migrate
```

```shell
docker-compose run --rm backend yii migrate/create
```

### Apply RBAC migrations
```shell
docker-compose run --rm backend yii migrate --migrationPath=@yii/rbac/migrations
```

### Seeding test data

```shell
docker-compose run --rm backend yii seed
```