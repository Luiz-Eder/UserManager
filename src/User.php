<?php

// Define o espaço de nomes da classe, ajudando a organizar
// o projeto e evitar conflitos de nomes com outras classes.

namespace App;


//A classe User representa um usuário do sistema.
//Os atributos são privados (encapsulamento) para proteger os dados:

class User
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senhaHash;


//É chamado quando um novo usuário é criado.
// Recebe id, nome, email e senha.
//Chama o método setPassword para gerar o hash da senha, garantindo segurança desde o início.

    public function __construct(int $id, string $nome, string $email, string $senha)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->setPassword($senha);
    }

//Recebe a senha em texto puro e gera o hash seguro usando password_hash.
// Esse hash é o que será armazenado no sistema, nunca a senha em texto puro.
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

//“A classe User representa cada usuário do sistema.
//Ela guarda informações importantes como ID, nome, email e senha (hash).
//A senha nunca é armazenada em texto puro; usamos setPassword para gerar o hash e verifyPassword para validar no login.
//Os getters permitem acessar os dados de forma segura.