<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Road_typesModel  extends BaseModel
{
    protected $table = 'road_types';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Roadtype';
    protected $useTimestamps = true;


}
