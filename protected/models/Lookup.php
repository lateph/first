<?php

/**
 * This is the model class for table "{{lookup}}".
 *
 * The followings are the available columns in table '{{lookup}}':
 * @property integer $id
 * @property string $nama
 * @property string $kode
 * @property string $tipe
 * @property integer $posisi
 */
class Lookup extends CActiveRecord
{
	/**
	 * @return string the associated database table nama
	 */
        private static $_items=array();     
	public function tableName()
	{
		return 't_lookup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, kode, tipe, posisi', 'required'),
			array('posisi', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>64),
			array('kode', 'length', 'max'=>8),
			array('tipe', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, kode, tipe, posisi', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation nama and the related
		// class nama for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (nama=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Name',
			'kode' => 'Kode',
			'tipe' => 'Type',
			'posisi' => 'Position',
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
		// @todo Please modify the following kode to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('kode',$this->kode,true);
		$criteria->compare('tipe',$this->tipe,true);
		$criteria->compare('posisi',$this->posisi);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class nama.
	 * @return Lookup the static model class
	 */

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function items($tipe)
        {
            if(!isset(self::$_items[$tipe]))
            self::loadItems($tipe);
            return self::$_items[$tipe];
        }        
        public static function item($tipe,$kode)
        {
            if(!isset(self::$_items[$tipe]))
            self::loadItems($tipe);
            return isset(self::$_items[$tipe][$kode]) ? self::$_items[$tipe][$kode] : false;
        }
        private static function loadItems($tipe)
        {
            self::$_items[$tipe]=array();
            $models=self::model()->findAll(array(
                'condition'=>'tipe=:tipe',
                'params'=>array(':tipe'=>$tipe),
                'order'=>'posisi',
            ));
            foreach($models as $model)
            self::$_items[$tipe][$model->kode]=$model->nama;
        }    
}
