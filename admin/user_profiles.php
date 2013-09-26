<?php 
   session_start();
   $page_title="SeasonWatch";
   include("../includes/dbc.php");
   include("main_includes.php");
   //include("../functions.php");
$userID = $_GET['user'];
$treeID = $_GET['treeid'];
//echo $userID;
//echo $treeID;
?>

</head>
<body>
<div class="body_main"> 
<div class='container first_image'>
<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<div>
<h3>User Details</h3>
<?php
include("admin_header.php");
?>
</table>
<div>
<hr/>
</div>
<table>
<tr>
<td>

<div class='realtime'><div class='realtime_header'>User profile<br>
<small>
<?php 
$end_date=date('d-M-Y');
$end_date_sql=date('Y-m-d');
$m= date("m"); // Month value
$de= date("d"); //today's date
$y= date("Y")-1; // Year value
$start_date= date('d-M-Y', mktime(0,0,0,$m,$de,$y)); 
$start_date_sql= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
echo $start_date; ?> to <? echo $end_date ; ?>
</small></div><br>

<div class="popspecies">
<?php 
$result = mysql_query("SELECT * FROM users where user_id='$userID';");
while($data = mysql_fetch_array($result))
{
?>
<ul class="chartlist">

        <li>Name : <?php echo $data[full_name]; ?></li>&nbsp;
	<li>Address : <?php echo $data[address]; ?></li>	&nbsp;
	<li>City : <?php echo $data[city]; ?></li>&nbsp;
        <li>State : 
<?php 
$query = mysql_query("select state from seswatch_states where state_id = $data[state_id]");
while($state= mysql_fetch_array($query)) 
	{
	echo $state[state]; 
	}
	?>
	</li>
		</ul>
<?
}
?>


<td class="cms" style="solid rgb(217, 92, 21); width: 50%;">
<table id="table1" class="box">
                <thead>
                       <tr>
                               <th style='width:220px'>Species Name</th>           
                               <th style='width:240px'>Tree Nickname</th>
                               <th style='width:100px'>Tree Location</th>
                               <th style='width:200px'>Date of addition</th>
                        </tr>
                </thead>
<tbody>

<?php
$usertree = mysql_query("SELECT user_tree_table.tree_nickname, users.full_name, species_master.species_primary_common_name,species_master.species_id,
location_master.city, seswatch_states.state, trees.date_of_addition, user_tree_table.user_id  
FROM user_tree_table
INNER JOIN (species_master, location_master, seswatch_states, trees, users)
ON
species_master.species_id = trees.species_id 
AND trees.tree_location_id = location_master.tree_location_id 
AND user_tree_table.tree_id = trees.tree_id
AND location_master.state_id = seswatch_states.state_id
AND user_tree_table.user_id = users.user_id
AND user_tree_table.user_id = '$userID'
GROUP BY user_tree_table.user_tree_id
 ;");


/* $usertree = mysql_query("SELECT species_master.species_primary_common_name, species_master.species_id,  location_master.city, users.full_name,users.user_id, seswatch_states.state, user_tree_table.tree_nickname, trees.date_of_addition, 
SUM(user_tree_table.user_id)
FROM user_tree_table 
INNER JOIN (species_master,location_master,trees, users, user_tree_observations, seswatch_states) 
ON trees.species_id = species_master.species_id 
AND trees.tree_location_id = location_master.tree_location_id 
AND user_tree_table.tree_id = trees.tree_id 
AND 
user_tree_table.user_id = users.user_id 
AND 
location_master.state_id = seswatch_states.state_id
AND
user_tree_table.user_id = '$userID' ;");
*/
while ($row_new_species = mysql_fetch_array($usertree)) 
{
$species_id = $row_new_species['species_id'];
$user_id = $row_new_species['user_id'];
$tree_location = $row_new_species['city'] . " " .$row_new_species['state'];
print "<tr>"; 
//$count++; 
//print "<td style='width:56px'>".$count."</td>";
echo "<td>"."<a href=\"tree_observations.php?user=".$user_id."&species=".$species_id."\">".$row_new_species['species_primary_common_name'] ."</td><td>".$row_new_species['tree_nickname']
."</td><td>".$tree_location."</td><td>".$row_new_species['date_of_addition']."</td>"; 
print "</tr>";  
}  
echo "</tbody></table>";
?>
</table>
</td>

</tr>
</table>

</div> 
</div>
<?php mysql_close($link);?>
</body>
</html>
