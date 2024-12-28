<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateRedirectionTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addPrimaryKey('id')
        ->addForeignKey('contact_id', 'contact', 'id')
        ->addForeignKey('item_id', 'item', 'id')
        ->addForeignKey('visitor_id', 'visitor', 'id')
        ->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'visitor_id' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'context' => [
                'type' => 'enum',
                'constraint' => ['item', 'any'],
                'default' => 'any'
            ],

            'item_id' => [
                'type' => 'varchar',
                'constraint' => 125,
                'null' => true
            ],

            'contact_id' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'created_at' => [
                'type' => 'varchar',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ]
        ])
        ->createTable('redirection', true);
    }

    public function down()
    {
        $this->forge->dropTable('redirection', true);
    }
}
