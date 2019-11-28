<div style="min-height: 100px;max-height: 400px; overflow-y: scroll;">
<?php 
		
	
	foreach ($z as $key => $value) {
		  if($key <5 ){
		?>

	<div style="border-bottom: 1px solid #ccc;">
	<div style="width: 5%; float: left;">
			<img src="<?php echo $value[0]->profile_pic; ?> " width="100%">
		</div>
	<div style="float: left;width: 90%;margin-top: 10px;" >
		 &nbsp; &nbsp;
		 <a href="<?php echo base_url(); ?>tuser/<?php echo $value[0]->otp.$value[0]->id; ?>/<?php echo str_replace(' ', '-', $value[0]->name); ?>">
		  <?php echo $value[0]->name; ?>  </a>



		<?php
		 
		 	if($z1[$key]){
		 	if($z1[$key]->status==1){
		 		echo "<span style='display: block; border: 1px solid green; color: green;padding: 0px 4px;' class='pull-right'> Linked </span>";
		 }

		 	if($z1[$key]->status==0){
		 		echo "<span style='display: block; border: 1px solid #ccc; color: #ccc;padding: 0px 10px;' class='pull-right'> Sent </span>";
		 }

		 	

		}

			else if($userId==$value[0]->id){
		 		echo "";
		 }
		
		 	else {
		 		echo "<a href='#' onclick='join(".$userId.",".$value[0]->id.",1); return false;'><span style='display: block; border: 1px solid #0768a0; color: #0768a0;padding: 0px 4px;' class='pull-right j1'> Link up </span> </a>";
		 	}
		  ?>
	</div>

	<div class="cl"> </div>
	</div>

	<?php	} }
			if(count($z) > 5){
				echo "<a style='text-align: center;display: block;' href='".base_url()."Feeds/Likes/".$pid."'> See More </a>";

			}
	 ?>
</div>