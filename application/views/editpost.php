<style type="text/css">
.hidden{
    display: none;
}
</style> 

<br clear="all">
<div id="content_wrapper">
<div id="Tleft"> 
</div>

<div id="Tfull" > 

<div class="postDiv">
<?php foreach ($postData as $value) {
 ?>
<div class="postForm">
<form id="form1" action="" method="post" enctype="multipart/form-data">
<div class="col-lg"> <strong> <small>  Post Title </small> </strong> </div>
<div class="col-lg"> <input class="txt-inp" type="text" name="post_title" id="post_title" style="width: 100%;" value="<?php echo $value['post_title']; ?>"> </div>

<div class="col-lg"> <span id="titE">  </span> </div>

<div class="col-lg"> <strong> <small>  Select category </small> </strong> </div>
<div class="col-lg"> 
	<select style="width: 100%;" name="cat" id="cat" form="form1">
		<option value="<?php echo $value['cat']; ?>"> <?php echo $value['cat']; ?> </option>
		<option value="Education"> Education </option>
		<option value="Jobs"> Jobs </option>
		<option value="Sports"> Sports </option>
		<option value="Entertainment"> Entertainment </option>
		<option value="News"> News </option>
		<option value="General Awareness"> General Awareness </option>
		<option value="Politics"> Politics </option>
		<option value="Computer"> Computer </option>
		<option value="Envoirnment"> Envoirnment </option>

	</select>

</div>

<div class="col-lg"> <span class="catE">  </span> </div>

<div class="col-lg"> <strong> <small>  Short Description </small> </strong> </div>
<div class="col-lg"> 
	<textarea name="short_des" id="short_des" style="width: 100%" rows="5" placeholder=" Enter Short Description for Post ">
   
   <?php echo $value['short_des']; ?> 
  </textarea>
</div>

<div class="col-lg"> <span id="shortE">  </span> </div>

<div class="col-lg"> <strong> <small>  Main Description </small> </strong> </div>
<div class="col-lg"> 
	<textarea name="main_des" id="main_des" style="width: 100%; height: 400px;" rows="5" placeholder="">
   
    <?php echo $value['main_des']; ?>  
  </textarea>
</div>

<input name="image[]" type="file" id="upload" class="hidden" onchange="">

<div class="col-lg"> <span id="mainE">  </span> </div>


<div class="col-lg"> <strong> <small>  Keywords </small> </strong> </div>
<div class="col-lg"> <input type="text" name="Keywords" id="Keywords" style="width: 100%;" value="<?php echo $value['Keywords']; ?>  "> </div>

<div class="col-lg"> <span id="keys">  </span> </div>

<div class="col-lg"> <strong> <small>  Upload Related Image </small> </strong> </div>
<div class="col-lg"> <input type="file" name="img" id="img" style="width: 100%;" onchange="preview_image(event)" > </div>
<div class="col-lg"> <span id="re"> 
   <div class="progress-wrp"><div class="progress-bar" aria-valuenow="0" aria-valuemax="100"></div >
     <!-- <div class="status" id="pb" > -->
       

     </div>

 </span> </div>
 <div class="col-lg">   

<input type="hidden" name="imgu" value="<?php echo $value['img']; ?>">
<img src="<?php echo base_url().$value['img']; ?> "  height="200" width="300" id="prevImg" >

 </div>



	<div class="col-lg"> <span class="catE">  </span> </div>
		
		<div class="col-lg"> <input type="Submit" value="Update Post" class="btn" style="width: 20%" name="sub"> </div>
	
</form>
</div>
</div>


<?php } ?>





</div>


</div>

<div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header">
      <a href="<?php echo base_url(); ?>Feeds" class="close" >     &times; </a>
          <h4 class="modal-title"> Update Post </h4>
        </div>
        <div class="modal-body">
         <div>
           <div  style="width: 20%; margin-left: 40%;">
            <img src="<?php echo base_url(); ?>assets/img/tick.jpg" width="100%" >
          </div>
         <h2 style="color: #4FA550;"> Your post has been successfully updated  </h2>
        </div>
        </div>
      </div>
    </div>
  </div>


<?php include("includes/footer.php"); ?> 


 <script type="text/javascript">
  
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
  
    $("#form1").submit(function(e){
      var formData = new FormData($(this)[0]);
        console.log(formData);
        e.preventDefault();
    $.ajax({
      xhr: function(){
      var xhr=new window.XMLHttpRequest();
      xhr.upload.addEventListener('progress', function(event) {
          if(event.lengthComputable){
               // console.log('bytes loaded'+event.loaded);
               // console.log('Total Size: '+event.total);
               // console.log('percentage uploaded'+ event.loaded/event.total);

               var percentage=Math.round((event.loaded/event.total)*100);
               $('.progress-wrp').css('display', 'block');
               $('.progress-bar').prop('aria-valuenow',percentage).css({'display': 'block','width': percentage+'%'}).text(percentage+'%');

          }

      });
      return xhr;
    },
    url: '<?php echo base_url() ?>Post/update_my_post/<?php echo $value['post_id'] ?>',
    data:formData,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){

      if(response==1)
      {
      console.log(response);
        $("#updateModal").modal('show');
        window.location="<?php echo base_url(); ?>Feeds/";
    
    }
    else{
       console.log(response);
      e.preventDefault();
    }
     
      
    }
    
    
  });
   

});

  





    
});

  

 </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

</style>



  