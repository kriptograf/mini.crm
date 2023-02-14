<?php

namespace console\seeders;

/**
 * Interface ITableSeeder
 *
 * @package console\seeders
 * @author Виталий Москвин <foreach@mail.ru>
 */
interface ITableSeeder
{
    /**
     * Запуск массовой вставки данных в БД
     * @return mixed
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function run();
}