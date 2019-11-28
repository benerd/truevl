<style type="text/css">
.parent {
  position: relative;
  top: 0;
  left: 0;
}
.image1 { 
  position: relative;
  top: 0;
  left: 0;
}
.image2 {
  position: absolute;
  top: 80px;
  left: 170px;  
}
 
.post-opt{
  display: none;
  position: absolute;
  left: 64%;
  border: 1px solid #ccc;
  border-radius: 3px;
  width: 150px;
  top:9%;
  background: #f5f5f5;
  z-index: 10;
}

 
.post-opt ul li{
   padding-top: 5px;
  padding-bottom: 5px;
  /*padding-left: 10px;*/
  border-bottom: 1px solid #000;
   color: #000;
}

.post-opt ul li:hover{
  background: #0093DD;
  color: #fff;

}
.post-opt ul li a{
  width: 100%;
  color: #000;
  font-size: 12px;
  line-height:16px; 
  font-weight: none;

}

.post-opt ul li a:hover{
  color: #fff;
}

.dott{
  cursor: pointer;
}

.lie{
  padding: 1px 5px;
 
  
}

.lio{
    padding: 1px 5px;
    background: #DDDDDC;
    
  
}

table{
  border: 1px solid #ccc;
}

table th{
  text-align: left;
  padding-left: 3px;
  color: rgba(0,0,0,0.6);
}

table td{
  vertical-align: middle;
  height: 40px;
  color: rgba(0,0,0,0.6);
  padding-left: 3px;
}

</style>


<br clear="all"> 
<div id="content_wrapper" style="margin-top: 20px;">
<div id="inner">

<div id="Tleft"> 

<?php
foreach ($userData as $x ) {

  include("includes/side.php");
   } ?>

 </div>
<div id="Tcenter" style="width: 710px;margin-top: 5px; background: #fff;min-height: 600px;"> 
  <br>
<div id="all_rows" style="width: 95%;margin: auto;"> 
<?php
if($not){ ?>
  
    <table border="1" width="100%">  
      <tr> 
        <th> Post Title  </th>
        <th> Publisher </th>
        <th> Promo Amount </th>
        <th> Action </th>

      </tr>
<?php
  $allRequest=array();
      $allBidPrice=array();
      $AllPromo=array();
          $AllStatus=array();
      foreach ($not as $key => $value) {
          $pid=$value["post_id"];
          $AllPromo=$this->User_model->getAllBids($pid, $userId);
          $uid1=$AllPromo["request_to"];
          $uid2=$AllPromo["request_from"];
          $pdata=$this->Feed_model->landingPost($pid);
          $post_title=$pdata[0]->post_title;
          $request_from=$AllPromo["request_from"];
          $udata=$this->User_model->getUdata($request_from);
          $img=$pdata[0]->img;
          $url=base_url()."Feeds/landing/".$post_title."/".$pid; 
          $url= preg_replace('/\s+/', '-', $url);
          $url=str_replace("?","q", $url);
          $url=str_replace("!","e", $url);
          $url=str_replace("#","h", $url);
        ?>

        <tr>
          <td width="45%;"> <img src="<?php echo $img; ?>" height="32px" width="32px" valign="middle"> <?php echo mb_substr($pdata[0]->post_title, 0,40); ?> </td>
          <td width="20%;"> <?php echo $udata[0]->name; ?>  </td>
          <td width="15%;"> <?php echo $AllPromo["bid_price"]; ?> </td>
          <td width="20%;"> <a href="#" style="padding: 0px 3px;" class="apb<?php echo $key; ?> btn-success" onclick="acceptPromoBtn(<?php echo $pdata[0]->user_id; ?>, <?php echo $pdata[0]->post_id; ?>, <?php echo $AllPromo["bid_price"]; ?>, <?php echo $key; ?> )"> Accept </a>  </a> </td>
        </tr>

      <?php }
    }



      else{ 
      ?>

      <div class="" style="box-shadow: none; width: 90%;margin-left: 2.5%;margin-top: 120px;">
           <h3 style="color: #CCE8F9; font-size: 24px;text-align: center;">  

              <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="108.000000pt" height="108.000000pt" viewBox="0 0 757.000000 729.000000"
 preserveAspectRatio="xMidYMid meet">
<metadata>

</metadata>
<g transform="translate(0.000000,729.000000) scale(0.100000,-0.100000)"
fill="#CCE8F9" stroke="none">
<path d="M3445 6759 c-1403 -134 -2553 -1206 -2809 -2619 -39 -214 -50 -348
-49 -600 0 -309 24 -506 98 -800 137 -545 417 -1045 814 -1452 79 -81 175
-173 213 -205 81 -66 66 -71 145 55 l46 73 -49 41 c-88 74 -298 291 -380 393
-236 293 -431 662 -539 1019 -194 643 -172 1336 62 1960 335 892 1065 1568
1966 1820 130 37 273 66 427 87 125 18 542 18 680 1 315 -40 623 -130 912
-269 65 -31 121 -53 125 -50 22 22 111 173 105 179 -4 4 -58 32 -121 63 -336
166 -719 272 -1096 305 -140 11 -421 11 -550 -1z"/>
<path d="M5075 5957 c-98 -155 -202 -318 -231 -362 -28 -44 -123 -192 -211
-330 -621 -971 -760 -1188 -798 -1245 -23 -36 -116 -180 -205 -320 -90 -140
-182 -284 -205 -320 -23 -36 -171 -267 -330 -515 -158 -247 -306 -479 -330
-515 -23 -36 -99 -155 -170 -265 -70 -110 -142 -222 -160 -250 -18 -27 -86
-133 -151 -235 -65 -102 -163 -255 -217 -340 -55 -85 -115 -179 -133 -208
l-34 -52 62 -40 c49 -31 65 -37 74 -27 6 7 116 176 244 377 129 201 257 401
285 445 28 44 121 188 205 320 84 132 214 335 288 450 75 116 206 320 292 455
86 135 342 535 570 890 227 355 505 789 618 965 112 176 224 349 247 385 23
36 115 180 205 320 89 140 177 278 195 305 77 118 162 253 183 287 l23 36 -60
36 c-32 20 -63 36 -67 35 -5 0 -90 -127 -189 -282z"/>
<path d="M5480 6098 c-58 -89 -60 -94 -42 -108 11 -8 57 -44 103 -80 104 -81
330 -304 431 -426 249 -301 439 -658 557 -1041 155 -505 173 -1074 50 -1593
-208 -879 -785 -1608 -1584 -2000 -315 -155 -625 -244 -973 -281 -176 -18
-585 -7 -742 21 -361 63 -689 179 -974 344 -54 32 -99 56 -101 54 -13 -16
-115 -181 -113 -183 12 -12 177 -105 258 -145 326 -164 687 -269 1070 -311
245 -27 613 -12 880 37 1014 185 1902 902 2315 1870 119 277 199 569 240 874
22 160 30 524 16 690 -80 930 -530 1756 -1264 2319 l-67 52 -60 -93z"/>
<path d="M4845 4545 c-16 -7 -52 -24 -80 -36 -168 -74 -183 -84 -149 -102 34
-18 140 -131 179 -192 61 -95 97 -169 152 -310 9 -22 21 -53 28 -70 7 -16 18
-46 25 -65 6 -19 16 -44 20 -55 5 -11 18 -49 30 -85 12 -36 26 -68 32 -71 10
-7 46 2 93 21 11 4 49 16 85 25 36 10 71 19 79 21 10 3 12 15 7 46 -4 23 -10
47 -14 53 -4 5 -14 28 -21 50 -13 38 -25 68 -57 143 -8 18 -14 39 -14 47 0 8
-4 15 -10 15 -5 0 -10 8 -10 17 0 23 -180 383 -191 383 -5 0 -9 5 -9 10 0 22
-120 170 -137 170 -4 0 -21 -7 -38 -15z"/>
<path d="M3538 4482 c-26 -10 -50 -20 -54 -24 -4 -5 -17 -8 -29 -8 -11 0 -25
-4 -30 -8 -6 -4 -37 -16 -70 -27 -33 -10 -64 -22 -70 -25 -5 -3 -38 -15 -73
-26 -62 -18 -119 -57 -233 -158 -34 -30 -45 -35 -47 -22 -3 12 -16 16 -55 16
-28 0 -84 9 -125 21 -40 11 -80 18 -87 15 -12 -4 -38 -80 -65 -186 -6 -25 -16
-61 -20 -80 -5 -19 -14 -60 -21 -90 -6 -30 -15 -71 -19 -90 -4 -19 -17 -80
-28 -135 -11 -55 -23 -113 -26 -130 -4 -16 -13 -63 -20 -103 -12 -70 -12 -74
8 -93 17 -16 186 -143 265 -199 25 -18 25 -19 2 -49 l-19 -25 5 25 c4 20 -3
31 -29 51 -18 14 -42 34 -53 45 -39 36 -125 85 -140 79 -8 -3 -15 -16 -15 -29
0 -13 -5 -38 -11 -55 -12 -35 1 -93 29 -125 42 -48 116 -60 170 -27 35 22 36
20 23 -27 -18 -64 36 -152 105 -169 34 -9 101 23 120 55 14 26 14 25 8 -11 -3
-21 -2 -38 3 -38 10 0 143 205 143 221 0 5 -9 9 -20 9 -23 0 -70 -45 -70 -66
0 -7 -4 -15 -9 -18 -5 -3 -6 15 -3 41 5 51 -14 99 -49 121 -30 19 -111 32
-131 21 -10 -5 -18 -6 -18 -1 0 17 54 37 97 35 58 -2 105 -37 123 -92 13 -41
13 -41 54 -35 23 4 44 9 48 13 14 12 588 913 588 922 0 5 -32 30 -71 55 -65
42 -76 46 -137 47 -37 0 -74 -3 -82 -8 -21 -14 -112 -44 -130 -44 -35 0 70 40
170 65 l108 27 78 -52 c53 -36 82 -51 91 -45 7 5 70 97 139 204 l125 195 -38
8 c-216 45 -335 53 -405 29z"/>
<path d="M4533 4389 c-6 -6 -45 -13 -87 -16 -44 -3 -81 -11 -87 -19 -6 -7 -84
-129 -175 -270 l-164 -256 23 -18 c12 -9 114 -78 227 -153 199 -132 224 -153
334 -282 15 -16 29 -38 32 -47 3 -10 11 -18 18 -18 7 0 61 46 120 102 74 69
128 112 171 133 76 37 98 54 87 69 -4 6 -16 36 -26 66 -10 30 -23 59 -27 65
-5 5 -9 15 -9 22 0 16 -76 184 -147 328 -108 214 -238 346 -290 294z"/>
<path d="M2268 4291 c-16 -49 -28 -95 -28 -103 0 -8 -4 -18 -8 -23 -5 -6 -17
-39 -26 -75 -10 -36 -22 -74 -26 -85 -7 -19 -16 -47 -72 -240 -11 -38 -24 -79
-29 -90 -4 -11 -16 -47 -25 -80 -9 -33 -23 -79 -31 -103 -7 -23 -13 -53 -13
-66 0 -22 5 -25 63 -31 34 -4 76 -11 92 -15 52 -15 233 -42 243 -36 5 3 12 40
16 83 4 43 11 92 16 108 5 17 16 66 25 110 9 44 20 91 25 105 4 14 16 61 25
105 10 44 21 89 26 100 4 11 10 31 13 45 11 51 33 135 38 150 14 37 30 109 26
125 -2 12 -41 29 -136 61 -188 62 -181 63 -214 -45z"/>
<path d="M3872 3598 c-71 -112 -217 -341 -326 -509 -129 -202 -194 -312 -190
-323 4 -11 2 -15 -7 -11 -9 3 -32 -24 -67 -77 l-52 -83 22 -19 c19 -15 33 -17
90 -12 36 3 88 15 115 27 l48 21 -45 38 c-25 22 -39 40 -32 40 6 0 12 -4 12
-8 0 -4 15 -16 33 -27 17 -10 41 -27 52 -37 27 -26 54 -31 131 -26 54 3 69 8
89 31 14 14 25 31 25 37 0 13 -42 54 -95 95 -22 16 -46 35 -53 42 -8 7 -23 18
-34 24 -11 6 -17 13 -14 16 5 5 40 -18 96 -64 8 -6 49 -38 90 -70 74 -57 76
-57 138 -56 51 1 68 5 97 27 67 51 59 84 -48 195 -37 39 -64 71 -60 71 5 0 42
-32 83 -70 78 -72 112 -87 174 -77 82 13 146 98 146 193 0 53 -16 89 -79 169
l-46 60 80 -58 c139 -100 173 -117 236 -117 51 0 59 3 92 37 79 78 75 201 -8
302 -60 74 -113 124 -173 163 -37 23 -71 46 -77 51 -5 4 -71 48 -145 97 -74
49 -140 93 -147 99 -7 6 -14 11 -17 11 -2 0 -62 -91 -134 -202z"/>
</g>
</svg>

<br>

           No Bid requests </h3>
          </div>
          <br>
          <br>
          <br>

      <?php
    }
?>
</div>
</div>
 
  

  
<!-- <edit status modal> -->





</div>

</div>
<div class="cl"> </div>

</div>

 <?php //include("includes/footer.php"); ?>

 
 
 </div>
</body>
</html>





<script type="text/javascript">
	
	


   function acceptPromoBtn(uid, pid, bidPrice, i){
           
            $("#acceptPromoModal").modal('show');
            $("#promoModal").modal('hide');
            $("#acceptPromoMsg").html("<div> <br> &nbsp;&nbsp;This post will be published on your Feeds.  </div> <div> <br> <input type='button'  value='Yes' class='mbtn-left btn-gray' onclick='acceptPromoReq("+pid+", "+uid+","+bidPrice+", "+i+")' style='width: 49.80%;' ><input type='button' class='mbtn-right btn-gray' value='No' style='width: 49.80%;' class='btn-danger' class='close' data-dismiss='modal'> </div>"); 
        }

function acceptPromoReq(pid, uid, bidPrice, i){
       
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/acceptBidPrice",
      data: {pid: pid, uid: uid, bidPrice: bidPrice},
      type: "post",
      success: function(response){
      
          // $("#acceptPromoModal").modal('hide');
           $("#acceptPromoModal").modal('hide');
              $(".apb"+i).attr("onclick", "");
              $(".apb"+i).html("Accepted");
              $(".apb"+i).css({"background":"#ccc", "width": "40%"});
          if(response==101){
              $("#acceptPromoModal").modal('hide');
              $(".apb"+i).attr("onclick", "");
              $(".apb"+i).val("Accepted");
              $(".apb"+i).css({"background":"#ccc", "width": "40%"});
          }

          else if(response==2){
            $("#acceptPromoMsg").html("Request time out");
          }

      }

    });
}


</script>