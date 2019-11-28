<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageNotfound extends CI_Controller {

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model('User_model');
	}
	public function index() 
	{
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;  
		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view("PageNotfound");
	}



}
