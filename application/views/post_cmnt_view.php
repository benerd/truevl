<?php 
		$unm=$data["name"]=$comntr["name"];
		$pp=$data["img"]=$comntr["profile_pic"];
		$uid=$comntr["id"];
		$rand=$comntr["otp"];
		$cid=$data["id"]; 			
		$ii="ax".$data["id"];
		$url=base_url()."tuser/".$rand.$uid."/".str_replace(" ", "-", $unm);
		$data["comment"] = trim(preg_replace('/\s\s+/', ' ', $data["comment"]));
		$counterr=0;
		?>

	

		<div class="pcomment0<?php echo $counterr; ?>" style="width: 100%;float: left;margin-bottom: 10px;">
		<div class="pcomments<?php echo $cid; ?>">
			<div style="width: 5%; float: left;margin-top: 10px;margin-left:0px; ">    <img src="<?php echo $pp ?>" width="90%" id="modal_img" style="border-radius: 50%;"> </div>   <div style="width: 92%;float: left;margin-top: 10px;margin-left:5px;"> <span style="color:#555; font-size: 12px;"> <a href="<?php echo $url ?>"> <?php echo $data["name"] ?> </a></span>  | <span style="color: #555;font-size: 11px; " > <?php echo $data["posted_on"] ?>  </span> <hr style="background: #000; color: #000;"> <div style="width: 100%; float: left;"> <div style="width: 90%; float: left;"> <p class="ureply0<?php echo $counterr; ?>" style="word-wrap: break-word;white-space:normal;color:#333;"> <?php echo $data["comment"] ?> </p>
				<input type="hidden" id="hid0<?php echo $counterr; ?>" value='<?php echo $data["comment"] ?>'>
		</div><div style="float: left; width: 9%;margin-left:1%;"> 
			 <?php if($userId==$uid){ ?>
			<a href="#" onclick="editComment(<?php echo $cid; ?>, '0<?php echo $counterr; ?>', '<?php echo $data["comment"]; ?>');return false;" style="color: #525151"> <i class="fa fa-pencil"></i>  </a>
			&nbsp; <a href="#" onclick="delComment(<?php echo $cid; ?>, '0<?php echo $counterr; ?>');return false;"  onclick="return false;" style="color: #525151"> <i class="fa fa-trash" aria-hidden="true"></i> 
			 </a>
		<?php } ?>
		 </div> <div class="cl"> </div> <div> <p style="display: inline-block;" > <small> <a style="color: #c6c6c6" href="#" onclick="repcmnt(<?php echo $cid ?>,'<?php echo $ii ?>', <?php echo $id ?>,<?php echo $uid ?>,0,'<?php echo $unm ?>', '<?php echo $pp ?>', '<?php echo $cid; ?>0');return false;"> Reply </a> </small>  
		 	</div>
		   </p> <div id="mod-replies<?php echo $cid; ?>0" class="mod-replies mod-replies<?php echo $cid; ?>0">  </div> <div id="rep<?php echo $ii ?>" class="rep" > </div>  </div> </div> </div> <div class="cl"> </div>  

