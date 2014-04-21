<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List category', 'url'=>array('index')),
	array('label'=>'Manage category', 'url'=>array('admin')),
);
?>

<h1>Create category</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>