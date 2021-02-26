<?php

namespace App\Helper;

class CPF
{
    private string $cpf;

    public function __construct($cpf)
    {
        $cpf = filter_var($cpf, FILTER_VALIDATE_REGEXP,[
            'options' => [
                'regexp' => '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/'

            ]
        ]);

        if ($cpf === false){
            echo "CPF inválido";
            exit();
        }

        $this->cpf = $cpf;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }
    
}
