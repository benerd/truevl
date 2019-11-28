<link rel="stylesheet" href="<?php echo base_url();?>assets/css/cropper.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>

 <script type="text/javascript">
   
    $(document).ready(function(){
         var count=0; 
         var tcount=0;  
         $(document).scrollTop(0); 
            loadPromotion();
          $(window).scroll(function ()
          {
                wh();
    });
 
    function wh(){
      if($(window).scrollTop() >= ($(document).height() - $(window).height())*0.8)
          {
            loadPromotion();
          }
    }
 
    function loadPromotion() 
    {
      var val = document.getElementById("row_no").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadPromotion/<?php echo $f; ?>',
      data: {
       getresult:val
      },
      async: false,
      beforeSend: function() {
        
        $("#load_img").html("<img src='<?php echo base_url(); ?>assets/img/giphy.gif' height='32px' height='32px' ");

      },
      success: function (response) {

          $("#all_activity").append(response);
          document.getElementById("row_no").value = Number(val)+3;


           if(response=="null"){
           $("#load_img").html("");    
        } 
      },
       complete: function() { 
       }

      });
    }




  });
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

<?php
if(isset($f1)){
  foreach ($authuser as $key => $userdata) {
  
  }
}
?>


<div id="profile_wrapper">
  

  <div id="inner"> 
  
     <?php  
      if(isset($f1)){
        include("includes/author_side.php"); 
      }
      else{
        include("includes/profile_side.php"); 
      }
      ?>


    <div id="right1"> 


    
<div class="profile_divs">
      
      <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Promoted Posts </h3>
          </div>

            <div id="all_activity">  </div>

          <input type="hidden" value="0" id="row_no" name="">

            <div id="load_img"> </div>
    
            <div class="cl"> </div>
     

  <br>  <br>
</div>
</div>

 <div class="modal fade" id="spinModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 70%;margin-top: 250px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Post Spinned</h4>
        </div>
        <div class="modal-body">
          <p> Your post has been spinned successfully</p>
        </div>
       
      </div>
      
    </div>
  </div>    

 <span id="rep_post"></span>
  <span id="rep_mod"></span>
  <span id="rep_admin"></span>
  <span id="msg_pbu"></span>
  
  <span id="status_mod"></span>

 <div  class="modal" data-backdrop="true" id="submitModal" role="dialog" style="width: 234px;margin: 150px auto; ">
    <div class="modal-dialog modal-sm">
    
     
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Submitted</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;padding: 20px">
         
            <p>  <span style="color: black;" id="rmsg"> </span>
             </p>
              <span id="suc_msg"></span>

        </div>
        
      </div>
      
    </div>
  </div>

<div class="modal" data-backdrop="true" id="disableModal" role="dialog" style="width: 20%;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" style="padding-left: 15%;" > Disable Comments </h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>  
            &nbsp;&nbsp; Are You sure you want disable comments on this post? </p>
            <a value="yes" id="del_y1" class="mbtn-left btn-gray"> Yes </a>
            <a value="no" id="del_n1" class="mbtn-right"> No </a>
          
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


function like(pid, uid, key){
  
    $.ajax({

    
    url: '<?php echo base_url() ?>Feeds/likePost/'+pid+'/'+uid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){

     
        
  
         $.get("<?php echo base_url(); ?>Feeds/nlikes/"+pid, function(data, status){
        $(".nvotes").eq(key).html(data);
        
    });
    
      
    }
    
    
  });

}

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


 function replies(pid, uid, key, pbuu){
      // alert(pid);
      // alert(uid);
      // alert(key);
      // alert(pbuu);
      user_comments(pid);

      $.ajax({
          url: "<?php echo base_url(); ?>Feeds/status_replies/"+pid,
          method: "post",
          datatype: "json",
          success: function(response){
            data=JSON.parse(response);
            console.log(data);
           
              $("#modal_img").attr("src", "<?php echo base_url() ?>"+data.img);
              $("#cmnt").css("background-color", "#f5f5f5");
              if(uid=='<?php echo $userId; ?>'){
                  $("#post_info").html("<a class='text-white' href=''>" + pbuu + "  </a>");
              } 

              else{
                 $("#post_info").html("<a class='text-white' href=''>" + pbuu + "  </a> Made a comment").addClass("text-white").css("font-weight", "bold");
              }
            
                $("#statusMod").modal('show');
            
                $("#modal_status_data").html(data.short_des).addClass(" user_status");

                $("#vote_mod").html('<a class="nv" onclick="like('+pid+', '+<?php echo $userdata->id;  ?>+' , '+key +');return false"href="#">  Vote </a> <span class="nvotes nv" id="nlikes"> '+data.nlikes+' </span>');

                $("#spin_mod").html('<a class="vote  "  href="#" onclick="spin('+pid+', '+uid+' , '+key +');return false;"> Spin </a> <span class="nspins nv"> </span></p> ');

                $("#reply_mod").html(' <a class="vote  "  href="#" onclick=""> Reply </a> <span class="nspins nv"> </span></p>  ');

                $("#txt_mod").html(' <textarea type="text" name="status_comment" id="status_comment" style="width: 100%;resize: none; " placeholder="Type your reply" onkeyup="increase(event,'+pid+');"></textarea>');



          }


      });
      
     
    }

    function increase(e, pid){
     
     if(e.keyCode==13){
        var data=$("#status_comment").val();
        $("#status_comment").html("");
        document.getElementById("status_comment").innerHTML="";
        document.getElementById("status_comment").value="";
      $.ajax({

          url: "<?php echo base_url(); ?>Feeds/post_comment/"+pid,
          data: {"data" : data},
          method: "post",

          success: function(response){
            if(response){
                  user_comments(pid);
            }
            else{
                return false;
            }
          }
});
   

     }

      var x=document.getElementById("status_comment").style.height;
      var len=document.getElementById("status_comment").value.length;
     
      if(len > 70){
        document.getElementById("status_comment").style.height="60px";
      }
      else{
         document.getElementById("status_comment").style.height="40px";
      }


    }

function user_comments(pid)    
{


      $.ajax({
           url:"<?php echo base_url(); ?>Feeds/user_comments/",
           method:"POST",
           data: {pid: pid},
           dataType:"json",
           success:function(data)
           {
                
                
                $(".mod-replies").html(data.output);
 
            }
          });

      t= setInterval(function(){  

          $.ajax({
           url:"<?php echo base_url(); ?>Feeds/user_comments/",
           method:"POST",
           data: {pid: pid},
           dataType:"json",
           success:function(data)
           {
                if(data.count > 5){
                  $("#loadmore_rep").html('<div style="width: 100%; background: #f5f5f5; margin-bottom: 10px;text-align: center;cursor: pointer" onclick="load_previous('+pid+', '+data.count+', '+t+' );"> Load Older </div> ');
                }
                

                  $(".mod-replies").html(data.output);
             
              }
          });

        }, 1000);
    

        $('#statusMod').on('hidden.bs.modal', function () {
           
            clearInterval(t);
            $("#loadmore_rep").html('');
            $("#loadnew_rep").html('');
        });

 }
  
 </script>
    
<script type="text/javascript">

  

   function hide_post(id, key){


        $("#hideModal").modal('show');  

      $("#hid_y").click(function(){
              $.ajax({
         url: "<?php echo base_url(); ?>Feeds/hide_post/",
         data: {id: id },
         method: "post",
         success: function(response){
           $(".post"+key).hide();
             $("#hideModal").modal('hide');  
         }
      });  
      });
    
       $("#hid_n").click(function(){
            $("#hideModal").modal('hide');  
       }); 
    }

    function report_post(pid, uid, pbu, key){
      $("#rep_post").html('<div  class="modal" data-backdrop="true" id="reportModal" role="dialog" style="width: 265px;margin: 0px auto; ">    <div class="modal-dialog">            <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width: 47%;">   <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Post</h4>     </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">               <ul style="list-style: none;">          <li class="lie"> <strong>  Why are you reporting this post? </strong> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href=""> Infringes my rights  </a> <span><input type="radio" name="ir" style=" height: 11px;" onclick="rights('+pid+')">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#" > Its not Interesting or fake content  </a> <span><input type="radio" name="ir" onclick=\'(op2(2,"'+pid+'", "'+uid+'", "'+pbu+'"))\' style="height: 11px;">  </span>  </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#" > Nudity or Violence </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(3,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Its spam </a> <span><input type="radio" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'",'+key+'))\' name="ir"  style="height: 11px;">  </span> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#"> Promotes terrorism </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Child abuse  </a>  <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(6,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>           <li class="lio"> <a  style="width: 42%;float: left;" class="text-black" href="#">  Harmful dangers acts  </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(7,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#">  Hateful content </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(8,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>   </li>                              </ul>        </div>              </div>          </div>  </div>');    
        $("#reportModal").modal('show');      
    }



    function op2(opt, pid, uid, pbu, key){
          $("#reportModal").modal('hide');
               $("#rep_mod").html(' <div  class="modal" data-backdrop="true" id="option2" role="dialog" style="width: 283px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width:50%;">    <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> What you can do </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">                          <ul style="list-style: none;">     <span id="rspm">  </span>                <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Report Admin  </a> <span><input type="radio" onclick="report_admin('+opt+','+pid+','+uid+','+key+' )" name="ir" style=" height: 11px;">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" > Hide Post   </a> <span><input type="radio" onclick=" hide_post('+pid+')" name="ir" style="height: 11px;">  </span>  </li>                    <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#"> Disconnect  '+pbu+' </a> <span><input type="radio" onclick="disconnect('+uid+');" name="ir" style="height: 11px;">  </span> </li>                      <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#"> Block  '+pbu+'  </a>  <span><input onclick="block('+uid+');" type="radio" name="ir" style="height: 11px;">  </span>  </li>                                                  </ul>        </div>              </div>          </div>  </div>');
                if(opt==4){
                  $("#rspm").html('<li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Mark as Spam  </a> <span><input type="radio" onclick="mark_spam('+opt+','+pid+','+uid+', '+key+' );return false;" name="ir" style=" height: 11px;">  </span>  </li> ');
                }

          $("#option2").modal('show');

    }


    function report_admin(opt, pid, uid, key){
          
          $("#option2").modal('hide');
          $("#rep_admin").html('<div  class="modal" data-backdrop="true" id="report_admin" role="dialog" style="width: 290px;margin: 150px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width: 51.4%;">     <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px;  padding: 5px 5px;"> Report Admin </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="admin_msg" id="admin_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type min 250 words" rows="6"></textarea>     <br> <input type="button" id="rep_admin_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

          $("#report_admin").modal('show');

          $("#rep_admin_btn").click(function(){

                if($("#admin_msg").val().length < 250){
                  $("#rep_ad_msg").html("<br><div style='margin-left: 15px;'>please write your report in atleast 250 character </div>").css({"color":"red", "font-size": "12px", "font-weight" : "bold"});
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
                       $("#rmsg").html("Report submited").css("color", "black");
                        $("#submitModal").modal('show');
                      
                        $(".post"+key).hide();
                      }

                      if(response==2){
                         $("#rmsg").html("Already Reported").css("color", "black");;
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
                       $("#rmsg").html("Report submited");
                        $("#submitModal").modal('show');
                      }

                      if(response==2){
                       $("#rmsg").html("Already Reported");
                       $("#submitModal").modal('show');
                      }
                    }
                });



          });

           $("#pb_msg").keyup(function(){

                if($("#pb_msg").val().length > 450){
                  $("#rep_ad_msg").html("<br><div style='margin-left: 15px;'> Max 450 character allowed </div>").css({"color":"red", "font-size": "12px", "font-weight" : "bold"});
                  return false;
                }
            });
    }

    function rights(pid){

      location.href="<?php echo base_url(); ?>settings/copyright/"+pid;
    }

     function mark_spam(opt, pid, uid, key){
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/mark_spam",
      type: "post",
      data: {pid: pid, uid: uid},
      success: function(response){
          if(response){
            
            $("#option2").modal('hide');
            $("#submitModal").modal("show");
            $("#suc_msg").html("&nbsp;&nbsp;&nbsp;&nbsp;Report Submitted");
            $.ajax({
             url: "<?php echo base_url(); ?>Feeds/hide_post/",
             data: {id: pid },
             method: "post",
             success: function(response){
               $(".post"+key).hide();
             }
            });  
    
          }
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
                 $("#loadcomments"+key).html('<div class="pcomments'+key+'" style="width: 100%;float: left;position:relative; margin-bottom: 10px;">        <p style="background: #f5f5f5;color: #444;border: 1px solid #afafaf;text-align: center; font-weight:bold; width: 97%;padding: 3px;"> Comments are disabled on this post</p>          </div>');

               
                 $(".dc"+key).attr("onclick", "enableComments("+pid+", "+key+");return false;").html("<i class='fa fa-check'> </i> Enable comments");
               
            }
            else{
               console.log(response);
            }
            }
            });
      });
    
       $("#del_n1").click(function(){
            $("#disableModal").modal('hide');  
       });
  }

  function enableComments(pid, key){
     
      $.ajax({
        url: "<?php echo base_url(); ?>Feeds/enableComments",
        type: "post",
        data: {pid:pid},
        success: function(response){

         
          $(".dc"+key).attr("onclick", "disableComments("+pid+", "+key+");return false;").html("<i class='fa fa-ban'> </i> Disable comments on this post");
          // user_comments(pid, key);
        }
      });
  }

  function ab(i){
      $(document).on('click', function(e) {
      if ( $(e.target).closest("#lnk"+i).length ) {
        $(".po"+i).show();
      }else if ( ! $(e.target).closest(".po"+i).length ) {
        $(".po"+i).hide();
      }
  });
}


</script>

<style type="text/css">
   .modal.in{z-index:10000!important}
.modal-backdrop.in{z-index:9999!important}
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


 

.ab img{
  position: absolute;
  top: 0px;
  left: 0px;
  
}

#wrapper{
  background-color:  rgba(0,0,0,0.8);
}



.thumbnail img {
   width: 100%;
}

.lie{
  padding: 4px 8px;
  font-size: 14px !important;
  
}
.lio{
    padding: 4px 8px;
    background: #DDDDDC; 
    font-size: 14px !important; 
}

</style>
  