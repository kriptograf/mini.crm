<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Bid $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bid-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Принять', ['apply', 'id' => $model->id], [
            'class' => 'btn btn-outline-success',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Отклонить', ['reject', 'id' => $model->id], [
            'class' => 'btn btn-outline-warning',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Брак', ['defect', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить заявку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                    'attribute' => 'product_id',
                    'value' => function ($model) {
                        return $model->product->title;
                    }
            ],
            'title',
            'client_name',
            'phone',
            'comment:ntext',
            [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return $model->humanStatus();
                    }
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
