<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Truevl</title>
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Teko:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT|Teko:700" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
   
     <style type="text/css">
      body{
      
        background-size: 100%;
        background-attachment: fixed;

      }

      .ab {
          height: 60px;
          width: 60px;
          float: left;
          overflow: hidden;
          margin: 1px;
          position: relative;
          background-color: black;
          overflow: hidden;
          margin: auto;
          z-index: 1; 
      }

      .ab img{
        position: absolute;
        top: 0px;
        left: 0px;
        
      }

    </style>
  </head>
  <body>


  <div id="wrapper">  

  <header>
    
    <div id="left">   <h1> <a href="<?php echo base_url(); ?>" class="tn"> truevl </a></h1> </div>


  
   

  </header>
<br>



   
  <div id="contentArea">

  <div id="right_s"  >
  <div id="ab" style="left: 40%;">



  <div id="logo">
    
  <img src="<?php echo base_url(); ?>assets/img/t.png">
  <h1> truevl </h1>
  </div>


  <div class="txt">  </div>

  <div id="form">
    
    <form action="<?php echo base_url(); ?>Admin/login" method="post">
      
      <input type="text"  placeholder="Enter Admin Id" name="id" required> <br>
      <input type="password" placeholder="Enter password" name="pass" required> <br>
    
      <input type="submit" name="sub" value="Log in">

    </form>
    <br clear="all">

  <div class="warning" style="width: 100%">  

  

  </div>

    


  </div>


  </div>

  </div>
  </div>
  </div>



  <div style="margin-top: 250px"> &nbsp; </div>

   


   
   
   </div>
  </body>
  </html>

  <?php 





  function imageResize($width, $height){

  $target=60;

  // if($width <800 && $height <800){
  //   $target=300;

  // }


  if ($width > $height) {
  $percentage = ($target / $width);
  } else {
  $percentage = ($target / $height);
  }


  $width = round($width * $percentage);
  $height = round($height * $percentage);


  return "width= $width"." height=$height";
  }
  ?>