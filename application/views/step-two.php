<div style="background: #fff; position: absolute;top: 42px; height: 300px; width: 100%; " >
	

	<div style="position: absolute;width: 32%; left: 30%;background: #fff; margin-top: 100px; padding: 40px;border: 1px solid #f5f5f5" id="otp_box" >
			
			<h3 style="color: #006097" class="text-center"> Please select your interest </h3>
			<form id="myfrm">
			<div class="bxes"> <img src="<?php echo base_url(); ?>assets/img/videos.png" > 
				
			 <div class="typo">	<input name="category[]" type="checkbox" style="margin-left: 5px;" value="Videos"> Videos </div>
			  </div>

			  <div class="bxes">  <img name="category[]" src="<?php echo base_url(); ?>assets/img/education.png" > 
				<div class="typo">	<input type="checkbox" style="margin-left: 5px;" name="category[]" value="Education"> Education </div>
			</div>

			
			<div class="bxes">  <img src="<?php echo base_url(); ?>assets/img/news.png" >
			<div class="typo">	<input name="category[]" type="checkbox" style="margin-left: 5px;" name="category[]" value="News"> News </div>
			 </div>

			<div class="cl">   </div>

			<div class="bxes">  <img src="<?php echo base_url(); ?>assets/img/politics.png" >
				<div class="typo"><input type="checkbox" style="margin-left: 5px;" name="category[]" value="Politics"> Politics </div>
			 </div>

			<div class="bxes"> <img src="<?php echo base_url(); ?>assets/img/Entertainment.png" > 
			<div class="typo">	
				<input type="checkbox" style="margin-left: 0px;" name="category[]" value="Entertainment" >Entertainment </div>
			 </div>

			<div class="bxes">  <img src="<?php echo base_url(); ?>assets/img/sports.png" > 
				
				<div class="typo"> <input type="checkbox" style="margin-left: 5px;" name="category[]" value="Sports"> Sports </div>
			</div>

		

			<div class="cl">  </div>

			<div id="err">  </div>

	</div>

	<div class="cl">  </div>



</div>


	<div style="position:absolute;bottom: 30px; width:80%; margin-left: 10%;"> 

		 <button style="width: 8%;background: green;color: #fff;border: 1px solid lightgreen;float: right;margin-left: 20px;" type="Submit" > Next </button>
		<a href="<?php echo base_url(); ?>Users/stepOne" > 	 <button style="width: 8%;background: #f5f5f5;color: #777;border: 1px solid #ccc;float: right;margin-left: 20px;" type="button" > Prev </button>
			</form>

	 </div>


<style type="text/css">

input{
	height: inherit;
}

.bxes{
	width: 26%;margin:15px 10px;float: left;
}

.typo{
	font-size: 13px; color: #aaa;
}

img{
	width: 100%;
}

</style>

<script type="text/javascript">

$("#myfrm").submit(function(e){

	e.preventDefault();

	if ($('input:checkbox:checked').length < 2) {
		$("#err").html(" <strong> Please select atleast two interests </strong> ").css({"color" : "red", "font-size": "18px"});
		return false;
	}

	var data=$(this).serialize();

	$.ajax({
		url: "<?php echo base_url(); ?>Users/interests",
		type: "post",
		data: data,
		success: function(response){
			
			if(response==1){
				window.location="<?php echo base_url(); ?>Users/stepThree";
			}
		}
	})


});	



</script>