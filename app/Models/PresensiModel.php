<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class PresensiModel extends Model
{
    protected $table      = 'presensi';
    protected $primaryKey = 'id_presensi';
    protected $useTimestamps = true;
    protected $createdField  = 'join_time';
    protected $updatedField  = 'last_join_time';
    protected $allowedFields = ['id_presensi','id_user','id_meeting'];
    public function getCountPresensibyUserMeeting($id_user,$id_meeting)
    {
        return $this->selectCount('id_presensi')->where(['id_user' => $id_user, 'id_meeting' => $id_meeting])->first();  
    }
    public function getIdbyUserMeeting($id_user,$id_meeting)
    {
        return $this->where(['id_user' => $id_user, 'id_meeting' => $id_meeting])->first();  
    }
}