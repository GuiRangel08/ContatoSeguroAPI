<?php

namespace App\Controllers;

use App\Models\CompanyModel;

use App\Config\Database;

use App\Utils\RequirementUtils;
use App\Utils\DataPreparationUtils;

class CompanyController
{
    private $db;
    private $company;
    private $bodyData = [
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

        if (!RequirementUtils::requerimentFields($data, $required)){
            return RequirementUtils::missingRequirementFields();
        }

        $params = DataPreparationUtils::prepareMissingData($this->bodyData, $data);

        $this->company->setName($params['name']);
        $this->company->setCnpj($params['cnpj']);
        $this->company->setAddress($params['address']);

        $this->company->save();

        header('HTTP/1.1 201 Created');
        return [
            'message' => 'Company created successfully'
        ];
    }

    public function update($data)
    {
        $required = [
            'id',
            'name',
            'cnpj',
            'address'
        ];

        if (!RequirementUtils::requerimentFields($data, $required)){
            return RequirementUtils::missingRequirementFields();
        }
        
        $id = (int) $data['id'];
        $this->company->setId($id);

        $params = DataPreparationUtils::prepareMissingData($this->bodyData, $data);

        if ($this->company->getCompanyById()) {
            $this->company->setName($params['name']);
            $this->company->setCnpj($params['cnpj']);
            $this->company->setAddress($params['address']);

            $this->company->update();

            header('HTTP/1.1 200 OK');
            return ['message' => 'Company updated successfully'];
        } else {
            header('HTTP/1.1 404 (Not Found)');
            return ['message' => 'Company not found'];
        }
    }

    public function destroy($data)
    {
        $id = (int) $data['id'];
        $this->company->setId($id);

        if ($this->company->getCompanyById()) {
            $this->company->inactive();
            header('HTTP/1.1 200 OK');
            return ['message' => 'Company inactived successfully'];
        } else {
            header('HTTP/1.1 404 (Not Found)');
            return ['message' => 'Company not found'];
        }
    }
}
