<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class AddJadwalForm extends EventJadwal
{
	public $repeat;
	public $repeatUntil;
	public $repeatEndDate;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return CMap::mergeArray(parent::rules(),array(
			// email has to be a valid email address
			// verifyCode needs to be entered correctly
			array('repeat','safe'),
			array('repeatEndDate','repeateNull'),
		));
	}

	public function repeateNull($a,$b){
		if($this->repeat and !strtotime($this->repeatEndDate)){
			$this->addError('repeatEndDate','Batas Pengulangan Harus diisi');
		}
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

	const DAILY = 1;
	const EVERY_WEEKDAY = 2;
	const WEEKLY = 3;
	const EVERY_2_WEEKS = 4;
	const MONTHLY_DAY_WEEK = 5;
	const MONTHLY_DATE = 6;
	const YEARLY = 7;

	public static function listRepeat(){
		return array(
			self::DAILY => "Harian",
			//self::EVERY_WEEKDAY => "Harian",
			self::WEEKLY => "Mingguan",
			self::MONTHLY_DATE => "Bulanan",
			self::YEARLY => "Tahunan",
		);
	}

	protected function beforeSave(){
		do{
			$token = $this->getToken(10);
		}while(EventJadwal::model()->find('`key` =:p1',array(':p1'=>$token))!=null);
		$this->key = $token;
		return parent::beforeSave();
	}
	protected function afterSave(){
		
		if($this->repeat == self::DAILY or $this->repeat == self::WEEKLY or $this->repeat == self::MONTHLY_DATE or $this->repeat == self::YEARLY){
			$endRepeat = strtotime($this->repeatEndDate);
			$from = strtotime($this->from);
			$end = strtotime($this->end);
			$diff = $end - $from;
			$date = new DateTime($this->from);
			do{
				$lanjut = false;
				if($this->repeat == self::DAILY){
					$date->modify("+1 day");
				}
				else if($this->repeat == self::WEEKLY){
					$date->modify("+1 week");
				}
				else if($this->repeat == self::MONTHLY_DATE){
					$date->modify("+1 month");
				}
				else if($this->repeat == self::YEARLY){
					$date->modify("+1 year");
				}
				if($date->getTimestamp() <= $endRepeat){
					$lanjut = true;
					$newJadwal = new EventJadwal();
					$newJadwal->from = $date->format('Y-m-d H:i:s');
					$newJadwal->end = date("Y-m-d H:i:s",$date->getTimestamp()+$diff);
					$newJadwal->judul = $this->judul;
					$newJadwal->idEvent = $this->idEvent;
					$newJadwal->key = $this->key;
					$newJadwal->save(false); 
				}
			}while($lanjut);
		}
	}

	function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
	}

	function getToken($length=32){
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    for($i=0;$i<$length;$i++){
	        $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
	    }
	    return $token;
	}
}