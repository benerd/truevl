<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function checkLogin($adminId, $password){
		$query= "select * from admin where adminId='$adminId' and password='$password'" ;
      
		if($this->db->query($query))
		{
   			return $this->db->query($query)->num_rows();
   		}
	}

	function getAllactive(){
		$sql="select * from sessions where status=1";
		return $this->db->query($sql)->row();
	}

	function getAllSpams(){
		$sql="select * from spams";
		return $this->db->query($sql)->result();
	}

	function getAllPosts(){
		$sql="select * from posts where is_status=0";
		return $this->db->query($sql)->result();
	}

	function getAllLinks(){
		$sql="select * from posts where is_status=1";
		return $this->db->query($sql)->result();
	}

	

	function AllPostData($f){
		if($f==1){
		$sql="select * from posts where is_status=0 and post_status=1 order by posted_on desc limit 20";
		}
		if($f==2){
		$sql="select * from posts where is_status=0 and post_status=1 order by posted_on desc";
		}
		$x=$this->db->query($sql)->result();
		$arr=array();
		foreach ($x as $key => $value) {
			$postId=$value->post_id;
			$userId=$value->user_id;

			$sql="select * from users where id=$userId";
			$name=$this->db->query($sql)->row()->name;
			$sql="select sum(ad_price) as sum from post_views where post_id=$postId";
			$earn=$this->db->query($sql)->row()->sum;
			$sql="select sum(p_id) as sum from total_views where p_id=$postId";
			$views=$this->db->query($sql)->row()->sum;
			$value->name=$name;
			$value->earn=$earn;
			array_push($arr, $value);
		}

		return $arr;
	}

	function AllLinkData($f){
		if($f==1){
		$sql="select * from posts where is_status=2 and post_status=1 order by posted_on desc limit 20";
		}
		else{
		$sql="select * from posts where is_status=2 and post_status=1  order by posted_on desc";	
		}
		$x=$this->db->query($sql)->result();
		$arr=array();
		foreach ($x as $key => $value) {
			$postId=$value->post_id;
			$userId=$value->user_id;

			$sql="select * from users where id=$userId";
			$name=$this->db->query($sql)->row()->name;
			// $sql="select sum(ad_price) as sum from post_views where post_id=$postId";
			// $earn=$this->db->query($sql)->row()->sum;
			// $sql="select sum(p_id) as sum from total_views where p_id=$postId";
			// $views=$this->db->query($sql)->row()->sum;
			$value->name=$name;
			array_push($arr, $value);
		}

		return $arr;
	}

	function mostViewed(){
		$sql="select * from posts where is_status=0 order by views desc limit 20";
		$x=$this->db->query($sql)->result();
		$arr=array();
		foreach ($x as $key => $value) {
			$postId=$value->post_id;
			$userId=$value->user_id;

			$sql="select * from users where id=$userId";
			$name=$this->db->query($sql)->row()->name;
			$sql="select sum(ad_price) as sum from post_views where post_id=$postId";
			$earn=$this->db->query($sql)->row()->sum;
			$sql="select sum(p_id) as sum from total_views where p_id=$postId";
			$views=$this->db->query($sql)->row()->sum;
			$value->name=$name;
			$value->earn=$earn;
			array_push($arr, $value);
		}

		return $arr;
	}

	function topPromoters(){
		$arr=array();
		$sql="select user_id, sum(incocming_balance) as sum, count(user_id) as count from wallet where incocming_balance > 0 and source='Promotion' group by user_id order by sum desc ";
		if($this->db->query($sql)){
			$x=$this->db->query($sql)->result();
			foreach ($x as $key => $value) {
				$user_id=$value->user_id;
				$sql="select * from users where id=$user_id";
				$udata=$this->db->query($sql)->row();
				$value->name=$udata->name;
				$value->joining_date=$udata->joining_date;
				$value->country=$udata->country;
				$value->state=$udata->state;
				array_push($arr, $value);
			}

			return $arr;
		}
	}

	function getAllSpamsData($f){
		$arr=array();
		if($f==1){
			$sql="select distinct post_id,post_by from spams where status=0 and type=1";
		}
		else if($f==2){
			$sql="select distinct post_id,post_by from spams where status=0 and type!=1";
		}
		else{
			$sql="select distinct post_id,post_by from painic where status=0";
		}
		$x=$this->db->query($sql)->result();
		foreach ($x as $key => $value) {
			$post_id=$value->post_id;
			$post_by=$value->post_by;
			$sql="select * from users where id=$post_by";
			$udata=$this->db->query($sql)->row();
			$sql="select * from posts where post_id=$post_id";
			$pdata=$this->db->query($sql)->row();
			if($f!=3){
			$sql="select * from spams where post_id=$post_id";
			$spamId=$this->db->query($sql)->row()->id;
			$type=$this->db->query($sql)->row()->type;
			$value->id=$spamId;
			$value->type=$type;
			}
			$spamCount=$this->db->query($sql)->num_rows();
			$value->spamCount=$spamCount;
			$value->name=$udata->name;
			$value->email=$udata->email;
			$value->mobile=$udata->mobile;
			$value->views=$pdata->views;
			$value->is_status=$pdata->is_status;
			$value->short_des=$pdata->short_des;
			$value->post_title=$pdata->post_title;
			$value->posted_on=$pdata->posted_on;
			$sql="select count(post_id) as count, sum(ad_price) as sum  from post_views where post_id=$post_id";
			$ads=$this->db->query($sql)->row();
			$value->adsop=$ads->count;
			$value->earn=$ads->sum;
			array_push($arr, $value);
		}
		return $arr;
	}

	function approveSpam($id){

		$sql="select * from spams where post_id=$id";
		$data=$this->db->query($sql)->row();
		$sql="update spams set status=1 where post_id=$id";
		$x=$this->db->query($sql);
		if($x){
			$post_id=$data->post_id;
			$sql="update posts set post_status=0 where post_id=$post_id";
			if($this->db->query($sql))
			{
				return 1;
			}
		}

	}

	function approvePainic($id){
		$sql="select * from painic where post_id=$id";
		$data=$this->db->query($sql)->row();
		$sql="update painic set status=1 where post_id=$id";
		$x=$this->db->query($sql);
		if($x){
			$post_id=$data->post_id;
			$sql="update posts set post_status=0 where post_id=$post_id";
			if($this->db->query($sql))
			{
				return 1;
			}
		}
	}

	function rejectSpam($id){

		
		$sql="update spams set status=2 where post_id=$id";
		$x=$this->db->query($sql);
		if($x){
				return 1;
		}

	} 

	function rejectPainic($id){
		$sql="update painic set status=2 where post_id=$id";
		$x=$this->db->query($sql);
		if($x){
				return 1;
		}
	}

	function blockUser($id){
		$sql="select * from spams where post_id=$id";
		$data=$this->db->query($sql)->row();
		$sql="update spams set status=1 where post_id=$id";
		$x=$this->db->query($sql);
		if($x){
			$post_id=$data->post_id;
			$post_by=$data->post_by;
			$sql="update posts set post_status=0 where post_id=$post_id";
			$sql1="update users set status=2 where id=$post_by";
			if($this->db->query($sql) && $this->db->query($sql1)  )
			{
				return 1;
			}
		}
	}

	function blockUsser($id){
		
			
			$sql1="update users set status=2 where id=$id";
			if($this->db->query($sql1)  )
			{
				return 1;
			}
		}
	


	function getPostedBy($id,$f){
		if($f!=3){
		$sql="select * from spams where post_id=$id";
		}
		else{
		$sql="select * from painic where post_id=$id";	
		}
		return $this->db->query($sql)->row();
	}

	function getApprovedSpams($f){
		$arr=array();
		if($f==1){
		$sql="select distinct post_id,post_by from spams where status=1 and type=1";
		}
		else if($f==2){
		$sql="select distinct post_id,post_by from spams where status=1 and type!=1";	
		}
		else{
		$sql="select distinct post_id,post_by from painic where status=1";		
		}
		$x=$this->db->query($sql)->result();
		foreach ($x as $key => $value) {
			$post_id=$value->post_id;
			$post_by=$value->post_by;
			$sql="select * from users where id=$post_by";
			$udata=$this->db->query($sql)->row();
			$sql="select * from posts where post_id=$post_id";
			$pdata=$this->db->query($sql)->row();
			if($f!=3){ 
			$sql="select * from spams where post_id=$post_id";
			$spamId=$this->db->query($sql)->row()->id;
			$value->id=$spamId;
			$spamCount=$this->db->query($sql)->num_rows();
			$value->spamCount=$spamCount;
			}
			else{
			$sql="select * from painic where post_id=$post_id";
			$spamCount=$this->db->query($sql)->num_rows();
			$value->spamCount=$spamCount;
			}
			$value->name=$udata->name;
			$value->email=$udata->email;
			$value->mobile=$udata->mobile;
			$value->views=$pdata->views;
			$value->is_status=$pdata->is_status;
			$value->short_des=$pdata->short_des;
			$value->post_title=$pdata->post_title;
			$value->posted_on=$pdata->posted_on;
			$sql="select count(post_id) as count, sum(ad_price) as sum  from post_views where post_id=$post_id";
			$ads=$this->db->query($sql)->row();
			$value->adsop=$ads->count;
			$value->earn=$ads->sum;
			array_push($arr, $value);
		}
		return $arr;
	}

	function getRejectedSpams($f){
		$arr=array();
		if($f==1){
		$sql="select distinct post_id,post_by from spams where status=2 and type=1";
		}
		else if($f==2){
		$sql="select distinct post_id,post_by from spams where status=2 and type!=1";	
		}
		else{
		$sql="select distinct post_id,post_by from painic where status=2";		
		}
		$x=$this->db->query($sql)->result();
		foreach ($x as $key => $value) {
			$post_id=$value->post_id;
			$post_by=$value->post_by;
			$sql="select * from users where id=$post_by";
			$udata=$this->db->query($sql)->row();
			$sql="select * from posts where post_id=$post_id";
			$pdata=$this->db->query($sql)->row();
			if($f!=3){
			$sql="select * from spams where post_id=$post_id";
			$spamCount=$this->db->query($sql)->num_rows();
			$value->spamCount=$spamCount;
			}
			else{
			$sql="select * from painic where post_id=$post_id";
			$spamCount=$this->db->query($sql)->num_rows();
			$value->spamCount=$spamCount;	
			}

			$value->name=$udata->name;
			$value->email=$udata->email;
			$value->mobile=$udata->mobile;
			$value->views=$pdata->views;
			$value->is_status=$pdata->is_status;
			$value->short_des=$pdata->short_des;
			$value->post_title=$pdata->post_title;
			$value->posted_on=$pdata->posted_on;
			$sql="select count(post_id) as count, sum(ad_price) as sum  from post_views where post_id=$post_id";
			$ads=$this->db->query($sql)->row();
			$value->adsop=$ads->count;
			$value->earn=$ads->sum;
			array_push($arr, $value);
		}
		return $arr;
	}

	function blockedUser(){
		$sql="select * from users where status=2";
		if($this->db->query($sql)){
			return $this->db->query($sql)->result();
		}
	}

	function unblockUser($uid){
		$sql="update users set status=1 where id=$uid";
		if($this->db->query($sql)){
			return 1;
		}
	}

	function checkSpam($post_id){
		$sql="select * from spams where post_id=$post_id";
		if($this->db->query($sql)){
			return 1;
		}
		else{
			return 0;
		}
	}

	function spammedBy($pid){
	$sql="select * from spams where post_id=$pid";
	if($this->db->query($sql)){
		return $this->db->query($sql)->result();
	}
	}

	function countSpam($spamBy){
		$arr=array();
		foreach ($spamBy as $key => $value) {
			$userId=$value->report_by;
			$post_id=$value->post_id;
			$sql="select * from users where id=$userId";
			$udata=$this->db->query($sql)->row();
			$sql="select * from messages where sender_id=$userId and post_id=$post_id";
			$msgs=$this->db->query($sql)->row();
			if(count($msgs) > 0){
			$value->msg=$msgs->msg;
			}
			$value->uid=$udata->id;
			$value->name=$udata->name;
			$value->profile_pic=$udata->profile_pic;
			array_push($arr, $value);
		}
		return $arr;
	}

	function getAllUsersData(){
		$arr=array();
		$sql="select * from users";
		$x= $this->db->query($sql)->result();
		foreach ($x as $key => $value) {
			$userId=$value->id;
			$sql="select sum(incocming_balance) as isum, sum(outgoing) as osum from wallet where `id`=$userId";
			$isum=$this->db->query($sql)->row()->isum;
			$osum=$this->db->query($sql)->row()->osum;
			$value->isum=$isum;
			$value->osum=$osum;
			array_push($arr, $value);
		}
		return $arr;
	}

	function getVerifiedUsers(){
		$arr=array();
		$sql="select * from users where status=1";
		$x= $this->db->query($sql)->result();
		foreach ($x as $key => $value) {
			$userId=$value->id;
			$sql="select sum(incocming_balance) as isum, sum(outgoing) as osum from wallet where `id`=$userId";
			$isum=$this->db->query($sql)->row()->isum;
			$osum=$this->db->query($sql)->row()->osum;
			$value->isum=$isum;
			$value->osum=$osum;
			array_push($arr, $value);
		}
		return $arr;
	}

	function getUnVerifiedUsers(){
		$arr=array();
		$sql="select * from users where status=0";
		$x= $this->db->query($sql)->result();
		foreach ($x as $key => $value) {
			$userId=$value->id;
			$sql="select sum(incocming_balance) as isum, sum(outgoing) as osum from wallet where `id`=$userId";
			$isum=$this->db->query($sql)->row()->isum;
			$osum=$this->db->query($sql)->row()->osum;
			$value->isum=$isum;
			$value->osum=$osum;
			array_push($arr, $value);
		}
		return $arr;
	}

	function getBlockedUsers(){
		$arr=array();
		$sql="select * from users where status=2";
		$x= $this->db->query($sql)->result();
		foreach ($x as $key => $value) {
			$userId=$value->id;
			$sql="select sum(incocming_balance) as isum, sum(outgoing) as osum from wallet where `id`=$userId";
			$isum=$this->db->query($sql)->row()->isum;
			$osum=$this->db->query($sql)->row()->osum;
			$value->isum=$isum;
			$value->osum=$osum;
			array_push($arr, $value);
		}
		return $arr;
	}

	function deletePostData($f){
		if($f==1){
			$sql="select * from posts where post_status=0 and is_status=0";
		}
		if($f==2){
			$sql="select * from posts where post_status=0 and is_status=2";
		}
		$x=$this->db->query($sql)->result();
		$arr=array();
		foreach ($x as $key => $value) {
			$postId=$value->post_id;
			$userId=$value->user_id;

			$sql="select * from users where id=$userId";
			$name=$this->db->query($sql)->row()->name;
			// $sql="select sum(ad_price) as sum from post_views where post_id=$postId";
			// $earn=$this->db->query($sql)->row()->sum;
			// $sql="select sum(p_id) as sum from total_views where p_id=$postId";
			// $views=$this->db->query($sql)->row()->sum;
			$value->name=$name;
			array_push($arr, $value);
		}

		return $arr;
	}

	function recover($pid){

		$sql="update posts set post_status=1 where post_id=$pid";
		return $this->db->query($sql);
	}

	function getFeedbacks(){
		$sql="select * from feedback";
		return $this->db->query($sql)->result();	
	}

}


?>