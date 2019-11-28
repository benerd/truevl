
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <style type="text/css">
      body{
        /*background: url(<?php echo base_url(); ?>assets/img/sky.jpg);*/
        background-size: 100% 100%;
        background-attachment: fixed;

      }

      button:focus, button:active {
      outline:0;
    }
    .filter {
      transition: all 2s ease;
    }
        .container { margin:150px auto;}
      

  #contentArea{
  margin-top:370px;
  width:100%;
}    

      .grid{
  width:188px;
  min-height:100px;
  padding: 15px;
  background:#fff;
  margin:2px;
  font-size:12px;
  float:left;
  box-shadow: 0 1px 3px rgba(34,25,25,0.4);
  -moz-box-shadow: 0 1px 3px rgba(34,25,25,0.4);
  -webkit-box-shadow: 0 1px 3px rgba(34,25,25,0.4);
  
  -webkit-transition: top 1s ease, left 1s ease;
  -moz-transition: top 1s ease, left 1s ease;
  -o-transition: top 1s ease, left 1s ease;
  -ms-transition: top 1s ease, left 1s ease;

}

.grid strong {
  border-bottom:1px solid #ccc;
  margin:10px 0;
  display:block;
  padding:0 0 5px;
  font-size:17px;
}
.grid .meta{
  text-align:right;
  color:#777;
  font-style:italic;
}
.grid .imgholder img{
  max-width:100%;
  background:#ccc;
  display:block;
}

.cntnr{
  position:relative;
  width:800px;
  margin:-67px auto 25px;
  padding-bottom: 10px;
  
}

@media screen and (max-width : 1240px) {
  body{
    overflow:auto;
  }
}
@media screen and (max-width : 900px) {
  #backlinks{
    float:none;
    clear:both;
  }
  #backlinks a{
    display:inline-block;
    padding-right:20px;
  }
  #wrapper{
    margin-top:90px;
  }
}

    </style>
    <script src="<?php echo base_url(); ?>assets/js/blocksit.min.js"></script>
   <script type="text/javascript">
    
    $(document).ready(function() {
  //vendor script
  
  
  //blocksit define
  $(window).load( function() {
    $('.cntnr').BlocksIt({
      numOfCol: 3,
      offsetX: 8,
      offsetY: 8
    });
  });
  
  //window resize
  var currentWidth = 1100;
  $(window).resize(function() {
    var winWidth = $(window).width();
    var conWidth;
    if(winWidth < 660) {
      conWidth = 440;
      col = 2
    } else if(winWidth < 880) {
      conWidth = 660;
      col = 3
    } else if(winWidth < 1100) {
      conWidth = 880;
      col = 4;
    } else {
      conWidth = 1100;
      col = 5;
    }
    
    if(conWidth != currentWidth) {
      currentWidth = conWidth;
      $('.cntnr').width(conWidth);
      $('.cntnr').BlocksIt({
        numOfCol: col,
        offsetX: 8,
        offsetY: 8
      });
    }
  });
});

  </script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
   
   
  </head>
  <body>


  <div id="wrapper">  

  <header>
    
    <div id="left">   <h1> <a href="<?php echo base_url(); ?>" class="tn"> truevl </a></h1> </div>


    <div id="rightC"> <a href="users"> Create an Account </a>  </div>

  </header>
  <br clear="all">




   
  <div id="contentArea">
    

  <div id="left_s">

<!--   <div class="tab">
    <button class="tablinks active" onclick="tabs(event, 'home')">Home</button>
    <button class="tablinks" onclick="tabs(event, 'news')">News</button>
    <button class="tablinks" onclick="tabs(event, 'jobs')">Jobs</button>
    <button class="tablinks" onclick="tabs(event, 'education')">Education</button>
    <button class="tablinks" onclick="tabs(event, 'videos')">Videos</button>
   
  </div> -->



  <div id="home" class="tabcontent" style="width: 100%;">
    <div class="cntnr">
  <?php

    foreach ($trending as $key => $value) {
        if($value["views"]>0){
           $imgu=base_url().$value["img"];
      
        $url=base_url()."Feeds/landing/".$value["post_title"]."/".$value["post_id"]; 
        $url= preg_replace('/\s+/', '-', $url);

  ?>

    
    <div class="grid filter <?php echo $value["cat"]; ?> ">
  <h3 class="heading4"> <?php echo $value["cat"]; ?> >> </h3>

  <div style="width: 100%; float: left;">

    <div style="width: 100%; float: left;"> <p  class="fs12">  <a class="text-black pull-left" href="<?php echo $url; ?>">   <?php echo mb_substr($value["post_title"], 0,80); ?> </a> </p> </div>
      <div class="imgholder">  <img src="<?php echo base_url().$value['img']; ?>"  width="100%" >  </div>
    <div class="cl"> </div>
    <div style="width: 100%; ">
      <p class="fs11"> <?php echo substr($value["short_des"],0,110)."..."; ?> </p>
    </div>
    <!-- <hr>  -->
    <div style="width: 100%;" >
        <p  class="pull-right text-gray fs11"> Views <?php echo $value['views']; ?>  </p>
        
    </div>
    <div class="cl">  </div>
    <div style="width: 100%;" class="">
      <p   class="pull-right text-gray fs11"> Posted by: <span style="font-family: 'Noto Sans', sans-serif; font-weight: bold;" class="Postedby"> <?php
      
          echo $udata[$key][0]->name;
          $img= $udata[$key][0]->profile_pic;
          // echo "<img src='".base_url().$img."' height='16px' width='16px'> ";
         ?>  </span> </p>
    </div>
  
  </div>


  <div class="cl"> </div>
   
   
  </div>

  <?php
    }
    }

  ?>

</div>

</div>  

  </div>

  <div id="right_s">
  <div id="ab">



  <div id="logo">
    
  <img src="<?php echo base_url(); ?>assets/img/t.png">
  <h1> truevl </h1>
  </div>


  <div class="txt"> Upload unique content and make them valueable with others  </div>

  <div id="form">
    
    <form action="users/login" method="post">
      
      <input type="email" placeholder="Enter email" name="email" required> <br>
      <input type="password" placeholder="Enter password" name="pass" required> <br>
      <a style="color: red" class="txt" href="#"> Forgot Password </a><br>
      <input type="submit" name="sub" value="Log in" style="width: 89%;">

    </form>
    <br clear="all">

  <div class="warning" style="width: 100%">  

  

  </div>

    <h3> New In truevl? </h3>

    <span class=""> <a href="users" class="sup text-black"> Create an account it's Free </a> </span>


</div>
</div>
</div>
</div>
</div>
<div style="margin-top: 250px"> &nbsp; </div>
</div>
</body>
</html>

 