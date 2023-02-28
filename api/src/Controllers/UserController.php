<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Config\Database;

use App\Utils\RequirementUtils;
use App\Utils\DataPreparationUtils;

class UserController
{
    private $db;
    private $user;
    private $bodyData = [
        'id',
        'name',
        'email',
        'phone',
        'birthDate',
        'birthCity',
        'birthState'
    ];

    public function __construct()
    {
        $this->db = new Database();
        $this->user = new UserModel($this->db->getConnection());
    }

    public function getAll()
    {
        $result = $this->user->getAllUsers();

        return $result;
    }

    public function getSingle($id)
    {
        $id = (int) $id['id'];
        $this->user->setId($id);

        $result = $this->user->getUserById();

        if (!$result) {
            header('HTTP/1.1 404 (Not Found)');
            return [
                'message' => 'User not found'
            ];
        }

        header('HTTP/1.1 200 OK');
        return $result;
    }

    public function store($data)
    {
        $required = [
            'name',
            'email'
        ];

        if (!RequirementUtils::requerimentFields($data, $required)){
            return RequirementUtils::missingRequirementFields();
        }

        $params = DataPreparationUtils::prepareMissingData($this->bodyData, $data);

        $this->user->setName($params['name']);
        $this->user->setEmail($params['email']);
        $this->user->setPhone($params['phone']);
        $this->user->setBirthDate($params['birthDate']);
        $this->user->setBirthCity($params['birthCity']);
        $this->user->setBirthState($params['birthState']);

        $this->user->save();

        header('HTTP/1.1 201 Created');
        return [
            'message' => 'User created successfully'
        ];
    }

    public function update($data)
    {
        $required = [
            'id',
            'name',
            'email'
        ];

        if (!RequirementUtils::requerimentFields($data, $required)){
            return RequirementUtils::missingRequirementFields();
        }
        
        $id = (int) $data['id'];
        $this->user->setId($id);

        $params = DataPreparationUtils::prepareMissingData($this->bodyData, $data);

        if ($this->user->getUserById()) {
            $this->user->setName($params['name']);
            $this->user->setEmail($params['email']);
            $this->user->setPhone($params['phone']);
            $this->user->setBirthDate($params['birthDate']);
            $this->user->setBirthCity($params['birthCity']);
            $this->user->setBirthState($params['birthState']);

            $this->user->update();

            header('HTTP/1.1 200 OK');
            return ['message' => 'User updated successfully'];
        } else {
            header('HTTP/1.1 404 (Not Found)');
            return ['message' => 'User not found'];
        }
    }

    public function destroy($data)
    {
        $id = (int) $data['id'];
        $this->user->setId($id);

        if ($this->user->getUserById()) {
            $this->user->delete();
            header('HTTP/1.1 200 OK');
            return ['message' => 'User deleted successfully'];
        } else {
            header('HTTP/1.1 404 (Not Found)');
            return ['message' => 'User not found'];
        }
    }
}
