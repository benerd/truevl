<link rel="stylesheet" href="<?php echo base_url();?>assets/css/cropper.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main1.css">
 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>

 <script type="text/javascript">
   
       $(document).ready(function(){
         var count=0;
         var tcount=0;  
       
         $(document).scrollTop(0); 
            loadActivity();

          $(window).scroll(function ()
              {

            
              
                wh();
        });
 
     

 function wh(){
   if($(window).scrollTop() >= ($(document).height() - $(window).height())*0.8)
          {
             
              loadActivity();
          }
 }
 



    function loadActivity() 
    {
         $(window).unbind('scroll');
      var val = document.getElementById("row_no").value;     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Users/loadBuyer/<?php echo $f; ?>',
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
      
        $(window).bind('scroll', wh); 
         
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
<br clear="all">
<div id="profile_wrapper">
  

  <div id="inner"> 
  
     <?php  include("includes/profile_side.php"); ?>


    <div id="right1"> 
    
    <div class="profile_divs">
  
          <div class="head_container" style="width: 100%;">
            <h3> &nbsp; About </h3>
          </div>

           <div class="uinfo">
   
       
         <?php if( $userdata->work!=NULL){ ?>
          <div class="boxes">
        <i class="fa fa-thumbs-up" aria-hidden="true"></i>  <span id="work">  I am a  <?php echo $userdata->work; ?> </span> <a href="#" onclick="update_work('work', 'wr'); return false;" > <i id="wr" class="fa fa-pencil-square-o" aria-hidden="true"></i>  </a>  </div><?php } ?>
     

       
          <?php if( $userdata->address!=NULL){ ?> <div class="boxes">
       <i class="fa fa-location-arrow" aria-hidden="true"></i>  <span id="add"> Lives in <?php echo $userdata->address; ?> </span><a href="#"  onclick="update_add('add', 'ad'); return false;" > <i id="ad" class="fa fa-pencil-square-o" aria-hidden="true"></i> </a> </div>  <?php } ?>
        

        <div class="boxes">

       <i class="fa fa-mobile" aria-hidden="true"></i>  <span id="mob"> <?php echo $userdata->mobile; ?> </span> <a href="#"  onclick="update_mob('mob', 'mb');return false;"  > <i id="mb" class="fa fa-pencil-square-o" aria-hidden="true"></i> </a> 
        </div>

      </div>

       <div class="uinfo">
        
         <?php if( $userdata->website!=NULL){ ?> <div class="boxes">
         <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  <span id="website"> <?php echo $userdata->website; ?> </span><a href="#"  onclick="update_web('website', 'web');return false;" > <i id="web" class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>  </div>   <?php } ?>
        
        <div class="boxes">
         <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Joined <?php echo $userdata->joining_date; ?>  
        </div>
     
     
      </div>  

     
    </div>

    
<div class="profile_divs">
      
      <div class="head_container" style="width: 100%;">
            <h3> &nbsp; Activity </h3>
          </div>

            <div id="all_activity">  </div>

          <input type="hidden" value="0" id="row_no" name="">

            <div id="load_img"> </div>
    
            <div class="cl"> </div>
     

  <br>  <br>
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

    
    url: '<?php echo base_url() ?>timeline/likePost/'+pid+'/'+uid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){

     
        
  
         $.get("<?php echo base_url(); ?>timeline/nlikes/"+pid, function(data, status){
        $(".nvotes").eq(key).html(data);
        
    });
    
      
    }
    
    
  });

}

function spin(pid, uid, key){

    $.ajax({

    
    url: '<?php echo base_url() ?>timeline/spinPost/'+pid+'/'+uid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){

       
        alert("your post has been shared");
        window.location="<?php echo base_url() ?>timeline/";
         $.get("<?php echo base_url(); ?>timeline/nspins/"+pid, function(data, status){
        $(".nspins").eq(key).html(data);
        return false; 
    });
    
      
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
          url: "<?php echo base_url(); ?>timeline/status_replies/"+pid,
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

          url: "<?php echo base_url(); ?>timeline/post_comment/"+pid,
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
           url:"<?php echo base_url(); ?>timeline/user_comments/",
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
           url:"<?php echo base_url(); ?>timeline/user_comments/",
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
    


<style type="text/css">
  
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


.thumbnail {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: black;
}
.thumbnail img {
  position: absolute;
  left: 50%;
  top: 50%;
  height: 100%;
  width: auto;
  -webkit-transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
          transform: translate(-50%,-50%);
}
.thumbnail img.portrait {
  width: 100%;
  height: auto;
}
</style>
  