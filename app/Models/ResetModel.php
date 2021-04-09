<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class ResetModel extends Model
{
    protected $table         = 'reset';
    protected $primaryKey    = 'id_reset';
    protected $useTimestamps = true;
    protected $createdField  = 'created_reset';
    protected $updatedField  = '';
    protected $allowedFields = ['id_reset','id_user','token'];
    public function getResetbyEmailUser($emailuser)
    {
        return $this->join('user','user.id_user=reset.id_user')->where('user.email',$emailuser)->orWhere('user.email',$emailuser)->orderBy('created_reset',"DESC")->first();
    }
    public function getResetbyToken($token)
    {
        return $this->join('user','user.id_user=reset.id_user')->where('reset.token',$token)->orderBy('created_reset',"DESC")->first();
    }
}