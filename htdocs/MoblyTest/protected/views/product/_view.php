<div class="view">

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>-->
	<img src='<?php echo Yii::app()->request->baseUrl;?>/images/<?php echo $data->image?>'/>
	<h1><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->prod_id)); ?></h1>
	<br />

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	&#36;<?php echo CHtml::encode($data->price); ?>
	<br />

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('features')); ?>:</b>
	<?php echo CHtml::encode($data->features); ?>
	<br />-->


</div>