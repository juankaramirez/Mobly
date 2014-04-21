<?php
$this->pageTitle=$this->pageTitle. ': '.$model->username;
$this->breadcrumbs=array(
	'Cart',
);

$this->menu=array(
	array('label'=>'Generate order', 'url'=>array('order/generateOrder','id'=>$model->user_id)),
	array('label'=>'Clear cart', 'url'=>array('order/delete',)),
);
?>
<h1>Current products</h1>

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
		array(
			'type' => 'raw',
			'value' => CHtml::link('Delete', array('product/deleteFromCart', 'prod_id'=>$product->prod_id, 'user'=>Yii::app()->user->name)),			
			),
	),
));echo '<br/><hr/>';
}?>