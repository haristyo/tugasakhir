<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;
    protected $createdField  = 'created_user';
    protected $updatedField  = 'updated_user';
    protected $allowedFields = ['username','nama_user','email','password','foto_profile','is_admin'];
    public function getDetailbyId($id_user = false)
    {
        if ($id_user != false) {
            # code...
            return $this->where('id_user',$id_user)->first();
        }
        else {
            # code...
            return $this->findAll();
        }
    }
    public function getSuperAdmin()
    {
        return $this->where('is_admin','S')->first();
    }
    public function getUser()
    {
        return $this->where('is_admin','N')->findAll();
    }

}