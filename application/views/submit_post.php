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



<div class="postDiv">
<div class="col-lg">  
<?php
  if($this->session->flashdata('err')){
    echo $this->session->flashdata('err');
  }

?>
</div>
<div class="postForm">
<form id="form1" action="" method="post" enctype="multipart/form-data">
<div class="col-lg"> <strong> <small>  Post Title </small> </strong> </div>
<div class="col-lg"> <input class="txt-inp" type="text" name="post_title" id="post_title" style="width: 100%;" placeholder=" Enter post title  "> </div>

<div class="col-lg"> <span id="titE">  </span> </div>

<div class="col-lg"> <strong> <small>  Select category </small> </strong> </div>
<div class="col-lg"> 
  <select style="width: 100%;" name="cat" id="cat" form="form1">
    <option value="select">--Select Category--</option>
    <option value="Education"> Education </option>
    <option value="Jobs"> Jobs </option>
  
    <option value="News"> News </option>
    

  </select>

</div>

<div class="col-lg"> <span class="catE">  </span> </div>

<div class="col-lg"> <strong> <small>  Short Description </small> </strong> </div>
<div class="col-lg"> 
  <textarea name="short_des" id="short_des" style="width: 100%" rows="5" placeholder=" Enter Short Description for Post " onkeyup="Express()" ></textarea>
  <div class="hiddenDiv"> </div>
</div>
<div class="col-lg"> <span id="shortE">  </span> </div>

<div class="col-lg"> <strong> <small>  Main Description </small> </strong> </div>
<div class="col-lg"> 
   <textarea name="main_des" id="main_des" style="width: 100%; height: 400px;" rows="5" placeholder=""></textarea>
</div>

<div class="col-lg"> <span id="s_msg">  </span> </div>

<input name="image[]" type="file" id="upload" class="hidden" onchange="">

<div class="col-lg"> <span id="mainE">  </span> </div>
<div class="col-lg"> <strong> <small>  Keywords </small> </strong> </div>
<div class="col-lg"> <input type="text" name="Keywords" id="Keywords" style="width: 100%;" placeholder=" e.g. Jobs in Dehradun "> </div>

<div class="col-lg"> <span id="keys">  </span> </div>

<div class="col-lg"> <strong> <small>  Upload Related Image </small> </strong> </div>
<div class="col-lg"> <input type="file" onchange="preview_image(event)" name="img" id="img" style="width: 100%;" > </div>

<div class="col-lg">  
  <img src="" id="prevImg" width="40%" >
</div>

<div class="col-lg"> <span id="re"> 
   <div class="progress-wrp"><div class="progress-bar" aria-valuenow="0" aria-valuemax="100"></div ></div>

 </span> </div>



  <div class="col-lg"> <span class="catE">  </span> </div>
    
    <div class="col-lg"> <button type="Submit" class="btn btn-success" style="width: 20%" id="pbtn" name="sub"> Submit Post </button></div>
  
</form>
</div>
</div> 

<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-sm"> 
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
      <a href="<?php echo base_url(); ?>Feeds" class="close" >     &times; </a>
          <h4 class="modal-title"> Upload Post </h4>
        </div>
        <div class="modal-body" style="padding: 0px;" >
         <div>
          <div  style="width: 20%; margin-left: 40%;">
            <img src="<?php echo base_url(); ?>assets/img/tick.jpg" width="100%" >
          </div>
          <div style="background: #f5f5f5;padding: 15px 0px;"> 
           <h2 style="color: #444;text-align: center;"> Your post has been successfully submitted  </h2>
          </div>
        </div>
        </div>
       
      </div>
      
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


    $("select").each(function(){
      var len=$(this).val();
      if (len=="select"){
        // $(this).css('color', 'red');
        check=0;
         $(this).css('border', '1px solid red');  
        $(this).focus();
        $(".catE").html("Please Select");
        $(".catE").addClass('post-warning');
        e.preventDefault()
      }
      else{
         $("select").css('border', '1px solid #ccc');  
        
        $(".catE").html("");
        $(".catE").removeClass('post-warning');
        
        check=1;
      }

    });
    
    var wordCount = document.getElementById("main_des").value.trim().split(/\s+/).length;
   
    if(wordCount==""){
        $('#s_msg').html("Sorry! This field can't be empty").css("color", "red");
        check=0;
    }
    else{
      check=1;
    }
    if(wordCount<=50){
        $('#s_msg').html("Sorry! Please write atleast 50 words ").css("color", "red");
        check=0;
    }
    else{
      check=1;
    }

    

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
    url: '<?php echo base_url(); ?>Post/submit_my_post/1',
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

<style type="text/css">
  
.progress-wrp {
    display: none;
    border: 1px solid #0099CC;
    padding: 1px;
    position: relative;
    border-radius: 3px;
    margin: 10px;
    text-align: left;
    background: #fff;
    box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
}
.progress-wrp .progress-bar{
  display: none;
    height: 20px;
    border-radius: 3px;
    background-color: #5CAA50;
    width: 0%;
    box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
}
.progress-wrp .status{
    top:3px;
    left:50%;
    position:absolute;
    display:inline-block;
    color: #000000;
}

.content {
        margin: 0 auto;
        max-width: 100%;
      }

</style>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>