<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'email:email',
                        [
                            'label'=>'User Type',
                            'value'=>$model->user_type == 2 ? 'User' : ($model->user_type == 3 ? 'Moderator' : '')
                        ],
                        [
                            'label'=>'Status',
                            'value'=>$model->status == 1 ? 'Active' : ($model->status == 0 ? 'Inactive' : 'No Status Defined'),
                        ],
                    ],
                ]) ?>
            </div><!-- /.col-->
        </div><!-- ./row -->
</section><!-- /.content -->