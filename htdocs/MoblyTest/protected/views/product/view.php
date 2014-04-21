<?php
$this->pageTitle=$this->pageTitle.': '.$model->name;
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

/*$this->menu=array(
	array('label'=>'List product', 'url'=>array('index')),
	array('label'=>'Create product', 'url'=>array('create')),
	array('label'=>'Update product', 'url'=>array('update', 'id'=>$model->prod_id)),
	array('label'=>'Delete product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->prod_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Search product', 'url'=>array('search')),
);*/
?>

<h1><?php echo $model->name; ?></h1>
<h3>Details:</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	array(
			'type' => 'image',
			'value' => 'images/'.$model->image,
		),
		'description',
		'price',
		'features',
		array(
			'type' => 'raw',
			
			'value' => CHtml::link('Add to cart', array('addToCart', 'prod_id'=>$model->prod_id, 'user'=>Yii::app()->user->name))
			/*CHtml::linkButton('Add', array(
				'submit' => 'product/addcart',
				'params' => array(
					'prod_id'=>$model->prod_id, 
					'user'=>Yii::app()->user->name
					)
				))*/
			),
		),
));
//echo $this->renderPartial('_formcart', array('model'=>$model));
 ?>