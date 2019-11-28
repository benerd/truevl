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
  
  <div id="left"> <a href="<?php echo base_url(); ?>">  <h1 style="line-height: 42px;"> truevl </h1> </a> </div>

<!--   <div id="centerSrch"> <form><input type='text' placeholder='Search...' id='search-text-input' /><div id='button-holder'>
    <img src='<?php //echo base_url(); ?>assets/img/si.png' />
</div> </form>  </div>
  -->
   <div id="rightC"> 
   </div>

</header>

<br clear="all">


  
  <div id="content_wrapper" style="background: none;">
  <div id="otp_box">

    <div id="" style="background: #006097; height: 40px; line-height: 40px;">
        <h3 class="text-center text-white"> Login </h3>
    </div>

  <h1 class="heading2 text-black  warning text-center" style="width: 100%;">
  <br> <?php

  if($this->session->flashdata('err')){
    if($this->session->flashdata('err')==1){ ?>

      <img src="<?php echo base_url(); ?>assets/img/stop.png" width="20%">  <br>
      Your account has been blocked due to suspecious activities
      

  <?php  }
    else{
    echo $this->session->flashdata('err');
  }
  }

   if($this->session->flashdata('pmsg')){
    echo $this->session->flashdata('pmsg');
  }
?>

  </h1>
  <div id="otp_form">

<form action="login" method="post" >
  <div class="col-lg">
   <input type="email" name="email"  style="width: 100%;height: 30px;" placeholder=" Enter email" > </div>
   <div class="col-lg">
   <input type="password" name="pass"  style="width: 100%;height: 30px;" placeholder=" Enter password" > </div>
   
   <div class="col-lg">
    <div style="float: left;width: 40%;">
        <a href="<?php echo base_url(); ?>Users/forgot_password" style="font-size: 12px; color: #999"> Forgot Password </a>
    </div>
    <div style="float: left;width: 60%;">
      <input type="submit" class="btn btn-sm" id="sub" name="sub" value="Login" style="float: right; width: 40%;margin-right: 0px;">
    </div>
    <div class="cl"></div>
  </div>


  <div class="warning" style="width: 100%;" id="otpW">  </div>
<div class="cl"> </div>

  <div>
    <p class="text-center sup" style="display: block;width: 100%" style="font-size: 12px;">
    <a href="<?php echo base_url(); ?>Users" style="color: green;" > Not a member Yet? Create an account. It's free </a>  </p>
  </div>

</form>

</div>
</div>
</div>
</div>

 
</body>
</html>
