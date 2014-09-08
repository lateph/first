<?php

class m140908_103408_event_jadwal extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_event_jadwal', array(
			'id'=>'pk',
			'idEvent'=>'int',
	        'judul'=>'varchar(256) NOT NULL',
	        'from'=>'datetime',
	        'end'=>'datetime',
	        'key'=>'varchar(10)',
        )); 
        $this->createIndex('index_event', 't_event_jadwal', 'idEvent');
		$this->createIndex('index_key', 't_event_jadwal', 'key');
	}

	public function down()
	{
		$this->dropTable('t_event_jadwal');
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