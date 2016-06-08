<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?>
<?php $this->beginContent('@app/views/layouts/main.php');?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">
				MAIN NAVIGATION
			</li>
			<li <?php 
                    if ($controller=="site" && $action=="index") {
                        echo 'class="active treeview"'; } ?> >
				<a href="<?= Yii::$app->homeUrl; ?>"> 
				    <i class="fa fa-dashboard"></i> 
				    <span>Dashboard</span>
				</a>
			</li>
			<li <?php
                if ($controller=="user") {
                    echo 'class="active treeview"'; } ?> >
                <a href="<?= Yii::$app->urlManager->createUrl('user/index');?>"> <i class="fa fa-circle-o"></i> <span>Users</span></a>
            </li>
            <li <?php
            if ($controller=="bad-words") {
                echo 'class="active treeview"'; } ?> >
                <a href="<?= Yii::$app->urlManager->createUrl('bad-words/index');?>"> <i class="fa fa-folder"></i> <span>Bad Words</span> </a>
            </li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
    		<?= Html::encode($this->title) ?>
        	<small>Control panel</small>
        </h1>
         <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>

    <?php echo $content; ?>
</div><!-- /.content-wrapper -->

<?php $this->endContent();?>