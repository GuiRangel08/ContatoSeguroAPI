<?php 
namespace App\Controllers;

use mysqli_sql_exception;

use App\Models\UserCompanyModel;

use App\Config\Database;

use App\Utils\RequirementUtils;
use Exception;

class UserCompanyController
{

    private $db;
    private $userCompanyModel;

    public function __construct()
    {
        $this->db = new Database();
        $this->userCompanyModel = new UserCompanyModel($this->db->getConnection());
    }

    public function getAll()
    {
        $result = $this->userCompanyModel->getAll();

        return $result;
    }

    public function store($data)
    {
        try {
            foreach ($data as $userCompany) {
                $required = [
                    'user_id',
                    'company_id'
                ];
                
                if (!RequirementUtils::hasAllRequiredFields($userCompany, $required)){
                    return RequirementUtils::errorMsgMissingRequiredFields();
                }
                $this->userCompanyModel->setUserId($userCompany['user_id']);
                $this->userCompanyModel->setCompanyId($userCompany['company_id']);
                
                $this->userCompanyModel->store();
            }
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                'error' => true,
                'message' => 'Erro on including one or more User Company'
            ];
        }

        header('HTTP/1.1 200 OK');
        return [
            'error' => false,
            'message' => 'Update successfully'
        ];
    }

    public function delete($data)
    {
        $userId = (int) $data['user_id'];
        $companyId = (int) $data['company_id'];

        $this->userCompanyModel->setUserId($userId);
        $this->userCompanyModel->setCompanyId($companyId);

        try {
            $this->userCompanyModel->inactive();
            return [
                'error' => false,
                'message' => 'User Company inactived successfully'
            ];
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                'error' => true,
                'message' => 'User Company inactivation error'
            ];
        }
    }
}