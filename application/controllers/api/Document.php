<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Document extends MY_Controller {

		public function __construct(){
			parent::__construct();
			 $this->load->helper('api');
			 $this->load->model('DocumentModel');

		}
 
			
		public function docUpload(){
			$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
			if ($this->form_validation->run() == true){

				$user_id = $this->input->post('user_id');

				$files_data = array();
				$file_not_uploaded = array();

				if(isset($_FILES['doc_images']) && !empty($_FILES['doc_images']['name'])){
					$filesCount = count($_FILES['doc_images']['name']);
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['doc_images']['name'][$i];
						$_FILES['file']['type']     = $_FILES['doc_images']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['doc_images']['tmp_name'][$i];
						$_FILES['file']['error']     = $_FILES['doc_images']['error'][$i];
						$_FILES['file']['size']     = $_FILES['doc_images']['size'][$i];

						$url = FCPATH.'uploads/documents/';
						$config['allowed_types']='*';
						$upload = $this->do_upload('file',$url,$config);
					   //	dd($upload,false);
						if(isset($upload['upload_data'])){
							chmod($upload['upload_data']['full_path'], 0777);
							$files_data[$i]['user_id'] = $user_id;
							$files_data[$i]['file'] = $upload['upload_data']['file_name'];
							$files_data[$i]['created_at']=date("Y-m-d H:i:s");
						}else{
							$file_not_uploaded[$i]['file'] =  $_FILES['file']['name'] ;
							$file_not_uploaded[$i]['error'] =  strip_tags($upload['error']) ;
						}
					}
				}
				if(!empty($files_data)){
					$this->DocumentModel->insert_batch($files_data);
					$documents = $this->DocumentModel->getDocumentByUserId($user_id);

					if($documents) {
						$response = array('status'=>true,'message'=>'Record inserted successfully','data'=>$documents);
					}else{
						$response = array('status'=>false,'message'=>'Somthing went wrong!');
					}
				}else{
					$response = array('status'=>false,'message'=>"No file uploaded");
				}


			}else{
				$errors = $this->form_validation->error_array();
				$response = array('status'=>false,'message'=>$errors);
			}


			$this->renderJson($response);
      
           
		}


	
	}


?>