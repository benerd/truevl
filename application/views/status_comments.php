<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
$(document).ready(function(){ 
replies(<?php echo $lp[0]->post_id;  ?>, <?php echo $lp[0]->user_id;  ?> , <?php echo 1; ?>, '<?php echo $post_by_user->name; ?>', '<?php echo $post_by_user->otp; ?>','<?php echo $post_by_user->name ?>');
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

  // function cmnt(e,rid,id,pid,uid,key,unm,pp,flag,kkey){
  //        content = $("#comments"+id).val();
  //        if(content.length  > 0){
  //          $(".repBtn"+key).html("<button onclick='cmntreply(event,"+rid+",\""+id+"\","+pid+","+uid+","+key+",\""+unm+"\",\""+pp+"\","+flag+","+kkey+");return false;' class='btn-primary'  style='width: 38px;font-size: 11px;' id='cmntreply'> Post </button>"); 
  //        }
  //        else{
  //         $(".repBtn"+key).html("");
  //        }
  //     } 
  var counterr=0;
      function cmntreply(e,rid,id,pid,uid,key,unm,pp,flag,kkey){
        $("#cmntreply").attr("disabled", "true");
        content = $("#comments"+id).val(); 
        var x=y="";
        var replyCount=$(".replyCount"+key).html();
        var counter=$(".ncmnts"+key).html();
              $.ajax({
              type: 'post',
              url: '<?php echo base_url();?>Feeds/post_comment/'+pid,
              data: {
                content:content, rid: rid,kkey:kkey
              },
              success: function (response){
                 $("#comments"+id).val('');              
                 repcmnt(rid,id,pid,uid,key,unm,pp,kkey);
                 $(".ncmnts"+key).html(parseInt(counter)+1);
                 $(".replyCount"+key).html(parseInt(replyCount)+1);
              },
             });       
      }

function ask(pid, key){
      $("#deleteModal").modal('show');  
      $("#del_y").click(function(){
          $.ajax({
            url: '<?php echo base_url() ?>Feeds/delete_post/'+pid,
            type: 'POST', 
            cache: false,
            contentType: false,
            processData: false,
           
            success: function(response){
            if(response==1)
              {
                $("#deleteModal").modal('hide');
                $(".post"+key).html("<h3> Post deleted </h3> ").fadeOut(2000);
               
                 window.location="<?php echo base_url(); ?>Feeds/";
            }
            else{
               console.log(response);
            }
            }
            });
      });
    
       $("#del_n").click(function(){
            $("#deleteModal").modal('hide');  
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
</style>
<div id="content_wrapper" style="margin-top: 20px;">
<div id="inner">
<div style="position: absolute;top: 46px">
</div>
<div id="Tleft">  
<?php
foreach ($userData as $x ) {
  include("includes/side.php");
} ?>
</div>
<div id="Tcenter">

<?php

if($lp[0]->post_status==1 &&  $lp[0]->is_status==2 ){    
      $url=$lp[0]->short_des; 
  ?>


  <div class="post post<?php echo 1; ?>" style="position: relative;">
  <div class="row">
    <div class="post_title">
      <?php $url=base64_encode($url);
            $url=str_replace("/","-", $url);


      ?>
      <a class="blue userName pull-left" href="<?php echo base_url(); ?>Feeds/countClick/<?php echo $url; ?>/<?php echo $lp[0]->post_id; ?>/<?php echo $lp[0]->user_id; ?>/0" target="_blank" >  
      
   <?php $len=strlen($lp[0]->post_title);

      echo $lp[0]->post_title; 
    
    ?> 
   </a>
 </div>
    <div class="dots">
      <a  onclick="ab(<?php echo 1 ?>);"  class="pull-right dott" id="lnk<?php echo 1; ?>"> <img src="<?php echo base_url()?>assets/img/tdot.jpg" class="tdot">  </a> 
  </div> <div class="cl"> </div>  </div> <div class="arrow-down po<?php echo 1 ?>">  </div>
      <div class="post-opt  po<?php echo 1; ?>"> 
        <span class="tip"></span>
      <ul>
     
      <?php if($x->id==$lp[0]->user_id){
       ?> 
        
        <li> <a href="#" onclick="ask(<?php echo $pid ?>, <?php echo 1; ?>);"> <i class="fa fa-trash"> </i> Delete Post </a></li>
        <?php if($lp[0]->cmnt_show==1){ ?> 
        <li> <a href="#" class="dc<?php echo 1; ?>" onclick="disableComments(<?php echo $pid ?>, <?php echo 1; ?>);"> <i class="fa fa-ban"> </i> Disable comments on this post </a></li>
        <?php } else{ ?>
           <li> <a href="#" class="dc<?php echo 1; ?>" onclick="enableComments(<?php echo $pid ?>, <?php echo 1; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } } else{  ?>

              
     
      <li class="lie"> <a href="#" onclick="report_post(<?php echo $lp[0]->post_id; ?>,<?php echo $lp[0]->user_id; ?>, '<?php echo $post_by_user->name; ?>',<?php echo 1; ?>);return false;"> Report Post </a>        </li> 
      <?php
        if(count($check) > 0 && $check->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $lp[0]->user_id; ?>);"> Disconnect <?php echo $post_by_user->name; ?> </a></li>      
    <?php } ?>
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $lp[0]->post_id; ?>,<?php echo $lp[0]->user_id; ?>,'<?php echo $post_by_user->name; ?>', <?php echo 1; ?>); return false;"> Its spam </a></li>   

      <li class="lie"> <a href="#" onclick="painic(<?php echo $lp[0]->post_id; ?>, <?php echo $userId;  ?>,  <?php echo 1; ?>);return false;" > Painic </a>  </li>     

        <?php } ?>
      </ul>
    </div> <div class="cl"></div> 
    <hr> <span class="icoL"> Posted by <a class="icoL Postedby" href="<?php echo base_url() ?>tuser/<?php echo $post_by_user->otp.$lp[0]->user_id; ?>/<?php echo str_replace(" ", "-", $post_by_user->name); ?>"> <?php echo $post_by_user->name; ?> </a> |
     <?php 
     $posted_on=new DateTime($lp[0]->posted_on);
     $posted_on=$posted_on->format("d, F-Y H:i:s");
      echo $posted_on; ?> </span>     <span class="icoL"> <?php echo $lp[0]->cat; ?>
      | 
      <?php

       if (!preg_match("~^(?:f|ht)tps?://~i", $lp[0]->short_des)) {
        $sourceUrl = "http://" . $lp[0]->short_des;
        $sourceUrl = parse_url($sourceUrl);
        $sourceUrl = $sourceUrlhost;
        // $sourceUrl=str_replace("www.","", $sourceUrl);
      }
      else{
         $sourceUrl = parse_url($lp[0]->short_des);
         $sourceUrl = $sourceUrl['host'];
         // $sourceUrl=str_replace("www.","", $sourceUrl);
      }
        echo $sourceUrl;
      ?>


      

      </span> 
 

 <br> 
   
  <a class="" href="<?php echo base_url(); ?>Feeds/countClick/<?php echo $url; ?>/<?php echo $lp[0]->post_id; ?>/<?php echo $lp[0]->user_id; ?>/0" target="_blank"> 


  <?php 

   $imgurl=str_replace("-2F", "%2F", $lp[0]->img); 

  

  if($lp[0]->cat!="Video"){    
     ?>

    <img src="<?php echo $imgurl; ?>"> </a>
<?php } ?> 

<?php if($lp[0]->cat=="Video"){ ?>
    
    <div class="parent">
    
   <img src="<?php echo $imgurl; ?>"> </a>
 
 <img class="image2" src="<?php echo base_url().'/assets/img/play.png';?> " style=" height: 80px; width: 80px; border: none;" />  

  </div>

<?php } 

?> 
</a>
  <p class="blog_des"> 
    <?php $len=strlen($lp[0]->main_des);
    if($len>160 ){
      $short_des=mb_substr($lp[0]->main_des, 0, 160);
      echo $short_des."...";
    }
    else{
      echo $lp[0]->main_des;
    }


    ?> 

   </p>
 
  <hr>
  <div class="post_footer"> 

   <div class="row">  
    <div class="pull-left">  
       <?php
        if(count($likeArr) > 0){
         if($likeArr->likes==0){ ?>
          <button  style="border: none;background: none;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $lp[0]->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,1);return false">  Vote </button>
            <?php } ?>
          <?php
          if($likeArr->likes==1){ ?>
          <button style="border: none;background: none;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $lp[0]->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,2);return false" href="#">  Vote </button>
         <?php }}

          else{ ?>
            <button style="border: none;background: none;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $lp[0]->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" href="#" onclick="postLikes(<?php echo $lp[0]->post_id; ?>);return false;" style="display: inline-block;min-height: 16px;" >
             <span class="nvotes<?php echo 1; ?> icoL">
          <?php
        if($numLikes[0]['sum'] ==1) {
         echo $numLikes[0]['sum']; 
          }
          else if($numLikes[0]['sum'] >1){
           echo $numLikes[0]['sum']; 
          }
          else{
            echo "";
          }
        ?> 
         </span>
          
            <span class="nvotess<?php echo 1; ?> icoL">
          <?php
        if($numLikes[0]['sum'] ==1) {
         echo " Vote"; 
          }
          else if($numLikes[0]['sum'] >1){
           echo " Votes"; 
          }
          else{
            echo "";
          }
        ?> 
         </span>
           </a>

            </div> 

     <div class="pull-left">  <a class="vote spc"  href="#" onclick="spin(<?php echo $lp[0]->post_id; ?>, <?php echo $userId;  ?> , <?php echo 1; ?>);return false;"> Spin </a> <span class="nspins nv"> </span> </div> 

     <div class="pull-left">  <a class="nv vote spc" onclick="replies(<?php echo $lp[0]->post_id;  ?>, <?php echo $lp[0]->user_id;  ?> , <?php echo 1; ?>, '<?php echo $post_by_user->name; ?>', '<?php echo $post_by_user->otp; ?>','<?php echo $post_by_user->name ?>');return false" href="#">  Comments </a>  <span class="ncmnts<?php echo 1; ?> nv"> <?php
        if($numComments){
          echo $numComments[0]["sum"];
        } else echo 0;?> 

      </span>    </div> 

    



     <?php

     if( $lp[0]->user_id!=$userId && $lp[0]->promo==0) { ?>
      <div class="pull-right"> <p > <a class="vote spc"  href="#" onclick="promoteModal(<?php echo $lp[0]->post_id; ?>); return false;" > Promote </a> <span class="nspins nv"> </span></p> </div> 
 <?php } ?>

     <div class="cl"> </div>  </div>


      <hr style="margin-bottom: 3px;">
   
       <div id="loadcomments<?php echo 1; ?>">
        </div>
       </div> <div class="cl"> </div>
    </div>
<?php 
  
 } 
 

   if($lp[0]->post_status==1 && ($lp[0]->is_status==4 || $lp[0]->is_status==1 ) ){
      
     
      $img=base_url()."".$lp[0]->img; 
      $pp=$post_by_user->profile_pic;
  ?>


  <div class="post post<?php echo 1; ?>" style="position: relative;"> 
   <div>      
    <div class="status_left"> <img src="<?php echo $pp; ?>" width="100%" style="border-radius: 50%;"> </div>     

      <div class="status_right">    <span class="postedby icoL"> <a class="icoL Postedby" href="<?php echo base_url() ?>tuser/<?php echo $post_by_user->otp.$lp[0]->user_id; ?>/<?php echo str_replace(" ", "-", $post_by_user->name); ?>"> <?php echo $post_by_user->name; ?> </a> Uploaded a picture 
         <br>
       <?php
        $posted_on=new DateTime($lp[0]->posted_on);
        $posted_on=$posted_on->format("d, F-Y H:i:s");
        echo $posted_on;
      ?> </span> 
      </div>
       <div class="status_right1">
       <a  onclick="ab(<?php echo 1; ?>);"  class="pull-right dott" id="lnk<?php echo 1; ?>"> 
      
     
     <img src="<?php echo base_url(); ?>assets/img/tdot.jpg" class="tdot">  </a>  


     <div class="arrow-down po<?php echo 1 ?>">  </div>
      <div class="post-opt  po<?php echo 1; ?>" style='margin-top: 26px;' >
       <span class="tip"></span> 
      <ul>
     
      <?php if($x->id==$lp[0]->user_id){
      ?>    

        <li> <a href="#" onclick="editPost(<?php echo $pid ?>, <?php echo 1; ?>);return false;"> <i class="fa fa-pencil"> </i> Edit Post </a></li>  

        <li> <a href="#" onclick="ask(<?php echo $pid ?>, <?php echo 1; ?>);"> <i class="fa fa-trash"> </i> Delete Post </a></li>
        <?php if($lp[0]->cmnt_show==1){ ?> 
        <li> <a href='' class="dc<?php echo 1; ?>" onclick="disableComments(<?php echo $pid ?>, <?php echo 1; ?>);"> <i class="fa fa-ban"> </i> Disable comments on this post </a></li>
        <?php } else{ ?>
           <li> <a href="#" class="dc<?php echo 1; ?>" onclick="enableComments(<?php echo $pid ?>, <?php echo 1; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } } else{  ?>

                
     
      <li class="lie"> <a href="#" onclick="report_post(<?php echo $lp[0]->post_id; ?>,<?php echo $lp[0]->user_id; ?>, '<?php echo $post_by_user->name; ?>',<?php echo 1; ?>);return false;"> Report Post </a>        </li> 
      <?php if(count($check) > 0 && $check->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $lp[0]->user_id; ?>);"> Disconnect <?php echo $post_by_user->name; ?> </a></li>      
    <?php } ?>
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $lp[0]->post_id; ?>,<?php echo $lp[0]->user_id; ?>,'<?php echo $post_by_user->name; ?>',<?php echo 1; ?>); return false;"> Its spam </a></li>   

      <li class="lie"> <a href="#" onclick="painic(<?php echo $lp[0]->post_id; ?>, <?php echo $userId;  ?>,  <?php echo 1; ?>);return false;" > Painic </a></li>

        <?php } ?>
      </ul>
    </div> <div class="cl"></div> 

      <hr>   

        </div> <div class="cl"> </div>  </div>  

        <div> 
           <input type="hidden" id="hidesc<?php echo 1; ?>" value="<?php echo $lp[0]->short_des;  ?>" >
          <?php if($lp[0]->is_status==4){ ?> 
          <img src="<?php echo $img; ?>" width="100%">
          <?php } ?>
          <div class="cl"> </div>
         
            <p class="blog_des<?php echo 1; ?>" id="seem<?php echo 1; ?>">
          <?php 
            if(strlen($lp[0]->short_des) < 160){
              echo $lp[0]->short_des;
            } 
            else{
            $lp[0]->short_des=preg_replace( "/\r|\n/", "", $lp[0]->short_des);
            $lp[0]->short_des=htmlentities($lp[0]->short_des, ENT_QUOTES);
            echo mb_substr($lp[0]->short_des, 0,160)."... <a href='#' onclick='seemore(1, \"".$lp[0]->short_des."\"); return false;'> See more </a> ";
            } 
            ?>

           </p>

           </p> 
           <hr
         </div>

        <div class="post_footer" style="border-top: 1px solid #f1f1f1;"> 
         <div class="row"> 
          <div class="pull-left"> 

            <?php
        if(count($likeArr) > 0){
         if($likeArr->likes==0){ ?>
           <button style="border: none;background: none;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $lp[0]->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,1);return false" href="#">  Vote </button> 
            <?php } ?>
          <?php
          if($likeArr->likes==1){ ?>
           <button style="border: none;background: none;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $lp[0]->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,2);return false" href="#">  Vote </button>
         <?php }} 
          else{ ?>
            <button style="border: none;background: none;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $lp[0]->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" href="#" style="display: inline-block;min-height: 16px;" onclick="postLikes(<?php echo $lp[0]->post_id; ?>);return false;"  >
             <span class="nvotes<?php echo 1; ?> icoL">
          <?php
        if($numLikes[0]['sum'] ==1) {
         echo $numLikes[0]['sum']; 
          }
          else if($numLikes[0]['sum'] >1){
           echo $numLikes[0]['sum']; 
          }
          else{
            echo "";
          }
        ?> 
         </span>
          
            <span class="nvotess<?php echo 1; ?> icoL">
          <?php
        if($numLikes[0]['sum'] ==1) {
         echo " Vote"; 
          }
          else if($numLikes[0]['sum'] >1){
           echo " Votes"; 
          }
          else{
            echo "";
          }
        ?> 
         </span>
           </a>

          </div>  

    <div class="pull-left"> <p > <a class="vote spc ?> "  href="#" onclick="spin(<?php echo $lp[0]->post_id; ?>, <?php echo $userId;  ?> , <?php echo 1; ?>);return false;"> Spin </a> <span class="nspins nv"> </span></p> </div> 


      <div class="pull-left">  <a class="nv vote spc" onclick="replies(<?php echo $lp[0]->post_id;  ?>, <?php echo $lp[0]->user_id;  ?> , <?php echo 1; ?>, '<?php echo $post_by_user->name; ?>','<?php echo $post_by_user->otp; ?>','<?php echo $post_by_user->name ?>');return false" href="#">  Comments </a>  <span class="ncmnts<?php echo 1; ?> nv"> <?php
        if($numComments){
          echo $numComments[0]["sum"];
        } else echo 0;?> 

      </span>    </div> 

      

  </div> 

    
       <hr style="margin-bottom: 3px;">
 
       <div id="loadcomments<?php echo 1; ?>">
        </div>
      

</div> <div class="cl"> </div> </div> 
</div>

<?php   
}

?>

 

 </div>

</div>

<div class="modal" data-backdrop="true" id="PromoteModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border: 0px;">
        <div class="modal-header"  >
            <button class="close" data-dismiss="modal"> &times; </button>
          <h4 class="modal-title" > &nbsp;&nbsp;Promote Post</h4>
            
         </div>
         
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;padding-bottom: 0px;">
          
          <div id="pmbody"></div>
           
        </div>
        
      </div>
      
    </div>

<div id="Tright"> 
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
<span id="delete_post">
  
<div class="modal" data-backdrop="true" id="deleteModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title"  > Delete Post</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>  
            &nbsp;&nbsp; Are You sure you want to delete post? </p>
        
            <a href="#" value="yes" id="del_y" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" id="del_n" class="mbtn-right"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div>

</span>

<span id="hide_post">
  
<div  class="modal" data-backdrop="true" id="hideModal" role="dialog" >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" >Hide Post</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;" >
         
            <p class="" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>  &nbsp;&nbsp; Are You sure you want to hide post ? </p>
         
              <a value="yes" id="hid_y" class="mbtn-left btn-gray"> Yes </a><a value="no" id="hid_n" class="mbtn-right"> No </a>
         
        </div>
        
      </div>
      
    </div>
  </div>

</span>


 <div class="modal fade" id="painicModal" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"  >Painic </h4>
        </div>
        <div class="modal-body" style="padding: 0px;">
          <p style="padding: 10px;"> Some text here  </p> <br>
            <div id="painic_btn"> </div>  
         
        </div>
       
      </div>
      
    </div>
  </div>
 
<div class="modal" data-backdrop="true" id="deleteCmntModal" role="dialog" >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" > Delete Comment</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p style="padding: 20px 0px;margin-left: 10%;">
             Are You sure you want to delete Comment? </p>
        
            <a href="#" value="yes" id="del_cy" class="mbtn-left btn-gray" onclick="return false;"> Yes </a><a  href="#" value="no" id="del_cn" class="mbtn-right" onclick="return false;"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div>

  <span id="rep_post"></span>
  <span id="rep_mod"></span>
  <span id="rep_admin"></span>
  <span id="msg_pbu"></span>
  
  <span id="status_mod"></span>

 <div  class="modal" data-backdrop="true" id="submitModal" role="dialog" >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header">
       <a style="color: #fff;" href="<?php echo base_url(); ?>"> <button type="button" class="close" data-dismiss="modal">&times;</button> </a>
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Submitted</h4>
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

 <div class="modal" data-backdrop="true" id="disableModal" role="dialog" >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title"> Disable Comments </h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>  
            &nbsp;&nbsp; Are You sure you want disable comments on this post? </p>
            <a value="yes" id="del_y1" class="mbtn-left btn-gray"> Yes </a>
            <a style="width: 48%;" value="no" id="del_n1" class="mbtn-right"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div> 

 <script type="text/javascript">
function comOpt(i) {
    $(document).on('click', function(e) {
    if ( $(e.target).closest("#lnk"+i).length ) {
        $(".co"+i).css("display", "inline-block");
    }else if ( ! $(e.target).closest(".co"+i).length ) {
        $(".co"+i).hide();
    }
});
}


  function seemore(key, data){
      $("#seem"+key).html(data);
  } 
  
  function editPost(pid, key){
    var desc=$("#hidesc"+key).val();

    $("#seem"+key).html("<textarea onkeyup='editNow("+key+","+pid+");' style='padding: 3px;border: 1px solid #ddd;' id='editPost"+key+"'>"+desc+"</textarea><div id='editPostBtn"+key+"'></div>").show();
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
        $("#seem"+key).html(response);
        $("#hidesc"+key).attr("value", response);
        $("#pstedit"+key).html("Post edited successfully").css({"color": "#ccc", "margin":"5px 0px", "border":"1px solid #ccc", "width": "98%","padding":"0px 3px"}).fadeOut(2000);
      }
    });
  }

  
function ask(pid, key){
      $("#deleteModal").modal('show');  
      $("#del_y").click(function(){
          $.ajax({
            url: '<?php echo base_url() ?>Feeds/delete_post/'+pid,
            type: 'POST', 
            cache: false,
            contentType: false,
            processData: false,
           
            success: function(response){
            if(response==1)
              {
                $("#deleteModal").modal('hide');
                window.location.href="<?php echo base_url(); ?>";
            }
            else{
               //console.log(response);
            }
            }
            });
      });
    
       $("#del_n").click(function(){
            $("#deleteModal").modal('hide');  
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
          user_comments(pid, key);
        }
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

function like(pid, uid, key,flag){
    var d= $(".nvotes"+key).html();
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
      if(flag==1){
        d=parseInt(d)+1;
        $(".lk"+key).css("font-weight", "700");
        if(d==1){
          $(".nvotes"+key).html(d);
          $(".nvotess"+key).html(" Vote");
        }
        else if(d > 1){
          $(".nvotes"+key).html(d);
          $(".nvotess"+key).html(" Votes");
        }
        else{
          $(".nvotes"+key).html("");
          $(".nvotess"+key).html("");
        }

        $(".lk"+key).attr("onclick", "like("+pid+","+ uid+","+ key+", 2);return false;");
      }
      if(flag==2){
        d=d-1;
  
        $(".lk"+key).css("font-weight", "400");
         if(d==1){
          $(".nvotes"+key).html(d);
          $(".nvotess"+key).html(" Vote");
        }
        else if(d >1){
          $(".nvotes"+key).html(d);
          $(".nvotess"+key).html(" Votes");
        }
        else{
          $(".nvotes"+key).html("");
          $(".nvotess"+key).html("");
        }

        $(".lk"+key).attr("onclick", "like("+pid+","+ uid+","+ key+",1);return false;");
      }
      
    },
    success: function(response){  
        
  
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

  
  function spinners(pid,key){
    
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/spinners",
      data: {pid: pid},
      type: "post",
      success: function(response){
        $("#spinners").html('<div class="modal fade" id="spinnersModal'+key+'" role="dialog">    <div class="modal-dialog modal-sm">          <!-- Modal content-->      <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title"> Spinned By </h4>        </div>        <div class="modal-body" style="padding:0px; ">  '+response+'   </p>        </div>                </div>  </div>');  

      $("#spinnersModal"+key).modal("show");
      }
    });
   
  }

function painic(pid, uid, key){
  
    $("#painicModal").modal('show');   

    $("#painic_btn").html('<a class="mbtn-left btn-gray"  onclick="painicPost('+pid+', '+uid+', '+key+')" > Yes </a><a href="#" class="mbtn-right"  data-dismiss="modal" > Cancel </a>  ');

   
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


      $("#rep_post").html('<div  class="modal" data-backdrop="true" id="reportModal" role="dialog" style="width: 280px;margin: 0px auto; ">    <div class="modal-dialog">            <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width: 47%;">   <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Post</h4>     </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">               <ul style="list-style: none;">          <li class="lie"> <strong>  Why are you reporting this post? </strong> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href=""> Infringes my rights  </a> <span><input type="radio" name="ir" style=" height: 11px;" onclick="rights('+pid+')">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#" > Its not Interesting or fake content  </a> <span><input type="radio" name="ir" onclick=\'(op2(2,"'+pid+'", "'+uid+'", "'+pbu+'"))\' style="height: 11px;">  </span>  </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#" > Nudity or Violence </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(3,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Its spam </a> <span><input type="radio" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'",'+key+'))\' name="ir"  style="height: 11px;">  </span> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#"> Promotes terrorism </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Child abuse  </a>  <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(6,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>           <li class="lio"> <a  style="width: 42%;float: left;" class="text-black" href="#">  Harmful dangers acts  </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(7,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#">  Hateful content </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(8,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>   </li>                              </ul>        </div>              </div>          </div>  </div>');    


        $("#reportModal").modal('show');      
       

    }



    function op2(opt, pid, uid, pbu, key){

     
          $("#reportModal").modal('hide');
                

               $("#rep_mod").html(' <div  class="modal" data-backdrop="true" id="option2" role="dialog" style="width: 300px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width:50%;">    <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> What you can do </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">                          <ul style="list-style: none;">     <span id="rspm">  </span>                <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Report Admin  </a> <span><input type="radio" onclick="report_admin('+opt+','+pid+','+uid+' )" name="ir" style=" height: 11px;">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" > Hide Post   </a> <span><input type="radio" onclick=" hide_post('+pid+')" name="ir" style="height: 11px;">  </span>  </li>                    <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#"> Disconnect  '+pbu+' </a> <span><input type="radio" onclick="unfmodal('+uid+');" name="ir" style="height: 11px;">  </span> </li>                      <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#"> Block  '+pbu+'  </a>  <span><input onclick="blkmodal('+uid+');" type="radio" name="ir" style="height: 11px;">  </span>  </li>                                                 </ul>        </div>              </div>          </div>  </div>');
                if(opt==4){
                  $("#rspm").html('<li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Mark as Spam  </a> <span><input type="radio" onclick="mark_spam('+opt+','+pid+','+uid+', '+key+' );return false;" name="ir" style=" height: 11px;">  </span>  </li> ');
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
                        $(".post"+key).hide();
                      }

                      if(response==2){
                         $("#rmsg").html("Already Reported").css("color", "black");;
                         $("#submitModal").modal('show');
                         $(".post"+key).hide();
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

   
   



    function replies(pid, uid, key, pbuu,rand, pp,cmnt){
      user_comments(pid,key);
      $(".feedComm"+key).show();
    }

    var counterr=0;
    function increase(e, pid,key){
       $("#incrBtn").attr("disabled","true");
        counterr=counterr+1;
        var data=$("#status_comment"+key).val();
        $("#status_comment").html("");
        document.getElementById("status_comment"+key).innerHTML="";
        document.getElementById("status_comment"+key).value="";
        var counter=$(".ncmnts"+key).html();
        $(".ncmnts"+key).html(parseInt(counter)+1);
        $.ajax({
          url: "<?php echo base_url(); ?>Feeds/post_comment/"+pid,
          data: {"content" : data, "rid": 0,"counterr":counterr  },
          method: "post",
          success: function(response){
            $(".comBtn"+key).html("");
              $(".feedComms"+key).append(response);
          }
      });
    }

function user_comments(pid,key)    
{
      $("#loadcomments"+key).html("");
      $.ajax({
           url:"<?php echo base_url(); ?>Feeds/user_comments/",
           method: "POST",
           data: {pid: pid, key: key},
           beforeSend: function(){
             $("#feedComm"+key).html("<img src='<?php echo base_url(); ?>assets/img/loading.gif' style='width: 24px; height: 24px;margin-left: 45%;'>" );
           }, 
           success:function(data)
            {
            
              $("#feedComm"+key).html("");
             // console.log(data);
              $("#loadcomments"+key).html(data);
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
            $("#submitModal").modal("show");
            $("#suc_msg").html("&nbsp;&nbsp;&nbsp;&nbsp;Report Submitted");
          }
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

  function Express(){
    var a=document.getElementById("express").value;
    
    $('.hiddendiv').html(a+ '<br class="lbr">').css("min-height", "42px");
    $("#express").css('height',  $('.hiddendiv').height());

    if(a.length > 0){
      $(".expBtn").html(" <input type='submit' class='btn btn-primary pull-right' value='Post' form='statusForm' ><div class='cl'> </div>")
    }
    else{
       $(".expBtn").html("")
    }
  } 

  function postLink(){
    $("#pl").html("<input type='text' id='url' placeholder=' Enter URL ' style='width: 100%;border: 1px solid #ccc;margin-bottom: 8px;' onkeyup='parse_link();' oninput='parse_link()' onpaste='parse_link()'name='short_des' >");
    $("#express").css("display", "none");

    $("#linkPost").html(' <button style="background: none; border: none;" onclick="postIc();return false;" ><img src="<?php echo base_url(); ?>assets/img/status.png" height="16px" width="16px" style="width: 16px;" valign="middle" > Post    </button>');
  }

  function postIc(){
     $("#pl").html("");
    $("#express").css("display", "block");

     $("#linkPost").html(' <button style="background: none; border: none;" onclick="postLink();return false;" ><img src="<?php echo base_url(); ?>assets/img/link.png" height="24px" width="24px" style="width: 24px;" valign="middle" > Link    </button>');
  }

  function preview_image(event) 
  {
      var reader = new FileReader();
      reader.onload = function()
      {
        var output = document.getElementById('statusImg');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
      $("#rprev").html("<a href='#' onclick='removeImagePrev();'> Remove preview </a>");
  }

  function removeImagePrev(){
      $("#statusImg").attr("src", "");
      $("#rprev").html("");
      $('input[type=file]').val("");
  } 

</script>


<script type="text/javascript">
  
 function statusForm(e){
 
  var form = $('#statusForm')[0]; 
  var formData = new FormData(form);
  var wordCount = document.getElementById("express").value.trim().split(/\s+/).length; 
  var status= document.getElementById("express").value;

  if(status==""){
        $('#s_msg').html("Sorry! This field can't be empty");
        return false
  }
  if(wordCount>100){
        $('#s_msg').html("Sorry! only 100 words are allowed");
        return false;
  }
       e.preventDefault();
       $.ajax({
        url: '<?php echo base_url(); ?>post/submit_my_post/3',
        method: 'post',
        data: formData,
        dataType: "json",
        beforeSend: function(){
          $("#npost").html("<img src='<?php echo base_url(); ?>assets/img/loading.gif' style='width: 10%; margin-left: 45%;'> ").css("display", "block"); 
        },
        success: function(response){
          
          $("#npost").html("");
          if(response==1){    
              $("#newBlog").modal('show');
              location.reload();
          }
          else{
              return false;
          }
        },
        cache: false,
        contentType: false,
        processData: false, 

    });
     return false;

 }

 function parse_link()
  {
      var imgUrl;
      var chkImg;
      if(!isValidURL($('#url').val()))
      {

        return false;
      }
      else
      {
        $("#detach").css("display", "none");
        $('#atc_loading').show();
        $('#atc_url').html($('#url').val());
        $.ajax({

              url: "<?php echo base_url(); ?>post/fetchPreview/",
              data: { url: $('#url').val() },
              type: "post",
              success:  function(response){
                
                  $('#atc_loading').hide();
                  $('#atc_title').html(response.title);
                  $('#atc_desc').html(response.description);
                  $('#atc_total_images').html(response.total_images);

                   $('#atc_images').html(' ');
                  
                   if(response.images[0].attributes)
                     {  imgUrl=response.images[0].attributes.src; 
                        chkImg=checkURL(imgUrl)
                        if(chkImg!=1){
                          if(response.images[1].attributes){
                           imgUrl=response.images[1].attributes.src; 
                           chkImg=checkURL(imgUrl)
                             if(chkImg!=1){
                              if(response.images[2].attributes){
                                 imgUrl=response.images[2].attributes.src; 
                                 chkImg=checkURL(imgUrl)
                                 if(chkImg!=1){
                                  if(response.images[3].attributes){
                                     imgUrl=response.images[3].attributes.src; 
                                        chkImg=checkURL(imgUrl)
                                       if(chkImg!=1){
                                        if(response.images[3].attributes){
                                           imgUrl=response.images[3].attributes.src; 
                                } 
                              }
                                } 
                              }
                            } 
                          }


                          }
                        }

                     }

                    
                   else
                      { imgUrl=response.images; }

                    
                  var RegExp = /\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                    
                  var str = imgUrl.split("?");
                  imgUrl = str[0];

                  if(RegExp.test(imgUrl)){
                      var x=1;
                  }
                  else { x=0; }

                   chkImg=checkURL(imgUrl);

                  if(chkImg==1){
                      x=1;
                  }
                  else{
                     x=0;
                  }

                  if (x==1)
                  {
                 
                    
                      $('#atc_images').append('<img src="'+imgUrl+'" width="100%" id="">');
                      $("#prevImg").attr("src", imgUrl);
                        imgUrl=imgUrl.replace(/%2F/gi, "-2F");
                        $("#imgs").attr("value", imgUrl); 
                        console.log(imgUrl); 
                  }

                 

                  $("#post_title_ln").attr("value", response.title );
                  $("#short_des_link").attr("value", response.description );    
                  $("#attach_contenta").show();
                     $(".expBtn1").html(" <input type='button' class='btn pull-right' value='Cancel' style='margin: 0px 12px;width: 14%;' onclick='cancelPreview();return false;' >  <input type='submit' class='btn-primary pull-right' value='Post' style='width: 14%;' form='form2' ><div class='cl'> </div>").show();
                       
            }
         
      });
      }
    };  

    function cancelPreview(){
      $("#attach_contenta").hide();
      $(".expBtn1").hide();
      $("#url").val("");
    }

    function checkURL(url) {
      if(url.match(/\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?.(jpeg|jpg|gif|png)$/) != null){
        return 1;
      }
      else{
        return 0;
      }
    }


  function isValidURL(url)
  {
    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    
    if(RegExp.test(url)){
      return true;
    }else{
      return false;
    }
  }

  function submitLink(e){
      var val = $("#url").val();
      // var regex = /^(https?:\/\/)?[a-z0-9-]*\.?[a-z0-9-]+\.[a-z0-9-]+(\/[^<>]*)?$/;
      //  var isValid = regex.test(val);
     
      //   if(regex.test(val))
      //   {
        
      //     check=0;
      //   }
      //   else{
         
      //     check=1;
      //   }
       
       var form = $('#form2')[0]; 
       var formData = new FormData(form);   
    

     $.ajax({
   
    url: '<?php echo base_url(); ?>post/submit_my_post/2',
    data:formData,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false, 
    beforeSend: function(){
          $("#npost").html("<img src='<?php echo base_url(); ?>assets/img/loading.gif' style='width: 10%; margin-left: 45%;'> ").css("display", "block"); 
        },

    success: function(response){  
        $("#npost").html(" ").css("display", "none"); 
        $('#newBlog').modal('show');
        location.reload();
        e.preventDefault();  
    }
    
    
  });
   
    return false;
  }

   function postCom(key,pid){
        $("[class^=mod-replies]").html("");
        $("[id^=rep]").html("");
        var x=document.getElementById("status_comment"+key).style.height;
        var len=document.getElementById("status_comment"+key).value.length;
        if(len > 160){
          document.getElementById("status_comment"+key).style.height="70px";
        }

       if(len > 250){
     
        document.getElementById("status_comment"+key).style.height="100px";
      }
      else{
         document.getElementById("status_comment"+key).style.height="40px";
      }
          var data=document.getElementById("status_comment"+key).value;

        if(data.length >0){
         $(".comBtn"+key).html("<button onclick='increase(event,"+pid+" ,"+key+");return false;' class='btn-primary' id='incrBtn'  style='width: 50px;'> Post </button>");
        }
        else{
          $(".comBtn"+key).html("");
        }
      }

  function delComment(pid, key,kkey){
      $("#deleteCmntModal").modal('show');  
      $("#del_cy").click(function(){
         var replyCount=$(".replyCount"+kkey).html();
        
          $.ajax({
            url: '<?php echo base_url() ?>Feeds/delete_cmnt/'+pid,
            type: 'POST', 
            cache: false,
            contentType: false,
            processData: false,
           
            success: function(response){
            if(response==1)
              {
                $("#deleteCmntModal").modal('hide');
               $(".replyCount"+kkey).html(parseInt(replyCount)-1);
                $(".pcomments"+pid).html("<p> Comment deleted </p> ").fadeOut(2000);
                 return false;
            }
            else{
               console.log(response);
            }
            }
            });
      });
    
       $("#del_cn").click(function(){
            $("#deleteCmntModal").modal('hide');  
       });
   
  
}

  function editComment(cid, key, comments){
    var comments=$("#hid"+key).val();
    $(".ureply"+key).html("<textarea style='height: 28px;border: 1px solid #ddd;' onkeyup='edComment(\""+key+"\");return false;' id='textarea"+key+"' >"+comments+"</textarea><br><input type='button' value='Save Changes' onclick='updateCmnt("+cid+", \""+key+"\");return false;' style='width: 21%;padding: 0px; font-size: 11px;' class='btn' id='cmntupdateBtn"+key+"' disabled> &nbsp;&nbsp; <input type='button' style='padding: 0px;font-size: 11px;' onclick='cncldlt(\""+comments+"\",\""+key+"\"); return false;' value='Cancel' class='btn'>"); 

  }

  function cncldlt(comments,key){
      $(".ureply"+key).html(comments);
  }

  function edComment(key){
      $("#cmntupdateBtn"+key).prop("disabled", false).removeClass("btn").addClass("btn-primary");
  }

  function updateCmnt(cid,key){
    var content=$("#textarea"+key).val();
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/updateCmnt",
      type: "post",
      data: {content: content, cid: cid},
      success: function(response){
        console.log(response);
         $(".ureply"+key).html(content);
         $("#hid"+key).attr("value",content);
      }
    });
  }

   function cmntNow(pid,key){
        $("#absPos").css("background", "#454545d1");
          user_comments(pid,key);
        $("#modal_status_data").html("<textarea style='width:99%; color: #000;' onkeyup='increase(event,"+pid+", "+key+");' id='status_comment'></textarea>");
      }

     function repcmnt(rid,i,pid,uid,key,unm,pp,kkey){ 
     
       $('.mod-replies').not('#mod-replies'+kkey).html("");
          $.ajax({
          url:"<?php echo base_url(); ?>Feeds/user_replies/",
          method: "POST",
          data: {rid: rid,kkey:kkey,pid:pid,uid:uid,key:key,unm:unm,pp:pp},
          success:function(data)
            {
               $(".mod-replies"+kkey).html(data);
            }
          });   
      }


      function cmnt(e,rid,id,pid,uid,key,unm,pp,flag,kkey){
         content = $("#comments"+id).val();
         if(content.length  > 0){
           $(".repBtn"+key).html("<button onclick='cmntreply(event,"+rid+",\""+id+"\","+pid+","+uid+","+key+",\""+unm+"\",\""+pp+"\","+flag+","+kkey+");return false;' class='btn-primary'  style='width: 38px;font-size: 11px;' id='cmntreply'> Post </button>"); 
         }
         else{
          $(".repBtn"+key).html("");
         }
      } 
      var rcounterr=0;
      function cmntreply(e,rid,id,pid,uid,key,unm,pp,flag,kkey){
      $("#cmntreply").attr("disabled", "true");
      rcounterr=rcounterr+1;
      content = $("#comments"+id).val(); 
      var x=y="";
      var replyCount=$(".replyCount"+key).html();
      var counter=$(".ncmnts"+key).html();
        $.ajax({
              type: 'post',
              url: '<?php echo base_url();?>Feeds/post_comment/'+pid,
              data: {
                content:content, rid: rid,kkey:kkey,counter:rcounterr
              },
              success: function (response){
                $("#comments"+id).val('');    
              if(flag==2){       
                repcmnt(rid,id,pid,uid,key,unm,pp,rid+"0");
              }

                $(".ncmnts"+kkey).html(parseInt(counter)+1);
                $(".replyCount"+kkey).html(parseInt(replyCount)+1);
              },
             });       
      }


function promoteModal(id){
   $.ajax({
      url: "<?php echo base_url(); ?>Feeds/promoteModal/",
      type: "post",
      data: {id: id },
      success: function(response){
        $("#pmbody").html(response);
       
        $("#PromoteModal").modal("show");
      }

    });
  }

  function promoteNow(pid, uid){

          $("#PromoteModal").modal("hide");
          $("#sucModal").fadeIn('modal');
          var price=$("#price"+pid).val();
          $.ajax({
          url: "<?php echo base_url() ?>Feeds/promoteFeedsPost",
          data: { pid: pid, price: price, posted_by:uid },
          type: "post",
          success: function(response){
            
           
            if(response==1){
             $("#success").html("&nbsp;&nbsp;&nbsp;&nbsp;Request Sent.");
            }
             if(response==2){
             $("#success").html("&nbsp;&nbsp;&nbsp;&nbsp;Request already Sent.");
            }
            else if(response==0){
               $("#success").html("&nbsp;&nbsp;&nbsp;&nbsp;Sorry can't send your request right now!");
            }
          }
        });
  }


  function countClick(url, id, uid){

   $.ajax({
      url: "<?php echo base_url(); ?>Feeds/countClick",
      type: "post",
      data: {id:id, uid: uid},
      success: function(response){
          window.open(url, '_blank');
      }
   });
  }

  function clsbtn(){
    $("#sucModal").fadeOut("modal");
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