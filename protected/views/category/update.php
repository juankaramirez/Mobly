<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->cat_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List category', 'url'=>array('index')),
	array('label'=>'Create category', 'url'=>array('create')),
	array('label'=>'View category', 'url'=>array('view', 'id'=>$model->cat_id)),
	array('label'=>'Manage category', 'url'=>array('admin')),
);
?>

<h1>Update category <?php echo $model->cat_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>