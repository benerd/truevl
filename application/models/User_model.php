<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model { 
	function check_mail($email){
		$query= "select * from users where email='$email'";
		if($this->db->query($query))
		{
   			if($this->db->query($query)->num_rows() > 0){
   				return false;
   			}
   			else{
   				return true;
   			}
   		}
	} 
	function check_mobi($mob){
		$query= "select * from users where mobile='$mob'";
      
		if($this->db->query($query))
		{
   			if($this->db->query($query)->num_rows() > 0){
   				return false;
   			}
   			else{
   				return true;
   			}
   		}

	}
	
	function insert_user($data){
		
	if($this->db->insert('users', $data))
      {
        return $this->db->insert_id();
      }
  
	}
  	
	function ver_otp($email,$check){
		if($check==3){
			return 1;
		}
		else{
		$query= "UPDATE users set phone_ver=1, status=1, active=1 where email='$email'";
      
		$this->db->query($query);
   		return $this->db->affected_rows();
   		}
	}

	function verotp($mobile){
		
	$query= "select * from users where mobile='$mobile'";
      
		if($this->db->query($query)->num_rows()==1)
   			return 2;
   		else 
   			return 3;

	}

	function get_otp()
	{
		if(!$this->session->userdata('email') && !$this->session->userdata('mobile')){
			redirect("/");
		}

		if($this->session->userdata('email')){
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
		if(!$this->session->userdata('email') && !$this->session->userdata('mobile')){
			redirect("/");
		}

		$otp=$_POST["otp"];

		if($check==1)
		{
			$x=$this->User_model->ver_otp($otp,$this->session->userdata('email'));
		}	
		else{
			$x=$this->User_model->verotp($otp,$this->session->userdata('mobile') );
		}
		if($x==1)
		{
			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$userId=$y->id;
			$q="insert into wallet set user_id=$userId, incocming_balance=10, outgoing=0, source='joining'";
			$qry=$this->db->query($q);
			
			$privcy=$this->User_model->set_privacy($x);			
			$this->session->set_flashdata('msg', 'Your OTP has been verified. Please Login.');
			redirect("users/stepOne");
		}
		else if($x==2){
			$this->load->view("password_form");
		}
		else{
			$this->session->set_flashdata("msg", "incorrect otp");
			redirect("users/get_otp");
		}
	}

	function set_privacy($id){
    	$sql="insert into privacy set user_id=$id";

    	if($this->db->query($sql)){
    		return 1;
    	}
    }
    function getUserData($email){
		$query= "select * from users where email='$email'";
      
		if($this->db->query($query))
		{
   			return $this->db->query($query)->result();
   		}
	}

	function getUserID($email){
		$query= "select id from users where email='$email'";
      
		if($this->db->query($query))
		{
   			return $this->db->query($query)->row();
   		}
	}

	function updateIntrests($data, $email){
		$sql="update users set interest='$data' where email='$email'";
		$this->db->query($sql);
		return 1;
	}

	function getLinkups($city, $userId){
		$sql="select * from users where city='$city' and id!=$userId order by rand() limit 6";
		if($this->db->query($sql)){
			$data=$this->db->query($sql)->result();
			return $data;
		}
	}
	
	function privacyData($id)
	{
		$sql="select * from privacy where user_id=$id";
		return $this->db->query($sql)->row();
	}	

	function addFriend($uid, $fid){

		$sql="select * from friends where (uid_1=$uid and uid_2=$fid) or (uid_2=$uid and uid_1=$fid)";

		$data=$this->db->query($sql)->row();

		if(count($data)>0){
		if($data->status==1 || $data->status==0){
			return 2;
		}
		else if($data->status==-1 || $data->status==-2){
		
			$sql="update friends set status=0,view_status=0,uid_1=$uid,uid_2=$fid where (uid_1=$data->uid_1 and uid_2=$data->uid_2) or (uid_1=$data->uid_2 and uid_2=$data->uid_1)";
			if($this->db->query($sql)){
				return 1;
			}
		}
		}
		else{
			$query="insert into friends set uid_1=$uid, uid_2=$fid, status=0";
		if($this->db->query($query)){
			
			return 1;
		}	
		}
	}

	function check_login($email, $pass){
		$query= "select * from users where email='$email' and password='$pass' and status=1" ;
      
		if($this->db->query($query))
		{
   			$r= $this->db->query($query)->num_rows();
   		}
   		if($r==1){
   			return $r;
   		}
   		else{
	   		$query= "select * from users where email='$email' and password='$pass' and status=2";
	   		if($this->db->query($query))
			{
				$r= $this->db->query($query)->num_rows();
	   			
	   		}
	   		if($r==1){
	   			return 2;
	   		}
	   		else{
	   			return 0;
	   		}
   		}
   		
	}

	function sessions($data){
		$this->db->insert("sessions",$data);
		return $this->db->insert_id();
	}
	
	function check_mobile($nm){
    	$q="select * from users where mobile='$nm'";
    	if($this->db->query($q)->num_rows()>0){
    		return 1;
    	}	
    	else{
    		return 0;
    	}

    }

    function update_password($pass, $mob){
    	$sql="update users set password='$pass' where mobile='$mob'";
    	if($this->db->query($sql)){
    		return 1;
    	}

    }
	
	 function get_activity($userId){

    	$sql="select * from posts where user_id=$userId";
    	$po=$this->db->query($sql)->num_rows();
    
    	// $sql="select * from baught_post where baught_by=$userId";
    	// $bp=$this->db->query($sql)->num_rows();
    	

    	$sum=$po;
    	return $sum;
    }

    function checkfrndStatus($id){
		$sql="select * from friends where friend_id=$id";
		return $this->db->query($sql)->row_array();
	}


    function get_links($userId){
    	$sql="select * from friends where (uid_1=$userId and status=1 ) or (uid_2=$userId and status=1) ";
    	$count=$this->db->query($sql)->num_rows();
    	return $count;

    }

    function activityCount($userId){
		$sql="select * from posts where user_id=$userId and ( is_status=2 or is_status=0) order by posted_on desc";
		return $this->db->query($sql)->num_rows();
	}

	function commentsCount($userId){
		$sql="select * from posts where user_id=$userId and (is_status=1 or is_status=4) order by posted_on desc";
		return $this->db->query($sql)->num_rows();
	}

	function linksCount($userId){
	
		$query="select * from friends where (uid_1=$userId and status=1) or ( uid_2=$userId and status=1) ";
		if($this->db->query($query)){
			$fid=$this->db->query($query)->num_rows();
		}
			return $fid;
		
	}
	function getCurrentComment($userId){
		$sql="select * from posts where user_id=$userId and is_status=1 and post_status=1 order by posted_on desc";
		if($this->db->query($sql)){
			return $this->db->query($sql)->row();
		}
	}

	function totalUserPromo($userId){ 
		$sql="select promo_requests.post_id from promo_requests where (promo_requests.request_from=$userId and promo_requests.status=1)";
		
		$r1= $this->db->query($sql)->num_rows();

		$sql="select bidrequests.post_id from bidrequests where (bidrequests.request_to=$userId and bidrequests.status=1)";
		
		$r2= $this->db->query($sql)->num_rows();

		return $r1+$r2;

	}

	function totalActivity($userId){
		$sql="select * from posts where user_id=$userId and is_status=0 and post_status=1";
		return $this->db->query($sql)->num_rows();
	}

	function userStatus($userId, $limit){
		$sql="select * from posts where user_id=$userId and (is_status=1 or is_status=4) and post_status=1 order by posted_on desc limit $limit, 3";
		return $this->db->query($sql)->result_array();
	}

	function totalStatus($userId){
		$sql="select * from posts where user_id=$userId and (is_status=1 or is_status=4) and post_status=1";
		return $this->db->query($sql)->num_rows();
	}

	function getcurStatus($userId){
		$sql="select * from posts where `is_status`=1 AND `user_id`=$userId order by posted_on desc";
		return $this->db->query($sql)->row();
	}


	function remove_pic($userId){
		$sql="update users set profile_pic='assets/img/default-user.jpg' where id=$userId";
		if($this->db->query($sql)){
			return 1;
		}
	} 

	public function authorData($id){

 		$query="select * from users where id=$id";

 		if($this->db->query($query)){
 			return $this->db->query($query)->result_array();
 		}
 	}

 	function Friends($userId, $limit){
		$query="select * from friends where (uid_1=$userId and status=1) or ( uid_2=$userId and status=1) limit $limit, 5";
		
		if($this->db->query($query)){
			$fid=$this->db->query($query)->result_array();
		}
			return $fid;
		
	}
	
	function check_friends($userId, $authId){
    	$sql="SELECT * FROM `friends` WHERE (`uid_1`=$userId and `uid_2`=$authId  ) or (`uid_1`=$authId and `uid_2`=$userId  ) ";
    	return $this->db->query($sql)->row();
    }

    function check_blocked($userId,$authId){
    	$sql="select * from friends where (uid_1=$userId and uid_2=$authId and blocked_by=$userId) or (uid_2=$userId and uid_1=$authId and blocked_by=$userId)";
    	return $this->db->query($sql)->num_rows();
    }

    function getUdata($userId){
		$query= "select * from users where id=$userId ";
		if($this->db->query($query))
		{
   			return $this->db->query($query)->result();
   		}
	}

	public function getFriends($userId){
 		$query="select uid_1,uid_2,status from friends where (uid_1=$userId and status=0) or (uid_1=$userId and status=1) or (uid_1=$userId and status=-3) or ((uid_2=$userId and status=0)	 or (uid_2=$userId and status=1) or (uid_2=$userId and status=-3))";

 		if($this->db->query($query)){
 			return $this->db->query($query)->result_array();
 		}
 	}

 	function getSuggestedUsers($userId){
		 $query="select * from users where id!=$userId order by rand()";

		if($this->db->query($query)){
			return $this->db->query($query)->result_array();
		}
	}

	function gsb($buyerIDs){

	
		$arr=array();
		$i=0;
		foreach ($buyerIDs as $key => $value) {
		$id=$buyerIDs[$key];
			
			if($id!=0){

			$sql="select * from users where id=$id";
			
			if($this->db->query($sql)){
					$x=$this->db->query($sql)->result_array();
					array_push($arr, $x);
					$sql="select * from posts where user_id=$id";
			    	$po=$this->db->query($sql)->num_rows();
			    	
			    	$arr[$i]["activity"]=$po;
			    	
			    	$sql="select * from friends where (uid_1=$id and status=1)  or (uid_2=$id and status=1) ";
    				$count=$this->db->query($sql)->num_rows();
    				
    				$arr[$i]["links"]=$count;
 					$i++;			
				}
			}
		}
		return $arr;
	}

	function lpdata($buyerIDs){
			$arr=array();
			foreach ($buyerIDs as $key => $value) {
				$id=$buyerIDs[$key];
				if($id!=0){
				$sql="select * from privacy where id=$id";
				if($this->db->query($sql)){
					$x=$this->db->query($sql)->result_array();
					array_push($arr, $x);
				}
			}
		}
				return $arr;
	}

	function friendNoti($uid){
		$query="select * from friends where status=0  and uid_2=$uid order by time desc";
		if($this->db->query($query)){
			return $this->db->query($query)->result_array();
		}
	}

	function friendNotiLoad($uid, $no){
		$query="select * from friends where status=0  and uid_2=$uid limit $no, 10";
		if($this->db->query($query)){
			return $this->db->query($query)->result_array();
		}
	}


	function promoti($uid){
		$query="select distinct post_id from promo_requests where status=0  and request_to=$uid";
		if($this->db->query($query)){
			return $this->db->query($query)->result_array();
		}
	}

	function bidNoti($uid){
		$query="select distinct post_id from bidrequests where status=0  and request_to=$uid";
		if($this->db->query($query)){
			return $this->db->query($query)->result_array();
		}
	}

	function FriendProflies($friendId){
		$query="select * from users where id=$friendId";
		if($this->db->query($query)){
			return $this->db->query($query)->result_array();
		}
	}

	
	function friendAccept($fid, $uid){

		$sql="select * from friends where uid_1=$fid and uid_2=$uid and status=1";
		if($this->db->query($sql)->num_rows() > 0){
			return false;
		}
		else{
		$query="update friends set status=1 where uid_1=$fid and uid_2=$uid and status=0";
		if($this->db->query($query)){
		$pid=0;
		$checkLinkup=$this->checkLinkup($fid);
		if($checkLinkup->link_noti==1){
		$noti=$this->Feed_model->insert_notification($uid,$fid,3,$pid);
		if($noti){
			return 1;
		}
 		}
		}
		else{
			return 0;
		}
		}
	}

	function checkLinkup($uid){
		$sql="select * from privacy where user_id=$uid";
		if($this->db->query($sql)){
			return $this->db->query($sql)->row();
		}
	}

	function friendReject($fid, $uid){
		$query="update friends set status=-1 where uid_1=$fid and uid_2=$uid";
		if($this->db->query($query)){
			return 2;
		}
		else{
			return 0;
		}
	}

	function copyrights_claim($data){
    	$x=$this->db->insert("copyright_claim", $data);
    	if($x){
    		return 1;
    	}
    }

	function getPromoCount($userId){ 
		$sql="select * from promo_requests where request_to=$userId and view_status=0";
		return $this->db->query($sql)->num_rows();
	}

	function getID($email){
		$query= "select id from users where email='$email'";
		if($this->db->query($query))
		{
   			return $this->db->query($query)->row();
   		}
	}

	function updateSessions($email){
		$sql="update sessions set status=0 where email='$email'";
		$this->db->query($sql);
	}

	 function disconnect($fid, $userId)
    {
   	$sql="select * from friends where (uid_1=$fid and uid_2=$userId and status=1) or (uid_2=$fid and uid_1=$userId and status=1)  ";
   	$row=$this->db->query($sql)->num_rows();
   
   	if($row==1){
   		$sql="update friends set status=-2 where (uid_1=$fid and uid_2=$userId) or  (uid_2=$fid and uid_1=$userId) ";
   		if($this->db->query($sql)){

   			echo 1;
   		}
   	}
   }

    function report_admin($data, $msg){

    	$pid=$data['post_id'];
    	$rep=$data['report_by'];
    	$action=$data['action'];
    	$sql="select * from spams where post_id=$pid and report_by=$rep";
    	$r=$this->db->query($sql)->num_rows();

    	if($r==1){
    		return 2;
    	}
    	else{
	    	$x=$this->db->insert("spams",$data);
	    	$s="insert into messages set sender_id=$rep, post_id=$pid, msg='$msg', time=now(), action=$action, view=0, to_id='admin'";
	    	$q=$this->db->query($s);
	    	if($x && $q){
	    		return 1;
	    	}
    	}
	}

	 function message_author($data){

    	$pid=$data['post_id'];
    	$sen=$data['sender_id'];
    	$action=$data['action'];
    	$sql="select * from messages where post_id=$pid and sender_id=$sen";
    	$r=$this->db->query($sql)->num_rows();

    	if($r==1){
    		return 2;
    	}
    	else{


    	$x=$this->db->insert("messages",$data);
    	
    	if($x){
    		return 1;
    	}
    	}
    }

     function getBalance($userId){
    	$sql="SELECT SUM(incocming_balance)-sum(outgoing) as total FROM `wallet` where user_id=$userId";
    	$qry=$this->db->query($sql);
    	if($qry){
    		return $qry->result_array();
    	}
    }

    function getTotalBids($userId){
		$sql="select sum(bid_price) as sum from bidrequests where `request_from`=$userId and status=0";
		return $this->db->query($sql)->row();
	}
	
	function checkPromoted($userId, $pid){
		$sql="select * from promo_requests where request_from=$userId and post_id=$pid";
		
		if($this->db->query($sql)){
			return $this->db->query($sql)->num_rows();
		}
	}

	function checkPromoPrivacy($userId){
		$sql="select * from privacy where user_id=$userId";
		return $this->db->query($sql)->row();
	}

	function promotePost($pid,$price,$posted_by,$userId){

		$sql="select * from promo_requests where request_to=$posted_by and request_from=$userId and post_id=$pid and status=0";
		$x=$this->db->query($sql)->num_rows();

		if($x > 0){
				return 2;
		}
		else{
			$sql="insert into promo_requests set request_to=$posted_by, request_from=$userId,  post_id=$pid, view_status=0, status=0, bid_price=$price";
			if($this->db->query($sql)){
				return 1;
			}
		}
		
	}

	function getAllPromo($pid, $userId){
		$sql="select * from promo_requests where post_id=$pid and request_from!=$userId and status=0";
		if($this->db->query($sql)){
			return $this->db->query($sql)->result_array();
		}
	}

	function checkUserPromotiStatus($pid,$uid, $userId){
		$sql="select * from promo_requests where request_to=$userId and request_from=$uid and post_id=$pid and status=0";
		return $this->db->query($sql)->num_rows();
	}

	function checkUserBidStatus($pid,$uid, $userId){
		$sql="select * from bidrequests where request_to=$userId and request_from=$uid and post_id=$pid and status=0";
		return $this->db->query($sql)->num_rows();
	}

	function acceptPromo($pid, $uid, $bidPrice){

		$sql="update promo_requests set time_publisher=now(), status=1, final_price=$bidPrice where post_id=$pid and request_from=$uid and status=0";
		if($this->db->query($sql)){
			return 1;
		}
	}

	function rejectPromo($pid, $uid){

		$sql="update promo_requests set time_publisher=now(), status=3 where post_id=$pid and request_from=$uid and status=0";
		if($this->db->query($sql)){
			return 1;
		}
	}

	function checkPromo($pid,$uid){
		$sql="select * from promo_requests where post_id=$pid and request_from=$uid and status=0";
		
			return $this->db->query($sql)->row();
	}

	function checkStatus($pid,$uid){
		$sql="select * from promo_requests where post_id=$pid and request_from=$uid and status=1";
		return $this->db->query($sql)->num_rows();		
	}

	function setOwnBid($userId, $uid, $pid, $bid){

		$sql="update promo_requests set time_publisher=now(), status=2, final_price=$bid where post_id=$pid and request_from=$uid and status=0";
		$x=$this->db->query($sql);
		
		if($x){
			$sql="select * from bidrequests where request_to=$uid and request_from=$userId and post_id=$pid and status=0";

			if($this->db->query($sql)->num_rows() > 0){
				return 1;
			}
			else{
			$sql="insert into bidrequests set request_to=$uid, request_from=$userId,  post_id=$pid, status=0, bid_price=$bid";
			if($this->db->query($sql)){
				return 2;
			}

			}
		}
	}

	function getAllBids($pid, $userId){
		$sql="select * from bidrequests where post_id=$pid and request_from!=$userId and status=0";
		if($this->db->query($sql)){
			return $this->db->query($sql)->row_array();
		}
	}

	function countClick($userId,$id,$uid, $Ad_id){
		$qry="select * from countclick where post_id=$id and clicked_by=$userId order by clicked_at desc";
		$check=$this->db->query($qry);  
		if($this->db->query($qry)->num_rows()>0){


		$row=$check->result_array();
		
		$date = new DateTime($row[0]["clicked_at"]);
		$result = $date->format('Ymd');
		$currentTime=date("Ymd");
		$ft=$currentTime-$result;

		if($ft!=0){	
			$curt=date("Y-m-d h:i:s");
			$sql="insert into countclick set post_id=$id, clicked_by=$userId, posted_by=$uid,Ad_id=$Ad_id, count=1, clicked_at='$curt'";
	   		$x=$this->db->query($sql);
	   		if($x){
	   			// $sql="insert into wallet set user_id=$userId,post_id=$id, incocming_balance=0.07, source='click'";
	   			// $this->db->query($sql);
	   			return 1;
	   		}
		}
	}

	else{
			$curt=date("Y-m-d h:i:s");
			$sql="insert into countclick set post_id=$id, clicked_by=$userId, posted_by=$uid,Ad_id=$Ad_id, clicked_at='$curt', count=1";
   			$x=$this->db->query($sql);
   			if($x){
   				// $sql="insert into wallet set user_id=$userId,post_id=$id, incocming_balance=0.07, source='click'";
	   			// $this->db->query($sql);	
	   			return 1;
	   		}
		}
	}

	function checkBidStatus($pid,$uid){
		$sql="select * from bidrequests where post_id=$pid and request_from=$uid and status=0";
		
			return $this->db->query($sql)->num_rows();
		
	}

	function acceptBids($pid, $uid, $bidPrice){

		$sql="update bidrequests set time_publisher=now(), status=1, final_price=$bidPrice where post_id=$pid and request_from=$uid and status=0";
		if($this->db->query($sql)){
			return 1;
		}
	}

	 function get_blocked($userId){
    	$sql="select * from friends where blocked_by=$userId";
    	$this->db->query($sql);
		$idarr=array();
		if($this->db->query($sql)){

			$x= $this->db->query($sql)->result_array();
			if($x){
			foreach ($x as $key => $value) {
					if($value["uid_1"]==$userId)
						array_push($idarr, $value["uid_2"]);
					if($value["uid_2"]==$userId)
						array_push($idarr, $value["uid_1"]);

			}

			foreach ($idarr as $key => $value) {
				$sql="select * from users where id=$value";
				return $this->db->query($sql)->result_array();
			}


		}
		}
    }

    public function trans($uid){
		$sql="select * from wallet where user_id=$uid order by time desc";
		return $this->db->query($sql)->result_array();

	}

	function monthlyEarning($userId){

		$format=('Y-m-d H:i:s');
		$curdate= date($format, strtotime("3 hours +30 minutes"));
		$d2=date($format, strtotime("-30 days "));
		$sql="select sum(incocming_balance) as sum from wallet  WHERE user_id=$userId and time >= '$d2' and time <= '$curdate'";
		$data1= $this->db->query($sql)->row()->sum;  
		return $data1;

	}

	function debit($userId){
		$sql="select sum(outgoing) as sum from wallet  WHERE user_id=$userId";
		$data1= $this->db->query($sql)->row()->sum;  
		return $data1;
	}

	function monthWiseEarning($userId){
	$sql="SELECT DATE_FORMAT(`time`, '%b')AS month, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:59:59' and user_id=$userId GROUP BY month ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();

	}

	function monthWisePromo($userId){
			$sql="SELECT DATE_FORMAT(`time`, '%b')AS month, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:59:59' and user_id=$userId and source='Promotion' GROUP BY month ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();
	}

	function monthWiseView($userId){
			$sql="SELECT DATE_FORMAT(`time`, '%b')AS month, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:59:59' and user_id=$userId and source='view' GROUP BY month ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();
	}

	function weeklyPromo($userId){
		$format=('Y-m-d 23:59:59');
		$curdate= date($format);
		$d2=date('Y-m-d 00:00:00', strtotime("-7 days "));

			$sql="SELECT DATE_FORMAT(`time`, '%W') AS week, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '$d2' AND '$curdate' and user_id=$userId and source='Promotion' GROUP BY week ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();
	}

	function monthlyPromo($userId){
		$format=('Y-m-d 23:59:59');
		$curdate= date($format);
		$d2=date('Y-m-d 00:00:00', strtotime("-30 days "));

			$sql="SELECT DATE_FORMAT(`time`, '%d') AS month, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '$d2' AND '$curdate' and user_id=$userId and source='Promotion' GROUP BY month ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();
	}

	function weeklyViewE($userId){
		$format=('Y-m-d 23:59:59');
		$curdate= date($format);
		$d2=date('Y-m-d 00:00:00', strtotime("-7 days "));

			$sql="SELECT DATE_FORMAT(`time`, '%W') AS week, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '$d2' AND '$curdate' and user_id=$userId and source='view' GROUP BY week ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();
	}

	function monthlyViewE($userId){
		$format=('Y-m-d 23:59:59');
		$curdate= date($format);
		$d2=date('Y-m-d 00:00:00', strtotime("-30 days "));

			$sql="SELECT DATE_FORMAT(`time`, '%d') AS month, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '$d2' AND '$curdate' and user_id=$userId and source='view' GROUP BY month ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();
	}

	function dailyPromo($userId){
		$format=('Y-m-d 23:59:59');
		$curdate= date($format);
		$d2=date('Y-m-d 00:00:00');

			$sql="SELECT DATE_FORMAT(`time`, '%H') AS hour, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '$d2' AND '$curdate' and user_id=$userId and source='Promotion' GROUP BY hour ORDER BY mc Asc";

		return $this->db->query($sql)->result_array();
	}

	function dailyView($userId){
		$format=('Y-m-d 23:59:59');
		$curdate= date($format);
		$d2=date('Y-m-d 00:00:00');

			$sql="SELECT DATE_FORMAT(`time`, '%H') AS hour, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '$d2' AND '$curdate' and user_id=$userId and source='view' GROUP BY hour ORDER BY mc Asc";

		return $this->db->query($sql)->result_array();
	}

	

	

	function totalPromoSpend($userId){
		$sql="select sum(outgoing) as sum from wallet where source='Promotion' and user_id=$userId";
		return $this->db->query($sql)->row();
	}

	function monthlyPromoSpend($userId){
		$format=('Y-m-d 23:59:59');
		$curdate= date($format);
		$d2=date('Y-m-d 00:00:00', strtotime("-30 days "));
		$sql="select sum(outgoing) as sum from wallet where source='Promotion' and user_id=$userId and `time` BETWEEN '$d2' AND '$curdate'";
		return $this->db->query($sql)->row();
	}


	public function getToalTime($userId){
		$sql="select * from users where id=$userId";
		return $this->db->query($sql)->row();
	}

		function circulate($pid,$userId ,$uid, $tc){
		$sql="INSERT INTO `reaches` SET post_id=$pid, user_id=$userId, promoter_id=$uid, reaches=$tc";

		if($this->db->query($sql)){
			return 1;
		}
	}

	function totalCirculation($userId){
		$sql="select sum(reaches) as sum from reaches where user_id=$userId";
		return $this->db->query($sql)->row();
	}
	
	function promotedPost($userId){

		$pids=array();
		$ppdata=array();
		$sql="select distinct post_id from promo_requests where request_to=$userId and status=1";
		$data=$this->db->query($sql)->result();

		foreach ($data as $key => $value) {
			array_push($pids, $value->post_id);
		}

		$sql="select * from bidrequests where request_from=$userId and status=1";
		$data=$this->db->query($sql)->result();

		foreach ($data as $key => $value) {
			array_push($pids, $value->post_id);
		}

		foreach ($pids as $key => $value) {
			$sql="select * from posts where post_id=$value";
			$pdata=$this->db->query($sql)->row();
			if($value){
			$sql="select * from reaches where post_id=$value";
			$reaches=$this->db->query($sql)->row();
			$pdata->reaches=$reaches->reaches;
			}
			$sql="select * from promo_requests where post_id=$value and status=1";
			$a=$this->db->query($sql)->num_rows();
			$sql="select * from bidrequests where post_id=$value and status=1";
			$b=$this->db->query($sql)->num_rows();
			$pdata->nop=$a+$b;
			$sql="select sum(final_price) as sum from promo_requests where post_id=$value and status=1  ";
			$a=$this->db->query($sql)->row()->sum;
			$sql="select sum(final_price) as sum from bidrequests where post_id=$value and status=1  ";
			$b=$this->db->query($sql)->row()->sum;
			$pdata->pamount=$a+$b;
			if($pdata->is_status==2){
			$sql="select sum(count) as count from countclick where post_id=$value";
			$res=$this->db->query($sql)->row();
			}
			else{
			$sql="select sum(p_id) as count from total_views where p_id=$value";
			$res=$this->db->query($sql)->row();	
			}
			$pdata->count=$res->count;
			array_push($ppdata, $pdata);

		}
			 return $ppdata;
	}

	function stopPromotion($id){
		$sql="update posts set promo=1 where post_id=$id";
		if($this->db->query($sql)){
			return 1;
		}
	}

	function startPromotion($id){
		$sql="update posts set promo=0 where post_id=$id";
		if($this->db->query($sql)){
			return 1;
		}
	}

	function monthWisePromoSpend($userId){
	$sql="SELECT DATE_FORMAT(`time`, '%b')AS month, DATE_FORMAT(`time`, '%c') AS mc, sum(`outgoing`) AS sum FROM wallet WHERE `time` BETWEEN '2018-02-01 00:00:00' AND '2018-12-31 23:59:59' and user_id=$userId GROUP BY month ORDER BY mc Asc ";

	return $this->db->query($sql)->result_array();

	}


	function comissionPost($userId){

		$sql="SELECT * FROM `posts` WHERE `user_id`=$userId and post_status=1 and is_status=0 order by posted_on desc ";
			$x= $this->db->query($sql)->result();
			$earning=array();
			
			foreach ($x as $key => $value) {

				$pid=$value->post_id;

				 $sql="select * from wallet where post_id=$pid and source='Commission'";
				 $a=$this->db->query($sql)->num_rows();
				
					if($a > 0){

					$value->productSold=$a;
					$sql="select sum(incocming_balance) as sum from wallet where post_id=$pid and source='Commission'";
					 $b=$this->db->query($sql)->row()->sum;

					 $value->Commission=$b;
					


					 array_push($earning, $value);

					}
			}
			
			return $earning;
		}

		function totalComission($userId){
		$sql="select sum(incocming_balance) as sum from wallet where user_id=$userId and source='Commission'";
		if($this->db->query($sql)){
			return $this->db->query($sql)->row()->sum;
		}
	}

	function monthlyComissin($userId){
		$sql="SELECT DATE_FORMAT(`time`, '%b')AS month, DATE_FORMAT(`time`, '%c') AS mc, sum(`incocming_balance`) AS sum FROM wallet WHERE `time` BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:59:59' AND user_id=$userId AND source='Commission' GROUP BY month ORDER BY mc Asc ";

		return $this->db->query($sql)->result_array();
	}

	function getSpamsByUser($userId){
		$arr=array();
		$sql="select distinct post_id from spams where post_by=$userId";
		$x= $this->db->query($sql)->result();

		foreach ($x as $key => $value) {
			$post_id=$value->post_id;
			$sql="select * from posts where post_id=$post_id";
			$value->pdata=$this->db->query($sql)->row()->post_title;
			$value->mdesc=$this->db->query($sql)->row()->main_des;
			$value->sdesc=$this->db->query($sql)->row()->short_des;
			$value->is_status=$this->db->query($sql)->row()->is_status;
			$sql="select count(post_id) as count from spams where post_id=$post_id";
			$value->pcount=$this->db->query($sql)->row()->count;
			array_push($arr, $value);
		}
		return $arr;		
	}

	function search_truevl($input, $no, $userId){
		
		if($no==0)
		$sql="select * from users where name like '$input%'";
		else
		$sql="select * from users where name like '$input%'  limit $no, 10";	
		return $this->db->query($sql)->result();
	}

	function checkFriend($userId, $fid){
		$sql="select * from friends where (uid_1=$userId and uid_2=$fid) or (uid_1=$fid and uid_2=$userId)";
			return $this->db->query($sql)->row();
	}


	function currentTime(){
		$sql="select Now() as ctime";
		return $this->db->query($sql)->row()->ctime;
	}

	function getOnlineUsers($currentTime){
		$ou=array();
		$sql="select distinct user_id,time from sessions order by time desc";
		if($this->db->query($sql)){

			$data=$this->db->query($sql)->result_array();
			
			foreach ($data as $key => $value) {	
				$uid=$value["user_id"];

				$sql="select * from sessions where user_id=$uid order by time desc";
				$lastonline=$this->db->query($sql)->row()->lastonline;
				
				$startTime = new DateTime($lastonline);
				$endTime = new DateTime($currentTime);
				$duration = $startTime->diff($endTime); 
				$d= $duration->format("%H%I%S")."<br>";
				
				if($d < 1500){
					array_push($ou, $value["user_id"]);
				}
			}
		}

		return $ou;
	}

	function new_count_message($userId){
		$sql="select distinct uid1 from chats where uid2=$userId and read_status=0";

		return $this->db->query($sql)->num_rows();
	}

	function new_message_noti($userId){
		$sql="select * from chats where uid2=$userId and read_status=0";
		return $this->db->query($sql)->row()->uid2;
	}

	function read($uid1){
		$sql="update chats set read_status=1 where uid2=$uid1";
		return $this->db->query($sql);
	}

	function userActivity($userId, $limit){
		$sql="select * from posts where user_id=$userId and (is_status=0 or is_status=2 ) and post_status=1 order by posted_on desc limit $limit, 3";
		return $this->db->query($sql)->result_array();
	}

	function numlikes($pid){
		$query="select sum(likes) as sum from likes where `post_id`=$pid group by post_id";
		if( $this->db->query($query))
			$x=$this->db->query($query)->result_array();
			return $x;
	}

		function userPromo($userId, $limit){
		$sql="select promo_requests.post_id from promo_requests where (promo_requests.request_from=$userId and promo_requests.status=1) limit $limit, 3";
		$data1=$this->db->query($sql)->result_array();
		$sql="select bidrequests.post_id from bidrequests where (bidrequests.request_to=$userId and bidrequests.status=1) limit $limit, 3";
		$data2=$this->db->query($sql)->result_array();
		$arr=array();
		$data=array_merge($data1, $data2);
		foreach ($data as $key => $value) {
		
			$post_id=$value["post_id"];
			$sql="select * from posts where post_id=$post_id";
			$res=$this->db->query($sql)->result_array();
			array_push($arr, $res);
		
		}

		return $arr;

	}

	function getPromotersList($pid){

		$bidArr=array();
		$promArr=array();
		$sql="select * from bidrequests where post_id=$pid and status=1";
		if($this->db->query($sql)){
			$a=$this->db->query($sql)->result();
			foreach ($a as $key => $value) {
				$pid=$value->post_id;
				$promoter=$value->request_to;
				$sql="select * from users where id=$promoter";
				$userd=$this->db->query($sql)->row();
				$value->name=$userd->name;
				$value->profile_pic=$userd->profile_pic;
				$sql="select * from reaches where promoter_id=$promoter and post_id=$pid";
				$a=$this->db->query($sql)->row();
				$value->reaches=$a->reaches;
				array_push($bidArr, $value);
			}
		}
		
		$sql="select * from promo_requests where post_id=$pid and status=1";
		if($this->db->query($sql)){
			$b=$this->db->query($sql)->result();
			foreach ($b as $key => $value) {
			$pid=$value->post_id;
				$promoter=$value->request_from;
				$sql="select * from users where id=$promoter";
				$userd=$this->db->query($sql)->row();
				$value->name=$userd->name;
				$value->profile_pic=$userd->profile_pic;
				$sql="select * from reaches where promoter_id=$promoter and post_id=$pid";
				$a=$this->db->query($sql)->row();
				$value->reaches=$a->reaches;
				array_push($promArr, $value);
			}
		}

			$data=array_merge($promArr, $bidArr);
			return $data;
	}

	 function block($fid, $userId)
    {

    $sql="select * from friends where (uid_1=$fid and uid_2=$userId and status=1) or (uid_2=$fid and uid_1=$userId and status=1)  ";
   	$row=$this->db->query($sql)->num_rows();
   
   	if($row==1){
   		$sql="update friends set status=-3, blocked_by=$userId where (uid_1=$fid and uid_2=$userId) or  (uid_2=$fid and uid_1=$userId) ";
   		if($this->db->query($sql)){

   			echo 1;
   		}
   	}

   	else{
   		$sql="insert into friends set uid_1=$userId, uid_2=$fid, status=-3,view_status=1,blocked_by=$userId";
   		if($this->db->query($sql)){

   			echo 1;
   		}
   	}
   
    }


    function unblock($userId, $authId){
    		$sql="update friends set status=-1, blocked_by=0 where (uid_1=$userId and uid_2=$authId and blocked_by=$userId ) or (uid_2=$userId and uid_1=$authId and blocked_by=$userId) ";
    		if($this->db->query($sql))
    		{
    			return 1;
    		}

    }

    function Deactivate($id){
		$sql="update users set active=0 where id=$id";
		$data=$this->db->query($sql);
		if($data){
			return 1;
		}
	}
   	
	function checkMsg($userId)
	{
		$sql="select suggestion from privacy where user_id=$userId";
		if($this->db->query($sql)){
			return $this->db->query($sql)->row()->suggestion;
		}
	}

	function insertFeedback($data){
		
		$this->db->insert("feedback",$data);
	}

	function getChats(){ 
		$sql="SELECT * FROM chats WHERE (LEAST(uid1, uid2),GREATEST(uid1, uid2),timestamp) IN ( SELECT LEAST(uid1, uid2) AS x, GREATEST(uid1, uid2) AS y, max(timestamp) AS msg_time FROM chats GROUP BY x, y ) AND uid1 != uid2 ORDER BY `chats`.`time` DESC";
		if($this->db->query($sql)){
			return $this->db->query($sql)->result();
		}
	}

	function getLatest($userId){
		$sql="select * from chats where uid1=$userId or uid2=$userId order by time desc";
		if($this->db->query($sql)){
			return $this->db->query($sql)->row();
		}
	}


	function EditPostData($pid){
		$query= "select * from posts where post_id=$pid";
      
		if($this->db->query($query))
		{
   			return $this->db->query($query)->result_array();
   		}
	}

	function UpdatePost($id,$data){

		// $this->db->where('post_id', $id);
  //       $this->db->update('posts', $data);

 

   $query="UPDATE posts SET post_title='".$data['post_title']."',cat='".$data['cat']."',short_des='".$data['short_des']."',main_des='".$data['main_des']."',post_images=NULL,Keywords='".$data['Keywords']."',img='".$data['img']."',Vfile='".$data['Vfile']."',thumb='".$data['thumb']."',posted_on='".$data['posted_on']."' WHERE post_id=$id";

   	// if($this->db->query($query))
   // echo $query;
   	if($this->db->query($query)){
   		return 1;
   	}
   	else{
   		return 0;
   	}
	}

	 function TFriends($userId){
	 	$query="select * from friends where (uid_1=$userId and status=1) or ( uid_2=$userId and status=1)";
		
		if($this->db->query($query)){
			$fid=$this->db->query($query)->result_array();
		}
			return $fid;
	 }

	function update_counter($cookie,$slug)
    {
     
     	if(isset($cookie["value"])){
        	$i= $cookie["value"];
        	
        }
    	else{
    		$i=$cookie;
    	
    	}
       	$sql="select * from total_views where u_id='$i' and p_id=$slug order by time desc";
       	$row=$this->db->query($sql)->num_rows($sql);
       	$data=$this->db->query($sql)->result_array($sql);
       	if($row==0){
       		$time=date("Y:m:d H:i:s");
       		$s="insert into total_views set u_id='$i',p_id=$slug, time='$time'";
       		if($this->db->query($s)){
       			$sq="select * from total_views where p_id=$slug";
       			$r=$this->db->query($sq)->num_rows();	
       			$sq="update posts set views=$r where post_id=$slug";
       			$this->db->query($sq);
       		}
       		

       	}
       	else{
       		$otime=new DateTime($data[0]["time"]);
       		
       		$result = $otime->format('Ymd');
       		
       		$ctime=date("Ymd");
       		$ft=$ctime-$result;

       		if($ft!=0){
       			$time=date("Y:m:d H:i:s");
       			$s="insert into total_views set u_id='$i',p_id=$slug, time='$time'";
       			if($this->db->query($s)){
       			$sq="select * from total_views where p_id=$slug";
       			$r=$this->db->query($sq)->num_rows();	
       			$sq="update posts set views=$r where post_id=$slug";
       			$this->db->query($sq);
       			}
       			
       		}
       	}
    } 

    function getViews(){

    	$sql="SELECT *, count(view_id) as count FROM post_views WHERE DATE(`viewed_at`) = CURDATE() GROUP by `post_id`";
    	if($this->db->query($sql)){
    		return $this->db->query($sql)->result();
    	}	
    }

    function getSpams($pid){
    	$sql="select count(id) as count1 from spams where post_id=$pid ";
    	$a=$this->db->query($sql)->row()->count1;
    	$sql="select count(id) as count2 from painic where post_id=$pid ";
    	$b=$this->db->query($sql)->row()->count2;

    	return $a+$b;
    }

    function getTodayBalance(){
    	$sql="select * from wallet where user_id=0 and DATE(`time`) = CURDATE() ";

    	return $this->db->query($sql)->row()->incocming_balance;
    }

    function getNotifiers($notiId){
    	$sql="select * from notifications where id=$notiId";
    	if($this->db->query($sql)){
    		return $this->db->query($sql)->row();
    	}
    }

    function check_total_friends($userId){
    	$q="select * from friends where (uid_1=$userId and status=1) or (uid_2=$userId and status=1) ";
		$n= $this->db->query($q)->num_rows($q);
		return $n;
    }
    
    function link_upSent($uid){
		$sql="select * from friends where (uid_1=$uid and  DATE(`time`) = CURDATE())  ";
		return $this->db->query($sql)->num_rows();
	}

	function wallAmount($userId){
		$sql="select sum(incocming_balance) as sum from wallet where user_id=$userId and source='MOJO'";
		$S1=$this->db->query($sql)->row()->sum;
		$sql="select sum(outgoing) as sum from wallet where user_id=$userId and source='Promotion'";
		$S2=$this->db->query($sql)->row()->sum;
		return $S1-$S2;
	}

	function walltransaction($userId){
		$sql="select * from wallet where user_id=$userId and source='MOJO'" ;
		return $this->db->query($sql)->result();
	}

	function walltransactionDb($userId){
		$sql="select * from wallet where user_id=$userId and source='Promotion'" ;
		return $this->db->query($sql)->result();
	}

	function ladd($userId){
		$sql="select incocming_balance from wallet where user_id=$userId and source='MOJO' and incocming_balance > 0 order by time desc limit 1";
			if($this->db->query($sql)->num_rows() > 0){
				return $this->db->query($sql)->row()->incocming_balance;
			}
			else{
				return 0;
			}
	}

	function todayExp($userId){
		$sql="SELECT sum(outgoing) as sum FROM wallet WHERE DATE(time) = CURDATE() and user_id=$userId and source='Promotion'";
		return $this->db->query($sql)->row()->sum;
	}

	function totExp($userId){
		$sql="SELECT sum(outgoing) as sum FROM wallet WHERE user_id=$userId and source='Promotion'";
		return $this->db->query($sql)->row()->sum;
	}

	  function getTrending(){

    	$qry="SELECT * FROM `posts` order by views DESC";
    	if($this->db->query($qry)){
    		return $this->db->query($qry)->result_array();
    	}
    }


    function getAllPost(){
    	$qry="SELECT * FROM `posts` order by posted_on DESC";
    	if($this->db->query($qry)){
    		return $this->db->query($qry)->result_array();
    	}
    }

}