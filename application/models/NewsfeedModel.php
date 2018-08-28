<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NewsfeedModel extends MY_Model {

	protected $table = 'newsfeeds';

	public function __construct()
	{
	    parent::__construct();
	}

}