<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addPrimaryKey('code')
        ->addField([
            'code' => [
                'type' => 'int',
                'auto_increment' => true
            ],

            'name' => [
                'type' => 'varchar',
                'constraint' => 30
            ]
        ])
        ->createTable('category');

        $categories = ['marriage', 'soiré'];

        foreach ($categories as $category)
        {
            $this->db->table('category')
            ->insert(['name' => $category]);
        }
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}
