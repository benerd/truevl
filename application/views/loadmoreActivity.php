
<?php 
  foreach ($userData as $key => $userdata) {
    
  }    
?>  
  <?php   
    if($postData!=NULL){
      foreach ($postData as $key => $PD) {
      $kkey=$key+$no; 
      if($PD["post_status"]==1 ){
          
         
    if($userId==$PD["user_id"]){

        if($PD['is_status']==0){
            $url=base_url()."feeds/landing/".$PD["post_title"]."/".$PD["post_id"]; 
            $url= preg_replace('/\s+/', '-', $url);
            $url=str_replace("?","-", $url);
            $url=str_replace("!","-", $url);
            $url=str_replace("#","-", $url);
            $url=str_replace("%","-", $url);
            $target="target='_self'";
        } 
        if($PD['is_status']==2){ 
              $url=$PD["short_des"]; 
              $url=base64_encode($url);
              $url=str_replace("/","-", $url);
              $url=base_url()."Feeds/countClick/".$url."/".$PD['post_id']."/".$PD['user_id']."/0";
              $target="target='blank'";
        }  
      ?>
   
    <div class="t1 post<?php echo $kkey; ?>" style="position: relative;">  
    <div class="row">
    <div class="post_title">
      <a class="blue userName pull-left" href="<?php echo $url; ?>" <?php echo $target; ?> >  <?php  echo $PD["post_title"]; ?>  </a>
 </div> 
    <div class="dots">
      <a href="#" onclick="ab('<?php echo "a".$kkey ?>');return false;"  class="pull-right dott" id="lnk<?php echo 'a'.$kkey; ?>"> <img src="<?php echo base_url()?>assets/img/tdot.jpg" class="tdot">  </a> 
  </div> <div class="cl"> </div>  </div> 

     <div class="post-opt  poa<?php echo $kkey; ?>"> 
      <span class="tip"></span>
      <ul>
     
      <?php if($x->id==$PD["user_id"]){
          if($PD['is_status']==0){
         ?>      
          <li> <a href="<?php echo base_url(); ?>Post/editPost/<?php echo $PD["post_id"]; ?>" >  <i class="fa fa-pencil"> </i>  Edit Post </a></li>
        <?php } ?>
        <li> <a href="#" onclick="ask(<?php echo $PD["post_id"] ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-trash"> </i> Delete Post </a></li>
          
         <?php if($PD["cmnt_show"]==1){ ?> 
        <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="disableComments(<?php echo $PD["post_id"] ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-ban"> </i> Disable comments on this post </a></li>
        <?php } else{ ?>
           <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="enableComments(<?php echo $PD["post_id"] ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } ?>

        <?php } else{

          ?>

      <li class="lie"> <a href="#" onclick="report_post(<?php echo $PD['post_id']; ?>,<?php echo $PD['user_id']; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>', <?php echo $kkey; ?>);return false;"> Report Post </a> </li> 
      <?php      
       if(count($check)>0 && $check->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $PD['user_id']; ?>);return false;"> Disconnect <?php echo $post_by_user[$key][0]['name']; ?> </a></li>      
    <?php } ?>
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $PD['post_id']; ?>,<?php echo $PD['user_id']; ?>,'<?php echo $post_by_user[$key][0]['name']; ?>', <?php echo $kkey; ?>); return false;"> Its spam </a></li>   

    

        <?php } ?>
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

        <?php
        if($PD["is_status"]==2){ ?>
     <img src="<?php echo $PD['img']; ?>" <?php echo $target; ?>  > </a>
     <?php } else{ ?>
     <img src="<?php echo $PD['img']; ?>" > </a>

    <?php }  ?>
   </div>
    <?php } ?> 

<?php if($PD["Vfile"]!=NULL){ ?> 
    
    <div class="parent">
       <a class="blue userName pull-left" href="<?php echo $url; ?>">  
  <img class="image1" src="<?php echo $PD['thumb']; ?>">
 
 <img class="image2" src="<?php echo base_url().'/assets/img/play.png';?> " style=" height: 80px; width: 80px; border: none;" />  </a>

  </div>

<?php } ?> 
    </div>
    <?php echo mb_substr($PD["main_des"], 0,200); ?>
   <hr style="background: #CCC; margin-top: 3px; ">

 <div class="post_footer">
      <div class="row">
     <div class="pull-left">           
      <?php
        if(count($likeArr[$key]) > 0){
         if($likeArr[$key]->likes==0){ ?>
          <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $PD["post_id"] ?>, <?php echo $uid; ?> , <?php echo $kkey; ?>,1);return false;">  Vote </button>
            <?php } ?>
          <?php
          if($likeArr[$key]->likes==1){ ?>
          <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $PD["post_id"] ?>, <?php echo $uid; ?> , <?php echo $kkey; ?>,2);return false" href="#">  Vote </button>
         <?php }}

          else{ ?>
            <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $PD["post_id"] ?>, <?php echo $uid; ?> , <?php echo $kkey; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" href="#" onclick="postLikes(<?php echo $PD['post_id']; ?>);return false;" style="display: inline-block;min-height: 16px;" >
        <span class="nvotes<?php echo $kkey; ?> icoL">
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
      
      <span class="nvotess<?php echo $kkey; ?> icoL">
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
    
         <div class="pull-left"> <p > <a class="vote spc<?php echo $PD['post_id']; ?> "  href="#" onclick="spin(<?php echo $PD['post_id'];  ?>, <?php echo $uid;  ?> , <?php echo $kkey; ?>);return false;"> Spin </a> <span class="nspins nv"> </span></p>   </div>
     
  
    <?php 
      if($PD["is_status"]==2){ ?>
     <div class="pull-left"> <p > <a class="vote"  href="<?php echo base_url(); ?>Comments/<?php echo $PD['post_id'];  ?>" > Comments </a> <span class="nspins nv"> </span></p>   </div>
   <?php } ?>

    <?php 
      if($PD["is_status"]==0){
          $url=base_url()."feeds/landing/".$PD["post_title"]."/".$PD["post_id"]; 
      $url= preg_replace('/\s+/', '-', $url);
      $url=str_replace("?","-", $url);
      $url=str_replace("!","-", $url);
      $url=str_replace("#","-", $url);
      $url=str_replace("%","-", $url);
       ?>

    <div class="pull-left"> <p > <a class="vote"  href="<?php echo $url; ?>" > Comments </a> <span class="nspins nv"> </span></p>   </div>
    <?php } ?>
      </div>

       <div class="cl"></div>
      <div class="row">
      <div class="pull-left"> &nbsp; </div>
          <div class="pull-right"> <p class="Postedby fs10"> <?php echo $PD["cat"]; ?> </p> </div>
      </div>

        <hr style="margin-bottom: 3px;">
       
<div class="cl"></div>
  </div>
     </div>

<?php } } } } 
?>
<span id="delete_post">
  
<div class="modal fade" data-backdrop="true" id="deleteModal" role="dialog"  >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" > &nbsp;&nbsp; Delete Post </h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;">  
            &nbsp;&nbsp; Are You sure you want to delete post? </p>
        
            <a href="#" value="yes" id="del_y" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" id="del_n" class="mbtn-right"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div>



</span>

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
               
                 
            }
            else{
               console.log(response);
            }
            }
            });
          return false;
      });
    
       $("#del_n").click(function(){
            $("#deleteModal").modal('hide');  
             return false;
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
      
    },
    success: function(response){  
      $.get("<?php echo base_url(); ?>Feeds/checklikes/"+pid+"/"+<?php echo $userId; ?>, function(data, status){
      
        if(data==0){
          $(".lk"+key).css("font-weight", "400");
        }
        else if(data==1){
          $(".lk"+key).css("font-weight", "700");
        }
      }); 
      $.get("<?php echo base_url(); ?>Feeds/nlikes/"+pid, function(data, status){
      $(".nvotes"+key).html(data);  
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