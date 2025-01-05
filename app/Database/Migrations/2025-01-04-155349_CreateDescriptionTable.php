<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateDescriptionTable extends Migration
{
    public function up()
    {
        $this->forge->addPrimaryKey('id')
        ->addField([
            'id' => [
                'type' => 'int',
                'auto_increment' => true,
                'unsigned' => true
            ],

            'label' => [
                'type' => 'varchar',
                'constraint' => 125
            ],

            'name' => [
                'type' => 'varchar',
                'constraint' => 125,
                'null' => false,
                'unique' => true
            ],

            'content' => [
                'type' => 'varchar',
                'constraint' => 255,

            ],

            'created_at' => [
                'type' => 'datetime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ]
        ])
        ->createTable('description', ifNotExists: true);

        $data = [
            [
                'name' => 'meta',
                'label' => 'Description Google',
                'content' => 'Charel Chapeau | Créer, confectionner des chapeaux pour vos marriages ou soirées partout au cameroun.',
            ],

            [
                'name' => 'main',
                'label' => 'Description principale',
                'content' => 'Création, Confection et vente de chapeaux, sacs et bijoux au cameroun et yaoundé en particulier.'
            ],

            [
                'name' => 'about',
                'label' => 'A propos de nous',
                'content' => "Chez Charel Chapeaux, nous mettons l\'accent sur le détail. Chaque fil, chaque tissu est soigneusement posé pour un résultat impeccable.\n\nPour tous vos événements, mariages, soirées, nous créons des chapeaux uniques et sur-mesure."
            ]
        ];

        $tab = $this->db->table('description');

        foreach ($data as $description)
        {
            try {
                $tab->insert([
                    'name' => $description['name'],
                    'label' => $description['label'],
                    'content' => $description['content']
                ]);
            } catch (\Throwable) {
                //throw $th;
            }
        }
    }

    public function down()
    {
        $this->forge->dropTable('description', ifExists: true);
    }
}
