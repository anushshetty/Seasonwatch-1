<?php
/* Initial development:- updates the user profile.This page will be loaded once users clicks edit profile.
 * 
 */
include 'includes/main_includes.php';
if (isset($_SESSION['userid']))
  {
    $userDetailsObj = unserialize ( $_SESSION['encoded_userobject'] );
    $userid=$userDetailsObj->userid;
    $pwdmd5=md5(Login::sanitize($_POST["password"]));
    $result= $userDetailsObj->editpassword($dbc,$userid,$pwdmd5);
    if ($result=="1")
    {  $msg="Your password has been updated successfully.";}
    else
    {  $msg="Sorry,We are unable update your password";} ?>

      <?echo "<script>window.location = 'memprofile.php?msg=$msg'</script>";
  }
?>