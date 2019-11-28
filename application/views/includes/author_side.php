<?php

foreach ($pdata  as $key => $privacy) { 
} 
?>
 
 <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/cover.css" />

<div class="timeline-header-wrapper">
 <div  class="cover-container">

     <div class="cover-wrapper">
           <img src="<?php echo base_url().$userdata->cover_repos ;?>">
            <div class="cover-progress"></div>     
        </div> 
     
     <div  class="cover-resize-wrapper">
        <div class="trans2"> <span style="color: white"> click </span> </div>
            <img  id="cvr" src="<?php echo base_url().$userdata->cover_pic ;?> ">
            <div class="drag-div" align="center">Drag to reposition</div>
            <div class="cover-progress"></div>
        </div>
  <form class="cover-position-form hidden" method="post">
            <input class="cover-position" name="pos" value="0" type="hidden">
        </form> 
   <?php if($this->session->userdata('email')){
  if(count($check) ==0 || $check->status==-2 || $check->status==-1){ ?>  <div class="trans3">  <a href="#" class="text-white" onclick="join(<?php echo $userId; ?>,<?php echo $authId ?>);">  Linkup  </a></div>  <?php }
  
   else { 

    if($check->status==0 && $check->uid_1==$userId ){  ?>

       <div class="trans3" style="background: #e5e5e5">   Request Sent  </div> 

   <?php }  
   if($check->status==0 && $check->uid_2==$userId ){ ?>
     <div class="trans3"> <a href="#" onclick="actions1(); return false;" class="text-white act1">   Respond  </a> </div> 
   <?php }

   ?>

    <?php if($check->status==1){ ?>  <div class="trans3"> <a href="#" onclick="actions(); return false;" class="text-white act"> Action </a>  </div>   <?php } } ?>

  
    <div class="trans">  Link <span class="biger"> <?php echo $get_links; ?>  </span>    Activity  <span class="biger"><?php echo $get_activity; ?>   </span></div>
    
  </div>
</div>
    
    <div id="author_actions">
     <?php if($this->session->userdata("email")) { ?>   
    <div class="" style="border-bottom: 1px solid #ccc;"> <a style=" padding-left: 15px;" class="text-black" href="#" onclick="disconnect(<?php echo $authId; ?>); return false;" > Disconnect  </a> </div>
    <?php  }  ?>

      <?php if($check_blocked==0){ ?>    
    <div class="" style="border-bottom: 1px solid #ccc;">  <a style=" padding-left: 15px;" class="text-black" href="#" onclick="block(<?php echo $authId; ?>); return false;" >   Block  </a> </div>
       <?php } else{ ?>


    <div style="border-bottom: 1px solid #ccc;">  <a style="padding-left: 15px;" class="text-black" href="#" onclick="unblock(<?php echo $authId; ?>); return false;" >   Unblock  </a> </div>
       <?php } } ?>
    </div>

    <?php if(count($check) > 0) { ?>
    <div id="author_actions1">

      <div class="" style="border-bottom: 1px solid #ccc;"> <a style="padding-left: 15px;" onclick="confirmf(<?php echo $check->uid_1; ?>,<?php echo $check->uid_2; ?>,1);" class="text-black" href="#" > Accept  </a> </div>

      <div class="" style="border-bottom: 1px solid #ccc;"> <a style=" padding-left: 15px;" onclick="confirmf(<?php echo $check->uid_1; ?>,<?php echo $check->uid_2; ?>,0);" class="text-black" href="#"  > Reject  </a> </div>
    </div>
  <?php } ?>
  <div id="left1">
    <div class="">
    <div class="container" id="crop-avatar">  
    <img onclick="openImage('<?php echo $userdata->profile_pic ;?>');" id="dp" class="avatar-view" src="<?php echo $userdata->profile_pic ;?>" width="85%" style="margin-left: 6px; margin-top: 5px;">
    </div> 


    <div class="trans1"> <a class="text-white" href="#" > Edit </a> </div>
    <div align="center" style="width: 99.1%;background: #f5f5f5; border: 1px solid #ccc;">
      <span style="color: #135d82; text-align: center;font-size: 16px;  font-weight: bold; padding: 3px 15px;"  class=" text-center"> <?php echo $userdata->name; ?> </span>
    </div>
    
    <div class="mar"> </div>
        <div class="status_quote"> 
          
           <div class="uinfo">
  
        
         <?php if($privacy->work_show==1 && $userdata->work!=NULL){ ?>
          <div class="boxes">
        <i class="fa fa-thumbs-up" aria-hidden="true"></i>  <span id="work">  I am a  <?php echo $userdata->work; ?> </span> <a href="#" onclick=" return false;" >   </a>  </div><?php } ?>
     

       
          <?php if($privacy->add_show==1 && $userdata->address!=NULL){ ?> <div class="boxes">
       <i class="fa fa-location-arrow" aria-hidden="true"></i>  <span id="add"> Lives in <?php echo $userdata->address; ?> </span><a href="#"  onclick=" return false;" >  </a> </div>  <?php } ?>
        
       <?php if($privacy->phone_show==1){?>  
        <div class="boxes">

     <i class="fa fa-mobile" aria-hidden="true"></i>  <span id="mob"> <?php echo $userdata->mobile; ?> </span> <a href="#"  onclick="return false;"  >  </a> 
        </div> <?php } ?>

    <?php if($privacy->email_show==1){?>  
        <div class="boxes">

     <i class="fa fa-mobile" aria-hidden="true"></i>  <span id="mob"> <?php echo $userdata->email; ?> </span> <a href="#"  onclick="return false;"  >  </a> 
        </div> <?php } ?>

    <?php if($privacy->bday_show==1){?>  
        <div class="boxes">

     <i class="fa fa-mobile" aria-hidden="true"></i>  <span id="mob"> <?php echo $userdata->dob; ?> </span> <a href="#"  onclick="return false;"  >  </a> 
        </div> <?php } ?>    

      </div>

       <div class="uinfo">
        
         <?php if( $userdata->website!=NULL){ ?> <div class="boxes">
         <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  <span id="website"> <?php echo $userdata->website; ?> </span><a href="#"  onclick="update_web('website', 'web');return false;" > <i id="web" class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>  </div>   <?php } ?>
        
        <div class="boxes">
         <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Joined <?php echo $userdata->joining_date; ?>  
        </div>
     
     
      </div>  

     
        </div>
    <!-- div>
    
    

  </div> -->
  </div>
    </div> <!-- <end of left> -->


<div id="userImgeModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" style="margin-top: 150px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Profile</h4>
      </div>
      <div class="modal-body" style="background: #ccc;padding: 5px;">
        <div id="userImg">  </div>
      </div>
      
    </div>
  </div>
</div>




<script type="text/javascript"> 
    
     var elementPosition = $('#left1').offset();

$(window).scroll(function(){
        if($(window).scrollTop() > elementPosition.top){
              $('#left1').css('position','fixed').css('top','44px');
               $("#right2").css('position','fixed').css('top','44px');
        } else {
            $('#left1').css('position','absolute').css('top', '320px');
            $('#right2').css('position','absolute').css('top', '364px');
        }    
});

function confirmf(fid,uid,cnfrm,key) {
    $.ajax({
    url: '<?php echo base_url(); ?>Users/friendAccept/'+fid+'/'+uid+'/'+cnfrm,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
    success: function(response){
        if(cnfrm==1){
        window.location.reload();
    }
  }
  });
}

</script>



<script type="text/javascript"> 
  var authId;
 function disconnect(uid){
          
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/disconnect/"+uid,
            method: "post",
            success: function(response){

              if(response==1){
                 alert("disconnected");
                 location.reload();
              }
            
             

            }


          });


    }

   
    
     function unblock(uid){
          
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/unblock/"+uid,
            method: "post",
            success: function(response){
                 alert("unblocked");
                
                 location.reload();

            }


          });


    }


function actions(){
  $("#author_actions").toggle();
}

function actions1(){
  $("#author_actions1").toggle();
}

function join(uid,fid,key){
   $.ajax({

    
    url: '<?php echo base_url() ?>Users/addFriend/'+uid+'/'+fid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
    if(response==1) 
      {
        $(".j"+key).css({"background": "#fff", "border": "1px solid #ccc", "color": "#ccc"});
        $(".j"+key).html("Sent");
        $(".trans3").html("Request Sent").css("background", "#d4d4d4");
    } 
    if(response==0){
          alert("you can't sent link request to this guy");
    
    }
    
    if(response==2){
       alert("Request already sent");
    } 
      
    }
    
    
  });
}




$(document).on('click', function(e) {
    if ( $(e.target).closest(".act").length ) {
        $("#author_actions").show();
    }else if ( ! $(e.target).closest("#author_actions").length ) {
        $("#author_actions").hide();
    }

     if ( $(e.target).closest(".act1").length ) {
        $("#author_actions1").show();
    }else if ( ! $(e.target).closest("#author_actions1").length ) {
        $("#author_actions1").hide();
    }
});

function openImage(img){
    $("#userImg").html("<img src='"+img+"' width='100%' >")
    $("#userImgeModal").modal("show");
}


</script>

<style type="text/css">
  
 
#author_actions,#author_actions1{
  background: #fff;
    width: 201px;
    padding: 10px;
    border: 1px solid #ccc;
    box-shadow: 2px 2px 2px 2px #ccc;
    position: absolute;
    right: 27.2%;
    top: 51%;
    display: none;
    z-index: 1;
}

#author_actions a, #author_actions1 a{
  display: block;
  
}

#author_actions a:hover{
  background: #f5f5f5;
  color: rgba(0,0,0,0.7);
 
}

#author_actions1 a:hover{
  background: #f5f5f5;
  color: rgba(0,0,0,0.7);
 
}

</style>