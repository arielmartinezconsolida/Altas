<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Provinces_Model  extends BaseModel
{
    protected $table = 'provinces';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Province';
    protected $useTimestamps = true;


}
