<?php

class m140903_073506_add_galery_width_height extends CDbMigration
{
	public function up()
	{
		$this->addColumn('t_event_galery','width','int');
		$this->addColumn('t_event_galery','height','int');
	}

	public function down()
	{
		$this->dropColumn('t_event_galery','width');
		$this->dropColumn('t_event_galery','height');
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