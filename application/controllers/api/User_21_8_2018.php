<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('api');
	    $this->load->model('UserModel');
	    $this->load->model('UserExternalLoginModel');
	   // $this->load->library('mailer');
	    
	}

	public function socialLogin() {

		$login_type = $this->input->post('login_type');
		if($login_type=='G'){
			$this->form_validation->set_rules('gmail_id','Gmail id','trim|required');
		}elseif ($login_type=='F') {
			$this->form_validation->set_rules('facebook_id', 'Facebook_id', 'trim|required');
		}
	
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		$this->form_validation->set_rules('login_type', 'Login Type', 'trim|required');

		if ($this->form_validation->run() == true){

			if($login_type =="G"){
				$social_id = $this->input->post('gmail_id');
				//$criteria['conditions'] = array('external_user_id'=>$social_id);
				$criteria['conditions'] = array('external_user_id'=>$social_id,'external_authentication_provider'=>'1');
			}else if($login_type == 'F'){
				$social_id = $this->input->post('facebook_id');
				//$criteria['conditions'] = array('external_user_id'=>$social_id);
				$criteria['conditions'] = array('external_user_id'=>$social_id,'external_authentication_provider'=>'2');
			}
			$criteria['field'] = 'id,user_id';
			$criteria['returnType'] = 'single';
			$user = $this->UserExternalLoginModel->search($criteria);

			unset($criteria);
			if(!empty($user)) {
				$user_id= $user['user_id'];
				$criteria['field'] = 'id,name,email,created_at,updated_at';
				$criteria['conditions'] = array('id'=>$user_id);
				$criteria['returnType'] = 'single';
				$user_data = $this->UserModel->search($criteria);
				unset($criteria);

				$response = array('status'=>true,'message'=>'Login successfully','user'=>$user_data);
			}else{
				$email = $this->input->post('email');
		 		 $is_exits_email = $this->UserModel->checkEmailExists($email);
		 		 //dd($is_exits_email);
		 		if(!empty($is_exits_email)) {
		 			 $user_id = $is_exits_email['id'];
		 			 $insert_data= array(
		 			 	'user_id' =>$user_id,
		 			 	'name'=>$this->input->post('name'),
		 			 	'email'=>$this->input->post('email'),
		 			 	'created_at' => date("Y-m-d H:i:s")
		 			 );

		 			 if($login_type =="G"){
						$insert_data['external_authentication_provider'] ="1";
						$insert_data['external_user_id']=$this->input->post('gmail_id');
					}else if($login_type == 'F'){
						$insert_data['external_authentication_provider'] ="2";
						$insert_data['external_user_id']=$this->input->post('facebook_id');
					}
					$this->UserExternalLoginModel->insert($insert_data);
					$criteria['field'] = 'id,name,email,created_at,updated_at';
					$criteria['conditions'] = array('id'=>$user_id);
					$criteria['returnType'] = 'single';
					$user_data = $this->UserModel->search($criteria);
					unset($criteria);
					$response = array('status'=>true,'message'=>'Login successfully','user'=>$user_data);
				}else{ 
					$register_data =array(
						'name' => $this->input->post('name'),
						'email'=>$this->input->post('email'),
						'created_at'=>date("Y-m-d H:i:s")
					);
					/*if($login_type=='G'){
						$register_data['gmail_id']= $this->input->post('gmail_id');
					}elseif ($login_type=='F') {
						$register_data['facebook_id']= $this->input->post('facebook_id');
					}	*/

			  		$insert_id = $this->UserModel->insert($register_data);
		      		if($insert_id) {
		      			$insert_data= array(
			 			 	'user_id' =>$insert_id,
			 			 	'name'=>$this->input->post('name'),
			 			 	'email'=>$this->input->post('email'),
			 			 	'created_at' => date("Y-m-d H:i:s")
			 			 );

			 			if($login_type =="G"){
							$insert_data['external_authentication_provider'] ="1";
							$insert_data['external_user_id']=$this->input->post('gmail_id');
						}else if($login_type == 'F'){
							$insert_data['external_authentication_provider'] ="2";
							$insert_data['external_user_id']=$this->input->post('facebook_id');
						}
						//dd($insert_data);
						$this->UserExternalLoginModel->insert($insert_data);
						//echo $this->db->last_query();die;
						$criteria['field'] = 'id,name,email,created_at,updated_at';
						$criteria['conditions'] = array('id'=>$insert_id);
						$criteria['returnType'] = 'single';
						$user = $this->UserModel->search($criteria);
						if(!empty($user)){
							$response = array('status'=>true,'message'=>'Login successfully','user'=>$user);
						}else{
							$response = array('status'=>false,'message'=>'Something went wrong');
						}
					}else{
						
						$response = array('status'=>false,'message'=>'An error occured!Please try again');
					}
			}

			}
		
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}

		$this->renderJson($response);
	} // end of socialLogin method


//General Email login
	public function login() {


		$this->form_validation->set_rules('username', 'username or email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == true){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->UserModel->check_user_exits(array('name'=>$username));
			if($user){
				$is_verified = password_verify($password,$user['password']);
				if($is_verified){
					$response = array('status'=>true,'message'=>'Login successfully','user'=>$user);
				}else{
					$response = array('status'=>false,'message'=>'Your password doesn\'t match');
				}
			}else{
				$response = array('status'=>false,'message'=>'User detail not found');
			}
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}


	    $this->renderJson($response);

	}

//General Email login

//Signup 



	public function signup() {


			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|min_length[12]');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_unique[users.phone]');

			if ($this->form_validation->run() == true){
		   	  		$insert_data=array(
		   			'first_name'=>$this->input->post('first_name'),
					'last_name'=>$this->input->post('last_name'),
					'email'=>$this->input->post('email'),
					'password'=>password_hash($this->input->post('password'),PASSWORD_BCRYPT),
					'phone'=>$this->input->post('phone'),
					'created_at'=>date('Y-m-d H:i:s')
		   			
		   		);

		   		$insert_id= $this->UserModel->insert($insert_data);
				if($insert_id) {
					$criteria['field'] = 'id,first_name,last_name,phone,email,created_at,updated_at';
					$criteria['conditions'] = array('id'=>$insert_id);
					$criteria['returnType'] = 'single';

					$user= $this->UserModel->search($criteria);
					$response = array('status'=>true,'message'=>'Record inserted successfully','user'=>$user);
				}else{
					$response = array('status'=>false,'message'=>'Somthing went wrong!Please try again');
				}
			}else{

		   		$errors = $this->form_validation->error_array();
				$response = array('status'=>false,'message'=>$errors);
			}

		   $this->renderJson($response);

	}

//Signup end
	   
	

	/*
	* Api : To edit a user profile
	* Parameter : user_id , name,first_name,last_name,email,phone
	 */
	 
	public function editProfile(){

		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		$this->form_validation->set_rules('name', 'Nick Name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		//$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Contact', 'trim|required');
		
		
		if ($this->form_validation->run() == true){
			$user_id = $this->input->post('user_id');
			$email = $this->input->post('email');
			$is_email_exist = $this->UserModel->checkEmailExistsExcept($user_id,$email);
			if(!$is_email_exist) {
				$user_id = $this->input->post('user_id');
				$update_data = array(
					'name'=>$this->input->post('name'),
					'first_name'=>$this->input->post('first_name'),
					'last_name'=>$this->input->post('last_name'),
					//'email'=>$this->input->post('email'),
					'phone'=>$this->input->post('phone')
				);
				$this->UserModel->update($update_data,array('id'=>$user_id));
				$criteria['field'] = 'id,name,first_name,last_name,phone,updated_at';
				$criteria['conditions'] = array('id'=>$user_id);
				$criteria['returnType'] = 'single';

				$user= $this->UserModel->search($criteria);
				$response =array('status'=>true,'message'=>'Record updated successfully','user'=>$user);
				
			}
			else{
			
				$response = array('status'=>false,'message'=>'Email is already registered!');
			}

		}else{
				
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}

		$this->renderJson($response);
	}// end of edit profile method
	
//Get User Profile

	public function getUserProfile(){
		//echo $user_id;
		 $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		if ($this->form_validation->run() == true){
			$user_id = $this->input->post('user_id');
			$criteria['field'] = 'id,name,first_name,last_name,email,phone,updated_at';
			$criteria['conditions'] = array('id'=>$user_id);
			$criteria['returnType'] = 'single';
			$userData= $this->UserModel->search($criteria);
			if(!empty($userData)) {
				$response =array('status'=>true,'message'=>'User detail found successfully','user'=>$userData);
			}else{
				$response =array('status'=>false,'message'=>'Record not found');
			}
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}
		$this->renderJson($response);
	}
	
//Get User Profile end
	
	   
	   
	   
	   
	   
	

	/*
	* Api : To edit a user profile
	* Parameter : user_id , name,first_name,last_name,email,phone
	 */
	/* public function editProfile(){

		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == true){
			$user_id = $this->input->post('user_id');
			$email = $this->input->post('email');
			$is_email_exist = $this->UserModel->checkEmailExistsExcept($user_id,$email);

			if(!$is_email_exist) {
				$file_name = '';
				if(isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name'])) {

					$url = FCPATH."uploads/app/";	
					$upload =$this->do_upload('profile_image',$url);
					if(isset($upload['upload_data'])){
						chmod($upload['upload_data']['full_path'], 0777);
						$file_name = $upload['upload_data']['file_name'];
					}
				}
				$user_id = $this->input->post('user_id');
				$update_data = array(
					'name' =>$this->input->post('name'),
					'email' =>$this->input->post('email')
				);
				if($file_name != ''){
					$update_data['profile_image']=$file_name;
				}

				$this->UserModel->update($update_data,array('id'=>$user_id));
				$criteria['field'] = 'id,otp,otp_verify,phone,name,profile_image,email,password,created_at,updated_at';
				$criteria['conditions'] = array('id'=>$user_id);
				$criteria['returnType'] = 'single';

				$user= $this->UserModel->search($criteria);
				$user['profile_image'] = base_url()."uploads/app/".$user['profile_image'];
				$response =array('status'=>true,'message'=>'Record updated successfully','user'=>$user);
			}else{
				$response = array('status'=>false,'message'=>'Email is already registered!');
			}

		}else{

			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}

		$this->renderJson($response);
	} */// end of edit profile method

	

	
	//Push notification 
	
	

public function sendNotification() {
	
			
			//$user_id = $this->input->post('user_id');
			$user = $this->UserModel->get_all();
			//print_r($user);die;
			foreach($user as $userData){ 
		//	$userData['deid'];
			$msg=array('title'=>'Test Notification','icon'=> base_url().'public/images/notify_icon.png','sound'=> 1,'body'=>'fghgfhg');
			$notifymsg=array(
				'notification'=>$msg,
				'to'  =>$userData['device_id']
			);
			$notification_result=send_push_notification($notifymsg,ANDRIOD_PUSH_AUTH_KEY);
			dd($notification_result,false);
			$this->session->set_flashdata('success_msg', 'Push notification send successfully!');
				}
			
	
	}

	
//Push notification end

}// end of class
