<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">

*{
  color: #333;

}
.dbox{
  width: 14%;
}  

.icons h3{
  font-size: 14px;
}

table{
  border: 1px solid #ccc;
  box-shadow: 1px 1px 1px #ccc;
  width: 100%;

}

a{
	color: #006097;

}


table td,th{
    border: 1px solid #ccc;
    padding-left: 10px;
    padding-right: 10px;
    font-size: 12px;
}

table tr td > table{
	margin: 0px;
	padding: 0px;
	box-shadow: none;
	border: none;
}

table tr td > table td{
 	border: none;
    padding-left: 0px;
    padding-right: 0px;
    font-size: 12px;
}


.trow:nth-child(even){
   background-color: #f9f9f9;
   height: 54px;
   
  
}
.trow:nth-child(odd){
    height: 54px;
}
</style>
<div id="Tfull" style="margin-left: 17px;margin-top: 47px;"> 

	<div class="dbox">
      <div class="icons orange">

        <h3 class="text-center text-white">
        Registered Users   </h3>
        
      </div>

      <div>
         <br><br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
        <a href="<?php echo base_url(); ?>Admin/users">  <?php echo $getAllUsers; ?> </a>
         </p>  <br>
      </div>

    </div> 

	<div class="dbox">
      <div class="icons orange">

        <h3 class="text-center text-white">
        Verified Users    </h3>
        
      </div>

      <div>
         <br><br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
         <a href="<?php echo base_url(); ?>Admin/users/2"> <?php echo count($getVerifiedUsers); ?></a>
         </p>  <br>
      </div>

    </div> 

      <div class="dbox">
       <div class="icons green">

        <h3 class="text-center text-white">
        Unvarified Users  </h3>
        
      </div>

      <div>
         <br> <br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
         <a href="<?php echo base_url(); ?>Admin/users/3">   <?php echo count($getUnVerifiedUsers); ?> </a>
            </p> <br>
      </div>
        

    </div>

    <div class="dbox">
       <div class="icons green">

        <h3 class="text-center text-white">
        Dead Users  </h3>
        
      </div>

      <div>
         <br> <br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
          <?php echo count($getUnVerifiedUsers); ?>
            </p> <br>
      </div>
        

    </div>

    <div class="dbox">
       <div class="icons green">

        <h3 class="text-center text-white">
        Blocked Users  </h3>
        
      </div>

      <div>
         <br> <br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
       <a href="<?php echo base_url(); ?>Admin/users/4">   <?php echo count($getBlockedUsers); ?> </a>
            </p> <br>
      </div>
        

    </div>

    <div class="cl"> </div>

<?php
  if($f==1) { ?>
  <br>
  <h3> Registered Users </h3>
  <br>
<table>
	<tr> 
		<td> SN </td>
		<td> User Id </td>
		<td> Username </td>
		<td> DOJ </td>
		<td> Email </td>
		<td> Mobile </td>
		<td> Earning </td>
		<td> Operation </td>
	</tr>

	<?php
	$i=1;
		foreach ($getAllUsersData as $key => $value) { ?>
		<tr>
			<td> <?php echo $i; ?> </td>
			<td><?php echo $value->id; ?> </td>
			<td>  <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > <?php echo $value->name; ?> </a> </td>
			<td> <?php echo $value->joining_date; ?> </td>
			<td> <a href="mailto: <?php echo $value->email; ?> "> <?php echo $value->email; ?> </a> </td>
			<td> <a href="tel: <?php echo $value->mobile; ?>"> <?php echo $value->mobile; ?> </td>
			<td> <?php 
          $sum=$value->isum-$value->osum;
      echo number_format($sum,2); ?> </td>
			<td> <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > View </a> | 
       <?php if($value->status==1) { ?>
        <a href="<?php echo base_url(); ?>Admin/blockUser/<?php echo $value->id; ?>/4">  Block </a> 
      <?php } else{ ?>
        <a href="<?php echo base_url(); ?>Admin/unblockUser/<?php echo $value->id; ?>/4">  Unblock </a> 
     <?php  } ?>

        | <a href="#" onclick="sendMsg(<?php echo $value->id; ?>)" >  Send msg </td>	
		</tr>	
	<?php $i++;	}
	?>


</table>
<?php } 

else if($f==2) { ?>
 <br>
  <h3> Verified Users </h3>
  <br>
<table>
  <tr> 
    <td> SN </td>
    <td> User Id </td>
    <td> Username </td>
    <td> DOJ </td>
    <td> Email </td>
    <td> Mobile </td>
    <td> Earning </td>
    <td> Operation </td>
  </tr>

  <?php
  $i=1;
    foreach ($getVerifiedUsers as $key => $value) { ?>
    <tr>
      <td> <?php echo $i; ?> </td>
      <td><?php echo $value->id; ?> </td>
      <td>  <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > <?php echo $value->name; ?> </a> </td>
      <td> <?php echo $value->joining_date; ?> </td>
      <td> <a href="mailto: <?php echo $value->email; ?> "> <?php echo $value->email; ?> </a> </td>
      <td> <a href="tel: <?php echo $value->mobile; ?>"> <?php echo $value->mobile; ?> </td>
      <td> <?php 
          $sum=$value->isum-$value->osum;
      echo number_format($sum,2); ?> </td>
      <td> <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > View </a> | 
       <?php if($value->status==1) { ?>
        <a href="<?php echo base_url(); ?>Admin/blockUser/<?php echo $value->id; ?>/4">  Block </a> 
      <?php } else{ ?>
        <a href="<?php echo base_url(); ?>Admin/unblockUser/<?php echo $value->id; ?>/4">  Unblock </a> 
     <?php  } ?>

        | <a href="#" onclick="sendMsg(<?php echo $value->id; ?>)">  Send msg </td> 
    </tr> 
  <?php $i++; }
  ?>


</table>
<?php }

else if($f==3) { ?>
 <br>
  <h3> Unverified Users </h3>
  <br>
<table>
  <tr> 
    <td> SN </td>
    <td> User Id </td>
    <td> Username </td>
    <td> DOJ </td>
    <td> Email </td>
    <td> Mobile </td>
    <td> Earning </td>
    <td> Operation </td>
  </tr>

  <?php
  $i=1;
    foreach ($getUnVerifiedUsers as $key => $value) { ?>
    <tr>
      <td> <?php echo $i; ?> </td>
      <td><?php echo $value->id; ?> </td>
      <td>  <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > <?php echo $value->name; ?> </a> </td>
      <td> <?php echo $value->joining_date; ?> </td>
      <td> <a href="mailto: <?php echo $value->email; ?> "> <?php echo $value->email; ?> </a> </td>
      <td> <a href="tel: <?php echo $value->mobile; ?>"> <?php echo $value->mobile; ?> </td>
      <td> <?php 
          $sum=$value->isum-$value->osum;
      echo number_format($sum,2); ?> </td>
      <td> <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > View </a> | 
       <?php if($value->status==1) { ?>
        <a href="<?php echo base_url(); ?>Admin/blockUser/<?php echo $value->id; ?>/4">  Block </a> 
      <?php } else{ ?>
        <a href="<?php echo base_url(); ?>Admin/unblockUser/<?php echo $value->id; ?>/4">  Unblock </a> 
     <?php  } ?>

        | <a href="#" onclick="sendMsg(<?php echo $value->id; ?>)">  Send msg </td> 
    </tr> 
  <?php $i++; }
  ?>


</table>
<?php } 

else if($f==4) { ?>
 <br>
  <h3> Blocked Users </h3>
  <br>
<table>
  <tr> 
    <td> SN </td>
    <td> User Id </td>
    <td> Username </td>
    <td> DOJ </td>
    <td> Email </td>
    <td> Mobile </td>
    <td> Earning </td>
    <td> Operation </td>
  </tr>

  <?php
  $i=1;
    foreach ($getBlockedUsers as $key => $value) { ?>
    <tr>
      <td> <?php echo $i; ?> </td>
      <td><?php echo $value->id; ?> </td>
      <td>  <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > <?php echo $value->name; ?> </a> </td>
      <td> <?php echo $value->joining_date; ?> </td>
      <td> <a href="mailto: <?php echo $value->email; ?> "> <?php echo $value->email; ?> </a> </td>
      <td> <a href="tel: <?php echo $value->mobile; ?>"> <?php echo $value->mobile; ?> </td>
      <td> <?php 
          $sum=$value->isum-$value->osum;
      echo number_format($sum,2); ?> </td>
      <td> <a href="<?php echo base_url(); ?>users/author/<?php echo $value->id; ?>" target="_blank" > View </a> | 
       <?php if($value->status==1) { ?>
        <a href="<?php echo base_url(); ?>Admin/blockUser/<?php echo $value->id; ?>/4">  Block </a> 
      <?php } else{ ?>
        <a href="<?php echo base_url(); ?>Admin/unblockUser/<?php echo $value->id; ?>/4">  Unblock </a> 
     <?php  } ?>

        | <a href="#" onclick="sendMsg(<?php echo $value->id; ?>)">  Send msg </td> 
    </tr> 
  <?php $i++; }
  ?>


</table>
<?php } 

 ?>

 

</div>


 


  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 60%;">
        <div class="modal-header" style="padding: 0px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"  >Send Message To User </h4>
        </div>
        <div class="modal-body">
          <p id="mbox"> </p>
        </div>
       
      </div>
      
    </div>
  </div>
  

<script type="text/javascript">
  
  function sendMsg(i){

    $("#mbox").html("<form action='<?php echo base_url(); ?>Admin/sendMsg' method='post'>  <b>Write Message:</b> <br>  <textarea style='width: 100%;' rows='6' name='msg'></textarea><br> <input type='hidden' name='userId' value='"+i+"' > <input type='submit' class='btn-success' style='width: 20%; height: 22px;' >  ");
    $("#myModal").modal("show");
  }

</script>