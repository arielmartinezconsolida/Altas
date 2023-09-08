<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class Work_placesModel  extends BaseModel
{
    protected $table = 'work_places';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Work_place';
    protected $useTimestamps = true;


}
