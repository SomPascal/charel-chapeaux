<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvitationLinkTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 125,
                'null' => false
            ],

            'inviter_id' => [
                'type' => 'int', 
                'constraint' => 11,
                'unsigned' => true
            ],

            'role' => [
                'type' => 'enum',
                'constraint' => ['admin', 'superadmin']
            ],

            'expire_at' => [
                'type' => 'datetime',
                'null' => true
            ],

            'created_at' => [
                'type' => 'datetime',
                'null' => true
            ]

        ])
        ->addPrimaryKey('id')
        // ->addForeignKey('inviter_id', 'users', 'id')
        ->createTable('invitation_links', true);
    }

    public function down()
    {
        $this->forge->dropTable('invitation_links', true);
    }
}
