<?php

/**
 * This is the model class for table "t_event_jadwal".
 *
 * The followings are the available columns in table 't_event_jadwal':
 * @property integer $id
 * @property integer $idEvent
 * @property string $judul
 * @property string $from
 * @property string $end
 * @property string $key
 */
class EventJadwal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventJadwal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_event_jadwal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('judul', 'required'),
			array('idEvent', 'numerical', 'integerOnly'=>true),
			array('judul', 'length', 'max'=>256),
			array('key', 'length', 'max'=>10),
			array('from, end', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idEvent, judul, from, end, key', 'safe', 'on'=>'search'),
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
			'idEvent' => 'Id Event',
			'judul' => 'Judul',
			'from' => 'From',
			'end' => 'End',
			'key' => 'Key',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idEvent',$this->idEvent);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('key',$this->key,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}