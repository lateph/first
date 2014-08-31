<?php

class m140825_073618_lookip extends CDbMigration
{
	public function up()
	{
		   $this->createTable('t_lookup', array(
			    'id'=>'pk',
			    'nama'=>'varchar(64) NOT NULL',
			    'kode'=>'varchar(8) NOT NULL',
			    'tipe'=>'varchar(32) NOT NULL',
			    'posisi'=>'int',
			));           
            $this->createIndex('t_tipe', 't_lookup', 'tipe');
            $this->createIndex('t_tipe_kode', 't_lookup', 'tipe,kode', true);

            $this->insert('t_lookup',array(
	        	'nama'=>'Bayar',
	        	'kode'=>Event::STATUS_BAYAR,
	        	'tipe'=>Event::TIPE_STATUS_BAYAR,
	        	'posisi'=>1,
            ));

            $this->insert('t_lookup',array(
	        	'nama'=>'Belum Bayar',
	        	'kode'=>Event::STATUS_BELUM_BAYAR,
	        	'tipe'=>Event::TIPE_STATUS_BAYAR,
	        	'posisi'=>2,
            ));

            //=====================================

            $this->insert('t_lookup',array(
	        	'nama'=>'Proses',
	        	'kode'=>Event::STATUS_PROSES,
	        	'tipe'=>Event::TIPE_STATUS_PROSES,
	        	'posisi'=>1,
            ));

            $this->insert('t_lookup',array(
	        	'nama'=>'Belum Proses',
	        	'kode'=>Event::STATUS_BELUM_PROSES,
	        	'tipe'=>Event::TIPE_STATUS_PROSES,
	        	'posisi'=>2,
            ));

            //=====================================

            $this->insert('t_lookup',array(
	        	'nama'=>'Aktif',
	        	'kode'=>Event::STATUS_AKTIF,
	        	'tipe'=>Event::TIPE_STATUS,
	        	'posisi'=>1,
            ));

            $this->insert('t_lookup',array(
	        	'nama'=>'Not Aktif',
	        	'kode'=>Event::STATUS_NOT_AKTIF,
	        	'tipe'=>Event::TIPE_STATUS,
	        	'posisi'=>2,
            ));

            
	}

	public function down()
	{
		$this->dropTable('t_lookup');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}