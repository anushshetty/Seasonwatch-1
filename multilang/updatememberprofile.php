<?php
/* Initial development:- updates the user profile.This page will be loaded once users clicks edit profile.
 * 
 */
include 'includes/main_includes.php';
 
  if (isset($_SESSION['userid']))
  {
    $data=array();
    $userDetailsObj = unserialize ( $_SESSION['encoded_userobject'] );
    //santize all data 
    $data[0]  = Login::sanitize($_POST['editfullname']);
    $data[1]  = Login::sanitize($_POST["editusername"]);
    $data[2]  = Login::sanitize($_POST["editemailId"]);
    $data[3]  = Login::sanitize($_POST["editaddress"]);
    $data[4]  = Login::sanitize($_POST["editusermob"]);
    $data[5]  = Login::sanitize($_POST["editschoolcity"]);
    $data[6]  = Login::sanitize($_POST["editschoolstate"]);
    $data[7]  = Login::sanitize($_POST["editschoolpin"]);
    $data[8] = Login::sanitize($_POST["usercategory"]);
    $data[9] = Login::sanitize($_POST["edituserid"]);
   
    if ($userDetailsObj->category != "individual")
    {
   
    $data[10]  = Login::sanitize($_POST["editschooladd"]);
    $data[11]  = Login::sanitize($_POST["editschoolphone"]);
    $data[12] = Login::sanitize($_POST["editschoolname"]);
    $data[13] = Login::sanitize($_POST["editgroupid"]);
    }
 
    
    $msg=$userDetailsObj->edituser($dbc,$data);
    if ($msg=="1")
    {
      $msg="Your profile has been updated successfully.";
      $userDetailsInfore = new UserInfo();
      $userDetailsInforeobj= $userDetailsInfore->getUserDetails($dbc,$data[9]);
      $_SESSION['encoded_userobject'] = serialize($userDetailsInforeobj);
      unset($data);
     
    }
 else {$msg="Sorry,We are unable update your profile"; unset($data);}
     echo "<script>window.location = 'memprofile.php?msg=$msg'</script>";
     
    
        
    
}	
 
	

?>