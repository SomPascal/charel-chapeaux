<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsHiddenColumnOnItemTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('item', [
            'is_hidden' => [
                'type' => 'boolean',
                'null' => false,
                'default' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('item', 'is_hidden');
    }
}
