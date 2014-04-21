<?php
$this->pageTitle='Mobly - Account';
$this->breadcrumbs=array(
	'Account',
);

$this->menu=array(
	array('label'=>'See orders', 'url'=>array('list','u'=>Yii::app()->user->name)),
	//array('label'=>'Manage order', 'url'=>array('admin')),
);
?>

<h1>Welcome <?php echo Yii::app()->user->name; ?></h1>

