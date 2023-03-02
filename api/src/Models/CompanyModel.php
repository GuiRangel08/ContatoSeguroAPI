<?php

namespace App\Models;

class CompanyModel
{
    private $id;
    private $name;
    private $cnpj;
    private $address;
    private $db;

    public function __construct($connection)
    {
        $this->db = $connection;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAllInactiveCompanies()
    {
        $query = "SELECT * FROM companies where active=0";
        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllCompanies()
    {
        $query = "SELECT * FROM companies where active=1";
        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCompanyById()
    {
        $query = "SELECT * FROM companies WHERE id = " . $this->id;
        $result = $this->db->query($query);

        return $result->fetch_assoc();
    }

    public function save()
    {
        $query = "
            INSERT INTO 
                companies (name, cnpj, address, active) 
            VALUES 
                ('$this->name','$this->cnpj','$this->address', 1)
        ";

        $this->db->query($query);
    }

    public function update()
    {
        $query = "
            UPDATE companies 
            SET name='$this->name', cnpj='$this->cnpj', address='$this->address' 
            WHERE id = $this->id
        ";

        $this->db->query($query);
    }

    public function inactive()
    {
        $query = "
            UPDATE companies SET active=0 
            WHERE id = " . $this->id;

        $this->db->query($query);
    }
}
