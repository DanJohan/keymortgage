<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
  function __construct($config = array())
  {
    parent::__construct($config);
  }

  function error_array()
  {
    if (count($this->_error_array) === 0)
      return FALSE;
    else
      return $this->_error_array;
  }

  function valid_url($url) {

    if (filter_var($url, FILTER_VALIDATE_URL)) {
    return true;
    } else {
       return false;
    }
  }
}