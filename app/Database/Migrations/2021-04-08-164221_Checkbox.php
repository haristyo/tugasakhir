<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Checkbox extends Migration
{
	private $table = 'checkbox';
	public function up()
	{
		$this->forge->addField([
			'id_checkbox'          => [
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
			'isi' => [
				'type'           => 'text',
				'null'           => false,
			],
			'value' => [
				'type'           => 'TINYINT',
				'constraint'	=> '1',
				'null'           => false,
				'defaul'		=> '0'
			],
			'created_checkbox' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
		$this->forge->addKey('id_checkbox', true);
		$this->forge->addForeignKey('id_epic','epic','id_epic','CASCADE','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
