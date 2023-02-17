<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\bids\models\HistoryBids $model */

$this->title = 'Update History Bids: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'History Bids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="history-bids-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
