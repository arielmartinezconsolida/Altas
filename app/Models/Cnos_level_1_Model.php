<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Cnos_level_1_Model  extends BaseModel
{
    protected $table = 'cnos_level_1';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Cno_level_1';
    protected $useTimestamps = true;


}
