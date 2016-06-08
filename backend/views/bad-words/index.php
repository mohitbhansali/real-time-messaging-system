<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BadWordsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bad Words';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bad-words-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bad Words', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'word',
            'replacement',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
