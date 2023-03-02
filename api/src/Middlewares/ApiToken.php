<?php

namespace App\Middlewares;

class ApiToken
{
    public static function isValid($token) {
        if ($token === $_ENV['API_TOKEN']) {
            return true;
        }

        return false;
    }
}