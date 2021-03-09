<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Meeting extends Migration
{
	private $table = 'meeting';
	public function up()
	{
		$this->forge->addField([
			'id_meeting'          => [
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
			'agenda' => [
				'type'           => 'text',
				'constraint'     => '25',
				'null'           => false,
			],
			'deskripsi_meeting' => [
				'type'           => 'text',
				'null'           => true,
			],
			'creator_meeting' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'link_meeting' => [
				'type'           => 'text',
				'null'           => true
			],
			'time_meeting' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'created_meeting' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_meeting' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]

	]);
	$this->forge->addKey('id_meeting', true);
	$this->forge->addForeignKey('id_project','Project','id_project','CASCADE','CASCADE');
	$this->forge->addForeignKey('creator_meeting','Member','id_member','NO ACTION','CASCADE');
	$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
