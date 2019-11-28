
  <!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Truevl</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Teko:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT|Teko:700" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){


 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
   window.location= "http://m.truevl.com";
  }
 else {
  return  false;
  }


});
    
</script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
   
     <style type="text/css">
      #ban{
        background: url(<?php echo base_url(); ?>assets/img/sky.jpg);
        background-size: 100%;
         /*position: absolute;
         top: 46px;*/
        height: 300px;

      }

      input[type="file"] {
          display: none;
      }

      .custom-file-upload {
          border: 1px solid #ccc;
          display: inline-block;
          padding: 6px 12px;
          cursor: pointer;
      }
      .col-lg {
        margin: 5px 5px;
      }

      body{
        background: #e1eaf3
      }

      label{
        color: #555;
        font-size: 14px;
        font-weight: 700;
      }

      input[type="text"]{
        border: 1px solid #eee;
      }

      input,select,textarea{
        border: 1px solid #eee;
      }
    </style>
  </head>
  <body>


  <div id="wrapper">  

  <header>
    
    <div id="left">   <h1 style="line-height: 42px;"> <a href="<?php echo base_url(); ?>" class="tn"> truevl  </a></h1>  </div>


  

   <div class="cl"> </div>

  </header>


  

  <!-- <div id="ban">
    <div style="background: rgba(255,255,255,0.2);height: 300px">
      
    </div>
  </div> -->
<div id="content_wrapper" style="margin-top: 0px;">
  <div style="width: 60%; left: 20%;position: absolute;top:20px; border: 1px solid #ccc;margin-top: 40px;background: #fff;box-shadow: 0px 0px 10px #f5f5f5;" >
  

    <p class="text-center" style="margin-top: 10px;"> <span style="font-size: 26px;color: #006097;font-weight: 700;"> truevl </span><i style="color: #006097;"> feedback </i> </p>

    <div style="margin-top: 50px;margin-bottom: 20px;float: left;width: 100%;">
      <form method="post" id="feedbackForm" enctype="multipart/form-data" >
      <div style="float: left;width: 35%;margin-left: 5%;">
         <div class="col-lg"> <label> Email </label> </div>
         <div class="col-lg">  <input type="email" style="width: 97%" name="email" required> </div>

         <div class="col-lg"> <label> Feedback & Attachment </label> </div>
         <div class="col-lg">  
          <textarea width="97%;" name="feedback" rows="5"></textarea>
          <br>
          <label class="custom-file-upload">
            <input type="file" name="attachment" />
            Attachment  <img src="http://localhost/tvbeta/assets/img/attach.png" height="18px" width="18px" valign="middle">  
          </label>
         </div>

         <div class="col-lg"> <label> Country </label> </div>
         <div class="col-lg">     <select style="width: 100%; " name="country" id="country" required>
           <option value="0"> Select Country </option>
          
        </select> 
        </div>

         <div class="col-lg"> <label> State </label> </div>
         <div class="col-lg">    
 <select name="state" id="state" style="width: 100%; " required>
          <option > Select state </option>
        </select>   </div>

         <div class="col-lg"> <label> Mobile </label> </div>
         <div class="col-lg">  <input type="number" style="width: 97%" name="mobile" required> </div>

         <div class="col-lg"> <input type="submit" class="btn-primary"  style="width: 100%;background: #006097;color: #fff;" name=""> </div>

      </div>
    </form>
      <div style="float: left;width: 55%;margin-right: 5%;">
        <img src="<?php echo base_url(); ?>assets/img/feedback.jpg" width="100%">
        <br><br><br>
        <h3 class="text-right" style="color: #555;"> We wan't your feedback, <br>
          It's important to us.
        </h3>
      </div>
      <div class="cl"></div>
    </div>
  </div>
</div>



  </div>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="margin: 0px;padding: 0px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Feedback Submit </h4>
        </div> 
        <div class="modal-body">

          <br> 
          <p> Thank you for your valueable feedback. It means a lot to stay. Stay tuned! </p>
          <br> 
        </div>
     
      </div>
      
    </div>
  </div>


<script type= "text/javascript" src ="<?php echo base_url(); ?>assets/js/countries.js"></script>



<script type="text/javascript">
    populateCountries("country", "state");   
</script>

<script type="text/javascript">
  
  $("#feedbackForm").submit(function(e){
      e.preventDefault();

      var formData=new FormData(this);
      $.ajax({
        url: "<?php echo base_url(); ?>Welcome/insertFeedback",
        type: "post",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
          // alert("submitted");
          $("#myModal").modal("show");
          // location.reload();
          console.log(response);
          e.preventDefault();
          return false;
        }
      });  
     
    });

</script>
</body>
</html>

  