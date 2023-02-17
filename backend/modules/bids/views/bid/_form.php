<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Bid $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bid-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-4">
    <?= $form->field($model, 'product_id')->dropDownList($products, ['text' => 'Выберите товар', 'options' => ['value' => 'none', 'class' => 'prompt', 'label' => 'Выберите']]) ?>
    </div>

    <div class="mb-4">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="mb-4">
    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="mb-4">
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="mb-4">
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    </div>

    <div class=mb-4">
    <?= $form->field($model, 'status')->dropDownList(\common\models\Bid::listStatus(), ['text' => 'Выберите статус', 'options' => ['value' => 'none', 'class' => 'prompt', 'label' => 'Select']]) ?>
    </div>

    <div class="mb-4 pt-5">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
