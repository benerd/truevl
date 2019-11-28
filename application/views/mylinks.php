<br clear="all"> 
<div id="content_wrapper" style="margin-top: 20px;">
<div id="inner">

<div id="Tleft"> 

<?php
foreach ($userData as $x ) {

  include("includes/side.php");
   } ?>

 </div>
<div id="Tcenter" style="margin-top: 1px; background: #fff;"> 

<div >
<?php 
	
	
	foreach ($udata as $key => $value){
		  
		?>
	<div style="width: 100%;">
		<div style="width: 9%; margin-left: 2%;float: left;">
			<img src="<?php echo $value[0]->profile_pic; ?>" width="100%" >
		</div>
		<div style="width: 85%;margin-left: 2%; float: left;">
			<a href="<?php base_url(); ?>tuser/<?php echo $value[0]->otp.$value[0]->id; ?>/<?php echo str_replace(' ', '-', $value[0]->name); ?> "> <?php echo $value[0]->name; ?> </a>

		<?php
		 if($key){ 
		 	if($fstatus[$key]){
		 	if($fstatus[$key]->status==1){
		 		echo "<span style='display: block; border: 1px solid green; color: green;padding: 0px 4px;' class='pull-right'> Linked </span>";
		 }

		 	if($fstatus[$key]->status==0){
		 		echo "<span style='display: block; border: 1px solid #ccc; color: #ccc;padding: 0px 10px;' class='pull-right'> Sent </span>";
		 }

		}
		 	else {
		 		echo "<a href='#' onclick='join(".$userId.",".$value[0]->id.",1); return false;'><span style='display: block; border: 1px solid #0768a0; color: #0768a0;padding: 0px 4px;' class='pull-right j1'> Link up </span> </a>";
		 	}
		 } ?>
		
		</div>
		<div class="cl"> </div>
	</div>	
		<?php
	} 

	
?>