<?php

class DataController extends ApiController
{
	public function actionLokasi(){
		$lokasi = Lokasi::model()->findAll();
		$this->send(new ApiList($lokasi,1));
	}
	public function actionKategori(){
		$kategoris = Kategori::model()->findAll();
		$this->send(new ApiList($kategoris));
	}
}