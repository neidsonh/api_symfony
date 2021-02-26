<?php

namespace App\Helper;

class CEP
{
    private string $cep;

    public function __construct($cep)
    {
        $cep = filter_var($cep, FILTER_VALIDATE_REGEXP,[
            'options' => [
                'regexp' => '/^[0-9]{5}\-[0-9]{3}$/'
                
                ]
            ]);
                
        if ($cep === false){
            echo "Formato do CEP inválido!";
            exit();
        }
        
        $this->cep = $cep;
    }

    public function getCep(): string
    {
        return $this->cep;
    }
}