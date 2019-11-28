<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php 
   if(isset($data)){
        foreach ($data as $key => $lpost) {
        if($key < 3) { 
         if($f[$key]==NULL){
          $flag=0;
            
        }
        else if($f[$key]->status==-3)
        {
          $flag=1;
        }
        else{
          $flag=0;
        }


          if($lpost->status==1 && $flag!=1){
           
         $url1=base_url()."tuser/".$lpost->otp.$lpost->id."/".str_replace(" ", "-", $lpost->name);
      
     ?>  

         <div  style=" width: 100%; float: left; background: #fff; margin-bottom: 3px;  "> 

            <div style="float: left;width: 11%;margin-left: 15px;margin-top: 5px;margin-bottom: 5px;">

            <?php if($lpost->profile_pic!=NULL) { ?>                 
              <img src="<?php echo $lpost->profile_pic; ?> " height="32px" width="32px" >
            <?php } ?>

             

            </div>

            <div style="float: left;width: 64%;margin-top: 3px;">
              <a class="wwrapp" style="line-height: 12px;margin-top: 3px; color: #555;font-weight: 700;font-size: 12px; " href="<?php echo $url1; ?>" valign="bottom" > <?php

              echo $lpost->name; ?>

               </a> 
               <p style="color: rgba(0,0,0,0.6);line-height:  14px;font-size: 11px;"> <?php echo $lpost->address; ?> </p>
          </div>

          <div style="float: left;width: 20%;">
            <?php
            if($lpost->id==$userId){

            } 
            else{         
            if($f[$key]!=NULL && $lpost->id!=$userId){
              if($f[$key]->status==1){ ?>
               <a style="color: #1BB85F;padding: 0px 5px;margin-top: 20px;background: #fff;width: 60%;border: 1px solid #1BB85F;height: 21px;text-align: center;display: inline-block;"  href="#" class="j<?php echo $key; ?> btn-succcess" >  Linked </a> 

            <?php }

              else if($f[$key]->status==0){ 
                if($f[$key]->uid_1==$userId){ 
                ?>
               
               <a style="color: #ccc;padding: 0px 5px;margin-top: 20px;background: #fff;border: 1px solid #ccc; width: 60%;height: 21px;text-align: center;display: inline-block;"  href="#" class="j<?php echo $key; ?> btn-primary" >  Sent </a> 

              <?php }
                else{ ?>
                  <a style="color: #006097;text-decoration: none;font-weight: 400;padding: 0px 5px;margin-top: 20px;background: #fff;width: 60%;border: 1px solid #006097; height: 21px;text-align: center;display: block;"  href="<?php echo base_url(); ?>tuser/<?php echo $lpost->otp.$lpost->id; ?>/<?php echo str_replace(" ", "-", $lpost->name) ?>" class="j<?php echo $key; ?> btn-primary"> <span>  Action <i class="fa fa-angle-down"></i> </span>  </a> 

              <?php  }

               }

              else if($f[$key]->status==-1){ ?>
              
               <a  style="color: #fff;margin-top: 20px;height: 21px; display: inline-block;width: 60%;padding: 0px 5px; text-align: center;" onclick="join(<?php echo $userId; ?>,<?php echo $lpost->id; ?>,'a<?php echo $key; ?>'); return false;" href="#" class="ja<?php echo $key; ?> btn-primary" > Linkup </a> 

              <?php }

              else if($f[$key]->status==-2){ ?>
              
               <a  style="color: #fff;margin-top: 20px;height: 21px; display: inline-block;width: 60%;padding: 0px 5px; text-align: center;" onclick="join(<?php echo $userId; ?>,<?php echo $lpost->id; ?>,'a<?php echo $key; ?>'); return false;" href="#" class="ja<?php echo $key; ?> btn-primary" > Linkup </a> 

              <?php }
            }
              else{ ?>
                 
                   <a  style="color: #fff;margin-top: 20px;height: 21px; display: inline-block;width: 60%;padding: 0px 5px; text-align: center;" onclick="join(<?php echo $userId; ?>,<?php echo $lpost->id; ?>,'a<?php echo $key; ?>'); return false;" href="#" class="ja<?php echo $key; ?> btn-primary" > Linkup </a> 
                 
              <?php }
            }
            ?>
          </div>

            
            <div class="cl"> </div>

         </div>
        
        <div class="cl"> </div>
        

        <?php } } } } 
        if(count($data) > 3) { ?> 
          <div> <a href="<?php echo base_url(); ?>Feeds/seeMoreSearch/<?php echo $input; ?>" style="display:block;color: #006097;text-align: center;margin: auto;"> See more </a> </div>
       <?php }
        ?>



 <div class="modal fade" id="frndModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 60%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Friend Requests </h4>
        </div>
        <div class="modal-body">
            <div id="mod">  </div>
        </div>
        
      </div>
      
    </div>
  </div>

<script type="text/javascript">
  
  function action(uid, fid, id){
    $("#frndModal").modal('show');
      $.ajax({
        url:"<?php echo base_url(); ?>Feeds/FriendAction",
        type: "post",
        data: {fid: fid, id: id},
        success: function(response){
          response=$.parseJSON(response);
            if(response.status==0){  
           data="<div style='width: 100%;float: left;'> <div style='width:25%;float:left;'> <img src='<?php echo  ?>"+response[0].profile_pic+"' width='100px' height='100px'>  </div> <div style='width: 68%; float:left'>"+response[0].name+" <br> "+response[0].address+" <br><br> <div class='pull-right'>  <a href='#' onclick='confirm("+fid+","+uid+",1);' class='cnfrm' > Confirm </a> &nbsp;&nbsp;&nbsp; <a href='#'  onclick='confirm("+fid+","+uid+",0);' class='cncl'> Cancel </a> </div> </div> <div class='cl'> </div>  </div><div class='cl'> </div>";
           }
           else if(response.status==1){
            data="<div style='width: 100%;float: left;'> <div style='width:25%;float:left;'> <img src='<?php echo  ?>"+response[0].profile_pic+"' width='100px' height='100px'>  </div> <div style='width: 68%; float:left'>"+response[0].name+" <br> "+response[0].address+" <br><br> <div class='pull-right'>  <a href='#' onclick='confirm("+fid+","+uid+",1);' style='background: #1BB85F' class='cnfrm' > Linked </a> &nbsp;&nbsp;&nbsp;</div> </div> <div class='cl'> </div>  </div><div class='cl'> </div>";
          
           
           } 
          $("#mod").html(data);
        }
      });

  }

</script>