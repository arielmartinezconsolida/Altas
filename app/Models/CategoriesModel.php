<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class CategoriesModel  extends BaseModel
{
    protected $table = 'categories';
    protected $allowedFields = [];
    protected $returnType    = 'App\Entities\Category';
    protected $useTimestamps = true;


}
