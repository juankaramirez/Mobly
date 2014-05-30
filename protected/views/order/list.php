<?php
$this->pageTitle='Mobly - Account - Orders';
$this->breadcrumbs=array(
	'Orders',
);

?>

<h1>Orders</h1>
<?php foreach($model->orders as $or){
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$or,
	'attributes'=>array(
		array(
			'label' => 'Order',
			'type' => 'raw',
			'value' => CHtml::link(CHtml::encode($or->order_id),
					   array('order/view', 'id'=>$or->order_id)),
		),
		'date',
	),
));echo '<br/><hr/>';
}
?>
