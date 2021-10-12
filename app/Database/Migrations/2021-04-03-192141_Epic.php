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
				'null'			=> false,
				'default'        => '0'
			],
			'elapsed' => [
				'type'			=> 'INT',
				'null'			=> true,
				'default'        => '0'
			],
			'creator_epic' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => true,
			],
			'editor_epic' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => true,
			],
		]);
		$this->forge->addKey('id_epic', true);
		$this->forge->addForeignKey('creator_epic','Member','id_member','NO ACTION','CASCADE');
		$this->forge->addForeignKey('editor_epic','Member','id_member','NO ACTION','CASCADE');
		$this->forge->addForeignKey('id_sprint','Sprint','id_sprint','CASCADE','CASCADE');
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
