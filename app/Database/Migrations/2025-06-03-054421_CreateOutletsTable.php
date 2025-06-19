<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOutletsTable extends Migration
{
    public function up()
    {
        $fields = [
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'              => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'address'           => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'operational_hours' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'image'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'maps'              => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'category'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('outlets');
    }

    public function down()
    {
        $this->forge->dropTable('outlets');
    }
}
