/************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#img_slider").easySlider({
        vertical: false,
speed: 800,
//auto: false,
pause: 2000
    //auto: true, 
    //continuous: true,
    //effect: 'fade',
    //fadeOutSpeed: 2000,
    //fadeInSpeed: 2000,
    //autoplayDuration: 500,
   // autogeneratePagination: true
    });
   $('#Indivpasswordclear').show();
    $('#Indivpassword').hide();
    $('#Indivpasswordclear').focus(function() {
        $('#Indivpasswordclear').hide();
        $('#Indivpassword').show();
        $('#Indivpassword').focus();
    });
    $('#Indivpassword').blur(function() {
        if($('#Indivpassword').val() == '') {
        $('#Indivpasswordclear').show();
        $('#Indivpassword').hide();
    }
    });

    $('#Indivcnfrmpasswordclear').show();
    $('#Indivcnfrmpassword').hide();
    $('#Indivcnfrmpasswordclear').focus(function() {
        $('#Indivcnfrmpasswordclear').hide();
        $('#Indivcnfrmpassword').show();
        $('#Indivcnfrmpassword').focus();
    });
    $('#Indivcnfrmpassword').blur(function() {
        if($('#Indivcnfrmpassword').val() == '') {
        $('#Indivcnfrmpasswordclear').show();
        $('#Indivcnfrmpassword').hide();
    }
    });

    $('#Indivnameclear').show();
    $('#Indivnametext').hide();
    $('#Indivnameclear').focus(function() {
        $('#Indivnameclear').hide();
        $('#Indivnametext').show();
        $('#Indivnametext').focus();
    });
    $('#Indivnametext').blur(function() {
        if($('#Indivnametext').val() == '') {
        $('#Indivnameclear').show();
        $('#Indivnametext').hide();
    }
    });
    $('#Indivmailidclear').show();
    $('#Indivmailidtext').hide();
    $('#Indivmailidclear').focus(function() {
        $('#Indivmailidclear').hide();
        $('#Indivmailidtext').show();
        $('#Indivmailidtext').focus();
    });
    $('#Indivmailidtext').blur(function() {
        if($('#Indivmailidtext').val() == '') {
        $('#Indivmailidclear').show();
        $('#Indivmailidtext').hide();
    }
    });
    $('#Indivfullnameclear').show();
    $('#Indivfullnametext').hide();
    $('#Indivfullnameclear').focus(function() {
        $('#Indivfullnameclear').hide();
        $('#Indivfullnametext').show();
        $('#Indivfullnametext').focus();
    });
    $('#Indivfullnametext').blur(function() {
        if($('#Indivfullnametext').val() == '') {
        $('#Indivfullnameclear').show();
        $('#Indivfullnametext').hide();
    }
    });
    $('#Indivmobnoclear').show();
    $('#Indivmobnotext').hide();
    $('#Indivmobnoclear').focus(function() {
        $('#Indivmobnoclear').hide();
        $('#Indivmobnotext').show();
        $('#Indivmobnotext').focus();
    });
    $('#Indivmobnotext').blur(function() {
        if($('#Indivmobnotext').val() == '') {
        $('#Indivmobnoclear').show();
        $('#Indivmobnotext').hide();
    }
    });
    $('#passwordclear').show();
    $('#password').hide();
    $('#passwordclear').focus(function() {
        $('#passwordclear').hide();
        $('#password').show();
        $('#password').focus();
    });
    $('#password').blur(function() {
        if($('#password').val() == '') {
        $('#passwordclear').show();
        $('#password').hide();
    }
    });

    $('#cnfrmpasswordclear').show();
    $('#cnfrmpassword').hide();
    $('#cnfrmpasswordclear').focus(function() {
        $('#cnfrmpasswordclear').hide();
        $('#cnfrmpassword').show();
        $('#cnfrmpassword').focus();
    });
    $('#cnfrmpassword').blur(function() {
        if($('#cnfrmpassword').val() == '') {
        $('#cnfrmpasswordclear').show();
        $('#cnfrmpassword').hide();
    }
    });

    $('#nameclear').show();
    $('#nametext').hide();
    $('#nameclear').focus(function() {
        $('#nameclear').hide();
        $('#nametext').show();
        $('#nametext').focus();
    });
    $('#nametext').blur(function() {
        if($('#nametext').val() == '') {
        $('#nameclear').show();
        $('#nametext').hide();
    }
    });
    $('#mailidclear').show();
    $('#mailidtext').hide();
    $('#mailidclear').focus(function() {
        $('#mailidclear').hide();
        $('#mailidtext').show();
        $('#mailidtext').focus();
    });
    $('#mailidtext').blur(function() {
        if($('#mailidtext').val() == '') {
        $('#mailidclear').show();
        $('#mailidtext').hide();
    }
    });
    $('#fullnameclear').show();
    $('#fullnametext').hide();
    $('#fullnameclear').focus(function() {
        $('#fullnameclear').hide();
        $('#fullnametext').show();
        $('#fullnametext').focus();
    });
    $('#fullnametext').blur(function() {
        if($('#fullnametext').val() == '') {
        $('#fullnameclear').show();
        $('#fullnametext').hide();
    }
    });
    $('#mobnoclear').show();
    $('#mobnotext').hide();
    $('#mobnoclear').focus(function() {
        $('#mobnoclear').hide();
        $('#mobnotext').show();
        $('#mobnotext').focus();
    });
    $('#mobnotext').blur(function() {
        if($('#mobnotext').val() == '') {
        $('#mobnoclear').show();
        $('#mobnotext').hide();
    }
    });

    $('#schnameclear').show();
    $('#schnametext').hide();
    $('#schnameclear').focus(function() {
        $('#schnameclear').hide();
        $('#schnametext').show();
        $('#schnametext').focus();
    });
    $('#schnametext').blur(function() {
        if($('#schnametext').val() == '') {
        $('#schnameclear').show();
        $('#schnametext').hide();
    }
    });
     $('#schaddclear').show();
    $('#schaddtext').hide();
    $('#schaddclear').focus(function() {
        $('#schaddclear').hide();
        $('#schaddtext').show();
        $('#schaddtext').focus();
    });
    $('#schaddtext').blur(function() {
        if($('#schaddtext').val() == '') {
        $('#schaddclear').show();
        $('#schaddtext').hide();
    }
    });
     $('#schcityclear').show();
    $('#schcitytext').hide();
    $('#schcityclear').focus(function() {
        $('#schcityclear').hide();
        $('#schcitytext').show();
        $('#schcitytext').focus();
    });
    $('#schcitytext').blur(function() {
        if($('#schcitytext').val() == '') {
        $('#schcityclear').show();
        $('#schcitytext').hide();
    }
    });

    $('#schstatetext').show();
     $('#schphclear').show();
    $('#schphtext').hide();
    $('#schphclear').focus(function() {
        $('#schphclear').hide();
        $('#schphtext').show();
        $('#schphtext').focus();
    });
    $('#schphtext').blur(function() {
        if($('#schphtext').val() == '') {
        $('#schphclear').show();
        $('#schphtext').hide();
    }
    
    });

 $("#logincls").click( function()
 {
    document.getElementById("logmsg").innerHTML = "";
    document.getElementById('login_name').value="Email / Username";
 });
 
$("#forgotpwdcls").click( function()
{
    //alert("saddsa");
    document.getElementById("formsg").innerHTML = "";
    document.getElementById('forgot_email').value="Email Address";
    document.getElementById('lightone').style.display='none';
    document.getElementById('light').style.display='none';
    document.getElementById('fadeone').style.display='none';
    document.getElementById('fadeone').style.display='none';
    window.location.reload();
});


$("#step1cancel").click( function()
 {
   
    document.getElementById("step1errormsg").innerHTML="";
   // $("#selopt").attr("checked" , false );
    if ($('input[name=selopt]').is(':checked'))
    {
       $('input[name=selopt]').attr('checked', false);
    }
 });
 
 $("#step1cls").click( function()
 {
    document.getElementById("step1errormsg").innerHTML="";
   // $("#selopt").attr("checked" , false );
    if ($('input[name=selopt]').is(':checked'))
    {
       $('input[name=selopt]').attr('checked', false);
    }
 });
 
 
});	
/* forgot password validation*/
function forgot_check()
{
   
 var forgot_email  = $.trim($('#forgot_email').val());
 if(forgot_email.search(/\S/) == -1 || forgot_email == "Email Address")
    {
     
        document.getElementById("forgotpwderrmsg").innerHTML = "Sorry! Please enter a valid email address";
        document.getElementById('forgot_email').focus();
        return false;
    }
    else if((/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z.]{2,5}$/).exec(forgot_email)== null)
    {
        
        document.getElementById("forgotpwderrmsg").innerHTML = "Sorry! Please enter a valid email address";
        document.getElementById('forgot_email').focus();
        return false;
    }
    else
    {
       //alert("chk");
       /* xmlhttp=GetXmlHttpObject();
        if (xmlhttp==null)
        {
            alert ("Your browser does not support XMLHTTP!");
            return;
        }*/
        //alert("chk1");
       /* var url="forgot_submit.php";
        url=url+"?femail="+forgot_email;		
        url=url+"&sid="+Math.random();
        alert(url);*/
        var dataString = "forgot_email="+$('#forgot_email').attr('value');
        //alert(dataString);
        $.ajax({
	type: "POST",
	url: "forgot_submit.php",
	data: dataString,
	success: function(data){
              if (data=="Sorry ! Please check your Email ID")
                {
                    document.getElementById("formsg").innerHTML = "Sorry!Please enter a valid email address";
                }
                else
                    {
                      //document.getElementById("forgot_email").value="Email Address";
                      document.getElementById('lightone').style.display='none';
                      document.getElementById('light').style.display='none';
                      document.getElementById('lightpwdsucessmsg').style.display='block';
                    }
        }
       });
        /*xmlhttp.onreadystatechange=stateChanged2;
        xmlhttp.open("GET",url,true);
        xmlhttp.send(null);*/
         //document.getElementById("forgotpwdfrm").submit();
        return true;
    }
    
}
function clearforgotpwd()
{
     document.getElementById("forgotpwderrmsg").innerHTML ="";
     document.getElementById("forgot_email").value="Email Address";
}
/* forgot password state changed*/
function stateChanged2()
{
    if (xmlhttp.readyState==4)
    {
        var res_text = xmlhttp.responseText;
        //alert(res_text);
        var cmpword="success";
        var matchPos1 = res_text.search(cmpword);
        if(matchPos1 != -1)
        {
         document.getElementById("formsg").innerHTML="Please check your email and get the password.Please check your Inbox and spam.";
        }
        else
        {
            var err1="impropermailid";
            var matchPos2 = res_text.search(err1);
            if(matchPos2 != -1)
            {
             document.getElementById("formsg").innerHTML="Sorry!Please enter a valid email address";
            }
            
            var err2="techprob";
            var matchPos3 = res_text.search(err2);
            if(matchPos3 != -1)
            {
             document.getElementById("formsg").innerHTML="Due to Technical Fault the mail could not be sent";
            }
       
        }
    }
}

function clearforgotpwd()
{
     document.getElementById('forgotpwderrmsg').innerHTML ="";
     document.getElementById('forgot_email').value= "Email Address";
}
function step1()
{
   
    if ($('input:radio[name=selopt]:checked').val()==1)
    {
        document.getElementById("step1errormsg").innerHTML ="";
        document.getElementById('selsite').value= "1";
        document.getElementById('lightregIndivstep2').style.display='block';
         document.getElementById('fade').style.display='block'; 
        document.getElementById("gsp").style.display="none";
        document.getElementById("gsplabel").style.display="none";
        document.getElementById("regbutton").style.display="inline";
        document.getElementById("regnextbut").style.display="none";
        document.getElementById("prebutton").style.display="inline";
        document.getElementById("myText").innerHTML ="Register as Individual";
        document.getElementById('closebut').style.display="none";
        document.getElementById('indvmsg').style.display="block";
        return false;
        
    }
    else if ($('input:radio[name=selopt]:checked').val()==2)
    {
        document.getElementById("step1errormsg").innerHTML ="";
        document.getElementById('selsite').value="2";
        document.getElementById('lightregstep2').style.display='block';
        document.getElementById('fade').style.display='block'; 
        document.getElementById("gsp").style.display="inline";
        document.getElementById("gsplabel").style.display="inline";
        document.getElementById("regnextbut").style.display="inline";
        document.getElementById("regbutton").style.display="none";
        document.getElementById("myText").innerHTML ="Register as School";
        document.getElementById("prebutton").style.display="inline";
        return false;
    }
    else
    {
    document.getElementById("step1errormsg").innerHTML = "Please select one of the option to register for SeasonWatch website.";
    return false;

    }
  
   
}

/* this function will clear all the inputs of regstep2 dialog*/
function Clearregstep2()
{
    document.getElementById("regerrmsg").innerHTML="";
    document.getElementById("step2errormsg").innerHTML="";
    document.getElementById("regmsg").innerHTML="";
    $('input:radio[name=selopt]:checked').value='0';
    document.getElementById('nametext').value="";
    document.getElementById('mailidtext').value="";
    document.getElementById('fullnametext').value="";
    document.getElementById('mobnotext').value="";
    document.getElementById('password').value="";
    document.getElementById('cnfrmpassword').value="";
    //clear all the textbox value
    $('#nametext').hide();
    $('#nameclear').show();
    $('#mailidtext').hide();
    $('#mailidclear').show();
    $('#fullnametext').hide();
    $('#fullnameclear').show();
    $('#mobnotext').hide();
    $('#mobnoclear').show();
    $('#password').hide();
    $('#passwordclear').show();
    $('#cnfrmpassword').hide();
    $('#cnfrmpasswordclear').show();
    
}

/* clears all the selction of the Reg Individual dialog*/
function clearIndivreg()
{
   
   document.getElementById("regerrmsg").innerHTML="";
   document.getElementById("step2errormsg").innerHTML="";
   document.getElementById("stepIndverrormsg").innerHTML="";
    //clear all the textbox value
    $("#selopt").attr("checked" , false );
    $('#Indivnametext').hide();
    $('#Indivmailidclear').show();
    $('#Indivmailidtext').hide();
    $('Indivmailidclear').show();
    $('#Indivfullnametext').hide();
    $('#Indivfullnameclear').show();
    $('#Indivmobnotext').hide();
    $('#Indivmobnoclear').show();
    $('#Indivpassword').hide();
    $('#Indivpasswordclear').show();
    $('#Indivcnfrmpassword').hide();
    $('#Indivcnfrmpasswordclear').show();
    document.getElementById('Indivnametext').value="";
    document.getElementById('Indivmailidtext').value="";
    document.getElementById('Indivfullnametext').value="";
    document.getElementById('Indivmobnotext').value="";
    document.getElementById('Indivpassword').value="";
    document.getElementById('Indivcnfrmpassword').value="";
   //window.location.reload();
}
function Clearregstep3()
{
   
    document.getElementById('schnametext').value="";
    if($('#schnametext').val() == '') {
       $('#schnameclear').show();
        $('#schnametext').hide();
    }
    document.getElementById('schaddtext').value="";
    if($('#schaddtext').val() == '') {
       
        $('#schaddclear').show();
        $('#schaddtext').hide();
    }
    document.getElementById('schcitytext').value="";
    if($('#schcitytext').val() == '') {
       
        $('#schcityclear').show();
        $('#schcitytext').hide();
    }
    document.getElementById('schphtext').value="";
    if($('#schphtext').val() == '') {
      
        $('#schphclear').show();
        $('#schphtext').hide();
    }
    document.getElementById('schstatetext').value="0";   
     document.getElementById('nametext').value="";   
    
    //clear step2
     document.getElementById('mailidtext').value="";
    if($('#mailidtext').val() == '') {
        
        $('#mailidclear').show();
        $('#mailidtext').hide();
    }
    document.getElementById('fullnametext').value="";
    if($('#fullnametext').val() == '') {
       
        $('#fullnameclear').show();
        $('#fullnametext').hide();
    }
    document.getElementById('mobnotext').value="";
    if($('#mobnotext').val() == '') {
        $('#mobnoclear').show();
        $('#mobnotext').hide();
    }
    document.getElementById('password').value="";
    if($('#password').val() == '') {
        $('#passwordclear').show();
        $('#password').hide();
    }
    document.getElementById('cnfrmpassword').value="";
    if($('#cnfrmpassword').val() == '') {
        $('#cnfrmpasswordclear').show();
        $('#cnfrmpassword').hide();
    }
  
    if ($('input[name=selopt]').is(':checked'))
    {
       $('input[name=selopt]').attr('checked', false);
    }
    
   document.getElementById('lightReg').style.display='none';
   document.getElementById('lightregstep2').style.display='none';
   document.getElementById('lightregstep3').style.display='none';
   document.getElementById('fade').style.display='none';
}

//To copy username same as emailId in school register*/
function mailidcopyusername()
{
    var mailID =$.trim($('#mailidtext').val());
    document.getElementById("nametext").value=mailID;
}
//To copy username same as emailId in Individual register*/
function Indivmailidcopyusername()
{
    var mailID =$.trim($('#Indivmailidtext').val());
    document.getElementById("Indivnametext").value=mailID;
}
function RegisterAsSchool()
{
   if (validateschooluser())
       {
         if(document.getElementById('gsp').checked)
        {
        document.getElementById("selschool").innerHTML ="Register as GSP-School";
        document.getElementById("schcat").value="school-gsp";
        }
        else
        {
        document.getElementById("selschool").innerHTML ="Register as School";
        document.getElementById("schcat").value="school";
        }
        document.getElementById("step2errormsg").innerHTML = "";
        document.getElementById('lightregstep2').style.display='none';
        document.getElementById('lightregstep3').style.display='block';
        document.getElementById('fade').style.display='block';
        return false;
       }
 }
function validateschooluser()
{
    var mailmatch = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    var invalid = " "; // Invalid character is a space 
    var re = /.+/;
    var name =$.trim($('#nametext').val());
    var fullname =$.trim($('#fullnametext').val());
    var mailID =$.trim($('#mailidtext').val());
    var spwd1 =$.trim($('#password').val());
    var spwd2 =$.trim($('#cnfrmpassword').val());
    var nMobno =$.trim($('#mobnotext').val());
   /* if(!name.match(re)) 
    {
        document.getElementById("step2errormsg").innerHTML ="Please enter a username";
        document.getElementById('nametext').focus();
        document.getElementById('nametext').select();
        return false;
    }
    else */
    if(!mailID.match(re)) 
    {
       document.getElementById("step2errormsg").innerHTML ="Please enter a valid email address";
        document.getElementById('mailidtext').focus();
        document.getElementById('mailidtext').select();
        return false;
    }
    else if(!mailID.match(mailmatch)) 
    {
        document.getElementById("step2errormsg").innerHTML ="Please enter a valid email address in the format xx@xxxx.xxx";
        document.getElementById('mailidtext').focus();
        document.getElementById('mailidtext').select();
        return false;
    }
    else if(!fullname.match(re)) 
    {
        document.getElementById("step2errormsg").innerHTML ="Please enter your full name";
        document.getElementById('fullnametext').focus();
        document.getElementById('fullnametext').select();
        return false;
    }
    else if(!spwd1.match(re)) 
    {
        
         document.getElementById("step2errormsg").innerHTML ="Please enter the Password.";
        document.getElementById('password').focus();
        document.getElementById('password').select();
        return false;
    }
    else if(!spwd2.match(re)) 
    {
        document.getElementById("step2errormsg").innerHTML ="Please enter the Password.";
        document.getElementById('cnfrmpassword').focus();
        document.getElementById('cnfrmpassword').select();
        return false;
    }
    
    else if(document.getElementById('password').value != document.getElementById('cnfrmpassword').value )
    {
        document.getElementById("step2errormsg").innerHTML ="Re-entered password doesn't match. Please enter both again.";
        document.getElementById('password').value='';
        document.getElementById('cnfrmpassword').value='';
        document.getElementById('password').focus();
        return false;
    }
    else if (spwd1.length <5)
    {
        document.getElementById("step2errormsg").innerHTML ="Password length should be atleast 5 characters.";
        document.getElementById('password').value='';
        document.getElementById('cnfrmpassword').value='';
        document.getElementById('password').focus();
        return false;  
     }
        document.getElementById("schcordname").value=$.trim($('#nametext').val());
        document.getElementById("schcordfullname").value=$.trim($('#fullnametext').val());
        document.getElementById("schcordmailid").value=$.trim($('#mailidtext').val());
        document.getElementById("schcordmob").value=$.trim($('#mobnotext').val());
        document.getElementById("schcordpwd").value=$.trim($('#password').val());
        return true;
}
function validatestep2fields()
{
    var mailmatch = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    var invalid = " "; // Invalid character is a space 
    var re = /.+/;
    var name =$.trim($('#name-text').val());
    var fullname =$.trim($('#fullname-text').val());
    var mailID =$.trim($('#mailid-text').val());
    var spwd1 =$.trim($('#password-password').val());
    var spwd2 =$.trim($('#cnfrmpassword-password').val());
    var nMobno =$.trim($('#mobno-text').val());
   /* if(!name.match(re)) 
    {
        
        document.getElementById("step2errormsg").innerHTML ="Please enter a username";
        document.getElementById('name-text').focus();
        document.getElementById('name-text').select();
        return false;
    }
    else */
    if(!mailID.match(re)) 
    {
       
         document.getElementById("step2errormsg").innerHTML ="Please enter a valid email address";
        document.getElementById('mailid-text').focus();
        document.getElementById('mailid-text').select();
        return false;
    }
    else if(!mailID.match(mailmatch)) 
    {
       
         document.getElementById("step2errormsg").innerHTML ="Please enter a valid email address in the format xx@xxxx.xxx";
        document.getElementById('mailid-text').focus();
        document.getElementById('mailid-text').select();
        return false;
    }
    else if(!fullname.match(re)) 
    {
        document.getElementById("step2errormsg").innerHTML ="Please enter your full name";
        document.getElementById('fullname-text').focus();
        document.getElementById('fullname-text').select();
        return false;
    }
    else if(!spwd1.match(re)) 
    {
        //alert("Please enter the Password.");
         document.getElementById("step2errormsg").innerHTML ="Please enter the Password.";
        document.getElementById('password-password').focus();
        document.getElementById('password-password').select();
        return false;
    }
    else if(!spwd2.match(re)) 
    {
       // alert("Please enter the Password.");
         document.getElementById("step2errormsg").innerHTML ="Please enter the Password.";
        document.getElementById('cnfrmpassword-password').focus();
        document.getElementById('cnfrmpassword-password').select();
        return false;
    }
    else if(document.getElementById('password-password').value != document.getElementById('cnfrmpassword-password').value )
    {
        document.getElementById("step2errormsg").innerHTML ="Re-entered password doesn't match. Please enter both again.";
        document.getElementById('password-password').value='';
        document.getElementById('cnfrmpassword-password').value='';
        document.getElementById('password-password').focus();
        return false;
    }
 
   
  return true;  
}


function SchoolRegister()
{
    //alert("Regwithallinfo");
    var re = /.+/;
    var schoolname =$.trim($('#schname-text').val());
    var schooladd =$.trim($('#schadd-text').val());
    var schoolcity= $.trim($('#schcity-text').val());
    var schoolstate =$.trim($('#schadd-textt').val());
    var schoolphno =$.trim($('#schph-text').val());
    
}


function validate_idpwd()
{
    var login_name= $.trim($('#login_name').val());
    var login_pass  = $.trim($('#login_pass').val());
    var login_remember  = $.trim($('#remember').val());
    /*var login_name = document.getElementById('login_name').value;
    var login_pass  = document.getElementById('login_pass').value;
    var login_remember  = document.getElementById('remember').value;*/
    if(login_name.search(/\S/) == -1 || login_name == "Email / Username")
    {
        alert("Please enter valid Email / Username");
       //  document.getElementById('logmsg').innerHTML ="Please enter valid Email / Username";
        document.getElementById('login_name').focus();
        return false;
    }
    else if(login_pass.search(/\S/) == -1 || login_pass == "Password")
    {
        alert ("Please enter Password");
        //document.getElementById('logmsg').innerHTML ="Please enter the Password.";
        document.getElementById('login_pass').focus();
        return false;
    }	
    else
    {
        xmlhttp=GetXmlHttpObject();
        if (xmlhttp==null)
        {
            alert ("Your browser does not support XMLHTTP!");
            return;
        }
        
        return true;
    }
}
function validate_regIndivstep()
{
    var mailmatch = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    var invalid = " "; // Invalid character is a space 
    var re = /.+/;
    var name =$.trim($('#Indivnametext').val());
    var fullname =$.trim($('#Indivfullnametext').val());
    var mailID =$.trim($('#Indivmailidtext').val());
    var spwd1 =$.trim($('#Indivpassword').val());
    var spwd2 =$.trim($('#Indivcnfrmpassword').val());
    var nMobno =$.trim($('#Indivmobnotext').val());
   /* if(!name.match(re) ) 
    {
        document.getElementById("stepIndverrormsg").innerHTML ="Please enter a username";
        document.getElementById('Indivnametext').focus();
        document.getElementById('Indivnametext').select();
        return false;
    }
    else */
    if(!mailID.match(re)) 
    {
       
        document.getElementById("stepIndverrormsg").innerHTML ="Please enter a valid email address";
        document.getElementById('Indivmailidtext').focus();
        document.getElementById('Indivmailidtext').select();
        return false;
    }
    else if(!mailID.match(mailmatch)) 
    {
       
        document.getElementById("stepIndverrormsg").innerHTML ="Please enter a valid email address in the format xx@xxxx.xxx";
        document.getElementById('Indivmailidtext').focus();
        document.getElementById('Indivmailidtext').select();
        return false;
    }
    else if(!fullname.match(re)) 
    {
        document.getElementById("stepIndverrormsg").innerHTML ="Please enter your full name";
        document.getElementById('Indivfullnametext').focus();
        document.getElementById('Indivfullnametext').select();
        return false;
    }
    else if(!spwd1.match(re)) 
    {
       // alert("Please enter the Password.");
        document.getElementById("stepIndverrormsg").innerHTML ="Please enter the Password.";
        document.getElementById('Indivpassword').focus();
        document.getElementById('Indivpassword').select();
        return false;
    }
    else if(!spwd2.match(re)) 
    {
        //alert("Please enter the Password.");
      
         document.getElementById("stepIndverrormsg").innerHTML ="Please enter the Password.";
        document.getElementById('Indivcnfrmpassword').focus();
        document.getElementById('Indivcnfrmpassword').select();
        return false;
    }
    
    else if(document.getElementById('Indivpassword').value != document.getElementById('Indivcnfrmpassword').value )
    {
        document.getElementById("stepIndverrormsg").innerHTML ="Re-entered password doesn't match. Please enter both again.";
        document.getElementById('Indivpassword').value='';
        document.getElementById('Indivcnfrmpassword').value='';
        document.getElementById('Indivpassword').focus();
        return false;
    }
    else if (spwd1.length <5)
        {
        document.getElementById("stepIndverrormsg").innerHTML ="password length should be atleast 5 characters.";
        document.getElementById('Indivpassword').value='';
        document.getElementById('Indivcnfrmpassword').value='';
        document.getElementById('Indivpassword').focus();
        return false;  
        }
  return true;  
   
}