<?php
$this->pageTitle= $this->pageTitle.': '.$model->name;
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List category', 'url'=>array('index')),
	array('label'=>'Search category', 'url'=>array('search')),
);
?>

<!--<h1>View category #<?php echo $model->cat_id; ?></h1>-->
<h1>Products</h1>
<!--<h2><?php echo sizeof($model->products)?>-->

<?php foreach($model->products as $product){
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
		'price'
	),
));echo '<br/><hr/>';
}?>
