<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	//class Banks extends CI_Controller {
	class Banks extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('BankModel');
			if (!$this->session->userdata['is_admin_login'] == TRUE)
			{
			   redirect('admin/auth/login'); //redirect to login page
			} 
		}
 
		public function index(){
			$data['pageTitle']= "Banks";
			$data['BankData'] =  $this->BankModel->get_all(NULL,array('bank_id','desc'));
			$data['view'] = 'admin/banks/bank_list';
			$this->load->view('admin/layout', $data);
		}
	
		public function edit($id = null){
			$data['pageTitle']= "Edit Bank";
			if(!$id){
				redirect('admin/banks');
			}

			if($this->input->post('submit')){
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
			$this->form_validation->set_rules('bank_domain', 'Bank Url', 'trim|required|valid_url');
			$this->form_validation->set_message('valid_url', 'The {field} field must contain a valid URL like (https://example.com).');
			$this->form_validation->set_rules('bank_branch', 'Bank Branch', 'trim|required');
							
				
				if ($this->form_validation->run() == FALSE) {
					$data['Bank'] = $this->BankModel->get(array('bank_id'=>$id));
					$data['view'] = 'admin/banks/bank_edit';
					$this->load->view('admin/layout', $data);
				}
				else{
					
					$file_name = $this->input->post('old_image');
					$old_file_name = $file_name;	
					
						if(isset($_FILES['bank_logo']) && !empty($_FILES['bank_logo']['name'])) {
							$path= FCPATH.'uploads/banks/';

					    	$upload= $this->do_upload('bank_logo',$path);
							if(isset($upload['upload_data'])){
								$file_name = $upload['upload_data']['file_name'];
								if(file_exists($path.$old_file_name)){
									unlink($path.$old_file_name);
								}

							}
						}
					
					$data = array(
						'bank_name' => $this->input->post('bank_name'),
						'bank_domain' => $this->input->post('bank_domain'),
						'bank_branch' => $this->input->post('bank_branch'),
						'bank_logo' => $file_name
						);
					$result = $this->BankModel->update($data, array('bank_id'=>$id));
					$this->session->set_flashdata('msg', 'Record updated Successfully!');          
                	redirect(base_url('admin/banks'));
               
				}
			}
			else{
				$data['Bank'] = $this->BankModel->get(array('bank_id'=>$id));
				$data['view'] = 'admin/banks/bank_edit';
				$this->load->view('admin/layout', $data);
			}
		}


	public function add(){
			if ($this->input->post('addBank')) { 
			//	print_r($_POST);
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
			$this->form_validation->set_rules('bank_domain', 'Bank Url', 'trim|required|valid_url');
			$this->form_validation->set_message('valid_url', 'The {field} field must contain a valid URL like (https://example.com).');
			$this->form_validation->set_rules('bank_branch', 'Bank Branch', 'trim|required');
			
				
				
				if ($this->form_validation->run() == FALSE) {
					$data['pageTitle'] = 'Add Bank';
					$data['view'] = 'admin/banks/bank_add';
					$this->load->view('admin/layout', $data);
				}
				else{	

			$file_name = '';
			if(isset($_FILES['bank_logo']) && !empty($_FILES['bank_logo']['name'])) {
					$path= FCPATH.'uploads/banks';
					$upload= $this->do_upload('bank_logo',$path);
					if(isset($upload['upload_data'])){
						$file_name = $upload['upload_data']['file_name'];
						}
					};	 
				
				 $data = array(
						'bank_name' => $this->input->post('bank_name'),
						'bank_domain' => $this->input->post('bank_domain'),
						'bank_branch' => $this->input->post('bank_branch'),
						'created_at' => date('Y-m-d H:i:s')
						);
				
			//print_r($data);die;
            $res = $this->BankModel->Insert($data);
			 if ($res) {
				
				$this->session->set_flashdata('msg', 'Record inserted Successfully!');
				 redirect(base_url('admin/banks'));
				
            }else{
				$this->session->set_flashdata('msg', 'Error in your data!');
				redirect(base_url('admin/banks'));
			}
      
           }

        }
		$data['pageTitle'] = 'Add bank';
        $data['view'] = 'admin/banks/bank_add';
		$this->load->view('admin/layout', $data);	

		}	

		
	public function detail($id){
			
			$data=array();
			$data['pageTitle']= "bank Detail";
			/* $criteria['field'] = 'users.*,project.name,project.location,project.document,project.bank';
			$criteria['join'] = array(
				array('project','users.d_workshop_assign=project.id','left'),
			);
			$criteria['conditions'] = array('users.id'=>$id);
			$criteria['returnType'] = 'single';
			$data['bankDetail'] =  $this->BankModel->search($criteria); */
			
			$criteria['field'] = 'users.*';
			$criteria['conditions'] = array('bank.bank_id'=>$id);
			$criteria['returnType'] = 'single';
			$data['bankDetail'] =  $this->BankModel->search($criteria); 
			echo $this->load->view('admin/banks/bank_detail',$data,true);
			
		  }
					
		public function del($id = null){
			if(!$id){
				redirect('admin/banks');
			}
			$this->BankModel->delete(array('bank_id' => $id));
			$this->session->set_flashdata('msg', 'Record deleted Successfully!');
			redirect(base_url('admin/banks'));
		}

	}


?>