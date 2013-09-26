<?php 
include 'includes/dbcon.php';

$q="1000";

if(isset($_GET['q'])){
$q = $_GET['q'];
}

$dbc1=Dbconn::getdblink();
$dbc1->Connecttodb();
$sql = "SELECT file_name,path_name FROM species_images where species_id=$q";
$resd = $dbc1->readtabledata($sql);

// loop through each row returned and format the response for jQuery
if ( $resd && mysql_num_rows($resd) )
{
	$row = mysql_fetch_array($resd) or die(mysql_error());
	   	$imagesource = $row['path_name'].$row['file_name'];
}
 
// jQuery wants JSON data
//echo json_encode($imagesource);
echo $imagesource;
?>