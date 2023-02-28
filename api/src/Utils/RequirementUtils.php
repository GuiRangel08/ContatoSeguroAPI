<?php

namespace App\Utils;

class RequirementUtils 
{
    public static function requerimentFields($data, $required){
        foreach ($required as $field) {
            if (!isset($data[$field])) {
                return false;
            }
        }
        return true;
    }

    public static function missingRequirementFields() {
        header('HTTP/1.1 400 Bad Request');
        return ['error' => 'Missing required fields'];
    }
}