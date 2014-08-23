<?php

class m140808_191410_add_new_schema extends CDbMigration
{
	public function up()
	{
            $this->createTable('t_provinsi', array(
                    'id'=>'pk',
                    'kode'=>'varchar(8) NOT NULL',
                    'nama'=>'varchar(256) NOT NULL',
            ));           
            $this->createIndex('t_provinsi_kode', 't_provinsi', 'kode', true);
            $this->createTable('t_tags', array(
                    'id'=>'pk',
                    'nama'=>'varchar(256) NOT NULL',
                    'frequency'=>'integer NULL',
            ));      
            
            $this->createTable('t_kabkota', array(
                    'id'=>'pk',
                    'kode'=>'varchar(8) NOT NULL',
                    'kode_provinsi'=>'varchar(8) NOT NULL',
                    'nama'=>'varchar(256) NOT NULL',                    
            ));     
            $this->createIndex('t_kabkota_kode_provinsi', 't_kabkota', 'kode, kode_provinsi', true);
            $this->createTable('t_kategori', array(
                    'id'=>'pk',
                    'nama'=>'varchar(512) NOT NULL',   
                    'parent_kategori'=>'integer NULL',
                    'urut'=>'smallint NULL',
                    'aktif'=>'varchar(8) NULL',
            ));                          
            $this->createIndex('t_kategori_nama', 't_kategori', 'nama', true);
            
            $this->createTable('t_event_type', array(
                    'id'=>'pk',
                    'nama'=>'varchar(512) NOT NULL',   
                    'parent_type'=>'integer NULL',
                    'urut'=>'smallint NULL',
                    'aktif'=>'varchar(8) NULL',
            ));             
            $this->createIndex('t_event_type_nama', 't_event_type', 'nama', true);
            $this->createTable('t_event_organizer', array(
                    'id'=>'pk',
                    'nama'=>'varchar(512) NOT NULL',   
                    'contact'=>'varchar(256) NULL',
                    'website'=>'varchar(256) NULL',
                    'email'=>'varchar(256) NULL',
                    'phone'=>'varchar(256) NULL',
                    'alamat'=>'text NULL',
                
            ));             
            $this->createIndex('t_event_organizer_nama', 't_event_organizer', 'nama', true);            

            $this->createTable('t_event', array(
                    'id'=>'pk',
                    'title'=>'varchar(512) NOT NULL',   
                    'date_publish'=>'datetime NOT NULL',
                    'description'=>'text NOT NULL',
                    'tags'=>'text NULL',
                    'thumb'=>'varchar(512)',
                    'type'=>'integer NOT NULL',
                    'provinsi_id'=>'varchar(8) NOT NULL',
                    'kabkota_id'=>'varchar(8) NULL',
                    'organizer_id'=>'integer NULL',
                    'status_bayar'=>'varchar(8) NOT NULL',    
                    'status_proses'=>'varchar(8) NOT NULL',
                    'date_create'=>'datetime NOT NULL',
                    'user_create'=>'integer NOT NULL',
                    'status'=>'varchar(8) NOT NULL',
                
                                    
            ));              
	}

	public function down()
	{
            $this->dropTable('t_event');
            
            $this->dropTable('t_event_type');
            $this->dropTable('t_event_organizer');      
            
            $this->dropTable('t_provinsi');
            $this->dropTable('t_tags');            
            $this->dropTable('t_kabkota');
            $this->dropTable('t_kategori');            
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