<?php

namespace frontend\models;

use common\models\Bid;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * BidForm is the model behind the send client request form.
 */
class BidForm extends Model
{
    public $title;
    public $name;
    public $phone;
    public $comment;
    public $product_id;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['title', 'name', 'phone', 'comment', 'product_id'], 'required'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя клиента',
            'title' => 'Название заявки',
            'phone' => 'Телефон',
            'comment' => 'Комментарий',
            'product_id' => 'Товар',
            'verifyCode' => 'Проверочный код',
        ];
    }

    public function send(): bool
    {
        $model = new Bid();
        $model->title = $this->title;
        $model->client_name = $this->name;
        $model->phone = $this->phone;
        $model->product_id = $this->product_id;
        $model->comment = $this->comment;

        return $model->save();
    }
}
