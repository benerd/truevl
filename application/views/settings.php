<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/jquery.datepick.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/jquery.plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.datepick.js"></script>
<style type="text/css">
  span{
    word-wrap: break-word;
  }
</style>

<?php
foreach ($privacy_data as $key => $value) {
} 

?> 

<br clear="all">
<div id="content_wrapper" style="background: none;">

<div id="TFull">

<br>	
<div class="row">
<div class="lft">
<h2>Account Setting</h2>
</div>
 <div class="tab">
    <button class="tablinks active" onclick="tabs(event, 'home')">General</button>
    <button class="tablinks" onclick="tabs(event, 'Login')">Login &amp; Security </button>
    <button class="tablinks" onclick="tabs(event, 'Privacy')">Privacy</button>
    <button class="tablinks" onclick="tabs(event, 'Notification')">Notification</button>
    <button class="tablinks" onclick="tabs(event, 'Blocking')">Blocking</button>
   
  </div>

</div>
 
 <div class="row">
  <div id="home" class="tabcontent"  >
  	   <div class="carea">
        <?php foreach ($userData as $key => $user) {
 ?>

 <a style="" class="text-white hnm" href="<?php echo base_url()?>Users/profile">  <img  src=" <?php echo $user->profile_pic; ?>" style="width: 7%;margin-left:10px; margin-top: 10px; border: 2px solid black;">  </a><?php } ?> 
<div class="cl"> </div>
        <div class="row1">
        <div class="coll">
        <div class="marg">
          <div class="left"> Name </div>
          <div class="right"> <span id="an"> <span id="name"> 
          <input type="hidden" value="<?php echo $user->name; ?>" id="hidname" >  
          <?php echo $user->name; ?>  </span>  </span> </div>
        </div>

         <div class="marg">
          <div class="left"> &nbsp; </div>
          <div class="right">  <span id="name_edit"> </span> </div>
        </div>

         <input type="hidden" id="hidWork" value="<?php echo $user->work; ?>">
        <div class="marg">
           <div class="left"> Work </div>
          <div class="right">
            <span id="work">  
           
            <?php 
            if($user->work!=NULL){
            echo $user->work; 
             }
             else{
              echo "nothing to show";
             } ?>  </span> <a id="wr" onclick="update_work('work', 'wr')" href="#"> Edit </a>
             </div>
            </div>

              <div class="marg">
          <div class="left">  &nbsp;  </div>
          <div class="right">  <span id="work_edit"> </span> </div>
        </div>

        <input type="hidden" id="hidWeb" value="<?php  echo $user->website; ?>">
            <div class="marg">
           <div class="left"> Website </div>
          <div class="right"> <span id="website">  
             <?php 
            if($user->website!=NULL){
            echo $user->website; 
             }
             else{
              echo "add your website";
             } ?> </span> <a id="web" onclick="update_web('website', 'web')" href="#"> Edit </a>
           </div>
        </div>

       
          <div class="marg">
          <div class="left">  &nbsp;  </div>
          <div class="right">  <span id="web_edit"> </span> </div>
        </div>

       </div>
       <div class="colr">
        <div class="marg">
         <div class="left"> Username </div>
          <div class="right"> <span id="email">   <?php echo $user->email; ?> </span> </div>
          </div>
            <input type="hidden" id="hidBday" value="<?php  echo $user->dob; ?>">
          <div class="marg">
          <div class="left">  &nbsp; </div>
          <div class="right">  <span id="unm_edit"> </span> </div>
        </div>

        
          <div class="marg">
           <div class="left"> Birth Day </div>
          <div class="right"> <span id="bday">   <?php echo $user->dob; ?> </span> <a id="bd" onclick="update_bday('bday', 'bd')" href="#"> Edit </a> </div>
        </div>


   <input type="hidden" id="hidAdd" value="<?php echo $user->address; ?>">
        <div class="marg">
          <div class="left">  &nbsp; </div>
          <div class="right">  <span id="bday_edit"> </span> </div>
        </div>
     
          <div class="marg">
           <div class="left"> Address </div>
          <div class="right"> <span id="add">    <?php echo $user->address; ?> </span> <a id="ad" onclick="update_add('add', 'ad')" href="#"> Edit </a> </div>
        </div>

          <div class="marg">
          <div class="left">  &nbsp; </div>
          <div class="right">  <span id="add_edit"> </span> </div>
        </div>

        </div>
      </div>
      <div class="cl"> </div>

      <div class="top-mar">
          
     <button class="deactivate"  type="button"> <a class="text-white" href="#" data-toggle="modal" data-target="#deActiveModal">    Deactivate Account  </a></button>

      </div>
      <br>
 </div>
</div>

<div id="Login" class="tabcontent">
     
   <div class="carea">
        <?php foreach ($userData as $key => $user) {
 ?>

 <a style="" class="text-white hnm" href="<?php echo base_url()?>Users/profile">  <img  src=" <?php echo $user->profile_pic; ?>" style="width: 7%;margin-left:10px; margin-top: 10px; border: 2px solid black;">  </a><?php } ?> 
<div class="cl"> </div>
        <div class="row1">
        <h3> Reset Password </h3>
        </div>
        <form action="" method="post" id="update_pas"> 
         <div class="row1">
         <div class="coll">
        <div class="marg">
          <div class="left"> Current </div>
          <div class="right"> <input type="Password" placeholder="Enter Current Password" id="cpass" > </div>
        </div>


        
        <div class="marg">
           <div class="left"> New Password </div>
          <div class="right">

           <input type="Password" placeholder="Enter New Password" id="pass">
             </div>
            </div>
           

            <div class="marg">
           <div class="left"> Retype New Password </div>
          <div class="right"> 
            <input type="Password" placeholder="Re-enter new Password" id="rpass">
           </div>
        </div>

        <div class="marg">
           <div class="left"> &nbsp; </div>
          <div class="right"> 
           <input type="submit" value="Save Changes" class="btn-primary" style="width: 68.5%;height: 28px;">
           </div>
        </div>

         <div class="marg">
           <div class="left"> &nbsp; </div>
          <div class="right"> 
          <span id="pass_msg">  </span>
           </div>
        </div>

        <br>
         </div>
         </form>
         <div class="coll">
        <div style="float: left; width: 100%;">
         <div class="ccol">
              <img src="<?php echo base_url() ?>assets/img/mobile.png" height="80px" width="80px">
          </div>
          <div class="mob"> 
            <div style="width: 22%;float: left;"> Update Mob: </div>
            <div style="width: 55%;margin-left: 3%;float: left;">
             <span id="mob"> <?php echo $user->mobile; ?>  </span> 
          <a id="mb" onclick="update_mob('mob', 'mb')" href="#"> Edit </a>  

          <span id="mob_edit">  </span> </div>
          <div class="cl"> </div>
          
          <span style="padding-top: 70px;color: red;"  id="mob_msg">  </span>
        </div>
        </div>
      </div>
      </div>

      <div class="cl"> </div>

     

</div>
    
  </div>

  <div id="Privacy" class="tabcontent">
     
   <div class="carea">
       

 <a style="" class="text-white hnm" href="<?php echo base_url()?>Users/profile">  <img  src=" <?php echo $user->profile_pic; ?>" style="width: 7%;margin-left:10px; margin-top: 10px; border: 2px solid black;">  </a>
<div class="cl"> </div>
     

   
 <div class="coll">
<div style="width: 94%;margin-left: 15px;margin-top: 15px; border-right: 4px solid #ccc;">
<div>
  <p class="col8 bold"> Do you want people linkup with you? </p>
   <p class="col2"> <label class="switch">
   <?php 
    if($value->link_up==1){
      ?>
       <input type="checkbox" id="linkup" checked>
  <?php  }

    else{
    ?>  <input type="checkbox" id="linkup">
   <?php }
   ?>
 
  <span class="slider round"></span>
</label>  </p>
    <p class="col6 fs122">if people linkup with you, so you can see 
        those post like videos, blog &amp; images. They 
        are able to sharing his content with you.
      </p>

</div>

  
  

   <div class="cl"> </div>
     <div class="mar2">
        <p class="col8 bold">Do you want people promoting your content? </p>
      <p class="col2">  <label class="switch">
       <?php 
    if($value->promoting==1){
      ?>
  <input type="checkbox" id="promoting" checked>
  <?php
    }
    else{ ?>
      <input type="checkbox" id="promoting" >
 <?php    }
    ?>

  <span class="slider round"></span>
</label>   </p>
      <p class="col6 fs122">
if you buying your content with other people,
that means you are sharing post views earing 
with those people.
</p>

     </div>

     <div class="cl"> </div>
    <div class="mar2">
    <p  class="col8 bold">Show my Phone No. with others?</p>
       <p class="col2"> <label class="switch">
 
   <?php 
    if($value->phone_show==1){
      ?>
  <input type="checkbox" id="phone_show" checked>
  <?php
    }
    else{ ?>
      <input type="checkbox" id="phone_show" >
 <?php    }
    ?>


  <span class="slider round"></span>
</label>   </p>
   <p class="col6"> <input type="text" name="" value="<?php echo $user->mobile; ?> " readonly></p>
    </div>

     <div class="cl"> </div>
    <div class="mar2">
    <p  class="col8 bold">Show my Address with others?</p>
     <p class="col2">  <label class="switch">
 
      <?php 
    if($value->add_show==1){
      ?>
   <input type="checkbox" id="add_show" checked>
  <?php
    }
    else{ ?>
      <input type="checkbox" id="add_show" >
 <?php    }
    ?>  


  <span class="slider round"></span>
</label>   </p>
      <p class="col6"> <?php echo $user->address; ?>  </p>
    </div>

     <div class="cl"> </div>
    <div class="mar2">
    <p class="col8 bold">Show my brithdate with others?</p>
     <p class="col2">  <label class="switch">
 
   <?php 
    if($value->bday_show==1){
      ?>
   <input type="checkbox" id="bday_show" checked>
  <?php
    }
    else{ ?>
       <input type="checkbox" id="bday_show">
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
       <p class="col6"> <?php echo $user->dob; ?>  </p>
    </div>
    </div>
 </div>      

 <div class="colr">
  <div style="width: 98%;">
    
     <div class="mar2">
    <p class="col8 bold">Show my Work Details with others?</p>
     <p class="col2">  <label class="switch">
 
   <?php 
    if($value->work_show==1){
      ?>
   <input type="checkbox" id="work_show" checked>
  <?php
    }
    else{ ?>
       <input type="checkbox" id="work_show">
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
       <p class="col6"> <?php echo $user->work; ?>  </p>
    </div>

    <div class="mar2">
    <p class="col8 bold"> Chat with people </p> 
     <p class="col2">  <label class="switch">
 
   <?php 
    if($value->suggestion==1){
      ?>
   <input type="checkbox" id="suggest" checked>
  <?php
    }
    else{ ?>
       <input type="checkbox" id="suggest" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
    <p class="col6"> If you turn this feature off, your linkups will not be able to chat with you.
</p>
</div>
  <div class="cl"> </div>
  <div class="mar2">
<p class="col8 bold">  Show my email address with others?</p>
 <p class="col2">  <label class="switch">
 

  <?php 
    if($value->email_show==1){
      ?>
    <input type="checkbox" id="email_show" checked>
  <?php
    }
    else{ ?>
       <input type="checkbox" id="email_show" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
   <p class="col6"> <?php echo $user->email; ?>  </p>
</div>
  <div class="cl"> </div>

  <div class="mar2">
<p class="col8 bold"> Show my promotional activities on my profile to others  </p>
 <p class="col2">  <label class="switch">
 

  <?php 
    if($value->promo_show==1){
      ?>
    <input type="checkbox" id="promo_show" checked>
  <?php
    }
    else{ ?>
       <input type="checkbox" id="promo_show" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
   <p class="col6"> If you disable this feature people will not be able to see your promotional activities on your profile page.  </p>
</div>
  <div class="cl"> </div>

   <div class="mar2">
<p class="col8 bold"> Show my link ups on my profile to others  </p>
 <p class="col2">  <label class="switch">
 

  <?php 
    if($value->links_show==1){
      ?>
    <input type="checkbox" id="links_show" checked>
  <?php
    }
    else{ ?>
       <input type="checkbox" id="links_show" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
   <p class="col6"> If you disable this feature people will not be able to see your link ups on your profile page.  </p>
</div>
  <div class="cl"> </div>
 
</div>



 
</div>
<div class="cl"> </div>  
</div>

</div> <!--  <end of privacy> -->



  <div id="Notification" class="tabcontent">
     
   <div class="carea">
       

 <a style="" class="text-white hnm" href="<?php echo base_url()?>Users/profile">  <img  src=" <?php echo $user->profile_pic; ?>" style="width: 7%;margin-left:10px; margin-top: 10px; border: 2px solid black;">  </a>
<div class="cl"> </div>
     

   
 <div class="coll">
<div style="width: 94%;margin-left: 15px;margin-top: 15px; border-right: 4px solid #ccc;">
<div>
  <p class="col8 bold"> Do you want truevl notification on your email? </p>
   <p class="col2"><label class="switch">
  

   <?php 
    if($value->true_noti==1){
      ?>
    <input type="checkbox" id="true_noti" checked>
  <?php
    }
    else{ ?>
     <input type="checkbox" id="true_noti" >
 <?php    }
    ?>  

  <span class="slider round"></span>
</label>  </p>
    <p class="col6 fs122">if you say yes, truevl send notification summary on
your registered email address

      </p>

</div>

  
  

   <div class="cl"> </div>
     <div class="mar2">
        <p class="col8 bold">Do you want Linkup Report on your Notification? </p>
      <p class="col2">  <label class="switch">
  <?php 
    if($value->link_noti==1){
      ?>
  <input type="checkbox" id="link_noti" checked>
    
  <?php
    }
    else{ ?>
  <input type="checkbox" id="link_noti" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
     

     </div>

     <div class="cl"> </div>
    <div class="mar2">
    <p  class="col8 bold">Do you want promotional notification?
</p>
       <p class="col2"> <label class="switch">
 

   <?php 
    if($value->buy_sell_noti==1){
      ?>
  <input type="checkbox" id="buy_sell_noti" checked>
    
  <?php
    }
    else{ ?>
  <input type="checkbox" id="buy_sell_noti" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
   
    </div>

     <div class="cl"> </div>

       <div class="mar2">
    <p  class="col8 bold">Do you want comments and replies notification?
</p>
       <p class="col2"> <label class="switch">
 

   <?php 
    if($value->comment_noti==1){
      ?>
  <input type="checkbox" id="comment_noti" checked>
    
  <?php
    }
    else{ ?>
  <input type="checkbox" id="comment_noti" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
   
    </div>
     <div class="cl"> </div>



       <div class="mar2">
    <p  class="col8 bold">Do you want vote notification?
</p>
       <p class="col2"> <label class="switch">
 

   <?php 
    if($value->vote_noti==1){
      ?>
  <input type="checkbox" id="vote_noti" checked>
    
  <?php
    }
    else{ ?>
  <input type="checkbox" id="vote_noti" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
   
    </div>
     <div class="cl"> </div>


         <div class="mar2">
    <p  class="col8 bold">Do you want spin notification?
</p>
       <p class="col2">

 <label class="switch">
   <?php 
    if($value->spin_noti==1){
      ?>
  <input type="checkbox" id="spin_noti" checked>
    
  <?php
    }
    else{ ?>
  <input type="checkbox" id="spin_noti" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label>   </p>
   
    </div>
     <div class="cl"> </div>

   

     <div class="cl"> </div>
    
    </div>
 </div>      

 <div class="colr">
  <div style="width: 98%;">
  
    <div style="margin-left: 37%;margin-top: 50px;">  
      <img src="<?php echo base_url() ?>assets/img/icon-notification.png" height="120px" width="120px"> <br>

    </div>  
    <p class=" text-center bold"> All Important Notification  </p>
        <p class="text-center">  

        <label class="switch">
   <?php 
    if($value->all_noti==1){
      ?>
  <input type="checkbox" id="all_noti" checked>
    
  <?php
    }
    else{ ?>
  <input type="checkbox" id="all_noti" >
 <?php    }
    ?>  
  <span class="slider round"></span>
</label> 

</p>    

</div>



 
</div>
<div class="cl"> </div>  
</div>

</div>  <!-- <end of notification> -->


<div id="Blocking" class="tabcontent">
     
   <div class="carea">
       

 <a style="" class="text-white hnm" href="<?php echo base_url()?>s/profile">  <img  src=" <?php echo $user->profile_pic; ?>" style="width: 7%;margin-left:10px; margin-top: 10px; border: 2px solid black;">  </a>
<div class="cl"> </div>
     

   
 <div class="coll">
<div style="width: 94%;margin-left: 15px;margin-top: 15px; border-right: 4px solid #ccc;">
  <div style="margin-left: 37%;margin-top: 50px;">  
      <img src="<?php echo base_url() ?>assets/img/stop.png" height="120px" width="120px"> <br>

    </div> 
     <p class=" text-center bold"> Block Links </p>
       <p class="text-center">  If you Block any People on truevl that means you will never see him again.   </p>  
    </div>
 </div>      

 <div class="colr">
  <div style="width: 94%;margin-left: 35px;margin-top: 55px; ">
  
    <table border="1" width="70%" cellspacing="10px" cellpadding="15px;">
     
     <?php
     if($get_blocked){
     foreach ($get_blocked as $key => $value) { ?>
      
    <tr>
      <td width="50%"> <?php echo $value["name"]; ?> </td>
      <td> <span class="gray-btn"> <i class="fa fa-check" aria-hidden="true"></i> <a class="text-black" href=""> Block </a> </span> <span class="green-btn"> <a class="text-white" href="#" onclick="unblock( <?php echo $value["id"]; ?>);"> Unblock </a>  </span> </td>
    </tr>

    <?php   } } ?>
    </table> 

    <div>
      <p class="text-center" id="unblck">  </p>
    </div>
</div>



 
</div>
<div class="cl"> </div>  
</div>

</div>  <!-- <end of Blockng> -->
</div>
</div>

<div  class="modal" data-backdrop="true" id="modals" role="dialog" style="width: 90%;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">
            
          </h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 20px;">
         
            <p class="text-center" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> <span id="mdl-body"></span>   </p>
           <p class="text-center" style="margin-bottom: 20px 0px;">
              <button value="yes" id="yes" class="btn btn-danger"> Yes </button>
              <button value="no" id="no" class="btn"> No </button>
          </p>
        </div>
        
      </div>
      
    </div>
  </div>

<span id="otpm"></span>

 <div class="modal fade" id="deActiveModal" role="dialog" style="width: 30%;margin: 150px auto; ">
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="width: 69%;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Deactivate Account </h4>
        </div>
        <div class="modal-body">
          <p> If you deactivate your account, your linkups will no longer <br> 
          <span style="margin-left: 15%;"> be able to see your activites. </span> </p>
        </div>
        
         <a href="<?php echo base_url() ?>Settings/Deactivate" value="yes" class="mbtn-left btn-gray" style="width: 34.7%" > Yes </a>
         <a  href="#" value="no" data-dismiss='modal' class="mbtn-right" style="width: 33.1%"> No </a>

      </div>
      
    </div>
  </div>


<!-- <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
<style type="text/css">
	
  ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #ccc;
  }

	div.tab {
    overflow: hidden;
    border: 0px solid;
   background: #006097;
   width: 100%;
   float: left;

}

div.tab button {
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 7px 16px;
    transition: 0.3s;
    font-family: verdana;
    color: #fff;
    font-weight: bold;
    background-color: #006097;
}


div.tab button:hover {
    background-color: #006097;
}


div.tab button.active {
    color: #006097;
    text-decoration: underline;
    background: #fff;
    border-bottom: none;
}

.row{
	width: 95%;
	float: left;
 
}

.lft{
	width: 12%;
	float: left;
	height: 32px;

	line-height: 32px;
}

.carea{
	background-color: #fff;

 clear: both;
 margin: 0px;
 padding: 0px;
 height: 421px;
 padding-bottom: 50px;
}

.tabcontent {
    display: none;
    padding: 0px;
  
    border-top: none;
}

.row1{
  margin-left: 15px;
  width: 90%;
  float: left;
}
.coll{
  float: left;
  width: 50%;
}

.colr{
  float: left;
  margin-left: 3%;
  width: 47%;
}

.coll .left{
  float: left;
  width: 50%;
}

.coll .right{
  float: left;
  width: 50%;
}
.colr .left{
  float: left;
  width: 50%;
}

.colr .right{
  float: left;
  width: 50%;
}

.marg{
  margin-bottom: 15px;
  padding-bottom: 15px;
  border: 1px solid #fff;
}

.deactivate{
  background-color: #DB214D;
  color: #fff;
  font-weight: 400;
  margin-left: 15px;
  margin-bottom: 10px;
  border-radius: 8px;
  border: none;
  font-size: 14px;
  box-shadow: 2px 2px 2px 2px #ccc;
  padding: 1px 4px;

}

.top-mar{
   margin-top: 50px;

}

input{
  padding: 0px;
  height: 24px;
}


input[type="text"]{
  border: 1px solid #ccc;
}

.ccol{
  margin-left: 15px;
  margin-top: 0px;
  width: 15%;
  float: left;

}

.mob{
  float: left;
  width: 80%;
   margin-left: 5px;
  margin-top: 28px;
}

.col8{
  width: 80%;
  float: left;
}

.col2{
  width: 20%;
  float: right;
}


.col6{
  width: 60%;
}

p{
  font-size: 13px;
  text-align: justify;

}

.mar2{
    padding-top: 20px;
}

.bold{
  font-weight: bold; 
}

.fs122{
  font-weight: none;
  font-size: 12px;
}


.switch {
  position: relative;
  display: inline-block;
  width: 42px;
  height: 18px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 4px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.ri{
  color: red;
  cursor: pointer;
}

.gi{
  color: green;
  cursor: pointer;
}

.gray-btn{
  text-decoration: none;
  background-color: #DEDEDE;
  padding: 0px 3px;
  color: #000;
 
  height: 18px;
  font-size: 13px;
  width: 35px;
  margin-left: 15px;
}

.green-btn{
  background-color: #009140;
  text-orientation: none;
  padding:0px 3px;
  color: #fff;

    height: 18px;
  font-size: 13px;
  margin-left: 5px;
}
</style>




<script>

  

</script>
 

<script type="text/javascript">
  

  function update_name(id1, id2) {
     
     $("#"+id2).hide();
     var nme=$("#hidname").val();
      $("#"+id1).html("<input type='text' id='up_name' value='"+nme+"' style='color: #ccc' readonly>"); 

      $("#name_edit").html("<input type='text' id='user_name'> <i id='nm_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='nm_cl'></i> <div id='msg1'>  </div> ").show();

      $("#nm_up").click(function(){

          var nm=$("#user_name").val();
          if(nm==""){
            $("#msg1").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/update_name",
            method: "post", 
            data: {nm: nm},
            success: function(response){
              if(response==1){
                $('#an').html('<span id="'+id1+'">'+nm+'</span><a id="nm" onclick="update_name(\''+id1+'\', \''+id2+'\')"  href="#"> Edit </a>');
                $("#hidname").attr("value",nme);
                $('#name_edit').html("<span class='gi'> <i class='fa fa-check'> Updated </span>").fadeOut(2000);
                return;
              }
            }
          });
      });

      $("#nm_cl").click(function(){
          $("#"+id1).html("<?php echo $user->name; ?>");
          $("#name_edit").html("");
          $("#"+id2).show();
      });
       return;
  }

  function update_work(id1, id2) {
    $("#"+id2).hide();
    var wrk=$("#hidWork").val();
    
      $("#"+id1).html("<input type='text' name='' value='"+wrk+"' style='color: #ccc' readonly>"); 

      $("#work_edit").html("<input type='text' id='work_v' maxlength='30' placeholder='Please update work' > <i id='w_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='w_cl'></i>  <div id='msg2'>  </div> ").show();

      $("#w_up").click(function(){
          var nm=$("#work_v").val();
           if(nm==""){
            $("#msg2").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/update_work",
            method: "post", 
            data: {nm: nm},
            success: function(response){
              $("#hidWork").attr("value",nm);

              if(response==1){
                $('#'+id1).html(nm+'<a id="nm" onclick="update_work(\''+id1+'\', \''+id2+'\')"  href="#"> Edit </a>');

                $('#work_edit').html("<span class='gi'> <i class='fa fa-check'> Updated </span>").fadeOut(2000);
              }

            }

          });
      });

       $("#w_cl").click(function(){
          $("#"+id1).html(wrk);
          $("#work_edit").html("");
          $("#"+id2).show();
      });

  }

   function update_web(id1, id2) {
    $("#"+id2).hide();
    var web=$("#hidWeb").val();
      $("#"+id1).html("<input type='text' name='' value='"+web+"' style='color: #ccc' readonly>"); 

      $("#web_edit").html("<input type='url' placeholder='Please update website' id='web_v' maxlength='40'>  <i id='wr_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='wr_cl'></i>  <div id='msg3'>  </div>  ").show();

      $("#wr_up").click(function(){
          var nm=$("#web_v").val();

           if(nm==""){
            $("#msg3").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
           var prefix = 'http://';
            if (nm.substr(0, prefix.length) !== prefix)
            {
                nm = prefix + nm;
            }
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/update_web",
            method: "post", 
            data: {nm: nm},
            success: function(response){

              if(response==1){
                $("#hidWeb").attr("value", nm);
                 $('#'+id1).html(nm+'<a onclick="update_web(\''+id1+'\', \''+id2+'\')"  href="#"> Edit </a>');

                $('#web_edit').html("<span class='gi'> <i class='fa fa-check'> Updated </span>").fadeOut(2000);
              }

            }

          });
      });

       $("#wr_cl").click(function(){
          $("#"+id1).html(web);
          $("#web_edit").html("");
          $("#"+id2).show();
      });
  }

   function update_bday(id1, id2) {
    var bday=$("#hidBday").val();
    $("#"+id2).hide();
      $("#"+id1).html("<input type='text' name='' value='"+bday+"' style='color: #ccc' readonly>"); 

      $("#bday_edit").html("<input type='text' id='bday_v'  placeholder=' Enter DOB' class='textbox-n' > <i id='bd_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='bd_cl'></i>  <div id='msg4'>  </div> ").show();
      $("#bday_v").mouseover(function(){
      $('#bday_v').datepick({ dateFormat: 'yyyy-mm-dd' });
      });
      $("#bd_up").click(function(){
          var nm=$("#bday_v").val();
           if(nm==""){
            $("#msg4").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/update_bday",
            method: "post", 
            data: {nm: nm},
            success: function(response){

              if(response==1){
                $("#hidBday").attr("value", nm);
                 $('#'+id1).html(nm+'<a onclick="update_bday(\''+id1+'\', \''+id2+'\')"  href="#"> Edit </a>');

                $('#bday_edit').html("<span class='gi'> <i class='fa fa-check'> Updated </span>").fadeOut(2000);
              }

            }

          });
      });

       $("#bd_cl").click(function(){
          $("#"+id1).html(bday);
          $("#bday_edit").html("");
          $("#"+id2).show();
      });
  }


   function update_add(id1, id2) {
    var hadd=$("#hidAdd").val();
    $("#"+id2).hide();
      $("#"+id1).html("<input type='text' name='' value='"+hadd+"' style='color: #ccc' readonly>"); 

      $("#add_edit").html("<input type='text' placeholder='Please update address' id='add_v'> <i id='ad_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='ad_cl'></i>  <div id='msg5'>  </div> ").show();

      $("#ad_up").click(function(){
          var nm=$("#add_v").val();
           if(nm==""){
            $("#msg5").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/update_add",
            method: "post", 
            data: {nm: nm},
            success: function(response){

              if(response==1){
                $("#hidAdd").attr("value", nm);
                $('#'+id1).html(nm+'<a onclick="update_add(\''+id1+'\', \''+id2+'\')"  href="#"> Edit </a>');

                $('#add_edit').html("<span class='gi'> <i class='fa fa-check'> Updated </span>").fadeOut(2000);
              }

            }

          });
      });

       $("#ad_cl").click(function(){
          $("#"+id1).html(hadd);
          $("#add_edit").html("");
          $("#"+id2).show();
      });
  }


    function update_mob(id1, id2) {
    $("#"+id2).hide();
      $("#"+id1).html("<input type='text' name='' value='<?php echo $user->mobile; ?> ' readonly style='color: #ccc'>"); 

      $("#mob_edit").html("<input type='text' placeholder='Please enter mobile no.' id='mob_v' style='margin-left: 0px; margin-top: 8px;'> <br> <input type='button' id='mob_up' value='Update' class='btn-primary  ' style='height: 28px; width:78%; margin-left: 0px; margin-top: 8px;'> ");

      $("#mob_up").click(function(){
          var nm=$("#mob_v").val();
           if(nm==""){
            return false;
          }
          if(isNaN(nm)){
             $("#mob_msg").html("please enter a valid number");
            return false;
          }
          
          $.ajax({
            url: "<?php echo base_url(); ?>Settings/sendOtp",
            method: "post", 
            data: {nm: nm},
            success: function(response){ 
              if(response==1){
                $("#otpm").html(' <div class="modal fade in" id="otpModal" role="dialog" style="display: block;">    <div class="modal-dialog modal-sm">                <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">×</button>          <h4 class="modal-title"> Enter OTP </h4>        </div>        <div class="modal-body">    <form id="otpForm" method="post" onsubmit="return otpForm();">      <p style="text-align: center;"> Please Enter OTP </p> <div style="margin: 10px 0px"> <input type="hidden" id="mobnum" value="'+nm+'" > <input type="text" id="otp" name="otp" autocomplete="off" style="height: 32px; width:100%;"> </div>  <div> <input type="submit" style="height:32px; width: 100%;" class="btn-primary"> </div> </form>     </div> </div>          </div>  </div> ');
                 $("#otpModal").modal("show");
              }
            }

          });
      });
  }

    function otpForm(){
      
        var nm=$("#mobnum").val();
      $.ajax({
        url: "<?php echo base_url(); ?>Users/verify_otp/3",
        type: "post",
        data: {otp: $("#otp").val()},
        success: function(response){
            if(response=="ok")
            {
                  $.ajax({
                    url: "<?php echo base_url(); ?>Settings/update_mob",
                    type: "post",
                    data: {nm: nm},
                    success: function(response){
                      if(response==1){
                        // $(".modal-body").html("<p> Updated </p>");
                        location.reload();
                        $("#otpModal").modal("hide");
                        
                      }
                    }
                  });

                 
            }
        }
      });
      return false;
    }

  $("#update_pas").submit(function(){

    var cpass=$("#cpass").val();
    var pass=$("#pass").val();
    var rpass=$("#rpass").val();
    

    if(pass!=rpass){
      $("#pass_msg").html("password mismatch");
         return false;
    } 
   
    else{

    $.ajax({
        url: "<?php echo base_url() ?>Settings/update_pas",
        method: "post",
        data: { cpass: cpass, pass: pass },
        method: "post",
        success: function(response){
          
          if(response){
              $("#pass_msg").html("password Updated");
           }

            if(response==0){
              $("#pass_msg").html("please enter valid current password");
            }

        }
    });
    return false;
  }
  });


   $("#linkup").click(function(){
   
      if($(this).prop("checked") == false){
          $.ajax({
          url: '<?php echo base_url() ?>Settings/linkup_up/0',
          type: 'POST', 
          cache: false,
          contentType: false,
          processData: false,
   
            success: function(response){
                 $("#linkup").prop("checked", false);
                
            }
          });
      }
      else{
          $.ajax({
          url: '<?php echo base_url() ?>Settings/linkup_up/1',
          type: 'POST', 
          cache: false,
          contentType: false,
          processData: false,
          success: function(response){
              $("#linkup").prop("checked", "true");
          }
        });
        }
  });


  $("#promoting").click(function(){
       if($(this).prop("checked") == false){
        $.ajax({
          url: '<?php echo base_url() ?>Settings/promoting/0',
          type: 'POST', 
          cache: false,
          contentType: false,
          processData: false,
          success: function(response){
               $("#promoting").prop("checked", false);
               $("#modals").modal("hide");
          }
        });          
      }
    else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/promoting/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#promoting").prop("checked", "true");
    }
  });
  }
});


 $("#phone_show").click(function(){
   
       if($(this).prop("checked") == false){
         $.ajax({
          url: '<?php echo base_url() ?>Settings/phone_show/0',
          type: 'POST', 
          cache: false,
          contentType: false,
          processData: false,
          success: function(response){
             $("#phone_show").prop("checked", false);
          }
        });                    
      }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/phone_show/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#phone_show").prop("checked", true);
    }

  });
  }

});

  $("#add_show").click(function(){
   
       if($(this).prop("checked") == false){
         
        
                              
                         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/add_show/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#add_show").prop("checked", false);
    }

  });                    

  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/add_show/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#add_show").prop("checked", true);
    }

  });
  }

});


 $("#bday_show").click(function(){
   
       if($(this).prop("checked") == false){
         
        
                              
                         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/bday_show/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#bday_show").prop("checked", false);
    }

  });                    

  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/bday_show/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#bday_show").prop("checked", true);
    }

  });
  }

});


 $("#work_show").click(function(){
   
       if($(this).prop("checked") == false){      
        $.ajax({
        url: '<?php echo base_url() ?>Settings/work_show/0',
        type: 'POST', 
        cache: false,
        contentType: false,
        processData: false,
         success: function(response){
         $("#work_show").prop("checked", false);
        }
      });                    
    }
    else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/work_show/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#work_show").prop("checked", true);
    }

  });
  }

});




$("#suggest").click(function(){
   
       if($(this).prop("checked") == false){
       $.ajax({
          url: '<?php echo base_url() ?>Settings/suggest/0',
          type: 'POST', 
          cache: false,
          contentType: false,
          processData: false,
          success: function(response){
               $("#suggest").prop("checked", false);
          }
          });  
          }
          else{
            $.ajax({

            
                  url: '<?php echo base_url() ?>Settings/suggest/1',
                 type: 'POST', 
            cache: false,
            contentType: false,
            processData: false,
           
            success: function(response){
               $("#suggest").prop("checked", true);
            }

          });
          }
});


$("#email_show").click(function(){
   
       if($(this).prop("checked") == false){
         
        
                              
                         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/email_show/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#email_show").prop("checked", false);
    }

  });                    

  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/email_show/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#email_show").prop("checked", true);
    }

  });
  }

});

$("#promo_show").click(function(){
   
       if($(this).prop("checked") == false){
         
        
                              
                         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/promo_show/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#promo_show").prop("checked", false);
    }

  });                    

  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/promo_show/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#promo_show").prop("checked", true);
    }

  });
  }

});



$("#links_show").click(function(){
   
       if($(this).prop("checked") == false){
        $.ajax({
        url: '<?php echo base_url() ?>Settings/links_show/0',
        type: 'POST', 
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
         $("#links_show").prop("checked", false);
         $("#modals").modal("hide");
        }
        });                    
        }

      else{
      $.ajax({

      
            url: '<?php echo base_url() ?>Settings/links_show/1',
           type: 'POST', 
      cache: false,
      contentType: false,
      processData: false,
     
      success: function(response){
         $("#links_show").prop("checked", true);
      }

      });
    }
    });


$("#true_noti").click(function(){
   
       if($(this).prop("checked") == false){
        $.ajax({
        url: '<?php echo base_url() ?>Settings/true_noti/0',
        type: 'POST', 
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
         $("#true_noti").prop("checked", false);
         $("#modals").modal("hide");
        }
        });   
        }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/true_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#true_noti").prop("checked", true);
    }

  });
  }
});

$("#link_noti").click(function(){
   
       if($(this).prop("checked") == false){
       $.ajax({
       url: '<?php echo base_url() ?>Settings/link_noti/0',
       type: 'POST', 
       cache: false,
       contentType: false,
       processData: false,
       success: function(response){
         $("#link_noti").prop("checked", false);
         $("#modals").modal("hide");
        }
      });                
  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/link_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#link_noti").prop("checked", true);
    }

  });
  }
});


$("#buy_sell_noti").click(function(){
   
       if($(this).prop("checked") == false){
      
         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/buy_sell_noti/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#buy_sell_noti").prop("checked", false);
         $("#modals").modal("hide");
    }

  });  

  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/buy_sell_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#buy_sell_noti").prop("checked", true);
    }

  });
  }

});


$("#comment_noti").click(function(){
    if($(this).prop("checked") == false){
         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/comment_noti/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#comment_noti").prop("checked", false);
         $("#modals").modal("hide");
    }

  });  
  }
  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/comment_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#comment_noti").prop("checked", true);
    }

  });
  }

});



$("#vote_noti").click(function(){
   
       if($(this).prop("checked") == false){
     
         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/vote_noti/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#vote_noti").prop("checked", false);
         $("#modals").modal("hide");
    }

  });  
  }
  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/vote_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#vote_noti").prop("checked", true);
    }

  });
  }

});


$("#spin_noti").click(function(){
   
       if($(this).prop("checked") == false){
                             
         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/spin_noti/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#spin_noti").prop("checked", false);
         $("#modals").modal("hide");
    }

  });  
   
      
  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/spin_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#spin_noti").prop("checked", true);
    }

  });
  }

});

$("#post_noti").click(function(){
   
       if($(this).prop("checked") == false){
         
       $.ajax({

    
          url: '<?php echo base_url() ?>Settings/post_noti/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#post_noti").prop("checked", false);
          $("#modals").modal("hide");
    }

  });     
        
  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/post_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#post_noti").prop("checked", true);
    }

  });
  }

});


$("#link_updates").click(function(){
   
       if($(this).prop("checked") == false){
        $.ajax({

    
          url: '<?php echo base_url() ?>Settings/link_updates/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#link_updates").prop("checked", false);
    }

  });  
  
                       
  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/link_updates/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#link_updates").prop("checked", true);
    }

  });
  }

});
 



$("#all_noti").click(function(){
   
       if($(this).prop("checked") == false){
       
                              
         $.ajax({

    
          url: '<?php echo base_url() ?>Settings/all_noti/0',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
         $("#all_noti").prop("checked", false);
          $("#true_noti").prop("checked", false);
        $("#link_noti").prop("checked", false);
        $("#buy_sell_noti").prop("checked", false);
        $("#vote_noti").prop("checked", false);
        $("#comment_noti").prop("checked", false);
        $("#spin_noti").prop("checked", false);
         $("#modals").modal("hide");
    }

  });  
      

  }

  else{
    $.ajax({

    
          url: '<?php echo base_url() ?>Settings/all_noti/1',
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
       $("#all_noti").prop("checked", true);
       $("#true_noti").prop("checked", true);
       $("#link_noti").prop("checked", true);
       $("#buy_sell_noti").prop("checked", true);
       $("#vote_noti").prop("checked", true);
       $("#comment_noti").prop("checked", true);
       $("#spin_noti").prop("checked", true);



    }

  });
  }

});








function unblock(id){
  

  $.ajax({
    url: "<?php echo base_url(); ?>Settings/unblock/"+id,
    method: "post",
    success: function(response){
        // location.reload();

        $("#unblck").html("User succesfully unblocked...");
    }

  });

}

</script>