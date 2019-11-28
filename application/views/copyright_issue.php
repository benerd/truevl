<style type="text/css">
	
	.lbox{
		float: left;
		width: 50%;
	}

	.b1{
		border: 1px solid;
		width: 90%;
		margin: 15px auto;
		padding: 3px 8px;
	}

	.row{
		width: 100%;
		float: left;
		margin: 0px;

	}

	.left{
		width: 90%;
		float: left;
	}

	.right{
		width: 10%;
		float: left;
	}

	.mar-top{
		margin-top: 50px;
		background-color: #0093DD;
		color: #fff;
		padding: 30px 10px;

	}

	input[type="text"]{
		width: 98%;
		height: 28px;
		border: 1px solid #ccc;
	}

	textarea{
		width: 100%;
		resize: none;
		border: 1px solid #ccc;
		height: 80px;
	}

	.white-bg{
		background-color: #fff;

	}	

	.place::-webkit-input-placeholder {
    color: red;
}

.tplace::-webkit-textarea-placeholder {
    color: red;
}
</style>


<br clear="all">
<div id="content_wrapper" >

<div id="TFull" class="white-bg">

	<br clear="all">

<form action="" method="post" enctype="multipart/form-data" > 
<div class="lbox">

	<div class="b1">
		Dear Publisher what is the issue?<br> 	
		<div class="row">
		<div class="left"> Copyright issue </div> <div class="right"> <input type="radio" value="1" name="issue"></div>
		</div><div class="row">
	<div class="left"> Someone is using my image </div> <div class="right"> <input type="radio" value="2" name="issue"></div>	
		</div><div class="row">	
		<div class="left"> Trademark issue </div> <div class="right"> <input type="radio" value="3" name="issue"></div>
			</div><div class="row">
		<div class="left"> Other Legal issue issue </div> <div class="right"> <input type="radio" value="4" name="issue"></div>	</div>

		<div id="cop_issue"></div>
			<div class="cl"> </div>

	</div>


	<div class="b1">
	
		<div class="row">
		Your Full Name/Company name
		</div>
		<div class="row">
			<input type="hidden" name="post_id" value="<?php echo $pid; ?>">
	       <input type="text" name="company_name">
		</div>

		<div class="row">	
		 		Your full address/Company reg. office address
		</div>
		<div class="row">
			<input type="text" name="company_add">
		</div>

	
		
		<div class="row">
		<div class="col-md"> City </div>
		<div class="col-md"> State</div>
		</div>

		<div class="row">
		<div class="col-md"> <input type="text" name="company_city"> </div>
		<div class="col-md"> <input type="text" name="company_state"></div>
		</div>


			

		<div class="row">
		<div class="col-md"> Country </div>
		<div class="col-md"> Pin Code</div>
		</div>
		<div class="row">
		<div class="col-md"> <input type="text" name="country"> </div>
		<div class="col-md"> <input type="text" name="pin_code"></div>
		</div>
		


			<div class="cl"> </div>

	</div>
	<div class="b1">
		<div class="row">	
		 		Enter URL of copyright proof
		</div>
		<div class="row">
			<input type="text" name="url">
		</div>

		<div class="row">	
		 		Submit copyright document
		</div>
		<div class="row">
			<input type="file" name="copyright_doc">
		</div>
		<div class="cl"> </div>
	</div>

	<div class="b1">
		<div class="row">	
		 		Type of copyright work (Maximum 230 Characters)
		</div>
		<div class="row">
			<textarea name="type" id="type"> </textarea>
		</div>

		<div class="row">	
		 		Additional Information
		</div>
		<div class="row">
			<textarea name="additional_info" id="additional_info"> </textarea>
		</div>
		<div class="cl"> </div>
	</div>

</div>  <!-- <end of left side> -->

    
<div class="lbox">

	<div class="b1">
		<strong> Where does the content appear? </strong>  <br>
		<div class="row">
		<div class="left"> Entire post </div> <div class="right"> <input onclick="e_post();" type="radio" name="content_appear" value="1"></div>
		</div><div class="row">
	<div class="left"> Timestamps or paragraph No. </div> <div class="right"> <input onclick="cont_app();" type="radio" name="content_appear" value="2"></div>	
		</div>
		
		<div id="c_app">
			
		</div>
			
		<div id="con_app"></div>
			<div class="cl"> </div>

	</div>


	<div class="b1 mar-top">
		
		<div class="row">
		<div class="left">I am the owner, or an agent authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</div> <div class="right"> <input type="checkbox" name="check1"></div>
		</div>

		<div class="row">
	<div class="left">	This notoficationn is accurate </div> <div class="right"> <input type="checkbox" name="check2"></div>	
		</div>

			<div class="row">
	<div class="left">	I understand that abuse of this tool will result in termination of my truevl account.  </div> <div class="right"> <input type="checkbox" name="check3"></div>	
		</div>

		<div class="row">
			Typing your full name in this box will act as your digital signature 
		</div>

		<div class="row">
			<input type="text" style="color: #000;" name="Full_name">
		</div>

		<div class="row">
			<br>
			<input type="Submit" value="Submit Report" class="btn" name="" style="width: 20%">
		</div>

			
			
			

			<div class="cl"> </div>

	</div>


	<div id="check_msg"></div>

</div>
<div class="cl"> </div>

 </form>

 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Report Submitted </h4>
      </div>
      <div class="modal-body" style="padding: 0px;" >
         <div>
          <div  style="width: 20%; margin-left: 40%;">
            <img src="<?php echo base_url(); ?>assets/img/tick.jpg" width="100%" >
          </div>
          <div style="background: #f5f5f5;padding: 15px 0px;"> 
           <h2 style="color: #444;text-align: center;">  Report Submitted  </h2>
          </div>
        </div>
        </div>

    
     
    </div>

  </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
	function cont_app() {
		$("#c_app").html('<div class="row">			 In a video case : Submit a time <input type="text" style="width: 60px; height: 15px;" name="start_time"> to  <input type="text" style="width: 60px; height: 15px;" name="end_time"> <br>			</div>			<div class="row">				In other case: <br>				Submit the screenshot (Underline the copyright content) <br>				<input type="file" name="screenshot">			</div>');
	}

	function e_post(){
		$("#c_app").html("");
	}


	
	$("form").submit(function(){


		if($('input[name=issue]:checked').length<=0)
			{
				$("#cop_issue").html("Please select an issue").css({"color": "red","font-size": "11px", "font-weight": "bold" });
			 	return false;
			}

		if($('input[name=company_name]').val().length<=0) 
			{
				$("input[name=company_name]").attr("placeholder", "Please enter a name").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("place");
			 	return false;
			}

	

		

		if($('input[name=company_state]').val().length<=0) 
			{
				$("input[name=company_state]").attr("placeholder", "Please enter city").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("place");
			 	return false;
			}

		if($('input[name=country]').val().length<=0) 
			{
				$("input[name=country]").attr("placeholder", "Please enter country").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("place");
			 	return false;
			}

		if($('input[name=pin_code]').val().length<=0) 
			{
				$("input[name=pin_code]").attr("placeholder", "Please enter pin code").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("place");
			 	return false;
			}


		if($('input[name=url]').val().length<=0) 
			{
				$("input[name=url]").attr("placeholder", "Please enter url").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("place");
			 	return false;
		}


		if($('input[name=copyright_doc]').val().length<=0) 
			{
				$("input[name=copyright_doc]").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("place");
			 	return false;
		}

		if($('#type').val().length<=0) 
			{
				$("#type").attr("placeholder", "Please enter type of work").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("tplace");
			 	return false;
		}

		if($('#additional_info').val().length<=0) 
			{
				$("#additional_info").attr("placeholder", "Please enter pin code").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("tplace");
			 	return false;
		}

		if($('input[name=content_appear]:checked').length<=0) 
			{
				$("#con_app").html("Please select ").css({"font-size": "11px", "font-weight": "bold", "color" : "red"});
			 	return false;
		}

		if($('input[name=check1]:checked').length<=0) 
			{
				$("#check_msg").html("Please check ").css({"font-size": "11px", "font-weight": "bold","color" : "red"});
			 	return false;
		}

		if($('input[name=check2]:checked').length<=0) 
			{
				$("#check_msg").html("Please check ").css({"font-size": "11px", "font-weight": "bold","color" : "red"});
			 	return false;
		}

		if($('input[name=check3]:checked').length<=0) 
			{
				$("#check_msg").html("Please check ").css({"font-size": "11px", "font-weight": "bold","color" : "red"});
			 	return false;
		}

		if($('input[name=Full_name]').val().length<=0) 
			{
				$("input[name=Full_name]").css({"font-size": "11px", "font-weight": "bold", "border" : "1px solid red"}).addClass("place");
			 	return false;
		}

		var formData=new FormData(this);
		

		

		$.ajax({

			url: "<?php echo base_url() ?>settings/copyrights_claim",
			method: "post",
			data: formData,
			datatype: "json",
			contentType: false,
    		processData: false,
			success: function(response){
				if(response==1){
					$("#myModal").modal('show');
					location.href="<?php echo base_url(); ?>Feeds";
				}
			}

		});
			return false;	
	});

</script>