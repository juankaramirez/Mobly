<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $prod_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property double $price
 * @property string $features
 */
class product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, image, price, features', 'required'),
			array('price', 'numerical'),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>1000),
			array('image', 'length', 'max'=>100),
			array('features', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prod_id, name, description, image, price, features', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'users' => array(self::MANY_MANY, 'User', 'cart(user_id, prod_id)'),
			'categories' => array(self::MANY_MANY, 'Category', 'category_product(cat_id, prod_id)'),
			'orders' => array(self::MANY_MANY, 'Order', 'order_product(order_id, prod_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prod_id' => 'Prod',
			'name' => 'Name',
			'description' => 'Description',
			'image' => 'Image',
			'price' => 'Price',
			'features' => 'Features',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('prod_id',$this->prod_id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('description',$this->description,true);

		$criteria->compare('image',$this->image,true);

		$criteria->compare('price',$this->price);

		$criteria->compare('features',$this->features,true);

		return new CActiveDataProvider('product', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}