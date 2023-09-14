<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Municipalities_Model  extends BaseModel
{
    protected $table = 'municipalities';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Municipality';
    protected $useTimestamps = true;


}
