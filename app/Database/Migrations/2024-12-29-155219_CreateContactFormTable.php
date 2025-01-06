<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateContactFormTable extends Migration
{
    public function up()
    {
        $this->forge->addPrimaryKey('id')
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

            'name' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'phone' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'created_at' => [
                'type' => 'datetime',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ]
        ])
        ->createTable('contact_form', true);
    }

    public function down()
    {
        $this->forge->dropTable('contact_form', true);
    }
}
