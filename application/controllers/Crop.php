<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use google\appengine\api\cloud_storage\CloudStorageTools;

class Crop extends CI_Controller { 
  
 public function __construct() 
  { 
    parent::__construct();
    $avatar_src=isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null;
  $avatar_data=isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null;
  $avatar_file=isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null;
    
    // print_r($avatar_file);

    $params=array('avatar_src'=>$avatar_src, 'avatar_data'=>$avatar_data, 'avatar_file'=>$avatar_file);
   $this->load->library("CropAvatar",$params);


  } 

  public function index(){


  		$response = array(
                  'state'  => 200,
                  'message' => NULL,
                  'result' =>  "1");        
      echo json_encode($response);
 }	 
 }
?> 