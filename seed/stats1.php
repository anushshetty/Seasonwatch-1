<?include_once("includes/dbc.php");
	session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us">
<head>
    <title>SeasonWatch-Seed Statistics</title>
	<link rel="stylesheet" href="css/jq.css" type="text/css" media="print, projection, screen" />
	<script type="text/javascript" src="js/jquery-latest.js"></script>
	
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css" id="" media="print, projection, screen" />
<script type="text/javascript" id="js">$(document).ready(function() {
	// call the tablesorter plugin
	$("table").tablesorter({
		// sort on the first column and third column, order asc
		sortList: [[0,0],[2,0]]
	});
}); </script>
</head>
<body>
    <h1 style="margin:15px;font-size:20px;">Seed-SeasonWatch User Statistics</h1>
    <br>
<?
                $sql1=mysql_query("SELECT distinct users.user_id,users.date,users.date_of_addition,user_groups.group_id,user_groups.group_name, users.mobile,users.educational_district,users.full_name, users.user_name
					FROM `users`,`user_tree_table`,user_groups 
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='school-seed' AND 
					user_groups.coord_id=users.user_id");?>
    
<script language="javascript"> 
function toggle(toggleText, displayText) {
	var ele = document.getElementById(toggleText);
	var text = document.getElementById(displayText);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "display list";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide list";
	}
} 
</script>
    
<b style="margin:15px;font-size:18px;">How many Seed schools have added atleast 1 tree?</b><br/>
<span style="margin:15px;font-size:15px;font-style:normal;">Count: <? echo mysql_num_rows($sql1); ?></span></br>
<a style="margin:15px;" id="displayText_schools" href="javascript:toggle('schools', 'displayText_schools');">display list</a>
<div id="schools" style="display:none;margin:15px;font-size:15px;font-style:normal;">
<div id="main">
	<div id="demo">
		<table cellspacing="1" class="tablesorter">
		<thead>
				<tr>
					<th>School name</th>
					<th>Coordinator Name</th>
					<th>SEED user id</th>
					<th>Date </th>
					<th>User registered Date </th>
					<th>Mobile No</th>
					<th>Educational District</th>
					<th>Last observation date</th>
					<th>No of observation</th>
                                        <th>Progress Status</th>
	
				</tr>
			</thead>
			<tbody>
                            <?while ($sql1_row=mysql_fetch_array($sql1))
	{?>
				<tr>
					<td><?echo $sql1_row['group_name']?></td>
                                        
		<td><?echo $sql1_row['full_name'] ?></td>
		<td><?echo $sql1_row['user_name'] ?></td>
		 <td><?echo $sql1_row['date'] ?></td>
                <td><?echo $sql1_row['date_of_addition']?></td>
                <td><?echo $sql1_row['mobile'] ?></td>
				<td><?echo $sql1_row['educational_district'] ?></td>
                <?$Query="SELECT date FROM  user_tree_observations WHERE  `user_id` ='$sql1_row[user_id]' ORDER BY  `user_tree_observations`.`date` DESC LIMIT 0 , 1  ";
                $sql_treeNo=mysql_query($Query);
                list($lastobdate)=mysql_fetch_row($sql_treeNo);?>
                <td><?echo $lastobdate ?></td>
               <? $Query_2="SELECT * FROM  user_tree_observations WHERE  `user_id` ='$sql1_row[user_id]'  ";
                $sql_treeNo_2=mysql_query($Query_2);
                $totalob = mysql_num_rows($sql_treeNo_2);?>
               <td><?echo $totalob; ?></td>
                <?$Indiffdate= round(abs(strtotime($today)-strtotime($lastobdate))/86400);
               // echo "<td>" . $xcc . "</td>";
               //$Indiffdate = round(abs(strtotime($today)-strtotime($lastobdate))/86400 ;
                if ($Indiffdate<=10)
                {
                    ?>
                     
                   <td> <img src="images/red_flag.png" width="30" height="30\"></img></td>
              <?  }
                else
                {
                     $flag="yes";?>
                     
                   <td> <img src="images/green_flag.png" width="30" height="30"></img></td>
                                                <?
                }?>
				</tr>
				<?}?>
			</tbody>
		</table>
	</div>
	
</div>
</div>
 <br />  
  <br />

<?php
        $sql2=mysql_query("SELECT users.full_name, users.user_name, 
        user_tree_table.tree_id, user_tree_table.tree_nickname
        FROM `user_tree_table` , users
        WHERE users.user_category = 'school-seed'
        AND `user_tree_table`.user_id = users.user_id");
?>
<b style="margin:15px;font-size:18px;">Which trees have been added?</b></br>
<span style="margin:15px;font-size:15px;font-style:normal;">Count: <? echo mysql_num_rows($sql2);?></span></br>
<a style="margin:15px;"id="displayText_trees" href="javascript:toggle('trees', 'displayText_trees');">display list</a>
<div id="trees" style="display:none;margin:15px;">
<table border="1" style="margin:15px;font-size:15px;font-style:normal;">
<?php
		echo "<tr><td><b>User Name</b></td>";
		echo "<td><b>SEED id</b></td>";
		echo "<td><b>Tree id</b></td>";		
		echo "<td><b>Tree nickname</b></td></tr>";		
	while ($sql2_row=mysql_fetch_array($sql2))
	{
		echo "<tr><td>" . $sql2_row['full_name'] . "</td>";
		echo "<td>" . $sql2_row['user_name'] . "</td>";
		echo "<td>" . $sql2_row['tree_id'] . "</td>";	
		echo "<td>" . $sql2_row['tree_nickname'] . "</td></tr>";			
	}
?>
</table>
</div>
<br/><br/>
<?php
$qu1="select users.full_name, users.user_name, users.user_id,users.educational_district,
						user_tree_observations.date, user_tree_table.tree_id from 
						user_tree_observations, users, user_tree_table WHERE
						user_tree_observations.user_id=users.user_id AND
						users.user_category='school-seed' AND
						users.group_role='coord' AND
						user_tree_table.user_tree_id = user_tree_observations.user_tree_id
						ORDER BY users.user_id, user_tree_observations.date";
	$sql3=mysql_query("select users.full_name, users.user_name, users.user_id,users.educational_district,
						user_tree_observations.date, user_tree_table.tree_id from 
						user_tree_observations, users, user_tree_table WHERE
						user_tree_observations.user_id=users.user_id AND
						users.user_category='school-seed' AND
						users.group_role='coord' AND
						user_tree_table.user_tree_id = user_tree_observations.user_tree_id
						ORDER BY users.user_id, user_tree_observations.date");
        //echo $qu1;

?>
<b style="margin:15px;font-size:18px;">Who has added observation, on which tree and when?</b><br/>
<span style="margin:15px;font-size:15px;font-style:normal;">Count: <? echo mysql_num_rows($sql3); ?></span><br />
<a  style="margin:15px;" id="displayText_observations" href="javascript:toggle('observations', 'displayText_observations');">display list</a>
<div id="observations" style="display:none">
<table border="1" style="margin:15px;font-size:15px;font-style:normal;">
<?php
		echo "<tr><td><b>User Name</b></td>";
		echo "<td><b>SEED id</b></td>";
		echo "<td><b>Date of Obs</b></td>";		
		echo "<td><b>Tree id</b></td>";
                echo "<td><b>educational_district</b></td></tr>";		
	while ($sql3_row=mysql_fetch_array($sql3))
	{
		echo "<tr><td>" . $sql3_row['full_name'] . "</td>";
		echo "<td>" . $sql3_row['user_name'] . "</td>";
		echo "<td>" . $sql3_row['date'] . "</td>";					
		echo "<td>" . $sql3_row['tree_id'] . "</td>";
                echo "<td>". $sql3_row['educational_district'] ."</td></tr>";	 
	}
?>
</table>
</div>
<br/><br/>

<?php
	$sql4=mysql_query("select species_primary_common_name, count(*)
from species_master, users, user_tree_table, trees
where user_category='school-seed' AND
users.user_id=user_tree_table.user_id AND
user_tree_table.tree_id=trees.tree_id AND
species_master.species_id=trees.species_id
group by species_primary_common_name");

?>
<b style="margin:15px;font-size:18px;">How many trees of each of the 25 species has been added?</b>
<br />
<a style="margin:15px;" id="displayText_species_count" href="javascript:toggle('species_count', 'displayText_species_count');">display list</a>
<div id="species_count" style="display:none">
<table border="1" style="margin:15px;font-size:15px;font-style:normal;">

<?php
		echo "<tr><td><b>Species Common Name</b></td>";
		echo "<td><b>No. of trees</b></td></tr>";
	while ($sql4_row=mysql_fetch_array($sql4))
	{
		echo "<tr><td>" . $sql4_row['species_primary_common_name'] . "</td>";
		echo "<td>" . $sql4_row['count(*)'] . "</td></tr>";
	}
?>
</table>
</div>
<br/><br/>
<b  style="margin:15px;font-size:18px;">In the selected educational districts which schools have added at least 1 tree?</b>
<br />

<form action="stats.php" method=POST>
<table style="margin:15px;font-size:15px;font-style:normal;">
<tr>
<td><input type="checkbox" name="educational_district[]" value="Alappuzha" />Alappuzha</td>
<td><input type="checkbox" name="educational_district[]" value="Aluva" />Aluva</td>
<td><input type="checkbox" name="educational_district[]" value="Attingal" />Attingal</td>
<td><input type="checkbox" name="educational_district[]" value="Calicut" />Calicut</td>
<td><input type="checkbox" name="educational_district[]" value="Chavakkad" />Chavakkad</td>
<td><input type="checkbox" name="educational_district[]" value="Cherthala" />Cherthala</td>
</tr><tr>
<td><input type="checkbox" name="educational_district[]" value="Ernakulam" />Ernakulam</td>
<td><input type="checkbox" name="educational_district[]" value="Idukki" />Idukki</td>
<td><input type="checkbox" name="educational_district[]" value="Irinjalakuda" />Irinjalakuda</td>
<td><input type="checkbox" name="educational_district[]" value="Kaduthuruthy" />Kaduthuruthy</td>
<td><input type="checkbox" name="educational_district[]" value="Kanhangad" />Kanhangad</td>
<td><input type="checkbox" name="educational_district[]" value="Kanjirappally" />Kanjirapally</td>
</tr><tr>
<td><input type="checkbox" name="educational_district[]" value="Kannur" />Kannur</td>
<td><input type="checkbox" name="educational_district[]" value="Kasaragode" />Kasaragode</td>
<td><input type="checkbox" name="educational_district[]" value="Kattappana" />Kattappana</td>
<td><input type="checkbox" name="educational_district[]" value="Kollam" />Kollam</td>
<td><input type="checkbox" name="educational_district[]" value="Kothamangalam" />Kothamangalam</td>
<td><input type="checkbox" name="educational_district[]" value="Kottarakkara" />Kottarakkara</td>
</tr><tr>
<td><input type="checkbox" name="educational_district[]" value="Kottayam" />Kottayam</td>
<td><input type="checkbox" name="educational_district[]" value="Kulakkada" />Kulakkada</td>
<td><input type="checkbox" name="educational_district[]" value="Kuttanad" />Kuttanad</td>
<td><input type="checkbox" name="educational_district[]" value="Malappuram" />Malappuram</td>
<td><input type="checkbox" name="educational_district[]" value="Mavelikara" />Mavelikara</td>
<td><input type="checkbox" name="educational_district[]" value="Moovatupuzha" />Moovatupuzha</td>
</tr><tr>
<td><input type="checkbox" name="educational_district[]" value="Neyyattinkara" />Neyyattinkara</td>
<td><input type="checkbox" name="educational_district[]" value="Ottapalam" />Ottapalam</td>
<td><input type="checkbox" name="educational_district[]" value="Pala" />Pala</td>
<td><input type="checkbox" name="educational_district[]" value="Palakkad" />Palakkad</td>
<td><input type="checkbox" name="educational_district[]" value="Pathanamthitta" />Pathanamthitta</td>
<td><input type="checkbox" name="educational_district[]" value="Punalur" />Punalur</td>
</tr><tr>
<td><input type="checkbox" name="educational_district[]" value="Telicherry" />Thalassery</td>
<td><input type="checkbox" name="educational_district[]" value="Thamarassery" />Thamarassery</td>
<td><input type="checkbox" name="educational_district[]" value="Thiruvalla" />Thiruvalla</td>
<td><input type="checkbox" name="educational_district[]" value="Thodupuzha" />Thodupuzha</td>
<td><input type="checkbox" name="educational_district[]" value="Thrissur" />Thrissur</td>
<td><input type="checkbox" name="educational_district[]" value="Thuravoor" />Thuravoor</td>
</tr><tr>
<td><input type="checkbox" name="educational_district[]" value="Tirur" />Tirur</td>
<td><input type="checkbox" name="educational_district[]" value="Trivandrum" />Trivandrum</td>
<td><input type="checkbox" name="educational_district[]" value="Vatakara" />Vatakara</td>
<td><input type="checkbox" name="educational_district[]" value="Veliyam" />Veliyam</td>
<td><input type="checkbox" name="educational_district[]" value="Veliyanad" />Veliyanad</td>
<td><input type="checkbox" name="educational_district[]" value="Wandoor" />Wandoor</td>
</tr><tr>
<td><input type="checkbox" name="educational_district[]" value="Wayanad" />Wayanad</td>
</tr>
</table>
<input type=submit name="submit" id="submit" value="Submit">
</form> 
<?php
if ($_POST['submit']) {
//echo "form submitted";
$an_educational_district = $_POST['educational_district'];  

  if(empty($an_educational_district))  
  {  
    echo("You didn't select any districts.");  
  }  
  else 
  {  
    $N = count($an_educational_district);  
    //echo("You selected $N educational district(s): ");  
	$edu_dist_list = "(";
    for($i=0; $i < $N; $i++)  
    {  
	  $edu_dist_list .= "'".$an_educational_district[$i]."'";
	  if ($i<$N-1)
		$edu_dist_list .= ", ";
    }  
	$edu_dist_list .= ")";
	//echo $edu_dist_list;
    $sql5=mysql_query("SELECT distinct user_groups.group_name, users.full_name, users.user_name, users.educational_district
					FROM `users`,`user_tree_table`,user_groups 
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='school-seed' AND 
					user_groups.coord_id=users.user_id AND
					`educational_district` IN ".$edu_dist_list.
					"ORDER BY educational_district");
?>
<!--<a id="displayText_schools_edudistrict" href="javascript:toggle('schools_edudistrict', 'displayText_schools_edudistrict');">display list</a>-->
<div id="schools_edudistrict" > <!--style="display:none">-->
<span style="margin:15px;font-size:18px;">Count: <? echo mysql_num_rows($sql5); ?></span><<br />
<table border="1">

<?php
		echo "<tr><td><b>School name</b></td>";
		echo "<td><b>Educational District</b></td>";		
		echo "<td><b>Coordinator Name</b></td>";
		echo "<td><b>SEED user id</b></td></tr>";
	while ($sql5_row=mysql_fetch_array($sql5))
	{
		echo "<tr><td>" . $sql5_row['group_name'] . "</td>";
		echo "<td>" . $sql5_row['educational_district'] . "</td>";
		echo "<td>" . $sql5_row['full_name'] . "</td>";
		echo "<td>" . $sql5_row['user_name'] . "</td></tr>";
	}
?>
</table>
</div>

<?php
}
}
else {?>
<span style="margin:15px;">"No educational districts chosen yet"</span>

<?}
?>    

</body>
</html>

