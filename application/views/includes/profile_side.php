
 <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/cover.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/jquery.form.min.js"></script>
    <script type="text/javascript" >
$(document).ready(function() {
 $('#photoimg').on('change', function(){
  var form = $('#imageform')[0]; 

  var formData = new FormData(form);
 
  console.log(formData);
  var f;

 repositionCover();
$.ajax({
  url: "<?php echo base_url(); ?>Users/cover_pic",
  data :formData,
  method: "post",
  dataType: "json",
  processData: false,
  contentType: false,
  cache: false,
  beforeSend: function() {
            
             $('.cover-progress').html('<br><br><br><br><img src="<?php echo base_url(); ?>assets/img/source.gif" height="32px" style="width:42px" >' ).fadeIn();
        },
  success: function(response){
        $('.cover-progress').html('').fadeOut();
        ('fast');
        d = new Date();
        $("#cvr").attr('src', response.pic+'?'+d.getTime());

  }

});
 
 
 
 

 
});


 var elementPosition = $('#left1').offset();

$(window).scroll(function(){
        if($(window).scrollTop() > elementPosition.top){
              $('#left1').css('position','fixed').css('top','44px');
              $("#right2").css('position','fixed').css('top','44px');
        } else {
            $('#left1').css('position','absolute').css('top', '320px');
            $('#right2').css('position','absolute').css('top', '364px');
        }    
});

});
</script>
  <script type="text/javascript">
function repositionCover() {
    $('.cover-wrapper').hide();
    $('.cover-resize-wrapper').show();
    $('.cover-resize-buttons').show();
    $('.default-buttons').hide();
    $("#sc").show();
    $("#cncl").show();
    $('.screen-width').val($('.cover-resize-wrapper').width());
    $('.cover-resize-wrapper img')
    .css('cursor', 's-resize')
    .draggable({
        scroll: false,
        
        axis: "y",
        
        cursor: "s-resize",
        
        drag: function (event, ui) {
            y1 = $('.timeline-header-wrapper').height();
            y2 = $('.cover-resize-wrapper').find('img').height();
            
            if (ui.position.top >= 0) {
                ui.position.top = 0;
            }
            else
            if (ui.position.top <= (y1-y2)) {
                ui.position.top = y1-y2;
            }
        },
        
        stop: function(event, ui) {
            $('input.cover-position').val(ui.position.top);
        }
    });
}

function saveReposition() {
    
    if ($('input.cover-position').length == 1) {
        posY = $('input.cover-position').val();
        $('form.cover-position-form').submit();
    }
}

function cancelReposition() {
    $('.cover-wrapper').show();
    $('.cover-resize-wrapper').hide();
    $('.cover-resize-buttons').hide();
    $('.default-buttons').show();
    $('input.cover-position').val(0);
    $('.cover-resize-wrapper img').draggable('destroy').css('cursor','default');
}


 $(function(){
    $('.cover-resize-wrapper').height($('.cover-resize-wrapper').width()*0.3);

    $('form.cover-position-form').ajaxForm({
        url:  '<?php echo base_url()?>cropcover',
        dataType:  'json', 
        beforeSend: function() {
            $('.cover-progress').html('<img src="<?php echo base_url(); ?>assets/img/tenor.gif"').fadeIn('fast').removeClass('hidden');
        },
        
        success: function(responseText) {
            if ((responseText.status) == 200) {
             $('.cover-progress').fadeOut('fast').addClass('hidden').html('');
               $('input.cover-position').val(0);
               $('.drag-div').hide();
               $("#sc").hide();
               $("#cncl").hide();
              $('.cover-resize-wrapper img').draggable('destroy').css('cursor','default');

                $('.cover-wrapper img')
                    .attr('src', responseText.url + '?' + new Date().getTime())
                    .load(function () {
                        $('.cover-progress').fadeOut('fast').addClass('hidden').html('');
                        $('.cover-wrapper').show();
                        $('.cover-resize-wrapper')
                            .hide()
                            .find('img').css('top', 0);
                        $('.cover-resize-buttons').hide();
                        $('.default-buttons').show();
                        $('input.cover-position').val(0);
                        $('.cover-resize-wrapper img').draggable('destroy').css('cursor','default');
                    });
            }
        }
    });
});  


function join(uid,fid,key){
   $.ajax({

    
    url: '<?php echo base_url() ?>Users/addFriend/'+uid+'/'+fid,
    type: 'POST', 
    cache: false,
    contentType: false,
    processData: false,
   
    success: function(response){
    if(response==1) 
      {
        $(".j"+key).css({"background": "#fff", "border": "1px solid #ccc", "color": "#ccc"});
        $(".j"+key).html("Sent");
        $(".trans3").html("Request Sent").css("background", "#d4d4d4");
    } 
    if(response==0){
          alert("you can't sent link request to this guy");
    
    }
    if(response==2){
       alert("Request already sent");
    } 
      
    }
    
    
  });
}


</script>

<div class="timeline-header-wrapper">
 <div  class="cover-container">
<span class="camera">  <form id="imageform" action="" method="post" enctype="multipart/form-data"> <input type="file" name="photoimg" style="opacity: 0.0; position: absolute; top:0; left: 0; bottom: 0; right:0; width: 100%; height:100%;" id="photoimg" /> <img valign="middle" src="<?php echo base_url(); ?>assets/img/camera-icon.png" style="width: 32px; height: 32px;">Change cover pic  </form></span>
     <div class="cover-wrapper">
           <img src="<?php echo $userdata->cover_repos ;?>">
            <div class="cover-progress"></div>    
        </div> 
     
     <div  class="cover-resize-wrapper">
        <div class="trans2"> <span style="color: white"> click </span> </div>
            <img  id="cvr" src="<?php echo $userdata->cover_pic ;?> ">
            <div class="drag-div" align="center">Drag to reposition</div>
            <div class="cover-progress"></div>
        </div>
  <form class="cover-position-form hidden" method="post">
            <input class="cover-position" name="pos" value="0" type="hidden">
        </form>
    
  
    <div class="trans">  Link <span class="biger"> <?php echo $get_links; ?> </span>    Activity  <span class="biger"> <?php echo $get_activity; ?>   </span></div>
    <a onclick="saveReposition();" id="sc">Save Cover</a> <a onclick="cancelReposition();" id="cncl">Cancel</a>
  </div>
</div>


  <div id="left1">
  <div class="">
    <div class="container" id="crop-avatar">  
    <img id="dp " onclick="abc()" class="avatar-view" src="<?php echo $userdata->profile_pic; ?>  " width="85%" style="margin-left: 6px; margin-top: 5px;">

    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg" > 
        <div class="modal-content" >
          <form class="avatar-form" action="<?php echo base_url(); ?>crop" enctype="multipart/form-data" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label">Change Profile Picture </h4>
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
     <img src="<?php echo $userdata->profile_pic; ?>" width="100%" style="z-index: 10000;">
                    </div>
                  </div>
                  <div class="col-md-3" style="float: right;width: 30%;">
                    <div class="avatar-preview preview-lg" style="z-index: 10000;"></div>
                    <div> <a href="<?php echo base_url(); ?>Users/remove_pic"> Remove Profile Pic  </a> </div>
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

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>



    </div> 
    <div class="trans1"> <a class="text-white" href="#" > Edit </a> </div>
    <div align="center" style="width: 99.1%;background: #f5f5f5; border: 1px solid #ccc;">
      <span style="color: #135d82; text-align: center;font-size: 16px;  font-weight: bold; padding: 3px 15px;"  class=" text-center"> <?php echo $userdata->name; ?> </span>
    </div>
   
     <div class="status_quote"> 
         <div class="uinfo">
   
       
         <?php if( $userdata->work!=NULL){ ?>
          <div class="boxes">
        <i class="fa fa-thumbs-up" aria-hidden="true"></i>  <span id="work">  I am a  <?php echo $userdata->work; ?> </span>  </div><?php } ?>
     

       
          <?php if( $userdata->address!=NULL){ ?> <div class="boxes">
       <i class="fa fa-location-arrow" aria-hidden="true"></i>  <span id="add"> Lives in <?php echo $userdata->address; ?> </span> </div>  <?php } ?>
        

        <div class="boxes">

       <i class="fa fa-mobile" aria-hidden="true"></i>  <span id="mob"> <?php echo $userdata->mobile; ?> </span> 
        </div>

      </div>

       <div class="uinfo">
        
         <?php if( $userdata->website!=NULL){ ?> <div class="boxes">
         <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  <span id="website"> <?php echo $userdata->website; ?> </span> 
           </div>   <?php } ?>
        
        <div class="boxes">
         <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Joined <?php echo $userdata->joining_date; ?>  
        </div>
     
     
      </div>  

     </div>
   

     
</div>
    </div> <!-- <end of left> -->



<div class="modal fade" id="statusModal" role="dialog">
    <div class="modal-dialog">
    
   
      <div class="modal-content" style="width: 400px; margin-left: 20%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Update Status </h4>
        </div>
        <div class="modal-body">
         <div id="usstatus">
            <form action="" method="post" onsubmit="return check_status();">
                <textarea rows="5" id="status" placeholder="Min 50 words" ></textarea>

                <br>

                <span style="font-weight: bold; color: red; font-size: 11px;" id="s_msg"></span>
               
                 <div align="right"><button class="btn"> Update </button> </div>
            </form>  
                
        </div>
        </div>
       
      </div>
      
    </div>
  </div>


<style type="text/css">
  input{
  padding: 0px;
  height: 11px;
}


input[type="text"]{
  border: 1px solid #ccc;
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
<script type="text/javascript">
  
 


  function check_status(){
     
     var wordCount = document.getElementById("status").value.trim().split(/\s+/).length; 
     var status= document.getElementById("status").value;

     if(status==""){
        $('#s_msg').html("Sorry! This field can't be empty");
        return false
     }
      if(wordCount>50){
        $('#s_msg').html("Sorry! only 50 words are allowed");
        return false;
      }

      $.ajax({
        url: '<?php echo base_url(); ?>feeds/submit_my_post/3',
        method: 'post',
        data: { "short_des" : status },

                success: function(response){
                      if(response==1){
                        
                        alert("status updated");
                        location.reload();
                      
                }

        }

    });
      
  }

  
      
  function update_work(id1, id2) {
    $("#"+id2).hide();
   //   $("#"+id1).html("<input type='text' name='' value='<?php echo $userdata->work; ?> ' style='color: #ccc' readonly>"); 

      $("#"+id1).html("<input type='text' id='work_v'> <i id='w_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='w_cl'></i>  <div id='msg2'>  </div> ");

      $("#w_up").click(function(){
          var nm=$("#work_v").val();
           if(nm==""){
            $("#msg2").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
          $.ajax({
            url: "<?php echo base_url(); ?>settings/update_work",
            method: "post", 
            data: {nm: nm},
            success: function(response){

              if(response==1){
                  location.reload();
              }

            }

          });
      });

       $("#w_cl").click(function(){
          $("#"+id1).html("<?php echo $userdata->work; ?>");
          $("#work_edit").html("");
          $("#"+id2).show();
      });

  }

   function update_web(id1, id2) {
    $("#"+id2).hide();
     

      $("#"+id1).html("<input type='text' id='web_v'>  <i id='wr_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='wr_cl'></i>  <div id='msg3'>  </div>  ");

      $("#wr_up").click(function(){
          var nm=$("#web_v").val();
           if(nm==""){
            $("#msg3").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
          $.ajax({
            url: "<?php echo base_url(); ?>settings/update_web",
            method: "post", 
            data: {nm: nm},
            success: function(response){

              if(response==1){
                  location.reload();
              }

            }

          });
      });

       $("#wr_cl").click(function(){
          $("#"+id1).html("<?php echo $userdata->website; ?>");
          $("#web_edit").html("");
          $("#"+id2).show();
      });
  }

  

   function update_add(id1, id2) {
    $("#"+id2).hide();
    

      $("#"+id1).html("<input type='text' id='add_v' style='border: 1px solid #ccc;'> <i id='ad_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='ad_cl'></i>  <div id='msg5'>  </div> ");

      $("#ad_up").click(function(){
          var nm=$("#add_v").val();
           if(nm==""){
            $("#msg5").html("<small>Sorry!! this field can't be empty</small>").css("color", "red");
            return false;
          }
          $.ajax({
            url: "<?php echo base_url(); ?>settings/update_add",
            method: "post", 
            data: {nm: nm},
            success: function(response){

              if(response==1){
                  location.reload();
              }

            }

          });
      });

       $("#ad_cl").click(function(){
          $("#"+id1).html("<?php echo $userdata->address; ?>");
          $("#add_edit").html("");
          $("#"+id2).show();
      });
  }


    function update_mob(id1, id2) {
    $("#"+id2).hide();
    

      $("#"+id1).html("<input type='text' id='mob_v'> <i id='mob_up' class='fa fa-check gi' aria-hidden='true'></i> <i class='fa fa-times ri' aria-hidden='true' id='mob_cl'></i>  <div id='msg6'>  </div> ");

      $("#mob_up").click(function(){
          var nm=$("#mob_v").val();
           if(nm==""){
            return false;
          }
          if(isNaN(nm)){
             $("#mob_msg").html("please enter a valid number");
            return false;
          }


            $.ajax({
            url: "<?php echo base_url(); ?>settings/update_mob",
            method: "post", 
            data: {nm: nm},
            success: function(response){

              if(response==1){
                  location.reload();
              }

            }

          });
      });

       $("#mob_cl").click(function(){
          $("#"+id1).html("<?php echo $userdata->mobile; ?>");
        
          $("#"+id2).show();
      });




  }


     
     function abc(){
        document.body.scrollTop=0;
        document.documentElement.scrollTop = 0;
     }


</script>

<style type="text/css">
  
.fileContainer {
      border: none;
      background: #006097;
      color: #fff;
      margin: 0px;
      padding-top: 9px; 
      padding-left: 15px;
      padding-right:15px;
      font-size: 16px; 
     /*display: inline-block;*/
}

.fileContainer [type=file] {
    border: none;
    cursor: inherit;
    display: block;
    overflow: hidden;
    position: relative;
    font-size: 999px;
    filter: alpha(opacity=0);
    min-height: 100%;
    min-width: 100%;
    opacity: 1;
    right: 0;
    text-align: right;
    top: 0;

}

.modal-backdrop {
  z-index: -1;
}

.modal-dialog{
  z-index: 10000 !important;
}


</style>