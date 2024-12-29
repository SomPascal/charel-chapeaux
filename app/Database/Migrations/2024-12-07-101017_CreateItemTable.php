<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateItemTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addPrimaryKey('id')
        // ->addForeignKey('admin_id', 'users', 'id')
        // ->addForeignKey('code_category', 'category', 'code')
        ->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 30,
            ],

            'admin_id' => [
                'type' => 'int',
            ],

            'code_category' => [
                'type' => 'int',
            ],

            'name' => [
                'type' => 'varchar',
                'constraint' => 30,
            ],

            'price' => [
                'type' => 'varchar',
                'constraint' => 50
            ],

            'description' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'created_at' => [
                'type' => 'datetime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],

            'updated_at' => [
                'type' => 'datetime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],

            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ])
        ->createTable('item', true);
    }

    public function down()
    {
        $this->forge->dropTable('item', true);
    }
}
