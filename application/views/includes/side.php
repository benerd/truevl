 
<div style="position: fixed;border: 1px solid #ccc; width: 198px;"> 
<div style="background: #fff;padding-bottom: 6px; ">
<div style="width: 85%; margin: auto;">
<img class="circle" src="<?php echo $x->profile_pic; ?>" height="142" width="142"  > 

<br>
<a href="<?php echo base_url(); ?>Users/profile" class="  userName" style="padding-top: 5px;display: block;text-align: center;"> <?php echo $x->name; ?> </a>
</div>

<div id="iconL">
  <ul>
  <li> <span class="iconr"> <img class="imgI" src="<?php echo base_url(); ?>assets/img/dash.png"  > </span> <span class="textl"> <a class="samller" href="<?php echo base_url(); ?>dashboard">  Dashboard  </a></span> </li>

<li> <span class="iconr"> <img class="imgI" src="<?php echo base_url(); ?>assets/img/Myprofile.png"  > </span> <span class="textl"> <a class=" samller" href="<?php echo base_url(); ?>Users/profile">  Profile  </a></span> </li>

 <li> <span class="iconr"> <img class="imgI" src="<?php echo base_url(); ?>assets/img/CreatePost.jpg"  > </span> <span class="textl"> <a class=" samller" href="<?php echo base_url(); ?>post/write_article/" > Create Post  </a></span> </li>

<li> <span class="iconr"> <img class="imgI" src="<?php echo base_url(); ?>assets/img/Createcomment.png"  > </span> <span class="textl"> <a class=" samller" href="#"  data-toggle="modal" data-target="#statusModal"> Update status  </a></span> </li>  

<li>        

 <span class="iconr"> <img class="imgI" src="<?php echo base_url(); ?>assets/img/promo.png"  >  </span> <span class="textl"> 

  <!-- <a class="not-allowed samller" href="<?php //echo base_url();?>promo_request" > Promo Notification </a> -->

  <a class="not-allowed samller" href="#" onclick="working(1);return false;" > Promo Notification </a>

  <span id="promoCount"> <small>  </small>  </span> </span> </li>  

 <li> <span class="iconr"> 
      <img class="imgI" src="<?php echo base_url(); ?>assets/img/bidr.png"  >
    </span> <span class="textl">

   <!--  <a class="not-allowed samller" href="<?php //echo base_url();?>bid_requests" > Bid Requests  </a> -->

    <a class="not-allowed samller" href="#" onclick="working(2);return false;" > Bid Requests  </a>

</span> 
      <span id="bidCount"> <small>  </small>  </span> 
</li>

<li> <span class="iconr"> <img class="imgI" src="<?php echo base_url(); ?>assets/img/messn.png"  > </span> <span class="textl"> <a class="samller" href="<?php echo base_url(); ?>Send/messengerp"  > Messenger </a></span> </li>

<li> <span class="iconr"> <img class="imgI" src="<?php echo base_url(); ?>assets/img/wallet.png"  > </span> <span class="textl"> <a class="not-allowed samller" href="#"  onclick="working(3);return false;"  > Wallet </a></span> </li>

</ul> 
</div>

<div class="cl"> </div>

</div>
<div id="ftr">
  <div style="margin:auto;width: 90%; padding: 6px 0px;">
  <a href="<?php echo base_url(); ?>Privacy"> Privacy </a>
   <a href="<?php echo base_url(); ?>Cookies"> Cookies </a> 
  <a href="<?php echo base_url(); ?>Help"> Help </a>
 <a href="<?php echo base_url(); ?>Terms"> Terms </a> <!-- <a href="<?php //echo base_url() ?>Advertisements">  Advertisements </a> -->
<br>
 <a href=""> &copy; 2018 truevl </a>
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



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
	
	function working(argument) {
	  if(argument==1){
		$(".ttl").html(" Promo Requests");
		}

	  if(argument==2){
		$(".ttl").html(" Bid Requests");
		}
    if(argument==3){
    $(".ttl").html(" Wallet ");
    }
		$("#bdy").html("This feature will be launched soon, We are currently working on this. Stay tuned!");
		$("#working").modal("show");
	}

</script>