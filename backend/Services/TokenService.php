<?php
namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService {
    private $secretKey = 'your_secret_key';

    public function generateToken($username) {
        $payload = [
            'iss' => 'yourdomain.com',
            'aud' => 'yourdomain.com',
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'data' => [
                'username' => $username
            ]
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }
}
