<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class StaffEnquiry extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->helper('api');
		    $this->load->model('StaffEnquiryModel');

		}
 
	public function getStaffEnquiries()
	{
     	$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
     	if ($this->form_validation->run() == true){
     		$user_id = $this->input->post('user_id');
     		$criteria['conditions'] = array('user_id'=>$user_id);
     		$enquiries = $this->StaffEnquiryModel->search($criteria);
     		//dd($enquiries);
     		if(!empty($enquiries)){
     			foreach ($enquiries as $index => &$enquiry) {
     				$new_images = array();
     				$images = json_decode($enquiry['document_image']);
     				//dd($images,false);
     				if(!empty($images)) {
	     				foreach ($images as $i => $image) {
	     					$new_images[$i]= base_url().'uploads/admin/'.$image;
	     				}
     					$enquiry['document_image']= $new_images;
     				}
     			}
     			$response = array('status'=>true,'message'=>'Record fetched successfully!','data'=>$enquiries);
     		}else{
     			$response = array('status'=>false,'message'=>'No detail found!');
     		}
     	}else{
     		$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
     	}
     	$this->renderJson($response);
	}

     public function updateEnquiryStatus(){
          $this->form_validation->set_rules('enquiry_id', 'enquiry_id', 'trim|required');
          $this->form_validation->set_rules('status','Status','trim|required');
          if ($this->form_validation->run() == true){
               $enquiry_id = $this->input->post('enquiry_id');
               $status = $this->input->post('status');
               $this->StaffEnquiryModel->update(array('status'=>$status),array('id'=>$enquiry_id));
               $response = array('status'=>true,'message'=>'Record updated successfully!');
          }else{
              $errors = $this->form_validation->error_array();
               $response = array('status'=>false,'message'=>$errors); 
          }

          $this->renderJson($response);
     }

}
?>




