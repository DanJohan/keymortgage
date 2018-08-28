<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InsertUserBankModel extends MY_Model {

	protected $table = 'users_bank_rel';

	public function __construct()
	{
	    parent::__construct();
	}

	
}