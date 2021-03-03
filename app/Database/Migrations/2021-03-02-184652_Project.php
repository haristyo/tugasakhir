<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Project extends Migration
{
	private $table = 'project';
	public function up()
	{
		$this->forge->addField([
			'id_project'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'nama_project'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
				'default'		 => 'Pembuatan Software',
				'null'           => false,
			],
			'deskripsi' => [
					'type'           => 'text',
					'null'           => true,
			],
			'creator_project' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'kode_join' => [
				'type'           => 'VARCHAR',
				'constraint'     => '32',
				'default'		 => 'abcd1234'
			],
			'password_project' => [
				'type'           => 'VARCHAR',
				'constraint'     => '32',
				'default'		 => '12345678'
			],
			'created_project' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_project' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]

	]);
	$this->forge->addKey('id_project', true);
	$this->forge->addForeignKey('creator_project','User','id_user','NO ACTION','CASCADE');
	$this->forge->createTable($this->table);
	
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
