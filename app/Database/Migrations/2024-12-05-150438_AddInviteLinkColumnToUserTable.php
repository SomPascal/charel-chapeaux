<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInviteLinkColumnToUserTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addForeignKey(
            'used_link_id', 
            'use_invitation_links',
            'id'
        )
        ->addColumn('users', [
            'used_link_id' => [
                'type' => 'varchar',
                'constraint' => 30,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'used_link_id');
    }
}
