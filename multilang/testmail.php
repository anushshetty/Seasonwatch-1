<?php 

  $rfullname="MeghanaElsaPallathu";
$hash="6e7b33fdea3adc80ebd648fffb665bb8";
$usermailID = "veenaht@gmail.com";
    $subject = "Seasonwatch: Confirm your registration";
$body = 
<<<MAILTXT
Dear $rfullname,

Thank you for registering with Seasonwatch. Please confirm your email address by clicking on the link below.

http://seasonwatch.in/confirm.php?val=$hash

Thank you again for contributing your time and effort to
Seasonwatch. Do let us know if you have any questions about how to
collect or send in the information.


With best wishes,
The Seasonwatch Team.
http://www.seasonwatch.in
sw@seasonwatch.in

MAILTXT;
    $headers = "To: " . $rfullname . "<" . $usermailID . "> \r\n";
    $headers .= "From: Seasonwatch Team <sw@seasonwatch.in>\r\n";
    //$headers .= "Cc: seasonwatch@ncbs.res.in \r\n";
    $headers .= "X-Mailer: php\r\n";
    mail($email, $subject, $body, $headers);
    $sent = mail($usermailID, $subject, $body, $headers) ;
  


?>
