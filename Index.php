<?php

require_once 'User.php';

// --- Dados Iniciais ---
$users = [
    new User(1, 'Eder', 'eder@email.com', 'SenhaEder1'),
    new User(2, 'Poliana', 'poliana@email.com', 'SenhaPoliana2'),
];

function findUserByEmail(string $email, array $userList): ?User
{
    foreach ($userList as $user) {
        if ($user->getEmail() === $email) {
            return $user;
        }
    }
    return null;
}

function validateEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validatePasswordStrength(string $password): bool
{
    return strlen($password) >= 8 && preg_match('/[0-9]/', $password) && preg_match('/[A-Z]/', $password);
}

// --- Funções do Sistema de Autenticação ---

function register(string $nome, string $email, string $senha, array &$userList): string
{
    if (!validateEmail($email)) {
        return "Erro: E-mail inválido.";
    }

    if (findUserByEmail($email, $userList)) {
        return "Erro: E-mail já está em uso.";
    }

    if (!validatePasswordStrength($senha)) {
        return "Erro: A senha deve ter no mínimo 8 caracteres, 1 número e 1 letra maiúscula.";
    }

    $newId = end($userList)->getId() + 1;
    $userList[] = new User($newId, $nome, $email, $senha);

    return "Sucesso: Usuário '{$nome}' cadastrado.";
}

function login(string $email, string $senha, array $userList): string
{
    $user = findUserByEmail($email, $userList);
    
    if ($user && $user->verifyPassword($senha)) {
        return "Sucesso: Login realizado. Bem-vindo, {$user->getNome()}!";
    } else {
        return "Erro: Credenciais inválidas.";
    }
}

function resetPassword(int $userId, string $novaSenha, array &$userList): string
{
    if (!validatePasswordStrength($novaSenha)) {
        return "Erro: A nova senha não é forte o suficiente.";
    }

    foreach ($userList as $user) {
        if ($user->getId() === $userId) {
            $user->setPassword($novaSenha);
            return "Sucesso: Senha de '{$user->getNome()}' alterada.";
        }
    }

    return "Erro: Usuário não encontrado.";
}

// --- Casos de Teste ---

echo "<h1>Sistema de Usuários e Autenticação</h1>";
echo "<p>Design Patterns & Clean Code</p>";
echo "<hr>";

echo "<h2>Casos de Teste:</h2>";

// Caso 1 - Cadastro válido
echo "<h3>Caso 1 - Cadastro válido (Eder Luiz)</h3>";
$message = register('Eder Luiz', 'Eder@email.com', 'SenhaForte1', $users);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
echo "<hr>";

// Caso 2 - Cadastro com e-mail inválido
echo "<h3>Caso 2 - Cadastro com e-mail inválido</h3>";
$message = register('Poliana', 'poliana@@email', 'Senha123', $users);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
echo "<hr>";

// Caso 3 - Tentativa de login com senha errada
echo "<h3>Caso 3 - Tentativa de login com senha errada (Eder)</h3>";
$message = login('eder@email.com', 'SenhaIncorreta', $users);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
echo "<hr>";

// Caso 4 - Reset de senha válido 
echo "<h3>Caso 4 - Reset de senha válido (Poliana)</h3>";
$message = resetPassword(2, 'NovaSenhaPoliana2', $users);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
echo "<hr>";

// Caso 5 - Cadastro de usuário com e-mail duplicado
echo "<h3>Caso 5 - Cadastro com e-mail duplicado (Eder)</h3>";
$message = register('Eder Duplicado', 'eder@email.com', 'OutraSenha', $users);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
echo "<hr>";
