<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name=>array('view','id'=>$model->prod_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List product', 'url'=>array('index')),
	array('label'=>'Create product', 'url'=>array('create')),
	array('label'=>'View product', 'url'=>array('view', 'id'=>$model->prod_id)),
	array('label'=>'Manage product', 'url'=>array('admin')),
);
?>

<h1>Update product <?php echo $model->prod_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>