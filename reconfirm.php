<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SeasonWatch / Reconfirm</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/popup.js"> </script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/form.css">
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/initiate.js"></script>
</head>
    <? include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
 include ("includes/headerbeforelogin.php");?>

<body>
<div class="wrapper">
    <div class="body_content_2">
     <div class="body_top">
        <div class="main">
            <div class="container">
               <div class="mytree"> <h2>Reconfirm</h2></div>
            </div>
        </div>
    </div> <!-- end div of body_top which includes Add tree heading--> 
 <script language="javascript" type="text/javascript">
 function VerifyForm()
 {
    var mailID =document.swatch_refirm.usr_email.value;
    if (mailID=="")
       {
        alert("Please enter an email address.");
        document.swatch_refirm.usr_email.focus();
        document.swatch_refirm.usr_email.select();
        return false;
       }
   
    var re = /.+/;
    var mailmatch = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    var invalid = " "; // Invalid character is a space
    if(!mailID.match(re)) 
    {
        alert("Please enter an email address.");
        document.swatch_refirm.user_email.focus();
        document.swatch_refirm.user_email.select();
        return false;
    }
    if (!mailID.match(mailmatch)) 
    {
        alert("Please enter an email address in xx@xxxx.xxx format");
        document.swatch_refirm.usr_email.focus();
        document.swatch_refirm.usr_email.select();
        return false;
    }
    
  }
    
  </script>
 <?  
// $confirm = $_GET['cmd'];
   if(isset($_GET['cmd']))
   {
       $confirm = $_GET['cmd'];
   }
   else
   {$confirm = "";}
   //$confirm = $_GET['cmd'];
   if ($confirm=='sentmail'){
  ?>
 <div class="container" style="height:40%;"> 
       <div class="reconfirm" >Your confirmation link has been sent sucessfully.</div>
       
         
    </div>

<? }elseif (($confirm=='incorrectmail')||($confirm=='')){
if ($confirm=='incorrectmail')
{?>
 <div style="color:#cc3300;">Please enter valid Email Address.</div>

<?}
?>
   
   
   <form name="swatch_refirm" action="reconfirmlink.php?emailid=" method="POST"  onSubmit="return VerifyForm()">
    <div class="container" style="height:50%;"> 
       <div class="reconfirm" >Please enter your email address to receive the confirmation link </div>
       <div align="center"> Your Email Address  : 
            <input  name="usr_email" id="usr_email" type="text" value="" autocomplete="off" class="emailfield " /></div>
            <div align="center"><input  type="submit" class="refirmsub" value="Send" /></div>
         
    </div>
   </form>
<?
 }?>
 
              
    </div>
</div>

<!--  start footer  -->
<?php include ("includes/footer.php"); ?>
<!--  end footer  -->   
 </body>
</html>