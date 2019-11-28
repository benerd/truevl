
<?php
	
	foreach ($userArr as $key => $value) { 
		
		?>
	<p style="border-bottom: 1px solid #ccc;padding-left:15px; padding-bottom: 5px;padding-top: 5px;">
		<img valign="middle" src="<?php echo $value[0]->profile_pic; ?>" height="24px" width="24px" >
		<a href="<?php echo base_url(); ?>tuser/<?php echo $value[0]->otp.$value[0]->id; ?>/<?php echo str_replace(" ", "-", $value[0]->name); ?>"> <?php echo $value[0]->name; ?> </a>
	</p>
	<?php }
		
?>