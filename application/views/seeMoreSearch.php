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
      // $(window).unbind('scroll');
     
      var val = document.getElementById("row_no").value;
      var content = document.getElementById("all_rows").innerHTML;
      var contenta= document.getElementById("all_rows");
      var c,c1,gsb;
     
      
     
      $.ajax({
      type: 'post',
      url: '<?php echo base_url();?>Feeds/loadSearchResult/<?php echo $input; ?>',
      data: {
       getresult:val
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

<div id="Tright" style="top: 56px;"> 




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
     
          $(".j"+key).css({"background":"#fff", "color": "#ccc", "border": "1px solid #ccc"});
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
