<?php

class DataController extends ApiController
{
	public function actionLokasi(){
		$lokasi = Lokasi::model()->findAll();
		$this->send($lokasi);
	}
	public function actionKategori(){
		$kategoris = Kategori::model()->findAll();
		$this->send($kategoris);
	}
}