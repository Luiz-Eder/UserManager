<?php

namespace App;

class Validator
{
    public function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function validatePasswordStrength(string $password): string
    {
        if (strlen($password) < 8) {
            return "Erro: Sua senha deve ter pelo menos 8 caracteres";
        }
        if (!preg_match('/[0-9]/', $password)) {
            return "Erro: Sua senha deve ter pelo menos um numero";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return "Erro: Sua senha deve ter pelo menos uma letra maiuscula";
        }
        return "";
    }
}
