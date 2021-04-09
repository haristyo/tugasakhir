<?php namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class CheckboxModel extends Model
{
    protected $table         = 'checkbox';
    protected $primaryKey    = 'id_checkbox';
    protected $useTimestamps = true;
    protected $createdField  = 'created_checkbox';
    protected $updatedField  = '';
    protected $allowedFields = ['id_checkbox','id_epic','value','isi'];
    
    public function getCheckboxbyProject($id_project = FALSE)
    {
        return $this->select('checkbox.*,project.id_project')->join('epic','epic.id_epic=checkbox.id_epic')->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->findAll();
    }
    public function getCheckboxbyId($id_checkbox)
    {
        return $this->select('checkbox.*,project.id_project')->join('epic','epic.id_epic=checkbox.id_epic')->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->where('id_checkbox',$id_checkbox)->first();
    }
    public function getCheckboxbyEpic($id_epic)
    {
       return $this->where('id_epic',$id_epic)->findAll();
    }
    public function countAllByProject($id_project)
    {
        return $this->select('checkbox.id_epic')->selectCount('id_checkbox')->join('epic','epic.id_epic=checkbox.id_epic')->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->where('sprint.id_project',$id_project)->groupBy('id_epic')->findAll();
    }
    public function countCheckedByProject($id_project)
    {
        return $this->select('checkbox.id_epic')->selectCount('id_checkbox')->join('epic','epic.id_epic=checkbox.id_epic')->join('sprint','sprint.id_sprint=epic.id_sprint')->join('project','project.id_project=sprint.id_project')->where(['sprint.id_project'=>$id_project,'value'=>'1'])->groupBy('id_epic')->findAll();
    }
    
    

}