<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 


class Send extends CI_Controller {
 

public function __construct() 
	{ 
		parent::__construct();
		$this->load->model('User_model'); 
	
		
	}	
	public function index(){
	}
	
	public function submit(){

		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;  
		$checkMsg=$this->User_model->checkMsg($this->input->post('uid2'));
		$checkBlocked=$this->User_model->check_blocked($this->input->post('uid1'), $this->input->post('uid2'));  
		if($checkBlocked==0){
		if($checkMsg==1){
		$linkdata=array("imgUrl"=>$_POST["imgUrl"],
						"post_title"=>$_POST["post_title"],
						"short_des"=>$_POST["post_title"]);
		$linkdata=json_encode($linkdata);
		$arr['link']=$linkdata;
		$arr['message'] = $this->input->post('message');
		$arr['uid1'] = $this->input->post('uid1');
		$arr['uid2'] = $this->input->post('uid2');
		$arr['timestamp']= time();
		$this->db->insert('chats',$arr);
		$detail = $this->db->select('*')->from('chats')->where('id',$this->db->insert_id())->get()->row();
		$arr['id'] = $detail->id;
		$arr['message'] = $detail->message;
		$arr['new_count_message'] = $this->User_model->new_count_message($arr['uid2']);
		$arr['sid'] = $this->User_model->new_message_noti($arr['uid2']);
		$arr['success'] = true;
		$arr['cm']=$checkMsg;
		echo json_encode($arr);
		}

		if($checkMsg==0){
		$arr['success'] = 0;
		echo json_encode($arr);
		}
		}

		else{
			echo "block";
		}
	}

	function messages(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$uid1=$_POST["uid1"];
		$uid2=$_POST["uid2"];
		$img=$_POST["img"];
		$sql="select * from chats where (uid1=$uid1 and uid2=$uid2) or (uid2=$uid1 and uid1=$uid2)";
		$res=$this->db->query($sql)->result();
		$view=$this->load->view("oneonone", array("res"=>$res, "userId"=>$userId, "img"=>$img));
		echo json_encode($view);
	}

	public function read(){
		$uid1=$_POST["uid1"];
		$read=$this->User_model->read($uid1);
	}

	public function fileupload(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		
		$img=array('name'=>$_FILES[0]["name"],
					'tmp'=>$_FILES[0]["tmp_name"],
					'size'=>$_FILES[0]["size"]
					);
		$f1=$this->uploadImgs($img);

		if($f1){
				$res=array("status"=>1, "img"=>$img['name']);
				echo json_encode($res);
			}	
	}

	function sendFile(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$arr['attachment'] ="../attachments/".$_POST["img"];
		$arr['uid1'] = $userId;
		$arr['uid2'] = $_POST["uid2"];
		$arr['timestamp']=time();
		$this->db->insert('chats',$arr);
		$detail = $this->db->select('*')->from('chats')->where('id',$this->db->insert_id())->get()->row();	
		$arr['id'] = $detail->id;
		$arr['attachment'] = $detail->message;
		$arr['new_count_message'] = $this->User_model->new_count_message($arr['uid2']);

		$arr['sid'] = $this->User_model->new_message_noti($arr['uid2']);
			$arr['success'] = true;
			echo json_encode($arr);
	}

	public function uploadImgs($file){
	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		if($file){

			$target_dir = "../attachments/";
			$target_file = $target_dir . basename($file["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


			if (file_exists($target_file)) {
			   $this->session->set_flashdata('err', 'Sorry, file already exists');
			    $uploadOk = 0;
			    	return 12;

			}


			if ($file["size"] > 2000000) {
			   $this->session->set_flashdata('err', 'Sorry, file is too large');
			    $uploadOk = 0;
			    	return 22;
			}

	
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
			     $this->session->set_flashdata('err', 'Sorry only images are allowed');
			    $uploadOk = 0;
			    	return 32;
			}



			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {

			  $this->session->set_flashdata('ex', 'Sorry, your file was not uploaded.');
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($file["tmp"], $target_file)) {

			       return 1;
			    } else {
			       return 0;
			    }
			}
					}
	}

	function tvmessenger(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		
		$a="select distinct uid1 from chats where uid2=$userId order by time desc";
		$op=$this->db->query($a)->result();
		$chatData=array();
		if(count($op) > 0){
		foreach ($op as $key => $value) {
			$uid1=$value->uid1;
			$sql="select * from chats where (uid1=$uid1 and uid2=$userId) or (uid2=$uid1 and uid1=$userId) order by time desc";
			
			
			
			$sql="select * from users where id=$uid1";
			$value->name=$this->db->query($sql)->row()->name;
			$value->img=$this->db->query($sql)->row()->profile_pic;
			
			array_push($chatData, $value);
			
	 	    }
	 	 }

		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view('tvmessenger', array("chatData"=>$chatData));	
	}

	function messenger($a, $b){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$a=(string)$a;
		$a=substr($a,6);
		$b=(string)$b;
		$b=substr($b,6);
		if($a==$userId){
			$uid1=$a;
			$uid2=$b;
		}
		else if($b==$userId){
			$uid1=$b;
			$uid2=$a;
		}
		else{
		}
		$fdata=$this->User_model->getUdata($uid2);
		$Chats=$this->User_model->getChats();
		$UdataArray=array();
		foreach ($Chats as $key => $value) {
			
			if($value->uid1==$userId){
				$chatUid=$value->uid2;
			}
			else if($value->uid2==$userId){
				$chatUid=$value->uid1;
			}
			
			$udata=$this->User_model->getUdata($chatUid);
			array_push($UdataArray, $udata);
		}

		$img=$fdata[0]->profile_pic;
		$fimg=$x[0]->profile_pic;
		$sql="select * from chats where (uid1=$uid1 and uid2=$uid2) or (uid2=$uid1 and uid1=$uid2)";
		$res=$this->db->query($sql)->result();
		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view("messengerList", array("Chats"=>$Chats, "UdataArray"=>$UdataArray,"userId"=>$userId,"res"=>$res, "userId"=>$userId, "img"=>$img, "uid1"=>$uid1, "uid2"=>$uid2, "fimg"=>$fimg, "fotp"=>$fdata[0]->otp, "fname"=>$fdata[0]->name)); 
	}

	function messengerp(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));

		$userId=$y->id; 
		$getLatest=$this->User_model->getLatest($userId);

		if(count($getLatest) >0){
		$r1=rand(100000,999999);
		$r2=rand(100000,999999);
		redirect('Send/messenger/'.$r1.$getLatest->uid1.'/'.$r2.$getLatest->uid2);
		}
		else{
			$friends=array();
			$UdataArray=array();
			$getFrnds=$this->User_model->TFriends($userId);
			if(count($getFrnds) > 0){
			foreach ($getFrnds as $key => $value) {

				if($value["uid_1"]==$userId){
					array_push($friends, $value["uid_2"]);
				}	
				else if($value["uid_2"]==$userId){
					array_push($friends, $value["uid_1"]);
				}
			}
			}	
			foreach ($friends as $key => $value) {
			$udata=$this->User_model->getUdata($value);
			array_push($UdataArray, $udata);
			}
			$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
			$this->load->view("messengerList1", array("UdataArray"=>$UdataArray));
		}
	}

		function searchFriends(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$friends=array();
		$si=array();
		$uidArr=array();
		$userId=$y->id; 
		$input=$_POST["nm"];
		$users=array();
		$getFrnds=$this->User_model->TFriends($userId);
		$data=$this->User_model->search_truevl($input,0, $userId);
		if(count($getFrnds) > 0){
			foreach ($getFrnds as $key => $value) {

				if($value["uid_1"]==$userId){
					array_push($friends, $value["uid_2"]);
				}	
				else if($value["uid_2"]==$userId){
					array_push($friends, $value["uid_1"]);
				}
			}
		}	
		foreach ($data as $key => $value) {
			array_push($si, $value->id);
		}

		for($i=0; $i<count($friends); $i++){
			for($j=0; $j<count($si); $j++){
				if($friends[$i]==$si[$j]){
					array_push($uidArr,$si[$j]);
				}
			}
		}
		foreach ($uidArr as $key => $value) {
			$udata=$this->User_model->getUdata($value);
			array_push($users, $udata);
		}
		
		$view=$this->load->view("searchF", array("users"=>$users, "userId"=>$userId));
		echo json_encode($view);
	}	

}
