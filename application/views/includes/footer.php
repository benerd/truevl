<div id="loadera"> 
    <div id="attach_content" >
        <button type="button" class="close" style="background: #fff; color: #000" onclick="removePrev();">&times;</button>
        <div id="atc_imagesa"></div>

        <div id="atc_infoa">
         
          <label id="atc_titlea"></label>
          <label id="atc_urla"></label>
        
          <label id="atc_desca"></label>
          <div class="cl"> </div>
        </div> 
    </div>
</div>
  
 
<div style="position:fixed;bottom:40px;right: 437px; height: 224px;width: 248px;background: rgba(0,0,0,0.6);border:1px solid #ccc;display: none;z-index: 600" id="preview">
  <div style="max-height: 200px; width: 240px;margin: 2px 0px;">
  <img id="output_image" src=""   style="margin: auto;opacity: 0.8;max-height:200px;display: block;max-width: 240px">
  
  </div> 
    <input type="hidden" id="attFile">
   <p class="text-center" id="oup"> 
    
   </p>
  
</div>
  <audio id="notif_audio"><source src="<?php echo base_url() ?>sounds/notify.ogg" type="audio/ogg"><source src="<?php echo base_url() ?>sounds/notify.mp3" type="audio/mpeg"><source src="<?php echo base_url() ?>sounds/notify.wav" type="audio/wav"></audio>

<div style="position:fixed;bottom:0px;right: 437px; height: 333px;width: 250px;z-index: 500;background: #fff;border:1px solid #ccc;display: none;" id="chatBox" >

<div class="chat_header" style="width: 100%; line-height: 35px;text-align: center;background:#006097;" >
	<a class="text-white"  href="#">  
    <span class="chat_title"></span>
   </a> 
	<span class="pull-right"> 
 
		
	

    <a href="#" style="text-decoration: none;" onclick="closechat()" class="text-white" > X &nbsp; </a> </span>	 
</div>

<div class="cbox" id="cbox" style="">

</div>

<input type="hidden" id="uid1" value="">
<input type="hidden" id="uid2" value="">
<input type="hidden" id="fimg">
<input type="hidden" id="imgUrl" name="">
<input type="hidden" id="post_title_ln" name="">
<input type="hidden" id="short_des_link" name="">
  <div align="center" id="atc_loadinga" style="display:none"><img src="<?php echo base_url(); ?>assets/img/load.gif" alt="Loading" /></div>

<div style="width:250px;position:fixed;bottom: 0px">
<textarea placeholder="Type your message here" id="txtSearchProdAssign" ></textarea>

<hr>

<form action="#" enctype="multipart/form-data" id="attachForm" style="display: inline-block;">
   <span class="image-upload">
    <label for="file-input">
         <img src="<?php echo base_url(); ?>assets/img/attach.png" height="16px" width="16px" valign="middle" > 
    </label>
    <input id="file-input" accept="image/*" type="file"/>
    </span>
</form>
    <button id="sendChat" class="btn-primary pull-right" style="margin-right: 5px;">  Send </button>
</div>
</div>


<div style="position:fixed;bottom:0px;right: 152px; height: 35px;width: 278px;z-index: 500;background: #fff;border:1px solid #ccc;" id="contacts" > 
	<h3 style="line-height: 35px;text-align: center;background:#006097;"> <a class="text-white"  href="#" onclick="chats();return false;">  Chat <span id="ocounter"></span> </a> </h3>
  <div style="margin-top: 5px;margin-bottom: 5px;">  
    <form>
    <input type="text" id="serchID" placeholder="Search..." style="width: 80%;margin-left:8%;height: 25px;" onkeyup="searchFriends();" name="">
  </form> 
  </div>
	<div id="list">
	</div>	
</div>

<div class="modal" data-backdrop="true" id="msgAlert" role="dialog" style="width: 20%;margin: 150px auto; ">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style=" border-radius: 0px;">
        <div class="modal-header" style="margin: 0px; padding: 0px;width: 46%;">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="padding-left: 10px" >Alert</h4>
        </div>
        <div class="modal-body" style="width: 100%; padding: 0px; background-color: #fff; font-size: 14px; padding-bottom: 0;">
            <p class="" style="padding: 20px 5px;"> 
            &nbsp;&nbsp; Sorry You cant send message right now </p>
        </div>
      </div>
    </div>
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

<div id="blockModal"> </div>

<script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>

<script type="text/javascript">
    function chats(){
    getOnlineUsers();
    var height=$("#contacts").height();
    if(height==35){
    $("#contacts").css({"height": "333px"});
    }
    else if(height==333){
      $("#contacts").css({"height": "35px"});
    }
    
  }

  function oneonone(uid1,uid2,name,otp,img){ 
    var nm=name.replace(" ", "-");
    $("#preview").hide();
    $("#attach_content").hide();
     $('.cbox').scrollTop($('.cbox')[0].scrollHeight);
     $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>Send/read",
            data: {uid1: uid1},
            success: function(){
               
                $(".tmsgsn").html('').css("display","none");
             
            }
     });
    $(".chat_title").html("Chat with <a style='color: #fff;display: inline;' href='<?php echo base_url(); ?>tuser/"+otp+uid2+"/"+nm+"'>"+name+"</a>");
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
    $("#chatBox").show();
  }

  function closechat(){
      $("#chatBox").hide();
      $("#preview").hide();
      $("#attach_content").hide();
      $("#contacts").show();
  }

  function getOnlineUsers(){
    $.ajax({
        url: "<?php echo base_url(); ?>users/getOnlineUsers/2",
        type: "POST",
        data: {},
        success: function(response){
          
          $("#list").html(response);
        }
  });
  }
   
  $(document).ready(function(){

    $('#txtSearchProdAssign').click(function () {
         
      $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>Send/read",
            data: {uid1: $("#uid1").val()},
            success: function(){
              
              $(".tmsgsn").html('').css("display","none");
            }
     });
   });


    $('#txtSearchProdAssign').on("input keypress",function (e) {
     
      var ipstring=$('#txtSearchProdAssign').val(); 
    
    var bool=isValidURL(ipstring); 
    if(bool){
      
      generatePreview(ipstring);
    }    
   
  });


    $("#sendChat").click(function(){  
        var ipstring=$('#txtSearchProdAssign').val(); 


        $("#attach_content").css("display","none");
        $("#txtSearchProdAssign").val("");
        var uid1=$("#uid1").val();
        var uid2=$("#uid2").val();
        var imgUrl=$("#imgUrl").val();
        var post_title=$("#post_title_ln").val();
        var short_des=$("#short_des_link").val();

        if(ipstring.length > 0){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>Send/submit",
            data: {message : ipstring, uid1: uid1, uid2: uid2,imgUrl:imgUrl,post_title:post_title,short_des: short_des },

            
            success: function(response){
                
                if(response=="block"){
                $("#blockModal").html(' <div class="modal fade" id="blckModal" role="dialog">    <div class="modal-dialog modal-sm">          <!-- Modal content-->      <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title">Oops</h4>        </div>        <div class="modal-body">          <p>sorry you cannot sent messages to this person</p>        </div>          </div>          </div>  </div>  </div>');
                
                $("#blckModal").modal("show");
                }  
                else{
                response=$.parseJSON(response);
              
              if(response.success==true){

                var socket = io.connect( 'http://'+window.location.hostname+':3000', { rememberTransport: false, transports: ['WebSocket', 'Flash Socket', 'AJAX long-polling'] } );
                socket.emit('new_count_message', { 
                  new_count_message: response.new_count_message,
                  sid: response.sid
                });
                socket.emit('new_message', {
                   message: response.message,
                   uid1: response.uid1,
                   uid2: response.uid2,
                   fimg: $("#fimg").val(),
                   imgUrl:$("#imgUrl").val(),
                   post_title:$("#post_title_ln").val(),
                   short_des:$("#short_des_link").val()
                });

              }

               else if(response.success == false){
                // alert("Sorry!You can't send message"); 
                $("#msgAlert").modal("show");
              }

              else if(response.success == false){
                $("#txtSearchProdAssign").val(response.message);
                }
              document.getElementById('cbox').scrollTop = document.getElementById('cbox').scrollHeight-50;
            }
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
                $("#oup").html('<a class="text-white" href="#" onclick="cancelAtt()" style="color: #fff !important; "> Cancel </a> &nbsp;&nbsp;&nbsp; <a class="text-white" href="#" onclick="Send(\''+img+'\')" style="color: #fff !important; "> Send  </a>')
              }
    });


            
        }
    }

});

    function generatePreview(ipstring){
       $('#atc_loadinga').show();
       
        $.ajax({

              url: "<?php echo base_url(); ?>Post/fetchPreview/",
              data: { url: ipstring },
              type: "post",
              success:  function(response){
               
                $('#atc_loadinga').hide();
                $('#atc_titlea').html(response.title);
                response.description=response.description.substring(0, 90);
                $('#atc_desca').html(response.description);
                $('#atc_total_images').html(response.total_images);
                $('#atc_imagesa').html(' ');
                  
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
                 
                    
                      $('#atc_imagesa').append('<img src="'+imgUrl+'" width="100%" id="">');
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
      
        mdata+= '<div style="margin-right: 10px;margin-top: 3px; width: 70%;float: right;text-align: right;font-size: 13px; color: #333"> <a href="#" onclick="imgModal(\''+data.attachment+'\')" >  <img src="../attachments/'+data.attachment+'" width="25%"> </a>    </div>';

      }
      else{
         
        mdata+= '<div style="margin-left: 10px;margin-top: 3px; width: 70%;float: left;font-size: 13px; color: #333">              <span style="display: inline-block;float: left;width: 11%;">  <img src="<?php echo base_url() ?>'+img+'" valign="bottom" width="100%" style="border-radius: 50px;"  > </span>    <a href="#" onclick="imgModal(\''+data.attachment+'\')" >          <img src="<?php echo base_url(); ?>../attachments/'+data.attachment+'" width="25%">  </a>        </div>';
      }
    
      $("#cbox").append(mdata);
        
});

 function removePrev(){
    $("#txtSearchProdAssign").val("");
    $("#attach_content").css("display", "none");
  }   
 
  function imgModal(img){
    var newheight = $(window).height()*0.8;   
    $("#prev").css("height",newheight);
    $("#prev").html("<img src='<?php echo base_url(); ?>"+img+"' >")
    $("#imgModal").modal("show");
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

.cbox{
  height: 210px;overflow-y:scroll;overflow-x: hidden;position: relative;  
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


  #attach_content{border:1px solid #ccc;padding:0px;padding-top:5px;position:fixed;bottom:40px;right: 437px; width: 248px;margin-top: 10px;
    z-index: 700;float: left;background: #fff;display: none;
  }
  #atc_imagesa {overflow:hidden;float:left; width: 35px;padding: 0px;margin-right: 10px;margin-left: 3px;margin-top: 5px;}
  #atc_infoa {width:200px;float:left;text-align:left;}
  #atc_titlea {font-size:12px;display:block;}
  #atc_urla {font-size:10px;display:block;}
  #atc_desca {font-size:10px;}
  #atc_total_image_nav{float:left;padding-left:0px}
  #atc_total_images_info{float:left;padding:0 0px;font-size:12px;}
</style>



