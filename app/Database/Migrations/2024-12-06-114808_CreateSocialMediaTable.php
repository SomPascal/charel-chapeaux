<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;

class CreateSocialMediaTable extends Migration
{
    public function up()
    {

        $this->forge->addPrimaryKey('id')
        ->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 30,
                'null' => false
            ],

            'name' => [
                'type' => 'varchar',
                'constraint' => 125,
                'unique' => true
            ],

            'content' => [
                'type' => 'varchar',
                'constraint' => 125,
            ],

            'created_at' => [
                'type' => 'datetime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ]
        ])
        ->createTable('contact', true);

        $config = config('Config\Contact');

        $data = [
            [
                'name' => 'whatsapp',
                'content' => $config::$whatsapp
            ],

            [
                'name' => 'facebook',
                'content' => $config::$facebook
            ],

            [
                'name' => 'phone',
                'content' => $config::$phone
            ],

            [
                'name' => 'instagram',
                'content' => $config::$instagram
            ],

            [
                'name' => 'location',
                'content' => $config::$location
            ],

            [
                'name' => 'map',
                'content' => $config::$map
            ]
        ];

        $social_table = $this->db->table('contact');

        foreach ($data as $social) {
            try {
                $social_table->insert(array_merge($social, [
                    'id' => uid(),
                    'created_at' => Time::now()
                ]));
            } catch (\Throwable) {
                //throw $th;
            }
        }
    }

    public function down()
    {
        $this->forge->dropTable('contact', true);
    }
}
