<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Feed_model extends CI_Model {

		function getPostData($userId){

		$query="SELECT * FROM friends WHERE (uid_1 =$userId AND STATUS =1)  OR (uid_2 =$userId AND STATUS =1)  ";

 		if($this->db->query($query)){
 			$n= $this->db->query($query)->num_rows();
 		}
		
   		if($n>0)
   		{
      
      $data=array();
			$idarr=array();
			$idarr1=array();
			$fidarr=array();
			$t=array();
			$arr=array();
			$query="select * from posts where user_id=$userId order by update_time desc ";
   			$x=$this->db->query($query)->result_array();
   			foreach ($x as $key => $value) {
   				array_push($idarr, $value["post_id"]);
   				array_push($t, $value["update_time"]);
   			}

   			$query="select * from friends where (uid_1=$userId and status=1) or  (uid_2=$userId and status=1)";
   			$x=$this->db->query($query)->result_array();
   			foreach ($x as $key => $value) {
   				if($value["uid_1"]==$userId)
   					array_push($fidarr, $value["uid_2"]);
   				if($value["uid_2"]==$userId)
   					array_push($fidarr, $value["uid_1"]);
   			}		

   			foreach ($fidarr as $key => $value) {
   				$id=$value;
   				$query="select * from posts where user_id=$id order by update_time desc";
   				$x=$this->db->query($query)->result_array();
   				foreach ($x as $key => $val) {
   				array_push($idarr, $val["post_id"]);
   				array_push($t, $val["update_time"]);
   				}
          $query1="select * from spins where spinned_by=$id order by update_time desc  ";
          $x1=$this->db->query($query1)->result_array();
          foreach ($x1 as $key => $val1) {
          array_push($idarr, $val1["post_id"]);
          array_push($t, $val1["update_time"]);
          }
   			}
   			    $arr=array("pid"=>$idarr,
   						     "time"=>$t);
   		      $n=count($arr["pid"]);


   		    for ($i=0; $i <$n ; $i++) { 
   		    	for ($j=$i+1; $j < $n ; $j++) { 
   		    		 
   		    		 if($arr["time"][$i] < $arr["time"][$j] )
   		    		 {
   		    		 	  $temp=$arr["pid"][$i];
   		    		 	  $arr["pid"][$i]=$arr["pid"][$j];
   		    		 	  $arr["pid"][$j]=$temp;

   		    		 	   $temp=$arr["time"][$i];
   		    		 	  $arr["time"][$i]=$arr["time"][$j];
   		    		 	  $arr["time"][$j]=$temp;
   		    		 }
   		    	}
   		    }

   		    $idarr=$arr["pid"];

   		    

   			foreach ($idarr as $key => $value) {
   			 	 $id=$value;
   			 	
   		      $qry="select * from posts where post_id=$id order by update_time desc";
   		      $y=$this->db->query($qry)->result_array();
   		      array_push($data, $y[0]);
   		  
 
   			}

   			

   			return $data;
   			
   			
   		}
   		
   		else{

   				$query= "select DISTINCT post_id,update_time from posts where user_id=$userId  order by update_time desc";

      	$data=array();
		if($this->db->query($query))
		{

   			$x=$this->db->query($query)->result_array();
   				foreach ($x as $key => $value) {
   			 	 $id=$value["post_id"];

   		      $qry="select * from posts where post_id=$id order by update_time desc limit 0,3" ;
   		      $y=$this->db->query($qry)->result_array();
   		     
   		    	array_push($data, $y[0]);

   			}

   		

   			return $data;
   		
   			}
   	}
   		
	}

   function loadPostData($userId,$no){
      $query="SELECT * FROM friends WHERE (uid_1 =$userId AND STATUS =1)  OR (uid_2 =$userId AND STATUS =1)";
         if($this->db->query($query)){
           $n= $this->db->query($query)->num_rows();
         }
         if($n>0)
         {
         $data=array();
         $idarr=array();
         $idarr1=array();
         $fidarr=array();
         $t=array();
         $arr=array();
         $query="select * from posts where user_id=$userId and post_status=1 order by update_time desc ";
            $x=$this->db->query($query)->result_array();
            foreach ($x as $key => $value) {
               array_push($idarr, $value["post_id"]);
               array_push($t, $value["update_time"]);
            }
          $query1="select * from spins where spinned_by=$userId ORDER by update_time desc ";
                $x1=$this->db->query($query1)->result_array();
              foreach ($x1 as $key => $val1) {
                array_push($idarr, $val1["post_id"]);
                array_push($t, $val1["update_time"]);
              }
          $query="select * from friends where (uid_1=$userId and status=1) or  (uid_2=$userId and status=1)";
            $x=$this->db->query($query)->result_array();
            foreach ($x as $key => $value) {
               if($value["uid_1"]==$userId)
                  array_push($fidarr, $value["uid_2"]);
               if($value["uid_2"]==$userId)
                  array_push($fidarr, $value["uid_1"]);
            }     
            foreach ($fidarr as $key => $value) {
               $id=$value;
               $query="select * from posts where user_id=$id order by update_time desc";
               $x=$this->db->query($query)->result_array();
               foreach ($x as $key => $val) {
               array_push($idarr, $val["post_id"]);
               array_push($t, $val["update_time"]);
               }
               $query1="select * from spins where spinned_by=$id order by update_time desc  ";
                $x1=$this->db->query($query1)->result_array();
                foreach ($x1 as $key => $val1) {
                array_push($idarr, $val1["post_id"]);
                array_push($t, $val1["update_time"]);
                }
            }
            $arr=array("pid"=>$idarr,
                       "time"=>$t);
            $n=count($arr["pid"]);
             for ($i=0; $i <$n ; $i++) { 
               for ($j=$i+1; $j < $n ; $j++) {        
                   if($arr["time"][$i] < $arr["time"][$j] )
                   {
                       $temp=$arr["pid"][$i];
                       $arr["pid"][$i]=$arr["pid"][$j];
                       $arr["pid"][$j]=$temp;
                       $temp=$arr["time"][$i];
                       $arr["time"][$i]=$arr["time"][$j];
                       $arr["time"][$j]=$temp;
                   }
               }
             }
            $idarr=$arr["pid"];
            $idarr=array_unique($idarr);
            foreach ($idarr as $key => $value) {
                $id=$value;
                $x=$no+10;
                if($key>=$no && $key <$x){
               $qry="select * from posts where post_id=$id order by update_time desc";
               $y=$this->db->query($qry)->result_array();
               array_push($data, $y[0]);
             }
            }
            return $data;
         }
         else{
            $idarr=array();
            $data=array();
            $t=array();
            $query= "select * from posts where user_id=$userId  order by update_time desc limit $no,10";
              $x=$this->db->query($query)->result_array();
              foreach ($x as $key => $value) {
               array_push($idarr, $value["post_id"]);
               array_push($t, $value["update_time"]);
              }   
              $query1="select * from spins where spinned_by=$userId ORDER by update_time desc ";
                $x1=$this->db->query($query1)->result_array();
              foreach ($x1 as $key => $val1) {
                array_push($idarr, $val1["post_id"]);
                array_push($t, $val1["update_time"]);
              }
              $arr=array("pid"=>$idarr,
                     "time"=>$t);
              $n=count($arr["pid"]);


             for ($i=0; $i <$n ; $i++) { 
               for ($j=$i+1; $j < $n ; $j++) { 
                   if($arr["time"][$i] < $arr["time"][$j] )
                   {
                       $temp=$arr["pid"][$i];
                       $arr["pid"][$i]=$arr["pid"][$j];
                       $arr["pid"][$j]=$temp;

                        $temp=$arr["time"][$i];
                       $arr["time"][$i]=$arr["time"][$j];
                       $arr["time"][$j]=$temp;
                   }
               }
             }

              $idarr=$arr["pid"];
            $idarr=array_unique($idarr);
            foreach ($idarr as $key => $value) {
                $id=$value;
                $x=$no+10;
                if($key>=$no && $key <$x){
               $qry="select * from posts where post_id=$id order by update_time desc";
               $y=$this->db->query($qry)->result_array();
               // return $y[$key];
               array_push($data, $y[0]);
             }
 
            }

            

            return $data;

              
          }

}


   function updatePostData($data,$pid){
     $sql="update posts set shared_by='$data' where post_id=$pid";
     if($this->db->query($sql)){
      return 1;
     }
   }

   function getIfad(){
      // $sql="select * from ad_type, ad_info where ad_type.ad_unit=2 and ad_info.Ad_id=ad_type.ad_id order by rand()"; 
      // return $this->db->query($sql)->row();
   }
   function getBidCount($userId){ 
      $sql="select * from bidrequests where request_to=$userId and view_status=0";
      return $this->db->query($sql)->num_rows();
   }

   function getPromoCount($userId){ 
      $sql="select * from promo_requests where request_to=$userId and view_status=0";
      return $this->db->query($sql)->num_rows();
   }

   function new_count_message($userId){
      $sql="select distinct uid1 from chats where uid2=$userId and read_status=0";

      return $this->db->query($sql)->num_rows();
   }

   function insertPost($data){
      if($this->db->insert('posts', $data))
      {
        return $this->db->insert_id();
      }
   }

   function getPostd($pid){
      $query= "select user_id,shared_by from posts where post_id=$pid";
   
      $x=$this->db->query($query)->row();
      return $x;
   }

      function likePost($pid, $uid, $userId){
        $query="select * from likes where post_id=$pid and liked_by=$uid";
        $x=$this->db->query($query)->num_rows();
        if($x==0){
         $q="insert into likes set post_id=$pid, likes=1, liked_by=$uid";
         if($uid!=$userId){
         $voteNoti=$this->User_model->checkLinkup($userId);
          if($voteNoti->vote_noti==1){        
         $noti=$this->Feed_model->insert_notification($uid,$userId,1,$pid);
        }
         }
      }
      else
      {  
            $query1="select * from likes where post_id=$pid and liked_by=$uid";
             $x=$this->db->query($query)->result_array();
          $likes= $x[0]["likes"];

       if($likes==1 && isset($x[0]["liked_by"]) ){
         $q="update likes set likes=0 where post_id=$pid and liked_by=$uid";
             }

              if($likes==0 && isset($x[0]["liked_by"]) ){
         $q="update likes set likes=1 where post_id=$pid and liked_by=$uid";
             }
       
      }
   

      $y=$this->db->query($q);
      if($y){
        return 1;
      }
   }

  function nlikes($pid){
      $query="select sum(likes) as sum from likes where `post_id`=$pid group by post_id";
      if( $this->db->query($query))
         $x=$this->db->query($query)->result();
         foreach ($x as $key => $value) {
            echo $value->sum; 
         }
  }

  function checklikes($pid,$uid){
    $query="select * from likes where post_id=$pid and liked_by=$uid";
    echo $this->db->query($query)->row()->likes;
  }

   function numlikes($pid){
      $query="select sum(likes) as sum from likes where `post_id`=$pid group by post_id";
      if( $this->db->query($query))
         $x=$this->db->query($query)->result_array();
         return $x;
   }


   function numComments($pid){
      $query="select count(post_id) as sum from comments where `post_id`=$pid and status=1 group by post_id";
      if( $this->db->query($query))
        $x=$this->db->query($query)->result_array();
        return $x;
   }

   function spinPost($pid, $uid,$userId){
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
         $noti=$this->Feed_model->insert_notification($uid,$userId,2,$pid);
         }
          }
         return 1;
      }
   }

   function promotePost($pid, $uid,$userId){
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
         $noti=$this->Feed_model->insert_notification($uid,$userId,22,$pid);

         $noti=$this->Feed_model->insert_notification($userId,$uid,222,$pid);
         }
        }
        return 1;
      }
   }

   function nspins($pid){
      $query="select sum(spins) as sum from spins where `post_id`=$pid group by post_id";
      if( $this->db->query($query))
         $x=$this->db->query($query)->result();
         foreach ($x as $key => $value) {
            echo $value->sum; 
         }
   }

   
   function likedPost(){
      $query="select distinct post_id from likes,friends where liked_by=uid_1 or liked_by=uid_2 and likes=1";
      if($this->db->query($query)){
         $data=array();
         $q=$this->db->query($query)->result_array();
         
         foreach ($q as $key=> $value) {
            
            // print_r($q);
            $id=$q[$key]["post_id"];
            
            $query1="select * from posts where post_id=$id";
            $x=$this->db->query($query1)->result_array();
            
            array_push($data, $x);
            
         }


         return $data;

      }
   }

      function insert_notification($uid,$userId, $type,$pid){
   
   if($type!=3 && $type!=5 && $type!=6 && $type!=9 ){
         
      $sql="select * from notifications where of=$userId and type=$type and post_id=$pid";

         $row=$this->db->query($sql)->num_rows();

               if($row>0){

               $check=$this->db->query($sql)->row();
               $f=0;
               $data=$check->by_user;
               $data=json_decode($data, TRUE);  
               $n=count($data)-1;; 
               foreach ($data as $key => $value) {
                  if($value["id"]==$uid){
                      $f=1;
                     for ($i=0; $i <$n ; $i++) { 
                        $temp=$data[$i]["id"];
                        $data[$i]["id"]=$data[$i+1]["id"];
                        $data[$i+1]["id"]=$temp;
                     }
                     $data=json_encode($data);
                  }
               }

               if($f==0){
            $i=count($data);
            $data[$i]["id"]=$uid;
            $data=json_encode($data);
               }

            $qr="update notifications set by_user='$data', view_status=0  where of=$userId and type=$type and post_id=$pid ";

               $this->db->query($qr);
         
                  
            }
               else{
               $data=array(0=>array("id"=>$uid));
               $data=json_encode($data);
            $qr="insert into notifications set by_user='$data', of=$userId, type=$type, post_id=$pid, view_status=0 ";

            $this->db->query($qr);
       
         
         }
         }
      else{
         $data=array(0=>array("id"=>$uid));
         $data=json_encode($data);
      $qr="insert into notifications set by_user='$data', of=$userId, type=$type, post_id=$pid, view_status=0";

      $this->db->query($qr);
 
   
   }

}

   function landingPost($id){
      $query= "select * from posts where post_id=$id ";
      
      if($this->db->query($query))
      {
            return $this->db->query($query)->result();
         }
   }


   function deletePost($pid){
      $query="update posts set post_status=0 where post_id=$pid";


      if($this->db->query($query)){
         return 1;
      }
      else{
         return 0;
      }
   }

   function delete_cmnt($pid){
      $query="update comments set status=0 where id=$pid";


      if($this->db->query($query)){
         $sql="update comments set status=0 where replyId=$pid";
         $this->db->query($sql);
         return 1;
      }
      else{
         return 0;
      }
   }

   function check_hidden($pid){
      $sql="select * from posts where post_id=$pid";
      return $this->db->query($sql)->row();
    }

  function hide_post($pid, $data){
      $sql="update posts set hidden_by='$data' where post_id=$pid ";
       $q=$this->db->query($sql);
       if($q){
         return 1;
       }
   }

   function mark_spam($data){
      if($this->db->insert('spams', $data))
         {
         return $this->db->insert_id();
         }
   }

   function checkCount($post_id){
      $sql="select * from spams where post_id=$post_id";
      return $this->db->query($sql)->num_rows();
   }

   function painicPost($pid, $uid){
      $insert="insert into painic set post_id=$pid, post_by=$uid, time=now()";
      if($this->db->query($insert)){
         return 1;
      }
   }






   function dpostdata($userId,$check){
      $sql="SELECT * FROM `posts` WHERE `user_id`=$userId and post_status=1 and is_status=0 order by posted_on desc ";
      $earning=array();
   
      if($check==1){

         return $this->db->query($sql)->result_array();
      }
      if($check==2){
         $x= $this->db->query($sql)->result();
         
         $dataArr=array();
         $dataArr1=array();
         
         
         
           
            

   
         foreach ($x as $key => $value) {
            $pid=$value->post_id;

             $sql="select * from promo_requests where post_id=$pid and status=1";
             $a=$this->db->query($sql)->num_rows();
             $sql="select * from bidrequests where post_id=$pid and status=1";
             $b=$this->db->query($sql)->num_rows();
             $value->nop=$a+$b;

             $sql="select sum(final_price) as sum from promo_requests where post_id=$pid and status=1  ";
             $a=$this->db->query($sql)->row()->sum;

              $sql="select sum(final_price) as sum from bidrequests where post_id=$pid and status=1  ";
             $b=$this->db->query($sql)->row()->sum;

             $value->pamount=$a+$b;

             $sql="SELECT count(post_id) as count from post_views where post_id=$pid";
             $value->aop=$this->db->query($sql)->num_rows();

              $sql="SELECT sum(ad_price) as sum from post_views where post_id=$pid";
             $value->adsum=$this->db->query($sql)->row()->sum;


             $sql="select name from `users` WHERE `id`=$userId";
             $value->name= $this->db->query($sql)->row()->name;
             $sql="select sum(`incocming_balance`) as PSUM from wallet where post_id=$pid and source='view' and user_id=$userId";
             $b=$this->db->query($sql)->row();
             // array_push($earning, $y);
             $value->PSUM=$b->PSUM;
             
             $sql="SELECT COUNT(`post_id`) as VSUM from post_views where post_id=$pid";
              $c=$this->db->query($sql)->row();
             // array_push($earning, $y);
             $value->VSUM=$c->VSUM; 

               
             $sql="select * from wallet where user_id=$userId and post_id=$pid and source='Promotion'";
             $nr=$this->db->query($sql)->num_rows();
             if($nr > 0){
             $a=$this->db->query($sql)->row();
             $value->earning=$a->incocming_balance;   
             }
             else{
               $value->earning=0;
             }

            $sql="select count(`post_id`) as count from baught_post where `post_id`=$pid and `baught_by`=$pid ";
             $c=$this->db->query($sql)->num_rows();
             if($c==1){
               $value->ptype="Buy"; 
             }

             $sql="select count(`post_id`) as count from baught_post where `post_id`=$pid and `posted_by`=$pid";
             $d=$this->db->query($sql)->num_rows();
             if($d!=0){
               $value->ptype="Sell"; 
             }

             if($c==0 && $d==0){
               $value->ptype="..."; 
             }

             $sql="select count(`baught_by`) as bby from baught_post where `post_id`=$pid and type=1";
             $c=$this->db->query($sql)->row();

             $value->nlink=$c->bby; 

             $sql="select sum(`incocming_balance`) as TSUM from wallet where post_id=$pid and user_id=$userId";
             $c=$this->db->query($sql)->row();

             $value->tsum=$c->TSUM; 

              $sql="select sum(`incocming_balance`) as BSUM from wallet where post_id=$pid and user_id=$userId and source='Bonus' ";
             $c=$this->db->query($sql)->row();
             if($c->BSUM > 0){
             $value->bsum=$c->BSUM; 
             }
             else{
             $value->bsum=0; 
             }

             $format=('Y-m-d H:i:s');
             $curdate= date($format, strtotime("3 hours +30 minutes"));
               $d2=date($format, strtotime("-30 days "));

             $sql="select count(post_id) as count from post_views WHERE post_id=$pid and viewed_at >= '$d2' and viewed_at <= '$curdate'";

             $uview=$this->db->query($sql)->row()->count;
  
             $value->uview=$uview;

             $sql="select count(p_id) as count from total_views WHERE  p_id=$pid and time >= '$d2' and time <= '$curdate'";

              $tview=$this->db->query($sql)->row()->count;

              $value->tview=$tview;


             array_push($earning, $value);

            
         }

         if(isset($dataArr)){       
         $earning=array_merge($earning, $dataArr);
         }

         
         return $earning;
      }

   }

 
   function video_summary($userId){
      $sql="SELECT COUNT(`posted_by`) as pby FROM `baught_post` WHERE `posted_by`=$userId and type=2";
      $data= $this->db->query($sql)->row_array();  
   
      $sql="SELECT COUNT(`baught_by`) as bby FROM `baught_post` WHERE `baught_by`=$userId and type=2";
      $data= $this->db->query($sql)->row_array();
         
   }

   function pearning($userId){
      $sql="SELECT SUM(incocming_balance) as total FROM `wallet` where user_id=$userId and `source`='view'";
      return $this->db->query($sql)->row();
   }

   function searning($userId){
      $sql="SELECT SUM(incocming_balance) as total FROM `wallet` where user_id=$userId and `source`='Sold'";
      return $this->db->query($sql)->row();
   }

   function get_statement($userId){
      $sql="select * from wallet where user_id=$userId  limit 0, 10";
      return $this->db->query($sql)->result_array();


   }

   function totalPromo($userId){ 
      $sql="select sum(incocming_balance) as sum from wallet where user_id=$userId and source='Promotion'";

      return $this->db->query($sql)->row()->sum;
   }

    function totalBonus($userId){ 
      $sql="select sum(incocming_balance) as sum from wallet where user_id=$userId and source='Bonus'";

      return $this->db->query($sql)->row()->sum;
   }
   
   function getPromoPost($userId){
      $dataArray=array();
      $dataArray1=array();
      $sql="select * from promo_requests where request_from=$userId and status=1 order by time_publisher desc ";
      $data= $this->db->query($sql)->result_array();
      foreach ($data as $key => $val) {
      $pid=$val["post_id"];
      $uid=$val["request_to"];
      $sql="select * from `posts` WHERE `post_id`=$pid and post_status=1";
      $value= $this->db->query($sql)->row();

      $sql="select * from `users` WHERE `id`=$uid";
      $name= $this->db->query($sql)->row();

      $value->name=$name->name;

      $sql="select * from promo_requests where post_id=$pid";
      $d= $this->db->query($sql)->row();
      $value->price=$d->final_price;
      $value->date=$d->time_publisher;

      array_push($dataArray, $value);

      }

      $sql="select * from bidrequests where request_to=$userId and status=1";
      $data= $this->db->query($sql)->result_array();
      foreach ($data as $key => $val) {
      $pid=$val["post_id"];
      $uid=$val["request_from"];
      $sql="select * from `posts` WHERE `post_id`=$pid and post_status=1";
      $value= $this->db->query($sql)->row();

      $sql="select * from `users` WHERE `id`=$uid";
      $name= $this->db->query($sql)->row();

      $value->name=$name->name;

      $sql="select * from bidrequests where post_id=$pid";
      $d= $this->db->query($sql)->row();
      $value->price=$d->final_price;
      $value->date=$d->time_publisher;
      array_push($dataArray1, $value);

      }

      $data=array_merge($dataArray, $dataArray1);

      return $data;

   }

   function totalCirculation($userId){
      $sql="select sum(reaches) as sum from reaches where user_id=$userId";
      return $this->db->query($sql)->row();
   }

   
    function post_comment($data,$userId){ 

      $x=$this->db->insert("comments",$data);
      if($x){
        $insert_id=$this->db->insert_id();
        $by=$userId;
        $pid=$data["post_id"];
        $of=$this->landingPost($pid);
        $of=$of[0]->user_id;


        if($of!=$by){
        $commentNoti=$this->User_model->checkLinkup($of);
        if($commentNoti->comment_noti==1){
          if($data["replyId"]==0){
          $noti=$this->Feed_model->insert_notification($by,$of,8,$pid);
          }
          else{
          $rep=$data['replyId'];
          $sql="select * from comments where id=$rep";
          $data=$this->db->query($sql)->row_array();
          $em=$data["comment_by"];
          $qry="select * from users where email='$em'";
          $comntr=$this->db->query($qry)->row()->id;
          if($data["by_user"]!=$of){  
          $noti=$this->Feed_model->insert_notification($by,$comntr,88,$pid);  
          }
         
          }
        }
        return $insert_id;
      }

        else{
          return $insert_id;
        }
      }
    }

      function getComments($id){
          $qry="select * from comments where post_id=$id and replyId=0 and status=1 limit 0,10";
          if($this->db->query($qry)){
              $data= $this->db->query($qry)->result_array();
               return $data;
          }
      }
      
    function getCommentsCount($id){
          $qry="select * from comments where post_id=$id and replyId=0 and status=1";
          if($this->db->query($qry)){
              $data= $this->db->query($qry)->num_rows();
               return $data;
          }
      }

     function getRepliesCount($id){
          $qry="select * from comments where replyId=$id and status=1";
          if($this->db->query($qry)){
              $data= $this->db->query($qry)->num_rows();
               return $data;
          }
      }

       function getReplies($id){
          $qry="select * from comments where replyId=$id and status=1";
          if($this->db->query($qry)){
              $data= $this->db->query($qry)->result_array();
               return $data;
          }
      }

     function getnewComments($id,$count){
      $qry="select * from comments where post_id=$id";
      if($this->db->query($qry)){
        $n= $this->db->query($qry)->num_rows();
        
          
            $x=$count;

        
      }
      
      $qry="select * from comments where post_id=$id limit $x, 5";
      if($this->db->query($qry)){
        $data= $this->db->query($qry)->result_array();
        $data[0]["count"]=$x;
        return $data;
      }

    }

     function status_data($pid){

      $sql="select * from posts where post_id=$pid";
      return $this->db->query($sql)->row();
    }


     function loadCatData($userId,$no,$cat){

        
      $query="SELECT * FROM friends WHERE (uid_1 =$userId AND STATUS =1)  OR (uid_2 =$userId AND STATUS =1)  ";

      if($this->db->query($query)){
         $n= $this->db->query($query)->num_rows();
      }
      
         if($n>0)
         {

     

            $data=array();
         $idarr=array();
         $idarr1=array();
         $fidarr=array();
         $t=array();
         $arr=array();
         $query="select * from posts where user_id=$userId and cat='$cat' and post_status=1 order by update_time desc ";
            $x=$this->db->query($query)->result_array();
            foreach ($x as $key => $value) {
               array_push($idarr, $value["post_id"]);
               array_push($t, $value["update_time"]);
            }

            $query="select * from friends where (uid_1=$userId and status=1) or  (uid_2=$userId and status=1)";
            $x=$this->db->query($query)->result_array();
            foreach ($x as $key => $value) {
               if($value["uid_1"]==$userId)
                  array_push($fidarr, $value["uid_2"]);
               if($value["uid_2"]==$userId)
                  array_push($fidarr, $value["uid_1"]);
            }     

            foreach ($fidarr as $key => $value) {
               $id=$value;
               $query="select * from posts where user_id=$id and cat='$cat' order by update_time desc";
               $x=$this->db->query($query)->result_array();
               foreach ($x as $key => $val) {
               array_push($idarr, $val["post_id"]);
               array_push($t, $val["update_time"]);
               }
            }


            
            $arr=array("pid"=>$idarr,
                     "time"=>$t);
             $n=count($arr["pid"]);


             for ($i=0; $i <$n ; $i++) { 
               for ($j=$i+1; $j < $n ; $j++) { 
                   
                   if($arr["time"][$i] < $arr["time"][$j] )
                   {
                       $temp=$arr["pid"][$i];
                       $arr["pid"][$i]=$arr["pid"][$j];
                       $arr["pid"][$j]=$temp;

                        $temp=$arr["time"][$i];
                       $arr["time"][$i]=$arr["time"][$j];
                       $arr["time"][$j]=$temp;
                   }
               }
             }

             $idarr=$arr["pid"];

             

            foreach ($idarr as $key => $value) {
                $id=$value;
                $x=$no+10;
                if($key>=$no && $key <$x){
               $qry="select * from posts where post_id=$id and cat='$cat' order by update_time desc";
               $y=$this->db->query($qry)->result_array();
               // return $y[$key];
               array_push($data, $y[0]);
             }
 
            }

            

            return $data;
            
            
         }
         
         else{

               $query= "select DISTINCT post_id from posts where user_id=$userId and cat='$cat' order by update_time desc limit $no,10";

         $data=array();
      if($this->db->query($query))
      {

            $x=$this->db->query($query)->result_array();
               foreach ($x as $key => $value) {
                $id=$value["post_id"];

               $qry="select * from posts where post_id=$id and cat='$cat' order by update_time desc" ;
               $y=$this->db->query($qry)->result_array();
              
               array_push($data, $y[0]);

            }

         

            return $data;
         
            }
      }
         
   }



    function getCatPostData($userId,$cat){

    $query="SELECT * FROM friends WHERE (uid_1 =$userId AND STATUS =1)  OR (uid_2 =$userId AND STATUS =1)  ";

    if($this->db->query($query)){
      $n= $this->db->query($query)->num_rows();
    }
    
      if($n>0)
      {

        $data=array();
      $idarr=array();
      $idarr1=array();
      $fidarr=array();
      $t=array();
      $arr=array();
      $query="select * from posts where user_id=$userId and cat='$cat' order by update_time desc ";
        $x=$this->db->query($query)->result_array();
        foreach ($x as $key => $value) {
          array_push($idarr, $value["post_id"]);
          array_push($t, $value["update_time"]);
        }

        $query="select * from friends where (uid_1=$userId and status=1) or  (uid_2=$userId and status=1)";
        $x=$this->db->query($query)->result_array();
        foreach ($x as $key => $value) {
          if($value["uid_1"]==$userId)
            array_push($fidarr, $value["uid_2"]);
          if($value["uid_2"]==$userId)
            array_push($fidarr, $value["uid_1"]);
        }   

        foreach ($fidarr as $key => $value) {
          $id=$value;
          $query="select * from posts where user_id=$id and cat='$cat' order by update_time desc";
          $x=$this->db->query($query)->result_array();
          foreach ($x as $key => $val) {
          array_push($idarr, $val["post_id"]);
          array_push($t, $val["update_time"]);
          }
        }


        
        $arr=array("pid"=>$idarr,
              "time"=>$t);
          $n=count($arr["pid"]);


          for ($i=0; $i <$n ; $i++) { 
            for ($j=$i+1; $j < $n ; $j++) { 
               
               if($arr["time"][$i] < $arr["time"][$j] )
               {
                  $temp=$arr["pid"][$i];
                  $arr["pid"][$i]=$arr["pid"][$j];
                  $arr["pid"][$j]=$temp;

                   $temp=$arr["time"][$i];
                  $arr["time"][$i]=$arr["time"][$j];
                  $arr["time"][$j]=$temp;
               }
            }
          }

          $idarr=$arr["pid"];

          

        foreach ($idarr as $key => $value) {
           $id=$value;
          
            $qry="select * from posts where post_id=$id and cat='$cat' order by update_time desc";
            $y=$this->db->query($qry)->result_array();
            array_push($data, $y[0]);
        
 
        }

        

        return $data;
        
        
      }
      
      else{

          $query= "select DISTINCT post_id from posts where user_id=$userId and cat='$cat' order by update_time desc";

        $data=array();
    if($this->db->query($query))
    {

        $x=$this->db->query($query)->result_array();
          foreach ($x as $key => $value) {
           $id=$value["post_id"];

            $qry="select * from posts where post_id=$id and cat='$cat' order by update_time desc limit 0,3" ;
            $y=$this->db->query($qry)->result_array();
           
            array_push($data, $y[0]);

        }

      

        return $data;
      
        }
    }
      
  }

  function checkLiked($pid, $userId){
    $sql="select * from likes where post_id=$pid and liked_by=$userId";
    return $this->db->query($sql)->row();
  }

  function postLikes($pid){
    $sql="select * from likes where post_id=$pid and likes=1";
    return $this->db->query($sql)->result();
  }

  function updateCmnt($data){
    $sql="update comments set comment='".$data['content']."' where id='".$data['cid']."' ";
   
     return $this->db->query($sql);
  }

  function editPost($content, $pid){
    $sql="update posts set short_des='$content' where post_id=$pid";
    if($this->db->query($sql)){
      return 1;
    }
  }

  function disableComments($pid){
    $sql="update posts set cmnt_show=0 where post_id=$pid";
    if($this->db->query($sql)){
      return 1;
    }
  }

  function enableComments($pid){
    $sql="update posts set cmnt_show=1 where post_id=$pid";
    if($this->db->query($sql)){
      return 1;
    }
  }

  function getNoti($id){
    $sql="select * from notifications where id=$id";
    if($this->db->query($sql)){
      return $this->db->query($sql)->row();
    }
  }

    function getRelated($cat, $pid){
      $sql="select * from posts where cat='$cat' and post_id!=$pid order by views desc limit 0,6";

      return $this->db->query($sql)->result_array();
    }


}