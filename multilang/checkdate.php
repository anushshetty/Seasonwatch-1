<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
   /* To checkdate befor updating the observation date.*/
   // include 'includes/main_includes.php';
    include 'includes/Login.php';
    session_start();
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
  
   $usertreeid      = $_POST['observationno'];
   $observationdate =   $_POST['obdate'];
    $sqlBeforeupdate= "Select * from user_tree_observations where user_tree_id='$_POST[observationno]' and date='$_POST[obdate]'and user_id='$_SESSION[userid]'";
   $result=$dbc->readtabledata($sqlBeforeupdate);    
   $num = mysql_num_rows($result);
   
   
   //$chkobservstatus=$newobservation::IsObservationExists($dbc,$observationdate,$usertreeid);
   //unset($newobservation);
   echo $num;
   
?>
