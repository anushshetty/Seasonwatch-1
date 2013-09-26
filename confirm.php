<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * This page will validate the hashkey and allows the user to login.
 * If not validated then sends to reconfirm page.
 */
$confirm = $_GET['val'];
include 'includes/dbcon.php';
include 'includes/Login.php';
include 'includes/loginsubmit.php';
$dbc = Dbconn::getdblink();
$dbc->Connecttodb();
if($confirm) {
	$sql = "select * from users where hashkey='$confirm'";
	//$result=mysql_query($sql);
	//$num = mysql_num_rows($result);
        $result=$dbc->readtabledata($sql);
	$num=mysql_num_rows($result);

        if($num > 0 ) {		
        $sql = "update users SET approved='1',registered_on=now() where hashkey='$confirm'";
      
        //mysql_query($sql);
        $result=$dbc->readtabledata($sql);
        
            header("Location: index.php?cmd=confirm");  
            
       } else {
          
           header("Location: reconfirm.php");
       }
}
?>