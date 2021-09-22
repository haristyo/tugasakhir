<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notes extends Migration
{
	private $table = 'notes';
	public function up()
	{
		$this->forge->addField([
			'id_notes'          => [
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
			'updated_notes' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'created_notes' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'sprint' => [
				'type'			=> 'INT',
				'null'			=> true,
				'unsigned'		 => true
			],
			'creator_notes' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
		]);
		$this->forge->addKey('id_notes', true);
		$this->forge->addForeignKey('id_project','project','id_project','CASCADE','CASCADE');
		$this->forge->addForeignKey('creator_notes','member','id_member','NO ACTION','CASCADE');
		$this->forge->addForeignKey('sprint','sprint','id_sprint','CASCADE','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
