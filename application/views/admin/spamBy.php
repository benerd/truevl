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
<br><br><br>
<div id="Tfull">

<table width="100%" border="0"><tr> <td>  S.N. </td> <td> Name </td> <td> Message </td><td> Time </td>   </tr>
<?php
	$i=1;
	foreach ($countSpam as $key => $value) {
	
		?>
		<tr>
			<td> <?php echo $i; ?> </td>
			<td> <a href="<?php echo base_url(); ?>users/author/<?php echo $value->uid; ?>"> 
			<img src="<?php echo base_url().$value->profile_pic; ?>" valign="middle" height="18px" width="18px">
			<?php echo $value->name; ?> </a> </td>
			<td> <?php if(isset($value->msg)){
			 		echo $value->msg;}
			 		else{
			 			echo "-";
			 		}
			  ?>  </td>
			<td> <?php echo $value->time; ?> </td>
		</tr>
<?php		
	}
?>


</table>
</div>