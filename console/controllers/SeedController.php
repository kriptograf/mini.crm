<?php

namespace console\controllers;

use console\seeders\ProductTableSeeder;
use console\seeders\RolesTableSeeder;
use console\seeders\UsersTableSeeder;
use yii\console\Controller;

class SeedController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function actionIndex(): int
    {
        try {
            (new ProductTableSeeder())->run();
            (new RolesTableSeeder())->run();
            (new UsersTableSeeder())->run();

            $this->stdout('Тестовые данные успешно добавлены!' . PHP_EOL);
        } catch(\Throwable $e) {
            $this->stdout($e->getMessage() . PHP_EOL);
            return 1;
        }

        return 0;
    }

}
