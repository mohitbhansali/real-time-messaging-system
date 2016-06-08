<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BadWords */

$this->title = 'Create Bad Words';
$this->params['breadcrumbs'][] = ['label' => 'Bad Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bad-words-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
