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
  
  <div id="left">   <h1 style="line-height: 42px;"> <a href="<?php echo base_url(); ?>"> truevl </a>  </h1> </div>



   <div id="rightC"> 
    <a href="<?php echo base_url(); ?>Users/login_page"> Login </a>
   </div>

</header>

<br clear="all">
<div id="sign_up">
  <h1 class="big-heading text-center text-black"> Sign Up Yourself </h1>
   <br>
  <p class="text-center"> <strong> It's Free </strong> </p>

  <div id="user_form">
  <p style="color: #f00">   <?php echo validation_errors(); ?> </p>
 
     <form action="<?php echo base_url(); ?>Users/user_registration" method="post" onsubmit="return check_form();"> 
 <legend>  Login Details</legend>
   <div class="col-md">
   <input type="text" name="email" id="email" style="width: 100%;" placeholder=" Enter Your Email" autocomplete='email' onblur="check_email();"> </div>
 
    <!-- <div class="cl"></div> -->
    <div class="warning" id="emailW">  </div>
       <div class="col-md">  <input type="Password" id="pass" name="pass" style="width: 100%;" placeholder=" Type Password"> </div>

        <div class="col-md"> <input type="Password" id="cpass" name="cpass" style="width: 100%;" placeholder=" Re-Type Password"> </div>
         <div class="warning" id="passW">  </div>
        
        <br clear="all">
           <legend>  Personal Details </legend>
      <div class="col-lg">
   <input type="text" name="name" style="width: 100%;" id="name"  placeholder=" Enter your good name"> 
   </div>
       <div class="warning" id="nameW">  </div>
    <div class="col-lg">
           <strong> <small> Gender </small></strong> </div>


           <div class="col-md"> <select id="Gender" name="Gender" style="width: 100%;">
           <option value="0"> Select Gender </option>
           <option value="Male"> Male </option>
           <option value="Female"> Female </option>
        </select> </div>

        <div class="col-md"><input type="text" name="mob" id="mob" style="width: 100%;" placeholder=" Mobile Number" onblur="check_mobile();"> </div>

           <div class="warning" id="genderW">  </div>

       <div class="col-lg">   <strong> <small> Date of Birth </small></strong>  </div>

        
        <div class="col-sm"> 
                    <select name="y" id="y" style="width: 100%;">
                       <option value="0"> Select Year </option>
                        <script type="text/javascript">
                          for(var i=1950; i<=2018; i++)
                          {
                            document.writeln("<option value='"+i+"'>"+i+"</option>")
                          }

                        </script>
                   </select> 
             </div>

              <div class="col-sm"> 
                    <select name="m" id="m" style="width: 100%;">
                       <option value="0"> Select Month </option>
                       <option value="01">Jan</option>
                       <option value="02">Feb</option>
                       <option value="03">Mar</option>
                       <option value="04">Apr</option>
                       <option value="05">May</option>
                       <option value="06">Jun</option>
                       <option value="07">Jul</option>
                       <option value="08">Aug</option>
                       <option value="09">Sep</option>
                       <option value="10">Oct</option>
                       <option value="11">Nov</option>
                       <option value="12">Dec</option>


                   </select> 
               </div>
                <div class="col-sm"> 

                    <select name="d" id="d" style="width: 100%;">
                       <option value="0"> Select Day </option>
                       <option value="01"> 1</option>
                       <option value="02"> 2</option>
                       <option value="03"> 3</option>
                       <option value="04"> 4</option>
                       <option value="05"> 5</option>
                       <option value="06"> 6</option>
                       <option value="07"> 7</option>
                       <option value="08"> 8</option>
                       <option value="09"> 9</option>
                        <script type="text/javascript">

                          for(var i=10; i<=31; i++)
                          {
                            document.writeln("<option value='"+i+"'>"+i+"</option>")
                          }

                        </script>
                   </select> 
               </div>
                   <div class="warning" id="dobW"> </div>
               <div class="col-md"> 
                <select name="con" id="country" style="width: 100%;">
           <option value="0"> Select Country </option>
           <option> India </option>
           <option> Pak </option>
        </select> 
        </div>
           <div class="col-md"> 
         <select name="st" id="state" style="width: 100%;">
           <option value="0"> Select State </option>
           <option> Uttarakhand </option>
           <option> UP </option>
        </select> 
        </div>
           <div class="warning" id="constW">  </div>
        <div class="col-lg">
         <input type="text" name="loc" id="loc" style="width: 100%" placeholder=" Where do you live?"> 
         </div>

     <div class="warning" id="locW">  </div>

 <div class="col-lg">
         <input type="submit" name="sub" id="submit" value="Create An Account" style="width: 30%;" > 
        </div>
    <div class="cl">  </div>
   </form>
      <div class="cl">  </div>
  </div>
</div>
</div>

<script type= "text/javascript" src ="<?php echo base_url(); ?>assets/js/countries.js"></script>
 

<script type="text/javascript">
    populateCountries("country", "state");   
</script>
</body>
</html>

