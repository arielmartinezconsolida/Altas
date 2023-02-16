<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class EmployeesModel  extends BaseModel
{
    protected $table = 'employees';
    protected $allowedFields = ['cif', 'nif','document_type', 'name', 'lastname', 'birthdate', 'number_ss', 'gender', 'country', 'street_name', 'address_number',
        'stairs', 'floor', 'door', 'zip', 'phone', 'email', 'account', 'type_of_day', 'contract_date_end', 'contract_date_start', 'category',
        'weekly_working_hours', 'monthly_salary', 'salary_type', 'road_type', 'contract_type', 'processed'];
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
