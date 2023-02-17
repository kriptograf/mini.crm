<?php

namespace console\seeders;

use common\models\Product;
use Faker\Factory;

/**
 * Class BlogTableSeeder
 * Наполнение блога и категорий блога тестовыми данными
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class ProductTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(Product::tableName())->checkIntegrity(false)->execute();

        $items = $this->getData();

        foreach ($items as $item) {
            $model = new Product();
            $model->title = $item['title'];
            $model->price = $item['price'];
            $model->save();
        }
    }

    private function getData()
    {
        $faker = Factory::create();

        return [
            [
                'title' => 'Яблоки',
                'price' => $faker->randomDigit(),
            ],
            [
                'title' => 'Апельсины',
                'price' => $faker->randomDigit(),
            ],
            [
                'title' => 'Мандарины',
                'price' => $faker->randomDigit(),
            ]
        ];
    }
}