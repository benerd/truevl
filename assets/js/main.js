function tabs(evt, tabName) {
    
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");

    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

   
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

  
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}


var res=true;
function check_form(){

    var x=document.getElementById("user_form");
    var y=document.getElementsByTagName("input");
    var y1=document.getElementsByTagName("select");
    var y2=document.getElementsByTagName("input");
      
   
    for (i = 0; i < y.length; i++) {
 
    if (y[i].value == "") {
     
      y[i].style.backgroundColor += "#ffdddd";
          
      valid = false;
      
    }

    else{
            y[i].style.backgroundColor += "#fff";
    }
  } 

  for (i = 0; i < y1.length; i++) {
            
    if (y1[i].selectedIndex  ==0) {
      
      y1[i].style.backgroundColor = "#ffdddd";
      
      valid = false;
     
    }
     else{
            y1[i].style.backgroundColor += "#fff";
    }
  }
for (i = 0; i < y2.length; i++) {
        
    if (y2[i].value == "") {
            y2[i].style.backgroundColor = "#ffdddd";
          valid = false;
       
    }

     else{
            y2[i].style.backgroundColor= "#fff";
    }
  }
    
    
    return valid;
}

function check_email(){
    
    var email=document.getElementById("email").value;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var t= re.test(String(email).toLowerCase());

    if(t==false){
        $( '#emailW' ).html("Invalid email");
        return false;
    }

    else{
     if(email)
    {
      $( '#emailW' ).html("");
        $.ajax({
        type: 'post',
        url: 'http://truevl.com/test/Users/check_email',
        data: {
            user_email:email
        },
         
        success: function (response) {
        
        if(response==0)
        {
             console.log(response);
             $( '#emailW' ).html("email already exist");

              return false;
        }
        else{
          $( '#emailW' ).html("");
              return true;   
        }
        
        }
        });
    }
    }
}



function check_mobile(){


    var mob=document.getElementById("mob").value;

     if(mob)
    {
        $.ajax({
        type: 'post',
        url: 'check_mob',
        data: {
            user_mob:mob
        },
        success: function (response) {
        
        if(response==0)   
        {
            $('#genderW' ).html("Mobile number already exist");
            res= false;
           
        }
        else
        {
          $('#genderW' ).html("");
        }
        }
        });
    }
    
}

