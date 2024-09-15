<?php
namespace App\Services;

class CodeService {
    protected $codes = [];

    public function generateCode($username) {
        $code = rand(100000, 999999);
        $this->codes[$username] = $code;
        return $code;
    }

    public function validateCode($username, $code) {
        if (isset($this->codes[$username]) && $this->codes[$username] == $code) {
            unset($this->codes[$username]);
            return true;
        }
        return false;
    }
}
