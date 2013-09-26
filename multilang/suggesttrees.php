<?php 
include 'includes/dbcon.php';

$q="t";

if(isset($_GET['term'])){
$q = $_GET['term'];
#echo "$q";
}

$dbc1=Dbconn::getdblink();
$dbc1->Connecttodb();
$sql = "SELECT species_primary_common_name as species_label,species_id as species_value FROM species_master WHERE species_search_names LIKE '%".$q."%';";
$resd = $dbc1->readtabledata($sql);


// loop through each row returned and format the response for jQuery
$data = array();
if ( $resd && mysql_num_rows($resd) )
{
	while( $row = mysql_fetch_array($resd, MYSQL_ASSOC) )
	{
		$data[] = array(
			'label' => $row['species_label'] ,
			'value' => $row['species_value']
		);
	}
}
 
// jQuery wants JSON data
echo json_encode($data);
flush();
?>