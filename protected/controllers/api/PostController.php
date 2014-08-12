<?php

class PostController extends ApiController
{
	public function actionIndex(){
		$perPage = 10;
		$criteria = new CDbCriteria();
		$criteria->with = array('kategori','totalReview');
		$criteria->limit  = $perPage;
		$criteria->offset = ((isset($_POST['page']) ? $_POST['page'] : 1)-1) * $perPage;
		$criteria->addCondition('t.status = :status');
		$criteria->params[':status'] = Post::STATUS_AKTIF;
		$posts = Post::model()->findAll($criteria);
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
		$this->send(new ApiList($kategoris,1));
	}
}