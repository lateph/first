<?php

/**
 * This is the model class for table "t_event_galery".
 *
 * The followings are the available columns in table 't_event_galery':
 * @property integer $id
 * @property integer $idEvent
 * @property string $file
 */
class EventGalery extends CActiveRecord
{
	public $imageFile;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_event_galery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEvent', 'numerical', 'integerOnly'=>true),
			array('file', 'length', 'max'=>64),

			array('imageFile', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true,'on'=>'create'),
			array('imageFile', 'required','on'=>'create'),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idEvent, file', 'safe', 'on'=>'search'),
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
			'file' => 'File',
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
		$criteria->compare('idEvent',$this->idEvent);
		$criteria->compare('file',$this->file,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventGalery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function afterSave(){
		if($this->post->galeryId == null){
			$this->post->galeryId = $this->id;
			if(!$this->post->save()){
				print_r($this->post->getErrors());
				exit;	
			}
		}
		return parent::afterSave();
	}
}
