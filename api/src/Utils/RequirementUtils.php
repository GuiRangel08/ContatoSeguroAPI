<?php

namespace App\Utils;

class RequirementUtils 
{
    public static function hasAllRequiredFields($data, $requiredFields){
        foreach ($requiredFields as $requiredField) {
            if (!isset($data[$requiredField])) {
                return false;
            }
            if (empty($data[$requiredField])) {
                return false;
            }
        }
        return true;
    }

    public static function errorMsgMissingRequiredFields() {
        header('HTTP/1.1 400 Bad Request');
        return [
            'error' => true, 
            'message' => 'Missing required fields'
        ];
    }
}