<?php
	
	foreach ($shared_by as $key => $value) { 
		$getUdata=$this->User_model->getUdata($value->id);
		?>
	<p style="border-bottom: 1px solid #ccc;padding-left:15px; padding-bottom: 5px;padding-top: 5px;">
		<img valign="middle" src="<?php echo $getUdata[0]->profile_pic; ?>" height="24px" width="24px" >
		<a href="<?php echo base_url(); ?>tuser/<?php echo $value->otp.$value->id; ?>/<?php echo str_replace(" ", "-", $value->name); ?>"> <?php echo $value->name; ?> </a>
	</p>
	<?php }
		
?>
