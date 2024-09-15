<?php
namespace App\Services;

class LoginFacade {
    protected $authService;
    protected $emailService;
    protected $codeService;
    protected $tokenService;
    protected $logService;

    public function __construct() {
        $this->authService = new AuthService();
        $this->emailService = new EmailService();
        $this->codeService = new CodeService();
        $this->tokenService = new TokenService();
        $this->logService = new LogService();
    }

    public function login($username, $password, $email) {
        if ($this->authService->authenticate($username, $password)) {
            $this->logService->logAccess($username, 'Autenticação bem-sucedida');

            $code = $this->codeService->generateCode($username);
            $this->emailService->sendVerificationCode($email, $code);

            $this->logService->logAccess($username, 'Código de verificação enviado por e-mail');

            return true;
        } else {
            $this->logService->logAccess($username, 'Falha na autenticação');
            return false;
        }
    }

    public function confirmCode($username, $code) {
        if ($this->codeService->validateCode($username, $code)) {
            $this->logService->logAccess($username, 'Código de verificação validado');

            $token = $this->tokenService->generateToken($username);
            $this->logService->logAccess($username, 'Token JWT gerado');

            return $token;
        } else {
            $this->logService->logAccess($username, 'Falha na validação do código de verificação');
            return false;
        }
    }

    public function logout($username) {
        $this->logService->logAccess($username, 'Logout realizado');
    }
}
