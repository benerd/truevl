<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model'); 
		$this->load->model('Admin_model'); 
	}


	public function index()
	{
		if($this->session->userdata("adminId")){
			redirect("Admin/dashboard");
		}
		$this->load->view('admin_login');
	}

	public function login(){

		$adminId=$_POST["id"];
		$password=$_POST["pass"];
		$check=$this->Admin_model->checkLogin($adminId, $password);
		
		if($check==1){
			$this->session->set_userdata("adminId", $adminId);
			redirect("Admin/dashboard");	
		}
		else{
			$this->session->set_flashdata("err", "Wrong username or password");
			redirect("Admin");	
		}
	}

	public function dashboard(){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		$getAllactive=$this->Admin_model->getAllactive();
		$getAllSpams=$this->Admin_model->getAllSpams();
		$getAllPosts=$this->Admin_model->getAllPosts();
		$getAllLinks=$this->Admin_model->getAllLinks();
		$getVerifiedUsers=$this->Admin_model->getVerifiedUsers();
		$getUnVerifiedUsers=$this->Admin_model->getUnVerifiedUsers();
		$AllPostData=$this->Admin_model->AllPostData(1);		
		$AllLinkData=$this->Admin_model->AllLinkData(1);
		$mostViewed=$this->Admin_model->mostViewed();
		$topPromoters=$this->Admin_model->topPromoters();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/dashboard', array("getAllactive"=>$getAllactive, "getAllSpams"=>$getAllSpams, "getAllPosts"=>$getAllPosts, "getAllLinks"=>$getAllLinks, "getVerifiedUsers"=>$getVerifiedUsers, "getUnVerifiedUsers"=>$getUnVerifiedUsers, "AllPostData"=>$AllPostData, "AllLinkData"=>$AllLinkData, "mostViewed"=>$mostViewed, "topPromoters"=>$topPromoters));

	}

	function totalPosts(){
		$tpday=$_POST["tpday"];
	}


	function spamalerts(){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		$getAllSpams=$this->Admin_model->getAllSpamsData(1);
		$getApprovedSpams=$this->Admin_model->getApprovedSpams(1);
		$getRejectedSpams=$this->Admin_model->getRejectedSpams(1);
		$blockedUser=$this->Admin_model->blockedUser();
		$this->load->view("admin/admin_header");
		$this->load->view("admin/spamalerts", array("getAllSpams"=>$getAllSpams, "getApprovedSpams"=>$getApprovedSpams, "getRejectedSpams"=>$getRejectedSpams, "blockedUser"=>$blockedUser, "f"=>1));

	}

	function approveSpam($id,$f){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		$getPostedBy=$this->Admin_model->getPostedBy($id,$f);
		$userId=$getPostedBy->post_by;
		$pid=$getPostedBy->post_id;
		if($f==1){
		$x=$this->Admin_model->approveSpam($id);
		$noti=$this->User_model->insert_notification("Admin",$userId,11,$pid);
			redirect("Admin/spamalerts");
		}
		else if($f==2){
		$x=$this->Admin_model->approveSpam($id);
		$noti=$this->User_model->insert_notification("Admin",$userId,11,$pid);
			redirect("Admin/reports");
		}
		else{
			$x=$this->Admin_model->approvePainic($id);
			$noti=$this->User_model->insert_notification("Admin",$userId,11,$pid);
			redirect("Admin/painic");
		}

	}

	function rejectSpam($id,$f){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		if($f==1){
		$x=$this->Admin_model->rejectSpam($id);
		redirect("Admin/spamalerts");
		}
		else if($f==2){
		$x=$this->Admin_model->rejectSpam($id);
		redirect("Admin/reports");
		}
		else{
		$x=$this->Admin_model->rejectPainic($id);
		redirect("Admin/painic");
		}
		
	}

	function blockUser($id,$f){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		
		if($f==4){
		$x=$this->Admin_model->blockUsser($id);
		}
		else{
		$x=$this->Admin_model->blockUser($id);
		}
		if($f==1){
			redirect("Admin/spamalerts");
		}	
		else if($f==2) {
			redirect("Admin/reports");
		}
		else if($f==3){
			redirect("Admin/painic");
		}
		else{
			redirect("Admin/users");
		}
	}
	
	function noyifyUser($id){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}

		$getPostedBy=$this->Admin_model->getPostedBy($id);
		$userId=$getPostedBy->post_by;
		$pid=$getPostedBy->post_id;
		// $userMail=$this->User_model->getUdata($getPostedBy);
		
		$noti=$this->User_model->insert_notification("Admin",$userId,10,$pid);
		if($noti){
			return 1;
		}
		else{
			return 0;
		}
	}

	function unblockUser($uid,$f){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		
		$x=$this->Admin_model->unblockUser($uid);
		

		if($f==1){
			redirect("Admin/spamalerts");
		}
		if($f==2){
			redirect("Admin/reports");
		}
		if($f==3){
			redirect("Admin/painic");
		}
		else{
			redirect("Admin/users");

		}
		

	}

	function spamCount($pid){
		
		$spamBy=$this->Admin_model->spammedBy($pid);
		$countSpam=$this->Admin_model->countSpam($spamBy);
		$this->load->view("admin/admin_header");
		$this->load->view("admin/spamBy", array("countSpam"=>$countSpam));	
		

	}

	function reports(){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		$getAllSpams=$this->Admin_model->getAllSpamsData(2);
		$getApprovedSpams=$this->Admin_model->getApprovedSpams(2);
		$getRejectedSpams=$this->Admin_model->getRejectedSpams(2);
		$blockedUser=$this->Admin_model->blockedUser();
		$this->load->view("admin/admin_header");
		$this->load->view("admin/spamalerts", array("getAllSpams"=>$getAllSpams, "getApprovedSpams"=>$getApprovedSpams, "getRejectedSpams"=>$getRejectedSpams, "blockedUser"=>$blockedUser, "f"=>2));

	}

	function painic(){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		$getAllSpams=$this->Admin_model->getAllSpamsData(3);
		$getApprovedSpams=$this->Admin_model->getApprovedSpams(3);
		$getRejectedSpams=$this->Admin_model->getRejectedSpams(3);
		$blockedUser=$this->Admin_model->blockedUser();
		$this->load->view("admin/admin_header");
		$this->load->view("admin/spamalerts", array("getAllSpams"=>$getAllSpams, "getApprovedSpams"=>$getApprovedSpams, "getRejectedSpams"=>$getRejectedSpams, "blockedUser"=>$blockedUser, "f"=>3));
	}

	function users($f=1){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
	}
	
	$getAllUsersData=$this->Admin_model->getAllUsersData();
	$getAllUsers=count($getAllUsersData);
	$getVerifiedUsers=$this->Admin_model->getVerifiedUsers();
	$getUnVerifiedUsers=$this->Admin_model->getUnVerifiedUsers();
	$getBlockedUsers=$this->Admin_model->getBlockedUsers();
	$this->load->view('admin/admin_header');
	$this->load->view('admin/users',array("getVerifiedUsers"=>$getVerifiedUsers, "getUnVerifiedUsers"=>$getUnVerifiedUsers, "getAllUsers"=>$getAllUsers, "getAllUsersData"=>$getAllUsersData, "getBlockedUsers"=>$getBlockedUsers, "f"=>$f) );
	}

	function sendMsg(){
		$pid=0;
		$userId=$_POST["userId"];
		$noti=$this->User_model->insert_notification("Admin",$userId,12,$pid);
			redirect("Admin/users");
		}
	
	function Post(){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		
		$AllPostData=$this->Admin_model->AllPostData(2);		
		$deletePostData=$this->Admin_model->deletePostData(1);
		$this->load->view('admin/admin_header');
		$this->load->view('admin/Post', array("AllPostData"=>$AllPostData, "deletePostData"=>$deletePostData));
	}

	function LinkPost(){
		if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}

		$AllLinkData=$this->Admin_model->AllLinkData(2);		
		$deletePostData=$this->Admin_model->deletePostData(2);
		$this->load->view('admin/admin_header');
		$this->load->view('admin/LinkPost', array("AllLinkData"=>$AllLinkData, "deletePostData"=>$deletePostData));
	}

	public function delete_post($pid){
			if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		$check=$this->User_model->if_baught($pid,1);
		if($check==0){
		$y=$this->User_model->deletePost($pid);
		if($y)
		{	echo $y;
		}
		}
		else{
			echo 0;
		}
	}

	public function recover(){
		$pid=$_POST["id"];
		$x=$this->Admin_model->recover($pid);
	}

	public function feedback(){
			if(!$this->session->userdata("adminId")){
			$this->session->set_flashdata("msg", "");
			redirect('Admin');
		}
		$f=$this->Admin_model->getFeedbacks();	
		$this->load->view('admin/admin_header');
		$this->load->view("admin/feedback", array("f"=>$f));
	}

}