<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Truevl</title>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
</head>
<body>


<div id="wrapper">  

<header>
  
  <div id="left">   <h1> truevl </h1> </div>

<!--   <div id="centerSrch"> <form><input type='text' placeholder='Search...' id='search-text-input' /><div id='button-holder'>
    <img src='<?php echo base_url(); ?>assets/img/si.png' />
</div> </form>  </div>
  -->
   <div id="rightC"> 
    <a href="#"> Login </a>
   </div>

</header>

<br clear="all">


  
  <div id="content_wrapper">
  <div id="otp_box">
  <h1 class="heading2 text-black text-center"> <?php

  if($this->session->flashdata('er')){
    echo $this->session->flashdata('er');
  }
?>

  </h1>
  <div id="otp_form">
<form action="<?php echo base_url(); ?>Users/update_password" method="post" onsubmit="return check_pass();">
  <div class="col-lg">
   <input type="password" name="pass" id="pas" style="width: 100%;height: 30px;" placeholder=" Enter password" > </div>
   <div class="col-lg">
   <input type="password" name="cpass" id="cpas" style="width: 100%;height: 30px;" placeholder=" Confirm password" > </div>
   <div class="col-lg">
  <input type="submit" class="btn btn-sm" id="sub" name="sub" value="Login">
  </div>
  <div class="warning" style="width: 100%;" id="otpW">  </div>
<div class="cl"> </div>
</form>

</div>
</div>
</div>
</div>



</body>
</html>

<script type="text/javascript">
  
  function check_pass(){
    var pas=$("#pas").val();
    var cpas=$("#cpas").val();

    if(pas.length < 8){
      $("#otpW").html("password too short");
      return false;
    }

    if(pas!=cpas){
      $("#otpW").html("password mismatch");
      return false;
    }
    return true;
  }


</script>