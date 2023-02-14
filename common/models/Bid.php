<?php

namespace common\models;

use Yii;

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
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'title' => 'Title',
            'client_name' => 'Client Name',
            'phone' => 'Phone',
            'comment' => 'Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
