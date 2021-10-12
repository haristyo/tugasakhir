<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class NotesModel extends Model
{
    protected $table         = 'notes';
    protected $primaryKey    = 'id_notes';
    protected $useTimestamps = true;
    protected $createdField  = 'created_notes';
    protected $updatedField  = 'updated_notes';
    protected $allowedFields = ['id_notes','id_project','isi','sprint','creator_notes','editor_notes'];
    public function getNotesbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('project','project.id_project=notes.id_project')
            ->findAll(); 
        }
        else {
            
            // return $this->join('project','project.id_project=notes.id_project')
            return $this->select('notes.*, project.*, creator.id_user AS pembuat, editor.id_user AS pengedit, user_creator.nama_user AS nama_pembuat, user_editor.nama_user AS nama_pengedit')
            ->join('project','project.id_project=notes.id_project')
            ->join("member creator" ,'creator.id_member=notes.creator_notes')
            ->join("member editor",'editor.id_member=notes.editor_notes','left')
            ->join('user user_creator','user_creator.id_user=creator.id_user')
            ->join('user user_editor','user_editor.id_user=editor.id_user','left')
            ->where('notes.id_project',$id_project)
            ->findAll();
        }
    }
    public function getNotesbyId($id_notes = false)
    {
        if($id_notes == false)
        {return $this->join('project','project.id_project=notes.id_project')
            ->findAll(); 
        }
        else {
            return $this->join('project','project.id_project=notes.id_project')->where('notes.id_notes',$id_notes)->first();
        }
    }

    

}