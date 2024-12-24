<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedAtColumnToCategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('category', [
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('category', 'deleted_at');
    }
}
