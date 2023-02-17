<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\bids\models\HistoryBids $model */

$this->title = 'Create History Bids';
$this->params['breadcrumbs'][] = ['label' => 'History Bids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-bids-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
