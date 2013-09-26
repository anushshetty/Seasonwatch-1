<?php 
   session_start();
   $page_title="SeasonWatch";
   include("../includes/dbc.php");
   include("main_includes.php");
  // include("bulkupload.php");
$userID = $_GET['user'];
$treeID = $_GET['treeid'];
echo $treeID;
?>
</head>
<body>
<div class='body_main'>
<div class='container first_image'>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<div>
<h3>Tree Observations</h3>
<?php
include("admin_header.php");
?>
</table>
<div>
<hr/>
</div>

<div id="pager" class="column span-7" style="" >
     <form action="tree_observations.php" name="bulkupload" method="post" enctype="multipart/form-data">
        <table >
        <tr>
		<td>
		<label for="file">Upload tree observation details:</label>
		</td>
		
		</tr>
		<tr>
		<td>
		<input type="file" name="file" id="file" />
		</td>
		<td>
		<input type="submit" name="submit" value="submit" class=buttonstyle>
		</td>
		</tr>
		<tr> 
		<td>
		<a href='sample1.csv'>Download sample csv file</a>"
		</td>
		</tr>
		<?php
		if($_POST['submit'] == 'submit')  
		{ 
			$uploadedfile = basename( $_FILES['file']['name']);

			$filename = basename( $_FILES['file']['name']);
			$ext = end(explode(".", $filename));
			if (($ext == "csv") || ($ext == "CSV"))
			  {
			  if ($_FILES["file"]["error"] > 0)
				{
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
				}
			  else
				{
				//$target_path = "uploads/";
				$target_path = "uploads/";
	
				$target_path = $target_path . basename( $_FILES['file']['name']); 
				
				if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
					echo "The file ".  basename( $_FILES['file']['name']). 
					" has been uploaded";
				} else{
					echo "There was an error uploading the file, please try again!";
				}
				if (($handle = fopen( $target_path, "r")) !== FALSE) {
					$i=0;
					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) 
					{
						$user_id = $data[0];
						$user_tree_id = $data[1];
						$date = $data[2] ;
						$observation_time = $data[3];
						$matureleaf_count = $data[4];
						$freshleaf_count = $data[5];
						$bud_count = $data[6];
						$open_flower_count = $data[7];
						$fruit_unripe_count = $data[8];
						$fruit_ripe_count = $data[9];
						$leaf_caterpillar = $data[10];
						$flower_butterfly = $data[11];
						$flower_bee = $data[12];
						$fruit_bird = $data[13];
						$fruit_monkey = $data[14];
						
									
						if($i>0){
							$q="insert into user_tree_observations (user_id, user_tree_id, date, observation_time, matureleaf_count, freshleaf_count, bud_count, open_flower_count, fruit_unripe_count, fruit_ripe_count, leaf_caterpillar, flower_butterfly, flower_bee, fruit_bird, fruit_monkey)
							values ('$user_id', '$user_tree_id', '$date', '$observation_time', '$matureleaf_count', '$freshleaf_count', '$bud_count', '$open_flower_count', '$fruit_unripe_count', '$fruit_ripe_count', '$leaf_caterpillar', '$flower_butterfly', '$flower_bee', '$fruit_bird', '$fruit_monkey')";
							
							mysql_query($q);
						}
						?>
							<!--<tr>
								<?php
								foreach($data as $rec){
									echo '<td>'.$rec.'</td>';
								}
								?>
							</tr> -->
						<?php
						$i++;
					}
				}
				fclose($handle);
				unlink($target_path);
				}
			 }
			else
			  {
			  echo "Invalid file";
			  }
		}
//		else
//		{
//			echo "error in uploading";
//		}
		?>
		</table>
     </form>
 </div>


<table>
<tr>
<?
if($_REQUEST['treeobservation']=='viewall')
{
	$last_months_date = 0;

$view3monthstreeLink = "<a href='tree_observations.php'>View Last 3 Months Tree Observations</a>";
print "<td>$view3monthstreeLink</td>";

}
else
{
$last_months_date = date("Y-m-d",mktime(0, 0, 0, date("m")-3, date("d"),   date("Y")));
//echo $last_months_date;

$viewalltreeLink = "<a href='tree_observations.php?treeobservation=viewall'>View All Tree Observations</a>";
print "<td>$viewalltreeLink</td>";
}
?>
</tr>

<tr>
<td>


<script type="text/javascript">
        $(function() { 

             $("#table1")
                .tablesorter({  headers: { 
                   5: { sorter: false }, 6: { sorter: false }, 7 : { sorter: false }, 8: { sorter: false } },widthFixed: true, widgets: ['zebra']})
                   .tablesorterPager({container: $("#pager"), positionFixed: false});

              $("#table2")
                .tablesorter({widthFixed: true, widgets: ['zebra']})
                .tablesorterPager({container: $("#pager2"), positionFixed: false});
                     
        });
    </script> 

<table id="table1" class="tablesorter">

                <thead>
				
                        <tr>
                                <th style='width:80px'>S No.</th>
								<th style='width:110px'>Username</th>
								<th style='width:110px'>Tree Name</th>
                                <th style='width:110px'>Fresh Status</th>    
				<th style='width:110px'>Mature Status</th>
				<th style='width:110px'>Bud Status</th>
				<th style='width:110px'>Ripe Status</th>       
                             

<th style='width:110px'>Last Observation date</th>
  </tr>
                </thead>
<tbody>


<?php 
$count=0;

$count_new_trees = mysql_query("SELECT count(tree_id) FROM trees WHERE date_of_addition > '" . $last_months_date . "'");

$row_new_trees = mysql_fetch_array($count_new_trees);
$count_new_observations = mysql_query("SELECT count(observation_id) FROM user_tree_observations WHERE date > '" . $last_months_date . "'");

$row_new_observations = mysql_fetch_array($count_new_observations);

$tree_observations = mysql_query("Select u.full_name, utt.tree_nickname, uto.observation_id,    uto.date,uto.is_leaf_mature, uto.is_leaf_fresh, uto.is_flower_bud,  uto.is_fruit_ripe,uto.is_fruit_unripe, uto.is_flower_open, uto.freshleaf_count, uto.matureleaf_count,
uto.bud_count, uto.fruit_ripe_count, uto.fruit_unripe_count, uto.open_flower_count, uto.animal_desc 
FROM user_tree_observations as uto
LEFT JOIN users as u ON u.user_id = uto.user_id
LEFT JOIN user_tree_table as utt ON uto.user_tree_id = utt.user_tree_id
WHERE uto.date > '" . $last_months_date . "' 
GROUP BY utt.tree_nickname, uto.date ORDER BY uto.date desc");

/*LEFT JOIN user_tree_table as utt ON 
INNER JOIN (user_tree_table)
ON user_tree_observations.user_tree_id = user_tree_table.user_tree_id
AND user_tree_table.user_id = '$userID'*/

while ($row_new_obs = mysql_fetch_array($tree_observations)) 
{
print "<tr>"; 
$count++; 
print "<td style='width:56px'>".$count."</td>";
//print $row_new_obs['species_id'];


/* for fresh status */
if($row_new_obs['is_leaf_fresh']== '0') 
{
	$row_new_obs['is_leaf_fresh']= "No";
}
elseif($row_new_obs['is_leaf_fresh'] == "1")
{
$row_new_obs['is_leaf_fresh'] = "Yes";

}
elseif($row_new_obs['is_leaf_fresh']  == "2")
{
$row_new_obs['is_leaf_fresh']= "Dont Know";
}


/* for mature status */
if($row_new_obs['is_leaf_mature']== '0') 
{
	$row_new_obs['is_leaf_mature']= "No";
}
elseif($row_new_obs['is_leaf_mature'] == "1")
{
$row_new_obs['is_leaf_mature'] = "Yes";
}
elseif($row_new_obs['is_leaf_mature']  == "2")
{
$row_new_obs['is_leaf_mature']= "Dont Know";
}


/* for bud status */
if($row_new_obs['is_flower_bud']== '0') 
{
	$row_new_obs['is_flower_bud']= "No";
}
elseif($row_new_obs['is_flower_bud'] == "1")
{
$row_new_obs['is_flower_bud'] = "Yes";
}
elseif($row_new_obs['is_flower_bud']  == "2")
{
$row_new_obs['is_flower_bud']= "Dont Know";
}



/* for fruit ripe status */
if($row_new_obs['is_fruit_ripe']== '0') 
{
	$row_new_obs['is_fruit_ripe']= "No";
}
elseif($row_new_obs['is_fruit_ripe'] == "1")
{
$row_new_obs['is_fruit_ripe'] = "Yes";
}
elseif($row_new_obs['is_fruit_ripe']  == "2")
{
$row_new_obs['is_fruit_ripe']= "Dont Know";
}


echo "<td>".$row_new_obs['full_name']."</td><td>".$row_new_obs['tree_nickname']."</td><td>".$row_new_obs['is_leaf_fresh']."</td><td>".$row_new_obs['is_leaf_mature']."</td><td>".$row_new_obs['is_flower_bud']."</td><td>".$row_new_obs['is_fruit_ripe']." </td><td>".$row_new_obs['date']."</td>"; 
/* $edittreeLink = "<a class=thickbox href=\"editspecies.php?speciesid=".$row_new_species['species_id']."&TB_iframe=true&height=500&width=700\">Edit</a>";
print "<td>$edittreeLink</td>"; 
$var=$row_new_obs['species_id'];
$deletetreeLink = "<a  href='listspecies.php' onclick=confirmDelete('$var');>Delete</a>";
//$deletetreeLink = "<a  href='listspecies.php?id=$var' >Delete</a>";
print "<td>$deletetreeLink</td>"; */
print "</tr>";  
}  
echo "</tbody></table>";
?>

<div id="pager" class="column span-7" style="" >
                        <form name="" action="" method="post">
                                <table >
                                <tr>
                                        <td><img src='pager/icons/first.png' class='first'/></td>
                                        <td><img src='pager/icons/prev.png' class='prev'/></td>
                                        <td><input type='text' size='8' class='pagedisplay'/></td>
                                        <td><img src='pager/icons/next.png' class='next'/></td>
                                        <td><img src='pager/icons/last.png' class='last'/></td>
                                        <td>
                                                <select class='pagesize'>
                                                        <option selected='selected'  value='10'>10</option>
                                                        <option value='20'>20</option>
                                                        <option value='30'>30</option>
                                                        <option  value='40'>40</option>
                                                </select>
                                        </td>
                                </tr>
                                </table>
                        </form>
                </div>

</table>
</td>
