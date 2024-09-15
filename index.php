<?php
require_once 'vendor/autoload.php';

use App\Services\LoginFacade;

// Instancia a fachada de login
$loginFacade = new LoginFacade();

// Simulação de dados de formulário de login
$username = 'admin';
$password = 'password123';
$email = 'admin@example.com';

// Etapa 1: Autenticação e envio de código
if ($loginFacade->login($username, $password, $email)) {
    echo "Autenticação bem-sucedida! Código de verificação enviado para o e-mail.\n";

    // Simulação de entrada do usuário para o código de verificação
    // Em uma aplicação real, isso viria de um formulário separado
    echo "Digite o código de verificação enviado para o e-mail: ";
    $handle = fopen ("php://stdin","r");
    $codeInput = trim(fgets($handle));

    // Etapa 2: Confirmação do código e geração do token JWT
    $token = $loginFacade->confirmCode($username, $codeInput);

    if ($token) {
        echo "Código validado com sucesso! Seu token JWT: {$token}\n";
    } else {
        echo "Código de verificação inválido. Falha no login.\n";
    }
} else {
    echo "Falha na autenticação. Verifique suas credenciais.\n";
}
