<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	private $table = 'user';
	public function up()
	{
		$this->forge->addField([
			'id_user'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'username'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '32',
					'default'		 => 'user',
					
			],
			'nama_user' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',	
					'default'		 => 'Nama_Lengkap'
			],
			'foto_profile' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'           => true,
				'default'		 => 'img/profil/default.jpg',
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'default'		 => 'Email@email.com'
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'default'		 => 'Password'
			],
			'created_user' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_user' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'is_admin' => [
				'type'           => 'char',
				'null'           => true,
			]

	]);
	$this->forge->addKey('id_user', true);
	$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
