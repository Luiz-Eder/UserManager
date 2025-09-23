<?php

namespace App;

class Validator
{
    public function validateEmail(string $email): bool 
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        //Usa filter_var para verificar se o email está no formato correto.
//Retorna true se for válido, false se não for.
    }

    public function validatePasswordStrength(string $password): bool
    {
        return strlen($password) >= 8 && preg_match('/[0-9]/', $password) && preg_match('/[A-Z]/', $password); //onfere se a senha segue regras de segurança:
    }
}