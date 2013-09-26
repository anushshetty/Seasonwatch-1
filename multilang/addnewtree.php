<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo "<script>window.setInterval(alert('Adding tree please wait..'),500);</script>";
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
session_start();
include 'includes/Login.php';
include 'includes/Tree.php';
$dbc = Dbconn::getdblink();
$dbc->Connecttodb();
if (isset($_SESSION['userid']))
{
   //  $treedata    = array();
$dfw_fieldname="";
$dos_fieldname="";
if(isset($_POST['species_id']))
{$speciesId        = Login::sanitize($_POST['species_id']);}
if(isset($_POST['distance_from_water']))
{$dfw_value        = Login::sanitize($_POST['distance_from_water']);}
if(isset($_POST['degree_of_slope']))
{$dos_value        = Login::sanitize($_POST['degree_of_slope']);}
if(isset($_POST['is_fertilised']))
{$is_fertilised    = Login::sanitize($_POST['is_fertilised']);}
if(isset($_POST['is_watered']))
{   $is_watered       = Login::sanitize($_POST['is_watered']);}
if(isset($_POST['location_type']))
{$location_type    = Login::sanitize($_POST['location_type']);}
if(isset($_POST['aspect']))
{$aspect           = Login::sanitize($_POST['aspect']);}
if(isset($_POST['tree_height']))
{$tree_height          = Login::sanitize($_POST['tree_height']);}
if(isset($_POST['tree_girth']))
{$tree_girth          = Login::sanitize($_POST['tree_girth']);}
if(isset($_POST['tree_nickname'])){
$tree_nickname    = Login::sanitize($_POST['tree_nickname']);}
if(isset($_POST['tree_damage'])){
$tree_damage    = Login::sanitize($_POST['tree_damage']);}
if(isset($_POST['other_notes'])){
$other_notes    = Login::sanitize($_POST['other_notes']);}
if(isset($_POST['members_assigned'])){
$membersassigned    = Login::sanitize($_POST['members_assigned']);}

 //Location Information
if(isset($_POST['latitude'])){
$lat       = Login::sanitize($_POST['latitude']);}
if(isset($_POST['longitude'])){
$lon        = Login::sanitize($_POST['longitude']);}
if(isset($_POST['locationname'])){
$locname        = Login::sanitize($_POST['locationname']);}
if(isset($_POST['stateid'])){
$stateid   = Login::sanitize($_POST['stateid']);}
if(isset($_POST['locationcity'])){
$loccity       = Login::sanitize($_POST['locationcity']);}
if(isset($_POST['zoomval'])){
$zoomval    = Login::sanitize($_POST['zoomval']);}
    
//add treelocation into location master table
$Treelocquery = "INSERT INTO location_master  
(state_id,city,longitude,latitude,location_name,zoom_factor)  
VALUES ('$stateid', '$loccity ','$lon','$lat','$locname ', '$zoomval')";  
$treeloc_rec=$dbc->readtabledata($Treelocquery);
if($treeloc_rec){$tree_location_id = mysql_insert_id(); //get treelocation id
}
 /** adding row in trees table*/
$tree_insert = "INSERT INTO trees  
(is_fertilised,
is_watered,species_id,tree_location_id,location_type,degree_of_slope,distance_from_water
,aspect,date_of_addition) VALUES
('$is_fertilised','$is_watered','$speciesId','$tree_location_id','$location_type','$dos_value','$dfw_value','$aspect', CURDATE())";
$treeinsert_rec=$dbc->readtabledata($tree_insert);
if($treeinsert_rec){ $tree_insert_id = mysql_insert_id(); }//get tree id}
 /*  for user_tree_table*///     
$user_tree = "INSERT INTO user_tree_table 
(tree_id,tree_nickname,user_id,members_assigned) 
VALUES
('$tree_insert_id', '".addslashes($tree_nickname)."','$_SESSION[userid]' ,'$membersassigned' )";//  ,'$tree_code_sms''$members_assigned' 
$usertreeinsert_rec=$dbc->readtabledata($user_tree);
//* for tree_measurement table*///
$treemeasure = "INSERT INTO tree_measurement  
(tree_id,user_id,date_of_measurement,tree_girth,tree_height,tree_damage,other_notes,date_of_addition)
values('$tree_insert_id','$_SESSION[userid]',now(),'$tree_height','$tree_girth','$tree_damage','$other_notes',now())";
$treemeasure_rec=$dbc->readtabledata($treemeasure);   

$tob = unserialize($_SESSION['tob']);
    $trees = "SELECT tree_nickname, species_primary_common_name,species_scientific_name,species_master.species_id as species_id, members_assigned, trees.tree_Id as tid, user_tree_id
    FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]')
    ON species_master.species_id = trees.species_id ORDER BY species_master.species_id ASC";
    $tree_data=$dbc->readtabledata($trees);
    $tree_no=mysql_num_rows($tree_data);
    $_SESSION['NoTrees']=$tree_no;
    for($i=0;$i<$tree_no;$i++)
    {

        $Treeobj[$i]=new Tree();
        $onetreedata=mysql_fetch_array($tree_data);
        $Treeobj[$i]->Tree_id =$onetreedata['tid'];
        $Treeobj[$i]->Addedby_userid=$_SESSION['userid'];
        $Treeobj[$i]->Tree_nickname=$onetreedata['tree_nickname'];
        $Treeobj[$i]->members_assigned=$onetreedata['members_assigned'];
        $Treeobj[$i]->user_tree_id=$onetreedata['user_tree_id'];

        $Treeobj[$i]->Species_id=$onetreedata['species_id'];
        $Treeobj[$i]->Species_common_name=$onetreedata['species_primary_common_name'];

        $Treeobj[$i]->Tree_desc=$onetreedata['tid'];
        $Treeobj[$i]->Tree_loc_type=$onetreedata['tid'];
        $Treeobj[$i]->species_scientific_name=$onetreedata['species_scientific_name'];
        $Treeobj[$i]->species_family=$onetreedata['tid'];

        $result = $dbc->readtabledata("SELECT path_name,file_name FROM species_images WHERE species_id='".$onetreedata['species_id']."'");
        $image_names = mysql_fetch_array($result);
        if ($image_names !='')
        {
            $species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
            // replace .jpg into .png
            $species_pic1 = str_replace(".jpg",".png",$species_pic1);
            //echo $species_pic1;
            $th_picname=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
            $Treeobj[$i]->species_image=$th_picname;
            $Treeobj[$i]->Loc_id=$onetreedata['tid'];
            $Treeobj[$i]->Loc_name=$onetreedata['tid'];
            $Treeobj[$i]->Loc_city=$onetreedata['tid'];
            $Treeobj[$i]->Loc_state=$onetreedata['tid'];
            $Treeobj[$i]->Loc_zoom=$onetreedata['tid'];
        }
       $_SESSION['tob'] = serialize($Treeobj);

    }




}
?>
