<?php

class m140901_085000_idgalery extends CDbMigration
{
	public function up()
	{
		$this->addColumn('t_event','idGalery','int');
	}

	public function down()
	{
		$this->dropColumn('t_event','idGalery');
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