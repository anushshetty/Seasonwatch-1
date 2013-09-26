<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php 
include 'includes/dbcon.php';
$q="k";
if(isset($_GET['term'])){
$q = $_GET['term'];
}
$dbc1=Dbconn::getdblink();
$dbc1->Connecttodb();
$sql="SELECT distinct users.user_id,user_groups.group_id,user_groups.group_name	FROM `users`,user_groups
     WHERE (users.user_category='school-seed'OR users.user_category='school-gsp' OR  users.user_category='school')AND user_groups.coord_id=users.user_id and group_name LIKE  '%".$q."%'";
$resd = $dbc1->readtabledata($sql);
// loop through each row returned and format the response for jQuery
$data = array();
if ( $resd && mysql_num_rows($resd) )
{
    while( $row = mysql_fetch_array($resd, MYSQL_ASSOC) )
    {
        $data[] = array( 'label' => $row['group_name'],'value' => $row['group_name']);
    }
}
// jQuery wants JSON data
echo json_encode($data);
flush();
?>
