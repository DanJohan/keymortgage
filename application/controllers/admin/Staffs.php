<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Staffs extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('UserModel');
			$this->load->model('UserProjectModel');
			$this->load->model('UserBankModel');
			$this->load->model('DocumentModel');
			$this->load->model('NotificationModel');
			$this->load->helper('api');
			$this->load->model('UserRolesModel');
		    $this->load->model('StaffEnquiryModel');

			if (!$this->session->userdata['is_admin_login'] == TRUE)
			{
			   redirect('admin/auth/login'); //redirect to login page
			} 
		}
 
		public function index(){
			$data['pageTitle']= "Staffs";
			$data['all_staff'] =  $this->UserModel->getStaffs(NULL,array('id','desc'));
			$this->db->last_query();
			//dd($data['all_staff']);
			$data['view'] = 'admin/staffs/staff_list';
			$this->load->view('admin/layout', $data);
		}
	
		public function edit($id = null){
				$data['pageTitle']= "Edit staff";
			if(!$id){
				redirect('admin/staff');
			}

			if($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'Username', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				
				
				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->UserModel->get(array('id'=>$id));
					$data['view'] = 'admin/staffs/staff_edit';
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
                	redirect(base_url('admin/staffs'));
               
				}
			}
			else{
				$data['user'] = $this->UserModel->get(array('id'=>$id));
				$data['view'] = 'admin/users/user_edit';
				$this->load->view('admin/layout', $data);
			}
		}


	/*public function add(){
			   $data['userRoles']=  $this->UserRolesModel->get_all();
			if ($this->input->post('addUser')) { 
			$this->form_validation->set_rules('name', 'User name', 'trim|required');	
			$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
			$this->form_validation->set_rules('role_name', 'User Roles', 'trim|required');

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
		*/
	public function detail($id=0){
			
			$data=array();
			$criteria['field'] = 'id,name,first_name,last_name,email,profile_image,phone';
			$criteria['conditions'] = array('id'=>$id);
			$criteria['returnType'] = 'single';
			$data['staff'] =  $this->UserModel->search($criteria);
			//dd($data['sfaff']);
			//$data['usersProject'] = $this->UserProjectModel->getProjectByUserId($id);
			//$data['usersBank'] = $this->UserBankModel->getBankByUserId($id);
			$data['staffDoc'] = $this->DocumentModel->getUserDocumentById($id);
			$data['staffEnq'] = $this->StaffEnquiryModel->getEnquiryByUserId($id);
			//echo $this->db->last_query();die;
			//dd($data['StaffEnq']);
			$data['pageTitle']= "Staff Profile";
			$data['view'] = 'admin/staffs/staff_detail';
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
					'type'=>'admin',
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
			
			redirect('admin/staffs/detail/'.$user_id);
	
	}

//Push notification end

// Send document method start


public function sendDocument() {
		//dd($_FILES,false);
		//dd($_POST);	
	if ($this->input->post('Submit')) {
//print_r($_POST);die;
			$user_id = $this->input->post('user_id');
				$files_data = array();
				$file_not_uploaded = array();

				if(isset($_FILES['document_image']) && !empty($_FILES['document_image']['name'])){
					$filesCount = count($_FILES['document_image']['name']);
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['document_image']['name'][$i];
						$_FILES['file']['type']     = $_FILES['document_image']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['document_image']['tmp_name'][$i];
						$_FILES['file']['error']     = $_FILES['document_image']['error'][$i];
						$_FILES['file']['size']     = $_FILES['document_image']['size'][$i];

						$url = FCPATH.'uploads/admin/';
						$config['allowed_types']='*';
						$upload = $this->do_upload('file',$url,$config);
					   	dd($upload,false);
						if(isset($upload['upload_data'])){
							chmod($upload['upload_data']['full_path'], 0777);
							$files_data[$i] = $upload['upload_data']['file_name'];
						}else{
							$file_not_uploaded[$i]['file'] =  $_FILES['file']['name'] ;
							$file_not_uploaded[$i]['error'] =  strip_tags($upload['error']) ;
						}
					}
				}
				$insert_data= array(
					'user_id'=>$user_id,
					'document_image'=>(!empty($files_data))?json_encode($files_data):'',
					'message'=>$this->input->post('message'),
					'created_at'=>date('Y-m-d H:i:s')
				);
				$this->StaffEnquiryModel->insert($insert_data);   

			
			
			redirect('admin/staffs/detail/'.$user_id);
	
	}

}
	
//Send document method end 





			
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




