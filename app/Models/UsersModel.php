<?php namespace app\Models;
use App\Models\BaseModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class UsersModel  extends BaseModel
{
    protected $table = 'users';
    protected $allowedFields = ['name','lastname', 'email', 'username', 'password','active', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\User';
    protected $useTimestamps = true;


}
