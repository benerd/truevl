<?php
	
	foreach ($by_user as $key => $value) { 
		$getUdata=$this->User_model->getUdata($value->id);
		?>
	<p style="border-bottom: 1px solid #ccc;padding-left:15px; padding-bottom: 5px;padding-top: 5px;">
		<img valign="middle" src="<?php echo $getUdata[0]->profile_pic; ?>" height="24px" width="24px" >
		<a href="<?php echo base_url(); ?>tuser/<?php echo $getUdata[0]->otp.$getUdata[0]->id; ?>/<?php echo str_replace(" ", "-", $getUdata[0]->name); ?>"> <?php echo $getUdata[0]->name; ?> </a>
	</p>
	<?php }
		
?>