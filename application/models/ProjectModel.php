<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProjectModel extends MY_Model {

	protected $table = 'projects';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getProjects(){
		$this->db->select('p.id,p.name,p.location,pc.cat_name,p.cost,p.size,p.description AS descp,CASE WHEN p.project_image="" THEN "" ELSE CONCAT("'.base_url().'uploads/projects/",p.project_image) END AS project_image,p.created_at');
		$this->db->from($this->table.' AS p');
		$this->db->join('project_category AS pc','p.cat_id=pc.cat_id');
		$query = $this->db->get();
    	return $query->result_array();
	}

}
