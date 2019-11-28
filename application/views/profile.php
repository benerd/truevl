<link rel="stylesheet" href="<?php echo base_url();?>assets/css/cropper.min.css"> 
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main1.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>
 
<script type="text/javascript">
   $(document).ready(function(){
      var count=0;
      var tcount=0;  
      loadActivity();
      loadComments();
      loadBuyer();
      loadPromotion();

    function loadActivity()  
    {   
      var activityCount=<?php echo $activityCount; ?>;
      var val = document.getElementById("row_no").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadActivity/0',
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
             $(".seemore").eq(0).html('<div class="cl"> </div><div> <p class="text-center"> <a href="<?php echo base_url(); ?>activities/<?php echo $rand; ?>/<?php echo $unm; ?> "   id="" > See More </a> </p>   </div>');
           }
        }
      });
    }

    function loadPromotion() 
    {
      var promoCount=<?php echo $promoCount; ?>;
      var val = document.getElementById("prow_no").value;     
      $.ajax({
      type: 'post', 
      url: '<?php echo base_url();?>Users/loadPromotion/0',
      data: {
       getresult:val
      },
      beforeSend: function() {
          $(".load_img").eq(1).html("<img src='<?php echo base_url(); ?>assets/img/loadingg.gif' width='100%'>");
      }, 
      success: function (response) {
          $(".load_img").eq(1).html("");
          $("#all_promos").append(response);
          if(promoCount > 3){
            document.getElementById("row_no").value = Number(val)+3;  
            $(".seemore").eq(1).html('<div class="cl"> </div><div> <p class="text-center"> <a href="<?php echo base_url(); ?>PromotedPosts/<?php echo $rand; ?>/<?php echo $unm; ?>" id="" > See More </a> </p>   </div>   ');   
          }
      }

      });
    } 

    function loadComments() 
     {
      var commentsCount=<?php echo $commentsCount; ?>;
      var val = document.getElementById("row_nos").value;  
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadComments/0',
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

           $(".seemore").eq(2).html(' <div class="cl"> </div>  <div><p class="text-center"> <a href="<?php echo base_url(); ?>comments/<?php echo $rand; ?>/<?php echo $unm; ?>"> See More </a> </p> </div>         ');    
          }
          }  
    
      });
    }


     function loadBuyer() 
    {
      var val = document.getElementById("row_noss").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadBuyer/0',
      data: {
       getresult:val
      },
      // datatype: "json",
      beforeSend: function() {
        
        $("#load_img").html("<img src='<?php echo base_url(); ?>assets/img/giphy.gif' height='32px' height='32px' ");

      },
      success: function (response) {
          $("#all_buyers").append(response);
             document.getElementById("row_noss").value = Number(val)+6;
             if(response=="null"){
             $(".seemore").eq(3).html('  <?php if($linksCount > 5) {  ?>
       <div> <p class="text-center"> <a href="<?php echo base_url(); ?>Users/Links/<?php echo $userId; ?>"> See more </a> </p>   </div>        <?php } ?>'); 
          } 
      }

      });
    }

  });

     

      function updateScroll(){
      var element = document.getElementById("#absPos");
      element.scrollTop = element.scrollHeight;
      }

    function user_comments(pid)    
{
     var element = document.getElementById("#absPos");
     $.ajax({
           url:"<?php echo base_url(); ?>Feeds/user_comments/",
           method: "POST",
           data: {pid: pid},
           dataType:"json",
           success:function(data)
            {
              $(".mod-replies").html(data.output);
              $('.mod-replies').scrollTop($('.mod-replies')[0].scrollHeight);
            }
          });
         
 }  


 function editPost(pid, key){
    var desc=$("#hidesc"+key).val();

    $(".blog_des"+key).html("<textarea onkeyup='editNow("+key+","+pid+");' style='padding: 3px;border: 1px solid #ddd;' id='editPost"+key+"'>"+desc+"</textarea><div id='editPostBtn"+key+"'></div>").show();
      var input = $("#editPost"+key);
      var len = input.val().length;
      input[0].focus();
      input[0].setSelectionRange(len, len);
  }

  function editNow(key,pid){
    $("#editPostBtn"+key).html("<input type='button' class='btn-primary' value='Update' style='width: 12%; height: 24px;margin-bottom: 5px;' onclick='editPostNow("+key+","+pid+")'>");
  }

  function editPostNow(key,pid){
    var content=$("#editPost"+key).val();
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/editPost",
      type: "post",
      data: {content: content, pid: pid},
      success: function(response){
        $(".blog_des"+key).html(response);
        $("#hidesc"+key).attr("value", response);
        $("#pstedit"+key).html("Post edited successfully").css({"color": "#ccc", "margin":"5px 0px", "border":"1px solid #ccc", "width": "98%","padding":"0px 3px"}).fadeOut(2000);
      }
    });
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
</script>   

    <script type="text/javascript">
  



function landing(url){
  window.location=""+url+"";
}

</script>


<?php
  foreach ($userData as $key => $userdata) {
  
  }
?>

<div id="profile_wrapper">
  

  <div id="inner"> 
  
     <?php  include("includes/profile_side.php"); ?>


    <div id="right1"> 
     
     
<div class="profile_divs">
      
      <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Activity </h3>
          </div>

            <div class="load_img"> </div>
            <div id="all_activity">  </div>

          <input type="hidden" value="0" id="row_no" name="">

            
    
            <div class="cl"> </div>


            <?php if($activityCount==0) {  ?>
                
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
      
      <div class="load_img"> </div>
        <div id="all_promos">  </div>
        <input type="hidden" value="0" id="prow_no" name="">

        <div class="cl"> </div>


            <?php  if($promoCount==0) {  ?>
                
                 <br><br>
  <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_activity.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;"> No Activity found  </h3>
   </div>


            <?php }  ?>

            <div class="seemore">  </div>
</div>    

    <div class="profile_divs" style="z-index: 1">

       <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Comments </h3>
          </div>

            <div id="all_commments">  </div>

          <input type="hidden" value="0" id="row_nos" name="">

          <?php if($commentsCount==0) { ?>
              <br> <br>


  <div align="center">  <img src="<?php echo base_url(); ?>assets/img/no_comments.png" height="80" width="95" valign="middle" > 
   <h3 style="color: #ccc;"> No comments found  </h3>
   </div>
          <?php } ?>

          <div class="seemore"> </div>

            <div class="load_img"> </div>
    
            <div class="cl"> </div>
      <div>    </div>
   
    </div>
    
      
    <div class="profile_divs" style="z-index: 1">
      
      <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Links </h3>
      </div>

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

        <div class="seemore">  </div>
    

    </div>

    </div> <!--  <end of right> -->

  

  </div>

</div>
</div>
</div>
</div>

</div>

 <?php //include("includes/footer.php"); ?>

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




<div class="modal fade" data-backdrop="true" id="disableModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title"> &nbsp;&nbsp; Disable Comments </h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;">  
            &nbsp;&nbsp; Are You sure you want disable comments on &nbsp;&nbsp; this post? </p>
            <a style="cursor: pointer;" value="yes" id="del_y1"  class="mbtn-left btn-gray"> Yes </a>
            <a style="cursor: pointer;width: 48%;" href="#" value="no" id="del_n1" class="mbtn-right"> No </a>
          
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
  $(document).click(function() {
  for(i=0; i<=1000; i++){
     $(".poa"+i).hide();
     $(".pob"+i).hide();
     $(".po"+i).hide();
  }
});

   $(document).ready(function(){
      $(".camera").mouseover(function(){
          $(".camera").css("border", "1px solid");
      
            $(".camera").addClass("transp");
          $("#ch").html("Update cover pic").css("font-size","14px");


      });

      $(".camera").mouseout(function(){
          $(".camera").css("border", "none");
            $(".camera").css("padding", "0px 0px");
              $(".camera").removeClass("transp");
          $("#ch").html("");


      });

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

 function disableComments(pid, key){

     $("#disableModal").modal('show'); 
    
      $("#del_y1").click(function(){
          $.ajax({
            url: '<?php echo base_url() ?>Feeds/disableComments/'+pid,
            type: 'POST', 
            cache: false,
            contentType: false,
            processData: false,
           
            success: function(response){
            if(response==1)
              {
                $("#disableModal").modal('hide');
                 $("#loadComments"+key).html('<div class="pcomments'+key+'" style="width: 100%;float: left;position:relative; margin-bottom: 10px;">        <p style="background: #f5f5f5;color: #444;border: 1px solid #afafaf;text-align: center; font-weight:bold; width: 97%;padding: 3px;"> Comments are disabled on this post</p>          </div>');

                 $(".dc"+key).attr("onclick", "enableComments("+pid+", "+key+");return false;").html("<i class='fa fa-check'> </i> Enable comments");
               return false;
            }
            else{
               console.log(response);
            }
            }
            });
      });
    
       $("#del_n1").click(function(){
            $("#disableModal").modal('hide');  
            return false;
       });
  }

  function enableComments(pid, key){
     
      $.ajax({
        url: "<?php echo base_url(); ?>Feeds/enableComments",
        type: "post",
        data: {pid:pid},
        success: function(response){

          user_comments(pid, key);
          $(".dc"+key).attr("onclick", "disableComments("+pid+", "+key+");return false;").html("<i class='fa fa-ban'> </i> Disable comments on this post");
        }
      });
  }



  function report_post(pid, uid, pbu, key){


      $("#rep_post").html('<div  class="modal" data-backdrop="true" id="reportModal" role="dialog" style="width: 280px;margin: 0px auto; ">    <div class="modal-dialog">            <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width: 50%;">   <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Post</h4>     </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">               <ul style="list-style: none;">          <li class="lie"> <strong>  Why are you reporting this post? </strong> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href=""> Infringes my rights  </a> <span><input type="radio" name="ir" style=" height: 11px;" onclick="rights('+pid+')">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#" > Its not Interesting or fake content  </a> <span><input type="radio" name="ir" onclick=\'(op2(2,"'+pid+'", "'+uid+'", "'+pbu+'"))\' style="height: 11px;">  </span>  </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#" > Nudity or Violence </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(3,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Its spam </a> <span><input type="radio" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'",'+key+'))\' name="ir"  style="height: 11px;">  </span> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#"> Promotes terrorism </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Child abuse  </a>  <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(6,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>           <li class="lio"> <a  style="width: 42%;float: left;" class="text-black" href="#">  Harmful dangers acts  </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(7,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#">  Hateful content </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(8,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>   </li>                              </ul>        </div>              </div>          </div>  </div>');    


        $("#reportModal").modal('show');      
       

    }



    function op2(opt, pid, uid, pbu, key){

     
          $("#reportModal").modal('hide');
                

               $("#rep_mod").html(' <div  class="modal" data-backdrop="true" id="option2" role="dialog" style="width: 300px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width:53%;">    <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> What you can do </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">                          <ul style="list-style: none;">     <span id="rspm">  </span>                <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Report Admin  </a> <span><input type="radio" onclick="report_admin('+opt+','+pid+','+uid+' )" name="ir" style=" height: 11px;">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" > Hide Post   </a> <span><input type="radio" onclick=" hide_post('+pid+')" name="ir" style="height: 11px;">  </span>  </li>                    <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#"> Disconnect  '+pbu+' </a> <span><input type="radio" onclick="unfmodal('+uid+');" name="ir" style="height: 11px;">  </span> </li>                      <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#"> Block  '+pbu+'  </a>  <span><input onclick="blkmodal('+uid+');" type="radio" name="ir" style="height: 11px;">  </span>  </li>                                                  </ul>        </div>              </div>          </div>  </div>');
                if(opt==4){
                  $("#rspm").html('<li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Mark as Spam  </a> <span><input type="radio" onclick="mark_spam('+opt+','+pid+','+uid+', '+key+' );return false;" name="ir" style=" height: 11px;">  </span>  </li> ');
                }

          $("#option2").modal('show');

    }


    function report_admin(opt, pid, uid, key){
          
          $("#option2").modal('hide');
          $("#rep_admin").html('<div  class="modal" data-backdrop="true" id="report_admin" role="dialog" style="width: 290px;margin: 150px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                    <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> Report Admin </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="admin_msg" id="admin_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type min 100 characters" rows="6"></textarea>     <br> <input type="button" id="rep_admin_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

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
                       $("#suc_msg").html("<h2 style='text-align: center'>Report submited </h2>").css("color", "black");
                        $("#submitModal").modal('show');
                        $(".post"+key).hide();                 
                      }

                      if(response==2){
                         $("#suc_msg").html("<h2 style='text-align: center'> Already Reported </h2>").css("color", "black");;
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

     function block(uid){
          
          $.ajax({
            url: "<?php echo base_url(); ?>settings/block/"+uid,
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
            $("#suc_msg").html("<h2 style='text-align: center'>Report Submitted </h2> ");
          }
      }

    })
 }
     function msg_rep(pid,uid,pbu){
          
          $("#option2").modal('hide');
          $("#msg_pbu").html('<div  class="modal " data-backdrop="true" id="msg_pb" role="dialog" style="width: 290px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                    <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> Message '+pbu+' </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="pb_msg" id="pb_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type your message" rows="6"></textarea>     <br> <input type="button" id="rep_pb_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

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
                       $("#suc_msg").html("<h2 style='text-align: center'> Report submited </h2>");
                        $("#submitModal").modal('show');
                      }

                      if(response==2){
                       $("#suc_msg").html("<h2 style='text-align: center'>Already Reported </h2>");
                       $("#submitModal").modal('show');
                      }
                    }
                });



          });
    }

     function rights(pid){

      location.href="<?php echo base_url(); ?>settings/copyright/"+pid;
    } 

       function unfmodal(id){
      $("#unf").html('<div class="modal fade" id="unfModal" role="dialog">    <div class="modal-dialog modal-sm">      <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title"> &nbsp; Unfriend User </h4>        </div>        <div class="modal-body" style="padding: 0px;">          <br>          <p> Are you sure you want to unfriend this user? </p>          <br>           <a href="#" onclick="disconnect('+id+');" value="yes" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" class="mbtn-right" data-dismiss="modal"> No </a>        </div>      </div>    </div>  </div> ');
      $("#option2").modal("hide");
      $("#unfModal").modal("show");
    }  


  function blkmodal(id){
      $("#blk").html('<div class="modal fade" id="blkModal" role="dialog">    <div class="modal-dialog modal-sm">      <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title"> &nbsp; Block User </h4>        </div>        <div class="modal-body" style="padding: 0px;">          <br>          <p> Are you sure you want to block this user? </p>          <br>           <a href="#" onclick="block('+id+');" value="yes" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" class="mbtn-right" data-dismiss="modal"> No </a>        </div>      </div>    </div>  </div> ');
      $("#option2").modal("hide");
      $("#blkModal").modal("show");
    }  

</script>



<style type="text/css">

.modal.in{z-index:10000!important}
.modal-backdrop.in{z-index:9999!important}

#absPos{
    position: absolute;bottom: 13px;background: #6161613b;width: 89.1%; 
    padding: 12px 14px; min-height:20px;
} 

  .lie{
  padding: 4px 8px;
 
  
}
.lio{
    padding: 4px 8px;
    background: #DDDDDC; 
}


.mod-replies::-webkit-scrollbar { 
    display: none; 
    overflow-y: scroll;
}
.mod-replies{
  max-height: 310px; overflow-y: scroll;
}

#mod_img{
   width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    background: #000;
}

#mod_img img{
  flex-shrink:0;
  -webkit-flex-shrink: 0;
  max-width:70%;
  max-height:90%;
}  

 .transp{
  background: rgba(0, 0, 0, 0.3) ;
  color: #fff;
}

#wrapper{
  background-color:  rgba(0,0,0,0.8);
}



.thumbnail img {
  width: 100%;
}

   .post-opt{
  display: none;
 width: 310px;
margin-top: 10px;
font-size: 11px;
position: absolute;
font-family: 'Lucida Grande', Tahoma, Verdana, Arial, sans-serif;
z-index: 1;
right: .1%;
background-color: white;
padding: 9px 11px;
background: rgba(255, 255, 255);
border: 1px solid #c5c5c5;
-webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
-moz-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
}

.post-opt .tip {
background-image: url('<?php echo base_url(); ?>assets/img/tip.png');
background-repeat: no-repeat;
background-size: auto;
height: 11px;
position: absolute;
top: -11px;
right: 12px;
width: 20px;
}
 
.post-opt ul li{
   padding-top: 5px;
  padding-bottom: 5px;
  padding-left: 10px;
  /*padding-left: 10px;*/
  border-bottom: 1px solid #ddd;
   color: #999;
}

.post-opt ul li a:hover{
  font-weight: bold;
  text-decoration: none;
}
.post-opt ul li a{
  width: 100%;
  color: #000;
  font-size: 14px;
  line-height:16px; 
  font-weight: none;
  display: inline-block;
  width: 100%;
}




</style>