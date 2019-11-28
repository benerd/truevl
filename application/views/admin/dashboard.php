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


body{
  background: #fff;
}

table td,th{
    border: 1px solid #000;
    padding-left: 10px;
    padding-right: 10px;
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

 <div class="dash" style="margin: 0px; margin-bottom: 8px;">
    <div class="dbox" style="width: 20%; margin-left: 0px;height: 86px;">
    
      <div class="icons orange" >
         <h3 class="text-center">
      Active Users  </h3>
      </div>

      <div> <br> <br> 
          <p class="text-center" style="font-size: 18px; font-weight: 700;">   
            <?php echo count($getAllactive); ?> </p>
      
      </div>

    </div>

    <div class="dbox">
      <div class="icons blu">

        <h3 class="text-center">
       Spam Alerts  </h3>
        
      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
          <?php echo count($getAllSpams); ?>  </p><br>
      </div>

    </div> 
      <div class="dbox">
      <div class="icons purple">

        <h3 class="text-center">
       Post </h3>
        
      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
          <?php echo count($getAllPosts); ?>
         </p><br>
      </div>

    </div> 

    <div class="dbox">
      <div class="icons purple">

        <h3 class="text-center">
       Links  </h3>
        
      </div>

      <div>
      <br><br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
           <?php echo count($getAllLinks); ?> 
         </p> <br>
      </div>

    </div> 

    <div class="dbox">
      <div class="icons orange">

        <h3 class="text-center">
        Verified Users   </h3>
        
      </div>

      <div>
         <br><br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
          <?php echo count($getVerifiedUsers); ?>
         </p>  <br>
      </div>

    </div> 

      <div class="dbox">
       <div class="icons green">

        <h3 class="text-center">
        Unvarified Users  </h3>
        
      </div>

      <div>
         <br> <br>
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> 
          <?php echo count($getUnVerifiedUsers); ?>
            </p> <br>
      </div>
        

    </div>
    <div class="cl"> </div>
  </div>


  <div class="cl"> </div>
  <br>  <br>  
  <div style="width: 45%; margin-right: 10px;border: 1px solid #ccc;float: left;padding-bottom: 20px;">
  <h3 style="display: inline-block;"> Earning </h3>  
      <select style="height: 20px; width: 30%;float: right;margin-right: 20px;"> 
        
          <option value="1"> Today so far  </option>
            <option value="2"> Yesterday  </option>
          <option value="3">  This week  </option>
          <option value="4"> This month  </option>
          <option value="5"> Total  </option>
        </select>

  
  <br> <br> 
 


   <div class="dbox" style="width:28%;">
      <div class="icons blu">

        <h3 class="text-center">
       Total Earning </h3> 
        
    

      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          21  </p><br>
      </div>
  </div>

   <div class="dbox" style="width:28%;">
      <div class="icons blu">

        <h3 class="text-center">
       Comission </h3> 
        
    

      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          21  </p><br>
      </div>
    </div>


  

  <div class="dbox" style="width:28%;">
      <div class="icons blu">

        <h3 class="text-center">
       Advertisement </h3>
        
      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          21  </p><br>
      </div>
  </div>

    <div style="margin:10px 0px;"> <br></div>

   <div class="dbox" style="width:28%;">
      <div class="icons blu">

        <h3 class="text-center">
       Promotion </h3> 
        
    

      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          21  </p><br>
      </div>
  </div>

   

   

</div>

 <div style="width: 45%; border: 1px solid #ccc;float: left;padding-bottom: 20px;">
  <h3 style="display: inline-block;"> Transactions </h3>  
      <select style="height: 20px; width: 30%;float: right;margin-right: 20px;"> 
        
          <option value=""> Today so far  </option>
            <option value=""> Yesterday  </option>
          <option value="">  This week  </option>
          <option value=""> This month  </option>
          <option value=""> Total  </option>
        </select>

  
  <br> <br> 
 
  <div class="dbox" style="width:28%;">
      <div class="icons blu">

        <h3 class="text-center">
       Total Amount  </h3>
        
      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          21  </p><br>
      </div>
  </div>

   <div class="dbox" style="width:28%;">
      <div class="icons blu">

        <h3 class="text-center">
        Payable amount </h3> 
        
    

      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          21  </p><br>
      </div>
  </div>

   <div class="dbox" style="width:28%;">
      <div class="icons blu">

        <h3 class="text-center">
       Pending amount </h3> 
        
    

      </div>

      <div>
         <br> <br> 
         <p class="text-center" style="font-size: 18px; font-weight: 700;"> <i class="fa fa-inr" ></i>  
          21  </p><br>
      </div>
    </div>


    <div style="margin:10px 0px;"> <br></div>

 

</div>

<div class="cl"> </div>

<div> 
  <br>
  <h3 style="display: inline-block;" > Total Posts:   </h3>
     <select class="pull-right" style="width: 25%;border: 1px solid #ccc;" onchange="totalPosts();" id="tpday" >
    
     <option value="1" selected> Today so far  </option>
     <option value="2"> Yesterday  </option>
     <option value="3"> This week </option>
     <option value="4"> Monthly  </option>

   </select>
    <br> <br>
      <table class="table"  border="1" class="" >
     <thead>
      <tr class="trow">
         <th width="1%"> <b> Id </b> </th>
         <th width="12%;"> <b> Date </b> </th>
         <th width="45%;"> <b> Post Title </b> </th>
         <th width="10%"> <b>  Category </b> </th>
         <th width="15%;">  <b> Pub. Name  </b> </th>
         <th width="5%">   <b> Views  </b> </th>
         <th width="10%"> <b> Earning </b> </th>
      </tr>
    </thead>


    <?php
      foreach ($AllPostData as $key => $value) { ?>
      <tr>
        <td>  <?php echo $value->post_id; ?> </td>   
        <td>  <?php echo date("d-m-Y", strtotime($value->posted_on)); ; ?> </td>   
        <td>  <?php echo $value->post_title; ?> </td>   
        <td>  <?php echo $value->cat; ?> </td>   
        <td>  <?php echo $value->name; ?> </td>  
        <td>  <?php echo $value->views; ?> </td>  
        <td>  <?php echo number_format($value->earn,2); ?> </td>     
      </tr>
     <?php }
    ?>
</table>
</div>

<div class="cl"> </div>

<div>
  <br>
   <h3 style="display: inline-block;"> Link Posts:   </h3>
     <select class="pull-right" style="width: 25%;border: 1px solid #ccc;" onchange="linkPosts();" id="lpday" >
    
     <option value="Today"> Today so far  </option>
     <option value="Yesterday"> Yesterday  </option>
     <option value="Week"> This week </option>
     <option value="Monthly"> Monthly  </option>

   </select>
    <br> <br>
      <table  border="1" class="table" >
     <thead>
      <tr class="trow">
         <th width="1%"> <b> Id </b> </th>
         <th width="12%;"> <b> Date </b> </th>
         <th width="45%;"> <b> Post Title </b> </th>
         <th width="10%"> <b>  Category </b> </th>
         <th width="15%;">  <b> Pub. Name  </b> </th>
        
      </tr>
    </thead>
       <?php
      foreach ($AllLinkData as $key => $value) { ?>
      <tr>
        <td> <?php echo $value->post_id; ?> </a> </td>   
        <td>   <?php echo date("d-m-Y", strtotime($value->posted_on)); ; ?> </td>   
        <td>  <a href='<?php echo $value->short_des; ?>' target="_blank" >  <?php echo $value->post_title; ?> </a> </td>   
        <td>  <?php echo $value->cat; ?> </td>   
        <td>  <?php echo $value->name; ?> </td>  
       
         
      </tr>
     <?php }
    ?>
  </table>
</div>

<div>
  <br>
   <h3 style="display: inline-block;"> Most Viewed: </h3>
     <select class="pull-right" style="width: 25%;border: 1px solid #ccc;" onchange="mostViewed();" id="mvday" >
    
     <option value="1"> Today so far  </option>
     <option value="2"> Yesterday  </option>
     <option value="3"> This week </option>
     <option value="4"> Monthly  </option>

   </select>
    <br> <br>
      <table  border="1" class="table" >
     <thead>
      <tr class="trow">
         <th width="1%"> <b> Id </b> </th>
         <th width="12%;"> <b> Date </b> </th>
         <th width="45%;"> <b> Post Title </b> </th>
         <th width="10%"> <b>  Category </b> </th>
         <th width="15%;">  <b> Pub. Name  </b> </th>
         <th width="5%">   <b> Views  </b> </th>
         <th width="10%"> <b> Earning </b> </th>
      </tr>
    </thead>
       <?php
      foreach ($mostViewed as $key => $value) { ?>
      <tr>
        <td> <?php echo $value->post_id; ?> </a> </td>   
        <td>   <?php echo date("d-m-Y", strtotime($value->posted_on)); ; ?> </td>   
        <td>  <a href='<?php echo $value->short_des; ?>' target="_blank" >  <?php echo $value->post_title; ?> </a> </td>   
        <td>  <?php echo $value->cat; ?> </td>   
        <td>  <?php echo $value->name; ?> </td>  
        <td>  <?php echo $value->views; ?> </td>  
        <td>  <?php echo number_format($value->earn,2); ?> </td>  
       
         
      </tr>
     <?php }
    ?>
  </table>
</div>

<div>
  <br>
   <h3 style="display: inline-block;"> Top Promoters:   </h3>
    <select class="pull-right" style="width: 25%;border: 1px solid #ccc;" onchange="topPromoters();" id="prday" >
    
     <option value="1"> Today so far  </option>
     <option value="2"> Yesterday  </option>
     <option value="3"> This week </option>
     <option value="4"> Monthly  </option>

   </select>
    <br><br>
      <table  border="1" class="table" >
     <thead>
      <tr class="trow">
         <th width="1%"> <b> UserId </b> </th>
         <th width="12%;"> <b> Name </b> </th>
         <th width="45%;"> <b> Joining Date </b> </th>
         <th width="10%"> <b>  Country </b> </th>
         <th width="15%;">  <b> State  </b> </th>
         <th width="5%">   <b> Promoted Post  </b> </th>
         <th width="10%"> <b> Promotion Earning </b> </th>
      </tr>
    </thead>
       <?php

      foreach ($topPromoters as $key => $value) { ?>
      <tr>  
        <td> <?php echo $value->user_id; ?>  </td>   
        <td>  <?php echo $value->name; ?>  </td>   
        <td> <?php echo $value->joining_date; ?> </td>   
        <td> <?php echo $value->country; ?>  </td>   
        <td> <?php echo $value->state; ?> </td>  
        <td> <?php echo $value->count; ?> </td>  
        <td> <?php echo $value->sum; ?> </td>  
       
         
      </tr>
     <?php }
    ?>
  </table>
</div>

<script type="text/javascript">

  totalPosts();
  function totalPosts(){
    var tpday=$("#tpday").val();
    
    $.ajax({
      url: "<?php echo base_url(); ?>admin/totalPosts",
      data: {tpday: tpday},
      type: "post",
      success: function(response){

      }
    });
  }


</script>