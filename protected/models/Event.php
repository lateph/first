<?php

/**
 * This is the model class for table "t_event".
 *
 * The followings are the available columns in table 't_event':
 * @property integer $id
 * @property string $title
 * @property string $date_publish
 * @property string $description
 * @property string $tags
 * @property string $thumb
 * @property integer $type
 * @property string $provinsi_id
 * @property string $kabkota_id
 * @property integer $organizer_id
 * @property string $status_bayar
 * @property string $status_proses
 * @property string $date_create
 * @property integer $user_create
 * @property string $status
 */
class Event extends CActiveRecord
{
	const TIPE_STATUS_BAYAR = 'EventStatusBayar';
	const TIPE_STATUS_PROSES = 'EventStatusProses';
	const TIPE_STATUS = 'EventStatus';

	const STATUS_BAYAR = 1;
	const STATUS_BELUM_BAYAR = 0;

	const STATUS_PROSES = 1;
	const STATUS_BELUM_PROSES = 0;

	const STATUS_AKTIF = 1;
	const STATUS_NOT_AKTIF = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, date_publish, description, type, provinsi_id, status_bayar, status_proses, status', 'required'),
			array('type, organizer_id, user_create', 'numerical', 'integerOnly'=>true),
			array('title, thumb', 'length', 'max'=>512),
			array('provinsi_id, kabkota_id, status_bayar, status_proses, status', 'length', 'max'=>8),
			array('tags', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, date_publish, description, tags, thumb, type, provinsi_id, kabkota_id, organizer_id, status_bayar, status_proses, date_create, user_create, status', 'safe', 'on'=>'search'),
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
			'galerys'=>array(self::HAS_MANY,'EventGalery','idEvent'),
			'cover'=>array(self::BELONGS_TO,'EventGalery','idGalery'),
			'jadwals'=>array(self::HAS_MANY,'EventJadwal','idEvent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'date_publish' => 'Date Publish',
			'description' => 'Description',
			'tags' => 'Tags',
			'thumb' => 'Thumb',
			'type' => 'Type',
			'provinsi_id' => 'Provinsi',
			'kabkota_id' => 'Kabkota',
			'organizer_id' => 'Organizer',
			'status_bayar' => 'Status Bayar',
			'status_proses' => 'Status Proses',
			'date_create' => 'Date Create',
			'user_create' => 'User Create',
			'status' => 'Status',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_publish',$this->date_publish,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('provinsi_id',$this->provinsi_id,true);
		$criteria->compare('kabkota_id',$this->kabkota_id,true);
		$criteria->compare('organizer_id',$this->organizer_id);
		$criteria->compare('status_bayar',$this->status_bayar,true);
		$criteria->compare('status_proses',$this->status_proses,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('user_create',$this->user_create);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeSave(){
		if($this->isNewRecord){
			$this->date_create = date('Y-m-d H:i:s');
			$this->user_create = date('Y-m-d H:i:s');
		}
		return parent::beforeSave();
	}

	public function getImageCover($width=270){
		if($this->cover){
			$height = $this->cover->width / $this->cover->height * $width;

			$url = LUpload::thumbs('EventGalery',$this->cover->file,$width.'x'.$height);
			return (object)array(
				'height' => $height,
				'width' => $width,
				'url'=>$url,
			);
		}
		else{
			return (object)array(
				'height' => 270,
				'width' => 197,
				'url'=>Yii::app()->theme->baseUrl.'/images/placeholder.jpg',
			);
		}
	}

	public function excerpt($limit=20){
		$words = explode(' ', strip_tags($this->description) );

	    //if excerpt has more than 20 words, truncate it and append ... 
	    if( count($words) > 20 ){
	        return sprintf("%s ...", implode(' ', array_slice($words, 0, $limit)) );
	    }

	    //otherwise just put it back together and return it
	    return implode(' ', $words);
	}
}
