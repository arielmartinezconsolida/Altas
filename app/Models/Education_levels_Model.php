<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Education_levels_Model  extends BaseModel
{
    protected $table = 'education_levels';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Education_level';
    protected $useTimestamps = true;


}
