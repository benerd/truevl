<table id="tableData12">
	<thead>
		<tr>
		<th> S.N. </th>
		<th> Promoter Name </th>
		<th> Date </th>
		<th> Price </th>
		<th> Circulations </th>
	</tr>
	</thead>


<?php

foreach ($list as $key => $value) { 

	?>
		<tr>	
		<td> <?php echo $key+1; ?> </td>
		<td> <img src="<?php echo $value->profile_pic; ?>" width="40" height="40" valign="middle" > <?php echo $value->name; ?> </td>
		<td> <?php echo $value->time_publisher; ?> </td>
		<td> <?php echo $value->final_price; ?> </td>
		<td> <?php echo $value->reaches; ?> </td>
	</tr>
<?php 
}

?>

</table>

<script type="text/javascript">
	
	 
	  	 $('#tableData12').paging({limit:5});  

	
</script>