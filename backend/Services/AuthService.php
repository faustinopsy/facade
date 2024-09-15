<?php
namespace App\Services;

class AuthService {
    public function authenticate($username, $password) {
        $users = [
            'admin' => 'password123',
            'user' => 'userpass'
        ];

        if (isset($users[$username]) && $users[$username] === $password) {
            return true;
        }
        return false;
    }
}
