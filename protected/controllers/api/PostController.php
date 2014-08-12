<?php

class PostController extends ApiController
{
	public function actionIndex(){
		$posts = Post::model()->findAll();
		$this->send(new ApiList($posts,1,array(
			new ApiCInt('id'),
			'judul',
			new ApiCInt('kategori.id'),
			'kategori.nama',
			'kota',
			'totalReview',
			new ApiCInt('premium'),
		)));
	}
	public function actionKategori(){
		$kategoris = Kategori::model()->findAll();
		$this->send($kategoris);
	}
}