<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Banana Bandy | Admin Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php $this->head() ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
    <?php $this->beginBody() ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= Yii::$app->homeUrl;?>"><b>Banana</b>Bandy</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">
                Please fill out the following fields to login:
            </p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="form-group has-feedback">
                <?= $form->field($model, 'email', [
                    'template' => "{input}\n{hint}\n{error}"
                ])->textInput(array('placeholder' => 'Email'))->label(false); ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?= $form->field($model, 'password', [
                    'template' => "{input}\n{hint}\n{error}"
                ])->passwordInput(array('placeholder' => 'Password'))->label(false); ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                </div><!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div><!-- /.col -->
            </div>
            <?php ActiveForm::end(); ?>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass : 'icheckbox_square-blue',
                radioClass : 'iradio_square-blue',
                increaseArea : '20%' // optional
            });
        });
    </script>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>