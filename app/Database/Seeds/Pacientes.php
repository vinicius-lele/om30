<?php

namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Pacientes extends Seeder
{
    public function run()
    {
        $faker = Factory::create('pt_BR');
        for($i=1;$i<=15;$i++){
            $data = [
                'nome' => $faker->name(),
                'nome_mae' =>$faker->name('female'),
                'data_nascimento' =>date('Y/m/d'),
                'cpf' =>$faker->cpf(false),
                'cns' =>$faker->cnpj(false),
                'endereco' =>$faker->address(),
            ];

            $this->db->table('pacientes')->insert($data);
        }
    }
}
