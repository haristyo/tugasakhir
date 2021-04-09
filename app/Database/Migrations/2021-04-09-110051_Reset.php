<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reset extends Migration
{
	private $table = 'reset';
	public function up()
	{
		$this->forge->addField([
			'id_reset'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'id_user' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'token' => [
				'type'           => 'VARCHAR',
				'constraint'	 => "255",
				'null'           => false,
			],
			'created_reset' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
		$this->forge->addKey('id_reset', true);
		$this->forge->addForeignKey('id_user','user','id_user','CASCADE','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
