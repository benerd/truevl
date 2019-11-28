<script type="text/javascript">
   

	
$(document).ready(function(){
	
	loadmore();

	$(window).scroll(function ()
    {
      wh();
});

     

 function wh(){
   if($(window).scrollTop() >= ($(document).height() - $(window).height())*0.7)
          {
             
               loadmore();
          }
 }

	function loadmore(){

		   $(window).unbind('scroll');
			
	var val = document.getElementById("row_no").value;

    var content = document.getElementById("all_rows");
  	var contenta=document.getElementById("all_rows").innerHTML;
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Feeds/seemoreNotification/',
      data: {
       getresult:val
      },
      success: function (response) {
      	content.innerHTML=contenta+response;
		document.getElementById("row_no").value = Number(val)+10;

		$(window).bind('scroll', wh);   
      }
});

  }

});

</script>
<style type="text/css">
 


.parent {
  position: relative;
  top: 0;
  left: 0;
}
.image1 { 
  position: relative;
  top: 0;
  left: 0;
}
.image2 {
  position: absolute;
  top: 80px;
  left: 170px;  
}
 
.post-opt{
  display: none;
  position: absolute;
  left: 64%;
  border: 1px solid #ccc;
  border-radius: 3px;
  width: 150px;
  top:9%;
  background: #f5f5f5;
  z-index: 10;
}

 
.post-opt ul li{
   padding-top: 5px;
  padding-bottom: 5px;
  /*padding-left: 10px;*/
  border-bottom: 1px solid #000;
   color: #000;
}

.post-opt ul li:hover{
  background: #0093DD;
  color: #fff;

}

.post-opt ul li a{
  width: 100%;
  color: #000;
  font-size: 12px;
  line-height:16px; 
  font-weight: none;

}

.post-opt ul li a:hover{
  color: #fff;
}

.dott{
  cursor: pointer;
}

.lie{
  padding: 1px 5px;
 
  
}

.lio{
    padding: 1px 5px;
    background: #DDDDDC;
    
  
}

.buyer{
  width: 93%;
  margin: 3px;
}

#all_rows{
  margin-top: 5px;
}
</style>


<br clear="all"> 
<div id="content_wrapper">
<div id="inner">

<div id="Tleft" style="margin-top: 9px;"> 

<?php
foreach ($userData as $x ) {

  include("includes/side.php");
   } ?>

 </div>

<div id="Tcenter" > 
<div id="all_rows"> 


</div>

 

  <input type="hidden" id="row_no" value="0">
  

  
<!-- <edit status modal> -->






  




</div>

<div id="Tright" style="top: 56px;"> 
<div id="aside"> 


  <div id="s-buyer">
    <h2 class="text-center side_heading pad5"> Linkup Suggestions </h2> 
<div class="mrl">

<?php 

if(count($suggest) > 0){
foreach ($suggest as $key => $Suggested) {
      if($Suggested[0]['active']==1){
          
       if($key <=4){
 ?>

<div class="buyer">
      <img valign="top" src="<?php echo $Suggested[0]['profile_pic']; ?> " >

      <div class="re">
      <p  class=" unm"> <a valign="top" style="color: rgba(0,0,0,0.7);"  href="<?php echo base_url().'tuser/'.$Suggested[0]["otp"].$Suggested[0]["id"].'/'.str_replace(" ", "-",  $Suggested[0]["name"]); ?>">  <?php echo $Suggested[0]["name"]; ?> </a>  </p> 

      <p class="text-gray"> Acvtity <?php
      if(isset($suggest[$key]["activity"])){
       echo @$suggest[$key]["activity"]; ?> </p>
      <?php } ?>

      <div style="width: 100%;">
      <p style="float: left; width: 60%; color: #797979" class=""> Links <?php
        if(isset($suggest[$key]["links"])){
       echo @$suggest[$key]["links"];  }?> </p>
     
     <div class="join jo<?php echo $key; ?>"> 

    <?php if($lpdata[$key][0]["link_up"]==1) { ?> 
     <a  style="color: #fff;font-weight: 400;background: #006097; height: 18px;display: inline-block;" onclick="join(<?php echo $userId; ?>,<?php echo $Suggested[0]['id'] ?>,<?php echo $key; ?>); return false;" href="#" class="j<?php echo $key; ?>" > Linkup </a> 
    <?php } ?>
     </div> </div> </div>
       </div>
     <?php }
        } 
      }
       if(count($suggest) > 4){
      ?>

       <br clear="all">  
      <div class="cl">  </div>
         <div align="center">   <a href="<?php echo base_url(); ?>Feeds/seemoreFriends" class=" text-center" style="color: #333;">  See more   </a>  </div> 
<?php }
    } 

else{ ?>
<div class="buyer">
<h3> Nothing to show</h3>
 </div>
<?php } ?>

   

   

      <br clear="all">  
      <div class="cl">  </div>
      
</div>

<div id="rp" class="tabcontent">

 <div class="content">  
<div class="aside">
 
<div style="width: 95%">
      <div class="ad_header">
      <div class="ad_head_left"> <small>  Reliance  </small> </div>

        <div class="ad_head_right"> <small>  Advertisement  </small> </div>
      </div>

      <div class="ad_img">
        <img src="<?php echo base_url(); ?>assets/img/side_ad.jpg" width="100%">
      </div>

      <div class="ad-content"> 
        <p> orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor </p>
      </div>

      
    </div>

 
</div>
      

 </div>

</div>



</div>
</div>






</div>
</div>
</div>
</div>

</div>
<div class="cl"> </div>

</div>

 <?php include("includes/footer.php"); ?>

 
 
 </div>
</body>
</html>

<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


  

<script type="text/javascript">
  
$(document).click(function() {
  for(i=0; i<=1000; i++){
     $(".po"+i).hide();
  }
        
           
        });

function ab(i){
  
  var lnk=$("#lnk"+i);
  var po=$(".po"+i);
  

  lnk.click(function(){
    po.show(); return false;
  });

    

        po.click(function(e) {
            e.stopPropagation();
        });

}





function ask(pid){

      $('<div></div>').appendTo('body')
                    .html('<div><h3>Are you sure you want to delete?</h3></div>')
                    .dialog({
                        modal: true, title: 'Delete Post', zIndex: 10000, autoOpen: true,
                        width: 'auto', resizable: false,
                        buttons: {
                            Yes: function () {
                              
                                 $.ajax({

    
          url: '<?php echo base_url() ?>Feeds/delete_post/'+pid,
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
      // console.log(response);
  
      if(response==1)
      {
      // console.log(response);
       alert('Your Post has been Deleted...');
         window.location="<?php echo base_url(); ?>Feeds/";
    
    }
    else{
      alert("sorry you cannot delete this post");
       console.log(response);
      // e.preventDefault();
    }
     
      
    }
    
    
  });
                                
                                
                                
                                $(this).dialog("close");
                            },
                            No: function () {                                                            
                            
                                $(this).dialog("close");
                            }
                        },
                        close: function (event, ui) {
                            $(this).remove();
                        }
                    });
   
  
}



function join(uid,fid){
   $.ajax({

    
    url: '<?php echo base_url() ?>Feeds/addFriend/'+uid+'/'+fid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){

      if(response==1)
      {
     
       alert('Your request has been sent. ');
       window.location="<?php echo base_url(); ?>Feeds/";
    
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

       
        alert("your post has been shared");
        window.location="<?php echo base_url() ?>Feeds/";
         $.get("<?php echo base_url(); ?>Feeds/nspins/"+pid, function(data, status){
        $(".nspins").eq(key).html(data);
        return false; 
    });
    
      
    }
    
    
  });
}




</script>

 <script type="text/javascript">

 

         


    

   



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

                $("#vote_mod").html('<a class="nv" onclick="like('+pid+', '+<?php echo $x->id;  ?>+' , '+key +');return false"href="#">  Vote </a> <span class="nvotes nv" id="nlikes"> '+data.nlikes+' </span>');

                $("#spin_mod").html('<a class="vote  "  href="#" onclick="spin('+pid+', '+uid+' , '+key +');return false;"> Spin </a> <span class="nspins nv"> </span></p> ');

                $("#reply_mod").html(' <a class="vote  "  href="#" onclick=""> Reply </a> <span class="nspins nv"> </span></p>  ');

                $("#txt_mod").html(' <textarea type="text" name="status_comment" id="status_comment" style="width: 100%;resize: none; " placeholder="Type your reply" onkeyup="increase(event,'+pid+');"></textarea>');



          }


      });
      
     
    }

   
function load_previous(pid, count, t){

   clearInterval(t);
      count=count-5;
  $.ajax({
    url: "<?php echo base_url(); ?>Feeds/load_prev",
    data: {pid: pid, count: count},
    method: "post",
    dataType:"json",
    success: function(res){
                clearInterval(t);
                if(res.count > 5){
                  $("#loadmore_rep").html('<div style="width: 100%; background: #f5f5f5; margin-bottom: 10px;text-align: center;cursor: pointer" onclick="load_previous('+pid+', '+res.count+', '+t+');"> Load Older </div> ');
                }
                else{
                   $("#loadmore_rep").html('');
                }
                
                $(".mod-replies").html(res.output);

                
                $("#loadnew_rep").html('<div style="width: 100%; background: #f5f5f5; margin-bottom: 10px;text-align: center;cursor: pointer" onclick="load_newer('+pid+', '+res.count+', '+t+' );"> Load Newer </div> ');
             
    }

  });
}
 

 function load_newer(pid, count, t){
    clearInterval(t);
    count=count+5;
    $.ajax({
    url: "<?php echo base_url(); ?>Feeds/load_newer",
    data: {pid: pid, count: count},
    method: "post",
    dataType:"json",
    success: function(res){
                clearInterval(t);
                
                  $("#loadmore_rep").html('<div style="width: 100%; background: #f5f5f5; margin-bottom: 10px;text-align: center;cursor: pointer" onclick="load_previous('+pid+', '+count+', '+t+');"> Load Older </div> ');
              
               
                
                $(".mod-replies").html(res.output);
              alert(count);
              alert(res.count);
              if(1){
                $("#loadnew_rep").html('<div style="width: 100%; background: #f5f5f5; margin-bottom: 10px;text-align: center;cursor: pointer" onclick="load_newer('+pid+', '+count+', '+t+' );"> Load Newer </div> ');
              }
    }

  });
 }



 

</script>

 
  
 