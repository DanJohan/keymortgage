<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends MY_Controller {

	public function __construct()
	{
	    parent::__construct();
	     $this->load->model('BankModel');
		 $this->load->model('UserBankModel');
	}

	
	/**
	 *  API DESCRIPTION : To get all Banks
	 *  API URL :http://localhost/key_mortgage/api/Bank/getBanks
	 *  PARAMETER : not required
	 */
	public function getBanks(){
	
		$criteria['field'] = 'banks.*';
		$banks_list = $this->BankModel->search($criteria);
	
	if(!empty($banks_list))
	{
		foreach ($banks_list as $banks) {
		
				$image_path = base_url().'uploads/banks/';
				$results['bank_id'] = $banks['bank_id'];
				$results['bank_name'] = $banks['bank_name'];	
				$results['bank_name'] = $banks['bank_name'];
				$results['bank_domain'] = $banks['bank_domain'];
				$results['bank_branch'] = $banks['bank_branch'];
				if(empty($banks['bank_logo']))
				{
					$results['bank_logo'] = NULL;
				}
				else
				{
					$results['bank_logo'] = $image_path.$banks['bank_logo'];
				}

				$results['created_at'] = $banks['created_at'];
				$response['bank_details'][] = $results;
		}	
    }
	else
	{
		$response= array("msg"=>"Record Not Found", "status"=>"404");
	}
		
	$this->renderJson($response);
	
	
	}// end of Getbanks method

	
	/**
	 *  API DESCRIPTION : To get all Banks
	 *  API URL :http://localhost/key_mortgage/api/Bank/addBanks
	 *  PARAMETER : not required
	 */
	// Addbanks method
	public function addBanks(){
		$this->form_validation->set_rules('bank_name', 'bank name', 'trim|required');
		$this->form_validation->set_rules('bank_domain', 'Bank Url', 'trim|required|valid_url');
		$this->form_validation->set_message('valid_url', 'The {field} field must contain a valid URL like (https://example.com).');
		$this->form_validation->set_rules('bank_branch', 'bank branch', 'trim|required');
		//$this->form_validation->set_rules('bank_logo', 'bank logo', 'trim|required');
		
		$file_name = '';
			if(isset($_FILES['bank_logo']) && !empty($_FILES['bank_logo']['name'])) {
					$path= FCPATH.'uploads/banks';
					$config['allowed_types'] = '*';
					$upload= $this->do_upload('bank_logo',$path,$config);
					if(isset($upload['upload_data'])){
						$file_name = $upload['upload_data']['file_name'];
						}
					};	 
	
		if ($this->form_validation->run() == true){
			$insert_data = array(
				'bank_name' => $this->input->post('bank_name'),
				'bank_domain' => $this->input->post('bank_domain'),
				'bank_branch' => $this->input->post('bank_branch'),
				'bank_logo' => $file_name,
				'created_at' => date("Y-m-d H:i:s")
			);

				
			$insert_id = $this->BankModel->insert($insert_data);
			if($insert_id){
				$response = array('status'=>true,'message'=>'Data inserted successfully!');
			}else{
				$response = array('status'=>false,'message'=>'Somthing went wrong!Please try again');
			}
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}

		$this->renderJson($response);

	}
// end Addbanks method

public function addUserBank(){
		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		$this->form_validation->set_rules('bank_id', 'Bank id', 'trim|required');

		if ($this->form_validation->run() == true){
			$insert_data = array(
				'user_id' => $this->input->post('user_id'),
				'bank_id' => $this->input->post('bank_id'),
				'created_at' => date("Y-m-d H:i:s")
			);

			$insert_id = $this->UserBankModel->insert($insert_data);
			if($insert_id){
				$response = array('status'=>true,'message'=>'Bank selected successfully!');
			}else{
				$response = array('status'=>false,'message'=>'Somthing went wrong!Please try again');
			}
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}

		$this->renderJson($response);

	}

	public function getUserBank() {

		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		if ($this->form_validation->run() == true){
			$user_id = $this->input->post('user_id');
			$banks = $this->UserBankModel->getUserBanks($user_id);
			//print_r($banks);die;
			if(!empty($banks)) {
				$response = array('status'=>true,'message'=>'Detail found successfully!','data'=>$banks);
			}else{
				$response= array('status'=>false,'message'=>'Not detail found!');
			}

		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);

		}
		$this->renderJson($response);
	}// end of getUserProject method







}// end of class
?>