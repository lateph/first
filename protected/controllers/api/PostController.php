<?php

class PostController extends ApiController
{
	public function actionIndex(){
		$posts = Post::model()->findAll();
		$this->send(new ApiList($posts,1,array(
			'id',
			'judul',
			'kategori.id',
			'kategori.nama',
			'kota',
			'totalReview',
			'premium',
		)));
	}
	public function actionKategori(){
		$kategoris = Kategori::model()->findAll();
		$this->send($kategoris);
	}
}