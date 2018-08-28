<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ConfirmEnquiryModel extends MY_Model {

	protected $table = 'enquiries';

	public function __construct()
	{
	    parent::__construct();
	}
	public function getAllEnquiries(){
		$this->db->select('e.*,cb.brand_name,cm.model_name,u.name');
		$this->db->from($this->table.' AS e');
		$this->db->join('cars AS c','e.car_id = c.id');
		$this->db->join('car_brands AS cb','c.brand_id = cb.id');
		$this->db->join('car_models AS cm','c.model_id = cm.id');
		$this->db->join('users AS u','c.user_id = u.id');
		$this->db->order_by('e.id','DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result : false;

	}
		
}
