<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGalleriesTable extends Migration
{
    public function up()
    {
        $fields = [
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'image'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'        => ['type' => 'DATETIME','null' => true],
            'updated_at'        => ['type' => 'DATETIME','null' => true],
            'deleted_at'        => ['type' => 'DATETIME','null' => true],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('galleries');
    }

    public function down()
    {
        $this->forge->dropTable('galleries');
    }
}
