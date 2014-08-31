<?php

class m140831_114403_galery extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_event_galery',array(
			'id'=>'pk',
			'idEvent'=>'int',
			'file'=>'varchar(64)',
		));
		$this->createIndex('idevent','t_event_galery','idEvent');
	}

	public function down()
	{
		$this->dropTable('t_event_galery');
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