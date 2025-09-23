<?php

namespace App;


//Inclui as classes User e Validator, que serão usadas para gerenciar usuários e validações.
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Validator.php';

class UserManager
{
    private array $users;
    private Validator $validator;

    //$users → array que simula o banco de dados de usuários.
    // $validator → objeto da classe Validator usado para verificar e-mails e senhas.

    public function __construct()
    {
        $this->validator = new Validator();
        $this->users = [
            new User(1, 'Eder', 'eder@email.com', 'SenhaEder1'),
            new User(2, 'Poliana', 'poliana@email.com', 'SenhaPoliana2'),
        ];
    }

    //Cria um objeto Validator para reutilizar métodos de validação.

 //Inicializa o array $users com usuários fixos, simulando dados já existentes.

//Assim, o sistema já pode ser testado sem banco de dados.

    private function findUserByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    //Procura no array de usuários se algum usuário tem o e-mail informado.
    // Retorna o objeto User se encontrado, ou null se não existir.
    //Usado para evitar duplicidade de e-mails e buscar usuário para login.

    public function register(string $nome, string $email, string $senha): string
    {
        if (!$this->validator->validateEmail($email)) {
            return 'Erro: E-mail inválido.';
        }
<<<<<<< HEAD

=======
        //Valida a nova senha com as regras de força.
>>>>>>> 8a1c39838b8fc021760b9442434375dd44342edb
        if ($this->findUserByEmail($email)) {
            return 'Erro: E-mail já está em uso.';
        }

        if (!$this->validator->validatePasswordStrength($senha)) {
<<<<<<< HEAD
            return 'Erro: A senha deve ter no mínimo 8 caracteres, 1 número e 1 letra maiúscula.';
=======
            return "Erro: A senha deve ter no mínimo 8 caracteres, 1 número e 1 letra maiúscula.";

>>>>>>> 8a1c39838b8fc021760b9442434375dd44342edb
        }
//Quando cadastramos um novo usuário, o sistema pega o último ID do array e soma 1 para criar um novo ID único. 
// Depois, criamos um objeto User com os dados informados e adicionamos ao array de usuários.
//  Por fim, retornamos uma mensagem de sucesso para indicar que o cadastro foi realizado corretamente.”

        $newId = end($this->users)->getId() + 1;
        $this->users[] = new User($newId, $nome, $email, $senha);

        return "Sucesso: Usuário '{$nome}' cadastrado.";
    }


    //“O método login procura o usuário pelo e-mail. Se ele existir, verifica a senha usando o hash armazenado. Dependendo do resultado,
    //  retorna uma mensagem de sucesso ou de erro, garantindo que só usuários com credenciais corretas consigam entrar no sistema.”


    public function login(string $email, string $senha): string
    {
        $user = $this->findUserByEmail($email);

        if ($user && $user->verifyPassword($senha)) {
            return "Sucesso: Login realizado. Bem-vindo, {$user->getNome()}!";
        }

        return 'Erro: Credenciais inválidas.';
    }

    //“O método login procura o usuário pelo e-mail. Se ele existir, verifica a senha usando o hash armazenado. Dependendo do resultado,
    //  retorna uma mensagem de sucesso ou de erro, garantindo que só usuários com credenciais corretas consigam entrar no sistema.”



    public function resetPassword(int $userId, string $novaSenha): string
    {
        //Validação da nova senha
        if (!$this->validator->validatePasswordStrength($novaSenha)) {
            return 'Erro: A nova senha não é forte o suficiente.';
        }

//Antes de trocar, o sistema testa se a nova senha segue as regras (mínimo de 8 caracteres, 1 número e 1 letra maiúscula).
//Se não for forte → já retorna erro e não altera nada.


        //Busca pelo usuário usando o ID
        foreach ($this->users as $user) {
            if ($user->getId() === $userId) //O código percorre o array $users. Procura qual usuário tem o mesmo ID informado no parâmetro.
             {
                //att da senha
                $user->setPassword($novaSenha); //Quando encontra o usuário, chama setPassword. Esse método gera um novo hash seguro da senha, substituindo o antigo. Depois retorna a mensagem de sucesso.
                return "Sucesso: Senha de '{$user->getNome()}' alterada.";
            }
        }
<<<<<<< HEAD

        return 'Erro: Usuário não encontrado.';
    }
}
=======
//Se terminar de percorrer todos os usuários e não achar o ID → retorna erro.
        return "Erro: Usuário não encontrado.";
    }
}

//O método resetPassword primeiro valida se a nova senha é forte. Depois, procura o usuário pelo ID.
//Se encontrar, troca a senha chamando setPassword, que guarda o hash em vez da senha real.
// No fim, retorna uma mensagem de sucesso ou erro.
>>>>>>> 8a1c39838b8fc021760b9442434375dd44342edb
