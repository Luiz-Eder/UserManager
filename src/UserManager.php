<?php

namespace App;

require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Validator.php';

class UserManager
{
    private array $users;
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->users = [
            new User(1, 'Eder', 'eder@email.com', 'SenhaEder1'),
            new User(2, 'Poliana', 'poliana@email.com', 'SenhaPoliana2'),
        ];
    }

    private function findUserByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }

    public function register(string $nome, string $email, string $senha): string
    {
        if (!$this->validator->validateEmail($email)) {
            return "Erro: E-mail inválido.";
        }
        
        if ($this->findUserByEmail($email)) {
            return "Erro: E-mail já está em uso.";
        }

        if (!$this->validator->validatePasswordStrength($senha)) {
            return "Erro: A senha deve ter no mínimo 8 caracteres, 1 número e 1 letra maiúscula.";
        }

        $newId = end($this->users)->getId() + 1;
        $this->users[] = new User($newId, $nome, $email, $senha);

        return "Sucesso: Usuário '{$nome}' cadastrado.";
    }

    public function login(string $email, string $senha): string
    {
        $user = $this->findUserByEmail($email);
        
        if ($user && $user->verifyPassword($senha)) {
            return "Sucesso: Login realizado. Bem-vindo, {$user->getNome()}!";
        } else {
            return "Erro: Credenciais inválidas.";
        }
    }

    public function resetPassword(int $userId, string $novaSenha): string
    {
        if (!$this->validator->validatePasswordStrength($novaSenha)) {
            return "Erro: A nova senha não é forte o suficiente.";
        }

        foreach ($this->users as $user) {
            if ($user->getId() === $userId) {
                $user->setPassword($novaSenha);
                return "Sucesso: Senha de '{$user->getNome()}' alterada.";
            }
        }

        return "Erro: Usuário não encontrado.";
    }
}