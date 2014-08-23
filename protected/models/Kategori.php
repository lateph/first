<?php

/**
 * This is the model class for table "t_kategori".
 *
 * The followings are the available columns in table 't_kategori':
 * @property integer $id
 * @property string $nama
 * @property integer $idParent
 * @property integer $urut
 * @property string $aktif
 */
class Kategori extends CActiveRecord
{
	const STATUS_AKTIF=1;
	const STATUS_NON_AKTIF=0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_kategori';
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
			array('idParent, urut', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>512),
			array('aktif', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, idParent, urut, aktif', 'safe', 'on'=>'search'),
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
			'parent'=>array(self::BELONGS_TO,'Kategori','idParent'),
			'childs'=>array(self::HAS_MANY,'Kategori','idParent'),
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
			'idParent' => 'ID Parent',
			'urut' => 'Urut',
			'aktif' => 'Aktif',
			'parent.nama' => 'Parent',
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
		$criteria->compare('idParent',$this->idParent);
		$criteria->compare('urut',$this->urut);
		$criteria->compare('aktif',$this->aktif,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kategori the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function listStatus(){
		return array(
			self::STATUS_AKTIF => 'Aktif',
			self::STATUS_NON_AKTIF => 'Tidak Aktif',
		);
	}

	public static function fetchChild($id,$sub=0,$except=null){
		$data = array();
		$criteria = new CDbCriteria();
		$criteria->addCondition('idParent = :id');
		$criteria->params[':id'] = $id;
		$criteria->order = 'urut ASC';
		$kategoris = Kategori::model()->findAll($criteria);
		foreach ($kategoris as $key => $value) {
			if($value->id === $except){
				continue;
			}
			$data[] = array(
				'id'=>$value->id,
				'nama'=>$value->nama,
				'sub'=>$sub,
			);
			if(count($value->childs) > 0){
				foreach (self::fetchChild($value->id,$sub+1,$except) as $key2 => $value2) {
					$data[] = $value2;
				}
			}
		}
		return $data;
	}
	public static function listParent($except=null){
		$ret = array(
			0=>'No Parent',
		);
		$arrs = self::fetchChild(0,0,$except);
		foreach ($arrs as $key => $value) {
			$id = $value['id'];
			$text = '|---';
			for ($i = 0 ; $i < $value['sub'];$i++) {
				$text.='---';
			}
			$text.=$value['nama'];
			$ret[$id] = $text;
		}
		return $ret;
	}

	public function getStatus(){
		$ar = self::listStatus();
		return @$ar[$this->aktif];
	}

	protected function beforeSave(){
		if($this->isNewRecord){
			if($this->idParent === null){
				$this->idParent = 0;
			}
			if($this->aktif === null){
				$this->aktif = 1;
			}
		}
		return parent::beforeSave();
	}

	public function parentName(){
		if($this->idParent == 0){
			return 'No Parent';
		}
		else{
			return @$this->parent->nama;
		}
	}
}
