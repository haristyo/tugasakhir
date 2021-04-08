<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class File extends Migration
{
	private $table = 'file';
	public function up()
	{
		$this->forge->addField([
			'id_file'          => [
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
			'sprint' => [
				'type'			=> 'INT',
				'null'			=> true,
				'unsigned'		 => true
			],
			'uploader_file' => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
			],
			'type' => [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
				'null'           => false,
			],
			'nama_asli' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'           => true
			],
			'nama_file' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'           => true
			],
			'created_file' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'deskripsi_file' => [
				'type'           => 'text',
				'null'           => true,
			],
		]);
		$this->forge->addKey('id_file', true);
		$this->forge->addForeignKey('id_project','Project','id_project','CASCADE','CASCADE');
		$this->forge->addForeignKey('uploader_file','Member','id_member','NO ACTION','CASCADE');
		$this->forge->addForeignKey('sprint','sprint','id_sprint','NO ACTION','CASCADE');
		$this->forge->createTable($this->table);

	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
