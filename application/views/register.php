<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Truevl</title>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <link href="<?php echo base_url(); ?>assets/css/jquery.datepick.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/jquery.plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.datepick.js"></script>
<script>
$(function() {
  $('#popupDatepicker').datepick({ dateFormat: 'yyyy-mm-dd' });
});
</script>

</head>
<style type="text/css">

.col-sm {
    float: left;
    width: 31%;
    margin: 10px 3px;
}   
  .tab {
  display: none;
}

.verror{
  color: #f00;font-size: 11px;
}
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
input.invalid {
  background-color: #ffdddd;
}

button{
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 5px 10px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}
</style>
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
  <div style="background: #006097; margin-bottom: 5px;padding-top: 15px;padding-top: 15px;">
  <h1 class="big-heading text-center text-black" style="margin-bottom: 4px;"> Sign Up Yourself </h1>

  <p class="text-center text-white"> <strong> It's Free </strong> </p>
     <br>
  </div>
  <div id="user_form">
  <div class="verror">   <?php echo validation_errors(); ?> </div>
 
     <form action="<?php echo base_url(); ?>Users/user_registration" method="post" onsubmit="return check_form();" id="regForm"> 

 <div class="tab">
   <div class="col-lg">
   <input type="text" name="email" id="email" style="width: 100%;" placeholder=" Enter Your Email" autocomplete='email' onblur="check_email();"> </div>
 
    <!-- <div class="cl"></div> -->
    <div class="warning" id="emailW">  </div>
       <div class="col-lg">  <input type="Password" id="pass" name="pass" style="width: 100%;" placeholder=" Type Password"> </div>

        <div class="col-lg"> <input type="Password" id="cpass" name="cpass" style="width: 100%;" placeholder=" Re-Type Password"> </div>
         <div class="warning" id="passW">  </div>
        
     
      <div class="warning" id="locW">  </div>
    </div>

    <div class="tab">

      <div class="col-lg">
   <input type="text" name="name" style="width: 100%;" id="name"  placeholder=" Enter your Full name" maxlength="25"> 
   </div>

       <div class="warning" id="nameW">  </div>
           <div class="cl"> </div>
           <div class="col-lg"> <select id="Gender" name="Gender" style="width: 100%;">
           <option value="0"> Select Gender </option>
           <option value="Male"> Male </option>
           <option value="Female"> Female </option>
        </select> </div>

         <div class="col-sm"> 
                    <select name="y" id="y" style="width: 100%;">
                       <option value="0">Year </option>
                        <script type="text/javascript">
                          for(var i=1950; i<=2017; i++)
                          {
                            document.writeln("<option value='"+i+"'>"+i+"</option>")
                          }

                        </script>
                   </select> 
             </div>

              <div class="col-sm"> 
                    <select name="m" id="m" style="width: 100%;">
                       <option value="0">Month </option>
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
                       <option value="0">Day </option>
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

        <div class="cl"> </div>

        <div class="col-lg"><input type="text" name="mob" id="mob" style="width: 100%;" placeholder=" Mobile Number" onblur="check_mobile();"> </div>

           <div class="warning" id="genderW">  </div>

                
                   <div class="warning" id="dobW"> </div>
               <div class="col-lg"> 
                <select name="con" id="country" style="width: 100%;">
           <option value="0"> Select Country </option>
          
        </select> 
        </div>
           <div class="col-lg"> 
         <select name="st" id="state" style="width: 100%;">
          
        </select> 
        </div>
           <div class="warning" id="constW">  </div>
        <div class="col-lg">
         <input type="text" name="loc" id="loc" style="width: 100%" placeholder=" Where do you live?"> 
         </div>


    </div>


 <div class="col-lg">
          <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
        </div>
        <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
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

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
 fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  if (currentTab >= x.length) {
    document.getElementById("sign_up").style.display="none";
    document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  y1 = x[currentTab].getElementsByTagName("select");
  for (i = 0; i < y.length; i++) {
  
    if (y[i].value == "") {
      y[i].className += " invalid";
      valid = false;
    }
  }

  for (i = 0; i < y1.length; i++) {
    if (y1[i].value == "") {
      y1[i].className += " invalid";
      valid = false;
    }
  }
    if (currentTab==0) {
     
      if($("#pass").val()!=$("#cpass").val()){
        $("#passW").html("Password mismatch");
        valid=false;
      }
      else{
        $("#passW").html("");
      }
    }
    if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}
</script>


</body>
</html>

