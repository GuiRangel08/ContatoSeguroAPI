<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserCompanyModel;

use App\Config\Database;

use App\Utils\RequirementUtils;
use App\Utils\DataPreparationUtils;

class UserController
{
    private $db;
    private $user;
    private $userCompany;
    private $apiBodyData = [
        'id',
        'name',
        'email',
        'phone',
        'birth_date',
        'birth_city',
        'birth_state',
        'companies'
    ];

    public function __construct()
    {
        $this->db = new Database();
        $this->user = new UserModel($this->db->getConnection());
        $this->userCompany = new UserCompanyModel($this->db->getConnection());
    }

    public function getAll()
    {
        $result = $this->user->getAllUsers();

        foreach ($result as &$row) {
            $companies_id = explode(",", $row["companies_id"]);
            $companies = explode(",", $row["companies"]);
            $row["companies"] = array_combine($companies_id, $companies);
        }

        return $result;
    }

    public function getSingle($data)
    {
        $id = (int) $data['id'];
        $this->user->setId($id);

        $result = $this->user->getUserById();

        if (!$result) {
            header('HTTP/1.1 404 (Not Found)');
            return [
                'error' => true,
                'message' => 'User not found'
            ];
        }

        $companies_id = explode(",", $result["companies_id"]);
        $companies = explode(",", $result["companies"]);
        $result["companies"] = array_combine($companies_id, $companies);

        header('HTTP/1.1 200 OK');
        return $result;
    }

    public function store($data)
    {

        $requiredFields = [
            'name',
            'email',
            'companies'
        ];

        if (!RequirementUtils::hasAllRequiredFields($data, $requiredFields)){
            return RequirementUtils::errorMsgMissingRequiredFields();
        }

        $data = DataPreparationUtils::prepareMissingData($this->apiBodyData, $data);

        $this->user->setName($data['name']);
        $this->user->setEmail($data['email']);
        $this->user->setPhone($data['phone']);
        $this->user->setBirthDate($data['birth_date']);
        $this->user->setBirthCity($data['birth_city']);
        $this->user->setBirthState($data['birth_state']);

        try {
            $this->db->getConnection()->begin_transaction();

            $this->user->store();

            $id = $this->db->getConnection()->insert_id;

            $this->userCompany->setUserId($id);

            foreach ($data['companies'] as $company) {
                $this->userCompany->setCompanyId($company);
                $this->userCompany->store();
            }

            $this->db->getConnection()->commit();

            header('HTTP/1.1 201 Created');
            return [
                'error' => false,
                'message' => 'User created successfully'
            ];
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                'error' => true,
                'message' => 'Error creating user'
            ];
        }
    }

    public function update($data)
    {
        $requiredFields = [
            'id',
            'name',
            'email'
        ];

        if (!RequirementUtils::hasAllRequiredFields($data, $requiredFields)){
            return RequirementUtils::errorMsgMissingRequiredFields();
        }
        
        $id = (int) $data['id'];
        $this->user->setId($id);

        $params = DataPreparationUtils::prepareMissingData($this->apiBodyData, $data);

        try {
            if ($this->user->getUserById()) {
                $this->user->setName($params['name']);
                $this->user->setEmail($params['email']);
                $this->user->setPhone($params['phone']);
                $this->user->setBirthDate($params['birth_date']);
                $this->user->setBirthCity($params['birth_city']);
                $this->user->setBirthState($params['birth_state']);

                $this->user->update();

                $this->userCompany->setUserId($id);
                
                foreach ($data['companies'] as $company) {

                    $this->userCompany->setCompanyId($company);

                    if(!$this->userCompany->dataExists()){
                        $this->userCompany->store();
                    }

                }

                header('HTTP/1.1 200 OK');
                return [
                    'error' => false,
                    'message' => 'User updated successfully'];
            } else {
                header('HTTP/1.1 404 (Not Found)');
                return [
                    'error' => true,
                    'message' => 'User not found'
                ];
            }
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                'error' => true,
                'message' => 'Error updating user, try again.'
            ];
        }
    }

    public function destroy($data)
    {
        $id = (int) $data['id'];
        $this->user->setId($id);

        try{

            if ($this->user->getUserById()) {
                $this->user->inactivate();
                header('HTTP/1.1 200 OK');
                return [
                    'error' => false,
                    'message' => 'User inactived successfully'
                ];
            } else {
                header('HTTP/1.1 404 (Not Found)');
                return [
                    'error' => true,
                    'message' => 'User not found'
                ];
            }
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                'error' => true,
                'message' => 'User inactivation error'
            ];
        }
    }
}
