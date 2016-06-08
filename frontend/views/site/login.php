<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row-fluid user-row">
                        <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                    </div>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <fieldset>
                            <label class="panel-login">
                                <div class="login_result"></div>
                            </label>
                            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(false) ?>
                            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
                            <br>
                            <?= Html::submitButton('Login >>', ['class' => 'btn btn-lg btn-info btn-block', 'name' => 'login-button']) ?>
                        </fieldset>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
