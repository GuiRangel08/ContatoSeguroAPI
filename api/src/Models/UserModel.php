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
    private $companies;
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
    
    public function getAllInactiveUsers()
    {
        $query = "
            SELECT u.*, GROUP_CONCAT(c.name SEPARATOR ',') as companies
            FROM users u
            JOIN users_companies uc on u.id = uc.user_id
            JOIN companies c on uc.company_id = c.id
            WHERE u.active = 0
            GROUP BY u.id;
        ";

        $result = $this->db->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($rows as &$row) {
            $row['companies'] = explode(',', $row['companies']);
        }

        return $rows;
    }

    public function getAllUsers()
    {
        $query = "
            SELECT u.*, GROUP_CONCAT(c.name SEPARATOR ',') as companies
            FROM users u
            JOIN users_companies uc on u.id = uc.user_id
            JOIN companies c on uc.company_id = c.id
            WHERE u.active = 1
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

    public function store()
    {
        $query = "
            INSERT INTO users (name, email, phone, birth_date, birth_city, birth_state, active) 
            VALUES ('$this->name', '$this->email', '$this->phone', " .
            (!empty($this->birthDate) ? "'$this->birthDate'" : "NULL") . ", '$this->birthCity', '$this->birthState', 1)
        ";

        $this->db->query($query);
    }

    public function update()
    {
        $query = "
            UPDATE users 
            SET name='$this->name', email='$this->email', phone='$this->phone', 
                birth_date=" .
                (!empty($this->birthDate) ? "'$this->birthDate'" : "NULL") .
                ", birth_city='$this->birthCity', 
                birth_state='$this->birthState' 
            WHERE id = $this->id
        ";

        $this->db->query($query);
    }

    public function inactive()
    {
        $query = "
            UPDATE users SET active = 0
            WHERE id = " . $this->id;

        $this->db->query($query);
    }
}
