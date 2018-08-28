<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MY_Controller {
		public function __construct(){
			parent::__construct();

			$this->load->model('UserModel');
			if (!$this->session->userdata['is_admin_login'] == TRUE)
			{
			   redirect('admin/auth/login'); //redirect to login page
			} 
		}

		public function index(){

			$data=array();
			$data['view'] = 'admin/dashboard/index2';
			$this->load->view('admin/layout', $data);
		}

	}

?>	