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
<span id="delete_post">
  
<div  class="modal" data-backdrop="true" id="deleteModal" role="dialog" style="width: 60%;margin: 150px auto; ">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;">
        
          <h4 class="modal-title" style="background-color: #61BAE0; color: #fff; font-weight: bold; font-size: 16px; padding: 5px 5px;">Delete Post</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 20px;">
         
            <p class="text-center" style="padding: 20px 0px;"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>   Are You sure you want to delete post </p>
           <p class="text-center" style="margin-bottom: 20px 0px;">
              <button value="yes" id="del_y" class="btn btn-danger"> Yes </button>
              <button value="no" id="del_n" class="btn"> No </button>
          </p>
        </div>
        
      </div>
      
    </div>
  </div>

</span>
<div id="Tfull" style="margin-top: 47px;"> 	

<br>
<h3> All Posts </h3>
<br>
 <table  border="1" class="" >
     <thead>
      <tr class="trow">
      	 <th width="1%"> SN </th>
         <th width="1%"> <b> Id </b> </th>
         <th width="12%;"> <b> Date </b> </th>
         <th width="35%;"> <b> Post Title </b> </th>
         <th width="10%"> <b>  Category </b> </th>
         <th width="15%;">  <b> Pub. Name  </b> </th>
         <th width="5%">   <b> Views  </b> </th>
         <th width="10%"> <b> Earning </b> </th>
         <th width="15%"> <b> Opeartion </b>  </th>
      </tr>
    </thead>


    <?php $i=1;
      foreach ($AllPostData as $key => $value) { 
      		  $url=base_url()."timeline/landing/".$value->post_title."/".$value->post_id; 
		      $url= preg_replace('/\s+/', '-', $url);
		      $url=str_replace("?","-", $url);
		      $url=str_replace("!","-", $url);
		      $url=str_replace("#","-", $url);
		      $url=str_replace("%","-", $url);
      	?>
      <tr>
      	<td> <?php echo $i; ?> </td>
        <td>  <?php echo $value->post_id; ?> </td>   
        <td>  <?php echo date("d-m-Y", strtotime($value->posted_on)); ; ?> </td>   
        <td> <a href="<?php echo $url; ?>" target="_blank">  <?php echo $value->post_title; ?> </a> </td>   
        <td>  <?php echo $value->cat; ?> </td>   
        <td>  <?php echo $value->name; ?> </td>  
        <td>  <?php echo $value->views; ?> </td>  
        <td>  <?php echo number_format($value->earn,2); ?> </td> 
        <td> <a href="<?php echo $url; ?>" target="_blank"> View </a> | <a href="#" onclick="ask(<?php echo $value->post_id; ?>);"> Delete </a>  </td>   
      </tr>
     <?php $i++; }
    ?>
</table>

<br>
<h3> Delete Posts </h3>
<br>
 <table  border="1" class="" >
     <thead>
      <tr class="trow">
      	 <th width="1%"> SN </th>
         <th width="1%"> <b> Id </b> </th>
         <th width="12%;"> <b> Date </b> </th>
         <th width="35%;"> <b> Post Title </b> </th>
         <th width="10%"> <b>  Category </b> </th>
         <th width="15%;">  <b> Pub. Name  </b> </th>
         <th width="5%">   <b> Views  </b> </th>
       
         <th width="15%"> <b> Opeartion </b>  </th>
      </tr>
    </thead>


    <?php $i=1;
      foreach ($deletePostData as $key => $value) { 
      		  $url=base_url()."timeline/landing/".$value->post_title."/".$value->post_id; 
		      $url= preg_replace('/\s+/', '-', $url);
		      $url=str_replace("?","-", $url);
		      $url=str_replace("!","-", $url);
		      $url=str_replace("#","-", $url);
		      $url=str_replace("%","-", $url);
      	?>
      <tr>
      	<td> <?php echo $i; ?> </td>
        <td>  <?php echo $value->post_id; ?> </td>   
        <td>  <?php echo date("d-m-Y", strtotime($value->posted_on)); ; ?> </td>   
        <td> <a href="<?php echo $url; ?>" target="_blank">  <?php echo $value->post_title; ?> </a> </td>   
        <td>  <?php echo $value->cat; ?> </td>   
        <td>  <?php echo $value->name; ?> </td>  
        <td>  <?php echo $value->views; ?> </td>  
      
        <td> <a href="<?php echo $url; ?>" target="_blank"> View </a> | <a href="#" onclick="recover(<?php echo $value->post_id; ?>);"> Restore </a>  </td>   
      </tr>
     <?php $i++; }
    ?>
</table>
</div>

</div>

<div class="cl"> </div>

</div>

<script type="text/javascript">
	
	function ask(pid){

 
      $("#deleteModal").modal('show');  

      $("#del_y").click(function(){

            $.ajax({

    
          url: '<?php echo base_url() ?>Admin/delete_post/'+pid,
         type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
     
      if(response==1)
      {
    
       alert('Your Post has been Deleted...');
         window.location="<?php echo base_url(); ?>Admin/Post";
    
    }
    else{
       console.log(response);
     
    }
         }
    });
});
    
       $("#del_n").click(function(){
            $("#deleteModal").modal('hide');  
       });
   
  
}

function recover(id){
	$.ajax({ 
	url: "<?php echo base_url(); ?>Admin/recover",
	type: "post",
	data: { id: id},
	success: function(response){
			alert("Recovered");
			location.reload();
	}
	});
}

</script>