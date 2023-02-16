<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class CompaniesModel  extends BaseModel
{
    protected $table = 'companies';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Company';
    protected $useTimestamps = true;


}
