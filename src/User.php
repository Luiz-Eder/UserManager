<?php

namespace App;

class User
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senhaHash;

    public function __construct(int $id, string $nome, string $email, string $senha)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->setPassword($senha);
    }

    public function setPassword(string $senha): void
    {
        $this->senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $senha): bool
    {
        return password_verify($senha, $this->senhaHash);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
