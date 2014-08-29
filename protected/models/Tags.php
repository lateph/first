<?php

/**
 * This is the model class for table "t_tags".
 *
 * The followings are the available columns in table 't_tags':
 * @property integer $id
 * @property string $nama
 * @property integer $frequency
 */
class Tags extends CActiveRecord
{
	private static $_items=array(); 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama', 'required'),
			array('frequency', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, frequency', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Nama',
			'frequency' => 'Frequency',
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
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('frequency',$this->frequency);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	      public static function item($domain,$kode)
        {
            if(!isset(self::$_items[$domain]))
            self::loadItems($domain);
            return isset(self::$_items[$domain][$kode]) ? self::$_items[$domain][$kode] : false;
        }    
        
        public static function loadItems()
        {
            //$models= self::model()->findAll();
            $models=self::model()->findAll(array(
                'select'=>'t.nama',
                'distinct'=>true,
                'order'=>'nama',
            ));            
            
            foreach($models as $model)
            self::$_items[]=$model->name;             
            return self::$_items;

        }     
}
