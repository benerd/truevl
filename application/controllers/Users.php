<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use google\appengine\api\cloud_storage\CloudStorageTools;
  
class Users extends CI_Controller {
	
	public function __construct()  
	{ 
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Feed_model');
	}	
	public function index() 
	{
		$this->signup();	
	}

	public function signup(){
		$this->load->view('register');
	}
  
	public function check_email()
	{
		$email=$_POST["user_email"];

	    $x=$this->User_model->check_mail($email);
		
		if($x)
		{
			echo 1;
		}
		else{
			echo 0;
		}
	}
	function check_mob()
	{
		$mob=$_POST["user_mob"];

		$x=$this->User_model->check_mobi($mob);
		
		if($x)
		{
			echo 1;
		}
		else{
			echo 0;
		}
	}

	 public function user_registration()
	{
		$d=$_POST["d"];
		$m=$_POST["m"];
		$y=$_POST["y"];
		$dob=$y."-".$m."-".$d;
		$this->form_validation->set_rules('name', 'Username', 'required');
		// $this->form_validation->set_rules('dob', 'dob', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpass', 'Password Confirmation', 'trim|required|matches[pass]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array(
                'required'      => '%s is mandatory.',
                'is_unique'     => 'This %s already exists.'
        ));
		$r=mt_rand(100000, 999999);
		$this->form_validation->set_rules('mob', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]|is_unique[users.mobile]', array(
                'required'      => '%s is mandatory.',
                'is_unique'     => 'This %s already exists.'
        ));
		
		if ($this->form_validation->run() == TRUE)
        {
       	
			$data=array(
				'email' => $_POST["email"], 
				'password' => md5($_POST["pass"]), 
				'name' => $_POST["name"], 
				'gender' => $_POST["Gender"], 
				'mobile' => $_POST["mob"], 
				'dob' =>  $dob, 
				'country'=> $_POST["con"],
				'state'=>$_POST["st"],
				'address'=>$_POST["loc"],
				'otp'=> $r,
				'profile_pic'=>'assets/img/default-user.jpg',  
				'cover_pic'=>'assets/img/default-background-cover.jpg',
				'cover_repos'=>'assets/img/default-background-cover.jpg',
				"joining_date"=>date("Y-m-d"),
				'status'=>0,
				'active'=>0
				);

			$mob=$data["mobile"];
			$link="http://testing.truevl.com/Users/verify/".$data["email"];
			$mail="Thank you for registeration on truevl. Please click the link below to verify your email

			".$link;
			$message="Welcome to truevl.Your OTP is ".$data["otp"];
			$message=urlencode($message);
			$x=$this->User_model->insert_user($data);
			if($x)
			{

			$privcy=$this->User_model->set_privacy($x);
			$this->session->set_userdata('temp_email', $data["email"]);
			$this->session->set_userdata('temp_mobile', $data["mobile"]);
			$this->session->set_tempdata('otp', $r,600);
			$response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=$mob&smsContentType=english");
				//echo $response;
				redirect('Users/get_otp'); 
		}
		}
		else{
			 $this->load->view('register');
			
			
		}
	}
	

	function resendOtp(){
		if(!$this->session->userdata('temp_email') && !$this->session->userdata('mobile')){
			redirect("/");
		}
		$r=mt_rand(100000,999999);
		$this->session->set_tempdata('otp', $r,600);
		$mob=$this->session->userdata('mobile');
		$message="Welcome to truevl.Your OTP is ".$r;
		$message=urlencode($message);
		$response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=$mob&smsContentType=english");
			
		echo $r;
	}
	

	function get_otp()
	{
		if(!$this->session->userdata('temp_email') && !$this->session->userdata('mobile')){   
			redirect("/");
		}                         
		if($this->session->userdata('temp_email')){
			$check=1;
			$this->load->view('otp.php',array("check"=>$check));
		}
		if($this->session->userdata('mobile')){
			$check=2;
			$this->load->view('otp.php',array("check"=>$check));
		}

	}

	function verify_otp($check) 
	{
		if(!$this->session->userdata('temp_email') && !$this->session->userdata('mobile') && !$this->session->userdata('email') ){
			redirect("/");
		}
		$x=0;
		$otp=$_POST["otp"];
		if($this->session->tempdata("otp")){	

		
			if($otp==$this->session->tempdata("otp")){
			if($check==1)
			{
				$x=$this->User_model->ver_otp($this->session->userdata('temp_email'), $check);
			}	
			else if($check==3)
			{
				$x=$this->User_model->ver_otp($this->session->userdata('email'), $check);
			}
			else{
			$x=$this->User_model->verotp($this->session->userdata('mobile') );
			}

			}

			if($x==1)
		{
			if($check==3){
				echo "ok";
			}
			else{
			$y=$this->User_model->getUserID($this->session->userdata('temp_email'));
			$userId=$y->id;			
			$privcy=$this->User_model->set_privacy($x);			
			$this->session->set_flashdata('msg', 'Your OTP has been verified. Please Login.');
			redirect("Users/stepOne");
			}
		}
		else if($x==2){
			$this->load->view("password_form");
		}
		else{
			if($check==3){
				echo "nope";
			}
			else{
			$this->session->set_flashdata("msg", "incorrect otp");
			redirect("Users/get_otp");
			}
		}
		}
		else{
			if($check==3){
				echo "sess";
				
			}
			else{
			$this->session->set_flashdata('msg', 'session timed out..');

			redirect("Users/get_otp");
			}
		}
		
	}


	function vv(){
		echo $_POST["otp"];
	}

	function stepOne(){
			if(!$this->session->userdata('temp_email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}	
		$x=$this->User_model->getUserData($this->session->userdata('temp_email'));
		$y=$this->User_model->getUserID($this->session->userdata('temp_email'));
		$userId=$y->id;

		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('step-one');
	}

	function stepTwo(){
			if(!$this->session->userdata('temp_email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}	
		$x=$this->User_model->getUserData($this->session->userdata('temp_email'));
		$y=$this->User_model->getUserID($this->session->userdata('temp_email'));
		$userId=$y->id;

		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('step-two');
	}

	function stepThree(){
		
		if(!$this->session->userdata('temp_email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}	

		$x=$this->User_model->getUserData($this->session->userdata('temp_email'));
		$y=$this->User_model->getUserID($this->session->userdata('temp_email'));
		$userId=$y->id;
		// $cat=$x[0]->interest;
		$city=$x[0]->city;
		$suggests=$this->User_model->getLinkups($city, $userId);

		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('step-three', array("suggests"=>$suggests));
	}

	


	function interests(){
		if(!$this->session->userdata('temp_email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}	
		$data= json_encode($_POST);

		$x=$this->User_model->updateIntrests($data,$this->session->userdata('temp_email'));
		if($x){
			echo 1;
		}
	}

	public function addFriend($uid, $fid){
		if(!$this->session->userdata('temp_email') && !$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$pdata=$this->User_model->privacyData($fid);
		$link_upSent=$this->User_model->link_upSent($uid);
		if($pdata->link_up==0){
				echo 0;
		}
		else{
			if($link_upSent<=15){
		    $y=$this->User_model->addFriend($uid, $fid);
				if($y)
				{	echo $y;
 
				}
			}
			else{
				echo 9;
			}
		}
	}

	function step3C(){
		if(!$this->session->userdata('temp_email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$this->session->set_userdata("email",$this->session->userdata('temp_email'));
		$this->session->unset_userdata('temp_email');
		redirect('Feeds');
	}

	function login_page(){
		$this->load->view("login.php");
	}
 
	function login(){

		$email=$this->input->post('email');
		$pass=md5($this->input->post('pass'));
		$row=$this->User_model->check_login($email, $pass);		
		if($row==1)
		{
			$data=$this->User_model->getUserData($email);
			$user_id=$data[0]->id;		
			$this->session->set_userdata('email', $email);
			$this->session->set_userdata('user_id', $user_id);
			$allUsers=$this->session->all_userdata();
			$allUsers["status"]=1;
			
			unset($allUsers["__ci_last_regenerate"]);
			unset($allUsers["temp_mobile"]);
			unset($allUsers["mobile"]);
			unset($allUsers["temp_email"]);
			if($this->session->userdata("adminId")){
				unset($allUsers["adminId"]);
			}
			$this->User_model->sessions($allUsers);

			
			redirect('Feeds');
		}

		else if($row==2){
			$this->session->set_flashdata('err', 1);
			redirect("Users/login_page");
		}
		else
		{  
			$this->session->set_flashdata('err', 'Wrong username or password');
			redirect("Users/login_page");
		}
	}

	public function forgot_password(){
		$this->load->view('includes/header');
		$this->load->view('forgot');
		
	}

	public function forgot(){
		
		$mn=$_POST["mn"];
		$otp=mt_rand(100000, 999999);
		$message="Your OTP is ".$otp;

		$message=urlencode($message);
		$check=$this->User_model->check_mobile($mn);
		$this->session->set_tempdata("otp", $otp, 600);
		if($check==1){
			$sql="update users set otp=$otp where mobile='$mn'";
			$this->db->query($sql);
		$response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=$mn&smsContentType=english");
		echo $response;
	
			$obj = json_decode($response);
			if($obj->{'responseCode'} ==3001){
				// $this->session->set_userdata("temp_mobile", $mn);
				$this->session->set_userdata("mobile", $mn);
				// echo $this->session->userdata("mobile");
				redirect('Users/get_otp/');
			}
		}
		else{
			$this->session->set_flashdata("er", "please enter your registered mobile number");
			redirect('Users/forgot_password/');
		}

	}

	public function update_password(){
			if(!$this->session->userdata('mobile') ){
			$this->session->set_flashdata('err', 'please login first');
			// redirect("/");
		}
		$mob=$this->session->userdata('mobile');
		$pass=md5($_POST["pass"]);
		$u=$this->User_model->update_password($pass,$mob);
		if($u){
			$this->session->unset_userdata('mobile');
			$this->session->set_flashdata("pmsg", "Please Login to continue");
			redirect("Users/login_page");
		}
	}


	public function verify($email){
               $sql="update users set email_ver=1 where email='$email'";
               $qry=$this->db->query($sql);
               if($qry){
                 $this->session->set_flashdata('msg', 'Your email has been successfully verified');
                 redirect("Users/login_page");
			}
	}

	function profile(){ 
		if(!$this->session->userdata('email') && $this->session->userdata('user_id') ){
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
     	$z=$this->Feed_model->getPostData($userId);
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$unm=str_replace(" ", "-", $x[0]->name);
		redirect("user/".$x[0]->otp.$userId.'/'.$unm);
	}

	public function user($rand, $unm){
		if(!$this->session->userdata('email') ){
			redirect("/");
		}

		if(!$rand){
			redirect("/");

		}

		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
     	$z=$this->Feed_model->getPostData($userId);
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$get_activity=$this->User_model->get_activity($userId);
		$get_links=$this->User_model->get_links($userId);
		
		$activityCount=$this->User_model->activityCount($userId);
		$commentsCount=$this->User_model->commentsCount($userId);
		$linksCount=$this->User_model->linksCount($userId); 
		$getCurrentComment=$this->User_model->getCurrentComment($userId);
		$promoCount=$this->User_model->totalUserPromo($userId);


		// if($x[0]->profile_pic=='assets/img/default-user.jpg'){
		// 	$image_url=base_url().$x[0]->profile_pic; 
		// }
		// else{
		// $bucket = CloudStorageTools::getDefaultGoogleStorageBucketName();
		
  //  		// $target_dir ='gs://' . $bucket . '/profilePics/';
  //       $options = ['size'=> 400, 'crop' => false];
  //       $image_file = $x[0]->profile_pic;
  //       // echo $image_file;
  //        $image_url = CloudStorageTools::getImageServingUrl($image_file, ['secure_url' => true]);
  //   	}
        // echo $image_url; 
		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId, 'postData'=>$z, "activityCount"=>$activityCount, "commentsCount"=>$commentsCount, "linksCount"=>$linksCount));
	
		$this->load->view('profile', array("auth"=>0, "get_activity"=>$get_activity, "get_links"=>$get_links, "getCurrentComment"=>$getCurrentComment, "promoCount"=>$promoCount, "rand"=>$rand, "unm"=>$unm));
		$this->load->view('includes/footer');
	}

		public function cover_pic(){
	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$email=$this->session->userdata('email');
		$bucket = CloudStorageTools::getDefaultGoogleStorageBucketName();
		$path = 'gs://' . $bucket . '/coverPics/';
		$valid_formats = array(".jpg", ".png", ".gif", ".bmp", ".JPG", ".PNG", ".GIF", ".BMP"); // set formate
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{

		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		if(strlen($name))
		{
		$fileExt = substr(strrchr($name, '.'), 0);
		if(in_array($fileExt,$valid_formats))
		{
		if($size<(5120*5120))
		{

		  $ext = pathinfo($name, PATHINFO_EXTENSION);
		   if ($ext == 'jpeg')
		    	$actual_image_name = time().substr(str_replace(" ", "_", $name), 5);
		   elseif ($ext== 'gif')
		        $actual_image_name = time().substr(str_replace(" ", "_", $name), 5);
		   elseif ($ext == 'png')
		        $actual_image_name = time().substr(str_replace(" ", "_", $name), 5); 
		   else
		   		$actual_image_name = time().substr(str_replace(" ", "_", $name), 5); 
		$tmp = $_FILES['photoimg']['tmp_name'];
		if(move_uploaded_file($tmp, $path.$actual_image_name))
		{

		// $file=base_url()."coverPics/".$actual_image_name;
		$options = ['crop' => false];
		$f=$path.$actual_image_name;
		$image_url = CloudStorageTools::getImageServingUrl($f, $options);
		
		$this->session->set_userdata("cover", $f);
		$qry="update users set cover_pic='$image_url' where email='$email' ";
		                       if($this->db->query($qry)){
		                       		$q="select * from users  where email='$email'";
		                       		if($this->db->query($q)){
		                  	     			$x=$this->db->query($q)->result_array();
		                       		}
		                       }

                     

                       foreach ($x as $key => $value) {
                      	  $cover_pic=$value["cover_pic"];
                       }
                       $res["pic"]=$cover_pic;
                       $res["status"]=200;

                       echo json_encode($res);;
					}
				}	
        		}
			}
		}
	}

	function loadBuyer($f){
			if(!$this->session->userdata('email')){
				$this->session->set_flashdata('err', 'please login first');
				redirect("/");
			}
		
	$x=$this->User_model->getUserData($this->session->userdata('email'));
	$y=$this->User_model->getUserID($this->session->userdata('email'));
	$no = $_POST['getresult'];
	$y=$this->User_model->getUserID($this->session->userdata('email'));
	$userId=$y->id;
	if($f==0){
		$userId=$y->id;
	}
	else{
		$userId=$f;
	}
	$frnds=$this->User_model->Friends($userId, $no);
	$data=array();
	$buyerNumber=array();
	for($i=0; $i<count($frnds); $i++)
	{
		$frid=$frnds[$i]['friend_id'];
		$query1="select * from friends where friend_id=$frid ";
		$ff=$this->db->query($query1)->result_array();
			if($userId==$ff[0]["uid_1"]){
		      	array_push($data, $ff[0]["uid_2"]);
		      	$myfid=$ff[0]["uid_2"];
				$q="select * from friends where (uid_1=$myfid or uid_2=$myfid) and status=1 ";
		      	$n= $this->db->query($q)->num_rows($q);
		      	array_push($buyerNumber, $n);
		}
		if($userId==$ff[0]["uid_2"]){
		    array_push($data, $ff[0]["uid_1"]);
		    $myfid=$ff[0]["uid_1"];
		    $q="select * from friends where (uid_1=$myfid or uid_2=$myfid) and status=1 ";
		    $n= $this->db->query($q)->num_rows($q);
		    array_push($buyerNumber, $n);
		}  
		}	

		if(isset($ff)){

		for($i=0; $i< count($data); $i++){
			$uid=$data[$i];
			$query="select * from users where id=$uid ";
			if($this->db->query($query)){
				
			$usr['con'][]=$this->db->query($query)->result_array();
			}
		}
		}

		else{
				$usr=NULL;
			}

		$view=$this->load->view("loadmoreBuyer", array('usr'=>$usr['con'], 'buyers'=>$buyerNumber, "userId"=>$userId));

		echo json_encode($view);
	}
		
	public function tv_user($rand, $unm){
		$rand= (string)$rand;
		$id=substr($rand,6);
		$authData=$this->User_model->authorData($id);
		if($this->session->userdata("email")){
			if($authData[0]["email"]==$this->session->userdata("email")){
				redirect("Users/profile");
			}
			else{
				$email=$authData[0]["email"];
			}
		$y=$this->User_model->getUserID($this->session->userdata("email"));
		$userId=$y->id;	
	
		$x=$this->User_model->getUserData($this->session->userdata("email"));
		}
		
		else{
			$email=$authData[0]["email"];
			$userId=NULL;
			$check=NULL;
			$check_blocked=NULL;
			$x=NULL;
		}
		
		$post_by_user=array();
		$auth=$this->User_model->getUserID($email);
		$authId=$auth->id;
		$sql="select * from privacy where user_id=$authId";
		$pdata=$this->db->query($sql)->result();
		$z=$this->Feed_model->getPostData($authId);
		
		$authuser=$this->User_model->getUserData($email);
		$frnds=$this->User_model->Friends($authId,0);
		$data=array();
		$buyerNumber=array();
		for($i=0; $i<count($frnds); $i++)
		{
			$frid=$frnds[$i]['friend_id'];
			$query1="select * from friends where friend_id=$frid ";
		    $ff=$this->db->query($query1)->result_array();
		     	 if($authId==$ff[0]["uid_1"]){
		      		array_push($data, $ff[0]["uid_2"]);
		      		$myfid=$ff[0]["uid_2"];		      	
		      		$q="select * from friends where (uid_1=$myfid or uid_2=$myfid) and status=1 ";
		      		$n= $this->db->query($q)->num_rows($q);
		      	    // echo $n;
		      	    array_push($buyerNumber, $n);
		      	    // print_r($buyerNumber);

		      }
		     	 if($authId==$ff[0]["uid_2"]){
		      		array_push($data, $ff[0]["uid_1"]);
		      		$myfid=$ff[0]["uid_1"];
		      		$q="select * from friends where (uid_1=$myfid or uid_2=$myfid) and status=1 ";
		      		$n= $this->db->query($q)->num_rows($q);
		      	    // echo $n;
		      	    array_push($buyerNumber, $n);
		      }
		     

		   
		}

		if(isset($ff)){

		for($i=0; $i< count($data); $i++){
			$uid=$data[$i];
			$query="select * from users where id=$uid ";
			if($this->db->query($query)){
				
			$usr['con'][]=$this->db->query($query)->result_array();
			}
		

		}
	}

		else{
				$usr=NULL;
			}
  
	
		$get_activity=$this->User_model->get_activity($authId);
		$activityCount=$this->User_model->activityCount($authId);
		$get_links=$this->User_model->get_links($authId);
		$check=$this->User_model->check_friends($userId, $authId);
		$commentsCount=$this->User_model->commentsCount($authId);
		$getCurrentComment=$this->User_model->getCurrentComment($authId);
		$check_blocked=$this->User_model->check_blocked($userId,$authId);
		$promoCount=$this->User_model->totalUserPromo($authId);

			$this->load->view('includes/header',array("userData"=> $x, 'userId'=>$userId, 'authId'=>$authId, 'postData'=>$z));
	
		$this->load->view('author_profile',array('authuser'=>$authuser, "auth"=>1, "pdata"=>$pdata,"get_activity"=>$get_activity, "activityCount"=>$activityCount, "get_links"=>$get_links, "check"=>$check, "linksCount"=>$get_links, "authId"=>$authId, "check_blocked"=>$check_blocked, 'usr'=>$usr['con'], 'buyers'=>$buyerNumber, "commentsCount"=>$commentsCount, "getCurrentComment"=>$getCurrentComment, "promoCount"=>$promoCount, "rand"=>$rand, "unm"=>$unm,"x"=>$x[0])); 
		$this->load->view('includes/footer');
			
	}

	function loadActivity($f){
		if($this->session->userdata('email')){
			$x=$this->User_model->getUserData($this->session->userdata('email'));
			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$check=NULL;
			if($f==0){
				$userId=$y->id;
			}
			else{
				$userId=$f;
				$check=$this->User_model->check_friends($y->id, $userId);
			}

		}
		else{
			$userId=$f;
			$x=$this->User_model->getUdata($userId);
			$check=$this->User_model->check_friends($y->id, $userId);
		}		
		$no = $_POST['getresult'];
		$z=$this->User_model->userActivity($userId,$no);
		$post_by_user=array();
		$totallikes=array();
		$likeArr=array();
		if($z){
		foreach ($z as $key => $value) {
			$pid=$value["post_id"];
			$numLikes=$this->User_model->numlikes($pid);
			array_push($totallikes, $numLikes);
			$post_user_id=$value["user_id"];	
			$likedArr=$this->Feed_model->checkLiked($pid, $userId);	
			array_push($likeArr, $likedArr);
			$qry="select otp,active,name,profile_pic from users where id=$post_user_id";
			if($this->db->query($qry)){
				$pbu=$this->db->query($qry)->result_array();
				array_push($post_by_user, $pbu);
			}
		}
		}
		else{
			$totallikes=NULL;
			$z=NULL;
		}

		$view=$this->load->view("loadmoreActivity", array("postData"=>$z, "userData"=>$x, 'numLikes'=>$totallikes, "userId"=>$userId, "post_by_user"=>$post_by_user, "x"=>$x[0], "likeArr"=>$likeArr, "check"=>$check, "uid"=>$y->id, "no"=>$no));

		echo json_encode($view);
			
	}  

	function loadPromotion($f){
		if($this->session->userdata('email')){
			$x=$this->User_model->getUserData($this->session->userdata('email'));
			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$check=NULL;
			if($f==0){
				$userId=$y->id;
			}
			else{
				$userId=$f; 
			}
		}
		else{
			$userId=$f;
			$x=$this->User_model->getUdata($userId);
			$check=$this->User_model->check_friends($userId, $authId);
		}
		$no=$_POST['getresult'];
		$z=$this->User_model->userPromo($userId,$no);
		$post_by_user=array();
		$totallikes=array(); 
		$likeArr=array();
		if(isset($z)){
		foreach ($z as $key => $value) {
			$pid=$z[$key][0]["post_id"];
			$numLikes=$this->User_model->numlikes($pid);
			array_push($totallikes, $numLikes);
			$likedArr=$this->Feed_model->checkLiked($pid, $userId);	
			array_push($likeArr, $likedArr);
			$post_user_id=$z[$key][0]["user_id"];	
			$qry="select otp, active,name,profile_pic from users where id=$post_user_id";
			if($this->db->query($qry)){
				$pbu=$this->db->query($qry)->result_array();
				array_push($post_by_user, $pbu);
			}
			}
		} 
		else{
			$totallikes=NULL;
			$z=NULL;

		}
		$view=$this->load->view("loadmorePromo", array("postData"=>$z, "userData"=>$x, 'numLikes'=>$totallikes, "userId"=>$userId, "post_by_user"=>$post_by_user, "likeArr"=>$likeArr, "x"=>$x[0], "check"=>$check, "uid"=>$y->id, "no"=>$no));
		echo json_encode($view);
	}

	function loadComments($f){
		if($this->session->userdata('email')){
			$x=$this->User_model->getUserData($this->session->userdata('email'));
			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$check=NULL;	
			if($f==0){
				$userId=$y->id;
			}
			else{
				$userId=$f;
				// $x=$this->User_model->getUdata($userId);
			}
		}
		else{
			$userId=$f;
			$x=$this->User_model->getUdata($userId);
			$check=$this->User_model->check_friends($userId, $authId);
		}
		$no = $_POST['getresult'];
		$z=$this->User_model->userStatus($userId,$no);
		$post_by_user=array();
		$totallikes=array();
		$likeArr=array();
		if($z){
		foreach ($z as $key => $value) {
			$pid=$value["post_id"];
			$numLikes=$this->User_model->numlikes($pid);
			array_push($totallikes, $numLikes);
			$post_user_id=$value["user_id"];
			$likedArr=$this->Feed_model->checkLiked($pid, $userId);	
			array_push($likeArr, $likedArr);	
			$qry="select profile_pic,otp,active,name,profile_pic from users where id=$post_user_id";
			if($this->db->query($qry)){
				$pbu=$this->db->query($qry)->result_array();
				array_push($post_by_user, $pbu);
			}
		}
		}
		else{
			$totallikes=NULL;
			$z=NULL;
		}
		$count=count($z);

		$view=$this->load->view("loadmoreStatus", array("postData"=>$z, "userData"=>$x, 'numLikes'=>$totallikes, "userId"=>$userId, "post_by_user"=>$post_by_user, "count"=>$count, "likeArr"=>$likeArr,"x"=>$x[0], "check"=>$check, "uid"=>$y->id, "no"=>$no));
		echo json_encode($view);
	}

	public function friendAccept($fid, $uid,$cnfrm){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		if($cnfrm==1){
			$x=$this->User_model->friendAccept($fid, $uid);
			if($x==1){
				echo 1;
			}
		}
		else{
			echo 1;
		}
		if($cnfrm==0){
			$x=$this->User_model->friendReject($fid, $uid);
			if($x==2){
				echo 2;
			}
			
		
		}
		
	}

	 public function logout(){
		if(!$this->session->userdata('email')){
			redirect("/");
		}

		$this->User_model->updateSessions($this->session->userdata('email'));

		$this->session->unset_userdata('email');

			redirect('/');
		
	}	

	function getOnlineUsers($f){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$luser=array();
		$ofuser=array();
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		$frnds=$this->User_model->Friends($userId, 0);	
	    $data=array();
	    $buyerNumber=array();
	   	
	   foreach ($frnds as $key => $value) {
	   		if($userId==$value["uid_1"]){
	   		  array_push($data, $value["uid_2"]);
	   		}
	   		if($userId==$value["uid_2"]){
              array_push($data, $value["uid_1"]);
          }  
	   }
	   
	   $currentTime=$this->User_model->currentTime();
	   $getOnlineUsers=$this->User_model->getOnlineUsers($currentTime);

	 	foreach ($getOnlineUsers as $key => $value) {
	 		if (in_array($value, $data)){
	 			array_push($luser, $value);
	 			if (($key = array_search($value, $data)) !== false) {
    			unset($data[$key]);
				}
	 		}
	 	}



	   $view=$this->load->view("chatList", array("luser"=>$luser, "ofuser"=>$data, "userId"=>$userId,"f"=>$f));

	}

	function Activities($rand,$unm){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$rand= (string)$rand;
		$f=$rand[strlen($rand)-1];
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		
		if($f==$userId){
		
		$get_activity=$this->User_model->get_activity($userId);
		$get_links=$this->User_model->get_links($userId);
		$z=$this->Feed_model->getPostData($userId);
		$getCurrentComment=$this->User_model->getCurrentComment($userId);
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('Activities', array("get_activity"=>$get_activity, "get_links"=>$get_links, "f"=>$f, "postData"=>$z,  "getCurrentComment"=>$getCurrentComment));
		}
		else{
			$f1=1;
			$authData=$this->User_model->authorData($f);
			if($this->session->userdata("email")){
			if($authData[0]["email"]==$this->session->userdata("email")){
				redirect("Users/profile");
			}
			else{
				$email=$authData[0]["email"];
			}
		}
		else{
			$email=$authData[0]["email"];
		}
		$authuser=$this->User_model->getUserData($email);
		$authId=$f;
		$check=$this->User_model->check_friends($userId, $authId);
		$get_activity=$this->User_model->get_activity($authId);
		$activityCount=$this->User_model->activityCount($authId);
		$get_links=$this->User_model->get_links($authId);
		$check_blocked=$this->User_model->check_blocked($userId,$authId);
		$sql="select * from privacy where user_id=$authId";
		$pdata=$this->db->query($sql)->result();
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId, 'authId'=>$authId));
		$this->load->view('Activities', array('authuser'=>$authuser,"get_activity"=>$get_activity, "get_links"=>$get_links, "check"=>$check, "f"=>$f, "authId"=>$authId, "check_blocked"=>$check_blocked, "pdata"=>$pdata,"f1"=>$f1));
			
		}
	}

	function comments($rand, $unm){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$rand= (string)$rand;
		$f=$rand[strlen($rand)-1];
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		if($f==$userId){
		$get_activity=$this->User_model->get_activity($userId);
		$get_links=$this->User_model->get_links($userId);
		$z=$this->Feed_model->getPostData($userId);
		$getCurrentComment=$this->User_model->getCurrentComment($userId);
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('comments', array("get_activity"=>$get_activity, "get_links"=>$get_links, "f"=>$f,  "postData"=>$z,  "getCurrentComment"=>$getCurrentComment));
		}
		else{
			$f1=1;
			$authData=$this->User_model->authorData($f);
			if($this->session->userdata("email")){
			if($authData[0]["email"]==$this->session->userdata("email")){
				redirect("Users/profile");
			}
			else{
				$email=$authData[0]["email"];
			}
		}

		else{
			$email=$authData[0]["email"];
		}
		$authuser=$this->User_model->getUserData($email);
		$authId=$f;
		$check=$this->User_model->check_friends($userId, $authId);
		$get_activity=$this->User_model->get_activity($authId);
		$activityCount=$this->User_model->activityCount($authId);
		$get_links=$this->User_model->get_links($authId);
		$check_blocked=$this->User_model->check_blocked($userId,$authId);
		$sql="select * from privacy where user_id=$authId";
		$pdata=$this->db->query($sql)->result();
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('comments', array('authuser'=>$authuser,"get_activity"=>$get_activity, "get_links"=>$get_links, "check"=>$check, "f"=>$f, "authId"=>$authId, "check_blocked"=>$check_blocked, "pdata"=>$pdata, "f1"=>$f1));
		
		}
	}

	function Links(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$get_activity=$this->User_model->get_activity($userId);
		$get_links=$this->User_model->get_links($userId);
		$z=$this->Feed_model->getPostData($userId);
		$getCurrentComment=$this->User_model->getCurrentComment($userId);
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('Links', array("get_activity"=>$get_activity, "get_links"=>$get_links, "postData"=>$z, "getCurrentComment"=>$getCurrentComment));
	}

	function PromotedPosts($rand, $unm){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$rand= (string)$rand;
		$f=$rand[strlen($rand)-1];
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		if($f==$userId){
		$get_activity=$this->User_model->get_activity($userId);
		$get_links=$this->User_model->get_links($userId);
		$z=$this->Feed_model->getPostData($userId);
		$getCurrentComment=$this->User_model->getCurrentComment($userId);
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('PromotedPosts', array("get_activity"=>$get_activity, "get_links"=>$get_links, "postData"=>$z, "f"=>$f, "getCurrentComment"=>$getCurrentComment));
		}
		else{
			$f1=1;
		$authData=$this->User_model->authorData($f);
			if($this->session->userdata("email")){
			if($authData[0]["email"]==$this->session->userdata("email")){
				redirect("Users/profile");
			}
			else{
				$email=$authData[0]["email"];
			}
		}

		else{
			$email=$authData[0]["email"];
		}
		$authuser=$this->User_model->getUserData($email);
		$authId=$f;
		$check=$this->User_model->check_friends($userId, $authId);
		$get_activity=$this->User_model->get_activity($authId);
		$activityCount=$this->User_model->activityCount($authId);
		$get_links=$this->User_model->get_links($authId);
		$check_blocked=$this->User_model->check_blocked($userId,$authId);
		$sql="select * from privacy where user_id=$authId";
		$pdata=$this->db->query($sql)->result();
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('PromotedPosts', array('authuser'=>$authuser,"get_activity"=>$get_activity, "get_links"=>$get_links, "check"=>$check, "f"=>$f, "authId"=>$authId, "check_blocked"=>$check_blocked, "pdata"=>$pdata, "f1"=>$f1));

		}
	}

	function myBuyers($uid)
	{ 
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}	
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$arr=array();
		$arr1=array();
		$getBuyers=$this->User_model->getFriends($uid);
		foreach ($getBuyers as $key => $value) {
			if($value["status"]==1){
			if($value["uid_1"]==$uid){ $fid=$value["uid_2"]; }
			else{ $fid=$value["uid_1"]; } }

			$fstatus=$this->User_model->check_friends($userId, $fid);
			$udata=$this->User_model->getUdata($fid);	
			array_push($arr, $udata);
			array_push($arr1, $fstatus);
		}   
		$view=$this->load->view("myBuyers", array("udata"=>$arr, "fstatus"=>$arr1, "userId"=>$userId, "uid"=>$uid));
		echo json_encode($view);		
	}  

	function test(){
		$link_upSent=$this->User_model->link_upSent(2);

		print_r($link_upSent);
	}


	function MyLinks($uid)
	{ 
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}	
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$arr=array();
		$arr1=array();
		$getBuyers=$this->User_model->getFriends($uid);
		foreach ($getBuyers as $key => $value) {
			if($value["status"]==1){
			if($value["uid_1"]==$uid){ $fid=$value["uid_2"]; }
			else{ $fid=$value["uid_1"]; } }

			$fstatus=$this->User_model->check_friends($userId, $fid);
			$udata=$this->User_model->getUdata($fid);	
			array_push($arr, $udata);
			array_push($arr1, $fstatus);
		}   
		$this->load->view("includes/header", array("userData"=>$x, "userId"=>$userId));
		$view=$this->load->view("mylinks", array("udata"=>$arr, "fstatus"=>$arr1, "userId"=>$userId, "uid"=>$uid));
			
	}  


	// function update(){
	// 	if(!$this->session->userdata('email')){
	// 		$this->session->set_flashdata('err', 'please login first');
	// 		redirect("/");
	// 	}	
	// 	$x=$this->User_model->getUserData($this->session->userdata('email'));
	// 	$y=$this->User_model->getUserID($this->session->userdata('email'));
	// 	$userId=$y->id;

	// 	$update="update users set profile_pic='assets/img/default-user.jpg' where id=$userId";
	// 	$this->db->query($update);
	// }
	
}