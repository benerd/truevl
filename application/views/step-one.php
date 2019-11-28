<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main1.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/cropper.min.css">
 
<div style="background: #fff; position: absolute;top: 42px; height: 300px; width: 100%" >
	

	<div style="margin-top: 140px; margin-bottom: 20px;color: #006097"> <p class="text-center">  	<?php echo $userData[0]->name; ?>, Please Set Your profile picture   </p> </div>

	<div style="width: 12%;	height: 53%; margin:0px auto;">
		  <div class="container" id="crop-avatar">  
	 <img src="<?php echo $userData[0]->profile_pic; ?>" width="100%" style="width: 100%;"  id="dp" class="avatar-view"> 
		<br><br>

		 <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1" style="z-index: 10000;">
      <div class="modal-dialog" style="z-index: 10000;"> 
        <div class="modal-content" style="z-index: 10000;">
          <form class="avatar-form" action="<?php echo base_url(); ?>crop" enctype="multipart/form-data" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label"> Set Your Profile Picture</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">
              <div class="col-lg" > <span id="re"> 
               <div class="progress-wrp"><div class="progress-bar" aria-valuenow="0" aria-valuemax="100"></div ></div>
                </span> </div>
              <div class="cl"> </div>
                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input type="hidden" class="avatar-src" name="avatar_src">
                  <input type="hidden" class="avatar-data" name="avatar_data">
                 <!--  <label for="avatarInput">Local upload</label> -->
                  <label class="fileContainer">
                      Choose File
                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                   </label>
                  

                </div>


                <div class="row" style="width: 100%; float: left;">
                  <div class="col-md-9" style="float: left;width: 65%;">
                    <div class="avatar-wrapper">
     <img src="<?php echo $userData[0]->profile_pic; ?>" width="100%" style="z-index: 10000;">
                    </div>
                  </div>
                  <div class="col-md-3" style="float: right;width: 30%;">
                    <div class="avatar-preview preview-lg" style="z-index: 10000;"></div>
                    <div>  </div>
                  </div>
                </div>
                <div class="cl"> </div>
                <div class="row avatar-btns">
                  <div class="col-md-12" style="width: 100%; float: left;">
                    <div class="" style="width: 33%; float: left;">
                     
                    
                    </div>
                    <div class="" style="width:33%; float: left;">
                    
                   
                    </div>
                  
                  <div class="cl"></div>
                    <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                  </div>
                  <div class="cl"> </div>
                </div>
              </div>
            </div>
           
          </form>
        </div>
      </div>
    </div><!-- /.modal -->
</div>

		<div style="width: 40%; margin: auto;">
			
		  </div>
		  <div class="cl"></div>
		 <div id="loader"> </div> 
	</div>

	<div class="cl">  </div>

	<div style="float: left;width:80%; margin-left: 10%;margin-top: 80px;"> 



<?php if($userData[0]->profile_pic!="assets/img/default-user.jpg") { ?>

		<a href="<?php echo base_url(); ?>Users/stepTwo"> <button style="width: 8%;background: green;color: #fff;border: 1px solid lightgreen;float: right;margin-left: 20px;" > Next </button> </a>
     <?php }
     else { ?>
		<span class="pull-right"> <a href="<?php echo base_url(); ?>Users/stepTwo">	Skip  </a>  </span> 

    <?php } ?>
	 </div>


</div>

 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/cropper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/main1.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/main2.js"></script>
<style type="text/css">
	.fileContainer {
     background: #006097;
     color: #fff;
      margin: 0px;
      padding-top: 9px; 
      padding-left: 15px;
      padding-right:15px;
      font-size: 16px; 
      padding-bottom: 9px;

     /*display: inline-block;*/
}

.fileContainer [type=file] {
 
    cursor: inherit;
    display: block;
    overflow: hidden;
    position: absolute;
    filter: alpha(opacity=0);
   
    opacity: 0;
    right: 0;
    text-align: right;
    top: 0;

}

.progress-wrp {
    display: none;
    border: 1px solid #0099CC;
    padding: 1px;
    position: relative;
    border-radius: 3px;
    margin: 10px;
    text-align: left;
    background: #fff;
    box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
}
.progress-wrp .progress-bar{
  display: none;
    height: 20px;
    border-radius: 3px;
    background-color: #5CAA50;
    width: 0%;
    box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
}
.progress-wrp .status{
    top:3px;
    left:50%;
    position:absolute;
    display:inline-block;
    color: #000000;
}


</style>
