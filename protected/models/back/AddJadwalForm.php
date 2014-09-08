<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class AddJadwalForm extends EventJadwal
{
	public $repeat;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return CMap::mergeArray(parent::rules(),array(
			// email has to be a valid email address
			// verifyCode needs to be entered correctly
		));
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(parent::attributeLabels(),array(
			'verifyCode'=>'Verification Code',
		));
	}

	
}