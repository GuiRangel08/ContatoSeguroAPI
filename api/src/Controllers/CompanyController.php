<?php

namespace App\Controllers;

use App\Models\CompanyModel;

use App\Config\Database;

use App\Utils\RequirementUtils;
use App\Utils\DataPreparationUtils;
use Exception;
use PhpParser\Node\Expr;

class CompanyController
{
    private $db;
    private $company;
    private $apiBodyData = [
        'id',
        'name',
        'cnpj',
        'address'
    ];

    public function __construct()
    {
        $this->db = new Database();
        $this->company = new CompanyModel($this->db->getConnection());
    }

    public function getAll()
    {
        $result = $this->company->getAllCompanies();

        return $result;
    }

    public function getSingle($id)
    {
        $id = (int) $id['id'];
        $this->company->setId($id);

        $result = $this->company->getCompanyById();

        if (!$result) {
            header('HTTP/1.1 404 (Not Found)');
            return [
                'error' => true,
                'message' => 'Company not found'
            ];
        }

        header('HTTP/1.1 200 OK');
        return $result;
    }

    public function store($data)
    {
        $required = [
            'name',
            'cnpj',
            'address'
        ];

        if (!RequirementUtils::hasAllRequiredFields($data, $required)){
            return RequirementUtils::errorMsgMissingRequiredFields();
        }

        $params = DataPreparationUtils::prepareMissingData($this->apiBodyData, $data);

        $this->company->setName($params['name']);
        $this->company->setCnpj($params['cnpj']);
        $this->company->setAddress($params['address']);

        try {

            $this->company->store();
            
            header('HTTP/1.1 201 Created');
            return [
                'error' => false,
                'message' => 'Company created successfully'
            ];
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                'error' => true,
                'message' => 'Error creating company'
            ];
        }
    }

    public function update($data)
    {
        $required = [
            'id',
            'name',
            'cnpj',
            'address'
        ];

        if (!RequirementUtils::hasAllRequiredFields($data, $required)){
            return RequirementUtils::errorMsgMissingRequiredFields();
        }
        
        $id = (int) $data['id'];
        $this->company->setId($id);

        $params = DataPreparationUtils::prepareMissingData($this->apiBodyData, $data);

        try {

            if ($this->company->getCompanyById()) {
                $this->company->setName($params['name']);
                $this->company->setCnpj($params['cnpj']);
                $this->company->setAddress($params['address']);
                
                $this->company->update();
                
                header('HTTP/1.1 200 OK');
                return [
                    'error' => false,
                    'message' => 'Company updated successfully'
                ];
            } else {
                header('HTTP/1.1 404 (Not Found)');
                return [
                    'error' => true,
                    'message' => 'Company not found'
                ];
            }
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                'error' => true,
                'message' => 'Error updating company'
            ];
        }
    }

    public function destroy($data)
    {
        $id = (int) $data['id'];
        $this->company->setId($id);

        try {
            if ($this->company->getCompanyById()) {
                $this->company->inactivate();
                header('HTTP/1.1 200 OK');
                return [
                    'error' => false,
                    'message' => 'Company inactived successfully'
                ];
            } else {
                header('HTTP/1.1 404 (Not Found)');
                return [
                    'error' => true,
                    'message' => 'Company not found'
                ];
            }
        } catch (Exception) {
            $this->db->getConnection()->rollBack();
            header('HTTP/1.1 400 Bad Request');
            return [
                
                'message' => 'Company inactivation error'
            ];
        }
    }
}
