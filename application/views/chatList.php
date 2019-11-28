
<?php

	foreach ($luser as $key => $value) {
		$usr=$this->User_model->getUdata($value);


        if($usr[0]->active==1){
          $frndId=$usr[0]->id; 
          $fname=$usr[0]->name;
          $fotp=$usr[0]->otp;
          $fimg=$usr[0]->profile_pic;
    ?> 
      <div style="margin-left: 15px;margin-top: 3px;">
        <img  src="<?php echo $usr[0]->profile_pic; ?> " width="18px" height="auto"> 

          <?php if($f==1) { ?> 
         <a class="" href="<?php echo base_url(); ?>Send/messenger/<?php echo $userId ?>/<?php echo $frndId; ?>">  <?php echo $usr[0]->name; ?> </a> 



       <?php } ?>

       <?php if($f==2) { ?> 
         <a class="" href="#" onclick="oneonone(<?php echo $userId ?>,<?php echo $frndId; ?>, '<?php echo $fname; ?>', '<?php echo $fotp; ?>', '<?php echo $fimg; ?>');return false;">  <?php echo $usr[0]->name; ?> </a> 
          


       <?php } ?>
        <img src="<?php echo base_url(); ?>assets/img/green.png" height="8px" width="8px" valign="middle" >

       
           <div class="cl"> </div>
      </div>
	<?php 	} 
	}
?>

<hr>

<?php
	foreach ($ofuser as $key => $value) {
		if($value!=$userId){
		$usr=$this->User_model->getUdata($value);
	        if($usr[0]->active==1){
	          $frndId=$usr[0]->id; 
	          $fname=$usr[0]->name;
            $fotp=$usr[0]->otp;
	          $fimg=$usr[0]->profile_pic;
   		 ?> 
      <div style="margin-left: 15px;margin-top: 3px;">
        <img  src="<?php echo $usr[0]->profile_pic; ?> " width="18px" height="auto"> 

          <?php if($f==1) { ?> 
         <a class="" href="<?php echo base_url(); ?>Send/messenger/<?php echo $userId ?>/<?php echo $frndId; ?>">  <?php echo $usr[0]->name; ?> </a> 
       <?php } ?>

           <?php if($f==2) { ?> 
         <a class="" href="#" onclick="oneonone(<?php echo $userId ?>,<?php echo $frndId; ?>, '<?php echo $fname; ?>', '<?php echo $fotp; ?>', '<?php echo $fimg; ?>');return false;">  <?php echo $usr[0]->name; ?> </a>

       <?php } ?>

          <small style="color: gray">  </small>
          
           <div class="cl"> </div>
      </div>
	<?php 	} 
	}
}


?>