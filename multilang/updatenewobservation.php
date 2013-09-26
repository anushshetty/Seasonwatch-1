<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$obdate     = $_POST['obdate'];
   //echo $obdate;
//include 'includes/main_includes.php';
//include 'includes/Tree.php';
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
//('display_errors',1);
session_start();
   include 'includes/Login.php';
   include 'includes/Tree.php';
   include 'includes/Observation.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
//echo $_SESSION['userid'];
if (isset($_SESSION['userid']))
{
    
    $obdate             = Login::sanitize($_POST['obdate']);
    $is_leaf_fresh      = Login::sanitize($_POST['is_leaf_fresh']); 
    $freshleaf_count    = Login::sanitize($_POST['freshleaf_count']);
    $is_leaf_mature     = Login::sanitize($_POST['is_leaf_mature']);
    $matureleaf_count   = Login::sanitize($_POST['matureleaf_count']); 
    $is_flower_bud      = Login::sanitize($_POST['is_flower_bud']); 
    $bud_count          = Login::sanitize($_POST['bud_count']); 
    $is_flower_open     = Login::sanitize($_POST['is_flower_open']);
    $open_flower_count  = Login::sanitize($_POST['open_flower_count']);  
    $is_fruit_ripe      = Login::sanitize($_POST['is_fruit_ripe']);  
    $fruit_ripe_count   = Login::sanitize($_POST['fruit_ripe_count']);
    $is_fruit_unripe    = Login::sanitize($_POST['is_fruit_unripe']);
    $fruit_unripe_count = Login::sanitize($_POST['fruit_unripe_count']);
    $leaf_caterpillar   = Login::sanitize($_POST['leaf_caterpillar']);
    $flower_butterfly   = Login::sanitize($_POST['flower_butterfly']);
    $flower_bee         = Login::sanitize($_POST['flower_bee']);
    $fruit_bird         = Login::sanitize($_POST['fruit_bird']);
    $fruit_monkey       = Login::sanitize($_POST['fruit_monkey']);  
    
    //echo $obdate;
    $observationdata    = array();
    $observationdata[0]  = Login::sanitize($_POST['obdate']);
    $observationdata[1]  = Login::sanitize($_POST['treeid']);
    $observationdata[2]  = Login::sanitize($_POST['is_leaf_fresh']); 
    $observationdata[3]  = Login::sanitize($_POST['freshleaf_count']);
    $observationdata[4]  = Login::sanitize($_POST['is_leaf_mature']);
    $observationdata[5]  = Login::sanitize($_POST['matureleaf_count']);
    $observationdata[6]  = Login::sanitize($_POST['is_flower_bud']); 
    $observationdata[7]  = Login::sanitize($_POST['bud_count']); 
    $observationdata[8]  = Login::sanitize($_POST['is_flower_open']);
    $observationdata[9]  = Login::sanitize($_POST['open_flower_count']);
    $observationdata[10] = Login::sanitize($_POST['is_fruit_ripe']);  
    $observationdata[11] = Login::sanitize($_POST['fruit_ripe_count']);
    $observationdata[12] = Login::sanitize($_POST['is_fruit_unripe']);
    $observationdata[13] = Login::sanitize($_POST['fruit_unripe_count']);
    $observationdata[14] = Login::sanitize($_POST['leaf_caterpillar']);
    $observationdata[15] = Login::sanitize($_POST['flower_butterfly']);
    $observationdata[16] = Login::sanitize($_POST['flower_bee']);
    $observationdata[17] = Login::sanitize($_POST['fruit_bird']);
    $observationdata[18] = Login::sanitize($_POST['fruit_monkey']);
    $observationdata[19] = Login::sanitize($_SESSION['userid']);  
    //$TreeInfoobj
    //create
    //echo $observationdata[1];
    $newobservation= new Observation();
    //$newobservation::AddObservation($dbc,$observationdata);
    $chkobservstatus=$newobservation->IsObservationExists($dbc,$observationdata[0],$observationdata[1]);
    //echo $chkobservstatus;
    $msg="";
    if ((int)$chkobservstatus=="0")
    {
       $addobstatus=$newobservation->AddObservation($dbc,$observationdata);
       //echo $addobstatus;
       $msg="sucess";
    }
    else
    {
       $msg="date exits"; 
    }
     echo $msg;   
}
//echo "<script>window.location = 'memprofile.php?msg=$msg'</script>";
?>