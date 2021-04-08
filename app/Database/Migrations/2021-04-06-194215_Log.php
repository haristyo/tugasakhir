<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Log extends Migration
{
	private $table = 'log';
	public function up()
	{
		$this->forge->addField([
			'id_log'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'id_epic' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'progress' => [
				'type'           => 'INT',
				'null'           => false,
			],
			'created_log' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'id_member' => [
				'type'			=> 'INT',
				'null'			=> true,
				'unsigned'		=> true,
			]
		]);
		$this->forge->addKey('id_log', true);
		$this->forge->addForeignKey('id_epic','epic','id_epic','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_member','member','id_member','NO ACTION','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
