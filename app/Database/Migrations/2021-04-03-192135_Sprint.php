<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sprint extends Migration
{
	private $table = 'sprint';
	public function up()
	{
		$this->forge->addField([
			'id_sprint'          => [
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
			'start_sprint' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'end_sprint' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_sprint' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'created_sprint' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
		]);
		$this->forge->addKey('id_sprint', true);
		$this->forge->addForeignKey('id_project','project','id_project','CASCADE','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
