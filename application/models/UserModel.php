<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends MY_Model {

	protected $table = 'users';

	public function __construct()
	{
	    parent::__construct();
	}

	public function verifyOtp($data=array()) {
		$this->db->select('*');
		$this->db->where($data);
		$query=$this->db->get($this->table);
		$result=$query->result_array();
		return (!empty($result))?true:false;
	}

	public function check_user_exits($data = array()) {
		$this->db->select('id,name,email,,password,user_role,created_at',false);
		$this->db->where($data);
		$query=$this->db->get($this->table);
		$result=$query->row_array();
		return (!empty($result))?$result:false;
	}

	public function checkEmailExistsExcept($id,$email){
		$this->db->select('*');
		$this->db->where(array('id !='=>$id,'email'=>$email));
		$query = $this->db->get($this->table);
		$result = $query->result_array();
		return (!empty($result))?true:false;
	}

	public function checkEmailExists($email){
		$this->db->select('id,email');
		$this->db->where(array('email'=>$email));
		$query = $this->db->get($this->table);
		$result = $query->row_array();
		return (!empty($result))? $result : false;
	}

	public function checkPhoneExists($phone) {
		$this->db->select('id,phone,otp_verify');
		$this->db->where(array('phone'=>$phone));
		$query = $this->db->get($this->table);
		$result = $query->row_array();
		return (!empty($result))? $result :false;
	}

	public function getStaffs()
	{
	$this->db->select('id,email,name,first_name,last_name,phone,profile_image,created_at,user_role,role_name');
	//$this->db->where(array('email'=>$email));
	$this->db->from($this->table);
	$this->db->join('user_roles', 'user_roles.role_id = users.user_role');
	$this->db->where(array('user_role !='=>0));
	//$this->db->where_in('user_role', array('1','2','3'));

	$query = $this->db->get();
	$result = $query->result_array();
	return (!empty($result))? $result : false;	

	}


	public function getAllUsers()
	{
	$this->db->select('id,email,name,first_name,last_name,phone,profile_image,created_at,user_role');
	//$this->db->where(array('email'=>$email));
	$this->db->from($this->table);
	$this->db->where(array('user_role ='=>0));
	//$this->db->where_in('user_role', array('1','2','3'));
	$query = $this->db->get();
	$result = $query->result_array();
	return (!empty($result))? $result : false;	

	}

}
