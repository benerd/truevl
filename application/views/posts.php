<?php 
foreach ($userData as $key => $x) { 
} 
if(count($postdata)>0){ 
foreach ($postdata as $key=> $y ) {
    $kkey=$key+$no;  
    if($kkey==0){ ?>  
    <div class="post" style="position: relative;background: #fafafa">
    <h3 style="margin-bottom: 8px; color: #555"> Express Your Thoughts </h3>
    <form id="form2" action="" method="post" enctype="multipart/form-data" onsubmit="return submitLink(event);">
      <span id="pl"> </span>
      <input class="txt-inp" type="hidden" name="post_title" id="post_title_ln">
     <!--   <input class="txt-inp" type="hidden" name="short_des" id="url"> -->
      <input type="hidden" name="main_des" id="short_des_link" style="width: 100%" rows="5">
      <input type="hidden" name="img" id="imgs">
       <div align="center" id="atc_loading" style="display:none"><img src="<?php echo base_url(); ?>assets/img/load.gif" style='width: 16px;' alt="Loading" /></div>
    </form>
   <form method="post" enctype="multipart/form-data" id="statusForm" onsubmit="return statusForm(event);">
    <textarea style="border: 1px solid #ccc;"  id="express" placeholder=" Write something here " name="short_des" onkeyup="Express();"></textarea>
    <div class="hiddendiv"></div>  
      <div>
    <label class="crsr">  <img src="<?php echo base_url(); ?>assets/img/camera-icon.png" height="24px" width="24px" style="width: 24px;" valign="middle" > Image
      <input type="file" onchange="preview_image(event)" name="img" style="display: none;">
    </label>
      &nbsp;&nbsp;
    <label id="linkPost">
        <button style="background: none; border: none;" onclick="postLink(); return false;" ><img src="<?php echo base_url(); ?>assets/img/link.png" height="24px" width="24px" style="width: 24px;" valign="middle" > Link
    </button>
    </label>
     &nbsp;&nbsp;
     <label id="article">
    <a style="color: #555;" href="<?php echo base_url(); ?>post/write_article"  return false;" ><img src="<?php echo base_url(); ?>assets/img/pencil.png" height="16px" width="16px" style="width: 16px;" valign="middle" > Write article </a>
    </button>
    </label>
    </div>
      <img src="" style="width: 50%;" id="statusImg">
      <div id="rprev"></div>
      <span style="font-weight: bold; color: red; font-size: 11px;" id="s_msg"></span>
    
       

    <div class="expBtn">

    </div>
  </form>

  <div id="attach_contenta" style="display:none; min-height: 50px;width: 96%;margin-bottom: 8px;">
              <div id="atc_images" style="width: 100%;" ></div>
              <div id="atc_info">
                <label id="atc_title"></label>
                <label id="atc_url"></label> 
                <br clear="all" />
                <label id="atc_desc"></label>
                <div class="cl"> </div>
              </div>

              <div class="cl"> </div>
              <div id="chBox"> </div>
              <br clear="all" /><br clear="all" />
              <hr style="margin: 3px 0px;">    
        </div>
      <div class="expBtn1">
      </div>

</div>


<div id="npost" style="position: relative;display: none;background: #fff; border: 1px solid #ccc">
</div>


    <?php }
    $pid=$y['post_id'];
    $uid=$y["user_id"];
    $hidden=$y["hidden_by"];
    $hidden=json_decode($hidden);
    $hid_u=0;
    if($hidden!=NULL){
    for ($p=0 ; $p <count($hidden) ; $p++) {

                if($hidden[$p]->id==$userId){
                    $hid_u=1;
                   
                }
            }
          }


      if($y["post_status"]==1 && $y["is_status"]==0 && $hid_u==0){
      
      $url=base_url()."feeds/landing/".$y["post_title"]."/".$y["post_id"]; 
      $url= preg_replace('/\s+/', '-', $url);
      $url=str_replace("?","-", $url);
      $url=str_replace("!","-", $url);
      $url=str_replace("#","-", $url);
      $url=str_replace("%","-", $url);

        $shared_by=json_decode($y["shared_by"]);
        $scount= count($shared_by);
        $str="";
         if($scount==1)
           { $str= "<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name." </a>  Spinned this post <br>  <hr>"; }
        else if($scount==2)
          { $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name." </a> and <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> Spinned this post <br>  <hr>"; }

        else if($scount==3){
          $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name."</a>, <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> and <a href='".base_url()."tuser/".$shared_by[2]->otp.$shared_by[2]->id."/".str_replace(" ", "-", $shared_by[2]->name)."'> ".$shared_by[2]->name." </a> Spinned this post <br>  <hr>";
        }
        else if($scount==4){
           $scount1=$scount-2;
           $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name."</a>, <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> and  <a href='#' onclick='spinners(".$y["post_id"].", ".$kkey.");'> ".$scount1." others </a> Spinned this post <br>  <hr>";
        } 
        else {
          $str="";
        }

  ?>


  <div class="post post<?php echo $kkey; ?>" style="position: relative;">
      <span class="postedby icoL"> <?php echo $str;  ?>  </span>
  <div class="row">
    <div class="post_title">
      <a class="blue userName pull-left" href="<?php echo $url; ?>">  
      <?php $len=strlen($y["post_title"]);
          echo $y["post_title"]; 
      
    ?> 
   </a>
 </div>
    <div class="dots">
      <a  onclick="ab(<?php echo $kkey ?>);"  class="pull-right dott" id="lnk<?php echo $kkey; ?>"> <img src="<?php echo base_url()?>assets/img/tdot.jpg" class="tdot">  </a> 
  </div> <div class="cl"> </div>  </div> <div class="arrow-down po<?php echo $kkey ?>">  </div>
    <div class="post-opt  po<?php echo $kkey; ?>"> 
        <span class="tip"></span>
      <ul>
     
      <?php if($x->id==$y["user_id"]){
       ?> 
           
           <li> <a href="<?php echo base_url(); ?>Post/editPost/<?php echo $pid; ?>" >  <i class="fa fa-pencil"> </i>  Edit Post </a></li>
        <li> <a href="#" onclick="ask(<?php echo $pid ?>, <?php echo $kkey; ?>);">  <i class="fa fa-trash"> </i>  Delete Post </a></li>
        <?php if($y["cmnt_show"]==1){ ?> 
        <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="disableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);"> <i class="fa fa-ban"> </i> Disable comments on this post </a></li>
        <?php } else{ ?>
           <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="enableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } ?>
        <?php }
        else{  ?>
        <li class="lie"> <a href="#" onclick="hide_post(<?php echo $y['post_id'] ?>, <?php echo $kkey; ?> ); return false;"> Hide Post </a></li>           
        <li class="lie"> <a href="#" onclick="report_post(<?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>',<?php echo $kkey; ?>);return false;"> Report Post </a>        </li> 

      <?php
      if(count($checkFriendArray[$key])>0){
        if($checkFriendArray[$key]->status==1){ ?>
      <li class="lie"> <a onclick="unfmodal(<?php echo $y['user_id']; ?>);return false"  href="#" > Disconnect <?php echo $post_by_user[$key][0]['name']; ?> </a></li>      
    <?php }} ?>
      
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>,'<?php echo $post_by_user[$key][0]['name']; ?>', <?php echo $kkey; ?>); return false;"> Its spam </a></li>   

      <li class="lie"> <a href="#" onclick="painic(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?>, <?php echo $kkey; ?> );return false;"> Painic </a></li>

        <?php } ?>
      </ul>
    </div>
   <div class="cl"></div> 
    <hr> <span class="icoL"> Posted by <a class="icoL Postedby" href="<?php echo base_url() ?>tuser/<?php echo $post_by_user[$key][0]['otp'].$y['user_id']; ?>/<?php echo str_replace(" ", "-", $post_by_user[$key][0]['name']); ?>"> <?php echo $post_by_user[$key][0]['name']; ?> </a> |


     <?php 
     $posted_on=new DateTime($y["posted_on"]);
     $posted_on=$posted_on->format("y-m-d");
     echo $posted_on; ?> </span>    | <span class="icoL"> <?php echo $y["cat"]; ?> </span> 
 

 <br> 
   
  <a class="" href="<?php echo $url; ?>"> 

  <?php if($y["img"]!=NULL){ ?>

    <img src="<?php echo $y['img']; ?>"> </a>
<?php } ?> 

<?php if($y["Vfile"]!=NULL){ ?>
    
    <div class="parent">
    
  <img class="image1" src="<?php echo $y['thumb']; ?>">
 
 <img class="image2" src="<?php echo base_url().'/assets/img/play.png';?> " style=" height: 80px; width: 80px; border: none;" />  

  </div>

<?php } ?> </a>

  <p class="blog_des"> 
    <?php $len=strlen($y["short_des"]);
    if($len>160 ){
      $short_des=mb_substr($y["short_des"], 0, 160);
      echo $short_des."...";
    }
    else{
      echo $y["short_des"];
    }

    ?> 

   </p>
  <hr>
  <div class="post_footer"> 

   <div class="row">  
   <div class="pull-left">  
       <?php
        if(count($likeArr[$key]) > 0){
         if($likeArr[$key]->likes==0){ ?>
          <button  style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false">  Vote </button>
            <?php } ?>
          <?php 
          if($likeArr[$key]->likes==1){ ?>
          <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,2);return false" href="#">  Vote </button>
         <?php }}
  
          else{ ?>
            <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" href="#" onclick="postLikes(<?php echo $y['post_id']; ?>);return false;" style="display: inline-block;min-height: 16px;" >
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

            </div> 
  
     <div class="pull-left">  <a class="vote spc"  href="#" onclick="spin(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?> , <?php echo $kkey; ?>);return false;"> Spin </a> <span class="nspins nv"> </span> </div> 

      <div class="pull-left">  <a class="nv vote spc" onclick="replies(<?php echo $y['post_id'];  ?>, <?php echo $y['user_id'];  ?> , <?php echo $kkey; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>', '<?php echo $post_by_user[$key][0]['otp']; ?>','<?php echo $post_by_user[$key][0]['profile_pic']; ?>');return false" href="#">  Comments </a>  <span class="ncmnts<?php echo $kkey; ?> nv"> <?php
        if($numComments[$key]){
          echo $numComments[$key][0]["sum"];
        } else echo 0;?> 

      </span>    </div> 
      <div class="cl"> </div>
      <hr style="margin-bottom: 3px;">
     <!--  <div id="feedComms<?php //echo $kkey; ?>" class='feedComms<?php //echo $kkey; ?>' > 
      </div> -->
      <div id="cmnts<?php echo $kkey; ?>" class='cmntcls' >
      
       <div id="loadcomments<?php echo $kkey; ?>" class="loadcomments" >
        </div>
        
      <div class="cl"> </div>
      </div> 
     




     <div class="cl"> </div>  </div> </div> </div> <div class="cl"> </div>


<?php 
 } 

  if($y["post_status"]==1 && $y["is_status"]==2 && $hid_u==0){
      
      $url=$y["short_des"]; 
  ?>


  <div class="post post<?php echo $kkey; ?>" style="position: relative;">
  <div class="row">
    <div class="post_title">
      <?php $url=base64_encode($url);
            $url=str_replace("/","-", $url);


      ?>
      <a class="blue userName pull-left" href="<?php echo base_url(); ?>Feeds/countClick/<?php echo $url; ?>/<?php echo $y['post_id']; ?>/<?php echo $y['user_id']; ?>/0" target="_blank" >  
      
   <?php $len=strlen($y["post_title"]);

      echo $y["post_title"]; 
    
    ?> 
   </a>
 </div>
    <div class="dots">
      <a  onclick="ab(<?php echo $kkey ?>);"  class="pull-right dott" id="lnk<?php echo $kkey; ?>"> <img src="<?php echo base_url()?>assets/img/tdot.jpg" class="tdot">  </a> 
  </div> <div class="cl"> </div>  </div> <div class="arrow-down po<?php echo $kkey ?>">  </div>
      <div class="post-opt  po<?php echo $kkey; ?>"> 
        <span class="tip"></span>
      <ul>
     
      <?php if($x->id==$y["user_id"]){
       ?> 
           
         
        <li> <a href="#" onclick="ask(<?php echo $pid ?>, <?php echo $kkey; ?>);">  <i class="fa fa-trash"> </i>  Delete Post </a></li>

        <?php if($y["cmnt_show"]==1){ ?> 
        <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="disableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);"> <i class="fa fa-ban"> </i> Disable comments on this post </a></li>

        <?php } else{ ?>
           <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="enableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } ?>


        <?php } else{  ?>

      <li class="lie"> <a href="#" onclick="hide_post(<?php echo $y['post_id'] ?>, <?php echo $kkey; ?> ); return false;"> Hide Post </a></li>             
     
      <li class="lie"> <a href="#" onclick="report_post(<?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>',<?php echo $kkey; ?>);return false;"> Report Post </a>        </li> 

      <?php
      if(count($checkFriendArray[$key])>0){
        if($checkFriendArray[$key]->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $y['user_id']; ?>);return false" > Disconnect <?php echo $post_by_user[$key][0]['name']; ?> </a></li>      
    <?php }} ?>


      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>,'<?php echo $post_by_user[$key][0]['name']; ?>', <?php echo $kkey; ?>); return false;"> Its spam </a></li>   

      <li class="lie"> <a href="#" onclick="painic(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?>, <?php echo $kkey; ?> );return false;"> Painic </a></li>

        <?php } ?>
      </ul>
    </div> <div class="cl"></div> 
    <hr> <span class="icoL"> Posted by <a class="icoL Postedby" href="<?php echo base_url() ?>tuser/<?php echo $post_by_user[$key][0]['otp'].$y['user_id']; ?>/<?php echo str_replace(" ", "-", $post_by_user[$key][0]['name']); ?>"> <?php echo $post_by_user[$key][0]['name']; ?> </a> |
     <?php 
     $posted_on=new DateTime($y["posted_on"]);
     $posted_on=$posted_on->format("d, F-Y H:i:s");
      echo $posted_on; ?> </span>     <span class="icoL"> <?php echo $y["cat"]; ?>
      | 
      <?php

       if (!preg_match("~^(?:f|ht)tps?://~i", $y['short_des'])) {
        $sourceUrl = "http://" . $y['short_des'];
        $sourceUrl = parse_url($sourceUrl);
        $sourceUrl = $sourceUrl['host'];
        // $sourceUrl=str_replace("www.","", $sourceUrl);
      }
      else{
         $sourceUrl = parse_url($y['short_des']);
         $sourceUrl = $sourceUrl['host'];
         // $sourceUrl=str_replace("www.","", $sourceUrl);
      }
        echo $sourceUrl;
      ?>


      

      </span> 
 

 <br> 
   
  <a class="" href="<?php echo base_url(); ?>Feeds/countClick/<?php echo $url; ?>/<?php echo $y['post_id']; ?>/<?php echo $y['user_id']; ?>/0" target="_blank"> 


  <?php 

   $imgurl=str_replace("-2F", "%2F", $y['img']); 

  

  if($y["cat"]!="Video"){    
     ?>

    <img src="<?php echo $imgurl; ?>"> </a>
<?php } ?> 

<?php if($y["cat"]=="Video"){ ?>
    
    <div class="parent">
    
   <img src="<?php echo $imgurl; ?>"> </a>
 
 <img class="image2" src="<?php echo base_url().'/assets/img/play.png';?> " style=" height: 80px; width: 80px; border: none;" />  

  </div>

<?php } 

?> 
</a>
  <p class="blog_des"> 
    <?php $len=strlen($y["main_des"]);
    if($len>160 ){
      $short_des=mb_substr($y["main_des"], 0, 160);
      echo $short_des."...";
    }
    else{
      echo $y["main_des"];
    }


    ?> 

   </p>
 
  <hr>
  <div class="post_footer"> 

   <div class="row">  
    <div class="pull-left">  
       <?php
        if(count($likeArr[$key]) > 0){
         if($likeArr[$key]->likes==0){ ?>
          <button  style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false">  Vote </button>
            <?php } ?>
          <?php
          if($likeArr[$key]->likes==1){ ?>
          <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,2);return false" href="#">  Vote </button>
         <?php }}

          else{ ?>
            <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" href="#" onclick="postLikes(<?php echo $y['post_id']; ?>);return false;" style="display: inline-block;min-height: 16px;" >
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

            </div> 

     <div class="pull-left">  <a class="vote spc"  href="#" onclick="spin(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?> , <?php echo $kkey; ?>);return false;"> Spin </a> <span class="nspins nv"> </span> </div> 

     <div class="pull-left">  <a class="nv vote spc" onclick="replies(<?php echo $y['post_id'];  ?>, <?php echo $y['user_id'];  ?> , <?php echo $kkey; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>', '<?php echo $post_by_user[$key][0]['otp']; ?>','<?php echo $post_by_user[$key][0]['profile_pic']; ?>');return false" href="#">  Comments </a>  <span class="ncmnts<?php echo $kkey; ?> nv"> <?php
        if($numComments[$key]){
          echo $numComments[$key][0]["sum"];
        } else echo 0;?> 

      </span>    </div> 

    



     <?php

     if( $y["user_id"]!=$userId && $y["promo"]==0) { ?>
      <div class="pull-right"> <p > <a class="vote spc"  href="#" onclick="promoteModal(<?php echo $y['post_id']; ?>); return false;" > Promote </a> <span class="nspins nv"> </span></p> </div> 
 <?php } ?>

     <div class="cl"> </div>  </div>


      <hr style="margin-bottom: 3px;">
  <!--      <div id="feedComms<?php //echo $kkey; ?>" class='feedComms<?php //echo $kkey; ?>' > 
      </div> -->
      <div id="cmnts<?php echo $kkey; ?>" class='cmntcls' >
      
       <div id="loadcomments<?php echo $kkey; ?>" class="loadcomments" >
        </div>
     
      <div class="cl"> </div>
      </div> 


    </div> <div class="cl"> </div>
    </div>
<?php 
  
 } 


   if($y["post_status"]==1 && $y["is_status"]==4 && $hid_u==0){
      
     
      $img=$y["img"]; 
      $pp=$post_by_user[$key][0]['profile_pic'];
        $shared_by=json_decode($y["shared_by"]);
        $scount= count($shared_by);
        $str="";
         if($scount==1)
           { $str= "<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name." </a>  Spinned this post <br>  <hr>"; }
        else if($scount==2)
          { $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name." </a> and <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> Spinned this post <br>  <hr>"; }

        else if($scount==3){
          $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name."</a>, <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> and <a href='".base_url()."tuser/".$shared_by[2]->otp.$shared_by[2]->id."/".str_replace(" ", "-", $shared_by[2]->name)."'> ".$shared_by[2]->name." </a> Spinned this post <br>  <hr>";
        }
        else if($scount==4){
           $scount1=$scount-2;
           $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name."</a>, <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> and  <a href='#' onclick='spinners(".$y["post_id"].", ".$kkey.");'> ".$scount1." others </a> Spinned this post <br>  <hr>";
        } 
        else {
          $str="";
        }
  ?>


  <div class="post post<?php echo $kkey; ?>" style="position: relative;"> 
   <div> 
     <span class="postedby icoL"> <?php echo $str;  ?>  </span>     
    <div class="status_left"> <img src="<?php echo $pp; ?>" width="100%" style="border-radius: 50%;"> </div>     

      <div class="status_right">    <span class="postedby icoL"> <a class="icoL Postedby" href="<?php echo base_url() ?>tuser/<?php echo $post_by_user[$key][0]['otp'].$y['user_id']; ?>/<?php echo str_replace(" ", "-", $post_by_user[$key][0]['name']); ?>"> <?php echo $post_by_user[$key][0]['name']; ?> </a> Uploaded a picture 
         <br>
       <?php
        $posted_on=new DateTime($y["posted_on"]);
        $posted_on=$posted_on->format("d, F-Y H:i:s");
        echo $posted_on;
      ?> </span>
      </div>
      <div class="status_right1">
        <a  onclick="ab(<?php echo $kkey; ?>);"  class="pull-right dott" id="lnk<?php echo $kkey; ?>"> 

     
     <img src="<?php echo base_url(); ?>assets/img/tdot.jpg" class="tdot">  </a>  


     <div class="arrow-down po<?php echo $kkey ?>">  </div>
      <div class="post-opt  po<?php echo $kkey; ?>" style="margin-top: 24px;" > 
        <span class="tip"></span>
      <ul>
     
      <?php if($x->id==$y["user_id"]){
      ?>    
        <li> <a href="#" onclick="editPost(<?php echo $pid ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-pencil"> </i> Edit Post </a></li>   
        <li> <a href="#" onclick="ask(<?php echo $pid ?>, <?php echo $kkey; ?>);"> <i class="fa fa-trash"> </i> Delete Post </a></li>
        <?php if($y["cmnt_show"]==1){ ?> 
        <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="disableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);"> <i class="fa fa-ban"> </i> Disable comments on this post </a></li>
        <?php } else{ ?>
           <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="enableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } ?>

        <?php } else{  ?>

      <li class="lie"> <a href="#" onclick="hide_post(<?php echo $y['post_id'] ?>, <?php echo $kkey; ?> ); return false;"> Hide Post </a></li>             
     
      <li class="lie"> <a href="#" onclick="report_post(<?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>',<?php echo $kkey; ?>);return false;"> Report Post </a>        </li> 

      <?php if(count($checkFriendArray[$key])>0){
        if($checkFriendArray[$key]->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $y['user_id']; ?>);return false" > Disconnect <?php echo $post_by_user[$key][0]['name']; ?> </a></li>      
    <?php }} ?>
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>,'<?php echo $post_by_user[$key][0]['name']; ?>',<?php echo $kkey; ?>); return false;"> Its spam </a></li>   

      <li class="lie"> <a href="#" onclick="painic(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?>,  <?php echo $kkey; ?>);return false;"> Painic </a></li>

        <?php } ?>
      </ul>
    </div> <div class="cl"></div> 

      <hr>   

        </div> <div class="cl"> </div>  </div>  

        <div> <img src="<?php echo $img; ?>" width="100%">
          <div class="cl"> </div>
          <input type="hidden" id="hidesc<?php echo $kkey; ?>" value="<?php echo $y["short_des"]; ?>">
           <p class="blog_des blog_des<?php echo $kkey; ?>"> 
            <p id="seem<?php echo $kkey; ?>" class='seem' style='word-wrap: break-word;'>
          <?php 
            if(strlen($y["short_des"]) < 160){
              echo $y["short_des"];
            } 
            else{
            $y["short_des"]=preg_replace( "/\r|\n/", "", $y["short_des"]);
            $y["short_des"]=htmlentities($y["short_des"], ENT_QUOTES);
            echo mb_substr($y["short_des"], 0,160)."... <a href='#' onclick='seemore(".$kkey.", \"".$y['short_des']."\"); return false;'> See more </a> ";
            } 
            ?>

           </p>
           <p id="pstedit<?php echo $kkey; ?>"></p>
           </p> 
           <hr
         </div>

        <div class="post_footer" style="border-top: 1px solid #f1f1f1;"> 
         <div class="row"> 
          <div class="pull-left"> 

            <?php
        if(count($likeArr[$key]) > 0){
         if($likeArr[$key]->likes==0){ ?>
           <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false" href="#">  Vote </button> 
            <?php } ?>
          <?php
          if($likeArr[$key]->likes==1){ ?>
           <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,2);return false" href="#">  Vote </button>
         <?php }} 
          else{ ?>
            <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" href="#" style="display: inline-block;min-height: 16px;" onclick="postLikes(<?php echo $y['post_id']; ?>);return false;"  >
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

          </div>  

    <div class="pull-left"> <p > <a class="vote spc ?> "  href="#" onclick="spin(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?> , <?php echo $kkey; ?>);return false;"> Spin </a> <span class="nspins nv"> </span></p> </div> 


      <div class="pull-left">  <a class="nv vote spc" onclick="replies(<?php echo $y['post_id'];  ?>, <?php echo $y['user_id'];  ?> , <?php echo $kkey; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>','<?php echo $post_by_user[$key][0]['otp']; ?>','<?php echo $post_by_user[$key][0]['profile_pic']; ?>');return false" href="#">  Comments </a>  <span class="ncmnts<?php echo $kkey; ?> nv"> <?php
        if($numComments[$key]){
          echo $numComments[$key][0]["sum"];
        } else echo 0;?> 

      </span>    </div> 

      

  </div> 

    <div class="cl"> </div>
       <hr style="margin-bottom: 3px;">
        <div id="cmnts<?php echo $kkey; ?>" class='cmntcls'>
  <!-- <div id="feedComm<?php //echo $kkey; ?>" class='feedComm<?php //echo $kkey; ?>' > 
        
      </div> -->
       <div id="loadcomments<?php echo $kkey; ?>" class="loadcomments" >
        </div>
      
      <div class="cl"> </div>
      </div>

</div> <div class="cl"> </div> </div> 
</div>

<?php   
}

  if($y["post_status"]==1 && $y["is_status"]==1 && $hid_u==0){
      
      $pp=$post_by_user[$key][0]['profile_pic'];
      $img=$y["img"]; 
       $shared_by=json_decode($y["shared_by"]);
        $scount= count($shared_by);
        $str="";
         if($scount==1)
           { $str= "<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name." </a>  Spinned this post <br>  <hr>"; }
        else if($scount==2)
          { $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name." </a> and <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> Spinned this post <br>  <hr>"; }

        else if($scount==3){
          $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name."</a>, <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> and <a href='".base_url()."tuser/".$shared_by[2]->otp.$shared_by[2]->id."/".str_replace(" ", "-", $shared_by[2]->name)."'> ".$shared_by[2]->name." </a> Spinned this post <br>  <hr>";
        }
        else if($scount==4){
           $scount1=$scount-2;
           $str="<a href='".base_url()."tuser/".$shared_by[0]->otp.$shared_by[0]->id."/".str_replace(" ", "-", $shared_by[0]->name)."'> ".$shared_by[0]->name."</a>, <a href='".base_url()."tuser/".$shared_by[1]->otp.$shared_by[1]->id."/".str_replace(" ", "-", $shared_by[1]->name)."'> ".$shared_by[1]->name." </a> and  <a href='#' onclick='spinners(".$y["post_id"].", ".$kkey.");'> ".$scount1." others </a> Spinned this post <br>  <hr>";
        } 
        else {
          $str="";
        }
  ?>


  <div class="post post<?php echo $kkey; ?>" style="position: relative;"> 
   <div>      
    <span class="postedby icoL"> <?php echo $str;  ?>  </span>

    <div class="status_left"> <img src="<?php echo $pp; ?>" width="100%" style="border-radius: 50%;"> </div>     

      <div class="status_right"> 
      
         <span class="postedby icoL"> <a class="icoL Postedby" href="<?php echo base_url() ?>tuser/<?php echo $post_by_user[$key][0]['otp'].$y['user_id']; ?>/<?php echo str_replace(" ", "-", $post_by_user[$key][0]['name']); ?>"> <?php echo $post_by_user[$key][0]['name']; ?></a>  updated his status
          <br>
       <?php
        $posted_on=new DateTime($y["posted_on"]);
        $posted_on=$posted_on->format("d, F-Y H:i:s");
        echo $posted_on;
      ?> </span>  
      </div>
      <div class="status_right1">
      <a  onclick="ab(<?php echo $kkey; ?>);"  class="pull-right dott" id="lnk<?php echo $kkey; ?>"> 

     
     <img src="<?php echo base_url(); ?>assets/img/tdot.jpg" class="tdot">  </a>  


     <div class="arrow-down po<?php echo $kkey ?>">  </div>
      <div class="post-opt  po<?php echo $kkey; ?>" style="margin-top: 23px;"> 
        <span class="tip"></span>
      <ul>
     
      <?php if($x->id==$y["user_id"]){
        $y["short_des"]=preg_replace( "/\r|\n/", "", $y["short_des"]);
        $y["short_des"]=str_replace("'", "&apos;", $y["short_des"]);
         $y["short_des"]=str_replace('"', "&quot;", $y["short_des"]);
     ?>      
        <li> <a href="#" onclick="editPost(<?php echo $pid ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-pencil"> </i> Edit Post </a></li>   
        <li> <a href="#" onclick="ask(<?php echo $pid ?>, <?php echo $kkey; ?>);"> <i class="fa fa-trash"> </i> Delete Post </a></li>
        <?php if($y["cmnt_show"]==1){ ?> 
        <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="disableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);"> <i class="fa fa-ban"> </i> Disable comments on this post </a></li>
        <?php } else{ ?>
           <li> <a href="#" class="dc<?php echo $kkey; ?>" onclick="enableComments(<?php echo $pid ?>, <?php echo $kkey; ?>);return false;"> <i class="fa fa-check"> </i> Enable comments  </a></li>
        <?php } ?>


        <?php } else{  ?>

      <li class="lie"> <a href="#" onclick="hide_post(<?php echo $y['post_id'] ?>, <?php echo $kkey; ?> ); return false;"> Hide Post </a></li>             
     
      <li class="lie"> <a href="#" onclick="report_post(<?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>',<?php echo $kkey; ?>);return false;"> Report Post </a>        </li> 
      <?php if(count($checkFriendArray[$key])>0){
        if($checkFriendArray[$key]->status==1){ ?>
      <li class="lie"> <a href="#" onclick="unfmodal(<?php echo $y['user_id']; ?>);return false"> Disconnect <?php echo $post_by_user[$key][0]['name']; ?> </a></li>      
      <?php }} ?>
      <li class="lie"> <a href="#" onclick="op2(4, <?php echo $y['post_id']; ?>,<?php echo $y['user_id']; ?>,'<?php echo $post_by_user[$key][0]['name']; ?>',<?php echo $kkey; ?>); return false;"> Its spam </a></li>   

      <li class="lie"> <a href="#" onclick="painic(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?>, <?php echo $kkey; ?> );return false;"> Painic </a></li>
        <?php } ?>
      </ul>
    </div>  </div> <div class="cl"></div> 

      <hr style="margin-bottom: 5px;">   
       <input type="hidden" id="hidesc<?php echo $kkey; ?>" value="<?php echo $y["short_des"]; ?>">
      <p class="blog_des "> 
        <p id="seem<?php echo $kkey; ?>" class='seem' style='word-wrap: break-word;'>
          <?php 
            if(strlen($y["short_des"]) < 160){
              if(strlen($y["short_des"]<30))
              {  
                echo "<span style='font-size: 20px;display: block;word-wrap:break-word; margin: 3px 0px;'>".$y["short_des"]."</span>"; 
              }
              else{
                echo $y["short_des"]; 
              }
            } 
            else{
            
            $y["short_des"]=htmlentities($y["short_des"], ENT_QUOTES);
            echo mb_substr($y["short_des"], 0,160)."... <a href='#' onclick='seemore(".$kkey.", \"".$y['short_des']."\"); return false;'> See more </a> ";
            } 
            ?>

           </p>
             <p id="pstedit<?php echo $kkey; ?>"></p>
      </p>  


       <div class="cl"> </div>  </div>      <div class="post_footer" style="border-top: 1px solid #f1f1f1;">  <div class="row"> <div class="pull-left"> 

        <?php
        if(count($likeArr[$key]) > 0){
         if($likeArr[$key]->likes==0){ ?>
           <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false" >  Vote </button>  
            <?php } ?>
          <?php
          if($likeArr[$key]->likes==1){ ?>
           <button style="margin-right: 5px;border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,2);return false" href="#">  Vote </button> 
         <?php }} 
          else{ ?>
              <button style="border: none;background: none;" class="nv lk<?php echo $kkey; ?>" onclick="like(<?php echo $y["post_id"] ?>, <?php echo $userId; ?> , <?php echo $kkey; ?>,1);return false" href="#">  Vote </button>
          <?php } ?>  

          <br>
          
          <a class="icoL" onclick="postLikes(<?php echo $y['post_id']; ?>);return false;"  href="#" style="display: inline-block;min-height: 16px;" >
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
      </div>  

    <div class="pull-left"> <p > <a class="vote spc ?> "  href="#" onclick="spin(<?php echo $y['post_id']; ?>, <?php echo $userId;  ?> , <?php echo $kkey; ?>);return false;"> Spin </a> <span class="nspins nv"> </span></p> </div> 

      <div class="pull-left">  <a class="nv vote spc" onclick="replies(<?php echo $y['post_id'];  ?>, <?php echo $y['user_id'];  ?> , <?php echo $kkey; ?>, '<?php echo $post_by_user[$key][0]['name']; ?>','<?php echo $post_by_user[$key][0]['otp']; ?>','<?php echo $post_by_user[$key][0]['profile_pic']; ?>');return false" href="#">  Comments </a>  <span class="ncmnts<?php echo $kkey; ?> nv"> <?php
        if($numComments[$key]){
          echo $numComments[$key][0]["sum"];
        } else echo 0;?> 

      </span>    </div> 

      

  </div>
  <div class="cl"> </div> 
   <hr>

   <hr style="margin-bottom: 3px;">

      
    <!-- <div id="feedComms<?php //echo $kkey; ?>" class='feedComms<?php //echo $kkey; ?>' > 
        
      </div> -->
       <div id="cmnts<?php echo $kkey; ?>" class='cmntcls'>
     
       <div id="loadcomments<?php echo $kkey; ?>" class="loadcomments">
        </div>
        
      
      <div class="cl"> </div>
      </div>
   </div> <div class="cl"> </div> </div> 

<?php 
  

  if($kkey==2){ 
    if($ifad){  
       $adurl=base64_encode($ifad->url);
        $adurl=str_replace("/","-", $adurl)
  ?>
    <div class="post post<?php echo $kkey; ?>" style="position: relative;">
      <legend style="float: right;"> <small> <strong style="color: #006097"> truevl </strong> Ad </small> </legend>
        <a href="<?php echo base_url(); ?>Feeds/countClick/<?php echo $adurl; ?>/0/0/<?php echo $ifad->Ad_id; ?>" target="_blank" >
        <img src="<?php echo base_url(); ?>../uploads/Ads/<?php echo $ifad->images; ?>" width="100%">
          <hr>
        <p > <?php echo $ifad->short_desc; ?> </p>
    </div>

  <?php } }

}

}
}
?>



<span id="buyPost">
  
<div class="modal" data-backdrop="true" id="PromoteModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border: 0px;">
        <div class="modal-header"  >
            <button class="close" data-dismiss="modal"> &times; </button>
          <h4 class="modal-title" > &nbsp;&nbsp;Promote Post</h4>
            
         </div>
         
        </div>

        <div class="modal-body" style="padding: 0px;" >
         <div>
          
           <div id="pmbody"></div>
         
        </div>
        </div>
      
        
      </div>
      
    </div>
  </div>

</span>


<div class="modal" data-backdrop="true" id="sucModal" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 60%;margin-left: 80px;" >
        <div class="modal-header" style="border: none;">
            <button class="close" onclick="clsbtn();"> &times; </button>     
          <h4 class="modal-title"> &nbsp; &nbsp; Promote Post</h4>
         </div>
       
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; ">
          <p class="text-center" id="msg">  </p>
            <div  style="width: 20%; margin-left: 40%;">
            <img src="<?php echo base_url(); ?>assets/img/tick.jpg" width="100%" >
          </div>
          <div style="background: #f5f5f5;padding: 15px 0px;" id="success" > </div>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">

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
          $("#sucModal").modal('show');
          var price=$("#price"+pid).val();
          $.ajax({
          url: "<?php echo base_url() ?>Feeds/promoteFeedsPost",
          data: { pid: pid, price: price, posted_by:uid },
          type: "post",
          success: function(response){
            
           
            if(response==1){
             $("#success").html("<h2 style='text-align: center;'> Request Sent. </h2> ");
            }
             if(response==2){
             $("#success").html("<h2 style='text-align: center;'>Request already Sent. </h2>");
            }
             if(response==3){
             $("#success").html("<h2 style='text-align: center;'> Please make atleast 1000 friends to promote a post. </h2>");
            }
            else if(response==0){
               $("#success").html("<h2 style='text-align: center;'>Sorry can't send your request right now! </h2>");
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
    $("#sucModal").modal("hide");
  }



 




</script>