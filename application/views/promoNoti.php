<style type="text/css">
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
<div id="Tcenter" style="width: 930px;margin-top: 2px; background: #fff;padding:20px 0px;height: 100%;"> 
<div id="all_rows"> 
<?php
if($not){

      $allRequest=array();
      $allBidPrice=array();
      $AllPromo=array();
      $AllStatus=array();
      foreach ($not as $key => $value) {
        $pid=$value["post_id"];
        $getAllPromo=$this->User_model->getAllPromo($pid, $userId);

        foreach ($getAllPromo as $k => $AllPromo) {
        $uid1=$AllPromo["request_to"];
        $pid=$AllPromo["post_id"];
        $pdata=$this->Feed_model->landingPost($pid);
        $post_title=$pdata[0]->post_title;
        $img=$pdata[0]->img;
        $url=base_url()."Feeds/landing/".$post_title."/".$pid; 
        $url= preg_replace('/\s+/', '-', $url);
        $url=str_replace("?","q", $url);
        $url=str_replace("!","e", $url);
        $url=str_replace("#","h", $url);
        $notiTime=new DateTime($pdata[0]->posted_on);
        $date = $notiTime->format('Y-m-d');
        
        array_push($allRequest,$AllPromo["request_from"]);
        array_push($allBidPrice, $AllPromo["bid_price"]);
        array_push($AllStatus, $AllPromo["status"]);
        $Request=json_encode($allRequest);
        $BidPrice=json_encode($allBidPrice);
        $status=json_encode($AllStatus);
        $totalBids=count(json_decode($Request));
        }
        ?>

        <?php $param=$key."_".$k; ?>
        <div class="post" style="box-shadow: none; width: 92%;margin-left: 2.5%;">
           <div class="post_title">
               <div style="width: 100%; float: left;">  
                <div style="width: 85%; float: left;"> 
                <a class="blue userName " href="<?php echo $url; ?>">

                 <?php echo $post_title; ?>  </a> 
                 <div style="margin-top: 12px;">
                 <small>  Posted on: <?php echo $date  ?>  </small> <br>
                 <strong> <small> Bid Requests: <?php echo $totalBids; ?> </small> </strong>
                 </div>
                  <br>
                 
               
                
                 </div> 

                 <div style="width: 15%; float: left;">
                   <img src="<?php echo $img; ?> " style="width: 60px; height: 60px;" > <br>
                     <a href="#" onclick='see(<?php echo $pid; ?>, <?php echo $Request; ?>, <?php echo $BidPrice; ?>, <?php echo $status; ?>, "<?php echo $param; ?>")'> See details </a>
                 </div>

              </div>
            </div>
              <div id="promoters_data<?php echo $param; ?>" style="width: 100%; float: left;" >
                


              </div>

              <div class="cl"> </div>
        </div>  
        <?php 
        $allRequest=array();  
        $allBidPrice=array();
        $AllStatus=array();
      }
      }

      else{
        ?>

          <div  style="box-shadow: none; width: 90%;margin-left: 2.5%;margin-top: 120px;">
           <h3 style="color: #CCE8F9; font-size: 24px;text-align: center;"> 

            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="108.000000pt" height="108.000000pt" viewBox="0 0 771.000000 725.000000"
 preserveAspectRatio="xMidYMid meet">
<metadata>

</metadata>
<g transform="translate(0.000000,725.000000) scale(0.100000,-0.100000)"
fill="#CCE8F9" stroke="none">
<path d="M3645 6850 c-575 -33 -1137 -229 -1610 -563 -221 -155 -487 -406
-646 -607 -399 -503 -624 -1049 -701 -1695 -16 -139 -16 -566 1 -700 78 -635
299 -1177 677 -1665 119 -153 493 -528 508 -509 1 2 29 44 60 93 l58 89 -64
55 c-98 85 -272 265 -359 373 -542 669 -772 1530 -639 2394 185 1204 1096
2190 2261 2449 205 45 315 58 556 63 497 12 879 -69 1327 -281 66 -31 120 -55
121 -54 1 2 22 35 47 73 78 122 86 102 -70 178 -171 83 -186 89 -360 148 -375
127 -770 181 -1167 159z"/>
<path d="M5312 6271 c-28 -43 -124 -193 -213 -332 -89 -140 -223 -348 -297
-464 -75 -115 -202 -313 -282 -440 -81 -126 -215 -336 -298 -465 -83 -129
-227 -354 -320 -500 -272 -424 -781 -1219 -827 -1290 -23 -36 -115 -180 -205
-320 -90 -140 -182 -284 -205 -320 -23 -36 -171 -267 -329 -515 -158 -247
-301 -469 -318 -493 -17 -24 -28 -45 -26 -47 2 -3 32 -22 65 -44 l61 -39 273
426 c305 478 700 1093 764 1192 23 36 171 268 330 515 158 248 302 473 320
500 31 48 443 690 795 1240 91 143 305 477 476 742 373 583 414 647 414 653 0
6 -113 80 -122 80 -3 0 -28 -36 -56 -79z"/>
<path d="M5569 6183 c-30 -49 -54 -91 -54 -94 0 -4 42 -39 94 -80 182 -140
424 -391 563 -585 260 -362 440 -779 522 -1209 42 -220 51 -326 50 -585 0
-177 -5 -281 -18 -375 -81 -596 -294 -1090 -669 -1555 -34 -41 -124 -138 -202
-215 -448 -446 -990 -719 -1618 -817 -191 -29 -616 -32 -802 -4 -376 55 -706
167 -1028 348 -61 34 -112 57 -117 52 -4 -5 -30 -46 -58 -91 -38 -61 -48 -84
-39 -91 27 -23 213 -123 314 -170 404 -188 782 -277 1223 -289 513 -14 971 82
1425 297 325 155 598 350 875 629 254 255 438 508 588 806 333 665 431 1396
286 2136 -147 754 -600 1477 -1215 1937 -31 23 -58 42 -61 42 -3 0 -29 -39
-59 -87z"/>
<path d="M3526 5144 c-76 -39 -123 -91 -165 -184 -8 -18 -12 -232 -14 -735
l-2 -710 -62 83 c-35 46 -63 85 -63 88 0 16 -94 95 -139 118 -78 37 -187 37
-265 0 -65 -31 -139 -106 -166 -170 -27 -61 -28 -195 -2 -246 21 -45 344 -508
354 -508 8 0 85 110 94 134 3 8 -57 102 -140 220 -80 114 -146 213 -146 221 0
8 -4 17 -10 20 -5 3 -10 19 -10 35 0 16 5 32 10 35 6 3 10 14 10 24 0 24 47
66 98 86 39 16 45 16 83 1 46 -19 52 -24 94 -81 17 -22 32 -42 36 -45 3 -3 25
-32 49 -65 24 -33 47 -61 52 -63 4 -2 8 -9 8 -15 0 -7 13 -27 29 -45 l29 -32
95 149 c52 82 102 162 111 179 14 27 16 102 16 628 0 452 3 606 12 633 15 41
59 91 82 91 8 0 18 5 21 10 3 6 21 10 40 10 19 0 37 -4 40 -10 3 -5 14 -10 24
-10 23 0 65 -46 82 -90 10 -26 15 -122 19 -385 l5 -350 78 120 77 120 -2 265
c-3 265 -3 265 -30 320 -31 64 -83 117 -151 154 -42 23 -59 26 -140 26 -78 0
-99 -4 -141 -26z"/>
<path d="M4168 4002 c-21 -32 -38 -65 -38 -73 0 -8 13 -27 29 -42 32 -31 40
-54 49 -142 5 -44 11 -60 22 -60 8 0 16 10 18 22 4 26 68 83 94 83 9 0 20 5
23 10 3 6 24 10 45 10 21 0 42 -4 45 -10 3 -5 14 -10 24 -10 23 0 91 -68 91
-91 0 -10 5 -21 10 -24 6 -3 10 -21 10 -40 0 -64 22 -86 40 -40 10 26 58 61
98 71 22 6 85 -18 109 -41 7 -7 19 -31 28 -53 14 -34 15 -83 12 -358 -3 -175
-9 -341 -15 -369 -11 -53 -34 -120 -45 -131 -4 -4 -7 -14 -7 -22 0 -12 -132
-289 -202 -426 -6 -11 -13 -40 -17 -65 l-6 -46 -465 -2 -465 -3 -30 65 c-16
36 -33 65 -36 65 -4 0 -9 8 -12 18 -8 25 -63 119 -92 157 -14 17 -25 34 -25
36 0 3 -29 49 -64 102 -72 110 -64 110 -132 -2 -26 -44 -35 -66 -26 -69 6 -2
12 -7 12 -11 0 -5 23 -42 50 -84 28 -42 50 -80 50 -86 0 -5 3 -11 8 -13 8 -3
62 -84 62 -93 0 -3 12 -24 27 -48 21 -32 28 -59 32 -117 l6 -75 633 -3 632 -2
0 90 c0 50 4 98 10 108 5 9 16 35 25 57 10 22 25 56 36 75 26 49 149 301 158
325 54 142 55 148 58 565 4 389 2 409 -28 460 -5 8 -12 22 -16 30 -15 32 -51
63 -109 96 -51 28 -71 34 -122 34 -59 0 -63 2 -105 43 -24 24 -69 56 -100 70
-47 23 -69 27 -146 27 l-90 0 -45 45 c-25 25 -51 45 -58 45 -7 0 -30 -26 -50
-58z"/>
</g>
</svg>

<br>


            No Promo requests </h3>
          </div>
          <br>
          <br>
          <br>
          <br><br><br><br><br><br><br><br><br><br><br>
        <?php

      }

?>
</div>
</div>
 
  








</div>

</div>
<div class="cl"> </div>

</div>

 

 
 
 </div>
 <div id="lowBalance" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Low balance</h4>
      </div>
      <div class="modal-body">
        <p id="errmsg">  </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>

<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



<script type="text/javascript">
	
	function see(pid, req, bid, status, key){

		var content="";
		$.ajax({
      url: "<?php echo base_url(); ?>Feeds/getPromoReq/1",
      data: {pid: pid, req: req, bid: bid, status: status},
      type: "post",
      datatype: "json",
      success: function(response){

        response=$.parseJSON(response);

        content='<table class="" border="1" width="100%" > <tr> <th width="35%"> Name </th><th width="10%"> Links </th><th width="10%"> Activity </th><th width="20%"> Bid Rate  </th> <th width="25%">  Set your promotion amount </th> </tr>   '; 
        if(response[0]!=""){

        for(i=0; i<response[0].length; i++){
           

          if(req[i]!=<?php echo $userId; ?>){
            
          }
         
          if(response[2][i]==0 && req[i]!=<?php echo $userId; ?>){
            param=key+"_"+i;
          
           content+="<tr class='div"+param+"' > <td> <img src='<?php echo ?>"+response[0][i][0].profile_pic+"' height='32px' style='width: 32px;' valign='middle' > "+response[0][i][0].name+" </td> <td> "+response[3].link+" </td> <td> "+response[3].activity+" </td> <td> "+response[1][i]+" &nbsp; <a style='margin-right:8px;color: green;' href='#' class='apb"+i+"' onclick=\"(acceptPromoBtn("+response[0][i][0].id+","+pid+","+response[1][i]+", '"+param+"'))\">  Accept </a> | <a href='#' class='apb"+i+"' style='color: red;' onclick=\"(rejectPromoBtn("+response[0][i][0].id+","+pid+","+response[1][i]+", '"+param+"'))\">  Reject </a> </td>  <td> <input type='text' style='height: 16px;border: 1px solid #ccc;width: 60%;' id='bid"+param+"' > <input style='border-radius: none; height: 16px; line-height: 16px;font-size: 11px;border: none;' type='button' value='Submit' class='btn-success sbr"+param+"' onclick=\"(setOwnBid("+response[0][i][0].id+","+pid+", '"+param+"'))\">  </p>  </td> </tr>  ";
          }


    
        }
            $("#promoters_data"+key).html(content);
      }

          else{
             $("#promoters_data"+key).html("<h1 style='color: #ccc;'>  No promotion requests </h1>");
          }
        
        
      }


    });

	}


   function acceptPromoBtn(uid, pid, bidPrice, i){
           
            $("#acceptPromoModal").modal('show');
            $("#promoModal").modal('hide');
            $("#acceptPromoMsg").html("<div> <br> &nbsp;&nbsp;"+bidPrice+" INR will be deducted from your account if &nbsp; &nbsp;click on OK </div> <div> <br>  <input type='button' style='width: 49%;' value='Yes' class='mbtn-left btn-gray ' onclick=\"(acceptPromoReq("+pid+", "+uid+","+bidPrice+", '"+i+"'))\" >  <input type='button' style='width: 49%;' value='No' class='mbtn-right btn-gray '  data-dismiss='modal'>   </div>"); 
        }

  function rejectPromoBtn(uid, pid, bidPrice, i){
          
            $("#acceptPromoModal").modal('show');
            $("#promoModal").modal('hide');
            $("#acceptPromoMsg").html("<div> <br> &nbsp;&nbsp;Are You sure you want to reject </div> <div> <br> <input type='button' style='width: 49.80%;' value='Yes' class='mbtn-left btn-gray' onclick=\"(rejectPromoReq("+pid+", "+uid+","+bidPrice+", '"+i+"'))\" ><input type='button' style='width: 49.80%;'  value='No' class='mbtn-right btn-gray ' data-dismiss='modal'>   </div>"); 
        }



function acceptPromoReq(pid, uid, bidPrice, i){
       $(".div"+i).remove();
           
        $.ajax({
          url: "<?php echo base_url(); ?>Feeds/acceptPromoReq",
          data: {pid: pid, uid: uid, bidPrice: bidPrice},
          type: "post",
          success: function(response){
           
              if(response==3){
                $("#acceptPromoModal").modal('hide');
                $("#lowBalance").modal('show');
                $("#errmsg").html("Sorry! you don't have sufficient balance to buy this promotion request.")
              }

              else if(response==2){
                $("#acceptPromoModal").modal('hide');
                $("#lowBalance").modal('show');
                $("#errmsg").html("You have already accepted this request");
              }

                else{
                $("#acceptPromoModal").modal('hide');
               
                }

          }

        });
}

function rejectPromoReq(pid, uid, bidPrice, i){
      $(".div"+i).remove();
              // $(".apb"+i).val("Rejected");
              //  $(".apb"+i).css({"background":"#ccc", "width": "40%"});
    $.ajax({
      url: "<?php echo base_url(); ?>Feeds/rejectPromoReq",
      data: {pid: pid, uid: uid, bidPrice: bidPrice},
      type: "post",
      success: function(response){
         
          $("#acceptPromoModal").modal('hide');

      }

    });
}



function setOwnBid(uid,pid, key){
  var bid=$("#bid"+key).val();

  $.ajax({
    url: "<?php echo base_url(); ?>Feeds/setOwnBid/",
    type: "post",
    data: {uid: uid, pid: pid, bid: bid},
    success: function(response){
          
        if(response==0){
            $("#lowBalance").modal('show');
            $("#errmsg").html("Sorry! you don't have sufficient balance to send this bid request ");
        }
        if(response==2){
          $(".div"+key).remove();
        }
         if(response==1){
            alert("Bid request already sent");
        }
    }

  });

}





</script>