<?php

class ProductController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('addToCart','deleteFromCart','search'),
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
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Add data to Cart.
	 * If addition is successful, the browser will be redirected to the 'cart' page.
	 */
	public function actionAddToCart()
	{	$model= new cart;
		$modelu= new user;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET['prod_id']))
		{
			$modelu=user::model()->find('username=:usrn',array(':usrn'=>$_GET['user']));
			$model=cart::model()->findByAttributes(array('user_id'=>$modelu->user_id, 'prod_id'=>$_GET['prod_id']));
			if($model===null){
				$model = new cart;
				$model->user_id=$modelu->user_id;
				$model->prod_id=$_GET['prod_id'];
				$model->quantity=1;
			}else{
				$model->quantity=$model->quantity+1;
			}
			
			if($model->save())
				$this->redirect(array('user/cart','id'=>$model->user_id));
		}
	}
	
	/**
	 * Delete data to Cart.
	 * If addition is successful, the browser will be redirected to the 'cart' page.
	 */
	public function actionDeleteFromCart()
	{	$model= new cart;
		$modelu= new user;

		if(isset($_GET['prod_id']))
		{
			$modelu=user::model()->find('username=:usrn',array(':usrn'=>$_GET['user']));
			$model=cart::model()->findByAttributes(array('user_id'=>$modelu->user_id, 'prod_id'=>$_GET['prod_id']));
			$model->quantity=$model->quantity-1;
			if($model->quantity===0)
				$model->delete();
				
			if($model->save())
				$this->redirect(array('user/cart','id'=>$modelu->user_id));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	 
	public function actionSearch()
	{
		$model=new product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['product']))
			$model->attributes=$_GET['product'];

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
				$this->_model=product::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
