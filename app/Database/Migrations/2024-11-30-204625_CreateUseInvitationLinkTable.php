<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateUseInvitationLinkTable extends Migration
{
    public function up()
    {
        $this->forge
        ->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 30,
                'null' => false
            ],

            'link_id' => [
                'type' => 'varchar',
                'constraint' => 125,
            ],

            'ip' => [
                'type' => 'varchar',
                'null' => true,
                'constraint' => 30
            ],

            'user_agent' => [
                'type' => 'varchar',
                'constraint' => 30
            ],

            'created_at' => [
                'type' => 'datetime',
                'null' => true 
            ]
        ])
        ->addPrimaryKey('id')
        ->addForeignKey('link_id', 'invitation_links', 'id')
        ->createTable('use_invitation_links');
    }

    public function down()
    {
        $this->forge->dropTable('use_invitation_links');
    }
}
