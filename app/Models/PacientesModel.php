<?php

namespace App\Models;

use CodeIgniter\Model;

class PacientesModel extends Model
{
    protected $table = 'pacientes';
    protected $allowedFields = ['id','nome', 'nome_mae', 'data_nascimento', 
    'cpf', 'cns', 'endereco', 'image'];
}
