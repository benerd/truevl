<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Truevl</title>
   <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
</head>
<body>


<div id="wrapper">  

<header>
  
  <div id="left">   <h1> <a href="<?php echo base_url(); ?>">  truevl </a> </h1> </div>



</header>

<br clear="all">


	
  <div id="content_wrapper">
  <div id="otp_box">

    <div id="" style="background: #006097; height: 40px; line-height: 40px;margin-bottom: 15px;">
        <h3 class="text-center text-white"> Please enter OTP </h3>
    </div>

  <?php
  if($check==1){ ?> 
  <h3 style="color: #777;font-size: 14px;"  class=" text-gray text-center"> Hurray! You have been successfully registered. Please enter your OTP to verify your mobile number</h3> <?php } ?>

   <?php
  if($check==2){ ?> 
  <h3  style="color: #777;font-size: 18px;line-height: 24px;" class=" text-black text-center"> Please Enter your OTP to reset your password </h3> <?php } ?>

  <div id="otp_form">
<form action="<?php echo base_url() ?>Users/verify_otp/<?php echo $check; ?>" method="post" >
	<div class="col-lg">
   <input type="text" name="otp" id="otp" style="width: 100%;height: 30px;" placeholder=" Enter OTP" > </div>
  
  <div style="width: 100%; float: left;margin-top: 4px;">
      <div style="width: 30%; float: left;">
        <div class="">
          &nbsp;<a href="#" onclick="resendOtp();return false;" class="text-gray fs11"> Resend OTP </a>
        </div>
      </div>
      <div style="width: 70%; float: right;">
          <input type="submit" class="btn" id="sub" name="sub" value="submit" style="float: right; width: 40%;margin-right: 5px">
      </div>
      <div class="cl"> </div>
  </div>

 
  <div class="warning"  id="otpW"> 

  <?php if($this->session->flashdata("msg")){
    echo $this->session->flashdata("msg");
    } ?></div>

    <div class="info">
    </div>
<div class="cl"> </div>
  
  <br><br>

</form>

</div>
</div>
</div>
</div>
<div style="margin-bottom: 80px;"> </div>
 

</body>
</html>

<script type="text/javascript">
  
  $(document).ready(function(){
     $(document).submit(function(e){
       var otp=$("#otp").val();
     

        if(otp.length!=6){
         $("#otpW").html("Please enter a valid otp");
         e.preventDefault();
       }
     });


});


  function resendOtp(){
      $.ajax({
        url: "<?php echo base_url(); ?>Users/resendOtp",
        type: "post",
        data: {},
        success: function(response){
          $(".info").html("<div class='cl'>  </div> <p style='font-size: 12px;'> OTP has been sent to your mobile </p>");
          console.log(response);
        } 
      });
     }
</script>