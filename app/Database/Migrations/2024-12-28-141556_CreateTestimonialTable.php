<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTestimonialTable extends Migration
{
    public function up()
    {
        $this->forge->addPrimaryKey('id')
        ->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 125
            ],

            'name' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'content' => [
                'type' => 'varchar',
                'constraint' => 255
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
                'null' => true,
            ]
        ])
        ->createTable('testimonial', true);
    }

    public function down()
    {
        $this->forge->dropTable('testimonial', true);
    }
}
