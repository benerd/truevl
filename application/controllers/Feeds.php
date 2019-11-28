<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use google\appengine\api\cloud_storage\CloudStorageTools;  
class Feeds extends CI_Controller { 
	public function __construct() 
	{    
		parent::__construct();
		
		$this->load->model('User_model');
		$this->load->model('Feed_model');
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
		$getAll=$this->User_model->getAllPost();	
		$pdata=$this->User_model->privacyData($userId);
		$getFrnds=$this->User_model->getFriends($userId);
		$s=$this->User_model->getSuggestedUsers($userId);
		$byid=array();
		foreach ($getFrnds as $key => $vl) {
				array_push($byid, $vl["uid_1"]);	
				array_push($byid, $getFrnds[$key]["uid_2"]);	
		}  
		$buyerIDs=array();
		foreach ($s as $key => $value) {
		 	array_push($buyerIDs, $value["id"]);
		}
		if(count($byid)>0){
		 	for ($i=0; $i <count($byid) ; $i++) { 
		 		for ($j=0; $j <count($buyerIDs) ; $j++) { 
		 			if($byid[$i]==$buyerIDs[$j]){
		 				$buyerIDs[$j]=0;	
		 			}
		 		}	
		 	}
		}
		
	$frnds=$this->User_model->Friends($userId, 0);	
    $data=array();
    $buyerNumber=array();
    for($i=0; $i<count($frnds); $i++)
    {
      
      $frid=$frnds[$i]['friend_id'];
      
       
      $query1="select * from friends where friend_id=$frid";
      
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

	$gsb=$this->User_model->gsb($buyerIDs);  

	$lpdata=$this->User_model->lpdata($buyerIDs);  
	$po=$this->Feed_model->getPostData($userId);
	$pcount=count($po);	

	
	$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
	$this->load->view('feeds',array(  'suggest'=>$gsb,  "pdata"=>$pdata, "lpdata"=>$lpdata, "pcount"=>$pcount));
	}

	public function loadpost($f){ 
		
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$no = $_POST['getresult'];
		

		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
      	$totallikes=array();
      	$totalComments=array();
      	$post_by_user=array(); 
      	$pidar=array();$likeArr=array();
      	$checkFriendArray=array();
      	if($f==1){
			$z=$this->Feed_model->loadPostData($userId,$no);
		}
		if($f==2){
			$cat=$_POST["cat"];
			$z=$this->Feed_model->loadCatData($userId,$no,$cat);	
		}
		foreach ($z as $key => $value) {
			$pid=$value["post_id"];
			$post_user_id=$value["user_id"];
			$numLikes=$this->Feed_model->numlikes($pid);
			$numComments=$this->Feed_model->numComments($pid);
			$likedArr=$this->Feed_model->checkLiked($pid, $userId);	
			$checkFriend=$this->User_model->checkFriend($userId, $post_user_id);
	 		array_push($checkFriendArray, $checkFriend);

			array_push($totallikes, $numLikes);
			array_push($totalComments, $numComments);
			array_push($pidar, $pid);
			array_push($likeArr, $likedArr);
			
			$qry="select profile_pic,otp,active,name from users where id=$post_user_id";
			if($this->db->query($qry)){
				$pbu=$this->db->query($qry)->result_array();
				array_push($post_by_user, $pbu);
			}
		}

		$sb=array();
		$aa=array();
		$shared_by_user=array();
		
		for ($i=0; $i < count($pidar); $i++) { 
				
				$pid=$pidar[$i];
				
		
		$qry="select distinct spinned_by from spins where post_id=$pid";
			if($this->db->query($qry)->num_rows()>0	){
				$c=$this->db->query($qry)->num_rows();
				$sbu=$this->db->query($qry)->result_array();
				
				for ($j=0; $j < $c ; $j++) { 
						$spid=$sbu[$j]["spinned_by"];
						$q="select name from users where id=$spid";
						$ss=$this->db->query($q)->result_array();
						array_push($sb, $ss);
				}					
		}

		$shared_by_user=array_push($aa, $sb);
		$sb=array();	
		}
		
		$po=$this->Feed_model->getPostData($userId);	
		if($f==1){	
			$pcount=count($po);
		}
		if($f==2){
			$pcount=count($z);
		}

		$getFrnds=$this->User_model->getFriends($userId);
		$s=$this->User_model->getSuggestedUsers($userId);
		$byid=array();
		$buyerIDs=array();
		foreach ($getFrnds as $key => $vl) {
			array_push($byid, $vl["uid_1"]);
			array_push($byid, $getFrnds[$key]["uid_2"]);	
		}
 
		 $buyerIDs=array();
	
		 foreach ($s as $key => $value) {
		 	array_push($buyerIDs, $value["id"]);

		 }
		 if(count($byid)>0){
		 	for ($i=0; $i <count($byid) ; $i++) { 
		 		for ($j=0; $j <count($buyerIDs) ; $j++) { 	
		 			if($byid[$i]==$buyerIDs[$j]){
		 				$buyerIDs[$j]=0;
		 			}
		 		}
		 	}
		}	
		$gsb=$this->User_model->gsb($buyerIDs, 2);  
		$gsbcount=count($gsb);		 
		$ifad=$this->Feed_model->getIfad();
		$data=array("postdata"=>$z,
					"numLikes"=>$totallikes,
					"numComments"=>$totalComments,
					"post_by_user"=>$post_by_user,
					"share_info"=>$aa,
					"po"=>$po,
					"pcount"=>$pcount,
					"gsb"=>$gsb,
					"no"=>$no,
					"userId"=>$userId,
					"userData"=>$x,
					"ifad"=>$ifad,
					"likeArr"=>$likeArr,
					"checkFriendArray"=>$checkFriendArray
		);

		$resp=$this->load->view('posts',$data);
		if($resp==null){
			 return;
		}		
		echo json_encode($resp);
	}
	
	public function buyer_request(){
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$not=$this->User_model->friendNoti($userId);
		$friend_id_array=array();
		if(isset($_POST["view"]))
		{	
 		$output='';
 		if($_POST["view"] != '')
 		{
  			$update_query = "UPDATE friends SET view_status=1 WHERE view_status=0 and uid_2=$userId";
  			$this->db->query($update_query);		
  		}
		if($not){
		foreach ($not as $key => $value) {
			$friendId=$value["uid_1"];

	 	   	$FriendProflies["friends"][]=$this->User_model->FriendProflies($friendId);
	 	   	array_push($friend_id_array, $FriendProflies["friends"][$key][0]);
	 	}
	 	   
	 	  $output.='<span style="font-weight: bold; font-size: 11px;line-height:11px;"> Connect Requests  </span>
  <hr style="margin-top: 2px; margin-bottom: 3px;">';
	 	if(count($friend_id_array)>0){
	 	   foreach ($friend_id_array as $key => $value) {
	 	   		if($key < 5){
	 	   		  $fid=$value["id"];
	 	   		  $pic=$value["profile_pic"];
	 	   		    $otp=$value["otp"];
	 	   		  $name=str_replace(" ", "-", $value["name"]);
	 	     $output.=' <div style="border: 1px solid #ccc; margin-bottom: 3px; padding: 10px; float: left; width:94%;" class="frnd'.$key.'" > <a style="color:#006097;font-weight: 600;font-size: 13px;" href="'.base_url().'tuser/'.$otp.$fid.'/'.$name.'">
	 	     		<img src="'.base_url().$pic.'" class="pull-left" width="32px" heigh="32px">

	 	     		<span class="pull-left" style="height: 22px; line-height=22px;margin-left: 5px;">'.$value["name"].'</a></span>  <div style="width=40%;float: right;" >  <a href="#" class="cnfrm" onclick="confirm('.$fid.','.$userId.',1, '.$key.');" > Confirm </a> &nbsp;&nbsp; <a href="#"  onclick="confirm('.$fid.','.$userId.',0, '.$key.');" class="cncl" > Cancel </a>     </div> <div class="cl"> </div>  </div><div class="cl"> </div>'; 
	 	  		}

	 	  		

	 	   	}
	 	   }

	 	   if(count($not) > 5 ){
	 	  			$output.='<div> <p class="text-center"> <a style="color: #006097;" href="'.base_url().'Feeds/seemore/1"> See more </a>  </p>  </div>';
	 	  		}
					
	 	 
	
		}
		  else{
	 	   	$output.='<div style="border: 1px solid #ccc; margin-bottom: 3px; padding: 10px; float: left; width:94%;">
	 	   	No link up requests </div>';
	 	   }
		 $query_1 = "SELECT * FROM friends WHERE view_status=0 and uid_2=$userId";
 $result_1 = $this->db->query($query_1);
 $count =$result_1->num_rows();
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
		
	
	  }
	
}

	function time_elapsed_string($datetime, $full = false) {
	    $sql="select now() as now";
	    $now =$this->db->query($sql)->row()->now;
	    $now= new DateTime($now);
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);
	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7; 
	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }
	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	public function notification(){
	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		if(isset($_POST["view"]))
		{	
 		if($_POST["view"] != '')
 			{
  			$update_query ="UPDATE notifications SET view_status=1 WHERE view_status=0 and of=$userId";
  			$this->db->query($update_query);		
  	  		}
		}
		$username=$this->User_model->getUdata($userId);
		$username=$username[0]->name;
		$names=array();
		$types=array();
		$idarr=array();
  		$byuserArr=array();	
 		$byidArr=array(); 
 		$by_userArr=array(); 
 		$timeArr=array();
 		$notiIdArray=array();

		$a="select * from notifications where of=$userId order by time desc limit 10 ";
		$op=$this->db->query($a)->result_array();
		$b="select * from notifications where of=$userId order by time desc";
		$noti_count=$this->db->query($a)->num_rows();
		$ncount=$this->db->query($b)->num_rows();
		$output='<span style="font-weight: bold; font-size: 11px;"> Notifications  </span>
  		<hr style="margin-top: 2px; margin-bottom: 3px;"> ';
		foreach ($op as $key => $value) {      
			$notiId=$value["id"];
			$by_user=$value["by_user"];
			$type=$value["type"];
			$id=$value["post_id"];
			$time=$value["time"];
			if($id!=NULL){
			$ids=$this->Feed_model->landingPost($id);
				array_push($idarr, $ids);	
			}
			array_push($types, $type);
			array_push($timeArr, $time);
			array_push($notiIdArray, $notiId);
			$by_user=json_decode($by_user, TRUE);
			for ($y=0; $y <count($by_user) ; $y++) { 
				$by_userArr[$key][$y]=$by_user[$y]["id"];
			}	
		}
		$by_userArrF=array();
		foreach($by_userArr as $key => $by) {
				for ($i=0; $i < count($by_userArr[$key]); $i++) {
					if($by[$i]=="Admin"){ 
					}
					else{
					 $b=$this->User_model->getUdata($by[$i]);
					 array_push($byuserArr, $b);

					} 
				}
					array_push($by_userArrF, $byuserArr);
					$byuserArr=array();	
		}		
		$url="";
		for ($i=0; $i <$noti_count ; $i++) { 
			if(count($by_userArrF[$i])==1){
					$url='<a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'tuser/'.$by_userArrF[$i][0][0]->otp.$by_userArrF[$i][0][0]->id.'/'.str_replace(" ", "-", $by_userArrF[$i][0][0]->name).'>'. $by_userArrF[$i][0][0]->name.'</a>';
		}
		else if(count($by_userArrF[$i])==2){
				for ($j=0; $j< count($by_userArrF); $j++) { 
					if($j==0)
							$url='<a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'tuser/'.$by_userArrF[$i][$j][0]->otp.$by_userArrF[$i][$j][0]->id."/".str_replace(" ", "-",$by_userArrF[$i][$j][0]->name).'>'.$by_userArrF[$i][$j][0]->name.'</a>';
						if($j==1)
							$url.=' and <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'tuser/'.$by_userArrF[$i][$j][0]->otp.$by_userArrF[$i][$j][0]->id."/".str_replace(" ", "-",$by_userArrF[$i][$j][0]->name).'>'.$by_userArrF[$i][$j][0]->name.'</a>';
						}
					}
					else{
					 for ($k=0; $k< count($by_userArrF); $k++) { 
					 	$c=count($by_userArrF[$i])-2;
					   	if($k==0)
							$url='<a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'tuser/'.$by_userArrF[$i][$k][0]->otp.$by_userArrF[$i][$k][0]->id."/".str_replace(" ", "-",$by_userArrF[$i][$k][0]->name).'>'.$by_userArrF[$i][$k][0]->name.'</a>';
						 if($k==1)
							$url.=', <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'tuser/'.$by_userArrF[$i][$k][0]->otp.$by_userArrF[$i][$k][0]->id."/".str_replace(" ", "-",$by_userArrF[$i][$k][0]->name).'>'.$by_userArrF[$i][$k][0]->name.'</a>';
						
						if($k==2)
							$url.=' and <a style="color: #006097;font-weight: 400;line-height: 12px;" href="#" onclick="notification_by_users('.$op[$i]["id"].')"> '.$c.'</a> other ';
						}
					}
					
					

				if(isset($idarr[$i][0]->post_id)){
				$sd=$idarr[$i][0]->short_des;
				$sd=base64_encode($sd);
            	$sd=str_replace("/","-", $sd);
            	if($idarr[$i][0]->is_status==0){
            		$url1=base_url()."feeds/landing/".$idarr[$i][0]->post_title."/".$idarr[$i][0]->post_id; 
		            $url1=preg_replace('/\s+/', '-', $url1);
		            $url1=str_replace("?","-", $url1);
		            $url1=str_replace("!","-", $url1);
		            $url1=str_replace("#","-", $url1);
		            $url1=str_replace("%","-", $url1);
            	}
            	if($idarr[$i][0]->is_status==2){
				$url1=base_url()."Feeds/countClick/".$sd."/".$idarr[$i][0]->post_id."/".$idarr[$i][0]->user_id."/0";
				}
				$url2=base_url().'Feeds/editApproval/'.'/'.$idarr[$i][0]->post_id;
				$title=$idarr[$i][0]->post_title;
				$title2=$idarr[$i][0]->post_title;
				$len=strlen($idarr[$i][0]->post_title);
   			 	if($len>50 ){
     				 $title=mb_substr($idarr[$i][0]->post_title, 0, 30);
     				 $title.="...";
     			}
				
				}
				else{
					$url1="";
					$url2="";
				}
				$x=$this->time_elapsed_string($timeArr[$i]);
				if($types[$i]==1)
				{
					if(isset($idarr[$i][0]->is_status) && $idarr[$i][0]->is_status==1)
					{
						$id=$idarr[$i][0]->post_id;
						$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;line-height: 12px;margin: 0px; "> '.$url.'  likes your <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" href="'.base_url().'Comments/'.$id.'">statement </a>  '.$x.'</div>';
					}
					else{
				 	$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px; ">'.$url.' likes your post  <a style="color: #006097;font-weight: 400;line-height: 12px;" href="" target="_blank">   '.$title.' </a>  '.$x.' </div>';
				 	}
			 	}


				if($types[$i]==2)
				{
					if($idarr[$i][0]->is_status==1)
					{
						$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' spinned your   <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" onclick="'.base_url().'Comments/'.$id.'"> '.mb_substr($idarr[$i][0]->short_des,0,15).'.. </a>  '.$x.' </div>';
					}
					else{
					 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' spinned your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
					}
				}

				if($types[$i]==22)
				{
					if($idarr[$i][0]->is_status==1)
					{
						$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' promoted your   <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" onclick="'.base_url().'Comments/'.$id.'"> '.mb_substr($idarr[$i][0]->short_des,0,15).'.. </a>  '.$x.' </div>';
					}
					else{
					 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' promoted your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
					}
				}

				if($types[$i]==222)
				{
					
					 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' accepted your bid on <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
					
				}

				if($types[$i]==3)
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' accepted your link up request  '.$x.' </div>';
			if($types[$i]==4)
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' baught your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';

			if($types[$i]==5){
				$RejectUrl=base_url()."Feeds/reject_buy_request/".$idarr[$i][0]->post_id.'/'.$userId.'/'.$byuserArr[$i][0];
				$AcceptUrl=base_url()."Feeds/accept_buy_request/".$idarr[$i][0]->post_id.'/'.$userId.'/'.$byuserArr[$i][0];
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"><a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url.'>'.$names[$i]->name.'</a> wants to buy your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.'> '.$title.' </a><br> <span class="pull-right"> <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$AcceptUrl.'> Accept </a>  | <a style="color: #f00;font-weight: 400;line-height: 12px;" href='.$RejectUrl.'> Reject </a> </span><div class="cl"> </div>  '.$x.'  </div>';
			}


			if($types[$i]==6){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"><a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url.'>'.$names[$i]->name.'</a> rejected your baught request.  '.$x.'  </div>';
			}

			if($types[$i]==7){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"><a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url.'>'.$names[$i]->name.'</a> accepted your baught request.  '.$x.' </div>';
			}

			if($types[$i]==8){
			if(isset($idarr[$i][0]->is_status) && ($idarr[$i][0]->is_status==1 || $idarr[$i][0]->is_status==4))
			{
				$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' commented on your  <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" href="'.base_url().'Comments/'.$idarr[$i][0]->post_id.'"> '.mb_substr($idarr[$i][0]->short_des,0,15).'..  </a>  '.$x.' </div>';
			}
			else if( $idarr[$i][0]->is_status==2 ){
				$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' commented on your post <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" href="'.base_url().'Comments/'.$idarr[$i][0]->post_id.'"> '.$title.'</a>  '.$x.' </div>';
			}
			else{
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' commented on your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
			}
			}

			if($types[$i]==88){

				
			if(isset($idarr[$i][0]->is_status) && ($idarr[$i][0]->is_status==1 || $idarr[$i][0]->is_status==2 ||$idarr[$i][0]->is_status==4))
			{
				$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' replied on your  <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" href="'.base_url().'Comments/'.$idarr[$i][0]->post_id.'"> comment  </a>  '.$x.' </div>';
			}
			else{

			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' replied on your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> Comment </a>  '.$x.' </div>';
			}
			}

			if($types[$i]==9){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' needs your edit approval for his post <a style="color: #006097;font-weight: 400;line-height: 12px;" href="'.$url2.'">'.$title2.'</a> '.$x.'    </div>';
			}
			
			if($types[$i]==10){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;">Your Post <a style="color: #006097;font-weight: 400;line-height: 12px;" href="'.$url2.'">'.$title2.'</a> '.$x.'    </div>';
			}

			if($types[$i]==11){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;">Your Post <a style="color: #333;font-weight: 400;line-height: 12px;" href="#">'.$title2.'</a> has been marked as <span style="color: red;"> spam </span> '.$x.'   </div>';
			}

			if($types[$i]==12){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> We have sent You a message on mail. Please check '.$x.'   </div> ';
			}

			
		}
		
		if($ncount > 10){
				$output.='<div> <p class="text-center"> <a style="color: #006097;" href="'.base_url().'Feeds/seemore/2"> See more </a>  </p>  </div>';	
		}

		$query_1 = "SELECT * FROM notifications WHERE view_status=0 and by_user!=$userId and of=$userId";
		$result_1 = $this->db->query($query_1);
		$count =$result_1->num_rows();
		$data = array(
		  'notification'   => $output,
		  'unseen_notification' => $count
		);
		echo json_encode($data);	
		
}

	function notifier(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$id=$_POST["id"];
		$getNoti=$this->Feed_model->getNoti($id);
		$by_user=json_decode($getNoti->by_user);

		$view=$this->load->view("notifier", array("by_user"=>$by_user));
		echo json_encode($view);
	}
	
	function getBidCount(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		$getBidCount=$this->Feed_model->getBidCount($userId);

		echo $getBidCount;
	}

	function getPromoCount(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		$getPromoCount=$this->Feed_model->getPromoCount($userId);

		echo $getPromoCount;
	}

	function msgs(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 

  		$output="";

  		$output.='<span style="font-weight: bold; font-size: 11px;"> &nbsp; Messages  </span>
  			<hr style="margin-top: 2px; margin-bottom: 3px;background: #fff;height:1px;">';
  		$a="select distinct uid1 from chats where uid2=$userId order by time desc";
		$op=$this->db->query($a)->result();

		if(count($op) > 0){
		foreach ($op as $key => $value) {
			$uid1=$value->uid1;
			$sql="select * from chats where (uid1=$uid1 and uid2=$userId) or (uid2=$uid1 and uid1=$userId) order by time desc";
			$sql1="select * from chats where (uid1=$uid1 and uid2=$userId)  and read_status=0";
			if($this->db->query($sql1)->num_rows() > 0){

				$unc="(".$this->db->query($sql1)->num_rows().")";
			}
			else{
				$unc="";
			}
			$message=$this->db->query($sql)->row()->message;
			$rs=$this->db->query($sql)->row()->read_status;
			$sql="select * from users where id=$uid1";
			$name=$this->db->query($sql)->row()->name;
			$otp=$this->db->query($sql)->row()->otp;
			$img=$this->db->query($sql)->row()->profile_pic;
			
			if($rs==0){
				$message="<b>".$message."</b>";
			}
			else{
				$message="".$message."";
			}
	 	    $output.=' <div style="border-bottom: 1px solid #fff; margin-bottom: 1px; float: left; width:100%;">
	 	     <a style="pointer:cursor;color: #222" href="#" onclick="oneonone('.$userId.','.$uid1.', '."'$name'".', '."$otp".', '."'$img'".')" >
	 	     <div style="width: 100%; float: left;">
	 	     	<div style="width: 9%;margin-right:5px;margin-left:5px;float: left">
	 	     		<img src="'.base_url().$img.'" style="padding: 0px;height:100%; width:100%;margin-top:5px;"  class="pull-left" valign="middle">
	 	     	</div>
	 	     	<div style="width: 80%; float: left;margin: 0px;">
	 	     		<span style="font-size:12px;font-weight:700;pointer:cursor;">'.$name. $unc.'</span> <div class="cl"> </div> <div  > <p style="line-height:13px"> <small> '.$message.'   </small> </p> </div> <div class="cl"> </div>  </div><div class="cl">   </div></div> </a> </div>	
	 	     			'; 
	 	  		
	 	    }
	if(count($op) > 5 ){
		$output.='<div> <p class="text-center"> <a style="color: #006097;" href="'.base_url().'send/tvmessenger"> See more </a>  </p>  </div>';
	}
	}
	else{
	 	$output.='<div style="border: 1px solid #ccc; margin-bottom: 3px; padding: 10px; float: left; width:94%;">
	 	   	No messages </div>';
	}
		
 $count =$this->Feed_model->new_count_message($userId);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
		
	
	}

	function insertPost($data){
		if($this->db->insert('posts', $data))
      {
        return $this->db->insert_id();
      }
	}

	public function likePost($pid, $uid){
		$z=$this->Feed_model->getPostd($pid);
		$userId=$z->user_id;
		$like=$this->Feed_model->likePost($pid,$uid,$userId);
		if($like){
			$this->nlikes($pid);
		}
	}

	

    public function nlikes($pid){
		$x=$this->Feed_model->nlikes($pid); 
	}

	public function checklikes($pid, $uid){
		$x=$this->Feed_model->checklikes($pid, $uid); 
	}

	public function spinPost($pid, $uid){
		$z=$this->Feed_model->getPostd($pid);
		$userId=$z->user_id;
		$data=$z->shared_by;
		$udata=$this->User_model->getUdata($uid);
		$x=$this->Feed_model->spinPost($pid,$uid,$userId);

		if($x)
		{	

			$flag=1;
			$data=json_decode($data, TRUE);
            $i=count($data);

            if(count($data)!=0){
            foreach ($data as $key => $value) {
            	if($value["id"]==$uid || $userId==$uid){
            		$flag=0;
            	}
            }
        	}
        	
            if($flag!=0){
            $data[$i]["id"]=$uid;
            $data[$i]["name"]=$udata[0]->name;
            $data[$i]["otp"]=$udata[0]->otp;
            $data=json_encode($data);
			$update=$this->Feed_model->updatePostData($data,$pid);
			}
			echo 1;
		}
		else{
			echo 0;
		}

	}


	public function promotePost($pid, $uid){
		$z=$this->Feed_model->getPostd($pid);
		$userId=$z->user_id;
		$data=$z->shared_by;
		$udata=$this->User_model->getUdata($uid);
		$x=$this->Feed_model->promotePost($pid,$uid,$userId);
		if($x)
		{	
			$flag=1;
			$data=json_decode($data, TRUE);
            $i=count($data);

            if(count($data)!=0){
            foreach ($data as $key => $value) {
            	if($value["id"]==$uid || $userId==$uid){
            		$flag=0;
            	}
            }
        	}
            if($flag!=0){
            $data[$i]["id"]=$uid;
            $data[$i]["name"]=$udata[0]->name;
            $data[$i]["otp"]=$udata[0]->otp;
            $data=json_encode($data);
			$update=$this->Feed_model->updatePostData($data,$pid);
			}
			echo 1;
		}
		else{ 
			echo 0;
		}

	}

    public function nspins($pid){
		$x=$this->Feed_model->nspins($pid);
		
	}

	function spinners(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$pid=$_POST["pid"];
		$postData=$this->Feed_model->landingPost($pid);
		$shared_by=json_decode($postData[0]->shared_by);
		$view=$this->load->view("spinners", array("shared_by"=>$shared_by));
		echo json_encode($view);
	}

	public function delete_post($pid){
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->Feed_model->deletePost($pid);
		if($y)
		{	
			echo $y;
		}
		
	}

	public function delete_cmnt($pid){
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->Feed_model->delete_cmnt($pid);
		if($y)
		{	
			echo $y;
		}
		
	}

	  function hide_post(){
         if(!$this->session->userdata('email')){
         $this->session->set_flashdata('err', 'please login first');
         redirect("/");
      }
      
      $pid=$_POST["id"];
      
      $y=$this->User_model->getUserID($this->session->userdata('email'));
      $userId=$y->id;

      $check=$this->Feed_model->check_hidden($pid);

   

      if($check->hidden_by==NULL){
            $data=array(0=>array("id"=>$userId));
      $data= json_encode($data);
      $hide=$this->Feed_model->hide_post($pid,$data);
      if($hide){
         echo 1;

       }
      }

      else{
            $data=$check->hidden_by;
            
            $data=json_decode($data, TRUE);
            $i=count($data);
            $data[$i]["id"]=$userId;
            $data=json_encode($data);
            $hide=$this->Feed_model->hide_post($pid,$data);
      
            if($hide){
               echo 1;
            }

      }

      

   }

   function mark_spam(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$post_by=$_POST["uid"];
		$post_id=$_POST["pid"];
		$data=array("post_by"=>$post_by,
					"report_by"=>$userId,
					"post_id"=>$post_id,
					"type"=>1,
					"action"=>1);

		$checkCount=$this->Feed_model->checkCount($post_id);
		$c=0;
		if($checkCount==9){
			$c=1;
		}

		$x=$this->Feed_model->mark_spam($data);
		if($x){
			if($c==1){
			$y=$this->Feed_model->approveSpam($id);
			if($y){
				$noti=$this->Feed_model->insert_notification("Admin",$userId,11,$pid);
				
			}
			}
			$pid=$post_id;
			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$userId=$y->id;
			$check=$this->Feed_model->check_hidden($pid);
			if($check->hidden_by==NULL){
					$data=array(0=>array("id"=>$userId));
			$data= json_encode($data);
			$hide=$this->Feed_model->hide_post($pid,$data);
			if($hide){
				echo 1;
			 }
			}
			else{
				$data=$check->hidden_by;
				$data=json_decode($data, TRUE);
				$i=count($data);
				$data[$i]["id"]=$userId;
				$data=json_encode($data);
				$hide=$this->Feed_model->hide_post($pid,$data);
				if($hide){
					echo 1;
				}

			}	
			}
	}

	function painicPost($pid, $uid){
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
			}
		
		
		$x=$this->Feed_model->painicPost($pid, $uid);
		if($x){
			
			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$userId=$y->id;
			$check=$this->Feed_model->check_hidden($pid);
			if($check->hidden_by==NULL){
					$data=array(0=>array("id"=>$userId));
			$data= json_encode($data);
			$hide=$this->Feed_model->hide_post($pid,$data);
				if($hide){
					echo 1;
			 	}
			}	
		}
	}

	function promoteModal(){
		$id=$_POST["id"];
		$postdata=$this->Feed_model->landingPost($id);
		$view=$this->load->view("promoModal", array("postData"=>$postdata[0]));
		echo json_encode($view);
	}

	public function landing($title, $id){
		
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$postData=$this->Feed_model->landingPost($id);
		$cat=$postData[0]->cat;
		
		foreach ($postData as  $value) {
			$userId=$value->user_id;
			$pid=$value->post_id;
			$post_title=$value->post_title;
		}
	
		 if($postData){ 
		 	
		 	$opi=array();
		 	$totallikes=array();
		  	$post_by_user=array();
		  	$shared_by_user=array();
		foreach ($postData as $key => $value) {
			$pid=$value->post_id;
			$numLikes=$this->User_model->numlikes($pid);
			array_push($totallikes, $numLikes);

			$post_user_id=$value->user_id;
			$post_share_id=$value->share_id;
			$qry="select name from users where id=$post_user_id";
			if($this->db->query($qry)){
				$pbu=$this->db->query($qry)->result_array();
				array_push($post_by_user, $pbu);
			}

			$qry="select name from users where id=$post_share_id";
			if($this->db->query($qry)){
				$sbu=$this->db->query($qry)->result_array();
				array_push($shared_by_user, $sbu);
			}
			
		

	}
			

}
		else{
			$totallikes=NULL;
			$z=NULL;

		}


		
		$z=$this->User_model->getUdata($userId);
		$not=$this->User_model->friendNoti($userId);
		if($not){
		foreach ($not as $key => $value) {
			$friendId=$value["uid_1"];

	 	   $FriendProflies["friends"][]=$this->User_model->FriendProflies($friendId);
	 	   	

		}
	    }

	    else{
	    	$FriendProflies["friends"][]=NULL;
	    }
	     
	    	if (!$this->session->userdata('email')) {
	     		 
   			$string=exec('getmac');
			$mac=substr($string, 0, 17); 
			$byid= $mac;
	     	}

	     	else{
	   
	     	$byid=$x[0]->id;
	   
		}
	    if($this->session->userdata("email")){ 
	    	$check1=$this->User_model->getBalance($userId);
			$check2=$this->User_model->getTotalBids($userId);
			$totalMoney=$check1[0]["total"]; 
			$bidMoney=$check2->sum;

			$ch=$totalMoney-$bidMoney;

			if($ch>0){
				$check=1;
			}
			else{
				$check=0;
			}
		

	 $checkPromoted=$this->User_model->checkPromoted($x[0]->id, $pid);
	 $checkPromoPrivacy=$this->User_model->checkPromoPrivacy($userId);
	  $getDOB=$x[0]->dob;
	 
	 $curt=date("Y-m-d");
	 $age=$curt-$getDOB;


	 if($age >=16 && $age <=21)
	 	$age_grp=1;
	 else if($age >=21 && $age <=35)
	 	$age_grp=2;
	 else if($age >=35 && $age <=50)
	 	$age_grp=3;
	 else if($age >=50 && $age <=65)
	 	$age_grp=4;
	 else if($age >=65 )
	 	$age_grp=5;
	 else
	 	$age_grp="All";
	 
	$city=$x[0]->city;
	 $imp=0;
	 $click=0;
	 $fid=$postData[0]->user_id;
		$check=$this->User_model->check_friends($userId, $fid);
	}
		else{
		$check=NULL;
		$checkPromoted=NULL;
		$checkPromoPrivacy=NULL;
	}
	 $getRelated= $this->Feed_model->getRelated($cat, $pid);
		
	$likeArr=$this->Feed_model->checkLiked($pid, $userId);
	$numLikes=$this->User_model->numlikes($pid);
	 $this->load->view('includes/landing_header',array('data'=>$postData, "userData"=> $x,'noti' => $not,'friends'=>$FriendProflies['friends'], 'userId'=>$userId));

	 $this->load->view('landing',array('user'=>$z,'numLikes'=>$totallikes, 'post_by_user'=>$post_by_user, 'shared_by_user'=>$shared_by_user, "check" =>$check,"post_id"=>$pid,"checkPromoted"=>$checkPromoted, "checkPromoPrivacy"=>$checkPromoPrivacy, "getRelated"=>$getRelated, "check"=>$check, "likeArr"=>$likeArr, "numLikes"=>$numLikes));

	 $cname="sess".$pid;

	 $this->add_count($pid);

	}



	public function add_count($slug){
	    $this->load->helper('cookie');

        $check_visitor = $this->input->cookie($slug, FALSE);
      

        if(!$this->session->userdata('email')){
        	$uid = $_SERVER["REMOTE_ADDR"];
        }
        else
        {
        	$y=$this->User_model->getUserID($this->session->userdata('email'));
			$uid=$y->id;
        }
        
     	
          if($check_visitor == false) {

            $cookie = array("name" => "sess".$slug , "value" => "$uid", "expire" => time() + 60*60*24, "secure" => false);
            $this->input->set_cookie($cookie);
             if(!$this->session->userdata('email')){
            $this->User_model->update_counter($cookie,$slug);
        	}
        	else{
        		$this->User_model->update_counter($uid,$slug);
        	}
        }
    }

	function promotefeedsPost(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$pid=$_POST["pid"];
		$price=$_POST["price"];
		$posted_by=$_POST["posted_by"];
		$check1=$this->User_model->getBalance($posted_by);
		$check2=$this->User_model->getTotalBids($posted_by);
		$totalMoney=$check1[0]["total"]; 
		$bidMoney=$check2->sum;
		$ch=$totalMoney-$bidMoney;
		if($ch>0){
			$check=1;
		}
		else{
			$check=0;
		}

		$ct=$this->User_model->check_total_friends($userId);
		$checkPromoted=$this->User_model->checkPromoted($userId, $pid);
		$checkPromoPrivacy=$this->User_model->checkPromoPrivacy($posted_by);
		$checkPromoPrivacy=$checkPromoPrivacy->promoting;



		if($checkPromoted==0 && $check==1 && $checkPromoPrivacy==1 && $ct>=2)
		{
			$promo=$this->User_model->promotePost($pid,$price,$posted_by,$userId);
			if($promo){
				echo 1;
			}
		}
		else if($ct<2){
			echo 3;
		}
		else if($checkPromoted==1){
			echo 2;
		}
		else{
			echo 0;
		}
	}

	function promoModal(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		$pid=$_POST["pid"];
		$uid=$_POST["uid"];
		$postData=$this->User_model->landingPost($pid);
		$userData=$this->User_model->getUdata($uid);
		$get_links=$this->User_model->get_links($uid);
		$data=array("postData"=>$postData,
					"userData"=>$userData,
					"get_links"=>$get_links
					);
		echo json_encode($data);
	}

	public function promo_request(){

		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		
		$pdata=$this->User_model->privacyData($userId);
		
			$update_query = "UPDATE promo_requests SET view_status=1 WHERE view_status=0 and request_to=$userId";
  			$this->db->query($update_query);		
		
		    $not=$this->User_model->promoti($userId);
			$this->load->view('includes/header', array("userData"=>$x, "userId"=>$userId));
			$this->load->view("promoNoti", array("not"=>$not, "userId"=>$userId));	
	}	

	function getPromoReq($f){

			if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
				$this->session->set_flashdata('err', 'please login first');
				redirect("/");
			}

			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$userId=$y->id;
				$pid=$_POST["pid"];
				$req=$_POST["req"];
				$bid=$_POST["bid"];
				$status=$_POST["status"];
				$bidRate=array();
				$userdata=array();
				$userStatus=array();



				for($i=0; $i<count($req); $i++){
					$uid=$req[$i];	
					if($f==1)
					{ $checkUser=$this->User_model->checkUserPromotiStatus($pid,$uid, $userId); }
					if($f==2)
					{ $checkUser=$this->User_model->checkUserBidStatus($pid,$uid, $userId); }

					if($checkUser==1)
					{
						$z=$this->User_model->getUdata($uid);
						$get_activity=$this->User_model->get_activity($uid);
						$get_links=$this->User_model->get_links($uid);
						$d=array("link"=>$get_links, "activity"=>$get_activity);
						array_push($userdata, $z);
						array_push($bidRate, $bid[$i]);
						array_push($userStatus, $status[$i]);
					}
					else{
						$userdata=array();
						$bidRate=array();
						$userStatus=array();
					}
				}
			$data=array($userdata,$bidRate,$userStatus,$d );

				echo json_encode($data);

		}

	function setOwnBid(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$uid=$_POST["uid"];
		$pid=$_POST["pid"];
		$bid=$_POST["bid"];
			$check=$this->User_model->getBalance($uid);
		if($check[0]["total"] < $bidPrice){
			 echo 0;
		}
		else{
			$setOwnBid=$this->User_model->setOwnBid($userId, $uid, $pid, $bid);
			if($setOwnBid){
				echo $setOwnBid;
			}
		}
	}

	function acceptPromoReq(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$pid=$_POST["pid"];
		$uid=$_POST["uid"];
		$bidPrice=$_POST["bidPrice"];
		$checkPromo=$this->User_model->checkPromo($pid,$uid);
		$checkStatus=$this->User_model->checkStatus($pid,$uid);
		$err=0;
		if($checkStatus==1){
			$err=2;
		}
		$check=$this->User_model->getBalance($uid);
		if($check[0]["total"] < $bidPrice){
			$err=3;
		}
		if($err!=0){
			echo $err;
		}
		else{
			$sql="insert into wallet set user_id=$uid,post_id=$pid,incocming_balance=$bidPrice,source='Promotion'";
			$a=$this->db->query($sql);
			$sql="insert into wallet set user_id=$userId,post_id=$pid,outgoing=$bidPrice,source='Promotion'";
			$b=$this->db->query($sql);
			if($a && $b){
				$acceptPromo=$this->User_model->acceptPromo($pid, $uid, $bidPrice);
				if($acceptPromo){  
					$get_links=$this->User_model->get_links($uid);
					$tc=$get_links+1;
					$circulate=$this->User_model->circulate($pid,$userId ,$uid, $tc);
					$x=$this->spinPost($pid, $uid);
					if($x){
						echo 1;
					}
					else{
						echo 0;
					}
				}
			}
		}
	}


	function rejectPromoReq(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		$pid=$_POST["pid"];
		$uid=$_POST["uid"];
		
		$rejectPromo=$this->User_model->rejectPromo($pid, $uid);

		if($rejectPromo){
			echo 1;
		}
		else
			echo 0;
		}

	function bid_requests(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$not=$this->User_model->bidNoti($userId);

		$update_query = "UPDATE bidrequests SET view_status=1 WHERE view_status=0 and request_to=$userId";
		$this->db->query($update_query);	
		$this->load->view('includes/header', array("userData"=>$x, "userId"=>$userId));
		$this->load->view("bidNoti", array("not"=>$not));	
	}

	function acceptBidPrice(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;

		$pid=$_POST["pid"];
		$uid=$_POST["uid"];

		$bidPrice=$_POST["bidPrice"];
		$checkPromo=$this->User_model->checkPromo($pid,$userId);
		$checkStatus=$this->User_model->checkBidStatus($pid,$uid);
		$err=0;
		if($checkStatus==0){
			$err=2;
		}
		$check=$this->User_model->getBalance($uid);
		if($check[0]["total"] < $bidPrice){
			$err=3;
		}
		// if($err!=0){
		// 	echo $err;
		// }
		if($err!=0){
			echo $err;
		}

		else{
			$sql="insert into wallet set user_id=$userId,post_id=$pid,incocming_balance=$bidPrice,source='Promotion'";
			$a=$this->db->query($sql);

			$sql="insert into wallet set user_id=$uid,post_id=$pid,outgoing=$bidPrice,source='Promotion'";
			$b=$this->db->query($sql);

			if($a && $b){
				$acceptPromo=$this->User_model->acceptBids($pid, $uid, $bidPrice);
				$get_links=$this->User_model->get_links($userId);
				$tc=$get_links+1;
				// $circulate=$this->User_model->circulate($pid,$uid ,$userId, $tc);
				if($acceptPromo){
					 $q="insert into spins set post_id=$pid, spins=1, spinned_by=$uid";
		      	$y=$this->db->query($q);
		      	if($y){
		         $format=('Y-m-d H:i:s');
		         $d= date($format, strtotime("3 hours +30 minutes"));
		         $query="update posts set update_time='$d' where post_id=$pid";
		         $this->db->query($query);
		         if($uid!=$userId){
		         $spinNoti=$this->User_model->checkLinkup($userId);
		         if($spinNoti->spin_noti==1){        
		         $noti=$this->Feed_model->insert_notification($userId,$uid,22,$pid);
		         }
		        }
		        return 1;
      		}
				}
			}
		}
	}


	function countClick($url, $id, $uid, $Ad_id){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		
		$countClick=$this->User_model->countClick($userId,$id,$uid, 0);


		    $url=str_replace("-","/", $url);
			$url=base64_decode($url);
			header("location: $url");
	}

		public function dashboard(){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;	
		$x=$this->User_model->getUserData($this->session->userdata('email'));

		$wa=$this->User_model->wallAmount($userId);
		$ladd=$this->User_model->ladd($userId);
		$texp=$this->User_model->todayExp($userId);
		$totp=$this->User_model->totExp($userId);
		$trans=$this->User_model->trans($userId);	
		$q=$this->Feed_model->dpostdata($userId,2); 
		$totalPromo=$this->Feed_model->totalPromo($userId);
		$totalBonus=$this->Feed_model->totalBonus($userId);
		$viewEarning=$this->Feed_model->pearning($userId);
		$promoPosts=$this->Feed_model->getPromoPost($userId);
		$totalBalance=$this->User_model->getBalance($userId);
		$monthlyEarning=$this->User_model->monthlyEarning($userId);
		$debit=$this->User_model->debit($userId);
		$monthWiseEarning=json_encode($this->User_model->monthWiseEarning($userId));
		$monthWisePromoSpend=json_encode($this->User_model->monthWisePromoSpend($userId));
		$monthWisePromo=json_encode($this->User_model->monthWisePromo($userId));
		$weeklyPromo=json_encode($this->User_model->weeklyPromo($userId));
		$monthlyPromo=json_encode($this->User_model->monthlyPromo($userId));
		$weeklyViewE=json_encode($this->User_model->weeklyViewE($userId));
		$monthlyViewE=json_encode($this->User_model->monthlyViewE($userId));
		$monthWiseView=json_encode($this->User_model->monthWiseView($userId));
		$dailyPromo=json_encode($this->User_model->dailyPromo($userId)); 
		$dailyView=json_encode($this->User_model->dailyView($userId));
		$totalPromoSpend=$this->User_model->totalPromoSpend($userId);
		$monthlyPromoSpend=$this->User_model->monthlyPromoSpend($userId);
		$totalTime=$this->User_model->getToalTime($userId);
		$totalCirculation=$this->Feed_model->totalCirculation($userId);
		$promotedPost=$this->User_model->promotedPost($userId);
		$comissionPost=$this->User_model->comissionPost($userId);
		$totalComission=$this->User_model->totalComission($userId);
		$getSpamsByUser=$this->User_model->getSpamsByUser($userId); 
		$monthlyComission=json_encode($this->User_model->monthlyComissin($userId));
		$this->load->view('includes/header',array("userData"=> $x,'userId'=>$userId));
		$this->load->view('dashboard',array("userData"=> $x, "postData"=>$q,  "statement"=>$trans, "promoPosts"=>$promoPosts, "totalPromo"=>$totalPromo, "viewEarning"=>$viewEarning, "totalBalance"=>$totalBalance, "monthlyEarning"=>$monthlyEarning, "debit"=>$debit, "monthWiseEarning"=>$monthWiseEarning, "monthWisePromo"=>$monthWisePromo, "monthWiseView"=>$monthWiseView, "weeklyPromo"=>$weeklyPromo, "monthlyPromo"=>$monthlyPromo, "weeklyViewE"=>$weeklyViewE, "monthlyViewE"=>$monthlyViewE, "dailyPromo"=>$dailyPromo, "dailyView"=>$dailyView, "totalPromoSpend"=>$totalPromoSpend, "monthlyPromoSpend"=>$monthlyPromoSpend, "totalTime"=>$totalTime,"promotedPost"=>$promotedPost, "monthWisePromoSpend"=>$monthWisePromoSpend, "comissionPost"=>$comissionPost, "totalComission"=>$totalComission, "monthlyComission"=>$monthlyComission,"totalCirculation"=>$totalCirculation, "getSpamsByUser"=>$getSpamsByUser, "totalBonus"=>$totalBonus, "wa"=>$wa,"ladd"=>$ladd, "texp"=>$texp, "totp"=>$totp)); 
	}

	 function search_truevl(){

	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}	
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
	 	$input=$_POST["input"];

	 	$checkFriendArray=array();
	 	$data=$this->User_model->search_truevl($input, 0, $userId);
	 	foreach ($data as $key => $value) {
	 		$fid=$value->id;
 	 		$checkFriend=$this->User_model->checkFriend($userId, $fid);
	 		array_push($checkFriendArray, $checkFriend);
	 	}
	 	$view=$this->load->view("searchResult", array("data"=>$data, "f"=>$checkFriendArray, "userId"=>$userId, "input"=>$input));	
	 	echo json_encode($view);
	 }
 
	 function seeMoreSearch($input){
		
		if((!$this->session->userdata('email') && !$this->session->userdata('user_id'))|| !$input ){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}


		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$pdata=$this->User_model->privacyData($userId);
		$getFrnds=$this->User_model->getFriends($userId);
		$s=$this->User_model->getSuggestedUsers($userId);
		$byid=array();
		foreach ($getFrnds as $key => $vl) {
				array_push($byid, $vl["uid_1"]);
				array_push($byid, $getFrnds[$key]["uid_2"]);
		}
		$buyerIDs=array();
		 foreach ($s as $key => $value) {
		 	array_push($buyerIDs, $value["id"]);
		}
		if(count($byid)>0){
		 	for ($i=0; $i <count($byid) ; $i++) { 
		 		for ($j=0; $j <count($buyerIDs) ; $j++) { 
		 			
		 			if($byid[$i]==$buyerIDs[$j]){
		 				$buyerIDs[$j]=0;
		 			}
		 		}	
		 	}
		}

	  
			
		$gsb=$this->User_model->gsb($buyerIDs);  
		$lpdata=$this->User_model->lpdata($buyerIDs);  


		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view('seeMoreSearch',array("pdata"=>$pdata, "suggest"=>$gsb, "lpdata"=>$lpdata, "input"=>$input));
	} 

	function FriendAction(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$fid=$_POST['fid'];
		$id=$_POST['id'];
		$udata=$this->User_model->getUdata($fid);
		$checkStatus=$this->User_model->checkfrndStatus($id);
		$data=array_merge($udata, $checkStatus);
		echo json_encode($data);
	}

	function loadSearchResult($input){

		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$no=$_POST['getresult'];
		$checkFriendArray=array();
	 	$data=$this->User_model->search_truevl($input, $no, $userId);
	 	foreach ($data as $key => $value) {
	 		$fid=$value->id;
 	 		$checkFriend=$this->User_model->checkFriend($userId, $fid);
	 		array_push($checkFriendArray, $checkFriend);

	 	}



		$view=$this->load->view("loadmoreSearch", array("data"=>$data, "f"=>$checkFriendArray, "userId"=>$userId));

		echo json_encode($view);
	}

	 public function post_comment($id){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		} 
		$email=$this->session->userdata('email');
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
	 	$format=('Y-m-d H:i:s');

		$d= date($format, strtotime("3 hours +30 minutes"));
			$data=array(
						"replyId"=>$_POST["rid"],
						"post_id"=>$id,
						"comment"=>$_POST["content"],
						"comment_by"=>$email,
						"posted_on"=>$d,
						);
		$postData=$this->Feed_model->landingPost($id);
		$cmntShow=$postData[0]->cmnt_show;
		if($cmntShow==1){
		$x=$this->Feed_model->post_comment($data,$userId);
		$counterr=$_POST["counterr"];
		if($x){
			$sql="select * from comments where id=$x";
			$data=$this->db->query($sql)->row_array();
			$em=$data["comment_by"];
			$qry="select * from users where email='$em'";
			$comntr=$this->db->query($qry)->row_array();

			$view=$this->load->view("post_cmnt_view.php", array("data"=>$data, "comntr"=>$comntr, "id"=>$id, "counterr"=>$counterr,"userId"=>$userId));
			echo json_encode($view);
			}
		}
		if($cmntShow==0){
			echo '<div class="pcomments1" style="width: 100%;float: left;position:relative; margin-bottom: 10px;">
				<p style="background: #f5f5f5;color: #444;border: 1px solid #afafaf;width: 97%;padding: 3px;text-align: center; font-weight: bold;"> Comments are disabled on this post</p>
					</div>';
			}

		}
	
	






	// --------------------------------------//

	 public function user_comments(){
	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$id=$_POST["pid"];
		if(isset($_POST["key"]))
		{	$kkey=$_POST["key"]; }
		else{
			$kkey=1;
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$userId=$y->id; 
		$postData=$this->Feed_model->landingPost($id);
		$cmntShow=$postData[0]->cmnt_show;
		$comm=$this->Feed_model->getComments($id);
		$comcount=$this->Feed_model->getCommentsCount($id);
		if($cmntShow==1){
		$view=$this->load->view("user_cmnt_view", array("comm"=>$comm, "comcount"=>$comcount, "id"=>$id, "userId"=>$userId, "cmntShow"=>$cmntShow, "kkey"=>$kkey, "x"=>$x[0]));
		echo json_encode($view);

		}
		
			if($cmntShow==0){
			echo '<div class="pcomments1" style="width: 100%;float: left;position:relative; margin-bottom: 10px;">
				<p style="background: #f5f5f5;color: #444;border: 1px solid #afafaf;width: 97%;padding: 3px;text-align: center; font-weight: bold;"> Comments are disabled on this post</p>
					</div>';
			}
			
		

	}

		public function user_replies(){
	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$id=$_POST["rid"];
		$pid=$_POST["pid"];
		$output="";
		$comm=$this->Feed_model->getReplies($id);
		$comcount=$this->Feed_model->getRepliesCount($id);
		
		$postData=$this->Feed_model->landingPost($pid);
		$cmntShow=$postData[0]->cmnt_show;
		$comntr=array();
		$comcount=$this->Feed_model->getRepliesCount($id);
		$kkey=$_POST["kkey"];
		$uid=$_POST["uid"];
		$key=$_POST["key"];
		$unm=$_POST["unm"];
		$pp=$_POST["pp"];
		$r=1;
		if($cmntShow==1){
		$view=$this->load->view("user_cmnt_view", array("comm"=>$comm, "comcount"=>$comcount, "id"=>$id, "userId"=>$userId, "r"=>$r, "kkey"=>$kkey, "cmntShow"=>$cmntShow,"x"=>$x[0],"pid"=>$pid, "uid"=>$uid,"key"=>$key, "unm"=>$unm, "pp"=>$pp));
		echo json_encode($view);

		}
		else{
				echo "";
		}
		
	}

	 function edit_status($pid){

	 	$status_data=$this->Feed_model->status_data($pid);
	 	echo json_encode($status_data);	
	 }

	 function update_user_status($pid){
	 	$status=$_POST["status"];

	 	$x=$this->Feed_model->update_user_status($status, $pid);
	 	if($x){
	 		echo 1;
	 	}
	 }



	 public function load_prev(){

	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$output="";
		$id=$_POST["pid"];
		if(isset($_POST["count"])){
			$comm=$this->Feed_model->getComments($id,$_POST["count"]);
		}	
		else{
			$comm=$this->Feed_model->getComments($id,0);
		}
		$comntr=array();
		foreach ($comm as $key => $comment) {
			$em=$comment["comment_by"];
			$qry="select * from users where email='$em'";
			$ud=$this->db->query($qry)->result_array();
			array_push($comntr, $ud);

		}
		
			for ($i=0; $i <count($comm) ; $i++) { 
				
				$data[$i]=$comm[$i];
				$data[$i]["name"]=$comntr[$i][0]["name"];
				$data[$i]["img"]=$comntr[$i][0]["profile_pic"];
				
				$output.='<div style="width: 100%; background: #f5f5f5; float: left;margin-bottom: 10px;"><div style="width: 10%; float: left;margin-top: 10px;margin-left:10px; ">    <img src="'.base_url().$data[$i]["img"].'" width="80%" id="modal_img" style="border-radius: 50%;"> </div>   <div style="width: 80%;float: left;margin-top: 10px;margin-left:25px;"> <span style="color:#0089E1; font-size: 12px; font-weight: bold;">  '.$data[$i]["name"].'</span>  | <span style="color: #0089E1;font-size: 11px; " > '.$data[$i]["posted_on"].'  </span> <hr style="background: #000; color: #000;"> <p> '.$data[$i]["comment"].' </p>  </div> </div> <div class="cl"> </div></div>';
			}
			
			if(isset($data)){
					$data=array("output" => $output,
								"count" =>$comm[0]["count"] 
					);
				echo json_encode($data);
			}

	 }

	  public function load_newer(){

	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$output="";
		$id=$_POST["pid"];
		if(isset($_POST["count"])){
			$comm=$this->Feed_model->getnewComments($id,$_POST["count"]);
		}	
		else{
			$comm=$this->Feed_model->getnewComments($id,0);
		}
		$comntr=array();
		foreach ($comm as $key => $comment) {
			$em=$comment["comment_by"];
			$qry="select * from users where email='$em'";
			$ud=$this->db->query($qry)->result_array();
			array_push($comntr, $ud);

		}
		
			for ($i=0; $i <count($comm) ; $i++) { 
				
				$data[$i]=$comm[$i];
				$data[$i]["name"]=$comntr[$i][0]["name"];
				$data[$i]["img"]=$comntr[$i][0]["profile_pic"];
				
				$output.='<div style="width: 100%; background: #f5f5f5; float: left;margin-bottom: 10px;"><div style="width: 10%; float: left;margin-top: 10px;margin-left:10px; ">    <img src="'.base_url().$data[$i]["img"].'" width="80%" id="modal_img" style="border-radius: 50%;"> </div>   <div style="width: 80%;float: left;margin-top: 10px;margin-left:25px;"> <span style="color:#0089E1; font-size: 12px; font-weight: bold;">  '.$data[$i]["name"].'</span>  | <span style="color: #0089E1;font-size: 11px; " > '.$data[$i]["posted_on"].'  </span> <hr style="background: #000; color: #000;"> <p> '.$data[$i]["comment"].' </p>  </div> </div> <div class="cl"> </div></div>';
			}
			
			if(isset($data)){
					$data=array("output" => $output,
								"count" =>$comm[0]["count"] 
					);
				echo json_encode($data);
			}

		
 		
		
	 }

	function status_replies($pid){
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$postdata=$this->Feed_model->status_data($pid);
		$numLikes=$this->Feed_model->numlikes($pid);
		foreach ($numLikes as $key => $value) {
			$postdata->nlikes=$value["sum"];
		}
		
		
		echo json_encode($postdata);

	}

	function getPromotersList(){

		$pid=$_POST["id"];
		$list=$this->User_model->getPromotersList($pid);
		$view=$this->load->view('promotersList', array("list"=>$list));
		echo json_encode($view);
	}

	function stopPromotion(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$id=$_POST["id"];

		$stopPromotion=$this->User_model->stopPromotion($id);
		if($stopPromotion){
			echo 1;
		}
	}

	function startPromotion(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$id=$_POST["id"];

		$stopPromotion=$this->User_model->startPromotion($id);
		if($stopPromotion){
			echo 1;
		}
	}

	function Categories($cat){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;	
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$pdata=$this->User_model->privacyData($userId);
		$getFrnds=$this->User_model->getFriends($userId);
		$s=$this->User_model->getSuggestedUsers($userId);
		$byid=array();
		foreach ($getFrnds as $key => $vl) {
				array_push($byid, $vl["uid_1"]);	
				array_push($byid, $getFrnds[$key]["uid_2"]);	
		} 
		$buyerIDs=array();
		foreach ($s as $key => $value) {
		 	array_push($buyerIDs, $value["id"]);
		}
		if(count($byid)>0){
			
		 	for ($i=0; $i <count($byid) ; $i++) { 
		 	
		 		for ($j=0; $j <count($buyerIDs) ; $j++) { 
		 			
		 			if($byid[$i]==$buyerIDs[$j]){
		 				
		 				$buyerIDs[$j]=0;
		 				// echo 1;
		 				
		 			}


		 		}
		 		
		 	}
		}
		
	$frnds=$this->User_model->Friends($userId, 0);	
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
	$gsb=$this->User_model->gsb($buyerIDs);  
	$lpdata=$this->User_model->lpdata($buyerIDs);  
	$po=$this->Feed_model->getCatPostData($userId, $cat);
	$pcount=count($po);	
	
		$this->load->view("includes/header",array("userData"=> $x,  'userId'=>$userId));
		$this->load->view("Categories",array('suggest'=>$gsb,  "pdata"=>$pdata, "lpdata"=>$lpdata, "pcount"=>$pcount, "cat"=>$cat));
	}

	function seemoreFriends(){

		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id; 
		$pdata=$this->User_model->privacyData($userId);

		$getFrnds=$this->User_model->getFriends($userId);
		
		$s=$this->User_model->getSuggestedUsers($userId);
		

		$byid=array();
		
		foreach ($getFrnds as $key => $vl) {
			
				array_push($byid, $vl["uid_1"]);
			
				array_push($byid, $getFrnds[$key]["uid_2"]);
			
		}
		
		
		 $buyerIDs=array();
	
		 foreach ($s as $key => $value) {
		 	array_push($buyerIDs, $value["id"]);

		 }
		 	


		 if(count($byid)>0){
			
		 	for ($i=0; $i <count($byid) ; $i++) { 
		 	
		 		for ($j=0; $j <count($buyerIDs) ; $j++) { 
		 			
		 			if($byid[$i]==$buyerIDs[$j]){
		 				
		 				$buyerIDs[$j]=0;
		 				// echo 1;
		 				
		 			}


		 		}
		 		
		 	}
		}
 
	
			
		$gsb=$this->User_model->gsb($buyerIDs);  
		$lpdata=$this->User_model->lpdata($buyerIDs);  
		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view('friend_suggestions', array("pdata"=>$pdata, "suggest"=>$gsb, "lpdata"=>$lpdata));
		

	}

	function postLikes($pid){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;	
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$udataArr=array();
		$arr1=array();
		$z=$this->Feed_model->postLikes($pid);
		foreach ($z as $key => $value) {
			$uid=$value->liked_by;
			if($uid!=NULL){
				
				$fstatus=$this->User_model->check_friends($userId, $uid);
				array_push($arr1, $fstatus);
				
				$udata=$this->User_model->getUdata($uid);
				array_push($udataArr, $udata);
			}
		}
		
		$view=$this->load->view("postLikes", array("z"=>$udataArr, "z1"=>$arr1, "userId"=>$userId, "pid"=>$pid));
		echo json_encode($view); 
	}

	function seemore($f){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
			$x=$this->User_model->getUserData($this->session->userdata('email'));
			$y=$this->User_model->getUserID($this->session->userdata('email'));
			$userId=$y->id; 
			$this->load->view("includes/header", array("userId"=>$userId, "userData"=>$x));
				$pdata=$this->User_model->privacyData($userId);

		$getFrnds=$this->User_model->getFriends($userId);
		
		$s=$this->User_model->getSuggestedUsers($userId);
		

		$byid=array();
		
		foreach ($getFrnds as $key => $vl) {
			
				array_push($byid, $vl["uid_1"]);
			
				array_push($byid, $getFrnds[$key]["uid_2"]);
			
		}
		
		// print_r($byid);
		 $buyerIDs=array();
	
		 foreach ($s as $key => $value) {
		 	array_push($buyerIDs, $value["id"]);

		 }
		 	


		 if(count($byid)>0){
			
		 	for ($i=0; $i <count($byid) ; $i++) { 
		 	
		 		for ($j=0; $j <count($buyerIDs) ; $j++) { 
		 			
		 			if($byid[$i]==$buyerIDs[$j]){
		 				
		 				$buyerIDs[$j]=0;
		 				// echo 1;
		 				
		 			}


		 		}
		 		
		 	}
		}

	 
			 
		$gsb=$this->User_model->gsb($buyerIDs);  
		$lpdata=$this->User_model->lpdata($buyerIDs);  

		 	if($f==1){
				$this->load->view("seemore2",array("pdata"=>$pdata, "suggest"=>$gsb, "lpdata"=>$lpdata));
		 	 }
			if($f==2){
				$this->load->view("seemore1",array("pdata"=>$pdata, "suggest"=>$gsb, "lpdata"=>$lpdata));
			}		
	}

	function seemoreNotification(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		
		$no = $_POST['getresult'];

		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$username=$this->User_model->getUdata($userId);
		$username=$username[0]->name;
		$names=array();
		$types=array();
		$idarr=array();
  		$byuserArr=array();	
 		$byidArr=array();
 		$by_userArr=array();
 		$timeArr=array();
	
		$a="select * from notifications where of=$userId order by time desc  limit $no, 15";
		$op=$this->db->query($a)->result_array();
		$noti_count=$this->db->query($a)->num_rows();
		$output='<div style="background: #fff; padding: 15px;">';
  		

		foreach ($op as $key => $value) {
			$by_user=$value["by_user"];
			$type=$value["type"];
			$id=$value["post_id"];
			$time=$value["time"];
			
			
			if($id!=NULL){
			$ids=$this->Feed_model->landingPost($id);
				array_push($idarr, $ids);	
			}
			array_push($types, $type);
			array_push($timeArr, $time);
			$by_user=json_decode($by_user, TRUE);
			// print_r($by_user);
			// echo "<br>";
				for ($y=0; $y <count($by_user) ; $y++) { 
					
					$by_userArr[$key][$y]=$by_user[$y]["id"];
			}	
					

		}
		

		$by_userArrF=array();
		foreach($by_userArr as $key => $by) {
					
				for ($i=0; $i < count($by_userArr[$key]); $i++) { 
					 $b=$this->User_model->getUdata($by[$i]);

					 
					 array_push($byuserArr, $b);
				}
					array_push($by_userArrF, $byuserArr);
					$byuserArr=array();

			
				
		}
		
		
		for ($i=0; $i <$noti_count ; $i++) { 
			
			if(count($by_userArrF[$i])==1){
					$url='<a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'tuser/'.$by_userArrF[$i][0][0]->otp.$by_userArrF[$i][0][0]->id.'/'.str_replace(" ", "-", $by_userArrF[$i][0][0]->name).'>'. $by_userArrF[$i][0][0]->name.'</a>';
					}

			else if(count($by_userArrF[$i])==2){
				for ($j=0; $j< count($by_userArrF); $j++) { 
					if($j==0)
							$url='<a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'user/'.$by_userArrF[$i][$j][0]->otp.$by_userArrF[$i][$j][0]->id.str_replace(" ", "-",$by_userArrF[$i][$j][0]->name).'>'.$by_userArrF[$i][$j][0]->name.'</a>';
						if($j==1)
							$url.=' and <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'user/'.$by_userArrF[$i][$j][0]->otp.$by_userArrF[$i][$j][0]->id.str_replace(" ", "-",$by_userArrF[$i][$j][0]->name).'>'.$by_userArrF[$i][$j][0]->name.'</a>';
						}
					}
					else{
					 for ($k=0; $k< count($by_userArrF); $k++) { 
					 	$c=count($by_userArrF[$i])-2;
					   	if($k==0)
							$url='<a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'user/'.$by_userArrF[$i][$k][0]->otp.$by_userArrF[$i][$k][0]->id.str_replace(" ", "-",$by_userArrF[$i][$k][0]->name).'>'.$by_userArrF[$i][$k][0]->name.'</a>';
						 if($k==1)
							$url.=', <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.base_url().'user/'.$by_userArrF[$i][$k][0]->otp.$by_userArrF[$i][$k][0]->id.str_replace(" ", "-",$by_userArrF[$i][$k][0]->name).'>'.$by_userArrF[$i][$k][0]->name.'</a>';
						
						if($k==2)
							$url.=' and <a style="color: #006097;font-weight: 400;line-height: 12px;" href="#" onclick="notification_by_users('.$op[$i]["id"].')" >'.$c.'</a> other ';
						}
					}
					

				if(isset($idarr[$i][0]->post_id)){
				$sd=$idarr[$i][0]->short_des;
				$sd=base64_encode($sd);
            	$sd=str_replace("/","-", $sd);
				$url1=base_url()."Feeds/countClick/".$sd."/".$idarr[$i][0]->post_id."/".$idarr[$i][0]->user_id."/0";
				$title=$idarr[$i][0]->post_title;
				$len=strlen($idarr[$i][0]->post_title);
   			 	if($len>50 ){
     				 $title=mb_substr($idarr[$i][0]->post_title, 0, 30);
     				 $title.="...";
     			}
				 $url1= preg_replace('/\s+/', '-', $url1);
				
				}
				else{
					$url1="";
				}


				$notiTime=new DateTime($timeArr[$i]);
			
				$date = $notiTime->format('Ymd');
				$timeH=$notiTime->format('h');
				$timeM=$notiTime->format('i');
				$dateNow=date("Ymd");
				$timeHNow=date("h", strtotime("3 hours"));
				$timeMNow=date("i", strtotime("30 minutes"));
			
				if($dateNow==$date){
					if($timeH==$timeHNow){
						$x=$timeMNow-$timeM;
						$x.=" minuites ago";
					}
					else{
						$x=$timeHNow-$timeH;
						$x.=" hours ago";
					}
				}

				else{
					$x=$dateNow-$date;
					if($x==1){
						$x= "Yesterday";
					}
					else{
					  $x.=" days ago";
					}
				}

				
				if($types[$i]==1)
				{
					if(isset($idarr[$i][0]->is_status) && $idarr[$i][0]->is_status==1)
					{
						$id=$idarr[$i][0]->post_id;
						$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;line-height: 12px;margin: 0px; "> '.$url.'  likes your <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" onclick="'.base_url().'Comments/'.$id.'">statement </a>  '.$x.'</div>';
					}
					else{
				 	$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px; ">'.$url.' likes your post  <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank">   '.$title.' </a>  '.$x.' </div>';
				 	}
			 	}


				if($types[$i]==2)
				{
					if($idarr[$i][0]->is_status==1)
					{
						$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' spinned your   <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" onclick="'.base_url().'Comments/'.$id.'"> statement </a>  '.$x.' </div>';
					}
					else{
					 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' spinned your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
					}
				}

				if($types[$i]==22)
				{
					if($idarr[$i][0]->is_status==1)
					{
						$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' promoted your   <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" onclick="'.base_url().'Comments/'.$id.'"> statement </a>  '.$x.' </div>';
					}
					else{
					 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' promoted your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
					}
				}

				if($types[$i]==222)
				{
					
					 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;"> '.$url.' accepted your bid on <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
					
				}

				if($types[$i]==3)
			 $output.='<div style="border-bottom: 1px solid #ccc; padding:10px 5px;font-size:12px;"> '.$url.' accepted your friend request  '.$x.' </div>';
			if($types[$i]==4)
			 $output.='<div style="border-bottom: 1px solid #ccc; padding:10px 5px;font-size:12px;"> '.$url.' baught your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.'> '.$title.' </a>  '.$x.' </div>';

			if($types[$i]==5){
				$RejectUrl=base_url()."timeline/reject_buy_request/".$idarr[$i][0]->post_id.'/'.$userId.'/'.$by_userArrF[$i][0][0]->id;
				$AcceptUrl=base_url()."timeline/accept_buy_request/".$idarr[$i][0]->post_id.'/'.$userId.'/'.$by_userArrF[$i][0][0]->id;

				echo $url;

			 $output.='<div style="border-bottom: 1px solid #ccc; padding:10px 5px;font-size:12px;margin: 0px;"><a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url.'>'.$names[$i]->name.'</a> wants to buy your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.'> '.$title.' </a><br> <span class="pull-right"> <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$AcceptUrl.'> Accept </a>  | <a style="color: #f00;font-weight: 400;line-height: 12px;" href='.$RejectUrl.'> Reject </a> </span><div class="cl"> </div>  '.$x.'  </div>';
			}


			if($types[$i]==6){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding:10px 5px;font-size:12px;margin: 0px;"><a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url.'>'.$names[$i]->name.'</a> rejected your baught request.  '.$x.'  </div>';
			}

			if($types[$i]==7){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding:10px 5px;font-size:12px;margin: 0px;"><a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url.'>'.$names[$i]->name.'</a> accepted your baught request.  '.$x.' </div>';
			}

			if($types[$i]==8){
			if(isset($idarr[$i][0]->is_status) && ($idarr[$i][0]->is_status==1 || $idarr[$i][0]->is_status==4 || $idarr[$i][0]->is_status==2 ))
			{
				$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' commented on your  <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" href="'.base_url().'Comments/'.$idarr[$i][0]->post_id.'">Statement  </a>  '.$x.' </div>';
			}
			else{

			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' commented on your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
			}
			}

			if($types[$i]==88){

				
			if(isset($idarr[$i][0]->is_status) && ($idarr[$i][0]->is_status==1 || $idarr[$i][0]->is_status==2 ||$idarr[$i][0]->is_status==4))
			{
				$output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' replied on your  <a style="color: #006097;font-weight: 400;cursor:pointer;line-height: 12px;" href="'.base_url().'Comments/'.$idarr[$i][0]->post_id.'">Statement  </a>  '.$x.' </div>';
			}
			else{

			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' replied on your post <a style="color: #006097;font-weight: 400;line-height: 12px;" href='.$url1.' target="_blank"> '.$title.' </a>  '.$x.' </div>';
			}
			}
			if($types[$i]==9){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> '.$url.' needs your edit approval for his post <a style="color: #006097;font-weight: 400;line-height: 12px;" href="'.$url2.'">'.$title2.'</a> '.$x.'    </div>';
			}
			
			if($types[$i]==10){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;">Your Post <a style="color: #006097;font-weight: 400;line-height: 12px;" href="'.$url2.'">'.$title2.'</a> '.$x.'    </div>';
			}

			if($types[$i]==11){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;">Your Post <a style="color: #333;font-weight: 400;line-height: 12px;" href="#">'.$title2.'</a> has been marked as <span style="color: red;"> spam </span> '.$x.'   </div>';
			}

			if($types[$i]==12){
			
			 $output.='<div style="border-bottom: 1px solid #ccc; padding: 5px;font-size:12px;margin: 0px;"> We have sent You a message on mail. Please check '.$x.'   </div> ';
			}	
			
		
		}
 echo $output;	
	}

	function seemoreFriend(){

		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		
		$no = $_POST['getresult'];
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$not=$this->User_model->friendNotiLoad($userId, $no);
		$friend_id_array=array();
		if($not){
		foreach ($not as $key => $value) {
			$friendId=$value["uid_1"];

	 	   	$FriendProflies["friends"][]=$this->User_model->FriendProflies($friendId);
	 	   	array_push($friend_id_array, $FriendProflies["friends"][$key][0]);
	 	}
	 	   
	 	  $output='<div style="background: #fff;">';
	 	if(count($friend_id_array)>0){
	 	   foreach ($friend_id_array as $key => $value) {
	 	   	
	 	   		  $fid=$value["id"];
	 	   		  $pic=$value["profile_pic"];
	 	   		  $otp=$value["otp"];
	 	   		  $name=str_replace(" ", "-", $value["name"]);
	 	       $output.=' <div style="border: 1px solid #ccc; margin-bottom: 3px; padding: 10px; float: left; width:94%;"> <a style="font-size: 13px;" href="'.base_url().'tuser/'.$otp.$fid.'/'.$name.'">  <img src="'.base_url().$pic.'" class="pull-left" height="36px" width="36px"> <span class="pull-left" style="height: 22px; line-height=22px;margin-left:5px;font-weight:600"> '.$value["name"].'</a></span>  <div style="width=40%;float: right;" >  <a href="#" class="cnfrm" onclick="confirm('.$fid.','.$userId.',1);" > Confirm </a> &nbsp;&nbsp; <a href="#"  onclick="confirm('.$fid.','.$userId.',0);" class="cncl" > Cancel </a>     </div> <div class="cl"> </div>  </div><div class="cl"> </div>'; 

	 	   		

	 	  		

	 	   	}
	 	   }

	 	   echo $output;

	} 
	}

	function Comments($pid){
		if(!$this->session->userdata('email') && !$this->session->userdata('user_id')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;	
		$lp=$this->Feed_model->landingPost($pid);
		$uid=$lp[0]->user_id;
		$likeArr=$this->Feed_model->checkLiked($pid, $userId);
		$z=$this->User_model->getUdata($uid);
		$numLikes=$this->User_model->numlikes($pid);
		$numComments=$this->Feed_model->numComments($pid);
		$check=$this->User_model->check_friends($userId, $uid);	
		$pdata=$this->User_model->privacyData($userId);
		$getFrnds=$this->User_model->getFriends($userId);
		$s=$this->User_model->getSuggestedUsers($userId);
		$byid=array();
		foreach ($getFrnds as $key => $vl) {
				array_push($byid, $vl["uid_1"]);	
				array_push($byid, $getFrnds[$key]["uid_2"]);	
		} 
		$buyerIDs=array();
		foreach ($s as $key => $value) {
		 	array_push($buyerIDs, $value["id"]);
		}
		if(count($byid)>0){
			
		 	for ($i=0; $i <count($byid) ; $i++) { 
		 	
		 		for ($j=0; $j <count($buyerIDs) ; $j++) { 
		 			
		 			if($byid[$i]==$buyerIDs[$j]){
		 				
		 				$buyerIDs[$j]=0;
		 				// echo 1;
		 				
		 			}


		 		}
		 		
		 	}
		}
		
	$frnds=$this->User_model->Friends($userId, 0);	
    $data=array();
    $buyerNumber=array();
    for($i=0; $i<count($frnds); $i++)
    {
      
      $frid=$frnds[$i]['friend_id'];
      
       
      $query1="select * from friends where friend_id=$frid";
      
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
	$gsb=$this->User_model->gsb($buyerIDs);  
	$lpdata=$this->User_model->lpdata($buyerIDs);
		$this->load->view("includes/header", array("userData"=>$x, "userId"=>$userId));
		$this->load->view("status_comments", array("pid"=>$pid, "uid"=>$uid, "post_by_user"=>$z[0], "x"=>$x, "lp"=>$lp, "numLikes"=>$numLikes,"numComments"=>$numComments, "likeArr"=>$likeArr, "userId"=>$userId, 'suggest'=>$gsb,  "pdata"=>$pdata, "lpdata"=>$lpdata, "check"=>$check ));	
	}

	function updateCmnt(){
		$x=$this->Feed_model->updateCmnt($_POST);
		if($x){
			echo 1;
		}
	}

	function editPost(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;  
		$z=$this->Feed_model->editPost($_POST['content'], $_POST["pid"]);

		if($z){
			echo $_POST['content'];
		}
	}

	function disableComments($pid){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$x=$this->Feed_model->disableComments($pid);
		echo 1;
	}

	public function enableComments(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->Feed_model->enableComments($_POST['pid']);
		echo 1;		
	}


	public function view_post(){ 
			$pid=$_POST["id"];
			// 0=$_POST["Ad_id"];
			// $imp=$_POST["imp"];
			$m=0;
			if (!$this->session->userdata('email')) {
	     		$cname="sess".$pid;
	     		if($this->input->cookie($cname, TRUE)){
	     			$byid=$this->input->cookie($cname, TRUE);
	     		}
	     	}
			     
	     	else
	     	{
	     		$x=$this->User_model->getUserData($this->session->userdata('email'));
	     		foreach ($x as $key => $ui) {
	     		$byid=$ui->id;
	     		}
	     	}
	    
			$qry="select * from post_views where post_id=$pid and viewed_by='$byid' order by viewed_at desc";
			$check=$this->db->query($qry);  
			if($this->db->query($qry)->num_rows()>0){


			$row=$check->result_array();
		
			$date = new DateTime($row[0]["viewed_at"]);
			$result = $date->format('Ymd');
			$currentTime=date("Ymd");
			$ft=$currentTime-$result;
			
			
			if($ft!=0){	

				$curt="select now() as time";
				$curt=$this->db->query($curt)->row()->time;
				$sql="insert into post_views set post_id=$pid, viewed_by='$byid', viewed_at='$curt', ad_id=0, ad_price=$m";
   				$x=$this->db->query($sql);

   				if($x){
   					$sql="select post_views.post_id, baught_by, count(baught_post.post_id) as count, sum(ad_price) as sum from baught_post, post_views where time<='$curt' and viewed_at='$curt' and baught_post.post_id=post_views.post_id group by baught_post.baught_by order by time desc";
   					$count=$this->db->query($sql)->num_rows();
   					if($count > 0){
   						$data=$this->db->query($sql)->result_array();
   						$uidarr=array();
   					   	$countarr=array();
   					   	$sumarr=array();
   					   	$buyarr=array();
   					   	foreach ($data as $key => $postdata) {
   					  		$poid=$postdata["post_id"];
   					  		$pcount=$postdata["count"];
   					  		$psum=$postdata["sum"];
   					  		$buyid=$postdata["baught_by"];
   					  		$sql="select user_id from posts where post_id=$poid";
   					  		$users=$this->db->query($sql)->result_array();

   					  		array_push($uidarr,$users);
							array_push($countarr, $pcount);
							array_push($sumarr, $psum);   	
							array_push($buyarr, $buyid);				  		

   					   }

   					   for ($i=0; $i < 1 ; $i++) { 
   					 		$ib=(float)$sumarr[0]/(count($countarr)+1);
   					 		$uid=$uidarr[$i][0]["user_id"];
   					 		$curt="select now() as time";
							$time=$this->db->query($curt)->row()->time;
   					 		$sql="insert into wallet set user_id=$uid, post_id=$pid, incocming_balance=$ib, outgoing=0, time='$time',source='view'";
   					 		if($this->db->query($sql)){
   					 			echo 1;
   					 		}
   					 		for ($j=0; $j <count($buyarr); $j++) { 
   					 			$bid=$buyarr[$j];
   					 			$sql="insert into wallet set user_id=$bid, post_id=$pid, incocming_balance=$ib, outgoing=0, time='$time',source='view'";
   					 		if($this->db->query($sql)){
   					 			echo 1;
   					 		}
   					 		}
   					 	}
   					 
   					 }

   				else{
   			
   					   $sql="SELECT post_id, count(`post_id`) as count ,sum(`ad_price`) as sum from post_views where viewed_at='$curt' group by post_id";
   					   $data=$this->db->query($sql)->result_array();
   					   $uidarr=array();
   					   $countarr=array();
   					   $sumarr=array();
   					   foreach ($data as $key => $postdata) {
   					  		$poid=$postdata["post_id"];
   					  		$pcount=$postdata["count"];
   					  		$psum=$postdata["sum"];
   					  		$sql="select user_id from posts where post_id=$poid";
   					  		$users=$this->db->query($sql)->result_array();

   					  		array_push($uidarr,$users);
							array_push($countarr, $pcount);
							array_push($sumarr, $psum);   					  		

   					   }

   				
   					 	for ($i=0; $i < 1 ; $i++) { 
   					 		$ib=(float)$sumarr[$i]/$countarr[$i];
   					 		$uid=$uidarr[0][$i]["user_id"];
   					 		$curt="select now() as time";
							$time=$this->db->query($curt)->row()->time;
   					 		$sql="insert into wallet set user_id=$uid, post_id=$pid, incocming_balance=$ib, outgoing=0, time='$time',source='view'";
   					 		if($this->db->query($sql)){
   					 			echo 1;
   					 		}
   					 	}
   					}
   				
   				}
   		}
   	}
		else{
   				$curt="select now() as time";
				$curt=$this->db->query($curt)->row()->time;
				$sql="insert into post_views set post_id=$pid, viewed_by='$byid', viewed_at='$curt', ad_id=0, ad_price=$m";
   				$x=$this->db->query($sql);

   				if($x){
   					$sql="select post_views.post_id, baught_by, count(baught_post.post_id) as count, sum(ad_price) as sum from baught_post, post_views where time<='$curt' and viewed_at='$curt' and baught_post.post_id=post_views.post_id group by baught_post.baught_by order by time desc";
   					$count=$this->db->query($sql)->num_rows();
   					if($count > 0){
   						$data=$this->db->query($sql)->result_array();
   						$uidarr=array();
   					   	$countarr=array();
   					   	$sumarr=array();
   					   	$buyarr=array();
   					   	foreach ($data as $key => $postdata) {
   					  		$poid=$postdata["post_id"];
   					  		$pcount=$postdata["count"];
   					  		$psum=$postdata["sum"];
   					  		$buyid=$postdata["baught_by"];
   					  		$sql="select user_id from posts where post_id=$poid";
   					  		$users=$this->db->query($sql)->result_array();

   					  		array_push($uidarr,$users);
							array_push($countarr, $pcount);
							array_push($sumarr, $psum);   	
							array_push($buyarr, $buyid);				  		

   					   }

   					   


   					   for ($i=0; $i < 1; $i++) { 
   					 		$ib=(float)$sumarr[0]/(count($countarr)+1);
   					 		$uid=$uidarr[$i][0]["user_id"];
   					 		$curt="select now() as time";
							$time=$this->db->query($curt)->row()->time;
   					 		$sql="insert into wallet set user_id=$uid, post_id=$pid, incocming_balance=$ib, outgoing=0, time='$time',source='view'";
   					 		if($this->db->query($sql)){
   					 			echo 1;
   					 		}
   					 		for ($j=0; $j <count($buyarr); $j++) { 
   					 			$bid=$buyarr[$j];
   					 			$sql="insert into wallet set user_id=$bid, post_id=$pid, incocming_balance=$ib, outgoing=0, time='$time',source='view'";
   					 		if($this->db->query($sql)){
   					 			echo 1;
   					 		}
   					 		}
   					 	}

   					
   					}
   					else{
   					   $sql="SELECT post_id, count(`post_id`) as count ,sum(`ad_price`) as sum from post_views where viewed_at='$curt' group by post_id";
   					   $data=$this->db->query($sql)->result_array();
   					   $uidarr=array();
   					   $countarr=array();
   					   $sumarr=array();
   					   foreach ($data as $key => $postdata) {
   					  		$poid=$postdata["post_id"];
   					  		$pcount=$postdata["count"];
   					  		$psum=$postdata["sum"];
   					  		$sql="select user_id from posts where post_id=$poid";
   					  		$users=$this->db->query($sql)->result_array();

   					  		array_push($uidarr,$users);
							array_push($countarr, $pcount);
							array_push($sumarr, $psum);   					  		

   					   }

   					

   					 	for ($i=0; $i < 1 ; $i++) { 
   					 		$ib=(float)$sumarr[$i]/$countarr[$i];
   					 		$uid=$uidarr[0][$i]["user_id"];
   					 		$curt="select now() as time";
							$time=$this->db->query($curt)->row()->time;
   					 		$sql="insert into wallet set user_id=$uid, post_id=$pid, incocming_balance=$ib, outgoing=0, time='$time',source='view'";
   					 		if($this->db->query($sql)){
   					 			echo 1;
   					 		}
   					 	}
   					}
   				
   				}
   		}
		}	

		public function distribute(){
		  $spams=array();
		  $getViews=$this->User_model->getViews();
		  $c=0;
		  foreach ($getViews as $key => $value) {
		  		$count=$value->count;
		  		$pid=$value->post_id;
		  		if($count>= 1){
		  			$getSpams=$this->User_model->getSpams($pid);
		  			array_push($spams, $getSpams);
		  			
		  		}
		  }

		  // print_r($getViews);
		  // echo "<br>";
		  // echo "<br>";
		  // echo "<br>";
		  // print_r($spams);

		  $TodayBalance=$this->User_model->getTodayBalance();
		 	

		  foreach ($getViews as $key => $value) {
		  	if($value->count >=2 && $spams[$key] <1){
		  		$count=$value->count;
		  		$tcount=floor($count/2);
		  		$c=$c+$tcount;
		  		
		  	}
		  }
		  
		  $perHead=$TodayBalance/$c;

		  foreach ($getViews as $key => $value) {
		  	if($value->count >=2 && $spams[$key] < 1){
		  		$pid=$value->post_id;
		  		$count=$value->count;
		  		$tcount=floor($count/2);
		  		$amount=$perHead*$tcount;
		  		$getId=$this->Feed_model->landingPost($pid);
		  		$uid=$getId[0]->user_id;

		  		$updatewallet="insert into wallet set user_id=$uid, post_id=$pid, incocming_balance=$amount, source='Bonus'";

		  		$this->db->query($updatewallet);

		  	}
		  }
		}

	public function notification_by_users(){
		$notiId=$_POST["notiId"];
		$getNotifiers=$this->User_model->getNotifiers($notiId);
		$byUsers=json_decode($getNotifiers->by_user);
		$userArr=array();
		foreach ($byUsers as $key => $value) {
			$uid=$value->id;
			$b=$this->User_model->getUdata($uid);
			array_push($userArr, $b);
		}
		
		$view=$this->load->view("notification_by_users", array("userArr"=>$userArr));

		echo json_encode($view);
	}

	public function Likes($pid){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;	
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$udataArr=array();
		$arr1=array();
		$z=$this->Feed_model->postLikes($pid);
		foreach ($z as $key => $value) {
			$uid=$value->liked_by;
			if($uid!=NULL){
				
				$fstatus=$this->User_model->check_friends($userId, $uid);
				array_push($arr1, $fstatus);
				
				$udata=$this->User_model->getUdata($uid);
				array_push($udataArr, $udata);
			}
		}
		
		$this->load->view("includes/header", array("userData"=>$x, "userId"=>$userId));
		$this->load->view("AllpostLikes", array("z"=>$udataArr, "z1"=>$arr1, "userId"=>$userId));

	
	}	
		
}
