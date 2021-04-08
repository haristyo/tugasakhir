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
    protected $allowedFields = ['id_notes','id_project','isi','sprint'];
    public function getNotesbyProject($id_project = false)
    {
        if($id_project == false)
        {return $this->join('project','project.id_project=notes.id_project')
            ->findAll(); 
        }
        else {
            
            return $this->join('project','project.id_project=notes.id_project')->where('notes.id_project',$id_project)
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