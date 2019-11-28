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
<br>
<?php if($f==1){ 
?>
<h3> Spams </h3> <?php } ?>

<?php if($f==2){ 
?>
<h3> Reports </h3> <?php } ?>

<?php if($f==3){ 
?>
<h3> Painic </h3> <?php } ?>

<br>

 <div class="tab">
    <button class="tablinks active" onclick="tabs(event, 'home')">Pending Alerts </button>
    <button class="tablinks" onclick="tabs(event, 'Approved')"> Approved  </button>
    <button class="tablinks" onclick="tabs(event, 'Rejected')"> Rejected </button>
    <button class="tablinks" onclick="tabs(event, 'blocked')"> Bocked Users </button>
</div>

<div id="home" class="tabcontent"  >
<?php
$i=1;

if(count($getAllSpams) > 0){
foreach ($getAllSpams as $key => $value) { 

		$url=base_url()."timeline/landing/".$value->post_title."/".$value->post_id;
		$url=preg_replace('/\s+/', '-', $url);
     	$url=str_replace("?","-", $url);
    	$url=str_replace("!","-", $url);
     	$url=str_replace("#","-", $url);
     	$url=str_replace("%","-", $url);
	?>
	<table width="100%">
	<tr>
		<td width="3%"> SN </td>
		<td> Post Id </td>
		<td> Pub. Date </td>
		<td> Title </td>
		<td> Pub Name </td>
		<td> Email &amp; Contact no. </td>
		<td> Views </td>
		<td> Ads on Post </td>
		<td> Views Earning </td>
		<?php if($f==2){ ?> 
		<td> Report Type </td>
		<?php } ?>
	</tr>
	<tr>
		<td> <?php echo $i; ?> </td>
		<td> <?php echo $value->post_id; ?> </td>
		<td> <?php echo $value->posted_on; ?>  </td>
		<td> <?php echo $value->post_title; ?> </td>
		<td> <?php echo $value->name; ?></td>
		<td> <?php echo $value->email; ?> <br> <?php echo $value->mobile; ?></td>
		<td> <?php echo $value->views; ?> </td>
		<td> <?php echo $value->adsop; ?> </td>
		<td> <?php echo number_format($value->earn,2); ?></td>
		<?php if($f==2){ ?> 
		<td> <?php
			if($value->type==2){
				echo "Its not Interesting or fake content";
			}
			if($value->type==3){
				echo "Nudity or Violence";
			}
			if($value->type==5){
				echo "Promotes terrorism";
			}
			if($value->type==6){
				echo "Child abuse";
			}
			if($value->type==7){
				echo "Harmful dangers acts";
			}
			if($value->type==8){
				echo "Hateful content";
			}
		?> </td>
		<?php } ?>
	</tr>
		
	<tr>
		<td colspan="10">
			<table border="1" width="100%">
				<tr> 
					
					<td width="16%">  Number of spams: 
					<a href="<?php echo base_url(); ?>Admin/spamCount/<?php echo $value->post_id; ?>" > <?php echo $value->spamCount;  ?> </a> </td>
					<td> &nbsp; </td>
					<td width="48%"> &nbsp; </td>
					<td> Operation:

					<?php if($value->is_status==0){ ?>
					<a href="<?php echo $url; ?>"> View </a>
					<?php } ?>
					<?php	if($value->is_status==2){ ?>
					<a target="_blank" href="<?php echo $value->short_des; ?>"> View </a>
					<?php } ?> 
					 |

			
					<a href="<?php echo base_url(); ?>Admin/approveSpam/<?php echo $value->post_id; ?>/<?php echo $f; ?>" > Approve </a> |
				
					<a href="<?php echo base_url(); ?>Admin/rejectSpam/<?php echo $value->post_id; ?>/<?php echo $f; ?>" > Reject </a> | 

				    <a style="color: red" href="<?php echo base_url(); ?>Admin/blockUser/<?php echo $value->post_id; ?>/<?php echo $f; ?>"> Block User </a>  

				     </td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br>
<?php $i++; } }


else{
	echo "<br> <h1> No pending spams </h1>";	
}
?>


</div>

<div id="Approved" class="tabcontent">
<?php
$i=1;
if(count($getApprovedSpams) > 0){
foreach ($getApprovedSpams as $key => $value) { 
		$url=base_url()."timeline/landing/".$value->post_title."/".$value->post_id;
		$url=preg_replace('/\s+/', '-', $url);
     	$url=str_replace("?","-", $url);
    	$url=str_replace("!","-", $url);
      	$url=str_replace("#","-", $url);
      	$url=str_replace("%","-", $url);
	?>
<table width="100%">
	<tr>
		<td width="3%"> SN </td>
		<td> Post Id </td>
		<td> Pub. Date </td>
		<td> Title </td>
		<td> Pub Name </td>
		<td> Email &amp; Contact no. </td>
		<td> Views </td>
		<td> Ads on Post </td>
		<td> Views Earning </td>
	</tr>
	<tr>
		<td> <?php echo $i; ?> </td>
		<td> <?php echo $value->post_id; ?> </td>
		<td> <?php echo $value->posted_on; ?>  </td>
		<td> <?php echo $value->post_title; ?> </td>
		<td> <?php echo $value->name; ?></td>
		<td> <?php echo $value->email; ?> <br> <?php echo $value->mobile; ?></td>
		<td> <?php echo $value->views; ?> </td>
		<td> <?php echo $value->adsop; ?> </td>
		<td> <?php echo number_format($value->earn,2); ?></td>
	</tr>
		
	<tr>
		<td colspan="9">
			<table border="1" width="100%">
				<tr> 
					
					<td width="16%">  Number of spams: <a href="<?php echo base_url(); ?>Admin/spamCount/<?php echo $value->post_id; ?>" > <?php echo $value->spamCount;  ?> </a>   </td>
					<td> &nbsp;</td>
					<td width="28%"> &nbsp; </td>
					<td> Operation:

					<?php if($value->is_status==0){ ?>
					<a href="<?php echo $url; ?>"> View </a>
					<?php } ?>
					<?php	if($value->is_status==2){ ?>
					<a target="_blank" href="<?php echo $value->short_des; ?>"> View </a>
					<?php } ?> 
					 |
					
					<a href="<?php echo base_url(); ?>Admin/rejectSpam/<?php echo $value->post_id; ?>/<?php echo $f; ?>" > Reject </a> | 
				    <a style="color: red" href="<?php echo base_url(); ?>Admin/blockUser/<?php echo $value->post_id; ?>/<?php echo $f; ?>"> Block User </a>  

				     </td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br>
<?php $i++; } }


else{
	echo "<br> <h1> Nothing found </h1>";	
}
?>

</div>

<div id="Rejected" class="tabcontent">
<?php
$i=1;
if(count($getRejectedSpams)) {
foreach ($getRejectedSpams as $key => $value) { 
		$url=base_url()."timeline/landing/".$value->post_title."/".$value->post_id;
		$url=preg_replace('/\s+/', '-', $url);
     	$url=str_replace("?","-", $url);
    	$url=str_replace("!","-", $url);
      	$url=str_replace("#","-", $url);
      	$url=str_replace("%","-", $url);
	?>
<table width="100%">
	<tr>
		<td width="3%"> SN </td>
		<td> Post Id </td>
		<td> Pub. Date </td>
		<td> Title </td>
		<td> Pub Name </td>
		<td> Email &amp; Contact no. </td>
		<td> Views </td>
		<td> Ads on Post </td>
		<td> Views Earning </td>
	</tr>
	<tr>
		<td> <?php echo $i; ?> </td>
		<td> <?php echo $value->post_id; ?> </td>
		<td> <?php echo $value->posted_on; ?>  </td>
		<td> <?php echo $value->post_title; ?> </td>
		<td> <?php echo $value->name; ?></td>
		<td> <?php echo $value->email; ?> <br> <?php echo $value->mobile; ?></td>
		<td> <?php echo $value->views; ?> </td>
		<td> <?php echo $value->adsop; ?> </td>
		<td> <?php echo number_format($value->earn,2); ?></td>
	</tr>
		
	<tr>
		<td colspan="9">
			<table border="1" width="100%">
				<tr> 
					
					<td width="16%">  Number of Spams: <a href="<?php echo base_url(); ?>Admin/spamCount/<?php echo $value->post_id; ?>" > <?php echo $value->spamCount;  ?> </a>  </td>
					<td> &nbsp; </td>
					<td width="28%"> &nbsp; </td>
					<td> Operation:

					<?php if($value->is_status==0){ ?>
					<a href="<?php echo $url; ?>"> View </a>
					<?php } ?>
					<?php	if($value->is_status==2){ ?>
					<a target="_blank" href="<?php echo $value->short_des; ?>"> View </a>
					<?php } ?> 
					 |
					<a href="<?php echo base_url(); ?>Admin/approveSpam/<?php echo $value->post_id; ?>/<?php echo $f; ?>" > Approve </a> |
					
				    <a style="color: red" href="<?php echo base_url(); ?>Admin/blockUser/<?php echo $value->post_id; ?>/<?php echo $f; ?>"> Block User </a>  

				     </td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br>
<?php $i++; } }


else{
	echo "<br> <h1> Nothing found </h1>";	
}
?>
</div>

<div id="blocked" class="tabcontent">

	
		<?php
			$i=1;
			if(count($blockedUser) > 0){  ?> 
			<table>
				<tr> 
					<td> S.N. </td>
					<td> Id </td>
					<td> Name </td>
					<td> Mobile </td>
					<td> Email </td>
					<td> Action </td>
				</tr>
		<?php
			foreach ($blockedUser as $key => $value) { ?>
			<tr> 
				<td height="40px;"> <?php echo $i; ?> </td>
				<td> <?php echo $value->id; ?> </td>
				<td > <img src="<?php echo base_url().$value->profile_pic ?>" height="32px" width="32px" valign="middle" > <?php echo $value->name; ?>  </td>
				<td> <?php echo $value->mobile; ?>  </td>
				<td> <?php echo $value->email; ?>  </td>
				<td> <a href="<?php  echo base_url(); ?>Admin/unblockUser/<?php echo $value->id; ?>/<?php echo $f; ?>"> Unblock User </a>  </td>
			</tr>		
		<?php	} }

		else{ ?>
		<br>
			<h1> Nothing found </h1>
		<?php }
		?>
	</table>	

</div>

