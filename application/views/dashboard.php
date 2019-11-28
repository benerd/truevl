<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/Chart.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/angular-chart.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/angular-chart.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.js"></script>

<br clear="all">
<div style="margin-top: 1px;width: 1200px;
  margin: auto; 
  margin-top: 10px;  
  background: #f5f5f5">
<div id="Tleft">
<?php 
foreach ($userData as $x ) {
  include 'includes/side.php';
   } ?>

</div>



<div id="TCenter" style="position: absolute; left: 362px;background: #fff; width: 62%" > 

<div class="row">

 <div class="tab">
    <button class="tablinks active" onclick="tabs(event, 'home')">Summary</button>
    <button class="tablinks" onclick="tabs(event, 'Post')"> Post </button>
    <button class="not-allowed tablinks" onclick="working(1);return false;"> Earning Report </button>
    <button class="tablinks" onclick="working(2);return false;"> Promotion </button>
    
    <button class="tablinks" onclick="working(3);return false;"> Truevl Donation </button>
    <button class="tablinks" onclick="tabs(event, 'Spam')">Spam alert</button>
    <button class="tablinks" onclick="working(4);return false;"> Payments </button>
   
  </div>

</div>

  <div class="row"> 

  <div id="home" class="tabcontent" >

  <div class="dash">
    
      <div class="dbox">
      <div class="icons blu">

        <h3 class="text-center">
       <i class="fa fa-handshake-o" aria-hidden="true"></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> Promo Earning </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          <?php echo number_format($totalPromo, 2); ?>  </p>
      </div>

    </div> 
      
     <div class="dbox">
      <div class="icons blu">

        <h3 class="text-center">
       <i class="fa fa-handshake-o" aria-hidden="true"></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> Bonus </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          <?php echo number_format($totalBonus, 2); ?>  </p>
      </div>

    </div> 
  

    <div class="dbox">
      <div class="icons orange">

        <h3 class="text-center">
       <i class="fa fa-hand-paper-o" aria-hidden="true"></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> This Month Earning </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i> 
           <?php echo number_format($monthlyEarning,2); ?>
         </p>
      </div>

    </div> 

      <div class="dbox">
       <div class="icons green">

        <h3 class="text-center">
        <i class="fa fa-inr" ></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> Total Balance </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i> 
           <?php

           echo number_format($totalBalance[0]["total"], 2);
           ?>
            </p>
      </div>
    </div> 

    <div class="dbox">
       <div class="icons green">

        <h3 class="text-center">
        <i class="fa fa-inr" ></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> Last Payout </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i> 
           <?php

           echo number_format($totalBalance[0]["total"], 2);
           ?>
            </p>
      </div>
    </div> 

<div class="cl"> </div>

</div>
  <div class="dash boxx" >
    <div style="width: 20%; float: left; border-right: 3px solid #ccc;margin-top: 10px;padding-bottom: 40px;">
      <h3 style="margin-top: 50px;" class="text-center tdeading"> Total Earning </h3>
      <h2 class="text-center" style="font-size: 36px;">   <?php

           echo number_format($totalBalance[0]["total"], 2);
           ?> </h2>
      <h4 class="text-center"> Date from <?php echo date("F, Y"); ?> </h4>
    </div>

    <div style="width: 79%; float: left;">
   <?php 
      if(count(json_decode($monthWiseEarning))==0){
        ?>
        <br><br>

    <h1 class="text-center text-gray"> 
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="42.000000pt" height="42.000000pt" viewBox="0 0 712.000000 688.000000"
 preserveAspectRatio="xMidYMid meet">
<metadata>

</metadata>
<g transform="translate(0.000000,688.000000) scale(0.100000,-0.100000)"
fill="#ccc" stroke="none">
<path d="M3425 6684 c-640 -53 -1221 -283 -1722 -682 -139 -111 -375 -346
-487 -487 -446 -560 -690 -1225 -713 -1945 -22 -685 169 -1352 549 -1918 199
-296 500 -610 774 -806 l52 -36 51 80 c28 44 54 86 57 94 3 9 -18 31 -58 62
-386 294 -685 655 -893 1079 -216 440 -310 852 -309 1355 1 503 93 896 314
1345 245 497 607 902 1067 1194 930 591 2094 601 3045 26 l57 -34 60 92 c69
105 76 86 -66 168 -355 206 -738 336 -1158 394 -107 15 -517 27 -620 19z"/>
<path d="M5304 5952 c-34 -53 -180 -281 -324 -507 -145 -225 -387 -603 -538
-840 -362 -566 -694 -1084 -747 -1165 -23 -36 -171 -267 -330 -515 -158 -247
-302 -472 -320 -500 -42 -65 -584 -910 -785 -1225 -86 -135 -173 -270 -193
-300 -20 -30 -37 -58 -37 -62 0 -4 27 -25 59 -48 l60 -40 19 28 c10 15 108
166 217 337 109 171 289 452 400 625 460 718 563 879 609 950 26 41 105 165
176 275 144 224 298 465 440 687 159 247 436 680 589 918 133 208 288 449 608
950 69 107 160 251 204 318 43 68 79 127 79 130 0 7 -113 83 -121 81 -2 0 -32
-44 -65 -97z"/>
<path d="M5568 5879 l-57 -92 57 -50 c163 -144 363 -373 491 -562 752 -1112
679 -2620 -178 -3642 -716 -855 -1797 -1226 -2869 -987 -166 37 -387 112 -543
184 -74 34 -139 63 -144 66 -9 4 -125 -162 -125 -178 0 -10 213 -110 325 -153
558 -216 1152 -267 1740 -150 443 89 882 286 1250 564 941 709 1425 1900 1249
3073 -97 652 -373 1230 -824 1728 -75 84 -295 290 -308 290 -4 0 -33 -41 -64
-91z"/>
<path d="M2870 4900 l0 -240 90 0 90 0 -2 238 -3 237 -87 3 -88 3 0 -241z"/>
<path d="M3467 5133 c-4 -3 -7 -111 -7 -240 l0 -233 90 0 90 0 0 240 0 240
-83 0 c-46 0 -87 -3 -90 -7z"/>
<path d="M4060 4900 l0 -240 90 0 90 0 -2 238 -3 237 -87 3 -88 3 0 -241z"/>
<path d="M1930 3355 l0 -1675 254 0 254 0 66 105 c36 58 66 107 66 110 0 3
-94 5 -210 5 l-210 0 0 1455 0 1455 303 2 302 3 3 108 3 107 -416 0 -415 0 0
-1675z"/>
<path d="M3160 4920 l0 -110 95 0 95 0 0 110 0 110 -95 0 -95 0 0 -110z"/>
<path d="M3760 4920 l0 -111 90 3 c50 2 90 6 90 11 0 4 0 52 0 107 l0 100 -90
0 -90 0 0 -110z"/>
<path d="M4350 4920 l0 -110 45 0 46 0 63 98 c34 53 66 103 70 110 6 9 -19 12
-108 12 l-116 0 0 -110z"/>
<path d="M4960 4929 c-36 -56 -66 -105 -68 -110 -2 -5 19 -9 47 -9 l51 0 1
-1430 c1 -786 2 -1437 2 -1445 0 -8 -1 -19 -2 -25 -1 -7 -337 -10 -986 -10
l-985 0 -63 -98 c-35 -53 -66 -103 -71 -109 -6 -10 230 -13 1163 -13 l1171 0
0 1675 0 1675 -98 0 -97 0 -65 -101z"/>
</g>
</svg>
<br>
No record found
</h1>
      <?php } else{ ?>
    
    <canvas id="myChart14" style="height: 80px; "  height="80px" ></canvas>
      <?php } ?>
    </div>
  </div>



<div class="cl"> </div>

  <div>
    <h3> No record found </h3>

  </div>


  </div>
  </div>


  <div class="row">
     <div id="Post" class="tabcontent" style="min-height: 400px;" >

      <div class="dash" style="margin-top: 40px;">
   <h1 class="tdeading"> Your post  </h1> <br>

<div style="width: 100%" cellpadding="4px">
   <table  class="" id="tableData1">
     <thead>
      <tr class="trow">
        <th>Publish Date </th>
        <th>Post Title </th>
        <th>Category </th> 
        <th>Type  </th>
        <th> Total Views  </th>
        <th> Unique views </th>
        <th> Bonus </th>
        <th>  Action </th>
      </tr>
    </thead>
    <?php

      if(count($postData)==0){ ?>
       <tr>   <td colspan="8"> No record found  </td> </tr>
      <?php  }  
      else{
      foreach ($postData as $key => $post) {

         $url=base_url()."feeds/landing/".$post->post_title."/".$post->post_id; 
         $url= preg_replace('/\s+/', '-', $url);
         $url=str_replace("?","-", $url);
         $url=str_replace("!","-", $url);
         $url=str_replace("#","-", $url);
         $url=str_replace("%","-", $url);
     
      ?>

      <tr class="trow">
          <td> <?php 
          $date = new DateTime($post->posted_on);
          $result = $date->format('Y-m-d');
          echo $result;
            ?>  </td>
          <td>
          <a href="<?php echo $url; ?>">  
            <?php 
              if($post->img!=NULL){
               ?>
               <img src=" <?php echo base_url().$post->img; ?>" height="40px" width="40px" valign="middle" > 
              <?php }
              else{ ?>
           <img src=" <?php echo base_url().$post->thumb; ?>" height="40px" width="40px" valign="middle" > 

              <?php }

              ?>
           <?php echo mb_substr($post->post_title, 0,40); ?>
            </a>
          </td>
          <td><?php echo mb_substr($post->cat,0,3).".."; ?></td>
         
          <td> <?php 
            if($post->img!=NULL){
                echo "  <i class='fa fa-file-word-o' aria-hidden='true'></i>";
              }
              else{
                echo "<i class='fa fa-file-video-o' aria-hidden='true'></i>";
              }
           ?> </td>
        
            <td> <?php echo $post->views; ?>   </td>
          <td> <?php echo $post->VSUM; ?> </td>

          <td> <?php echo $post->bsum; ?>   </td>
           <td> 
          <?php    if($post->img!=NULL){ ?>
         <a href="<?php echo base_url(); ?>Post/editpost/<?php echo $post->post_id; ?>">  <i class="fa fa-edit"> </i> </a>  <?php }  ?>    
         <?php if($post->Vfile!=NULL){ ?>
         <a href="<?php echo base_url(); ?>timeline/editVideo/<?php echo $post->post_id; ?>">   <i class="fa fa-edit"> </i>   </a> <?php }  ?>  

            | 
             <a href="#" onclick="ask(<?php echo $post->post_id ?>);return false"> <i class="fa fa-remove"> </i> </a> </td>
      </tr>

      <?php }  }


    ?>

   </table>
   </div>
 </div>
 </div>
  </div>


  <div class="row">
      <div id="Earning" class="tabcontent"  >
      <div>
        <br><br>
        <h3> No record found </h3>
        <br><br><br><br><br><br><br>
          <br><br><br><br><br><br><br> <br><br><br><br><br><br><br>
      </div>
      </div>
  </div>


   <div class="row">
      <div id="Promotion" class="tabcontent"  >
        
        <div class="dash">
    
      <div class="dbox" style="width: 23%;">
      <div class="icons blu">

        <h3 class="text-center">
       <i class="fa fa-handshake-o" aria-hidden="true"></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> Total money in wallet </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          <?php echo number_format($wa, 2); ?>  </p>
      </div>

    </div> 
      

  

    <div class="dbox" style="width: 23%;">
      <div class="icons orange">

        <h3 class="text-center">
       <i class="fa fa-hand-paper-o" aria-hidden="true"></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> Last Added </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i> 
           <?php echo number_format($ladd,2); ?>
         </p>
      </div>

    </div> 

      <div class="dbox" style="width: 23%;">
       <div class="icons green">

        <h3 class="text-center">
        <i class="fa fa-inr" ></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;"> Today Promotion Expense </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i> 
           <?php

           echo number_format($texp, 2);
           ?>
            </p>
      </div>
    </div> 

    <div class="dbox" style="width: 23%;">
       <div class="icons green">

        <h3 class="text-center">
        <i class="fa fa-inr" ></i>  </h3>
        
      </div>

      <div>
         <h4 class="text-center" style="margin-top: 25px; margin-bottom: 10px;">  Total Promotion Expense </h4>
         <p class="text-center" style="font-size: 32px; font-weight: 700;"> <i class="fa fa-inr" ></i> 
           <?php

           echo number_format($totp, 2);
           ?>
            </p>
      </div>
    </div> 

<div class="cl"> </div>
  <br>
    &nbsp;<h3> Promotion Summary </h3>
    <div style="width: 100%" cellpadding="4px">
   <table  class="" id="tableData" >
     <thead> 
      <tr class="trow">
        <th> <b>  Date </b> </th>
         <th> <b> Post Title </b> </th>
        
         <th> <b> No. of Promoters </b> </th>
         <th> <b> Promotion Expenses </b> </th>
         <th> <b>  Circulation </b> </th>
         <th> <b>  Action </b> </th>
      </tr>
    </thead>
     
     <?php

      if(count($promotedPost) > 0) {  
      foreach ($promotedPost as $key => $post) { 
          if($key < 5){ 
        ?>
      <tr class="trow">
          <td> <?php 
          $date = new DateTime($post->posted_on);
          $result = $date->format('Y-m-d');
          echo $result;
            ?>  </td>
          <td> 
              <?php 
              if($post->img!=NULL){
               ?>
               <img src=" <?php echo $post->img; ?>" height="40px" width="40px" valign="middle" > 
              <?php }
               else{ ?>
              <img src=" <?php echo base_url().$post->thumb; ?>" height="40px" width="40px" valign="middle" > 

              <?php }

              ?>
            <?php echo mb_substr($post->post_title, 0,40); ?> </td>
         
         
        
      
          <td> <a href="#" onclick="promoters(<?php echo $post->post_id; ?>);return false;"> <?php echo $post->nop; ?> </a>  </td>
        
  
          <td>  <?php echo $post->pamount; ?>   </td>
            <td> 

              <?php 
                echo $post->reaches; 
            ?>
              

             </td>
          <td>
             <?php if($post->promo==0) { ?> 
           <a href="#" id="start" onclick="askPromotion(<?php echo $post->post_id; ?>); return false;"> Stop promotion </a>  </td>
           <?php } else { ?>
            <a id="stp" href="#" onclick="askstartPromotion(<?php echo $post->post_id; ?>); return false;"> Start promotion </a>  </td>
            <?php } ?>
      </tr>

      <?php } } }

      else { 
    ?>
      <tr>
        <td colspan="8"> No record found </td>
      </tr>
    <?php } ?>

   </table>
 </div>
</div>


      </div>
  </div>



  <div class="row">
  <div id="Help" class="tabcontent">

    <div>
      <br><br>
        <h3 style="color: #999;"> We are working on it. Stay tuned.  </h3> <br><br><br><br><br><br><br>
          <br><br><br><br><br><br><br> <br><br><br><br><br><br><br>
    </div>
  </div>
</div>
  

   <div class="row">
      <div id="Spam" class="tabcontent" style="min-height: 550px;">

      <br>  <br>
         <h1 class="tdeading"> Spam alerts </h1> 
            <div style="width: 100%" cellpadding="4px">

        <?php

          if(count($getSpamsByUser) ==0)
          {
            echo "<h3 style='color: #999'> No spams </h3>";
          }
          else {
        ?>
   <table  class="" id="tableData8" >
      <thead>
      <tr class="trow">
        <th> S.N.  </th>
        <th> Post Title </th>
        <th> Number Of Spams </th>   
        <th> Action </th> 
      </tr>
    </thead>
    <?php
      $i=1;
      foreach ($getSpamsByUser as $key => $post) {
       
       ?> 
       <tr class="trow">
          <td> <?php echo $i; ?>  </td>
          <td> <?php
            if($post->is_status==0){
              echo $post->pdata;
            } 
            else if($post->is_status==1){
               echo $post->sdesc;
            }
            else if($post->is_status==2){
               echo $post->mdesc;
            }
            else {}
            ?> </td>
          <td> <?php echo $post->pcount; ?> </td>
          <td> <a href="#" onclick="ask(<?php echo $post->post_id; ?>);"> Delete </a> </td>
      </tr>

      <?php $i++; } 


    ?>

   </table>
 <?php } ?>
   </div>



<div class="cl"> </div>

      </div>
   </div>


  <div class="row">
   <div id="Payments" class="tabcontent"  >
    <div>
     

      <table width="100%" >
    
    
<?php
$i=1;
if(count($statement) > 0) { 
foreach ($statement as $key => $val) {
   $post_id=$val["post_id"];
   $postData=$this->Feed_model->landingPost($post_id);

   if($val["incocming_balance"]!=0) { ?>
       <tr class="trow">
          <td width="10%" class="text-center"> <?php echo $i; ?> </td>
          <td width="40%"> <?php echo $postData[0]->post_title; ?>  </td>
          <?php if ($val["incocming_balance"]!=0) { ?>
             <td> <?php echo "+".$val["incocming_balance"]; ?> </td>
           <?php  }  ?>
          
        
          <td> <?php echo $val["time"]; ?> </td>
          <td class="text-center"> <?php echo $val["source"]." earning"; ?> <?php ?>  </td>  
           </tr>  

<?php $i++; } } }

else{  ?>
    <tr> <td colspan="3"> No record found </td> </tr>
<?php }

?>
</table>




    </div>
    </div>
  </div>



<div id="askModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Stop Promotions</h4>
      </div>
      <div class="modal-body" style="padding: 0px;">
        <p> Are you sure you want to stop promotions on this post?</p>
         <br> <br> 

         <div id="am">

         </div>
    
            <div class="cl"> </div>
      </div>
     
    </div>

  </div>
</div>


<div id="askstartModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Start Promotions</h4>
      </div>
      <div class="modal-body">
        <p> Are you sure you want to start promotions on this post?</p>
         <br> <br> 

         <div id="asm">

         </div>
        

            <br> <br> 

            <div class="cl"> </div>
      </div>
     
    </div>

  </div>
</div>


<div id="stopModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Stop Promotions</h4>
      </div>
      <div class="modal-body">
        <p id="stopMsg"></p>
      </div>
     
    </div>

  </div>
</div>

<div id="askstartModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Start Promotions</h4>
      </div>
      <div class="modal-body">
        <p id="startMsg"></p>
      </div>
     
    </div>

  </div>
</div>

<span id="delete_post">
  
<div class="modal" data-backdrop="true" id="deleteModal" role="dialog ">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title">&nbsp;&nbsp; Delete Post</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
         
            <p class="" style="padding: 20px 0px;">   
            &nbsp;&nbsp; Are You sure you want to delete post? </p>
        
            <a href="#" value="yes" id="del_y" class="mbtn-left btn-gray"> Yes </a><a  href="#" value="no" id="del_n" class="mbtn-right"> No </a>
          
        </div>
        
      </div>
      
    </div>
  </div>

</span>

<div id="promotersModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> &nbsp;&nbsp;&nbsp;  Promoters </h4>
      </div>
      <div class="modal-body">
            <div id="promoterList"></div>
      </div>
    
    </div>

  </div>
</div>


  <div class="modal fade" id="working" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title ttl">  </h4>
        </div>
        <div class="modal-body">
          <p id="bdy"> </p>
        </div>
      
      </div>
      
    </div>
  </div>

 <?php //include("includes/footer.php"); ?>

<style type="text/css">
  
  
table{
  border: 1px solid #ccc;
  box-shadow: 1px 1px 1px #ccc;
  width: 100%;
}

table td,th{
    border: 1px solid #ccc;
    padding-left: 10px;
    padding-right: 10px;
    font-size: 13px;
}

.trow:nth-child(even){
   background-color: #f9f9f9;
   height: 54px;
   
  
}
.trow:nth-child(odd){
    height: 54px;
}

 /*span {
    display: inline-block;
    height:100%;
    box-sizing: border-box;
    float: left;
    color: #000;
    font-weight: bold;
    font-family: arial, sans-serif;
    font-size: 9px;

  }*/

  .bar-1 {
    background: #F7B334;
  }

  .bar-2 {
    background: #A7A9AC;
  }

  .bar-3 {
    background: #D57E00;
  }
  
.boxx{
  background: #fff;height: 220px;border: 1px solid #eee; box-shadow: 3px 3px 3px #f5f5f5;
}

.paging-nav {
  text-align: right;
  padding-top: 2px;
}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}




</style>



 </body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/paging.js"></script> 
<script type="text/javascript">
  
  


function ask(pid){

      $("#deleteModal").modal('show');  
      $("#del_y").click(function(){
            $.ajax({
          url: '<?php echo base_url() ?>Feeds/delete_post/'+pid,
          type: 'POST', 
          cache: false,
          contentType: false,
          processData: false,
          success: function(response){
              if(response==1)
              {
                 window.location="<?php echo base_url(); ?>dashboard/";
              }
            else{
               console.log(response);
              // e.preventDefault();
            }
          }
    });
});
    
       $("#del_n").click(function(){
            $("#deleteModal").modal('hide');  
       });
   
  
}

function askPromotion(id){
    $("#askModal").modal('show');
    $("#am").html(' <button class="mbtn-left"  onclick="stopPromotion('+id+')" > Yes </button>  <button class="mbtn-right"  data-dismiss="modal" > No </button>         ');
}


function askstartPromotion(id){
    $("#askstartModal").modal('show');
    $("#asm").html(' <button class="btn btn-danger" style="width: 10%; float: right;" data-dismiss="modal" > No </button>          <button class="btn btn-success" onclick="startPromotion('+id+')" style="width: 10%; float: right; margin-right: 15px;"> Yes </button> ');
}

function stopPromotion(id){
     $("#askModal").modal('hide');
    $.ajax({
    url: "<?php echo base_url(); ?>Feeds/stopPromotion/",
    type: "Post",
    data: {id: id},
    success: function(response){
        $("#stopModal").modal('show');
        $("#stopMsg").html("Done");
        $("#start").html("Start Promotion")
        $("#start").attr("onclick", "askstartPromotion("+id+");return false;");
    }

  })
  
}

function startPromotion(id){
     $("#askstartModal").modal('hide');
    $.ajax({
    url: "<?php echo base_url(); ?>Feeds/startPromotion/",
    type: "Post",
    data: {id: id},
    success: function(response){
        $("#startModal").modal('show');
        $("#startMsg").html("Done");
         $("#start").html("Stop Promotion")
        $("#start").attr("onclick", "askPromotion("+id+");return false;");
    }

  })
  
}

  $(document).ready(function() {

   
    $('#tableData1').paging({limit:5});
    $('#tableData2').paging({limit:5});
    $('#tableData3').paging({limit:5});
    $('#tableData4').paging({limit:5});
    $('#tableData5').paging({limit:5});
    $('#tableData6').paging({limit:5});
    $('#tableData7').paging({limit:5});
    $('#tableData8').paging({limit:5});
    $('#tableData9').paging({limit:5});
    $('#tableData10').paging({limit:5});  
   

});

</script>
  


<script>
var ctx = document.getElementById("myChart11");
var ctx1 = document.getElementById("myChart12");
var ctx2 = document.getElementById("myChart13");
var ctx4 = document.getElementById("myChart14");


var ctxpr = document.getElementById("myChartpr");

var month=new Array();
var earn=new Array();

var spmonth=new Array();
var spend=new Array();

var monthP=new Array();
var earnP=new Array();

var monthV=new Array();
var earnV=new Array();

var week=new Array();
var wEarn=new Array();

var lineM=new Array();
var lineE=new Array();

var viewW=new Array();
var viewEa=new Array();

var viewM=new Array();
var viewE=new Array();

var dailyV=new Array();
var dailyVE=new Array();

var dailyP=new Array();
var dailyPE=new Array();


var monthCom=new Array();
var earnCom=new Array();
var mwise=<?php echo $monthWiseEarning; ?>;
var mspend=<?php echo $monthWisePromoSpend; ?>;
var mwisep=<?php echo $monthWisePromo; ?>;
var ComissionEarn=<?php echo $monthlyComission; ?>;
var mwisev=<?php echo $monthWiseView; ?>;
var weaklyP=<?php echo $weeklyPromo; ?>;
var monthlyPromo=<?php echo $monthlyPromo; ?>;
var weeklyViewE=<?php echo $weeklyViewE; ?>;
var monthlyViewE=<?php echo $monthlyViewE; ?>;
var dailyPromo=<?php echo $dailyPromo; ?>;
var dailyView=<?php echo $dailyView; ?>;
for(i=0; i<mwise.length; i++)
  {
    month[i]=mwise[i].month;
    earn[i]=mwise[i].sum;
  }

for(i=0; i<mspend.length; i++)
  {
    spmonth[i]=mspend[i].month;
    spend[i]=mspend[i].sum;
  }

for(i=0; i<mwisep.length; i++)
  {
  
    monthP[i]=mwisep[i].month;
    earnP[i]=mwisep[i].sum;
  }

for(i=0; i<mwisev.length; i++)
  {
    monthV[i]=mwisev[i].month;
    earnV[i]=mwisev[i].sum;
  }

   for(i=0; i<weaklyP.length; i++) 
  {
    week[i]=weaklyP[i].week;
    wEarn[i]=weaklyP[i].sum;
  }

   for(i=0; i<monthlyPromo.length; i++) 
  {
    lineM[i]=monthlyPromo[i].month;
    lineE[i]=monthlyPromo[i].sum;
  }

   for(i=0; i<weeklyViewE.length; i++) 
  {
    viewW[i]=weeklyViewE[i].week;
    viewEa[i]=weeklyViewE[i].sum;
  }

   for(i=0; i<monthlyViewE.length; i++) 
  {
    viewM[i]=monthlyViewE[i].month;
    viewE[i]=monthlyViewE[i].sum;
  }

   for(i=0; i<dailyView.length; i++) 
  {
    dailyV[i]=dailyView[i].hour;
    dailyVE[i]=dailyView[i].sum;
  }


   for(i=0; i<dailyPromo.length; i++) 
  {
    dailyP[i]=dailyPromo[i].hour;
    dailyPE[i]=dailyPromo[i].sum;
  }


   for(i=0; i<ComissionEarn.length; i++) 
  {
    monthCom[i]=ComissionEarn[i].hour;
    earnCom[i]=ComissionEarn[i].sum;
  }








if(dailyPromo.length > 0){ 
var myLineChart = new Chart(ctx, {
    type: 'line',
  data: {
    labels: dailyP,
    datasets: [{ 
        data: dailyPE ,
        label: "INR",
        borderColor: "#3e95cd",
        fill: false
      } 
    ]
  },
  options: {
    title: {
      display: true,
    
    }
  }

});
}


if(weaklyP.length > 0){

var myLineChart = new Chart(ctx1, {
    type: 'line',
  data: {
    labels: week,
    datasets: [{ 
        data: wEarn,
        label: "INR",
        borderColor: "#3e95cd",
        fill: false
      } 
    ]
  },
  options: {
    title: {
      display: true,
     
    }
  }

});
}

if(monthlyPromo.length > 0) { 

var myLineChart = new Chart(ctx2, {
    type: 'line',
  data: {
    labels: lineM,
    datasets: [{ 
        data: lineE,
        label: "INR",
        borderColor: "#3e95cd",
        fill: false
      } 
    ]
  },
  options: {
    title: {
      display: true,
    
    }
  }

});

}

var myLineChart = new Chart(ctx4, {
    type: 'line',
   data: {
        labels: month,
        datasets: [{
            label: 'INR',
            data: earn,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
               
            ],
            borderColor: [
                'rgba(255,99,132,1)'
               
            ],
            borderWidth: 1
        }]
    },
  options: {
    title: {
      display: true,
    
    }
  }

});




var myLineChart = new Chart(ctxpr, {
    type: 'line',
   data: {
        labels: spmonth,
        datasets: [{
            label: 'INR',
            data: spend,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
               
            ],
            borderColor: [
                'rgba(255,99,132,1)'
               
            ],
            borderWidth: 1
        }]
    },
  options: {
    title: {
      display: true,
    
    }
  }

});


if(ComissionEarn.length > 0) {
var myLineChart = new Chart(ctx7, {
    type: 'line',
   data: {
        labels: monthCom,
        datasets: [{
            label: 'INR',
            data: earnCom,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
               
            ],
            borderColor: [
                'rgba(255,99,132,1)'
               
            ],
            borderWidth: 1
        }]
    },
  options: {
    title: {
      display: true,
    
    }
  }



});

}





  function promoters(id){
      $("#promotersModal").modal('show');
      $.ajax({
        url: "<?php echo base_url(); ?>Feeds/getPromotersList",
        type: "post",
        data: {id: id},
        success: function(response){
          $("#promoterList").html(response);
        }
      });

  }

</script>

<script type="text/javascript">
  
  function working(argument) {
    if(argument==1){
    $(".ttl").html(" Earning Report");
    }

    if(argument==2){
    $(".ttl").html(" Promotion");
    }
    if(argument==3){
    $(".ttl").html(" Truevl Donation");
    }
     if(argument==4){
    $(".ttl").html(" Payments");
    }
    $("#bdy").html("This feature will be launched soon, We are currently working on this. Stay tuned!");
    $("#working").modal("show");
  }

</script>