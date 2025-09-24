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
    
    // Gera um novo ID de usuário, buscando o maior ID atual
    private function getNextUserId(): int
    {
        $maxId = 0;
        foreach ($this->users as $user) {
            if ($user->getId() > $maxId) {
                $maxId = $user->getId();
            }
        }
        return $maxId + 1;
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

    public function register(string $name, string $email, string $password): string
    {
        if (!$this->validator->validateEmail($email)) {
            return "Erro: Email invalido.";
        }
        
        if ($this->findUserByEmail($email)) {
            return "Erro: Email ja em uso.";
        }

        $passwordError = $this->validator->validatePasswordStrength($password);
        if ($passwordError !== "") {
            return $passwordError;
        }

        $newId = $this->getNextUserId();
        $this->users[] = new User($newId, $name, $email, $password);

        return "Succeso: Usuario '{$name}' registrado.";
    }

    public function login(string $email, string $password): string
    {
        $user = $this->findUserByEmail($email);
        
        if ($user && $user->verifyPassword($password)) {
            return "Bem vindo, {$user->getName()}!";
        } else {
            return "Erro: Login ou senha invalido.";
        }
    }

    public function resetPassword(int $userId, string $newPassword): string
    {
        $passwordError = $this->validator->validatePasswordStrength($newPassword);
        if ($passwordError !== "") {
            return $passwordError;
        }

        foreach ($this->users as $user) {
            if ($user->getId() === $userId) {
                $user->setPassword($newPassword);
                return "Successo: Sua senha '{$user->getName()}' foi alterada.";
            }
        }

        return "Erro: Usuario nao encontrado";
    }
}
