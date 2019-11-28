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
      url: '<?php echo base_url();?>Feeds/seemoreFriend/',
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

<div id="Tcenter"> 
<div id="all_rows"> 


</div>

 

  <input type="hidden" id="row_no" value="0">
  

  
<!-- <edit status modal> -->






  




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



</script>
