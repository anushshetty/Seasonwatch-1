<?php
/*
Called from profileTree.php -> Edit Observations -> choose from, to dates and submit.
This page populates the list of observations between the from and to dates with Edit and Delete links next to them.
*/
/* Jan 31 2012:- update query with ORDER BY  `user_tree_observations`.`date` ASC
  To display the list by the order of  observation date.*/

	session_start();
	include_once("includes/dbc.php");
	$start_date=$_POST[from_obdate];
	$end_date=$_POST[to_obdate];
?>

<table id="table1" class="tablesorter" cellspacing="0" cellpadding="3" style="width: 530px; margin-left: auto; margin-right: auto;">
<!--<colgroup>
<col style="width: 90px;"/>
<col style="width: 80px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 95px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 65px;"/>
<col style="width: 65px;"/>
</colgroup>-->
<thead>
<tr>
<!--<th class="header">No</th>-->
<th class="header">Primary Common Name</th>
<th class="header">Tree Nickname</th>
<th class="header">Observation Date</th>
<!--<th class="header">Fresh Leaves</th>
<th class="header">Mature Leaves</th>
<th class="header">Flower Buds</th>
<th class="header">Open Flowers</th>
<th class="header">Unripe Fruit</th>
<th class="header">Ripe Fruit</th>-->
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>

<?php 
//echo $speciesid;
$count=0;
print "<tr class='delboxtr'>";
//$user_tree_table_settings = mysql_query("SELECT tree_nickname, tree_id FROM  user_tree_table WHERE user_id='".$_SESSION[user_id]."'");
if ($_SESSION[group_role]=='coord')
{
	$sql_temp_results=mysql_query("SELECT user_id FROM  users WHERE group_id='".$_SESSION[group_id]."'");
	$sql_temp_results_row = mysql_fetch_array($sql_temp_results);
	//echo $sql_temp_results_row['user_id']. "xx";
	$user_id_array = " IN (" . $sql_temp_results_row['user_id'];
	while ($sql_temp_results_row = mysql_fetch_array($sql_temp_results)) 
	{
		$user_id_array .= "," . $sql_temp_results_row['user_id'];
	}
	$user_id_array .= ")";
	//echo "user_id_array: ". $user_id_array;
}
else
{
	$user_id_array=" = '".$_SESSION[user_id]."'";
}
/*if($speciesid=="" OR $speciesid=="All")
{*/
if($start_date=="" AND $end_date=="")
{
$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname, 
user_tree_observations.observation_id, 
user_tree_observations.date,
is_leaf_fresh, is_flower_open, is_fruit_ripe, 
is_leaf_mature, is_flower_bud, is_fruit_unripe,
species_master.species_primary_common_name 
FROM user_tree_observations 
INNER JOIN (users, user_tree_table, trees,species_master) 
ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
AND user_tree_table.user_id ". $user_id_array." 
AND users.user_id=user_tree_table.user_id 
AND user_tree_table.tree_id=trees.tree_id 
AND trees.species_id=species_master.species_id  
AND trees.tree_id=".$_POST[tree_id]."
ORDER BY user_tree_table.tree_id");
}
elseif($start_date=="" AND $end_date!="")
{
$user_tree_table_settings=mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
  user_tree_observations.observation_id,user_tree_observations.date,
  is_leaf_fresh,
  is_flower_open, 
  is_fruit_ripe, 
  species_master.species_primary_common_name 
  FROM user_tree_observations 
  INNER JOIN 
  (users, user_tree_table,trees,species_master) 
  ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id
  AND user_tree_table.user_id ". $user_id_array." 
  AND users.user_id=user_tree_table.user_id 
  AND user_tree_table.tree_id=trees.tree_id 
  AND trees.species_id=species_master.species_id 
  AND trees.tree_id=".$_POST[tree_id]."  
  WHERE  user_tree_observations.date <= '$end_date'ORDER BY  `user_tree_observations`.`date` ASC");
}
elseif($start_date!="" AND $end_date=="")
{
$user_tree_table_settings=mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
  user_tree_observations.observation_id,user_tree_observations.date,
  is_leaf_fresh,
  is_flower_open, 
  is_fruit_ripe, 
  species_master.species_primary_common_name 
  FROM user_tree_observations 
  INNER JOIN 
  (users, user_tree_table,trees,species_master) 
  ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id
  AND user_tree_table.user_id ". $user_id_array." 
  AND users.user_id=user_tree_table.user_id 
  AND user_tree_table.tree_id=trees.tree_id 
  AND trees.species_id=species_master.species_id 
  AND trees.tree_id=".$_POST[tree_id]."  
  WHERE  user_tree_observations.date >= '$start_date'ORDER BY  `user_tree_observations`.`date` ASC");
}
else
{
$user_tree_table_settings=mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
  user_tree_observations.observation_id,user_tree_observations.date,
  is_leaf_fresh,
  is_flower_open, 
  is_fruit_ripe, 
  species_master.species_primary_common_name 
  FROM user_tree_observations 
  INNER JOIN 
  (users, user_tree_table,trees,species_master) 
  ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id
  AND user_tree_table.user_id ". $user_id_array." 
  AND users.user_id=user_tree_table.user_id 
  AND user_tree_table.tree_id=trees.tree_id 
  AND trees.species_id=species_master.species_id 
  AND trees.tree_id=".$_POST[tree_id]."  
  WHERE  user_tree_observations.date BETWEEN '$start_date' AND '$end_date'ORDER BY  `user_tree_observations`.`date` ASC");
}
/*}
else
{
if($start_date=="" AND $end_date=="")
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
       ORDER BY user_tree_table.tree_id");
}
elseif($start_date=="" AND $end_date!="")
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
	   WHERE  user_tree_observations.date <= '$end_date'
       ORDER BY user_tree_table.tree_id");
}
elseif($start_date!="" AND $end_date=="")
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
	   WHERE  user_tree_observations.date >= '$start_date'
       ORDER BY user_tree_table.tree_id");
}
else
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
	   WHERE  user_tree_observations.date BETWEEN '$start_date' AND '$end_date'
       ORDER BY user_tree_table.tree_id");
}
}*/ 
while ($row_settings = mysql_fetch_array($user_tree_table_settings)) 
{
print "<tr>";
$count++;  
//print "<td style='width:220px'>".$count."</td>";
print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td>".$row_settings['tree_nickname']."</td>";

$printdate = date("Y-m-d",strtotime($row_settings['date']));
//echo $printdate;


print "<td>".$printdate. "</td>";
//print "<td>".$row_settings[observation_id]. "</td>";
//print "<td>".$row_settings['user_tree_id']. "</td>";
/*
$fresh_status = $row_settings['is_leaf_fresh'];
if($fresh_status == '1')
{
$fresh_status = 'Yes';
}
else
{
if($fresh_status == '0')
{
$fresh_status = 'No';
}
else
$fresh_status='Dont know';
}
echo "<td>" . $fresh_status . "</td>";
//print "<td>".$row_settings['is_leaf_fresh']. "</td>";

$mature_status = $row_settings['is_leaf_mature'];
if($mature_status == '1')
{
$mature_status = 'Yes';
}
else
{
if($mature_status == '0')
{
$mature_status = 'No';
}
else
$mature_status='Dont know';
}
echo "<td>" . $mature_status . "</td>";

$bud_status = $row_settings['is_flower_bud'];
if($bud_status == '1')
$bud_status = 'Yes';
else
if($bud_status == '0')
$bud_status = 'No';
else
if($bud_status == '2')
$bud_status = 'Dont know';
echo "<td>" . $bud_status . "</td>";

$open_status = $row_settings['is_flower_open'];
if($open_status == '1')
$open_status = 'Yes';
else
if($open_status == '0')
$open_status = 'No';
else
if($open_status == '2')
$open_status = 'Dont know';
echo "<td>" . $open_status . "</td>";
//print "<td>".$row_settings['is_flower_open']. "</td>";

$unripe_status = $row_settings['is_fruit_unripe'];
if($unripe_status == '1')
$unripe_status = 'Yes';
else
if($unripe_status == '0')
$unripe_status = 'No';
else
if($unripe_status== '2')
$unripe_status = 'Dont know';

echo "<td>" . $unripe_status . "</td>";

$ripe_status = $row_settings['is_fruit_ripe'];
if($ripe_status == '1')
$ripe_status = 'Yes';
else
if($ripe_status == '0')
$ripe_status = 'No';
else
if($ripe_status== '2')
$ripe_status = 'Dont know';

echo "<td>" . $ripe_status . "</td>";


//print "<td>".$row_settings['is_fruit_ripe']. "</td>";
*/
$var=$row_settings['user_tree_id'];
$var1=$row_settings['observation_id'];
$editobservationLink = "<a href='#dialog_edit_obs' id='edit_obs_link' onClick='edit_obs_load(".$var1.");return false;'>Edit</a>";
//$editobservationLink = "<a href=".$row_settings['observation_id'].">Edit</a>";

print "<td>$editobservationLink</td>";

$deleteobservationLink = "<a  id='obs_delete' href='' onClick='obs_delete(".$var1.");return false;'>Delete</a>";
//$deletetreelink="<a class=thickbox href=\"deleteobservation.php?usertreeid=".$row_settings['user_tree_id']."&observationid=".$row_settings['observation_id']."&TB_iframe=true&height=500&width=700\">Delete</a>";
print "<td>$deleteobservationLink</td>";
print "</tr>";
}  
echo "</tbody></table>";
?>