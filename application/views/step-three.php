<div style="background: #fff; position: absolute;top: 42px; height: 300px; width: 100%; " >
	

	<div style="position: absolute;width: 80%; left: 10%;border: 1px solid #f5f5f5;margin-top: 120px; background: #fff; padding: 40px;" id="otp_box">
			
			<h3 style="color: #006097" class="text-center"> Link up suggestions </h3>

			<?php
			foreach ($suggests as $key => $value) { ?> 
				

			<div style="width: 15%;margin:15px  6px;float: left;border: 1px solid #ccc;"> <img src="<?php echo $value->profile_pic; ?>" style="width: 100%;"> 
				<p> <p class="text-center" style="color: #555">
          <?php echo $value->name; ?> </p> </p>
			  <a href="#" onclick="join(<?php echo $userId; ?>,<?php echo $value->id; ?>,<?php echo $key; ?>); return false;" >	<button class="lnkup<?php echo $key; ?>" style="width: 100%; background: #006097;border: none;color: #fff;"> Link up </button>
			  </div>

			  <?php } ?>

			<div class="cl">  </div>



	</div>

	<div class="cl">  </div>



</div>


	<div style="position:absolute;bottom:160px; width:80%; margin-left: 10%;"> 

	  <span class="pull-right" >    <a href="<?php echo base_url(); ?>Users/step3C"> <button id="nxt" style="width: 8%;background: green;color: #fff;border: 1px solid lightgreen;display: none; float: right;margin-left: 20px;" > Next </button> </span> </a>
		  
      <a id="skp" href="<?php echo base_url(); ?>Users/step3C"> <span class="pull-right">	Skip  </span> </a>

	 </div>


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
     
        $(".lnkup"+key).css("background", "#ccc").html("Sent");
        $("#skp").hide();
        $("#nxt").show();
    
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