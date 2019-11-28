<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model('User_model');
	}
	public function index()
	{
		if($this->session->userdata('email')){
			redirect("Feeds");
		}
		$trending=$this->User_model->getTrending();
		$getAll=$this->User_model->getAllPost();	
		$userdata=array();
		foreach ($trending as $key => $value) {
				 	$userId=$value["user_id"];
				 	$z=$this->User_model->getUdata($userId);
				 	array_push($userdata, $z);

				 }
		$userdata1=array();
		foreach ($getAll as $key => $value) {
		 	$userId=$value["user_id"];
		 	$z=$this->User_model->getUdata($userId);
		 	array_push($userdata1, $z);

		 }
		$this->load->view('home_page',array("trending"=>$trending, "getAll"=>$getAll, "udata"=>$userdata,"udata1"=>$userdata1, "getAll"=>$getAll,));
	}

	public function feedback(){
		$this->load->view("feedback");
	}

	public function insertFeedback()
	{
		$data=$_POST;
		$this->do_upload($_FILES);
		$data["attachment"]="../uploads/feedback/".$_FILES["attachment"]["name"];
		$this->User_model->insertFeedback($data);
		echo 1;
	}


	function do_upload($data){

	$target_dir = "../uploads/feedback/";
	$target_file = $target_dir . basename($data["attachment"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($data["attachment"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($data["attachment"]["size"] > 50000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($data["attachment"]["tmp_name"], $target_file)) {
	        //echo "The file ". basename( $data["attachment"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

	}

	function Help(){
		$this->load->view("help");
	}

	function Terms(){
		$this->load->view("Terms");	
	}

	function Cookies(){
		$this->load->view("Cookies");	
	}

	function Privacy(){
			
		$this->load->view("Privacy");	
	}

	

	

}
