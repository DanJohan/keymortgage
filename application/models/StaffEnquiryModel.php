<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class StaffEnquiryModel extends MY_Model {

	protected $table = 'staff_enquiry';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getEnquiryByUserId($id) 
	{
		$this->db->select('id,user_id,document_image,message,status,created_at');
		$this->db->from($this->table);
	    $this->db->where('user_id',$id);
		$query=$this->db->get();
		$result=$query->result_array();
		return (!empty($result))?$result:false;
	}

	

}
