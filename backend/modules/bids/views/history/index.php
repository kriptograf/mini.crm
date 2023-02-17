<?php

use backend\modules\bids\models\HistoryBids;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'History Bids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-bids-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create History Bids', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'attribute' => 'user_id',
                    'label' => 'Менеджер',
                    'value' => function ($model) {
                        return $model->user->username;
                    }
            ],
            [
                    'attribute' => 'field',
                    'label' => 'Изменилось поле',
                    'value' => function ($model) {
                        return $model->hasChangedFieldName($model->field);
                    }
            ],
            'old_value:ntext',
            'new_value:ntext',
            'created_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, HistoryBids $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
