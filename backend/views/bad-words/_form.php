<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BadWords */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bad-words-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'word')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'replacement')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>
