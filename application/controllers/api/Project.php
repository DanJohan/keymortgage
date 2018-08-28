<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class project extends MY_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('api');
	    $this->load->model('ProjectModel');
	    $this->load->model('UserProjectModel');
		$this->load->model('NotificationModel');
	}


	/**
	 *  API DESCRIPTION : To get all Projects
	 *  API URL :http://localhost/key_mortgage/api/project/getProjects
		*  PARAMETER : not required
	 */
	public function getProjects(){
	
	$project_list = $this->ProjectModel->getProjects();
			
	if(!empty($project_list))
	{
		
		$response = array('status'=>true,'message'=>'Record found successfully', 'project_details'=>$project_list);

                                 
    }
	else
	{
		$response= array("msg"=>"Record Not Found", "status"=>"404");
	}
		
	$this->renderJson($response);
	
	
	}// end of Getproject method

	public function addUserProject(){
		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		$this->form_validation->set_rules('project_id', 'Project id', 'trim|required');

		if ($this->form_validation->run() == true){
			$user_id = $this->input->post('user_id');
			$project_id = $this->input->post('project_id');
			$insert_data = array(
				'user_id' => $this->input->post('user_id'),
				'project_id' => $this->input->post('project_id'),
				'created_at' => date("Y-m-d H:i:s")
			);

			$insert_id = $this->UserProjectModel->insert($insert_data);
			if($insert_id){
				$result = $this->UserProjectModel->getUserProjectById($insert_id);

			if(!empty($result['user_name'])) {

				$data['body'] = 'Dear '.$result['user_name'].', You have successfully booked '.$result['project_name'];
			
			}

			$notification_data = array(
				'user_id'=>$this->input->post('user_id'),
				'text' =>$data['body'],
				'type'=>'project booking',
				'created_at'=>date("Y-m-d H:i:s")
			);
			$this->NotificationModel->insert($notification_data);


			$msg=array('body'=>$data['body'],'title'=>'Key mortgage','Project name'=>$result['project_name'],'icon'=> base_url().'public/images/app/notify_icon.png','sound'=> 1);
			//print_r($msg);die;
			$notifymsg=array(
				'notification'=>$msg,
				'to'  =>$result['device_id']
			);
			if($result['device_type']=='A') {
				$notification_result=send_push_notification($notifymsg,ANDRIOD_PUSH_AUTH_KEY);
			
			}elseif($result['device_type']=='I'){
				$notification_result=send_push_notification($notifymsg,IOS_PUSH_AUTH_KEY);
			}
			unset($result['device_id']);
			unset($result['device_type']);
			$response = array('status'=>true,'message'=>'Project booked successfully!','data'=>$result);	
				
			}else{
				$response = array('status'=>false,'message'=>'Somthing went wrong!Please try again');
			}
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}

		$this->renderJson($response);

	}

	public function getUserProject() {

		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		if ($this->form_validation->run() == true){
			$user_id = $this->input->post('user_id');
			$projects = $this->UserProjectModel->getUserProjects($user_id);
			if(!empty($projects)) {
				$response = array('status'=>true,'message'=>'Detail found successfully!','data'=>$projects);
			}else{
				$response= array('status'=>false,'message'=>'Not detail found!');
			}

			
			
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);

		}
		$this->renderJson($response);
	}// end of getUserProject method

	public function deleteUserProject() {

		$this->form_validation->set_rules('id', 'Id', 'trim|required');
		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		if ($this->form_validation->run() == true){
			$id = $this->input->post('id');
			$user_id = $this->input->post('user_id');
			$banks = $this->UserProjectModel->delete(array('id'=>$id,'user_id'=>$user_id));
			$response = array('status'=>true,'message'=>'Record deleted successfully!');
			
		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);

		}
		$this->renderJson($response);
	}// end user bank detail delete method
	
	

}