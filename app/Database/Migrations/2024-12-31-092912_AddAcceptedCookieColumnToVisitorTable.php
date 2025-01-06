<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAcceptedCookieColumnToVisitorTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('visitor', [
            'accepted_cookie' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('visitor', 'accepted_cookie');
    }
}
