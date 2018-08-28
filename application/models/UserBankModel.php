<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserBankModel extends MY_Model {

	protected $table = 'user_banks';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getUserBanks($user_id) {
	
	$this->db->select('user_banks.id,users.id AS user_id,users.name,users.email,users.profile_image,users.phone,banks.bank_name,banks.bank_domain,CASE WHEN banks.bank_logo="" THEN null ELSE CONCAT("'.base_url().'uploads/banks/",banks.bank_logo) END AS bank_logo,user_banks.user_bank_email,user_banks.user_bank_branch');
		
    $this->db->from('user_banks');
    $this->db->join('users', 'users.id = user_banks.user_id'); 
    $this->db->join('banks', 'banks.bank_id = user_banks.bank_id'); 
    $this->db->where('user_banks.user_id',$user_id);
    $query = $this->db->get();
    return $query->result();
	return (!empty($result))?$result:false;
	
	}
	
// used in  Admin panel
	public function getBankByUserId($user_id) {
	
	$this->db->select('banks.bank_name,banks.bank_domain, bank_logo,banks.bank_branch,user_banks.user_bank_email,user_banks.user_bank_branch');
		
    $this->db->from('user_banks');
   $this->db->join('banks', 'banks.bank_id = user_banks.bank_id'); 
    $this->db->where('user_banks.user_id',$user_id);
    $query = $this->db->get();
    return $query->result_array();
	return (!empty($result))?$result:false;
	
	}

// used in  Admin panel	

	
}