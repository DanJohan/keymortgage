<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Projects extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('ProjectModel');
			$this->load->model('CategoryModel');
			$this->load->model('UserProjectModel');
			if (!$this->session->userdata['is_admin_login'] == TRUE)
			{
			   redirect('admin/auth/login'); //redirect to login page
			} 
		}
 
		public function index(){
			$data['pageTitle']= "Projects";
			
			$criteria['field'] = 'projects.*,project_category.*';	
			$criteria['join']=array(
				array('project_category','projects.cat_id=project_category.cat_id','inner')
			);
			$data['all_Project'] =  $this->ProjectModel->search($criteria);
			$data['view'] = 'admin/project/project_list';
			$this->load->view('admin/layout', $data);
		}
	
		public function edit($id = null){
		$data['projectCats'] = $this->CategoryModel->get_all();
		$data['pageTitle']= "Edit Project";
			if(!$id){
				redirect('admin/projects');
			}

			if($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'Project name', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');


				
				
				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->ProjectModel->get(array('id'=>$id));
					$data['view'] = 'admin/projects/project_edit';
					$this->load->view('admin/layout', $data);
				}
				else{
					
					$file_name = $this->input->post('old_image');
					$old_file_name = $file_name;	
					
						if(isset($_FILES['project_image']) && !empty($_FILES['project_image']['name'])) {
							$path= FCPATH.'uploads/projects/';

					    	$upload= $this->do_upload('project_image',$path);
							if(isset($upload['upload_data'])){
								$file_name = $upload['upload_data']['file_name'];
								if(file_exists($path.$old_file_name)){
									unlink($path.$old_file_name);
								}

							}
						}
					
					
					$data = array(
						'name' =>$this->input->post('name'),
               			'location' => $this->input->post('location'),
               			'cat_id' => $this->input->post('cat_name'),
               			'cost' => $this->input->post('cost'),
               			'size' => $this->input->post('size'),
               			'description' => $this->input->post('description'),
						'project_image' => $file_name
						);

					$result = $this->ProjectModel->update($data, array('id'=>$id));
					$this->session->set_flashdata('msg', 'Record updated Successfully!');          
                	redirect(base_url('admin/projects'));
               
				}
			}
			else{
				$data['project'] = $this->ProjectModel->get(array('id'=>$id));
				$data['view'] = 'admin/project/project_edit';
				$this->load->view('admin/layout', $data);
			}
		}


	public function add(){
		 $data['projectCats'] = $this->CategoryModel->get_all();
		 //dd($data['projectCats']);
			if ($this->input->post('addProject')) {
			//print_r($_POST);die; 
			$this->form_validation->set_rules('name', 'Project name', 'trim|required');	
			$this->form_validation->set_rules('location', 'location', 'required|trim');
			$this->form_validation->set_rules('cat_name', 'Category name', 'required|trim');
			$this->form_validation->set_rules('cost', 'Project Cost', 'required|trim');
			$this->form_validation->set_rules('size', 'Project Size', 'required|trim');
			$this->form_validation->set_rules('description', 'Project description', 'required|trim');
					
								
				if ($this->form_validation->run() == FALSE) {
					$data['pageTitle'] = 'Add Project';
					$data['view'] = 'admin/project/project_add';
					$this->load->view('admin/layout', $data);
				}
				else{	

			 $file_name = '';
			 if(isset($_FILES['project_image']) && !empty($_FILES['project_image']['name'])) {
			 		$path= FCPATH.'uploads/projects';
			 		$upload= $this->do_upload('project_image',$path);
			 		if(isset($upload['upload_data'])){
			 			$file_name = $upload['upload_data']['file_name'];
			 			}
			 		};	
				//print_r($_POST);die;
				 $data = array(
                'name' =>$this->input->post('name'),
               	'location' => $this->input->post('location'),
               	'cat_id' => $this->input->post('cat_name'),
               	'cost' => $this->input->post('cost'),
               	'size' => $this->input->post('size'),
               	'description' => $this->input->post('description'),
               	'project_image' => $file_name,
				'created_at' => date('Y-m-d H:i:s')
				);
			
            $res = $this->ProjectModel->insert($data);
           
			 if ($res) {
				
				$this->session->set_flashdata('msg', 'Record inserted Successfully!');
				redirect(base_url() . 'admin/projects');
				
            }else{
            	
            	$this->session->set_flashdata('error_msg', 'some thing went wrong please try again!');
				redirect(base_url() . 'admin/projects');
			}
      
           }

        }
		$data['pageTitle'] = 'Add Project';
        $data['view'] = 'admin/project/project_add';
		$this->load->view('admin/layout', $data);	

		}	

		
	public function detail($id){
			
			$data=array();
			$data['pageTitle']= "Project Detail";
			$criteria['field'] = 'projects.*,project_category.*,user_projects.*';		 
			$criteria['join'] = array(
				array('project_category','projects.cat_id=project_category.cat_id','inner'),
				array('projects','user_projects.project_id=projects.id','left'),
				
			);
			$criteria['conditions'] = array('user_projects.user_id'=>$id);
			$criteria['returnType'] = 'join';
			$data['projectDetail'] =  $this->ProjectModel->search($criteria); 
			//print_r($data['projectDetail']);die;
			echo $this->load->view('admin/project/project_detail',$data,true);
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

		
		






		
		public function del($id = null){
			if(!id){
				redirect('admin/projects');
			}
			$this->ProjectModel->delete(array('id' => $id));
			$this->session->set_flashdata('msg', 'Record deleted Successfully!');
			redirect(base_url('admin/projects'));
		}

	}


?>