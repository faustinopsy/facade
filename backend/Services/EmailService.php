<?php
namespace App\Services;

class EmailService {
    public function sendVerificationCode($email, $code) {
        echo "Enviando e-mail para {$email} com o código de verificação: {$code}\n";
    }
}
