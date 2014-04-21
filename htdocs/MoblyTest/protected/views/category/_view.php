<div class="view">

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('cat_id')); ?>:</b>-->
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->cat_id)); ?>
	

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />-->


</div>