 <?php 
    if(isset($recent)){
        foreach ($recent as $key => $lpost) {
          if($lpost["post_status"]==1 ){
           
         $url1=base_url()."Feeds/landing/".$lpost["post_title"]."/".$lpost["post_id"]; 
         $url1=str_replace("?","-", $url1);
         $url1=str_replace("!","-", $url1);
         $url1=str_replace("#","-", $url1);
         $url1=str_replace("%","-", $url1);
     ?>  
          <div class="le">
          <?php if($lpost["img"]!=NULL) { ?>
        <img src="<?php echo base_url().$lpost['img']; ?>"  height="48" width="48" >
        <?php }  if($lpost["Vfile"]!=NULL) { ?>
         <img src="<?php echo base_url().$lpost['thumb']; ?>"  height="48" width="48" >

       <?php } ?>
        </div>
        <div  class="re"> <a class="wwrapp" href="<?php echo $url1; ?>"> <?php echo $lpost['post_title']; ?> </a> </div>
        <br clear="all">

<?php } } }



?>


