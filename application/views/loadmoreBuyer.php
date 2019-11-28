   <?php 

    if(count($usr)>0)
    {
      for ($i=0; $i < count($usr) ; $i++) { 
        // $parts = explode("@", $usr[$i][0]['email']);
        $unm = str_replace(" ", "-", $usr[$i][0]['name']); 
        $url=base_url()."tuser/".$usr[$i][0]['otp'].$usr[$i][0]['id']."/".$unm;

        if($usr[$i][0]['active']==1){
  ?>

        <div class="buyer">

          
      <!-- <?php
        // print_r($buyers);
      ?> -->
        <a href="<?php echo $url; ?>">

<img  src="<?php $usr[$i][0]['profile_pic']; ?> " width="100%" height="auto" style="z-index: 0"> </a>
        
        <p style="line-height: 11px;min-height:20px;" class="text-center "> <a class="unm" href="<?php echo $url; ?>">  <?php echo $usr[$i][0]['name']; ?> </a> </p> 
        <p class="text-center"> <a style="font-size: 11px;" href="#" onclick="buyers(<?php echo $usr[$i][0]['id']; ?>);return false;" class="text-gray"> Links (<?php echo($buyers[$i]);  ?>) </a> </p>
        

        
        
         </div>
<?php } } }


?>

<div id="myb"> </div>

<div id="mybModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Links </h4>
      </div>
      <div class="modal-body">
        <p id="mbaa"></p>
      </div>
     
    </div>

  </div>
  </div>

<script type="text/javascript">
  
  function buyers(uid){
    $.ajax({
      url: "<?php echo base_url(); ?>Users/myBuyers/"+uid,
      type:"post",
      success: function(response){
        $("#mbaa").html(response);
        $("#mybModal").modal('show');
      }
    })
  } 
 

</script>