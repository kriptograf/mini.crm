<?php

namespace console\seeders;

use common\models\User;
use common\rbac\RolesEnum;
use Yii;

/**
 * Class UsersTableSeeder
 * Наполнение таблицы пользователей первичными данными
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class UsersTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     * @throws \yii\db\Exception
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(User::tableName())->execute();

        $items = $this->getData();

        $auth = Yii::$app->authManager;

        foreach ($items as $item) {
            $user = new User();
            $user->username = $item['username'];
            $user->email = $item['email'];
            $user->setPassword($item['password']);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                $role = $auth->getRole($item['role']);
                $auth->assign($role, $user->getId());
            }
        }
    }

    /**
     * @return \string[][]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    private function getData(): array
    {
        $users = [
            [
                'username'  => 'admin',
                'email'      => 'admin@example.com',
                'password'   => '123456',
                'role' => RolesEnum::ROLE_ADMIN,
            ],
        ];

        return array_merge($users, $this->getManagers());

    }

    private function getManagers(): array
    {
        $result = [];

        for ($i = 1; $i < 30; $i++) {
            $result[] = [
                'username'  => 'manager' . $i,
                'email'      => 'manager' . $i . '@example.com',
                'password'   => '123456',
                'role' => RolesEnum::ROLE_MANAGER,
            ];
        }

        return $result;
    }
}