<?php

namespace App\Config;

class Config {
    public static function getDatabaseEnvVariables($index){
        
        $env = [
            'MYSQL_HOST' => $_ENV['MYSQL_HOST'],
            'MYSQL_DATABASE' => $_ENV['MYSQL_DATABASE'],
            'MYSQL_USER' => $_ENV['MYSQL_USER'],
            'MYSQL_PASSWORD' => $_ENV['MYSQL_PASSWORD']
        ];

        return $env[$index];
    } 
}