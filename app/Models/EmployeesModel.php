<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class EmployeesModel  extends BaseModel
{
    protected $table = 'employees';
    protected $allowedFields = ['company_id', 'work_center_id', 'nif', 'ccc', 'name', 'lastname', 'birthdate', 'document_type', 'employee_nif', 'number_ss',
    'account', 'email', 'phone', 'gender', 'civil_status', 'province_id', 'municipality_id', 'road_type', 'street_name', 'address_number', 'stairs',
     'floor', 'door', 'zip', 'category_id', 'category_selected', 'work_place_id', 'work_place_selected', 'cod_ocupation', 'tariff_group', 'type_of_charge',
     'cod_ocupation_letter', 'test_period', 'imputation', 'description_of_functions', 'contract_type', 'contract_date_start', 'type_of_day', 'monthly_salary',
      'salary_type', 'education_level_id', 'process', 'weekly_working_hours', 'country_id'  ];
    protected $returnType    = 'App\Entities\Employee';
    protected $useTimestamps = true;

    function getNotProcessed(){
        $db = db_connect();
        $query = "select * from employees where processed = 0";
        return $db->query($query)->getResult('array');
    }

    function setProcessed($id){
        $db = db_connect();
        $query = "update employees set processed = 1 where id = ".$id;
        return $db->query($query);
    }

}
