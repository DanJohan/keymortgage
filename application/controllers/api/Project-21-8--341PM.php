<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class project extends MY_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('api');
	    $this->load->model('ProjectModel');
	    $this->load->model('UserProjectModel');
	}

	public function index(){
		$this->load->view('api/test');
	}

	/**
	 *  API DESCRIPTION : To get all Projects
	 *  API URL :http://localhost/key_mortgage/api/project/getProjects
		*  PARAMETER : not required
	 */
	public function getProjects(){
	
		$criteria['field'] = 'projects.*,project_category.*';
		$criteria['join']=array(
				array('project_category','projects.cat_id=project_category.cat_id','inner')
			);
/*		$page = $this->input->post('page');
		$limit=($this->input->post('limit')?$this->input->post('limit'):10);
		$offset = ($page - 1)  * $limit;
		$criteria['limit'] = $limit;
		$criteria['start']=$offset;*/
		$project_list = $this->ProjectModel->search($criteria);
	
	
		
	if(!empty($project_list))
	{
		foreach ($project_list as $project) {
		
				$image_path = base_url().'uploads/projects/';
				$results['id'] = $project['id'];	
				$results['name'] = $project['name'];
				$results['location'] = $project['location'];
				$results['cat_name'] = $project['cat_name'];
				$results['cost'] = $project['cost'];
				$results['size'] = $project['size'];
				$results['description'] = $project['description'];
				if(empty($project['project_image']))
				{
					$results['project_image'] = NULL;
				}
				else
				{
					$results['project_image'] = $image_path.$project['project_image'];
				}

				$results['created_at'] = $project['created_at'];
				$response['project_details'][] = $results;
		}	
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
			$insert_data = array(
				'user_id' => $this->input->post('user_id'),
				'project_id' => $this->input->post('project_id'),
				'created_at' => date("Y-m-d H:i:s")
			);

			$insert_id = $this->UserProjectModel->insert($insert_data);
			if($insert_id){
				$response = array('status'=>true,'message'=>'Project booked successfully!');
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


}