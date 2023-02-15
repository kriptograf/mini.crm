<?php

use common\models\Bid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bid-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'client_name',
            'title',
            [
                    'attribute' => 'product_id',
                    'value' => function ($model) {
                        return $model->product->title;
                    }
            ],
            'phone',
            'created_at',
            [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return $model->humanStatus();
                    }
            ],
            [
                    'attribute' => 'comment',
                    'value' => function ($model) {
                        return \yii\helpers\StringHelper::truncateWords($model->comment, 6);
                    }
            ],
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return $model->product->price;
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Bid $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
