<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php 
include 'includes/dbcon.php';

$q="0";

if(isset($_GET['q'])){
$q = $_GET['q'];
}
session_start();

$dbc1=Dbconn::getdblink();
$dbc1->Connecttodb();
$qObcnt="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
         user_tree_id ='".$q."' and user_id='$_SESSION[userid]' and deleted='0'";
//echo $qObcnt; 
$observationscnt=$dbc1->readtabledata($qObcnt);
 $totalnoofobservationscnt=mysql_num_rows($observationscnt);
                                    
 //echo " ".$totalnoofobservationscnt;
 //$obsdates=array();
 $obsdates="";
 for($p=0;$p<$totalnoofobservationscnt;$p++){
 	$temp=mysql_fetch_array($observationscnt);
 	if ($obsdates=="")
 $obsdates=$temp['date'];
 	else
 $obsdates=$obsdates.",".$temp['date'];
 }
 
// jQuery wants JSON data
//echo json_encode($obsdates);
echo $obsdates;
 ?>