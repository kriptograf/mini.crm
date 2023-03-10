<?php

namespace console\seeders;

use common\rbac\RolesEnum;
use Yii;

/**
 * Class RolesTableSeeder
 * Наполнение таблицы ролей
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class RolesTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     * @throws \yii\base\Exception
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable('auth_assignment')->checkIntegrity(false)->execute();
        \Yii::$app->db->createCommand()->truncateTable('auth_item_child')->checkIntegrity(false)->execute();
        \Yii::$app->db->createCommand()->truncateTable('auth_item')->checkIntegrity(false)->execute();
        \Yii::$app->db->createCommand()->truncateTable('auth_rule')->checkIntegrity(false)->execute();

        /** @var \yii\rbac\DbManager $auth */
        $auth = Yii::$app->authManager;

        // -- Роли
        $manager = $auth->createRole(RolesEnum::ROLE_MANAGER);
        $manager->description = 'Менеджер';
        $auth->add($manager);

        $admin = $auth->createRole(RolesEnum::ROLE_ADMIN);
        $admin->description = 'Администратор';
        $auth->add($admin);

        $auth->addChild($admin, $manager);
    }
}