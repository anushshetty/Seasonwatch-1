<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
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
 

//get other information also
/*$sql = "SELECT species_scientific_name,special_notes_on_the_species FROM species_master where species_id=$q";
$resd1 = $dbc1->readtabledata($sql);

// loop through each row returned and format the response for jQuery
if ( $resd1 && mysql_num_rows($resd1) )
{
	$row = mysql_fetch_array($resd1) or die(mysql_error());
        $sciencename = $row['species_scientific_name'];
        $notes = $row['special_notes_on_the_species'];
}

$imagesource=$imagesource."=".$sciencename."|".$notes;*/


// jQuery wants JSON data
//echo json_encode($imagesource);
echo $imagesource;
?>