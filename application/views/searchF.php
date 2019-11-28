<?php
	if(count($users) > 0){
      foreach ($users as $key => $value) {

       ?>
    
      <div class="chats1">
    
          <div style="width: 20%;float: left;">
            <img src="<?php echo $value[0]->profile_pic; ?>" style="width: 60%;border-radius: 50%; margin: auto;display: block;" >
          </div>
          <div style="width: 80%;float: left;">
            <p> <a style="color: #555;" href="<?php echo base_url(); ?>Send/messenger/<?php echo rand(100000,999999).$value[0]->id; ?>/<?php echo rand(100000,999999).$userId; ?>"> <?php echo $value[0]->name; ?>   </a> </p>
         
          </div>
          <div class="cl"> </div>
        </div>  
     <?php }}
     else{ ?>
     	 <div class="chats1">
     	 	<p class="text-gray"> No result found...  </p>
     	 </div>
    <?php }

    ?>