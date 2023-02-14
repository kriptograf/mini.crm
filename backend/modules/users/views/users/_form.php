<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-4">
        <?= $form->field($model, 'username')->textInput() ?>
    </div>

    <div class="mb-4">
        <?= $form->field($model, 'status')->dropDownList(\common\models\User::listStatus()) ?>
    </div>

    <div class="mb-4">
        <?= $form->field($model, 'role')->dropDownList(\common\models\User::listRoles()) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
