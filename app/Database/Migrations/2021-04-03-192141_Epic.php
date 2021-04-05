<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Epic extends Migration
{
	private $table = 'epic';
	public function up()
	{
		$this->forge->addField([
			'id_epic'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'id_sprint' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'isi' => [
				'type'           => 'text',
				'null'           => true,
			],
			'updated_epic' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'created_epic' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'status' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'			=> true
			],
			'estimated' => [
				'type'			=> 'INT',
				'null'			=> false
			],
			'elapsed' => [
				'type'			=> 'INT',
				'null'			=> true
			]
		]);
		$this->forge->addKey('id_epic', true);
		$this->forge->addForeignKey('id_project','project','id_project','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_sprint','sprint','id_sprint','CASCADE','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
