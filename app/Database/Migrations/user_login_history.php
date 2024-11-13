<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoginHistoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'login_date' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('login_history');
    }

    public function down()
    {
        $this->forge->dropTable('login_history');
    }
}
