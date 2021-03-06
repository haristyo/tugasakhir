<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Presensi extends Migration
{
	private $table = 'presensi';
	public function up()
	{
		$this->forge->addField([
			'id_presensi'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'id_meeting' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'id_user' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'join_time' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'last_join_time' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
		$this->forge->addKey('id_presensi', true);
		$this->forge->addForeignKey('id_meeting','Meeting','id_meeting','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_user','User','id_user','NO ACTION','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
