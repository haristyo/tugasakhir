<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class FileModel extends Model
{
    protected $table         = 'file';
    protected $primaryKey    = 'id_file';
    protected $useTimestamps = true;
    protected $createdField  = 'created_file';
    protected $updatedField  = '';
    protected $allowedFields = ['id_file','id_project','sprint','uploader_file','type','nama_asli','nama_file','deskripsi_file'];
    public function getFilebyProject($id_project = FALSE)
    {
        return $this->select('id_file,file.id_project,uploader_file,type,nama_file,nama_asli,user.username,deskripsi_file,created_file,user.id_user')->join('project','project.id_project=file.id_project')->join('sprint','sprint.id_sprint=file.sprint')->join('member','member.id_member=file.uploader_file')->join('user','user.id_user=member.id_user')->where('file.id_project',$id_project)->orderBy('created_file', 'DESC');
    }
    public function getFilebyId($id_file)
    {
        return $this->select('id_file,file.id_project,type,nama_file')->where('file.id_file',$id_file)->first();
    }
   
    
    

}