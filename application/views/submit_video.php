<br clear="all">
<div id="content_wrapper">
<div id="Tleft"> 
 
<?php
foreach ($userData as $x ) {  

  include("includes/side.php");
   } ?>
</div>
 

<div style="background: #fff; width: 60%;" id="Tcenter" > 
<div> 




<div class="col-lg">  
<?php
  if($this->session->flashdata('err')){
    echo $this->session->flashdata('err');
  }
?>


<div class="videoForm">
<form id="form2" action="" method="post" enctype="multipart/form-data">
<div class="col-lg"> <strong> <small>  Video Title </small> </strong> </div>
<div class="col-lg"> <input class="txt-inp" type="text" name="post_title" id="video_title" style="width: 100%;" placeholder=" Enter video title  "> </div>

<div class="col-lg"> <span id="vide">  </span> </div>





<div class="col-lg"> <strong> <small>   Description </small> </strong> </div>
<div class="col-lg"> 
	<textarea name="short_des" id="vshort_des" style="width: 100%" rows="5" placeholder=" Enter Short Description for Post "></textarea>
</div>

<div class="col-lg"> <span id="shortDE">  </span> </div>






<div class="col-lg"> <strong> <small>  Upload Video </small> </strong> </div>
<div class="col-lg"> <input type="file" name="vid" id="vid" style="width: 100%;" > </div>

<div class="col-lg"> <span id="vre"> 

     <div class="progress-wrp"><div class="progress-bar" aria-valuenow="" aria-valuemax="100"></div >
     <!-- <div class="status" id="pb" > -->
       

     </div>
    <div id="output"><!-- error or success results --></div>
 </span> </div>



	<div class="col-lg"> <span class="VcatE">  </span> </div>
		
		<div class="col-lg"> <input type="Submit" value="Submit Post" class="btn" style="width: 20%" name="sub"> </div>
	
</form>
</div>
</div>


<script type="text/javascript">
 
function Express(){
    var a=document.getElementById("short_des").value;
    
    $('.hiddendiv').html(a+ '<br class="lbr">').css("min-height", "402px");
    $("#express").css('height',  $('.hiddendiv').height());

   
  } 

 function preview_image(event) 
 {
      var reader = new FileReader();
      reader.onload = function()
      {
        var output = document.getElementById('prevImg');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
      $("#rprev").html("<a href='#' onclick='removeImagePrev();'> Remove preview </a>");
  }  

  $(document).ready(function(){
    var check=1;
    $("#form1").submit(function(e){
       $("#pbtn").attr("disabled", "true");
      $("input").not("#search-text-input").each(function(){
      var len=$(this).val().length;
      if (len==0){

         $(this).css('border', '1px solid red');  
        $(this).focus();
        check=0;
        e.preventDefault()
      }
      else{
         $("input").css('border', '1px solid #ccc');  
        check=1;
        }

      
  });

      $("textarea").each(function(){
      var len=$(this).val().length;
      if (len==0){
        $(this).css('border', '1px solid red');  
        $(this).focus();
        check=0;
        e.preventDefault()
      }
      else{
         $("textarea").css('border', '1px solid #ccc');  
        
        check=1;
        

      }

});

      if(check==1)
      {

      var formData = new FormData($(this)[0]);
        console.log(formData);
        e.preventDefault();
      $.ajax({
      xhr: function(){
      var xhr=new window.XMLHttpRequest();
      xhr.upload.addEventListener('progress', function(event) {
          if(event.lengthComputable){
          

               var percentage=Math.round((event.loaded/event.total)*100);
               $('.progress-wrp').css('display', 'block');
               $('.progress-bar').prop('aria-valuenow',percentage).css({'display': 'block','width': percentage+'%'}).text(percentage+'%');

          }

      });
      return xhr;
    },
    url: '<?php echo base_url(); ?>Post/submit_my_post/4',
    data:formData,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
      if(response==1)
      {
       $("#myModal1").modal('show');      
      }
      else{
        return false;
      }
    }
    
    
  });
    }

});

  

  

    
});

  

 </script>