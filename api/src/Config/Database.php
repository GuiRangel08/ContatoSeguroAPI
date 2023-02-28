<?php

namespace App\Config;

use App\Config\Config;

class Database
{
    private $host;
    private $user;
    private $password;
    private $database;
    private $connection;

    public function __construct()
    {
        
        $this->host = Config::getDatabaseEnvVariables('MYSQL_HOST');
        $this->database = Config::getDatabaseEnvVariables('MYSQL_DATABASE');
        $this->user = Config::getDatabaseEnvVariables('MYSQL_USER');
        $this->password = Config::getDatabaseEnvVariables('MYSQL_PASSWORD');

        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
