<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Newsfeed extends MY_Controller {
		public function __construct(){
			parent::__construct();

			if (!$this->session->userdata['is_admin_login'] == TRUE)
			{
			   redirect('admin/auth/login'); //redirect to login page
			} 
			$this->load->model('UserModel');
			$this->load->model('UserRolesModel');
			$this->load->model('NewsfeedModel');
		}


		public function create(){
			//dd($_FILES);
			if($this->input->post('submit')){
				$send_to = $this->input->post('send_to');
				$title = $this->input->post('title');
				$message = $this->input->post('message');
				if($send_to != ''){
					$criteria['field'] = 'id';
					if($send_to != '0') {
						$criteria['conditions'] = array('user_role'=>$send_to);
					}
					$users = $this->UserModel->search($criteria);
					$newsfeed_data = array();
				    if(!empty($users)){
				    	$file_name = '';
						if(isset($_FILES['newsfeed_image']) && !empty($_FILES['newsfeed_image']['name'])) {
							$path= FCPATH.'uploads/admin/';
							$upload= $this->do_upload('newsfeed_image',$path);
							if(isset($upload['upload_data'])){
								$file_name = $upload['upload_data']['file_name'];

							}
						}
				    	
				    	foreach ($users as $index => $user) {
				    		$newsfeed_data[$index]['user_id'] = $user['id'];
				    		$newsfeed_data[$index]['title'] = $title;
				    		$newsfeed_data[$index]['message'] = $message;
				    		$newsfeed_data[$index]['image'] = $file_name;
				    		$newsfeed_data[$index]['created_at'] = date('Y-m-d H:i:s');
				    	}
				    }
				    if(!empty($newsfeed_data)){
				    	$insert=$this->NewsfeedModel->insert_batch($newsfeed_data);
				    	if($insert){
				    		$this->session->set_flashdata('success_msg',"Message  send successfully!");
				    	}
				    }else{
				    		$this->session->set_flashdata('error_msg',"Message not send! Pleas try again");
				    }
				}
				redirect('admin/newsfeed/create');
			}

			$data['userRoles']=  $this->UserRolesModel->get_all();
			$data['view'] = 'admin/newsfeed/create';
			$this->load->view('admin/layout', $data);
		}

	}

?>	