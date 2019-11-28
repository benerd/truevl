<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use google\appengine\api\cloud_storage\CloudStorageTools;

class CropCover extends CI_Controller {
  
 public function __construct() 
  { 
    parent::__construct();
    $this->load->library("ThumbAndCrop");
    $this->load->model('User_model');
  } 

  public function index(){

    if(!$this->session->userdata('email')){
      $this->session->set_flashdata('err', 'please login first');
      redirect("/");
    }
      $x=$this->User_model->getUserData($this->session->userdata('email'));
 $email=$this->session->userdata('email');
    foreach ($x as $key => $value) {
        $cover=$value->cover_pic;
    }
      
    if(isset($_POST['pos']))
{
$from_top = abs($_POST['pos']);
$default_cover_width = 918;
$default_cover_height = 276;
  // includo la classe
  $bucket = CloudStorageTools::getDefaultGoogleStorageBucketName();
    $path = 'gs://' . $bucket . '/coverPics/';
  $repos=$path.md5(rand()).".jpg";
 
  // valorizzo la variabile
   $tb = new ThumbAndCrop();
    
  $img=$this->session->userdata("cover");
  $tb->openImg($img); //original cover image
  
  $newHeight = $tb->getRightHeight($default_cover_width);
  
  $tb->creaThumb($default_cover_width, $newHeight);

  $tb->setThumbAsOriginal();
  
  $tb->cropThumb($default_cover_width, 276, 0, $from_top);
  
  
  $tb->saveThumb($repos); //save cropped cover image
  $options = ['crop' => false];
  $image_url = CloudStorageTools::getImageServingUrl($repos, $options);
     $qry="update users set cover_repos='$image_url' where email='$email' ";
    $this->db->query($qry);
  $tb->resetOriginal();
  
  $tb->closeImg();


$data['status'] = 200;
$data['url'] = $image_url;
$data['durl']=$cover;
echo json_encode($data);
} 
 }

 
 			
 }
?>