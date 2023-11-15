<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pacientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=>'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nome'=>[
                'type'=>'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'nome_mae'=>[
                'type'=>'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'data_nascimento'=>[
                'type'=>'DATE',
                'null' => false,
            ],
            'cpf'=>[
                'type'=>'VARCHAR',
                'constraint' => 11,
                'null' => false,
            ],
            'cns'=>[
                'type'=>'VARCHAR',
                'constraint' => 15,
                'null' => false,
            ],
            'endereco'=>[
                'type'=>'VARCHAR',
                'constraint' => 800,
                'null' => false,
            ],
            'image'=>[
                'type'=>'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            ]);

            $this->forge->addPrimaryKey('id');
            $this->forge->addUniqueKey('id');
            $this->forge->createTable('pacientes');
    }

    public function down()
    {
        $this->forge->dropTable('pacientes');
    }
}
