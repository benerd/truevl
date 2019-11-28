<br clear="all">  
<div id="content_wrapper" style="margin-top: 20px;">
<div id="inner">
<div id="Tleft"> 
<?php
foreach ($userData as $x ) {
  include("includes/side.php");
   } ?>
 
 </div>
  

<div style=" width: 40%; background: #fff;position:absolute; left:362px;top:46px;height: 92%; ">
  <div style="height: 5%;"> &nbsp;<b style="color: #006097"> Chat With  </b> <a href="<?php echo base_url(); ?>tuser/<?php echo $fotp.$uid2; ?>/<?php echo str_replace(" ", "-", $fname); ?>"> <?php echo $fname; ?> </a> <hr> </div>
	<div id="cbox" style="height: 80%;overflow-y: scroll;">
   <div style="">
    <div style="">
 <?php
              
       if(count($res) > 0){
        
          foreach($res as $row){
          $dt = new DateTime($row->time);  
          if($userId==$row->uid1){ ?>

          <div style="margin-right: 10px;margin-top: 3px; width: 70%;float: right;text-align: right;font-size: 13px; color: #333">  
          <span style="display: inline-block;float: left;max-width: 90%;border-radius: 8px;background: #f5f5f5;float: right; padding: 0px 6px;word-wrap: break-word;"> 

            <?php 
            $msg=trim($row->message, " ");
            if (filter_var($msg, FILTER_VALIDATE_URL)) {
            echo "<a href='".$msg."' target='_blank'> ".$msg." </a>";    
            }
            else{
              echo $row->message;
              echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>"; 
            }
             ?> 
           </span>
          <?php
            if(isset($row->link)){
              $link=json_decode($row->link);
              if($link->imgUrl || $link->post_title ){ ?>
          <span style="display: inline-block;float: left;max-width: 100%;border-radius: 8px;background: #f5f5f5;float: right; padding: 0px 6px;word-wrap: break-word;margin-top: 3px;">
          <img src='<?php echo $link->imgUrl; ?>' width="30%" valign="top" > 
          <span style="width: 70%;font-size: 12px;"><b> <?php echo mb_substr($link->post_title,0,100); ?> </b>
          </span>
           <p> <?php echo mb_substr($link->short_des,0,150); ?> </p> 
          <?php  echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>"; ?>            
          </span> 
             <?php }
            }
          ?>
         
         <?php
          if(isset($row->attachment)){ ?>
            <a href="#" onclick="imgModal('<?php echo $row->attachment ?>')" >
              <img src="<?php echo base_url().$row->attachment; ?>" width="25%" style=""> </a>
          <?php } ?>  

          </div>
           <?php } 
           else{ ?> 
            <div style="margin-left: 10px;margin-top: 3px; width: 70%;float: left;font-size: 13px; color: #333"> 
             <span style="display: inline-block;float: left;width: 11%;">  <img src="<?php echo base_url().$img; ?>" valign="bottom" width="100%" style="border-radius: 50px;"  > </span>
              <span style="display: inline-block;float: left;max-width: 79%;border-radius: 8px;background: #e1eaf3; padding: 0px 6px; margin-left: 5px;word-wrap: break-word;"> 
                <?php 
            $msg=trim($row->message, " ");
            if (filter_var($msg, FILTER_VALIDATE_URL)) {
               echo "<a href='".$row->message."' target='_blank'> ".$row->message." </a>";    
            } 
            else{
              echo $row->message;
              echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>";
            }
             ?> 
          </span>
          <?php
            if(isset($row->link)){
              $link=json_decode($row->link);
              if($link->imgUrl || $link->post_title ){ ?>
          <span style="display: inline-block;float: left;max-width: 100%;border-radius: 8px;background: #e1eaf3;float: right; padding: 0px 6px;word-wrap: break-word;margin-top: 3px;">
          <img src='<?php echo $link->imgUrl; ?>' width="30%" valign="top" > 
          <span style="width: 70%;font-size: 12px;"><b> <?php echo mb_substr($link->post_title,0,100); ?> </b>
          </span>
           <p> <?php echo mb_substr($link->short_des,0,150); ?> </p>
           <?php  echo "&nbsp; <sub><small>".$dt->format('H:i')."</small> </sub>"; ?>

          </span> 
             <?php }
            }
          ?>

              <?php
          if(isset($row->attachment)){ ?>

            <a href="#" onclick="imgModal('<?php echo $row->attachment ?>')" >  <img src="<?php echo base_url().$row->attachment; ?>" width="25%" style=""> </a>
          <?php } ?>  
          </div>

         <?php  }
           }
        }  
          ?>

        
       </div></div>
	</div>

	<input type="hidden" id="uid1" value="<?php echo $uid1; ?>">
<input type="hidden" id="uid2" value="<?php echo $uid2; ?>">
<input type="hidden" id="fimg" value="<?php echo $fimg; ?>">
<input type="hidden" id="imgUrl" name="">
<input type="hidden" id="post_title_ln" name="">
<input type="hidden" id="short_des_link" name="">
  <div align="center" id="atc_loading" style="display:none"><img src="<?php echo base_url(); ?>assets/img/load.gif" alt="Loading" /></div>
<div style="position: absolute;bottom: 0px;width: 100%">
<textarea style="border: 1px solid #ccc" placeholder="Type your message here" id="txtSearchProdAssign" ></textarea>



 <form action="#" enctype="multipart/form-data" id="attachForm" style="display: inline-block;">
   <span class="image-upload">
  
    <label for="file-input">
         <img src="<?php echo base_url(); ?>assets/img/attach.png" height="20px" width="20px" style="margin-left: 5px;" valign="middle" > 
    </label>

    <input id="file-input" accept="image/*" type="file"/>
    
    </span>
    </form>


<button class="btn-primary pull-right" style="width: 15%;margin-right: 5px;" id="sendMsg" > Send </button>
</div>
</div>

<div  style=" width: 20%; background: #fff;position:absolute; left:67%;top:46px;height:90%;overflow: scroll; ">
	<div > <h3 style="line-height: 35px;text-align: center;background:#006097;"> <a class="text-white" href="#" onclick="chats();return false;">  Messaging <span id="ocounter"></span> </a> </h3>

	<br>
	
	<form>
		<input type="text" id="serchID" placeholder="Search..." style="width: 80%;margin-left:8%;" onkeyup="searchFriends();" name="">
	</form>	

	 </div>
	 <br>
	<div id="list">   
    <?php 
      foreach ($Chats as $key => $value) {

       ?>
      <?php if($value->read_status==0 && $value->uid1!=$userId){ ?>   
        <div class="chats1" style="background: #f5f5f5">
      <?php } else { ?>
        <div class="chats1">
      <?php } ?>

          <div style="width: 20%;float: left;">
            <img src="<?php echo $UdataArray[$key][0]->profile_pic; ?>" style="width: 60%;border-radius: 50%; margin: auto;display: block;" >
          </div>
          <div style="width: 80%;float: left;">
            <p> <a style="color: #555;" href="<?php echo base_url(); ?>Send/messenger/<?php echo $UdataArray[$key][0]->otp.$value->uid1; ?>/<?php echo $UdataArray[$key][0]->otp.$value->uid2; ?>"> <?php echo $UdataArray[$key][0]->name; ?>   </a> </p>
          <p style="line-height: 11px;color: #999;"> <small>
           <?php 

           if($value->uid1==$userId){ 
              echo "<i style='font-size: 9px' class='fa fa-reply'> </i> ";
           }
           if($value->read_status==0 && $value->uid1!=$userId){
            if($value->attachment!=""){
              echo "Attachment";
            }
            elseif (filter_var($value->message,FILTER_VALIDATE_URL)) {
              echo "Link";
            }
            echo "<b>".$value->message."</b>"; }
            else{
               echo $value->message;
            } ?> </small> </p>
          </div>
          <div class="cl"> </div>
        </div>  
     <?php }
    ?>
  </div>


</div>


<div id="loader"> 

    <div id="attach_content" >
      <button type="button" class="close" style="background: #fff; color: #000" onclick="removePrev();">&times;</button>
        <div id="atc_images"></div>

        <div id="atc_info">
         
          <label id="atc_title"></label>
          <label id="atc_url"></label>
        
          <label id="atc_desc"></label>
          <div class="cl"> </div>
        </div>
    </div>
</div>

<div style="position: fixed;
    bottom: 78px;
    right: 455px;
    height: 224px;
    width: 248px;
    background: rgba(0, 0, 0, 0.6);
    border: 1px solid rgb(204, 204, 204);
    display: none;
    z-index: 600;" id="preview">

  <div style="max-height: 200px; width: 240px;margin: 2px 0px;">
  <img id="output_image" src=""   style="margin: auto;opacity: 0.8;max-height:200px;display: block;max-width: 240px">
  
  </div>
    <input type="hidden" id="attFile">
   <p class="text-center" id="oup"> 
    
   </p>
  
</div>

  <div class="modal fade" id="imgModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Image Preview</h4>
        </div>
        <div class="modal-body">
          <div id="prev"> </div>
        </div>
       
      </div>
      
    </div>
  </div>

<audio id="notif_audio"><source src="<?php echo base_url() ?>sounds/notify.ogg" type="audio/ogg"><source src="<?php echo base_url() ?>sounds/notify.mp3" type="audio/mpeg"><source src="<?php echo base_url() ?>sounds/notify.wav" type="audio/wav"></audio>


<script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
<script type="text/javascript">

	 
   function oneonone(uid1, uid2, name, img){
     
     $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>Send/read",
            data: {uid1: uid1},
            success: function(){
               
                $(".tmsgsn").html('').css("display","none");
             
            }
     });
    $(".chat_title").html("Chat with "+name);
    $("#uid1").attr("value", uid1);
    $("#uid2").attr("value", uid2);
    $("#fimg").attr("value",'<?php echo $userData[0]->profile_pic; ?>');

    $.ajax({
      url: "<?php echo base_url(); ?>Send/messages",
      data: { uid1: uid1, uid2: uid2, img: img },
      type: "POST",
      success: function(response){
            
            $("#cbox").html(response);
      } 
    });
  
  }


  $('#txtSearchProdAssign').click(function () {
     
      var ipstring=$('#txtSearchProdAssign').val(); 
      
      $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>Send/read",
            data: {uid1: $("#uid1").val()},
            success: function(){
              
              $(".tmsgsn").html('').css("display","none");
            }
     });
    
    });

  $('#txtSearchProdAssign').on("keyup keypress paste", function (e) {
    
    var bool=isValidURL(ipstring); 
    if(bool){
      console.log(bool);
      generatePreview(ipstring);
    }    
   
    });

  $(document).ready(function(){
      
    $('#sendMsg').click(function (e) {
        var ipstring=$('#txtSearchProdAssign').val(); 
        $("#attach_content").css("display","none");
        $("#txtSearchProdAssign").val("");
        if(ipstring.length > 0){

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>Send/submit",
            data: {message : ipstring, uid1: $("#uid1").val(), uid2: $("#uid2").val(),imgUrl:$("#imgUrl").val(),post_title:$("#post_title_ln").val(),short_des:$("#short_des_link").val()  },
            success: function(data){
          
               
                data=$.parseJSON(data);

              if(data.success==true){

                var socket = io.connect( 'http://'+window.location.hostname+':3000', { rememberTransport: false, transports: ['WebSocket', 'Flash Socket', 'AJAX long-polling'] } );
                socket.emit('new_count_message', { 
                  new_count_message: data.new_count_message,
                  sid: data.sid
                });
                socket.emit('new_message', {
                   message: data.message,
                   uid1: data.uid1,
                   uid2: data.uid2,
                   fimg: $("#fimg").val(),
                   imgUrl:$("#imgUrl").val(),
                   post_title:$("#post_title_ln").val(),
                   short_des:$("#short_des_link").val()
                });

              }

               else if(data.success == false){
                // alert("Sorry!You can't send message"); 
                $("#msgAlert").modal("show");
              }

              else if(data.success == false){
                $("#txtSearchProdAssign").val(data.message);
                }
              document.getElementById('cbox').scrollTop = document.getElementById('cbox').scrollHeight-50;
            } ,error: function(xhr, status, error) {
              // alert(error);
            },

        });
    }
      else{
            return false;

      }
     
    });
    var files;
    $("#file-input").on("change", attachFile);

    function attachFile(input) {
        if (input.target.files && input.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            $("#preview").css("display", "block"); 
            $('#output_image').attr('src', e.target.result);
          }
            
            reader.readAsDataURL(input.target.files[0]);
            files= input.target.files;
              
              var data = new FormData();
              $.each(files, function(key, value)
              {
                  data.append(key, value);
              });
              
             
              $.ajax({
              url: '<?php echo base_url(); ?>Send/fileupload/',
              type: 'POST',
              data: data,
              cache: false,
              dataType: 'json',
              processData: false, 
              contentType: false,  
                beforeSend: function(response){
                $("#oup").html('<img src="<?php echo base_url(); ?>assets/img/load.gif" alt="Loading" />');
              },
            
              success: function(response)
              { 
                var img=response.img;
                $("#oup").html('<a class="text-white" href="#" onclick="cancelAtt()"> Cancel </a> &nbsp;&nbsp;&nbsp; <button style="border: none; background: none;color: white;" class="text-white"  onclick="Send(\''+img+'\')"> Send  </button>')
              }
    });


            
        }
    }

});

    function generatePreview(ipstring){
       $('#atc_loading').show();
       
        $.ajax({

              url: "<?php echo base_url(); ?>Post/fetchPreview/",
              data: { url: ipstring },
              type: "post",
              success:  function(response){
               
                $('#atc_loading').hide();
                $('#atc_title').html(response.title);
                response.description=response.description.substring(0, 90);
                $('#atc_desc').html(response.description);
                $('#atc_total_images').html(response.total_images);
                $('#atc_images').html(' ');
                  
                   if(response.images[0].attributes)
                     {  imgUrl=response.images[0].attributes.src; 
                        chkImg=checkURL(imgUrl)
                        if(chkImg!=1){
                          if(response.images[1].attributes){
                           imgUrl=response.images[1].attributes.src; 
                           chkImg=checkURL(imgUrl)
                             if(chkImg!=1){
                              if(response.images[2].attributes){
                                 imgUrl=response.images[2].attributes.src; 
                                 chkImg=checkURL(imgUrl)
                                 if(chkImg!=1){
                                  if(response.images[3].attributes){
                                     imgUrl=response.images[3].attributes.src; 
                                        chkImg=checkURL(imgUrl)
                                       if(chkImg!=1){
                                        if(response.images[3].attributes){
                                           imgUrl=response.images[3].attributes.src; 
                                } 
                              }
                                } 
                              }
                            } 
                          }


                          }
                        }

                     }

                    
                   else
                      { imgUrl=response.images; }

                    
                  var RegExp = /\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                    
                  var str = imgUrl.split("?");
                  imgUrl = str[0];

                  if(RegExp.test(imgUrl)){
                      var x=1;
                  }
                  else { x=0; }

                   chkImg=checkURL(imgUrl);

                  if(chkImg==1){
                      x=1;
                  }
                  else{
                     x=0;
                  }

                  if (x==1)
                  {
                 
                    
                      $('#atc_images').append('<img src="'+imgUrl+'" width="100%" id="">');
                      $("#prevImg").attr("src", imgUrl);
                        imgUrl=imgUrl.replace(/%2F/gi, "-2F");
                        $("#imgs").attr("value", imgUrl); 
                         
                  }

                 
                  $("#imgUrl").attr("value",imgUrl);
                  $("#post_title_ln").attr("value", response.title );
                  $("#short_des_link").attr("value", response.description );    
                  $("#attach_content").show();
                       
            }
         
      });
      }
   
    

    function checkURL(url) {
      if(url.match(/\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?.(jpeg|jpg|gif|png)$/) != null){
        return 1;
      }
      else{
        return 0;
      }
    }

  function Send(img){
     var uid2=$("#uid2").val();

     $.ajax({
       url: "<?php echo base_url(); ?>Send/SendFile",
       data: {uid2: uid2, img: img},
       type: "POST",
       success: function(response){
          var socket = io.connect( 'http://'+window.location.hostname+':3000' );
            document.getElementById('cbox').scrollTop = document.getElementById('cbox').scrollHeight;
                socket.emit('send_attachment', { 
                  attachment: img,
                  uid1: <?php echo $userId; ?>,
                  fimg: $("#fimg").val()
                });
            $("#preview").css("display", "none");
          
       }
     })
  }

  function cancelAtt(){
    $("#preview").css("display", "none");
    $("#output_image").attr("src", "");
  }
  
  function isValidURL(url)
  {
    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    
    if(RegExp.test(url)){
      return true;
    }else{
      return false;
    }
  }

   var socket = io.connect('http://'+window.location.hostname+':3000');
    
  socket.on('new_count_message', function( data ) {
        if(data.sid==<?php echo $userId; ?>){ 
        $( ".tmsgsn" ).html( data.new_count_message ).css("display", "block");
        $('#notif_audio')[0].play();
        }
      

  });

  socket.on( 'update_count_message', function( data ) {
     
      $( "#new_count_message" ).html( data.update_count_message );
    
  });

  socket.on('new_message', function( data ) {
     
      var uid1=data.uid1;
      var uid2=data.uid2;
      var img= data.fimg;
      var imgUrl=data.imgUrl;
      var post_title=data.post_title;
      var short_des=data.short_des;
      var mdata='';
      var ldata='';
      
      if(isValidURL(data.message)){
           data.message=data.message.replace(/\s/g,'') 
           msg='<a href="'+data.message+'" target="_blank" > '+data.message+' </a>';
        }
        else{
          msg=data.message;
        }

      
        
      if(uid1==<?php echo $userId; ?>){
       if(post_title){
        ldata='<span style="display: inline-block;float: left;max-width: 100%;border-radius: 8px;background: #f5f5f5;float: right; padding: 0px 6px;word-wrap: break-word;margin-top: 3px;">          <img src="'+imgUrl+'" width="20%" valign="top" >           <span style="width: 50%;font-size: 12px;"><b> '+post_title.substring(0,20)+' </b>          </span>           <p> '+short_des.substring(0,50)+' </p>           </span> ';
      } 
        mdata+= '<div style="margin-right: 10px;margin-top: 3px; width: 70%;float: right;text-align: right;font-size: 13px; color: #333"> <span style="display: inline-block;float: left;max-width: 90%;border-radius: 8px;background: #f5f5f5;float: right; padding: 0px 6px;word-wrap: break-word;"> '+msg+' </span> '+ldata+' </div>';

      }
      else{
        
        if(post_title){
        ldata='<span style="display: inline-block;float: left;max-width: 100%;border-radius: 8px;background: #e1eaf3;float: right; padding: 0px 6px;word-wrap: break-word;margin-top: 3px;">          <img src="'+imgUrl+'" width="20%" valign="top" >           <span style="width: 50%;font-size: 12px;"><b> '+post_title+' </b>          </span>           <p> '+short_des+' </p>           </span> ';
      } 
        mdata+= '<div style="margin-left: 10px;margin-top: 3px; width: 70%;float: left;font-size: 13px; color: #333">              <span style="display: inline-block;float: left;width: 11%;">  <img src="<?php echo base_url() ?>'+img+'" valign="bottom" width="100%" style="border-radius: 50px;"  > </span>              <span style="display: inline-block;float: left;max-width: 79%;border-radius: 8px;background: #e1eaf3; padding: 0px 6px; margin-left: 5px;word-wrap: break-word;"> '+msg+' </span>     '+ldata+'     </div>';
      }
    
      $("#cbox").append(mdata);
        document.getElementById('cbox').scrollTop = document.getElementById('cbox').scrollHeight;
  });

  socket.on('send_attachment', function( data ) {
      var uid1=data.uid1;
      var attachment=data.attachment;
      var img= data.fimg
      var mdata;
      mdata='';
      if(uid1==<?php echo $userId; ?>){
      
        mdata+= '<div style="margin-right: 10px;margin-top: 3px; width: 70%;float: right;text-align: right;font-size: 13px; color: #333"> <a href="#" onclick="imgModal(\''+data.attachment+'\')" > <img src="<?php echo base_url(); ?>../attachments/'+data.attachment+'" width="25%"> </a>    </div>';

      }
      else{
          
        mdata+= '<div style="margin-left: 10px;margin-top: 3px; width: 70%;float: left;font-size: 13px; color: #333">              <span style="display: inline-block;float: left;width: 11%;">  <img src="<?php echo base_url() ?>'+img+'" valign="bottom" width="100%" style="border-radius: 50px;"  > </span>        <a href="#" onclick="imgModal(\''+data.attachment+'\')" >     <img src="<?php echo base_url(); ?>../attachments/'+data.attachment+'" width="25%">  </a>        </div>';
      }
    
      $("#cbox").append(mdata);
        document.getElementById('cbox').scrollTop = document.getElementById('cbox').scrollHeight-50;
});


  function imgModal(img){

    var newheight = $(window).height()*0.8;   
    $("#prev").css("height",newheight);
    $("#prev").html("<img src='<?php echo base_url(); ?>"+img+"' >")
    $("#imgModal").modal("show");
  }
   
  function removePrev(){
    $("#txtSearchProdAssign").val("");
    $("#attach_content").css("display", "none");
  }   

  function searchFriends(){
    $.ajax({
      url: "<?php echo base_url(); ?>Send/searchFriends",
      type: "post",
      data: {nm: $("#serchID").val() },
      beforeSend: function(){
          $("#list").html("<p class='text-center'>Searching...</p>");
      },
      success:function(response){

          $("#list").html(response);
      }
    });
  }

</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">


#prev{
   width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    background: #000;
}

#prev img{
  flex-shrink:0;
    -webkit-flex-shrink: 0;
    max-width:50%;
    max-height:70%;
}

.chats1:last-child {
    border-bottom:1px solid #ccc;
}

.chats1{
  width: 99%; float: left; 
  border: 1px solid #ccc;  
  border-bottom:none; 
  padding-bottom: 10px;
}

.image-upload > input
{
    display: none;
}

.image-upload img
{
    display: inline-block;
    width: 20px;
    height: 20px;
    cursor: pointer;
}


#attach_content {
    border: 1px solid #ccc;
    padding: 0px;
    padding-top: 5px;
    position: fixed;
    bottom: 77px;
    right: 457px;
    width: 545px;
    margin-top: 10px;
    z-index: 700;
    float: left;
    background: #fff;
    display: none;
}

#atc_images {overflow:hidden;float:left; width: 100px;padding: 0px;margin-right: 10px;margin-left: 3px;margin-top: 5px;}

#atc_info {
    width: 410px;
    float: left;
    text-align: left;
}
  #atc_title {font-size:12px;display:block;}
  #atc_url {font-size:10px;display:block;}
  #atc_desc {font-size:10px;}
  #atc_total_image_nav{float:left;padding-left:0px}
  #atc_total_images_info{float:left;padding:0 0px;font-size:12px;}
</style>



