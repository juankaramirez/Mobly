<?php

class UserController extends Controller
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
		
			array('allow', // allow all users to perform 'create' action
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'cart' action
				'actions'=>array('cart'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new user;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['user']))
		{
			$model->attributes=$_POST['user'];
			if($model->save())
				$this->redirect(Yii::app()->homeUrl);
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the user model based on the primary key given in the GET variable,
	 * in order to show the cart that belongs to the user.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function actionCart()
	{
		$modelc = new cart;
		if(isset($_GET['u'])){
			$modelu=user::model()->find('username=:usrn',array(':usrn'=>$_GET['u']));
		}elseif(isset($_GET['id'])){
			$modelu=user::model()->findByPK($_GET['id']);
		}
		$model1=cart::model()->findAllByAttributes(array('user_id'=>$modelu->user_id));
		$keyqu = [];
		$quarray = [];
		foreach($model1 as $key => $qu){
			array_push($quarray,$qu->quantity);
			$keyqu[$qu->prod_id]=$qu->quantity;
		}
		$quarray=array_reverse($quarray);
		
		$this->render('cart', array(
			'model'=>$this->loadModel(),
			'quarray' => $quarray,
			'prodqu' => $keyqu
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
				$this->_model=user::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
