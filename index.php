<?php


define('ROOT_PATH', __DIR__ . '/');
define('SRC_PATH', ROOT_PATH . 'src/');


require_once SRC_PATH . 'UserManager.php';


use App\UserManager;


$userManager = new UserManager();

echo '<h1>Simulador de Sistema de Usuários e Autenticação</h1>';
echo '<p>Projeto da disciplina de Design Patterns & Clean Code.</p>';
echo '<hr>';

echo '<h2>Casos de Teste:</h2>';

// Caso 1 - Cadastro válido
echo '<h3>Caso 1 - Cadastro válido (João Silva)</h3>';
$message = $userManager->register('João Silva', 'joao@email.com', 'SenhaForte1');
echo '<p>Resultado: ' . htmlspecialchars($message) . '</p>';
echo '<hr>';

// Caso 2 - Cadastro com e-mail inválido
echo '<h3>Caso 2 - Cadastro com e-mail inválido</h3>';
$message = $userManager->register('Pedro', 'pedro@@email', 'Senha123');
echo '<p>Resultado: ' . htmlspecialchars($message) . '</p>';
echo '<hr>';

// Caso 3 - Tentativa de login com senha errada
echo '<h3>Caso 3 - Tentativa de login com senha errada (Eder)</h3>';
$message = $userManager->login('eder@email.com', 'SenhaIncorreta');
echo '<p>Resultado: ' . htmlspecialchars($message) . '</p>';
echo '<hr>';

// Caso 4 - Reset de senha válido 
echo '<h3>Caso 4 - Reset de senha válido (Poliana)</h3>';
$message = $userManager->resetPassword(2, 'NovaSenhaPoliana2');
echo '<p>Resultado: ' . htmlspecialchars($message) . '</p>';
echo '<hr>';

// Caso 5 - Cadastro de usuário com e-mail duplicado
echo '<h3>Caso 5 - Cadastro com e-mail duplicado (Eder)</h3>';
$message = $userManager->register('Eder Duplicado', 'eder@email.com', 'OutraSenha');
echo '<p>Resultado: ' . htmlspecialchars($message) . '</p>';
echo '<hr>';

// Caso 6 - Login após o reset da senha
echo '<h3>Caso 6 - Login com a nova senha de Poliana</h3>';
$message = $userManager->login('poliana@email.com', 'NovaSenhaPoliana2');
echo '<p>Resultado: ' . htmlspecialchars($message) . '</p>';
echo '<hr>';