<div style="">
    <div style=""> 
 <?php  
      $dates=array();   
      if(count($res) > 0){
          
          // foreach ($res as $key => $value) {
          //   $dat=new DateTime($value->time);
          //   $dat=$dat->format('Y-m-d');
          //   array_push($dates, $dat);
          //  } 

           
          foreach($res as $row){
          $dt = new DateTime($row->time);
          ?>
          
          <?php if($userId==$row->uid1){ ?>

          <div style="margin-right: 10px;margin-top: 3px; width: 70%;float: right;text-align: right;font-size: 13px; color: #333"> 
          <span style="display: inline-block;float: left;max-width: 90%;border-radius: 8px;background: #f5f5f5;float: right; padding: 0px 6px;word-wrap: break-word;"> 

            <?php 
            $msg=trim($row->message, " ");
            if (filter_var($msg, FILTER_VALIDATE_URL)) {
            echo "<a href='".$msg."' target='_blank'> ".$msg." </a>";    
            }
            else{
              echo $row->message;
              echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>";
            }
             ?> 
           </span>
          <?php
            if(isset($row->link)){
              $link=json_decode($row->link);
              if($link->imgUrl || $link->post_title ){ ?>
         <a href="<?php echo $row->message; ?>" target="_blank"> <span style="display: inline-block;float: left;max-width: 100%;border-radius: 8px;background: #f5f5f5;float: right; padding: 0px 6px;word-wrap: break-word;margin-top: 3px;">
          <img src='<?php echo $link->imgUrl; ?>' width="20%" valign="top" > 
          <span style="width: 50%;font-size: 12px;"><b> <?php echo mb_substr($link->post_title,0,20); ?> </b>
          </span>
           <p> <?php echo mb_substr($link->short_des,0,50); ?> </p> 
           <?php   echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>"; ?>
          </span>  </a>
             <?php

              }

            }
          ?>
         
         <?php
          if(isset($row->attachment)){ ?>
            <a href="#" onclick="imgModal('<?php echo $row->attachment ?>')" >
              <img src="<?php echo base_url().$row->attachment; ?>" width="25%" style="">
            </a>
          
          <?php } ?>  

          </div>
           <?php } 
           else{ ?> 
            <div style="margin-left: 10px;margin-top: 3px; width: 70%;float: left;font-size: 13px; color: #333"> 
          	 <span style="display: inline-block;float: left;width: 11%;">  <img src="<?php echo base_url().$img; ?>" valign="bottom" width="100%" style="border-radius: 50px;"  > </span>
          	  <span style="display: inline-block;float: left;max-width: 79%;border-radius: 8px;background: #e1eaf3; padding: 0px 6px; margin-left: 5px;word-wrap: break-word;"> 
                <?php 
            $msg=trim($row->message, " ");
            if (filter_var($msg, FILTER_VALIDATE_URL)) {
               echo "<a href='".$row->message."' target='_blank'> ".$row->message." </a>";    
            }
            else{
              echo $row->message;
              echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>";
            }
             ?> 
          </span>
          <?php
            if(isset($row->link)){
              $link=json_decode($row->link);
              if($link->imgUrl || $link->post_title ){ ?>
        <a href="<?php echo $row->message; ?>" target="_blank">   <span style="display: inline-block;float: left;max-width: 100%;border-radius: 8px;background: #e1eaf3;float: right; padding: 0px 6px;word-wrap: break-word;margin-top: 3px;">
          <img src='<?php echo $link->imgUrl; ?>' width="20%" valign="top" > 
          <span style="width: 50%;font-size: 12px;"><b> <?php echo mb_substr($link->post_title,0,20); ?> </b>
          </span>
           <p> <?php echo mb_substr($link->short_des,0,50); ?>

            </p> 
        <?php  echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>"; ?>
          </span>  </a>
             <?php
            
              }
            }
          ?>

              <?php
          if(isset($row->attachment)){ ?>
           <p> <a href="#" onclick="imgModal('<?php echo $row->attachment ?>')" >
              <img src="<?php echo base_url().$row->attachment; ?>" width="25%" style="">
            </a> </p>
          <?php } ?>  
          </div>

         <?php  }
           }
        }  
          ?>

        
       </div></div>