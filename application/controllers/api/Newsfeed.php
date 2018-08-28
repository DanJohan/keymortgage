<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsfeed extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('NewsfeedModel');
	}

	public function getNewsfeed(){
		$this->form_validation->set_rules('user_id','User id','trim|required');
		if ($this->form_validation->run() == true){
			$user_id = $this->input->post('user_id');
			$criteria['conditions'] = array('user_id'=>$user_id);
			$criteria['order_by'] = array(array('id','DESC'));
			$news_feeds = $this->NewsfeedModel->search($criteria);
			if(!empty($news_feeds)){
				foreach ($news_feeds as $index => &$news_feed) {
		            $news_feed['image']=($news_feed['image'] == '')?'':base_url().'uploads/admin/'.$news_feed['image'];
		        }
				$response= array('status'=>true,'message'=>'Record found successfully','data'=>$news_feeds);
			}else{
				$response = array('status'=>false,'message'=>'No detail found!');
			}

		}else{
			$errors = $this->form_validation->error_array();
			$response = array('status'=>false,'message'=>$errors);
		}

		$this->renderJson($response);
	}



}

?>	