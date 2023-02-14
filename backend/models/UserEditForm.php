<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

/**
 * Edit user form
 */
class UserEditForm extends Model
{
    public int $id;
    public string $username;
    public int $status;
    public string $role;

    /** @var \common\models\User */
    private User $_user;

    /**
     * @param int   $id
     * @param array $config
     */
    public function __construct(int $id, array $config = [])
    {
        parent::__construct($config);

        $this->getUser($id);

        $this->id = $this->_user->id;
        $this->username = $this->_user->username;
        $this->status = $this->_user->status;
        $roles = $this->_user->getRoles($id);
        $this->role = $roles[0];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'status', 'role'], 'required'],
        ];
    }

    /**
     * Сохранить измененные данные пользователя
     * @return bool
     * @throws \Exception
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function save(): bool
    {
        if ($this->validate()) {
            $this->_user->username = $this->username;
            $this->_user->status = $this->status;
            if ($this->_user->save()) {
                Yii::$app->authManager->revokeAll($this->_user->id);
                Yii::$app->authManager->assign(Yii::$app->authManager->getRole($this->role), $this->_user->id);

                return true;
            } else {
                return false;
            }
        }
        
        return false;
    }

    /**
     * Получаем пользователя по id
     *
     * @param int $id
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    protected function getUser(int $id)
    {
        $model = User::findIdentity($id);
        if ($model !== null) {
            $this->_user = $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
