<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateItemPicsTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addPrimaryKey('id')
        ->addForeignKey('item_id', 'item', 'id')
        ->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 30,
            ],

            'item_id' => [
                'type' => 'varchar',
                'constraint' => 30
            ],

            'extension' => [
                'type' => 'varchar',
                'constraint' => 30,
                'null' => 'false',
                'default' => 'png'
            ],

            'created_at' => [
                'type' => 'datatime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],

            'deleted_at' => [
                'type' => 'datatime',
                'null' => true
            ]
        ])
        ->createTable('item_pics');
    }

    public function down()
    {
        $this->forge->dropTable('item_pics');
    }
}
