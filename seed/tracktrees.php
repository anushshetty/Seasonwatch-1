<?php 
include 'includes/dbc.php';

//print_r($HTTP_POST_VARS);

$speciesId=($_POST['species_id']);
$getlocationname= $_SESSION['treelocID']; 
//echo "xx".$_POST['treelocationname'];
//echo $getlocationname;

//if($_POST['Submit'] == 'Submit')  
//{                     foreach($_POST as $key => $value)
{ 
$data[$key] = filter($value);
} 
$dfw_fieldname="";
$dfw_value="";
$dos_fieldname="";
$dos_value="";
 if($_POST[distance_from_water]!="")
 {
 $dfw_fieldname="distance_from_water,";
 $dfw_value="'$_POST[distance_from_water]',";
 }
 if($_POST[degree_of_slope]!="")
 {
 $dos_fieldname="degree_of_slope,";
$dos_value="'$_POST[degree_of_slope]',";
 }
$sql1 = "INSERT INTO trees  
              (tree_desc,is_fertilised,
              is_watered,species_id,tree_location_id,location_type,".$dfw_fieldname.$dos_fieldname." aspect,date_of_addition)  
              VALUES
              ('$_POST[tree_desc]',
              '$_POST[is_fertilised]',
              '$_POST[is_watered]',  
              '$speciesId',  
              '$_SESSION[treelocID]', 
              '$_POST[location_type]',".
               $dfw_value.$dos_value." 
              '$_POST[aspect]',
				CURDATE()
              )";  
              mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()); 
//echo "user id in session is: " . $_SESSION[user_id];
//echo "ID of last inserted record is: " . mysql_insert_id();
$tree_id = mysql_insert_id();
//echo "$tree_id"; 
if ($_POST[assigned_user]){
	$user_to_assign=$_POST[assigned_user];
}
else {
	$user_to_assign=$_POST[user_id];
}
/*$tree_code_sms_data=mysql_query("SELECT tree_code_sms FROM user_tree_table WHERE user_id='$user_to_assign'");
$tree_code_sms_last=1;
while(list($tree_code_sms_val)=mysql_fetch_row($tree_code_sms_data))
{
	if ($tree_code_sms_last<=intval($tree_code_sms_val))
	{
		$tree_code_sms_last=intval($tree_code_sms_val)+1;
		echo $tree_code_sms_val;
	}
}
if ($tree_code_sms_last<10)
{
	$tree_code_sms="00".strval($tree_code_sms_last);
}
else if ($tree_code_sms_last<100)
{
	$tree_code_sms="0".strval($tree_code_sms_last);
}
else
{
	$tree_code_sms=strval($tree_code_sms_last);
}
*/
//echo $tree_code_sms;
$sql2 = "INSERT INTO user_tree_table 
         (tree_id,tree_nickname,user_id,members_assigned,tree_code_sms) 
         VALUES
         ('$tree_id', 
         '".addslashes($_POST[tree_nickname])."',
         '$user_to_assign',
		 '$_POST[members_assigned]',
		 '$_POST[tree_code_sms]'
         )"; 
       mysql_query($sql2,$link) or die("Insertion Failed2:" .mysql_error()); 

//echo "tree damage".$_POST[tree_damage];
$sql3 = "INSERT INTO tree_measurement  
	            (tree_id,user_id,date_of_measurement,";
 if($_POST[tree_girth]!="")
 {
 $sql3 .= "tree_girth,";
 }           
 if($_POST[tree_height]!="")
 {
 $sql3 .= "tree_height,";
 }  
 $sql3 .= "tree_damage,other_notes) 
               VALUES 
               ('$tree_id',
               '$_POST[user_id]',
               now(),";
if($_POST[tree_girth]!="")
 {
 $sql3 .= "'".addslashes($_POST[tree_girth])."',";
 }           
 if($_POST[tree_height]!="")
 {
 $sql3 .= "'".addslashes($_POST[tree_height])."',";
 }  
 $sql3 .= "		'".addslashes($_POST[tree_damage])."', 
               '".addslashes($_POST[other_notes])."' 
               )";    
					mysql_query($sql3,$link) or die("Insertion Failed3:" .mysql_error()); 

//echo "Done id: ".$row.". <br />"; 
/*}
else
{
	echo "not done";
}*/

//after insertion unset the session for treelocation 

unset($_SESSION['treelocation']); 
mysql_close($link);
?>