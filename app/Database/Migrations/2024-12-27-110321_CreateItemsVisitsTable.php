<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsVisitsTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addPrimaryKey('id')
        ->addForeignKey('visitor_id', 'visitor', 'id')
        ->addForeignKey('item_id', 'item', 'id')
        ->addField([
            'visitor_id' => [
                'type' => 'varchar',
                'constraint' => 125,
            ],

            'item_id' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'created_at' => [
                'type' => 'datetime',
                'null' => false
            ]
        ])
        ->createTable('items_visits', true);
    }

    public function down()
    {
        $this->forge->dropTable('items_visits', true);
    }
}
