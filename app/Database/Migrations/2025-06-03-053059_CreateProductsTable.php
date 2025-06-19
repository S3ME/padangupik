<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $fields = [
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'name'              => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'description'       => ['type' => 'MEDIUMTEXT', 'null' => true],
            'image'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'favorite'          => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'        => ['type' => 'DATETIME','null' => true],
            'updated_at'        => ['type' => 'DATETIME','null' => true],
            'deleted_at'        => ['type' => 'DATETIME','null' => true],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('name');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
