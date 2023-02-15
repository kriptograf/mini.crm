<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "bid".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 * @property string|null $title
 * @property string|null $client_name
 * @property string|null $phone
 * @property string|null $comment
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Product $product
 * @property User $user
 */
class Bid extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_APPLY = 1;
    const STATUS_REJECT = 2;
    const STATUS_DEFECT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'bid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'product_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'client_name', 'phone'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id'          => 'ID',
            'user_id'     => 'User ID',
            'product_id'  => 'Товар',
            'title'       => 'Название заявки',
            'client_name' => 'Имя клиента',
            'phone'       => 'Телефон',
            'comment'     => 'Комментарий',
            'status'      => 'Статус',
            'created_at'  => 'Дата создания',
            'updated_at'  => 'Дата изменения',
        ];
    }

    /**
     * @return array[]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function behaviors(): array
    {
        return [
            [
                'class'              => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * Список статусов
     * @return string[]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public static function listStatus(): array
    {
        return [
            self::STATUS_NEW    => 'Новая',
            self::STATUS_APPLY  => 'Принята',
            self::STATUS_REJECT => 'Отказана',
            self::STATUS_DEFECT => 'Брак',
        ];
    }

    /**
     * Человекопонятное отображение статуса
     * @return string
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function humanStatus(): string
    {
        $statuses = static::listStatus();

        return $statuses[$this->status];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
