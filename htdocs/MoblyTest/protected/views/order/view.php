<?php
$this->pageTitle=$this->pageTitle.' #'.$model->order_id;
$this->breadcrumbs=array(
	'Orders'=>array('list','u'=>$model->user->username),
	$model->order_id,
);

$this->menu=array(
	/*array('label'=>'List order', 'url'=>array('index')),
	array('label'=>'Create order', 'url'=>array('create')),
	array('label'=>'Update order', 'url'=>array('update', 'id'=>$model->order_id)),*/
	array('label'=>'Delete order', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage order', 'url'=>array('search')),
);
?>

<h1>View order #<?php echo $model->order_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label' =>'Customer',
			'type' => 'raw',
			'value' => $model->user->name." ".$model->user->lastname,
		),
		array(
			'label' =>'Address',
			'type' => 'raw',
			'value' => $model->user->address,
		),
		'date',
	),
));echo '<br/><hr/>';?>
<h2>Items:</h2>
<?php
foreach($model->products as $product){
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$product,
	'attributes'=>array(
		array(
			'type' => 'raw',
			'value' => CHtml::link(CHtml::encode($product->name),
					   array('product/view', 'id'=>$product->prod_id)),
		),
		array(
			'type' => 'image',
			'value' => 'images/'.$product->image,
		),
		'price',
		array(
			'label' => 'Quantity',
			'type' => 'number',
			'value' => array_pop($quarray)
		),
	),
));echo '<br/><hr/>';
}
 ?>
