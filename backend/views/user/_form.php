<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'user_type')->dropDownList(['2' => 'User', '3' => 'Moderator']); ?>
    </div>

    <div class="col-md-12 form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>
