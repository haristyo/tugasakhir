<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Backlog extends Migration
{
	private $table = 'backlog';
	public function up()
	{
		$this->forge->addField([
			'id_backlog'          => [
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
			'isi' => [
				'type'           => 'text',
				'null'           => true,
			],
			'updated_backlog' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'created_backlog' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'sprint' => [
				'type'			=> 'INT',
				'null'			=> true,
				'unsigned'		 => true
			],
			'point' => [
				'type'			=> 'INT',
				'null'			=> false,
				'default'        => '0'
			]
		]);
		$this->forge->addKey('id_backlog', true);
		$this->forge->addForeignKey('id_project','project','id_project','CASCADE','CASCADE');
		$this->forge->addForeignKey('sprint','sprint','id_sprint','CASCADE','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
