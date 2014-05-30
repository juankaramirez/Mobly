<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->order_id=>array('view','id'=>$model->order_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List order', 'url'=>array('index')),
	array('label'=>'Create order', 'url'=>array('create')),
	array('label'=>'View order', 'url'=>array('view', 'id'=>$model->order_id)),
	array('label'=>'Manage order', 'url'=>array('admin')),
);
?>

<h1>Update order <?php echo $model->order_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>