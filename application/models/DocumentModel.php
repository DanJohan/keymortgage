<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DocumentModel extends MY_Model {

	protected $table = 'documents';

	public function __construct()
	{
	    parent::__construct();
	}

	
	public function getDocumentByUserId($user_id){
		$this->db->select('document_id,user_id,CASE WHEN file="" THEN null ELSE CONCAT("'.base_url().'uploads/documents/",file) END AS file,created_at,status');
		$this->db->from($this->table);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}


// used in admin panel
	public function getUserDocumentById($user_id)
	{
		$this->db->select('document_id,user_id,file,created_at,status');
		$this->db->from($this->table);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;

	}
// used in admin panel	
}
