<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'email:email',
            'password_hash',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->humanStatus();
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'visibleButtons' => [
                        'update' => Yii::$app->user->can(\common\rbac\RolesEnum::ROLE_ADMIN),
                        'delete' => Yii::$app->user->can(\common\rbac\RolesEnum::ROLE_ADMIN)
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
