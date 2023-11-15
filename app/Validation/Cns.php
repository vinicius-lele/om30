<?php

namespace App\Validation;

class Cns
{
    public function cns_is_valid($cns, ?string &$error = null)
    {
        $error = 'CNS inválido!';
    
        //  LIMPO A MASCARA SE HOUVER
        $cns = preg_replace('/[^0-9]/', '', $cns);
    
        //  VALIDA A QUANTIDADE DE NUMEROS
        if (strlen($cns) != 15) {
            return false;
        }
    
        $pis = substr($cns, 0, 11);
        $soma = 0;
    
        for ($i = 0, $j = strlen($pis), $k = 15; $i < $j; $i++, $k--) :
            $soma += $pis[$i] * $k;
        endfor;
    
        $dv = 11 - fmod($soma, 11);
        $dv = ($dv != 11) ? $dv : '0'; // retorna '0' se for igual a 11
    
        if ($dv == 10) {
            $soma += 2;
            $dv = 11 - fmod($soma, 11);
            $resultado = $pis . '001' . $dv;
        } else {
            $resultado = $pis . '000' . $dv;
        }
    
        if ($cns != $resultado) {
            return false;
        } else {
            return true;
        }
    }
}
