<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>

<div class="row-fluid">
  <div class="span15 ">
	<h1 style="font-size: 55px;">Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
	</br>
	<p style="font-size: 25px;">Take a look to our products, maybe you want something.</p>
   </div>
</div>

