<?php
namespace App\Services;

class LogService {
    public function logAccess($username, $action) {
        $timestamp = date('Y-m-d H:i:s');
        echo "[{$timestamp}] Usuário '{$username}' realizou a ação: {$action}\n";
    }
}
