 <link rel="stylesheet" href="<?php echo base_url();?>assets/css/cropper.min.css"> 
 <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main1.css"> 
  
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>
<script type="text/javascript"> 
 
   $(document).ready(function(){
         var count=0; 
         var tcount=0;   
         loadActivity(); 
         loadComments();
         loadPromotion();
    <?php if($this->session->userdata('email')){ ?>
         loadBuyer();
    <?php } ?>
 
    function loadActivity() 
    {
      var activityCount=<?php echo $activityCount ?>;
      var val = document.getElementById("row_no").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadActivity/<?php echo $authId; ?>',
      data: {
       getresult:val
      },
      beforeSend: function() {
        
           $(".load_img").eq(0).html("<img src='<?php echo base_url(); ?>assets/img/loadingg.gif' width='100%'>");

      },
      success: function (response) {
          $(".load_img").eq(0).html("");
          $("#all_activity").append(response);
          document.getElementById("row_no").value = Number(val)+3;
          if(activityCount > 3){ 
             $(".seemore").eq(0).html('<div class="cl"> </div> <div> <p class="text-center"> <a href="<?php echo base_url(); ?>activities/<?php echo $rand.$authId; ?>/<?php echo $unm; ?>" id="" > See More </a> </p> </div>');      
          }
          
      }

      });
    }

    function loadPromotion() 
    {
      var promoCount=<?php echo $promoCount ?>;
      var val = document.getElementById("prow_no").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadPromotion/<?php echo $authId; ?>',
      data: {
       getresult:val
      },
      beforeSend: function() {
        
        $(".load_img").eq(1).html("<img src='<?php echo base_url(); ?>assets/img/loadingg.gif' width='100%'>");

      },
      success: function (response) {

          $(".load_img").eq(1).html("");
          $("#all_promos").append(response);
          document.getElementById("row_no").value = Number(val)+3;
           if(promoCount > 3){ 
             $(".seemore").eq(1).html(' <div class="cl"> </div> <div> <p class="text-center"> <a href="<?php echo base_url(); ?>PromotedPosts/<?php echo $rand.$authId; ?>/<?php echo $unm; ?> " id="" > See More </a> </p>   </div>');      
          } 
     
      }

      });
    }

     function loadComments() 
     {
      var commentsCount=<?php echo $commentsCount ?>;
      var val = document.getElementById("row_nos").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadComments/<?php echo $authId; ?>',
      data: {
       getresult:val
      },
     
      beforeSend: function() {
           $(".load_img").eq(2).html("<img src='<?php echo base_url(); ?>assets/img/loadingg.gif' width='100%'>");
      },
      success: function (response) {
         $(".load_img").eq(2).html(""); 
         $("#all_commments").append(response);
         document.getElementById("row_nos").value = Number(val)+3;
          if(commentsCount > 3){ 
             $(".seemore").eq(2).html('<div> <div class="cl"> </div>   <p class="text-center"> <a href="<?php echo base_url(); ?>comments/<?php echo $rand.$authId; ?>/<?php echo $unm; ?>"> See More </a> </p> </div> ');    
          } 
      }

      });
    }


     function loadBuyer() 
     {
      var val = document.getElementById("row_noss").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadBuyer/<?php echo $authId; ?>',
      data: {
       getresult:val
      },
      // datatype: "json",
      beforeSend: function() {
        
         $(".load_img").eq(3).html("<img src='<?php echo base_url(); ?>assets/img/loadingg.gif' width='100%'>");

      },
      success: function (response) {
          $(".load_img").eq(3).html("");
          $("#all_buyers").append(response);
           document.getElementById("row_noss").value = Number(val)+6;
   
      }

      });
    }

  });  


function landing(url){
  window.location=""+url+"";  
}

</script>





<?php
  if($this->session->userdata("email")){
    foreach ($userData as $key => $userdata) {
    } }
?>

<style type="text/css">
 
.camera{
  position: absolute;
  top: 60px;
  left: 245px;
}


 

</style>



<?php
  foreach ($authuser as $key => $userdata) {
  
  }
?>

<div id="profile_wrapper">
 

  <div id="inner"> 
  
     <?php  include("includes/author_side.php") ?>


    <div id="right1"> 
      
      <div class="profile_divs">
      
      <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Activity </h3>
          </div>

            <div class="load_img"> </div>
            <div id="all_activity">  </div>

          <input type="hidden" value="0" id="row_no" name="">

            
    
            <div class="cl"> </div>


            <?php
           
             if($activityCount==0) {  ?>
                
                 <br><br>
  <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_activity.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;"> No Activity found  </h3>
   </div>


            <?php }  ?>
            <div class="seemore"> </div>
</div>


      
  <div class="profile_divs">
      
      <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Promoted Posts </h3>
          </div>

          <?php 
            if($privacy->promo_show==1) { ?>
            

            <div id="all_promos">  </div>

          <input type="hidden" value="0" id="prow_no" name="">

            <div class="load_img"> </div>
    
            <div class="cl"> </div>


            <?php  if($promoCount==0) {  ?>
                
                 <br><br>
  <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_activity.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;"> No Activity found  </h3>
   </div>


            <?php } ?>
            <div class="seemore"> </div>
         <?php } 
       

          else{ ?>
          <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_activity.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;"> Nothing to show </h3>
   </div>

        <?php  }

        ?>

</div>  


      <div class="profile_divs">

               <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Comments </h3>
          </div>

            <div id="all_commments">  </div>
            
            <?php if($commentsCount==0) { ?>
              <br> <br>


  <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_comments.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;"> No comments found  </h3>
   </div>
          <?php } ?>
           <div class="seemore"> </div>
          <input type="hidden" value="0" id="row_nos" name="">
     
        

    
            <div class="cl"> </div>
      <div>    </div>
      
       </div>

 <?php if($this->session->userdata('email')){ ?>
  <div class="profile_divs">
            <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Links </h3>
      </div>
      <?php 
            if($privacy->links_show==1) { ?>
        <div id="all_buyers">  </div>

          <input type="hidden" value="0" id="row_noss" name="">

            <div class="load_img"> </div>
    
            <div class="cl"> </div>

       <?php if($linksCount==0) {  ?>
             <br><br>
  <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_links.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;"> No Links found  </h3>
   </div>
       <?php } ?>

      <?php if($linksCount > 5) {  ?>
       <div> <p class="text-center"> <a href="<?php echo base_url(); ?>Users/Links/<?php echo $authId; ?>"> See more </a> </p>   </div>
        <?php }
      }

      else { ?>

        <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_links.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;">Nothing to show </h3>
   </div>

     <?php } ?>
      
        </div>

        <?php } ?>

</div> <!--  <end of right> -->

   



  </div>

</div>
</div>
</div>
</div>

</div>

 
<div class="modal" data-backdrop="true" id="blockModal" role="dialog" style="width: 20%;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" style="padding-left: 15%;" > Block User</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;">   
            &nbsp;&nbsp; Are You sure you want to block this user? </p>
        
            <a href="#" value="yes" id="del_y" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" id="del_n" class="mbtn-right"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div>


  <div class="modal fade" id="spinModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Post Spinned</h4>
        </div>
        <div class="modal-body" style="padding: 0px;" >
         <div>
          <div  style="width: 20%; margin-left: 40%;">
            <img src="<?php echo base_url(); ?>assets/img/tick.jpg" width="100%" >
          </div>
          <div style="background: #f5f5f5;padding: 15px 0px;"> 
           <h2 style="color: #444;text-align: center;">  Your post has been spinned successfully  </h2>
          </div>
        </div>
        </div>      
      </div>
      
    </div>
  </div>


 <span id="rep_post"></span>
  <span id="rep_mod"></span>
  <span id="rep_admin"></span>
  <span id="msg_pbu"></span>
  
  <span id="status_mod"></span>

 <div  class="modal fade" data-backdrop="true" id="submitModal" role="dialog" style="">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header"> 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px;">Report Submitted</h4>
        </div>
       <div class="modal-body" style="padding: 0px;" > 
         <div>
          <div  style="width: 20%; margin-left: 40%;">
            <img src="<?php echo base_url(); ?>assets/img/tick.jpg" width="100%" >
          </div>
          <div style="background: #f5f5f5;padding: 15px 0px;"> 
           <span id="suc_msg"></span>
          </div>
        </div>
        </div> 
      </div>
    </div>
  </div>

<div class="modal fade" id="likeModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Likes</h4>
        </div>
        <div class="modal-body">
            <div id="postLikes"> </div>
        </div>
       
      </div>
      
    </div>
  </div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/cropper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/main1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main2.js"></script>

 <script type="text/javascript">
   
   $(document).ready(function(){
     


       

   });

   function block(uid){
      authId=uid;
      $("#blockModal").modal("show");
      }

     $("#del_y").click(function(){ 
        uid=authId;
         $.ajax({
            url: "<?php echo base_url(); ?>settings/block/"+uid,
            method: "post",
            data: {uid: uid},
            success: function(response){
                window.location.href="<?php echo base_url(); ?>";
            }
          });
      });
    
       $("#del_n").click(function(){
            $("#blockModal").modal('hide');  
       });  


function spin(pid, uid, key){
  
    $.ajax({
    url: '<?php echo base_url() ?>Feeds/spinPost/'+pid+'/'+uid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
        $("#spinModal").modal('show');
      
    }
    
    
  });
}




  function report_post(pid, uid, pbu, key){


      $("#rep_post").html('<div  class="modal" data-backdrop="true" id="reportModal" role="dialog" style="width: 265px;margin: 0px auto; ">    <div class="modal-dialog">            <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width: 47%;">   <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Post</h4>     </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">               <ul style="list-style: none;">          <li class="lie"> <strong>  Why are you reporting this post? </strong> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href=""> Infringes my rights  </a> <span><input type="radio" name="ir" style=" height: 11px;" onclick="rights('+pid+')">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#" > Its not Interesting or fake content  </a> <span><input type="radio" name="ir" onclick=\'(op2(2,"'+pid+'", "'+uid+'", "'+pbu+'"))\' style="height: 11px;">  </span>  </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#" > Nudity or Violence </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(3,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Its spam </a> <span><input type="radio" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'",'+key+'))\' name="ir"  style="height: 11px;">  </span> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#"> Promotes terrorism </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Child abuse  </a>  <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(6,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>           <li class="lio"> <a  style="width: 42%;float: left;" class="text-black" href="#">  Harmful dangers acts  </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(7,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#">  Hateful content </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(8,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>   </li>                              </ul>        </div>              </div>          </div>  </div>');    


        $("#reportModal").modal('show');      
       

    }



    function op2(opt, pid, uid, pbu, key){

     
          $("#reportModal").modal('hide');
                

               $("#rep_mod").html(' <div  class="modal" data-backdrop="true" id="option2" role="dialog" style="width: 280px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width:50%;">    <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> What you can do </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">                          <ul style="list-style: none;">     <span id="rspm">  </span>                <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Report Admin  </a> <span><input type="radio" onclick="report_admin('+opt+','+pid+','+uid+', '+key+' )" name="ir" style=" height: 11px;">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" > Hide Post   </a> <span><input type="radio" onclick=" hide_post('+pid+')" name="ir" style="height: 11px;">  </span>  </li>                    <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#"> Disconnect  '+pbu+' </a> <span><input type="radio" onclick="disconnect('+uid+');" name="ir" style="height: 11px;">  </span> </li>                      <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#"> Block  '+pbu+'  </a>  <span><input onclick="block('+uid+');" type="radio" name="ir" style="height: 11px;">  </span>  </li>                                                   </ul>        </div>              </div>          </div>  </div>');
                if(opt==4){
                  $("#rspm").html('<li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Mark as Spam  </a> <span><input type="radio" onclick="mark_spam('+opt+','+pid+','+uid+', '+key+' );return false;" name="ir" style=" height: 11px;">  </span>  </li> ');
                }

          $("#option2").modal('show');

    }


    function report_admin(opt, pid, uid, key){
          
          $("#option2").modal('hide');
          $("#rep_admin").html('<div  class="modal" data-backdrop="true" id="report_admin" role="dialog" style="width: 290px;margin: 150px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width:51.5%">    <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> Report Admin </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="admin_msg" id="admin_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type min 100 Characters" rows="6"></textarea>     <br> <input type="button" id="rep_admin_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

          $("#report_admin").modal('show');

          $("#rep_admin_btn").click(function(){

                if($("#admin_msg").val().length < 100){
                  $("#rep_ad_msg").html("<br><div style='margin-left: 15px;'>please write your report in atleast 100 character </div>").css({"color":"red", "font-size": "12px", "font-weight" : "bold"});
                  return false;
                }
                if($("#admin_msg").val().length > 450){
                  $("#rep_ad_msg").html("<br><div style='margin-left: 15px;'> Max 450 character allowed </div>").css({"color":"red", "font-size": "12px", "font-weight" : "bold"});
                  return false;
                }
                var data = {opt :opt, pid: pid, uid: uid, action: 1, msg: $("#admin_msg").val()};
                $.ajax({
                    url: "<?php echo base_url(); ?>settings/report_admin",
                    data: data,
                    method: "post",
                    datatype: "json",
                    success: function(response){
                       $("#report_admin").modal('hide');
                      if(response==1){
                       $("#suc_msg").html("<h2 style='text-align: center; '>Report submited </h2>").css("color", "black");
                        $("#submitModal").modal('show');
                        $(".post"+key).hide();
                      }

                      if(response==2){
                         $("#suc_msg").html("<h2 style='text-align: center; '>Already Reported </h2>").css("color", "black");;
                         $("#submitModal").modal('show');

                      }
                    }
                });



          });

           $("#admin_msg").keyup(function(){

                if($("#admin_msg").val().length > 450){
                  $("#rep_ad_msg").html("<br><div style='margin-left: 15px;'> Max 450 character allowed </div>").css({"color":"red", "font-size": "12px", "font-weight" : "bold"});
                  return false;
                }
            });
    }


    function disconnect(uid){
          
          $.ajax({
            url: "<?php echo base_url(); ?>settings/disconnect/"+uid,
            method: "post",
            success: function(response){
             location.reload();

            }


          });


    }

    


          

  

   function mark_spam(opt, pid, uid, key){
    
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/mark_spam",
      type: "post",
      data: {pid: pid, uid: uid},
      success: function(response){
          if(response){
            // $(".post"+key).hide();
            $("#option2").modal('hide');
            $("#submitModal").modal("show");
            $("#suc_msg").html("<h2 style='text-align: center; '> Report Submitted </h2> ");
          }
      }

    })
 }
     function msg_rep(pid,uid,pbu){
          
          $("#option2").modal('hide');
          $("#msg_pbu").html('<div  class="modal" data-backdrop="true" id="msg_pb" role="dialog" style="width: 290px;margin: 150px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                    <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> Message '+pbu+' </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="pb_msg" id="pb_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type your message" rows="6"></textarea>     <br> <input type="button" id="rep_pb_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

          $("#msg_pb").modal('show');

          $("#rep_pb_btn").click(function(){

                               
                if($("#pb_msg").val().length > 450){
                  $("#rep_ad_msg").html("<br><div style='margin-left: 15px;'> Max 450 character allowed </div>").css({"color":"red", "font-size": "12px", "font-weight" : "bold"});
                  return false;
                }
                var data = { pid: pid, uid: uid, action: 5, msg: $("#pb_msg").val()};
               
                $.ajax({
                    url: "<?php echo base_url(); ?>settings/message_author",
                    data: data,
                    method: "post",
                    datatype: "json",
                    success: function(response){
                       $("#msg_pb").modal('hide');
                      if(response==1){
                       $("#suc_msg").html("<h2 style='text-align: center; '>Report submited </h2>");
                        $("#submitModal").modal('show');
                      }

                      if(response==2){
                       $("#suc_msg").html("<h2 style='text-align: center; '>Already Reported </h2> ");
                       $("#submitModal").modal('show');
                      }
                    }
                });



          });
    }

     function rights(pid){

      location.href="<?php echo base_url(); ?>settings/copyright/"+pid;
    }

      function postLikes(pid){
        $.ajax({
          url: "<?php echo base_url(); ?>Feeds/postLikes/"+pid,
          type: "post",
          data: {}, 
          success: function(response){
              $("#likeModal").modal("show");
            $("#postLikes").html(response);
          }
        });
 }
  


       function unfmodal(id){
      $("#unf").html('<div class="modal fade" id="unfModal" role="dialog">    <div class="modal-dialog modal-sm">      <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title"> &nbsp; Unfriend User </h4>        </div>        <div class="modal-body" style="padding: 0px;">          <br>          <p> Are you sure you want to unfriend this user? </p>          <br>           <a href="#" onclick="disconnect('+id+');" value="yes" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" class="mbtn-right" data-dismiss="modal"> No </a>        </div>      </div>    </div>  </div> ');

      $("#unfModal").modal("show");
    }  


  function blkmodal(id){
      $("#blk").html('<div class="modal fade" id="blkModal" role="dialog">    <div class="modal-dialog modal-sm">      <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title"> &nbsp; Block User </h4>        </div>        <div class="modal-body" style="padding: 0px;">          <br>          <p> Are you sure you want to block this user? </p>          <br>           <a href="#" onclick="block('+id+');" value="yes" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" class="mbtn-right" data-dismiss="modal"> No </a>        </div>      </div>    </div>  </div> ');
      $("#option2").modal("hide");
      $("#blkModal").modal("show");
    }  
 </script>


<style type="text/css">
  
  .lie{
  padding: 4px 8px;
 
  
}
.lio{
    padding: 4px 8px;
    background: #DDDDDC; 
}

 .transp{
  background: rgba(0, 0, 0, 0.3) ;

color: #fff;
}

.ab {
    height: 60px;
    width: 60px;
    float: left;
    overflow: hidden;
    margin: 1px;
    position: relative;
   
     overflow: hidden;
    margin: auto;
  background-color: black;
  z-index: 1; 

}


 /*.ab:before{
  content: ' ';
  z-index: -1;
   
  
      background-size:cover; 
        position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    filter: blur(5px);
}*/

.ab img{
  position: absolute;
  top: 0px;
  left: 0px;
  
}

.thumbnail {
  
}
.thumbnail img {
  width: 100%;
}
.thumbnail img.portrait {
  width: 100%;
  height: auto;
}
</style>