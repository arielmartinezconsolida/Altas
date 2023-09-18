<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Companies_agreements_Model  extends BaseModel
{
    protected $table = 'companies_agreements';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Company_agreement';
    protected $useTimestamps = true;

    function getCompanyAgreements($company_id){
        $query = "SELECT
                    a.* 
                FROM
                    companies_agreements ca
                    INNER JOIN agreements a ON ca.ca_agreement_id = a.id WHERE ca.ca_company_id = $company_id";
        return $this->db->query($query)->getResult();
    }


}
