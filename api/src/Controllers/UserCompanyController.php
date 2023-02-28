<?php 
namespace App\Controllers;

use mysqli_sql_exception;

use App\Models\UserCompanyModel;

use App\Config\Database;

use App\Utils\RequirementUtils;

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
        foreach ($data as $userCompany) {
            $required = [
                'user_id',
                'company_id'
            ];
            
            if (!RequirementUtils::requerimentFields($userCompany, $required)){
                return RequirementUtils::missingRequirementFields();
            }

            $this->userCompanyModel->setUserId($userCompany['user_id']);
            $this->userCompanyModel->setCompanyId($userCompany['company_id']);

            try {
                $this->userCompanyModel->save();
            } catch (mysqli_sql_exception $e) {
                continue;
            }
        }

        header('HTTP/1.1 200 OK');
        return [
            'message' => 'Update successfully'
        ];
    }

    public function delete()
    {
        $query = "DELETE FROM companies WHERE id = " . $this->id;
        $this->db->query($query);
    }
}