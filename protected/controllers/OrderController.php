<?php

class OrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','generateOrder','search','list','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model1=order_product::model()->findAllByAttributes(array('order_id'=>$_GET['id']));
		$keyqu = array();
		$quarray = array();
		foreach($model1 as $key => $qu){
			array_push($quarray,$qu->quantity);
			$keyqu[$qu->prod_id]=$qu->quantity;
		}
		$quarray=array_reverse($quarray);
		$this->render('view',array(
			'model'=>$this->loadModel(),
			'quarray' => $quarray,
			'prodqu' => $keyqu
		));
	}

	/**
	 * Add data to Cart.
	 * If addition is successful, the browser will be redirected to the 'cart' page.
	 */
	public function actionGenerateOrder()
	{	$model= new order;
		$model1= new cart;
		$modelop = new order_product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET['id']))
		{
				$model1=cart::model()->findAllByAttributes(array('user_id'=>$_GET['id']));
				date_default_timezone_set('America/Bogota');
				$date = date("Y-m-d H:i:s");
				$model->user_id=$_GET['id'];
				$model->date=$date;
				if($model->save()){
					$model=order::model()->findByAttributes(array('user_id'=>$_GET['id'],'date'=>$date));
					foreach($model1 as $key => $data){
						$modelop = new order_product;
						$modelop->order_id=$model->order_id;
						$modelop->prod_id=$data->prod_id;
						$modelop->quantity=$data->quantity;
						if($modelop->save()){
							$data->delete();
						}
					}
					$this->redirect(array('view', 'id' =>$model->order_id));
				}
		}else{
			throw new CHttpException(400,'The request cannot be fulfilled due to bad syntax.');
		}
	}

	/**
	 * Deletes a particular order.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		$modelop = new order_product;
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$modelop = order_product::model()->findAllByAttributes(array('order_id'=>$_GET['id']));
			foreach($modelop as $key => $op){
				$op->delete();
			}
				$this->loadModel()->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionList()
	{
		$this->render('list',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionSearch()
	{
		$model=new order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['order']))
			$model->attributes=$_GET['order'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=order::model()->findbyPk($_GET['id']);
			if(isset($_GET['u']))
				$this->_model=user::model()->find('username=:usrn',array(':usrn'=>$_GET['u']));
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
