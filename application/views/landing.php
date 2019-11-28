<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="http://connect.facebook.net/en_US/all.js"></script>

<script type="text/javascript"> 
   
  $(document).ready(function(){

      window.setTimeout(function(){
        $.ajax({
          url: "<?php echo base_url(); ?>Feeds/view_post",
          method: "post",
          data: {'id' : <?php echo $post_id; ?> },
          success: function(response){

            console.log(response);
          }

        });
   }, 1000);







  }); 



</script>

<?php if($this->session->userdata("email")){  ?>
<div id="featrured_ad"> 
<?php } else { ?>
<div id="featrured_ad" style="margin: 0px !important;padding: 0px!important;"> 
<?php }?>
<img src="<?php echo base_url(); ?>assets/img/ad-banner-jobs.png"> </div>

<div id="content_wrapper">
  <div id="inner">

  <?php foreach ($data as $key => $value) {
      $url=base_url()."Feeds/landing/".$value->post_title."/".$value->post_id; 
     $url= preg_replace('/\s+/', '-', $url);
   ?>
    <div id="l1">

    <div style="float: left;width: 100%;">
    <div style="width: 90%;float: left;">  
      <h1 style="margin-left: 10PX;font-size: 28px;" class="heading wwrapp"> <?php echo $value->post_title; ?> </h1> 
    </div>
    <div style="width: 10%;float: left;">
      <?php if($this->session->userdata("email")){ ?>
       <a href="#" onclick="ab(<?php echo 1 ?>);return false;"  class="pull-right dott" id="lnk<?php echo 1; ?>"> <img src="<?php echo base_url()?>assets/img/tdot.jpg" class="tdot">  </a>  
     <?php } else{  ?>
       <a href="#" class="pull-right dott"  data-toggle="modal" data-target="#loginModal"> <img src="<?php echo base_url()?>assets/img/tdot.jpg" class="tdot">  </a>  
     <?php } ?>
       <div class="post-opt  po<?php echo 1; ?>" style='margin-top: 26px;' >
       <span class="tip"></span> 
      <ul>
     <?php if($this->session->userdata("email")) {
       if($userData[0]->id==$value->user_id){
      ?>    

        <li class="lie"> 
           <a href="<?php echo base_url(); ?>Post/editPost/<?php echo $value->post_id; ?>" >
         <i class="fa fa-pencil"> </i> Edit Post </a></li>  
        <li class="lie"> <a href="#" onclick="ask(<?php echo $value->post_id ?>, <?php echo 1; ?>);return false;"> <i class="fa fa-trash"> </i> Delete Post </a></li>
        <?php if($value->cmnt_show==1){ ?> 
        <li class="lie"> <a href="#" class="dc<?php echo 1; ?>" onclick="disableComments(<?php echo $value->post_id ?>, <?php echo 1; ?>);return false;"> <i class="fa fa-ban"> </i> Disable comments on  this post </a></li>
        <?php } else{ ?>
           <li class="lie"> <a href="#" class="dc<?php echo 1; ?>" onclick="enableComments(<?php echo $value->post_id ?>, <?php echo 1; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } } else{  ?>
      <li class="lie"> <a href="#" onclick="report_post(<?php echo $value->post_id; ?>,<?php echo $value->user_id ?>, '<?php echo $user[0]->name; ?>',<?php echo 1; ?>);return false;"> Report Post </a>  </li> 
      <?php if(count($check) > 0 && $check->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $value->post_id ?>);return false"> Disconnect <?php echo $user[0]->name; ?> </a></li>      
    <?php } ?>
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $value->post_id; ?>,<?php echo $value->user_id; ?>,'<?php echo $user[0]->name; ?>',<?php echo 1; ?>); return false;"> Its spam </a></li>   
        <?php } } ?>
      </ul>
    </div>
    </div>
    <div class="cl"> </div>
  </div>
      <hr>

      
      <span  style="margin-left: 10px;" class="icoL" > <img src="<?php echo base_url(); ?>assets/img/calender.png" height="12" width="12" >  <?php echo $value->posted_on; ?>     </span>

      <!-- <?php foreach ($user as $userD) {

       ?>

       <?php if($userD->active==1){?>  
        <a class="icoL Postedby" href="<?php echo base_url();?>users/author/<?php echo $value->user_id; ?>"> <img src="<?php echo base_url(); ?>assets/img/user.png" height="12" width="12">

      <?php echo $userD->name; ?>  </a>
       <?php }
        else{ ?>

          <span class="icoL"> <?php echo $userD->name; ?>  </a> </span>

        <?php }
        ?>
      

      <?php } ?> -->
      <span class="icoL"> <img src="<?php echo base_url(); ?>assets/img/category.png" height="12" width="12""> <?php echo $value->cat; ?> </span>
    
      <div id="landing_img"> 

      <?php if($value->img){ ?>
      <img src="<?php echo $value->img; ?>"> 
  <?php }  ?>

      <?php if($value->Vfile){ ?>
        <video width="100%"   id="video" controls>
    <source src="<?php  echo $value->Vfile ?>" >
</video>
  <?php }  ?>

      </div>
      
      <?php foreach ($userData as $key => $u) {
        
      } ?>
      <?php if($this->session->userdata('email') &&  $value->user_id!=$u->id){  ?> 

      <!-- <div class="price_div" style="background: url('<?php echo base_url(); ?>assets/img/P-tag.png') no-repeat; background-size: 70%">
      <strong style="font-size: 35px;"> <?php echo $value->Price; ?> </strong> INR <bR>
      

      </div> -->

      <?php } ?>
      <div id="bar" style="padding-top: 8px; padding-bottom: 0px;">

         <div class="row">
      <div style="display: inline-block;width: 120px;"> 
      
       <?php if($this->session->userdata("email")){ ?>
         <?php
        if(count($likeArr) > 0){
         if($likeArr->likes==0){ ?>
          <button  style="border: none;background: none;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $value->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,1);return false">  Vote </button>
            <?php } ?>
          <?php
          if($likeArr->likes==1){ ?>
          <button style="border: none;background: none;display: inline-block;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $value->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,2);return false" href="#">  Vote </button>
         <?php }}

          else{ ?>
            <button style="border: none;background: none;display: inline-block;" class="nv lk<?php echo 1; ?>" onclick="like(<?php echo $value->post_id ?>, <?php echo $userId; ?> , <?php echo 1; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          
          
          <a class="icoL" href="#" onclick="postLikes(<?php echo $value->post_id; ?>);return false;" style="display: inline-block;" >
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
      </span></a>
      <?php }  else{ ?>
         <a href="#" class="vote spc<?php echo $value->post_id; ?>"  data-toggle="modal" data-target="#loginModal" onclick="return false;" >  Vote </a>
        <?php } ?>
           </div>

      <?php 

        //   $cookie_name="spc".$value->post_id'];
        // $a= get_cookie($cookie_name, $xss_clean = NULL);
      $share_id=$value->share_id;
      $spid=$value->post_id;
      $shared_by=$value->shared_by;

      $po= $value->posted_on;
       $post_time=date("dmy", strtotime($po));
        $curtime=date("dmy",strtotime("3 hours +30 minutes"));
          // echo $post_time."<br>";
          // echo $curtime."<br>";
      
        $a=$curtime-$post_time;
        
      if(isset($share_id) && isset($shared_by)){
          if($share_id==0){
            $share_id=NULL;
          }
           if($shared_by==0){
            $shared_by=NULL;
          }
      }
     
     // if(isset($shared_by) && $a==0){
     //    echo "1";
     // }

      if(($share_id==$userId || $shared_by==$userId))
      {
          if(isset($shared_by) && $a==0){
         ?>  <div class="pull-left"> <p > <a class="vote " style="color: black;"  href="#" onclick="alert('You Have already spinned this post. Now you can spin it after 24 hours');"> Spin </a> <span class="nspins nv"> </span></p>   </div>
   <?php    }
    else{
       ?>

      <div class="pull-left"> <p > 
       <?php if($this->session->userdata("email")){ ?>
        <a class="vote spc<?php echo $value->post_id; ?> "  href="#" onclick="spin(<?php echo $value->post_id;  ?>, <?php echo $userId;  ?> , <?php echo $key; ?>);return false"> Spin </a> 
        <?php } else{ ?>
          <a href="#" class="vote spc<?php echo $value->post_id; ?> " data-toggle="modal" data-target="#loginModal" onclick="return false;">  Spin </a>
        <?php } ?>

        <span class="nspins nv"> </span></p>   </div>
      <?php }  } 

      else{


      ?>
      <div style="display: inline-block;"> <p > 
          <?php if($this->session->userdata("email")){ ?>
        <a class="vote spc<?php echo $value->post_id; ?> "  href="#" onclick="spin(<?php echo $value->post_id;  ?>, <?php echo $userId;  ?> , <?php echo $key; ?>);return false;"> Spin </a> 
        <?php } else{ ?>
          <a href="#" class="vote spc<?php echo $value->post_id; ?> " data-toggle="modal" data-target="#loginModal" onclick="return false;">  Spin </a>
        <?php } ?>

        <span class="nspins nv"> </span></p>   </div>
      <?php }  ?>

      
        

      </div>
        <div class="cl"></div>
      <div class="row">
     
      </div>


      </div>

      <div id="content" style="margin-top: 10px; line-height: 20px;">
      
        <p> <?php 
          if($value->img){ 
            echo "<div style='padding: 0px 15px' >".$value->main_des."</div>"; 
          }

          if($value->Vfile){ 
            echo $value->short_des; 
          }

          ?> </p>


      </div>
      <hr>

      <div class="pull-left">
        <div id="share_social"> <span class="text text-center" style="margin-left: 15px;"> Share this article on </span>

        <div id="icoS">
          
          <a class="fbshare" href="https://www.facebook.com/dialog/share?app_id=316650945736195 &display=popup&href=<?php echo $url; ?>&redirect_uri=<?php echo $url; ?>"  target="_blank" > <img src="<?php echo base_url(); ?>assets/img/facebook.png"  height="32" width="36" ></a>
          <a 
          href="https://twitter.com/share?ref_src=twsrc%5Etfw" 
          class="twitter-share-button" 
          data-text="<?php echo $value->post_title; ?>" 
          data-show-count="false"><img src="<?php echo base_url(); ?>assets/img/twitter.png" height="32" width="36"  > </a>
          <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          
          <!-- Place this tag where you want the share button to render. -->
        <div class="g-plus" data-action="share" data-href="<?php echo $url; ?>"></div>

        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>" target="_blank"> 
<img src="<?php echo base_url(); ?>/assets/img/linkedin.ico" height="24px" width="24px">
 </a>


        <!-- Place this tag after the last share tag. -->
        
          
         

        </div>
        </div>
      </div>
      <div align="right">
        <a valign="middle" class="by_user" href="<?php echo base_url();?>tuser/<?php echo $userD->otp.$value->user_id; ?>/<?php echo str_replace(" ", "-", $userD->name); ?>"> By <?php echo $userD->name; ?> 
        <img valign="middle" class="circle" src="<?php echo $userD->profile_pic; ?>" height="42" width="42"  > </a>
      </div>
      <div class="cl"> </div>
      <hr>
      
      <div id="feedComm<?php echo 1; ?>" class='feedComm<?php echo 1; ?>' > 
      </div>
       <div id="loadcomments<?php echo 1; ?>">
        </div>
        <div class="cl"> </div>


</div>
    




  
 
    <?php } ?>

    <?php if($this->session->userdata("email")) { ?>
    <div id="l3" style="border: 1px solid #ccc;">
    <?php } else{ ?>
    <div id="l3" style="border: 1px solid #ccc;top: 191px;"> 
    <?php } ?>  
      <div class="ad_header">
      </div>

      <div class="ad_img">
        <img src="<?php echo base_url(); ?>assets/img/side_ad.jpg" width="100%">
      </div>

      <div class="ad-content"> 
        <p> orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et  </p>
      </div>

      
    </div>
      <?php if($this->session->userdata("email")) { ?>
    <div id="l2" style="border: 1px solid #ccc;background: #fff;">
    <?php } 
    else{ ?>
    <div id="l2" style="border: 1px solid #ccc;background: #fff;top: 430px;">
    <?php }
    ?>
      <h1 class="cat_header"> Related News </h1>

      <div class="aside">

           <?php 
         
    if(isset($getRelated)){
        foreach ($getRelated as $key => $lpost) {
        $title=str_replace(" ", "-", $lpost["post_title"]);
         $url1=base_url()."Feeds/landing/".$title."/".$lpost["post_id"]; 
         $url1=preg_replace('/\s+/', '-', $url1);
         $url1=str_replace("?","-", $url1);
         $url1=str_replace("!","-", $url1);
         $url1=str_replace("#","-", $url1);
        
     ?>  
         <div style="width: 100%; border-bottom: 1px solid #ccc;">
      
        <div  class="re1"> <a class="wwrapp" href="<?php echo $url1; ?>"> <?php echo $lpost['post_title']; ?> </a> </div>
         <div class="le2">
          <?php if($lpost["img"]!=NULL) { ?>
        <img src="<?php echo $lpost['img']; ?>"  height="48" width="48" >
        <?php }  if($lpost["Vfile"]!=NULL) { ?>
         <img src="<?php echo $lpost['thumb']; ?>"  height="48" width="48" >

       <?php } ?>
        </div>
         <div class="cl"> </div>
      </div>
      

        <?php } } ?> 
        
        
      </div>

    </div>


  


 <div  class="modal" data-backdrop="true" id="submitModal" role="dialog"  ">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" >
            <a style="color: #fff" href="<?php echo base_url(); ?>"> <button class="close" type="button" >
              &times; </button>  </a>
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


<div id="unf"> </div>
<div id="blk"> </div>

<?php if($this->session->userdata("email")) {
  include("includes/footer.php");
}
?>

 
 

 </div>
<div class="modal fade" id="painicModal" role="dialog" style="width: 20%;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="padding-left: 15%;" >Painic </h4>
        </div>
        <div class="modal-body" style="padding: 0px;">
          <p style="padding: 10px;"> Some text here  </p> <br>
            <div id="painic_btn"> </div>  
         
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


<div class="modal" data-backdrop="true" id="deleteCmntModal" role="dialog" >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" > Delete Comment</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p style="padding: 20px 0px;margin-left: 10%;">
             Are You sure you want to 
             delete Comment? </p>
        
            <a href="#" value="yes" id="del_cy" class="mbtn-left btn-gray" onclick="return false;"> Yes </a><a  href="#" value="no" id="del_cn" class="mbtn-right" onclick="return false;"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div>


<span id="delete_post">
  
<div class="modal" data-backdrop="true" id="deleteModal" role="dialog" >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" > Delete Post</h4>
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

 <div class="modal" data-backdrop="true" id="disableModal" role="dialog" >
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title"> Disable Comments </h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;">   
            &nbsp;&nbsp; Are You sure you want disable comments on &nbsp;&nbsp; this post? </p>
            <a value="yes" id="del_y1" class="mbtn-left btn-gray"> Yes </a>
            <a style="width: 48%;" value="no" id="del_n1" class="mbtn-right"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div> 


  <div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
         
          <div id="otp_form" style="width: 60%">

<form action="<?php echo base_url(); ?>Users/login" method="post" >
  <div class="col-lg">
   <input type="email" name="email"  style="width: 100%;height: 30px;" placeholder=" Enter email" > </div>
   <div class="col-lg">
   <input type="password" name="pass"  style="width: 100%;height: 30px;" placeholder=" Enter password" > </div>
   
   <div class="col-lg">
    <div style="float: left;width: 40%;">
        <a href="<?php echo base_url(); ?>Users/forgot_password" style="font-size: 12px; color: #999"> Forgot Password </a>
    </div>
    <div style="float: left;width: 60%;">
      <input type="submit" class="btn btn-sm" id="sub" name="sub" value="Login" style="float: right; width: 40%;margin-right: 0px;">
    </div>
    <div class="cl"></div>
  </div>


  <div class="warning" style="width: 100%;" id="otpW">  </div>
<div class="cl"> </div>

  <div>
    <p class="text-center sup" style="font-size: 12px;">
    <a href="<?php echo base_url(); ?>Users" class='text-white'> Not a member Yet? Create an account. It's free </a>  </p>
  </div>

</form>

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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId  : '1869151450066105',
      status : true, 
      cookie : true, 
      xfbml  : true  
      
    });
    FB.AppEvents.logPageView();
  };

 

document.getElementById('shareBtn').onclick = function() {
  

  FB.ui({
    method: 'share',
    display: 'popup',
    href: '<?php //echo $url; ?>',
  }, function(response){});
}
</script> 

<script type="text/javascript">


</script>

<script type="text/javascript">
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/platform.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>



<?php if($this->session->userdata("email")) { ?>
<script type="text/javascript">

$(document).ready(function(){
replies(<?php echo $data[0]->post_id;  ?>, <?php echo $data[0]->user_id;  ?> , <?php echo 1; ?>, '<?php echo $user[0]->name ?>', '<?php echo $user[0]->otp; ?>','<?php echo $user[0]->name ?>');
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

  function cmnt(e,rid,id,pid,uid,key,unm,pp,flag,kkey){
         content = $("#comments"+id).val();
         if(content.length  > 0){
           $(".repBtn"+key).html("<button onclick='cmntreply(event,"+rid+",\""+id+"\","+pid+","+uid+","+key+",\""+unm+"\",\""+pp+"\","+flag+","+kkey+");return false;' class='btn-primary'  style='width: 38px;font-size: 11px;' id='cmntreply' > Post </button>"); 
         }
         else{
          $(".repBtn"+key).html("");
         }
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


      $("#rep_post").html('<div  class="modal" data-backdrop="true" id="reportModal" role="dialog" style="width: 280px;margin: 0px auto; ">    <div class="modal-dialog">            <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width: 50%;">   <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Report Post</h4>     </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">               <ul style="list-style: none;">          <li class="lie"> <strong>  Why are you reporting this post? </strong> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href=""> Infringes my rights  </a> <span><input type="radio" name="ir" style=" height: 11px;" onclick="rights('+pid+')">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#" > Its not Interesting or fake content  </a> <span><input type="radio" name="ir" onclick=\'(op2(2,"'+pid+'", "'+uid+'", "'+pbu+'"))\' style="height: 11px;">  </span>  </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#" > Nudity or Violence </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(3,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Its spam </a> <span><input type="radio" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'",'+key+'))\' name="ir"  style="height: 11px;">  </span> </li>            <li class="lio"> <a style="width: 42%;float: left;" class="text-black" href="#"> Promotes terrorism </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(4,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#"> Child abuse  </a>  <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(6,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>           <li class="lio"> <a  style="width: 42%;float: left;" class="text-black" href="#">  Harmful dangers acts  </a><span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(7,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>  </li>            <li class="lie"> <a style="width: 42%;float: left;" class="text-black" href="#">  Hateful content </a> <span><input type="radio" name="ir" style="height: 11px;" onclick=\'(op2(8,"'+pid+'", "'+uid+'", "'+pbu+'"))\'>  </span>   </li>                              </ul>        </div>              </div>          </div>  </div>');    


        $("#reportModal").modal('show');      
       

    }



    function op2(opt, pid, uid, pbu, key){

     
          $("#reportModal").modal('hide');
                

               $("#rep_mod").html(' <div  class="modal" data-backdrop="true" id="option2" role="dialog" style="width: 300px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;width:53%;">    <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> What you can do </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">                          <ul style="list-style: none;">     <span id="rspm">  </span>                <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Report Admin  </a> <span><input type="radio" onclick="report_admin('+opt+','+pid+','+uid+' )" name="ir" style=" height: 11px;">  </span>  </li>              <SPAN CLASS="CL"> </SPAN>            <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" > Hide Post   </a> <span><input type="radio" onclick=" hide_post('+pid+')" name="ir" style="height: 11px;">  </span>  </li>                    <li class="lio"> <a style="width: 44%;float: left;" class="text-black" href="#"> Disconnect  '+pbu+' </a> <span><input type="radio" onclick="unfmodal('+uid+');" name="ir" style="height: 11px;">  </span> </li>                      <li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#"> Block  '+pbu+'  </a>  <span><input onclick="blkmodal('+uid+');" type="radio" name="ir" style="height: 11px;">  </span>  </li>                                             </ul>        </div>              </div>          </div>  </div>');
                if(opt==4){
                  $("#rspm").html('<li class="lie"> <a style="width: 44%;float: left;" class="text-black" href="#" "> Mark as Spam  </a> <span><input type="radio" onclick="mark_spam('+opt+','+pid+','+uid+', '+key+' );return false;" name="ir" style=" height: 11px;">  </span>  </li> ');
                }

          $("#option2").modal('show');

    }


    function report_admin(opt, pid, uid, key){
          
          $("#option2").modal('hide');
          $("#rep_admin").html('<div  class="modal" data-backdrop="true" id="report_admin" role="dialog" style="width: 290px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                    <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> Report Admin </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="admin_msg" id="admin_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type min 250 words" rows="6"></textarea>     <br> <input type="button" id="rep_admin_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

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
                       $("#suc_msg").html("<h2 style='text-align: center;'> Report submited </h2>").css("color", "black");
                        $("#submitModal").modal('show');
                        $(".post"+key).hide();
                      }

                      if(response==2){
                         $("#suc_msg").html("<h2 style='text-align: center;'>Already Reported </h2>").css("color", "black");;
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
              window.location.href='<?php echo base_url(); ?>';

            }


          });


    }

     function block(uid){
          
          $.ajax({
            url: "<?php echo base_url(); ?>settings/block/"+uid,
            method: "post",
            success: function(response){
             window.location.href='<?php echo base_url(); ?>';

            }


          });


    }

     function msg_rep(pid,uid,pbu){
          
          $("#option2").modal('hide');
          $("#msg_pbu").html('<div  class="modal" data-backdrop="true" id="msg_pb" role="dialog" style="width: 290px;margin: 0px auto; ">    <div class="modal-dialog">                <div class="modal-content" style=" border-radius: 0px;">        <div class="modal-header" style="margin: 0px; padding: 0px;">                    <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;"> Message '+pbu+' </h4>        </div>        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px;">   <span id="rep_ad_msg"> </span>   <br>  <textarea name="pb_msg" id="pb_msg" style="width: 44%; border: 1px solid #ccc; resize: none; margin-left: 15px;" maxlength="450" placeholder="type your message" rows="6"></textarea>     <br> <input type="button" id="rep_pb_btn" value="Submit" class="btn"  style="margin-left:15px; padding-top: 0px; width: 16%; height: 20px; line-height:20px; font-size: 13px;"> <br>  <br>    </div>              </div>          </div>  </div>');

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
                       $("#suc_msg").html("<h2 style='text-align: center;'>Report submited </h2>");
                        $("#submitModal").modal('show');
                      }

                      if(response==2){
                       $("#suc_msg").html("<h2 style='text-align: center;'>Already Reported</h2>");
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
            $("#loadpostComent").append(response);
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
            $("#suc_msg").html("<h2 style='text-align: center'> Report Submitted </h2>");
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
         $(".comBtn"+key).html("<button onclick='increase(event,"+pid+" ,"+key+");return false;' class='btn-primary' id='incrBtn' style='width: 50px;'> Post </button>");
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




</script>
<?php } ?>

<script type="text/javascript">
   var elementPosition = $('#l2').offset();
   var sess='<?php echo $this->session->userdata("email"); ?>';
$(window).scroll(function(){
  var w=$(window).width();
    if(w > 1200){
        if($(window).scrollTop() > elementPosition.top){
              $('#l2').css('position','fixed').css({'top':'46px', 'left' : '880px', 'width':'320px'});

             
         } else {
            if(sess!=""){
            $('#l2').css('position','absolute').css({ 'width':'320px', 'top': '415px'});
            $('#l3').css('position','absolute').css({ 'width':'320px', 'top': '176px' });;
            }
            else{
              $('#l2').css('position','absolute').css({ 'width':'320px', 'top': '430px'});
            $('#l3').css('position','absolute').css({ 'width':'320px', 'top': '190px' }); 
            }
        } 
    }
    else{

             $('#l2').css('position','absolute').css({ 'width':'320px', 'top': '428px'});
            $('#l3').css('position','absolute').css({ 'width':'320px', 'top': '170px' });;
             $('#l4').css('position', 'absolute').css({'top':'798px', 'left' : '880px', 'width':'320px'});
         
    }   
});

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
</body>
</html>


