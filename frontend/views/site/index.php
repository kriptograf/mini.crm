<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content p-5">

        <div class="row justify-content-center">
            <div class="col-lg-6 card">
                <div class="card-body">
                    <h1>Заявка</h1>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'name')->textInput() ?>

                            <?= $form->field($model, 'phone')->textInput() ?>

                            <?= $form->field($model, 'comment')->textarea() ?>

                            <?= $form->field($model, 'product_id')->dropDownList($products) ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
