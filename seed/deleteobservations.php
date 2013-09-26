<?php 
	session_start();
	include_once("includes/dbc.php");

if($_POST['observation_id']!= "")
{ 
$sql1 = "DELETE FROM user_tree_observations
               WHERE observation_id='$_POST[observation_id]'";  
//echo "sql1";
mysql_query($sql1,$link)or die("Deletion Failed:" .mysql_error()); 
echo  "Successfully Deleted";
} 
?>