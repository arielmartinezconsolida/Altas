<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Work_centersModel  extends BaseModel
{
    protected $table = 'Work_centers';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Work_center';
    protected $useTimestamps = true;


}
