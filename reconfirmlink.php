<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'includes/dbcon.php';
include 'includes/Login.php';
include 'includes/loginsubmit.php';
$dbc = Dbconn::getdblink();
$dbc->Connecttodb();
//If (isset($_POST['submit'])) { 
$confirm_email = $_POST['usr_email'];
//echo $confirm_email;
   $sql = "SELECT user_name , hashkey FROM users WHERE user_email='".$confirm_email."'";
   $result = mysql_query($sql);
    $result=$dbc->readtabledata($sql);
    $hashkey_exists=mysql_num_rows($result);
 //  $hashkey_exists = mysql_num_rows($result);
   while($data = mysql_fetch_assoc($result)) {
	$hashkey_confirm = $data['hashkey'];
	$user_name_confirm = $data['user_name'];
   }
  if($hashkey_exists > 0 ) {

	

				$subject = "Seasonwatch: Confirm your registration";
				$body = 
<<<MAILTXT
Dear $user_name_confirm,

Thank you for registering with Seasonwatch. Please confirm your email address by clicking on the link below.

http://seasonwatch.in/confirm.php?val=$hashkey_confirm

Thank you again for contributing your time and effort to
Seasonwatch. Do let us know if you have any questions about how to
collect or send in the information.


With best wishes,
The Seasonwatch Team.
http://www.seasonwatch.in
sw@seasonwatch.in

MAILTXT;
	                        $headers = "To: " . $user_name_confirm . "<" . $confirm_email . "> \r\n";
				$headers .= "From: Seasonwatch Team <sw@seasonwatch.in>\r\n";
				/*$headers .= "Cc: seasonwatch@ncbs.res.in \r\n";*/
				$headers .= "X-Mailer: php\r\n";
                                $sent = mail($email, $subject, $body, $headers);
                                if($sent)
                                {
                                         header("Location: reconfirm.php?cmd=sentmail");
                                }
                                else
                                {
                                    $logmsg="Due to Technical Fault the mail could not be sent.";
                                    //$logmsg ="fail";
                                }
				//mail($email, $subject, $body, $headers);
                                header("Location: reconfirm.php?cmd=sentmail");
                                //exit();
			}else {

		            header("Location: reconfirm.php?cmd=incorrectmail");
	           }

//}
?>
