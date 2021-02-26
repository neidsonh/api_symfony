<?php

namespace App\Helper;

class Email
{
    private string $email;

    public function __construct($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo "Formato do e-mail inválido!";
            exit();
        }

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    
}
