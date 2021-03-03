<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Member extends Migration
{
	private $table = 'member';
	public function up()
	{
		$this->forge->addField([
			'id_member'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'id_project' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'id_user' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'position' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'null'           => true,
				'default'		 => 'Development Team'
			],
			'created_member' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_member' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]

	]);
	$this->forge->addKey('id_member', true);
	$this->forge->addForeignKey('id_project','Project','id_project','CASCADE','CASCADE');
	$this->forge->addForeignKey('id_user','User','id_user','NO ACTION','CASCADE');
	$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
