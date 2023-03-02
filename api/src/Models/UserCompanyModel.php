<?php

namespace App\Models;

class UserCompanyModel
{
    private $userId;
    private $companyId;
    private $db;

    public function __construct($connection)
    {
        $this->db = $connection;
    }

    public function setUserId($id) {
        $this->userId = $id;
    }

    public function setCompanyId($id) {
        $this->companyId = $id;
    }

    public function getAll()
    {
        $query = "SELECT * FROM users_companies";
        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function dataExists()
    {
        $query = "
            SELECT count(*) FROM users_companies 
            WHERE  
            user_id = '$this->userId' and company_id = '$this->companyId'
        ";

        $result = $this->db->query($query);
        
        $count = $result->fetch_row()[0];

        if ($count > 0) {
            return true;
        } 

        return false;
    }

    public function store()
    {
        $query = "
            INSERT INTO 
                users_companies (user_id, company_id) 
            VALUES 
                ('$this->userId','$this->companyId')
        ";

        $this->db->query($query);
    }

    public function delete()
    {
        $query = "
        DELETE FROM users_companies 
        WHERE used_id = $this->userId and company_id = $this->companyId
        ";
        
        $this->db->query($query);
    }
}