

<div id="content_wrapper">
  <div id="otp_box">
  <h1 class="heading2 text-black text-center" style="color: red;"> <?php

  if($this->session->flashdata('er')){
    echo $this->session->flashdata('er');
  }
?>
 
    </h1>

    <div id="" style="background: #006097; height: 40px; line-height: 40px;">
        <h3 class="text-center text-white"> Forgot Password </h3>
    </div>
 
 <hr>
 <br>
  <div id="otp_form">
 <h4 style="color: #777"> &nbsp; Enter your registered mobile to reset your password </h4> 
 

<form action="<?php echo base_url(); ?>Users/forgot" method="post" onsubmit="return check_number();">
  <div class="col-lg">
   <input type="text" name="mn" id="mn" style="width: 100%;height: 30px;" placeholder=" Enter mobile number" > </div>
    
   
         <div class="warning" style="width: 100%;" id="otpW">  </div>
   

   <div class="col-lg">
  <input type="submit" class="btn"  id="sub" name="sub" value="Submit" style="float: right;width: 18%;">
  </div>

 
<div class="cl"> </div>
<div class="cl"> </div>
</form>
</div>
</div>
</div>

<script type="text/javascript">
	
function check_number(){
	var nm=$("#mn").val();

	if(isNaN(nm)){
		$("#otpW").html("Only numbers are allowed");
		return false;
	}

	if(nm.length!=10 ){
		$("#otpW").html("Please enter a valid mobile number");
		return false;
	}

	return true;
}

</script>