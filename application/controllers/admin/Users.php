<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Users extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('UserModel');
			$this->load->model('UserProjectModel');
			$this->load->model('UserBankModel');
			$this->load->model('DocumentModel');
			$this->load->model('NotificationModel');
			$this->load->helper('api');
		    $this->load->model('UserRolesModel');

			if (!$this->session->userdata['is_admin_login'] == TRUE)
			{
			   redirect('admin/auth/login'); //redirect to login page
			} 
		}
 
		public function index(){
			$data['pageTitle']= "Users";
			$data['all_users'] =  $this->UserModel->get_all(NULL,array('id','desc'));
			$data['view'] = 'admin/users/user_list';
			$this->load->view('admin/layout', $data);
		}
	
		public function edit($id = null){
				$data['pageTitle']= "Edit User";
			if(!$id){
				redirect('admin/users');
			}

			if($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'Username', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				
				
				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->UserModel->get(array('id'=>$id));
					$data['view'] = 'admin/users/user_edit';
					$this->load->view('admin/layout', $data);
				}
				else{
					
					$file_name = $this->input->post('old_image');
					$old_file_name = $file_name;	
					
						if(isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name'])) {
							$path= FCPATH.'uploads/admin/';

					    	$upload= $this->do_upload('profile_image',$path);
							if(isset($upload['upload_data'])){
								$file_name = $upload['upload_data']['file_name'];
								if(file_exists($path.$old_file_name)){
									unlink($path.$old_file_name);
								}

							}
						}
					
					
					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'profile_image' => $file_name
					);
					$result = $this->UserModel->update($data, array('id'=>$id));
					$this->session->set_flashdata('msg', 'User updated Successfully!');          
                	redirect(base_url('admin/users'));
               
				}
			}
			else{
				$data['user'] = $this->UserModel->get(array('id'=>$id));
				$data['view'] = 'admin/users/user_edit';
				$this->load->view('admin/layout', $data);
			}
		}


	public function add(){
			   $data['userRoles']=  $this->UserRolesModel->get_all();
//print_r($data['userType']);
			if ($this->input->post('addUser')) { 
			$this->form_validation->set_rules('name', 'User name', 'trim|required');	
			$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
			$this->form_validation->set_rules('role_name', 'User Roles', 'trim|required');

			// $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|min_length[8]|alpha_numeric');	
			
				
				
				if ($this->form_validation->run() == FALSE) {
					$data['pageTitle'] = 'Add User';
					$data['view'] = 'admin/users/user_add';
					$this->load->view('admin/layout', $data);
				}
				else{	

			$file_name = '';
			if(isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name'])) {
					$path= FCPATH.'uploads/admin';
					$upload= $this->do_upload('profile_image',$path);
					if(isset($upload['upload_data'])){
						$file_name = $upload['upload_data']['file_name'];
						}
					};	
				
				 $data = array(
                'name' =>$this->input->post('name'),
               	'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'profile_image' => $file_name,
				'user_role' =>$this->input->post('role_name'),
				'created_at' => date('Y-m-d H:i:s')
				);
				
             

		        $res = $this->UserModel->Insert($data);
			 if ($res) {
				
				redirect(base_url() . 'admin/users?msg=success');
				
            }else{
				redirect(base_url() . 'admin/users?msg=error');
			}
      
           }

        }
		$data['pageTitle'] = 'Add User';
        $data['view'] = 'admin/users/user_add';
		$this->load->view('admin/layout', $data);	

		}	
		
	public function detail($id=0){
			
			$data=array();
			$criteria['field'] = 'id,name,first_name,last_name,email,profile_image,phone';
			$criteria['conditions'] = array('id'=>$id);
			$criteria['returnType'] = 'single';
			$data['user'] =  $this->UserModel->search($criteria);
			$data['usersProject'] = $this->UserProjectModel->getProjectByUserId($id);
			$data['usersBank'] = $this->UserBankModel->getBankByUserId($id);
			$data['usersDoc'] = $this->DocumentModel->getUserDocumentById($id);
			//dd($data['usersDoc']);die;
			$data['view'] = 'admin/users/user_detail';
			$this->load->view('admin/layout',$data);
		}
			

		public function sendDocumentNotification() {
			$user_id = $this->input->post('user_id');
			$message = $this->input->post('message');
			$criteria['field']="device_id,device_type";
			$criteria['conditions']= array('id' =>$user_id);
			$criteria['returnType']="single";
			$user = $this->UserModel->search($criteria);

			if(!empty($user))	
			{
				$notification_data = array(
					'user_id'=>$user_id,
					'text' =>$message,
					'type'=>'Document pending',
					'created_at'=>date("Y-m-d H:i:s")
				);
				$this->NotificationModel->insert($notification_data);
				$msg=array('body'=>$message,'title'=>'Key mortgage','icon'=> base_url().'public/images/app/notify_icon.png','sound'=> 1);
				$notifymsg=array(
					'notification'=>$msg,
					'to'  =>$result['device_id']
				);
				
				if($user['device_type']=='A') {
					$notification_result=send_push_notification($notifymsg,ANDRIOD_PUSH_AUTH_KEY);
				
				}elseif($user['device_type']=='I'){
					$notification_result=send_push_notification($notifymsg,IOS_PUSH_AUTH_KEY);
				}	
			}		
			
     
			$this->session->set_flashdata('success_msg', 'Message send successfully!');
			
			redirect('admin/users/detail/'.$user_id);
	
	}

//Push notification end

			
	public function del($id = null){
			if(!id){
				redirect('admin/users');
			}
			$this->UserModel->delete(array('id' => $id));
			$this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
			redirect(base_url('admin/users'));
		

	}

	public function sendMessageView() {
		$user_id = $this->input->post('user_id');

		if($user_id){
			$template=$this->load->view('admin/users/document_message',compact('user_id'),true);
			$response = array('status'=>true,'message'=>'Record fetch successfully','template'=>$template);
		}else{
			$response = array('status'=>false,'message'=>'Detail not found');
		}
		$this->renderJson($response);
	}

}
?>




