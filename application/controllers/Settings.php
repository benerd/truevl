<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {


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
		$sql="select * from privacy where user_id=$userId";
		$pdata=$this->db->query($sql)->result();

		$get_blocked=$this->User_model->get_blocked($userId);


		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view("settings",array("privacy_data"=>$pdata, "get_blocked"=>$get_blocked));
		// $this->load->view("includes/footer");

	}

	public function update_name()
	{
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$email=$this->session->userdata('email');
		$nm=$_POST["nm"];
		$sql="update users set name='$nm' where email='$email'";
		$x=$this->db->query($sql);
		if($x){
			echo 1;
		}

	}

	public function update_work()
	{
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$email=$this->session->userdata('email');
		$nm=$_POST["nm"];
		$sql="update users set work='$nm' where email='$email'";
		$x=$this->db->query($sql);
		if($x){
			echo 1;
		}

	}


		public function update_web()
	{
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$email=$this->session->userdata('email');
		$nm=$_POST["nm"];
		$sql="update users set website='$nm' where email='$email'";
		$x=$this->db->query($sql);
		if($x){
			echo 1;
		}

	}

	public function update_bday()
	{
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$email=$this->session->userdata('email');
		$nm=$_POST["nm"];
		$sql="update users set dob='$nm' where email='$email'";
		$x=$this->db->query($sql);
		if($x){
			echo 1;
		}

	}


	public function update_add()
	{
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$email=$this->session->userdata('email');
		$nm=$_POST["nm"];
		$sql="update users set address='$nm' where email='$email'";
		$x=$this->db->query($sql);
		if($x){
			echo 1;
		}

	}

	public function update_mob()
	{
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$email=$this->session->userdata('email');
		$nm=$_POST["nm"];
		$sql="update users set mobile='$nm' where email='$email'";
		$x=$this->db->query($sql);
		if($x){
			echo 1;
		}

	}

	public function update_pas()
	{
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$cpass=md5($_POST["cpass"]);
		$pass=md5($_POST["pass"]);
	
		$email=$this->session->userdata('email');
		$sql="select * from users where password='$cpass' and email='$email' ";
		if($this->db->query($sql)->num_rows()==1)
		{


		$nm=$_POST["nm"];
		$sql="update users set password='$pass' where email='$email'";
		$x=$this->db->query($sql);
			if($x){
				echo 1;
			}
		}

		else{
			echo 0;
		}



	}

	function linkup_up($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set link_up=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}


	function promoting($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set promoting=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}

	function phone_show($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set phone_show=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}

	function add_show($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set add_show=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}

	function bday_show($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set bday_show=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}


	function work_show($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set work_show=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}


	function suggest($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set suggestion=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}

	function email_show($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set email_show	=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;

 
	}

	function promo_show($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set promo_show=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;
	}

		function links_show($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set links_show=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;
	}

	function true_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set true_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}

	function link_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set link_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}


	function buy_sell_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set buy_sell_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}


	function comment_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set comment_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;
	}

	function vote_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set vote_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}

	function spin_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set spin_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}

	function all_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set spin_noti=$d,vote_noti=$d,comment_noti=$d,true_noti=$d,link_noti=$d,buy_sell_noti=$d,all_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}


function post_noti($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set content_post_noti=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}




function link_updates($d){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$sql="UPDATE privacy set link_updates=$d where user_id=$userId";
		$this->db->query($sql);
		echo 1;


	}


	function Deactivate(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		$d=$this->User_model->Deactivate($userId);
		if($d){
			redirect('users/logout');	
		}
	}


	function report_admin(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

			

		$data=array( 
				"post_by"=>$_POST["uid"],
				"report_by"=>$userId,
				"post_id"=>$_POST["pid"],
				"type"=>$_POST["opt"],
				"action"=>$_POST["action"]
				);
		$msg=$_POST["msg"];
		$ins=$this->User_model->report_admin($data, $msg);
		
		if($ins){
			echo $ins;
		}

	}

	function disconnect($fid){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$dis=$this->User_model->disconnect($fid, $userId);


		if($dis){
			echo 1;
		}
	}

	function block($fid){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$dis=$this->User_model->block($fid, $userId);
		

		if($dis){
			echo 1;
		}
	}

	function message_author(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

			

		$data=array( 
				
				"sender_id"=>$userId,
				"post_id"=>$_POST["pid"],
				"msg"=>$_POST["msg"],
				"time"=>date("Y-m-d H:i:s"),
				"action"=>$_POST["action"],
				"view"=>0,
				"to_id"=>$_POST["uid"]
				);
		
		$ins=$this->User_model->message_author($data);
		
		if($ins){
			echo $ins;
		}

	}


	public function unblock($id){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$x=$this->User_model->unblock($userId, $id);

		if($x)
			echo 1;

	}

	public function copyright($pid){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		
		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view("copyright_issue", array("pid"=>$pid));

	}

	public function copyrights_claim(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$data=$_POST;
		$data["claimed_by"]=$userId;
		$data["copyright_doc"]=$_FILES["copyright_doc"]["name"];
		
		

		if($data["content_appear"]==2){
			if(isset($_FILES["screenshot"]["name"])){
				$data["screenshot"]=$_FILES["screenshot"]["name"];
			}

			if($data["screenshot"]=""){
				$data["screenshot"]=NULL;
			}

			if($data["start_time"]=="")
				$data["start_time"]=NULL;
			if($data["end_time"]=="")
				$data["end_time"]=NULL;

		}
		echo 1;
		$this->User_model->copyrights_claim($data);

	}


		public function sendOtp(){
			if(!$this->session->userdata('email')){
				$this->session->set_flashdata('err', 'please login first');
				redirect("/");
			}
			$email=$this->session->userdata('email');
			$nm=$_POST["nm"];
			$r=rand(100000,999999);
			$message="Welcome to truevl.Your OTP is ".$r;
			$message=urlencode($message);
			$this->session->set_tempdata('otp', $r,600);

			$response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=$nm&smsContentType=english");

			if($response){
				echo 1;
			}
		}


}


