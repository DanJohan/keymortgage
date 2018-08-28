<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserProjectModel extends MY_Model {

	protected $table = 'user_projects';
	
	public function __construct()
	{
	    parent::__construct();
	}

	public function getUserProjects($user_id) {
		//$this->db->select('up.id as user_project_id,p.id AS project_id,name,CASE WHEN p.project_image="" THEN null ELSE CONCAT("'.base_url().'uploads/projects/",p.project_image) END AS project_image,p.location,pc.cat_name,p.description AS descp,p.cost,p.size',false);
		$this->db->select('up.id as user_project_id,p.id AS project_id,name,CASE WHEN p.project_image="" THEN "" ELSE CONCAT("'.base_url().'uploads/projects/",p.project_image) END AS project_image,p.location,pc.cat_name,p.description AS descp,p.cost,p.size',false);
		$this->db->from($this->table.' AS up');
		$this->db->join('projects AS p','up.project_id=p.id');
		$this->db->join('project_category AS pc','p.cat_id=pc.cat_id');
		$this->db->where('up.user_id',$user_id);

		$query=$this->db->get();
		$result=$query->result_array();
		return (!empty($result))?$result:false;
	}
	
	public function getUserProjectById($id) 
	{
		$this->db->select('p.name AS project_name,CASE WHEN p.project_image="" THEN "" ELSE CONCAT("'.base_url().'uploads/projects/",p.project_image) END AS project_image,u.name AS user_name,u.device_id,u.device_type',false);
		$this->db->from($this->table.' AS up');
		$this->db->join('projects AS p','up.project_id=p.id');
		$this->db->join('users AS u','up.user_id=u.id');
		$this->db->where('up.id',$id);
		$query=$this->db->get();
		$result=$query->row_array();
		return (!empty($result))?$result:false;
	}
	
	/* public function getUserDetailsById($id) 
	{
			
		$this->db->select('p.name AS project_name,CASE WHEN p.project_image="" THEN "" ELSE CONCAT("'.base_url().'uploads/projects/",p.project_image) END AS project_image,u.name AS user_name,u.email,u.first_name,u.last_name,pc.cat_name',false);
		$this->db->from($this->table.' AS up');
		$this->db->join('projects AS p','up.project_id=p.id');
		$this->db->join(' project_category AS pc','pc.cat_id=p.cat_id');
		$this->db->join('users AS u','up.user_id=u.id');
		$this->db->where('up.id',$id);
		$query=$this->db->get();
		$result=$query->row_array();
		return (!empty($result))?$result:false;
		
		
		
	}
	 */
	 
	/* public function getUserDetailsById($id) 
	{
			
		$this->db->select('p.name AS project_name,CASE WHEN p.project_image="" THEN "" ELSE CONCAT("'.base_url().'uploads/projects/",p.project_image) END AS project_image,p.created_at,u.name AS user_name,u.email,u.first_name,u.last_name,pc.cat_name,banks.bank_name,banks.bank_domain,CASE WHEN banks.bank_logo="" THEN null ELSE CONCAT("'.base_url().'uploads/banks/",banks.bank_logo) END AS bank_logo,user_banks.user_bank_email,user_banks.user_bank_branch,CASE WHEN documents.file="" THEN "" ELSE CONCAT("'.base_url().'uploads/documents/",documents.file ) END AS doc_image',false);
		$this->db->from($this->table.' AS up ,user_banks,documents');
		$this->db->join('projects AS p','up.project_id=p.id');
		$this->db->join(' project_category AS pc','pc.cat_id=p.cat_id');
		$this->db->join('users AS u','up.user_id=u.id');
		//$this->db->join('users', 'users.id = user_banks.user_id'); 
        $this->db->join('banks', 'banks.bank_id = user_banks.bank_id'); 
		$this->db->where('up.id',$id AND 'user_banks.user_id',$id AND 'documents.user_id',$id);
		$query=$this->db->get();
		$result=$query->result_array();
		return (!empty($result))?$result:false;
	
	}	 */
	
	 //for admin panel
	 public function getProjectByUserId($user_id) {
		$this->db->select('up.id as user_project_id,p.id AS project_id,name,project_image,p.location,pc.cat_name,p.description AS descp,p.cost,p.size',false);
		$this->db->from($this->table.' AS up');
		$this->db->join('projects AS p','up.project_id=p.id');
		$this->db->join('project_category AS pc','p.cat_id=pc.cat_id');
		$this->db->where('up.user_id',$user_id);

		$query=$this->db->get();
		$result=$query->result_array();
		return (!empty($result))?$result:false;
	}
	
	//for admin panel
	
	
	
	
}