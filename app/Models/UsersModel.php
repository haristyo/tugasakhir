<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class UsersModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;
    protected $createdField  = 'created_user';
    protected $updatedField  = 'updated_user';
    protected $allowedFields = ['username','nama_user','email','password','foto_profile','is_admin'];
    

}