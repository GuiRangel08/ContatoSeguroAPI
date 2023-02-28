<?php

namespace App\Models;

class UserModel
{
    private $id;
    private $name;
    private $email;
    private $phone;
    private $birthDate;
    private $birthCity;
    private $birthState;
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

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function setBirthCity($birthCity)
    {
        $this->birthCity = $birthCity;
    }

    public function setBirthState($birthState)
    {
        $this->birthState = $birthState;
    }


    public function getAllUsers()
    {
        $query = "
            SELECT u.*, GROUP_CONCAT(c.name SEPARATOR ',') as companies
            FROM users u
            JOIN users_companies uc on u.id = uc.user_id
            JOIN companies c on uc.company_id = c.id
            GROUP BY u.id;
        ";

        $result = $this->db->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($rows as &$row) {
            $row['companies'] = explode(',', $row['companies']);
        }

        return $rows;
}

    public function getUserById()
    {
        $query = "SELECT * FROM users WHERE id = " . $this->id;
        $result = $this->db->query($query);

        return $result->fetch_assoc();
    }

    public function save()
    {
        $query = "
            INSERT INTO 
                users (name, email, phone, birth_date, birth_city, birth_state) 
            VALUES 
                ('$this->name','$this->email','$this->phone','$this->birthDate','$this->birthCity','$this->birthState')
        ";

        $this->db->query($query);
    }

    public function update()
    {
        $query = "
            UPDATE users 
            SET name='$this->name', email='$this->email', phone='$this->phone', 
                birth_date='$this->birthDate', birth_city='$this->birthCity', 
                birth_state='$this->birthState' 
            WHERE id = $this->id
        ";

        $this->db->query($query);
    }

    public function delete()
    {
        $query = "DELETE FROM users WHERE id = " . $this->id;
        $this->db->query($query);
    }
}
