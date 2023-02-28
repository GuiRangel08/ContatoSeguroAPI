<?php

namespace App\Middlewares;

class ApiToken
{
    public static function validate($token) {
        if ($token !== $_ENV['API_TOKEN']) {
            return false;
            exit;
        }

        return true;
    }
}