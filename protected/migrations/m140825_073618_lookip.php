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
            $this->createIndex('t_tipe', 't_lookup', 'tipe', true);
            $this->createIndex('t_tipe_kode', 't_lookup', 'tipe,kode', true);
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