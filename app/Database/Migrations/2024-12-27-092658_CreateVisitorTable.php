<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateVisitorTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addPrimaryKey('id')
        ->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'ip' => [
                'type' => 'varchar',
                'constraint' => 125,
                'null' => false
            ],

            'user_agent' => [
                'type' => 'varchar',
                'constraint' => 125,
                'null' => true
            ],

            'accept_lang' => [
                'type' => 'varchar',
                'constraint' => 125,
                'null' => true
            ],

            'referrer_url' => [
                'type' => 'varchar',
                'constraint' => 125,
                'null' => true
            ],

            'created_at' => [
                'type' => 'datetime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],

            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ]
        ])
        ->createTable('visitor', true);
    }

    public function down()
    {
        $this->forge->dropTable('visitor', true);
    }
}
