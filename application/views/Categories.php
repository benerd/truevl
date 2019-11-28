<script type="text/javascript">
   
var iScrollPos = 0;
      $(document).ready(function(){
         $(document).scrollTop(0); 
           loadmore();

          $(window).scroll(function ()
              {

            
              
                wh();
        });
 
     

 function wh(){
   if($(window).scrollTop() >= ($(document).height() - $(window).height())*0.8)
          {
             
               loadmore();
          }
 }
 
   

  
 

    

  function loadmore() 
    {
      $(window).unbind('scroll');
     
      var val = document.getElementById("row_no").value;
      var content = document.getElementById("all_rows").innerHTML;
      var contenta= document.getElementById("all_rows");
      var c,c1,gsb;
     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Feeds/loadpost/2',
      data: {
       getresult:val, cat: '<?php echo $cat; ?>'
      },
      async: false,
      beforeSend: function() {
        
        $("#loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loadingg.gif' width='100%'> <br> <img src='<?php echo base_url(); ?>assets/img/loadingg.gif' width='100%'>");

      },
      success: function (response) {
          $("#all_rows").append(response);
          document.getElementById("row_no").value = Number(val)+10; 
      },

      complete: function() {
      
        $(window).bind('scroll', wh); 
         $("#loading_img").html("");
         
       }

      });
    }
});

      function cmntNow(pid,key){
        $("#absPos").css("background", "#454545d1");
          user_comments(pid);
        $("#modal_status_data").html("<textarea style='width:99%; color: #000;' onkeyup='increase(event,"+pid+", "+key+");' id='status_comment'></textarea>");
      }

      function repcmnt(rid,i,pid,uid,key,unm,pp){
          $.ajax({
           url:"<?php echo base_url(); ?>Feeds/user_replies/",
           method: "POST",
           data: {rid: rid},
           dataType:"json",
           success:function(data)
            {
              $(".mod-replies"+i).html(data.output);
              console.log(data.output);
            }
          });
          $('.rep').not('#rep'+i).html("");
          $("#rep"+i).html("<textarea style='width:100%; color: #000;margin-top: 3px;height: 30px;' id='comments"+i+"' onkeyup='cmnt(event, "+rid+",\""+i+"\", "+pid+", "+uid+" , "+key+", \""+unm+"\",\""+pp+"\", 2);'></textarea> <div class='hiddendiv"+i+" hiddendiv' style='min-height: 30px;'> </div>");
          
      }

      function cmnt(e,rid,id,pid,uid,key,unm,pp,flag){
        content = $("#comments"+id).val();
         
        var x="";
        var counter=$(".ncmnts"+key).html();
        $('.hiddendiv'+id).html(content + '<br class="lbr">');
        $("#comments"+id).css('height',  $('.hiddendiv'+id).height());
     
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
              $.ajax({
              type: 'post',
              url: '<?php echo base_url();?>Feeds/post_comment/'+pid,
              data: {
                content:content, rid: rid
              },
              success: function (response){

                 $("#comments"+id).val('');              
                  replies(pid,uid,key,unm,pp);
                 if(flag==2){
                  repcmnt(rid,id,pid,uid,key,unm,pp);
                 }
                 else{
                  user_comments(pid);
                 }
                 $(".ncmnts"+key).html(parseInt(counter)+1);

              },
             });
        }
      }

      function updateScroll(){
      var element = document.getElementById("#absPos");
      element.scrollTop = element.scrollHeight;
      }
</script>

<style type="text/css">

#absPos{
    position: absolute;bottom: 13px;background: #6161613b;width: 89.1%; 
    padding: 12px 14px; min-height:20px;
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
 .ad_header{
  width: 90%;
  float: left;
  padding: 0px 0px 0px 0px ;
}

.ad_head_left{
  float: left;
  font-size: 18px;
  font-weight: bold;
  margin-left: 4px;
}

.ad_head_right{
  float: right;
  color: rgba(0,0,0,0.6);
  line-height: 15px;
}


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

.thumbnail {
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background: black;
}
.thumbnail img {
  position: absolute;
  left: 50%;
  top: 50%;
  height: 100%;
  width: 100%;
  -webkit-transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
          transform: translate(-50%,-50%);
}
.thumbnail img.portrait {
  width: 100%;
  height: auto;
}

</style>


<br clear="all"> 
<div id="content_wrapper" style="margin-top: 20px;">
<div id="inner">

<div id="Tleft"> 

<?php
foreach ($userData as $x ) {

  include("includes/side.php");
   } ?>

 </div>
<div id="Tcenter"> 
<div id="all_rows"> 


</div>

 <div id="load_data"></div>
   <div id="load_data_message"></div>

<div id="loading_img" width="100%"> </div>

  <input type="hidden" id="row_no" value="0">
  
  <?php if($pcount==0){

 ?>

   <div class="post" style="position: relative;">

    <br><br><br>
      <h1 class="text-center" style="color: rgba(0,0,0,0.6);"> No post found </h1>

        
         <br><br> <br>
   </div>

<?php } ?>
  
<!-- <edit status modal> -->

<span id="esmodal"></span>

<!-- <report modal> -->
  <span id="rep_post"></span>
  <span id="rep_mod"></span>
  <span id="rep_admin"></span>
  <span id="msg_pbu"></span>
  
  <span id="status_mod"></span>

 <div  class="modal" data-backdrop="true" id="submitModal" role="dialog" style="width: 250px;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Submitted</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;padding: 20px">
         
            <p> <i class="fa fa-check-circle-o" aria-hidden="true"></i> <span style="color: black;" id="rmsg"> </span>
             </p>
              <span id="suc_msg"></span>

        </div>
        
      </div>
      
    </div>
  </div>


<div class="modal" id="statusMod" role="dialog"> 
   <div class="modal-dialog" style="width: 40%;">            
    <div class="modal-content out_box" >           
        <div class="modal-body">
          <div>  <span id="post_info">   </span>      </div>
            
          <div>
            <div style="width: 100%;float: left;">
                  <div id="mod_img"> </div>
                  <div id="absPos">
                      <div class="mod-replies"> </div>
                   <p id="modal_status_data"> </p>   

                   <div class="post_footer">
                      <div class="row">
                      <div class="pull-left"> 
                          <span id="vote_mod"></span>
                      </div>

                      <div class="pull-left"> 
                          <span id="spin_mod"></span>
                      </div>

                      <div class="pull-left"> 
                          <span id="cmnt_mod"></span>
                      </div>

                       <div class="pull-left">  
                          <span id="reply_mod"></span>
                       </div>

                        <div class="pull-right"> <p > <a class=" text-white"  href="#" > Painic </a> <span class="nspins nv"> </span></p>   </div>


                      </div>


                  </div>
                      <div class="cl"></div>   
            </div>
                  
         </div>
              <div class="cl"></div>
          

         <!-- <div id="loadmore_rep"> </div> -->
        

        

          

            
    </div>         
   </div> 
</div>
</div>




  


  


</div>

<span id="delete_post">
  
<div  class="modal" data-backdrop="true" id="deleteModal" role="dialog" style="width: 60%;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Delete Post</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 20px;">
         
            <p class="text-center" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>   Are You sure you want to delete post </p>
           <p class="text-center" style="margin-bottom: 20px 0px;">
              <button value="yes" id="del_y" class="btn btn-danger"> Yes </button>
              <button value="no" id="del_n" class="btn"> No </button>
          </p>
        </div>
        
      </div>
      
    </div>
  </div>

</span>


<span id="hide_post">
  
<div  class="modal" data-backdrop="true" id="hideModal" role="dialog" style="width: 90%;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Hide Post</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 20px;">
         
            <p class="text-center" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>   Are You sure you want to hide post </p>
           <p class="text-center" style="margin-bottom: 20px 0px;">
              <button value="yes" id="hid_y" class="btn btn-danger"> Yes </button>
              <button value="no" id="hid_n" class="btn"> No </button>
          </p>
        </div>
        
      </div>
      
    </div>
  </div>

</span>




<div id="Tright1">
<div id="aside"> 
<div class="head_container">
<h3> &nbsp; Categories </h3>
</div>

<div id="tp" class="tabcontent" style="padding: 0px;">
  
 <div class="content">  
<div class="aside">
  
  <div id="all_rows2">
    <ul>      
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" >  <a href="<?php echo base_url();?>Categories/Videos"> Videos  </a> </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Blogs"> Blogs </a>  </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Breaking-News"> Breaking News </a>  </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Education"> Education </a> </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Current-Affairs"> Current Affairs </a> </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Environmental"> Environmental </a>  </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Government"> Government </a> </li>
    
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Sports"> Sports </a> </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > 
        <a href="<?php echo base_url();?>Categories/Newspapers">Newspapers  </a> </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Politics"> Politics </a>  </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Religion-and-Spirituality"> Religion-and-Spirituality </a>  </li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Technology"> Technology  </a></li>
      <li> <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" width="30px" height="30px" valign="middle" > <a href="<?php echo base_url();?>Categories/Entertainment"> Entertainment </a>   </li>


    </ul>
  </div>

  <div id="loading_img2"></div>
       <input type="hidden" id="row_noss" value="0">
  </div>
      
  
 </div>
</div>
</div>
</div>

<div id="Tright"> 
<div id="aside"> 


  <div id="s-buyer">
    <h2 class="text-center side_heading pad5"> Suggested Buyers </h2> 
<div class="mrl">



<?php 

foreach ($suggest as $key => $Suggested) {
      if($Suggested[0]['active']==1){
       
       if($key <=4){
 ?>

<div class="buyer">
      <img valign="top" src="<?php echo $Suggested[0]['profile_pic']; ?> " >

      <div class="re">
      <p  class=" unm"> <a valign="top" style="color: rgba(0,0,0,0.7);"  href="<?php echo base_url().'tuser/'.$Suggested[0]["otp"].$Suggested[0]["id"].'/'.str_replace(" ", "-",  $Suggested[0]["name"]); ?>">  <?php echo $Suggested[0]["name"]; ?> </a>  </p> 

      <p class="text-gray"> Acvtity <?php echo $suggest["activity"]; ?> </p>

      <div style="width: 100%;">
      <p style="float: left; width: 60%; color: #797979" class=""> Links <?php echo $suggest["links"]; ?> </p>
     
     <div class="join jo<?php echo $key; ?>"> 

    <?php if($lpdata[$key][0]["link_up"]==1) { ?> 
     <a  style="color: #fff;font-weight: 400;background: #006097; height: 18px;display: inline-block;" onclick="join(<?php echo $userId; ?>,<?php echo $Suggested[0]['id'] ?>,<?php echo $key; ?>); return false;" href="#" class="j<?php echo $key; ?>" > Linkup </a> 
    <?php } ?>
     </div> </div> </div>
       </div>
<?php } } }  ?>

   

      <br clear="all">  
      <div class="cl">  </div>
         <div align="center">   <a href="<?php echo base_url(); ?>Feeds/seemoreFriends" class=" text-center" style="color: #333;">  See more   </a>  </div> 
  </div>
</div>

<div id="rp" class="tabcontent">

 <div class="content">  
<div class="aside">
 
<div style="width: 95%">
      <div class="ad_header">
      <div class="ad_head_left"> </div>

        <div class="ad_head_right"> <small>  Advertisement  </small> </div>
      </div>

      <div class="ad_img">
        <img src="<?php echo base_url(); ?>assets/img/side_ad.jpg" width="100%">
      </div>

      <div class="ad-content"> 
        <p> <small> lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor </small>  </p>
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



 
 
 </div>




  <div class="modal fade" id="spinModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 70%;">
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


    <div class="modal fade" id="painicModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 70%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Painic </h4>
        </div>
        <div class="modal-body">
          <p> Some text here <br>
            <div id="painic_btn"> </div>  
          </p>
        </div>
       
      </div>
      
    </div>
  </div>
  
</div>

<?php include 'includes/footer.php';  ?>
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
$(document).on('click', function(e) {
    if ( $(e.target).closest("#lnk"+i).length ) {
        $(".po"+i).show();
    }else if ( ! $(e.target).closest(".po"+i).length ) {
        $(".po"+i).hide();
    }
});

}






function ask(pid){

 
      $("#deleteModal").modal('show');  

      $("#del_y").click(function(){

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
       // alert('Your Post has been Deleted...');
         window.location="<?php echo base_url(); ?>Feeds/";
    
    }
    else{
       console.log(response);
      // e.preventDefault();
    }
         }
    });
});
    
       $("#del_n").click(function(){
            $("#deleteModal").modal('hide');  
       });
   
  
}


function join(uid,fid, key){
   $.ajax({

    
    url: '<?php echo base_url() ?>Users/addFriend/'+uid+'/'+fid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
      console.log(response);
      if(response==1)
      {
     
       $(".j"+key).css({"background": "#fff", "border": "1px solid #ccc", "color": "#ccc"});
       $(".j"+key).html("Sent");
    
    } 
    if(response==0){
          alert("you can't sent link request to this user");
    
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
        $("#spinModal").modal('show');
      
    }
    
    
  });
}


function painic(pid, uid, key){
  
    $("#painicModal").modal('show');   

    $("#painic_btn").html('<br> <br> <button class="pull-right btn-danger" style="width: 20%;" data-dismiss="modal" > Cancel </button>  <button class="pull-right btn-success" style="width: 20%;margin-right: 10px;" onclick="painicPost('+pid+', '+uid+', '+key+')" > Yes </button>   <br> <br> ');

   
}

function painicPost(pid, uid,key){
     $.ajax({ 
        url: '<?php echo base_url() ?>Feeds/painicPost/'+pid+'/'+uid,
        type: 'POST', 
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
          $(".post"+key).hide();
             $("#painicModal").modal('hide');   
        }     
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


      $("#rep_post").html('<div  class="modal" data-backdrop="true" id="reportModal" role="dialog" style="width: 250px;margin: 150px auto; ">    <div class="modal-dialog">            <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                  <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Post</h4>     </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">               <ul style="list-style: none;">          <li class="lie"> <strong>  Why are you reporting this post? </strong> </li>            <li class="lio"> <a style="width: 38%;float: left;" class="text-black" href=""> Infringes my rights  </a> <span><input type="radio" name="ir" style=" height: 11px;" onclick="rights('+pid+')">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 38%;float: left;" class="text-black" href="#" > Its not Interesting or fake content  </a> <span><input type="radio" name="ir" onclick=\'(op2(2,"'+pid+'", "'+uid+'", "'+pbu+'"))\' style="height: 11px;">  </span>  </li>            <li class="lio"> <a style="width: 38%;float: left;" class="text-black" href="#" > Nudity or Violence </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(3,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 38%;float: left;" class="text-black" href="#"> Its spam </a> <span><input type="radio" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'",'+key+'))\' name="ir"  style="height: 11px;">  </span> </li>            <li class="lio"> <a style="width: 38%;float: left;" class="text-black" href="#"> Promotes terrorism </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 38%;float: left;" class="text-black" href="#"> Child abuse  </a>  <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(6,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>           <li class="lio"> <a  style="width: 38%;float: left;" class="text-black" href="#">  Harmful dangers acts  </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(7,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 38%;float: left;" class="text-black" href="#">  Hateful content </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(8,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>   </li>                              </ul>        </div>              </div>          </div>  </div>');    


        $("#reportModal").modal('show');      
       

    }



    function op2(opt, pid, uid, pbu, key){

     
          $("#reportModal").modal('hide');
                

               $("#rep_mod").html(' <div  class="modal" data-backdrop="true" id="option2" role="dialog" style="width: 250px;margin: 150px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                    <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> What you can do </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">                          <ul style="list-style: none;">     <span id="rspm">  </span>                <li class="lio"> <a style="width: 38%;float: left;" class="text-black" href="#" "> Report Admin  </a> <span><input type="radio" onclick="report_admin('+opt+','+pid+','+uid+' )" name="ir" style=" height: 11px;">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 38%;float: left;" class="text-black" href="#" > Hide Post   </a> <span><input type="radio" onclick=" hide_post('+pid+')" name="ir" style="height: 11px;">  </span>  </li>                    <li class="lio"> <a style="width: 38%;float: left;" class="text-black" href="#"> Disconnect  '+pbu+' </a> <span><input type="radio" onclick="disconnect('+uid+');" name="ir" style="height: 11px;">  </span> </li>                      <li class="lie"> <a style="width: 38%;float: left;" class="text-black" href="#"> Block  '+pbu+'  </a>  <span><input onclick="block('+uid+');" type="radio" name="ir" style="height: 11px;">  </span>  </li>           <li class="lio"> <a  style="width: 38%;float: left;"class="text-black" href="#">  Message '+pbu+' for this issue </a><span><input onclick=\'(msg_rep("'+pid+'", "'+uid+'", "'+pbu+'"))\' type="radio" name="ir" style="height: 11px;">  </span>  </li>                                          </ul>        </div>              </div>          </div>  </div>');
                if(opt==4){
                  $("#rspm").html('<li class="lie"> <a style="width: 38%;float: left;" class="text-black" href="#" "> Mark as Spam  </a> <span><input type="radio" onclick="mark_spam('+opt+','+pid+','+uid+', '+key+' );return false;" name="ir" style=" height: 11px;">  </span>  </li> ');
                }

          $("#option2").modal('show');

    }


    function report_admin(opt, pid, uid, key){
          
          $("#option2").modal('hide');
          $("#rep_admin").html('<div  class="modal" data-backdrop="true" id="report_admin" role="dialog" style="width: 290px;margin: 150px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                    <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> Report Admin </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="admin_msg" id="admin_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type min 250 words" rows="6"></textarea>     <br> <input type="button" id="rep_admin_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

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

   
   



    function replies(pid, uid, key, pbuu,pp){
     
    
    
    
      $.ajax({
          url: "<?php echo base_url(); ?>Feeds/status_replies/"+pid,
          method: "post",
          datatype: "json",
          success: function(response){
            data=JSON.parse(response);
              // alert($(window).height()*0.8);
              $(".out_box").css("height", $(window).height()*0.9+"px");
              $("#cmnt").css("background-color", "#f5f5f5");
             
                  $("#post_info").html("<span class='icoL'>Posted By:  <a class='icoL Postedby' href=''>" + pbuu + "  </a> | "+data.posted_on);
             

            
           
              
                if(data.is_status==4){
                  $("#mod_img").html("<img src='<?php echo base_url() ?>"+data.img+"' >  ").css("height", $(window).height()*0.82+"px");
                }

                if(data.is_status==2 ){
                  $("#mod_img").html("<img src='"+data.img+"'> ").css("height", $(window).height()*0.82+"px");;
                }


                if(data.is_status==1 || data.is_status==4){
                $("#modal_status_data").html(data.short_des).addClass(" blog_des text-white").css("color", "white");
                }
                if(data.is_status==2){
                  
                $("#modal_status_data").html(data.main_des).addClass("blog_des text-white").css("color", "white");;  
                }

                $("#vote_mod").html('<a class="text-white" onclick="like('+pid+', '+<?php echo $x->id;  ?>+' , '+key +');return false"href="#">  Vote </a> <span class="nvotes text-white" id="nlikes"> '+data.nlikes+' </span>');

                $("#spin_mod").html('<a class="text-white  spc"  href="#" onclick="spin('+pid+', '+uid+' , '+key +');return false;"> Spin </a> <span class="nspins "> </span></p> ');

                 $("#cmnt_mod").html('<a class="text-white  spc"  href="#" onclick="cmntNow('+pid+', '+key+');"> Comment </a> <span class="nspins "> </span></p> ');

                // $("#reply_mod").html(' <a class="vote  "  href="#" onclick=""> Reply </a> <span class="nspins nv"> </span></p>  ');

                $("#txt_mod").html(' <textarea type="text" name="status_comment" id="status_comment" style="width: 100%;resize: none; " placeholder="Type your reply" onkeyup="increase(event,'+pid+', '+key+');"></textarea>');
                  $("#statusMod").modal('show');
              
          }


      });
      
     
    }

    function increase(e, pid,key){
    
     if(e.keyCode==13){
      
        var data=$("#status_comment").val();
        $("#status_comment").html("");
        document.getElementById("status_comment").innerHTML="";
        document.getElementById("status_comment").value="";
        var counter=$(".ncmnts"+key).html();
        $(".ncmnts"+key).html(parseInt(counter)+1);
        $.ajax({

          url: "<?php echo base_url(); ?>Feeds/post_comment/"+pid,
          data: {"content" : data, "rid": 0},
          method: "post",

          success: function(response){
            user_comments(pid);
            $(".ncmnts"+key).html(parseInt(counter)+1);

          }
      });
   

     }

      var x=document.getElementById("status_comment").style.height;
      var len=document.getElementById("status_comment").value.length;
     
      if(len > 120){
        document.getElementById("status_comment").style.height="70px";
      }
      else{
         document.getElementById("status_comment").style.height="40px";
      }


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


 function edit_status(pid) {
    $("#esmodal").html('<div class="modal fade" id="editstatusModal" role="dialog">    <div class="modal-dialog">             <div class="modal-content" style="width: 400px; margin-left: 20%;">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title"> Update Status </h4>        </div>        <div class="modal-body">         <div id="usstatus">            <form action="" method="post" onsubmit="return update_user_status('+pid+');">                <textarea rows="5" id="edit_status"></textarea>                <br>                <span style="font-weight: bold; color: red; font-size: 11px;" id="s_msg"></span>                                <div align="right"><button class="btn"> Update </button> </div>            </form>                          </div>        </div>             </div>          </div>  </div>');
      $("#editstatusModal").modal('show');
   $.ajax({
      url: "<?php echo base_url(); ?>Feeds/edit_status/"+pid,
      method: "post",
      success: function(response){
       
        response=JSON.parse(response);
        console.log(response);
     
          $("#edit_status").html(response.short_des);
      }


   });

 }
 
function update_user_status(pid){
    var status=$("#edit_status").val();
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/update_user_status/"+pid,
      data: {status: status},
      method: "post",
      success: function(response){
       
       
        location.reload();
        
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
           
              if(1){
                $("#loadnew_rep").html('<div style="width: 100%; background: #f5f5f5; margin-bottom: 10px;text-align: center;cursor: pointer" onclick="load_newer('+pid+', '+count+', '+t+' );"> Load Newer </div> ');
              }
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
            $(".post"+key).hide();
            $("#option2").modal('hide');
          }
      }

    })
 }

 

</script>

 
  
