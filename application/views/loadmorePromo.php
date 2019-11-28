<?php
  foreach ($userData as $key => $userdata) {
   
  } 
?> 
  <?php 

 
    if($postData!=NULL){

      foreach ($postData as $key => $PD) {
        $PD=$PD[0];
        $kkey=$key+$no; 
        if($PD["post_status"]==1 ){

              $url=$PD["short_des"]; 
              $url=base64_encode($url);
              $url=str_replace("/","-", $url);
          

      ?>

    <div class="t1 post<?php echo $kkey; ?>" style="position: relative;">  
    <div class="row">
    <div class="post_title">
      <a class="blue userName pull-left" href="<?php echo $url; ?>">  
      <?php echo $PD["post_title"]; ?> 
      </a>
    </div>
    <div class="dots">
      <a href="#" onclick="ab(<?php echo $kkey ?>);return false;"  class="pull-right dott" id="lnk<?php echo $kkey; ?>"> <img src="<?php echo base_url()?>assets/img/tdot.jpg" class="tdot">  </a> 
  </div> <div class="cl"> </div>  </div> 
    <div class="post-opt  po<?php echo $kkey; ?>"> 
         <span class="tip"></span>
      <ul>
      <li class="lie"> <a href="#" onclick="report_post(<?php echo $PD['post_id']; ?>,<?php echo $PD['user_id']; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>', <?php echo $key; ?>);return false;"> Report Post </a>        </li> 
       <?php
       if(count($check)>0 && $check->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $PD['user_id']; ?>);return false;"> Disconnect <?php echo $post_by_user[$key][0]['name']; ?> </a></li>      
    <?php } ?>
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $PD['post_id']; ?>,<?php echo $PD['user_id']; ?>,'<?php echo $post_by_user[$key][0]['name']; ?>', <?php echo $key; ?>); return false;"> Its spam </a></li>
      </ul>
    </div> <div class="cl"></div> 
     <hr style="background: #CCC; margin-top: 3px; ">
    <span style="font-size: 11px;" class="icoL"> Posted by <a class="icoL Postedby" href="<?php echo base_url(); ?>tuser/<?php echo $post_by_user[$key][0]['otp'].$PD['user_id']; ?>/<?php echo str_replace(" ", "-", $post_by_user[$key][0]['name']); ?>"> <?php 
     echo $post_by_user[$key][0]['name'];
     ?></a> </span> 
     <span style="font-size: 11px;" class="icoL">
     <?php
        $posted_on=new DateTime($PD["posted_on"]);
        $posted_on=$posted_on->format("d, F-Y | H:i:s");
        echo $posted_on;
      ?>
    </span>
    <div class="t1in">
    <?php if($PD["img"]!=NULL) { ?>
       <a class="blue userName pull-left" href="<?php echo $url; ?>">  
      <div class="thumbnail">
     <img src="<?php echo $PD['img']; ?>" style="z-index: 0"> </a>
   </div>
    <?php } ?> 

<?php if($PD["Vfile"]!=NULL){ ?>
    
    <div class="parent">
       <a class="blue userName pull-left" href="<?php echo $url; ?>">  
  <img class="image1" src="<?php echo base_url().$PD['thumb']; ?>">
 
 <img class="image2" src="<?php echo base_url().'/assets/img/play.png';?> " style=" height: 80px; width: 80px; border: none;" />  </a>

  </div>

<?php } ?> 
    </div>

    <hr style="background: #CCC; margin-top: 3px; ">

 <div class="post_footer">
      <div class="row">
     <div class="pull-left">       <?php

        if(count($likeArr[$key]) > 0){
         if($likeArr[$key]->likes==0){ ?>
          <button  style="border: none;background: none;" class="nv plk<?php echo $key; ?>" onclick="likep(<?php echo $PD["post_id"] ?>, <?php echo $uid; ?> , <?php echo $kkey; ?>,2);return false">  Vote </button>
            <?php } ?>
          <?php
          if($likeArr[$key]->likes==1){ ?>
          <button style="border: none;background: none;" class="nv plk<?php echo $kkey; ?>" onclick="likep(<?php echo $PD["post_id"] ?>, <?php echo $uid; ?> , <?php echo $key; ?>,1);return false" href="#">  Vote </button>
         <?php }}

          else{ ?>
            <button style="border: none;background: none;" class="nv plk<?php echo $kkey; ?>" onclick="likep(<?php echo $PD["post_id"] ?>, <?php echo $uid; ?> , <?php echo $key; ?>,2);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" href="#" onclick="postLikes(<?php echo $PD['post_id']; ?>);return false;" style="display: inline-block;min-height: 16px;" >
             <span class="pnovtes<?php echo $key; ?> icoL">
          <?php
        if($numLikes[$key][0]["sum"] ==1) {
         echo $numLikes[$key][0]["sum"]; 
          }
          else if($numLikes[$key][0]["sum"] >1){
           echo $numLikes[$key][0]["sum"]; 
          }
          else{
            echo "";
          }
        ?> 
         </span>
          
            <span class="pnovtess<?php echo $kkey; ?> icoL">
          <?php
        if($numLikes[$key][0]["sum"] ==1) {
         echo " Vote"; 
          }
          else if($numLikes[$key][0]["sum"] >1){
           echo " Votes"; 
          }
          else{
            echo "";
          }
        ?> 
         </span>
           </a>

            </div>  </div>

      <div class="pull-left"> <p > <a class="vote spc<?php echo $PD['post_id']; ?> "  href="#" onclick="spin(<?php echo $PD['post_id'];  ?>, <?php echo $uid;  ?> , <?php echo $key; ?>);return false;"> Spin </a> <span class="nspins nv"> </span></p>   </div>

     <div class="pull-left"> <p > <a class="vote"  href="<?php echo base_url(); ?>Comments/<?php echo $PD['post_id'];  ?>" > Comments </a> <span class="nspins nv"> </span></p>   </div>


      </div>

       <div class="cl"></div>
        <div class="cl"></div>
      <div class="row">
      <div class="pull-left"> &nbsp; </div>
          <div class="pull-right"> <p class="Postedby fs10"> <?php echo $PD["cat"]; ?> </p> </div>
      </div>
     
       <hr style="margin-bottom: 3px;">
  
           
  <div class="cl"></div>
  </div>
     </div>


<?php  } } } 


 

?>

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
<script type="text/javascript">
 
 function ab(i){
$(document).on('click', function(e) {
    if ( $(e.target).closest("#lnk"+i).length ) {
        $(".po"+i).show();
    }else if ( ! $(e.target).closest(".po"+i).length ) {
        $(".po"+i).hide();
    }
});
} 


  function likep(pid, uid, key,flag){
    var d= $(".pnovtes"+key).html();
    d=d.trim();
    if(d==""){
      d=0;
    }
    $.ajax({
    url: '<?php echo base_url() ?>Feeds/likePost/'+pid+'/'+uid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function(){
    },
    success: function(response){  
      $.get("<?php echo base_url(); ?>Feeds/checklikes/"+pid+"/"+<?php echo $userId; ?>, function(data, status){
      
        if(data==0){
          $(".plk"+key).css("font-weight", "400");
        }
        else if(data==1){
          $(".plk"+key).css("font-weight", "700");
        }
      }); 
       $.get("<?php echo base_url(); ?>Feeds/nlikes/"+pid, function(data, status){
        $(".pnovtes"+key).html(data);    
      
    }); 
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

<style type="text/css">
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