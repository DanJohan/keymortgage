<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Notification extends MY_Controller {
		public function __construct(){
			parent::__construct();

			if (!$this->session->userdata['is_admin_login'] == TRUE)
			{
			   redirect('admin/auth/login'); //redirect to login page
			} 
			$this->load->model('UserModel');
			$this->load->model('UserRolesModel');
			$this->load->model('NotificationModel');
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
					$notification_data = array();
				    if(!empty($users)){
				    	foreach ($users as $index => $user) {
				    		$notification_data[$index]['user_id'] = $user['id'];
				    		$notification_data[$index]['text'] = $message;
				    		$notification_data[$index]['type'] = 'admin';
				    		$notification_data[$index]['created_at'] = date('Y-m-d H:i:s');
				    	}
				    }
				    if(!empty($notification_data)){
				    	$insert=$this->NotificationModel->insert_batch($notification_data);
				    	if($insert){
				    		$this->session->set_flashdata('success_msg',"Message  send successfully!");
				    	}
				    }else{
				    		$this->session->set_flashdata('error_msg',"Message not send! Pleas try again");
				    }
				}
				redirect('admin/notification/create');
			}

			$data['userRoles']=  $this->UserRolesModel->get_all();
			$data['view'] = 'admin/notification/create';
			$this->load->view('admin/layout', $data);
		}

	}

?>	