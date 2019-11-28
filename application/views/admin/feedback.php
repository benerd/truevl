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
<h3> Feedbacks </h3>
<br>
 <table  border="1" class="" >
     <thead>
      <tr class="trow">
      	 <th width="1%"> SN </th>
       
         <th width="12%;"> <b> Email  </b> </th>
         <th width="35%;"> <b> Mobile Number </b> </th>
         <th width="10%"> <b>  Feedback </b> </th>
         <th width="15%;">  <b> Attachment  </b> </th>
         
      </tr>
    </thead>


    <?php $i=1;
      foreach ($f as $key => $value) { 
      		 
      	?>
      <tr>
      	<td> <?php echo $i; ?> </td>
        <td>  <?php echo $value->email; ?> </td>   
        <td>  <?php echo $value->mobile; ?> </td>   
        <td>  <?php echo $value->feedback; ?> </a> </td>   
        <td> 
          <?php if($value->attachment!=NULL) { ?> 
          <img src="<?php echo base_url().$value->attachment; ?>" height="32px" width="32px" >  <a href="<?php echo base_url().$value->attachment; ?>" target="_blank" > View </a>  </td>   
        <?php } else{
            echo "No Attachment";          
        } ?>
      </tr>
     <?php $i++; }
    ?>
</table>

<br>
