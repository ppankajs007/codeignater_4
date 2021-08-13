<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'first_name'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
                        'lastname' => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
                        'username' => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
                        'email' => [
                                'type'       => 'text',
                                'null'       =>  true,
                        ],
                        'phone' => [
                          	'type'       => 'VARCHAR',
                            'constraint' => '100',
                            'null'	     => null
                        ],
                        'phone' => [
                          	'type'       => 'VARCHAR',
                            'constraint' => '100',
                            'null'	     => null
                        ],
                        'password' => [
                          	'type'       => 'text'
                        ],
                ]);
                $this->forge->addKey('id', true);
                $this->forge->createTable('blog');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
