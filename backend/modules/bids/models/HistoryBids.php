<?php

namespace backend\modules\bids\models;

use common\models\Bid;
use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "history_bids".
 *
 * @property int $id
 * @property int|null $bid_id
 * @property int|null $user_id
 * @property string|null $field
 * @property string|null $old_value
 * @property string|null $new_value
 * @property string|null $created_at
 *
 * @property Bid $bid
 * @property User $user
 */
class HistoryBids extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'history_bids';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bid_id', 'user_id'], 'default', 'value' => null],
            [['bid_id', 'user_id'], 'integer'],
            [['old_value', 'new_value'], 'safe'],
            [['created_at'], 'safe'],
            [['field'], 'string', 'max' => 255],
            [['bid_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bid::class, 'targetAttribute' => ['bid_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bid_id' => 'Заявка',
            'user_id' => 'Пользователь',
            'field' => 'Поле',
            'old_value' => 'Старое значение',
            'new_value' => 'Новое значение',
            'created_at' => 'Дата изменения',
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class'              => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value'              => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * Вернуть название атрибута
     *
     * @param $attribute
     *
     * @return mixed|string
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function hasChangedFieldName($attribute)
    {
        $fields = $this->bid->attributeLabels();

        return $fields[$attribute];
    }

    /**
     * Gets query for [[Bid]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBid()
    {
        return $this->hasOne(Bid::class, ['id' => 'bid_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function writeHistory($bidId, $changedAttributes, $newAttributes)
    {
        unset($changedAttributes['updated_at']);
        //echo VarDumper::dump([$changedAttributes, $newAttributes],10,true);exit;
        foreach ($changedAttributes as $key => $value) {
            $model = new self();
            $model->bid_id = $bidId;
            $model->user_id = Yii::$app->user->id;
            $model->field = $key;
            $model->old_value = $value;
            $model->new_value = $newAttributes[$key];
            if (!$model->save()) {
                echo VarDumper::dump($model->getErrors(),10,true);exit;
            }
        }
    }
}
