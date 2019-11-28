<?php  	 
$comntr=array();
	if($cmntShow==1){
		foreach ($comm as $key => $comment) {
			$em=$comment["comment_by"];
			$qry="select * from users where email='$em'";
			$ud=$this->db->query($qry)->result_array();
			array_push($comntr, $ud);
		}
		for ($i=0; $i <count($comm) ; $i++) { 
				$data[$i]=$comm[$i];
				$unm=$data[$i]["name"]=$comntr[$i][0]["name"];
				$pp=$data[$i]["img"]=$comntr[$i][0]["profile_pic"];  
				$uid=$comntr[$i][0]["id"];
				$rand=$comntr[$i][0]["otp"];
				$cid=$comm[$i]["id"]; 	
				$ii="a".$i;
				$url=base_url()."tuser/". $rand.$uid."/".str_replace(" ", "-", $unm);
				$data[$i]["comment"] = trim(preg_replace('/\s\s+/', ' ', $data[$i]["comment"]));
				$select="select * from comments where replyId=$cid and status=1";
				$rcount=$this->db->query($select)->num_rows();

				if(!isset($kkey)){
					$kkey="";
				}
				
			if(isset($r)){ ?>	
			<div id="pcomment<?php echo  $cid.$i; ?>" class="pcomment<?php echo $cid.$i; ?> pcomments" style="width: 100%;float: left;position:relative; ">
				<div class="pcomments<?php echo $cid; ?>">
				<div style="width: 5%; float: left;margin-top: 10px;margin-left:0px; "> 

			<?php  } else {?>
				<div class="pcomment<?php echo $i; ?>" style="width: 100%;float: left;position:relative; ">

					<div class="pcomments<?php echo $cid; ?>">
					<div style="width: 5%; float: left;margin-top: 10px;margin-left:0px; "> 
			<?php } ?> 
			   <img src="<?php echo base_url().$data[$i]['img'] ?>" width="90%" id="modal_img" style="border-radius: 50%;"> </div>   <div style="width: 92%;float: left;margin-top: 10px;margin-left:5px;"> <span style="color:#555; font-size: 12px;"> <a href="<?php echo $url ?>"> <?php echo $data[$i]["name"] ?> </a></span>  | <span style="color: #555;font-size: 11px; " > <?php echo $data[$i]["posted_on"] ?>  </span> <hr style="background: #000; color: #000;"> <div style="width: 100%; float: left;"> <div style="width: 90%; float: left;"> 
			   	<?php if(isset($r)){ ?>
			   	<p class="ureply<?php echo $r.$i; ?>" style="word-wrap: break-word;white-space:normal;color:#333;"> <?php echo $data[$i]["comment"] ?> </p> 
			   	<input type="hidden" id="hid<?php echo $r.$i; ?>" value='<?php echo $data[$i]["comment"] ?>'>
			   <?php } 
			   else { ?>
			   	<p class="ureply<?php echo $i; ?>" style="word-wrap: break-word;white-space:normal;color:#333;"> <?php echo $data[$i]["comment"] ?> </p> 
			   	<input type="hidden" id="hid<?php echo $i; ?>" value='<?php echo $data[$i]["comment"] ?>'>
			   <?php } ?>


			   	</div> <div style="float: left; width: 9.5%;margin-left:0.5%;"> <?php if($userId==$uid){ ?>

			<?php if(isset($r)){ ?>
			<a href="#" onclick="editComment(<?php echo $cid; ?>, <?php echo $r.$i; ?>, '<?php echo $data[$i]["comment"]; ?>');return false;" style="color: #525151"> <i class="fa fa-pencil"></i>  </a>
		<?php }
		else{ ?>
			<a href="#" onclick="editComment(<?php echo $cid; ?>, <?php echo $i; ?>, '<?php echo $data[$i]["comment"]; ?>');return false;" style="color: #525151"> <i class="fa fa-pencil"></i>  </a>
		<?php } ?>

		<?php if(isset($r)){ ?>
			&nbsp; <a href="#" onclick="delComment(<?php echo $cid; ?>, <?php echo $r.$i; ?>,<?php echo  $kkey; ?>);return false;" style="color: #525151"> <i class="fa fa-trash" aria-hidden="true"></i> 
			 </a> 
		 <?php  } 
		 else{ ?>
		 	&nbsp; <a href="#" onclick="delComment(<?php echo $cid; ?>, <?php echo $i; ?>,<?php echo  $kkey; ?>);return false;" style="color: #525151"> <i class="fa fa-trash" aria-hidden="true"></i> 
			 </a> 
		<?php }
		?>

			 <?php } ?> </div> <div class="cl"> </div> <div>
			<div>
			<?php if(!isset($r)){ ?>
			 <small> <a style="color: #c6c6c6" href="#" onclick="repcmnt(<?php echo $cid ?>,'<?php echo $ii ?>', <?php echo $id ?>,<?php echo $uid ?>,0,'<?php echo $unm ?>', '<?php echo $pp ?>','<?php echo $cid; ?>0' );return false;"> Reply </a> </small>
			
		

			<small style="color: #c6c6c6"> 
		 	<?php
		 	
		 	 if($rcount==1){	
		 		echo "| <span class='replyCount".$i."'>".$rcount. "</span> Reply";
		 		}
		 		if($rcount > 1){
		 		echo "| <span class='replyCount".$i."'>".$rcount. "</span> Replies";
		 		}
		 	?>
		 	 </small>
		 	 <?php } ?>
			</div> <div class="cl"> </div> </div> 

			<div id="mod-replies<?php echo $cid; ?>0" class="mod-replies<?php echo $cid; ?>0 mod-replies">  </div> 


			 <div class="cl"> </div>  </div>  
			</div>
			</div>
			<?php }

			if($comcount>10){ ?>
			<div style='margin-bottom: 5px'><a href='<?php echo base_url(); ?>Comments/<?php echo $id; ?>' class='text-center'> See more </a> </div>


	<?php }  ?>
	

	 
			 <?php if(isset($r)){ ?>
			 <div class="rep" >
				<div style='width: 100%; float: left;margin-top: 15px;'> <div style='width: 5%; float: left;'> <img src='<?php echo $x->profile_pic;?>' style='border-radius: 50%;margin-top:5px;width: 100%'> </div> <div style='width: 92%;margin-left: 5px; float: left;'> <textarea style='width:100%; color: #000;margin-top: 3px;height: 30px;border:1px solid #ddd;' id='comments<?php echo $kkey; ?>' onkeyup='cmnt(event, <?php echo $id; ?>,"<?php echo $kkey; ?>", <?php echo $pid; ?>, <?php echo $uid; ?> , <?php echo $key; ?>, "<?php echo $unm; ?>","<?php echo $pp; ?>", 2,"<?php echo $kkey; ?>");'></textarea> <div class='repBtn<?php echo $key; ?>'></div> </div>  <div class='hiddendiv<?php echo $kkey; ?> hiddendiv' style='min-height: 30px;'> </div>
				</div></div>
			<?php } 	 ?>


			    
			    <?php if(!isset($r)){ ?>
	<div id="loadpostComent"></div>
	 <div id="feedComms<?php echo $kkey; ?>" class='feedComms<?php echo $kkey; ?>' > 
      </div>
	<div style="float: left;width: 100%;" class="feedComm<?php echo $kkey; ?>">
        
       <div style="width: 5%;float: left;">
          <img src="<?php echo $x->profile_pic;?>" style='border-radius: 50%;margin-top: 8px;width: 100%' >
       </div> 
     
       <div style="width: 92%;margin-left: 5px;float: left;">
        <textarea style="width: 100%;border: 1px solid #ddd;" onkeyup="postCom(<?php echo $kkey; ?>,<?php echo $id; ?> );return false;" id="status_comment<?php echo $kkey; ?>" autocomplete="off"></textarea>
        <div class="comBtn<?php echo $kkey; ?>"></div>
      </div> 
    </div>

    

	<?php } 

}

	
	else{ ?>
		
	<div class="pcomments1" style="width: 100%;float: left;position:relative; margin-bottom: 10px;">

		<p style="background: #f5f5f5;color: #444;border: 1px solid #afafaf;width: 97%;padding: 3px;text-align: center; font-weight: bold;"> Comments are disabled on this post</p>

	</div>

	<?php }



?>



