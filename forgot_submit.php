<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

include_once("includes/dbcon.php");
include_once("includes/Login.php");
include_once("includes/UserInfo.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    $dbc = Dbconn::getdblink();
   $dbc->Connecttodb();
   $forgotmail=Login::sanitize($_POST["forgot_email"]);
   $newforgotmailobject = new UserInfo();
   $forgotpwdcheck =$newforgotmailobject->forgotpwd($dbc,$forgotmail);
   echo $forgotpwdcheck;
       
?>
