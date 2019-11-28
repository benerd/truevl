
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

.join{
  background: #006097;
  font-weight: 400;
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

<div id="Tcenter"> 
<div id="all_rows"> 
<?php 

foreach ($suggest as $key => $Suggested) {
      if($Suggested[0]['active']==1){
       
     
 ?>

<div class="buyer" style="margin-bottom: 1px;">
      <img valign="top" src="<?php echo $Suggested[0]['profile_pic']; ?> " style="width: 20%;" >

      <div class="re" style="padding-top: 10px;">
      <p  class=" unm"> <a valign="top"  href="<?php echo base_url().'tuser/'.$Suggested[0]["otp"].$Suggested[0]["id"].'/'.str_replace(" ", "-", $Suggested[0]["name"]); ?>">  <?php echo $Suggested[0]["name"]; ?> </a>  </p> 

      <p class="text-gray" style="padding: 0px 3px;"> Acvtity <?php echo $suggest[$key]["activity"]; ?> </p>

      <div style="width: 100%;">
      <p style="float: left; width: 60%;padding: 0px 3px;" class="Postedby"> Links <?php echo $suggest[$key]["links"]; ?> </p>
     
     <div class="join jo<?php echo $key; ?>"> 

    <?php if($lpdata[$key][0]["link_up"]==1) { ?> 
     <a  style="color: #fff;" onclick="join(<?php echo $userId; ?>,<?php echo $Suggested[0]['id'] ?>, <?php echo $key; ?>); return false;" href="#" class="j<?php echo $key; ?>" > Linkup </a> 
    <?php } ?>
     </div> </div> </div>
       </div>
<?php } }  ?>

</div>

 

  <input type="hidden" id="row_no" value="0">
  

  
<!-- <edit status modal> -->






  




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



function join(uid,fid, key){
   $.ajax({

    
    url: '<?php echo base_url() ?>Users/addFriend/'+uid+'/'+fid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){

      if(response==1)
      {
     
      
       $(".jo"+key).css("background", "#ccc");
       $(".j"+key).html("Sent");
    
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






</script>

 <script type="text/javascript">

 

         


    

   





 

</script>

 
  
