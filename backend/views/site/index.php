<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Banana Bandy - Dashboard';
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3>Recent Added Users</h3>
                    <div class="box-body">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'name',
                                'email',

                                [
                                    'attribute' => 'user_type',
                                    'value' => function ($model) {
                                        return $model->user_type == 2 ? 'User' : ($model->user_type == 3 ? 'Moderator' : '-');
                                    },
                                    'filter' => Html::activeDropDownList($searchModel, 'user_type', ["2"=>"User", "3"=>"Moderator"]
                                        ,['class'=>'form-control','prompt' => 'Select User Type']),
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return $model->status == 1 ? 'Active' : 'Inactive';
                                    },
                                    'filter' => Html::activeDropDownList($searchModel, 'status', array("1"=>"Active", "0"=>"Inactive"),['class'=>'form-control','prompt' => 'Select']),
                                ],

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                ],
                            ],
                        ]); ?>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->