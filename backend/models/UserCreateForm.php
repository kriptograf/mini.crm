<?php

namespace backend\models;

use common\models\User;
use common\rbac\RolesEnum;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * Create user form
 */
class UserCreateForm extends Model
{
    public string $username;
    public string $email;
    public string $password;
    public int $status;
    public string $role;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->status = User::STATUS_ACTIVE;
        $this->role = RolesEnum::ROLE_MANAGER;
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'status', 'role'], 'required'],
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Сохранить данные пользователя
     * @return bool
     * @throws \Exception
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function save(): ?bool
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if ($user->save()) {
            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($this->role), $user->id);

            return true;
        }

        return false;
    }

    public function loadDefaultValues()
    {
    }
}
