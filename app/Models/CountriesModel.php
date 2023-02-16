<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class CountriesModel  extends BaseModel
{
    protected $table = 'countries';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Country';
    protected $useTimestamps = true;


}
