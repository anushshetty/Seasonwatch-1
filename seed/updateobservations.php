<?php 
include './includes/dbc.php';

//$usertreeId=($_POST['usertreeid']);
//$observationId=($_POST['observation_id']);
//echo $usertreeId; 
//echo $observationId;
//echo $_POST[is_flower_bud];

//$updatedate=date("Y-m-d",strtotime($_POST['obdate1']));
//echo $updatedate;


$sql1 = "UPDATE user_tree_observations SET  
               `date`='$_POST[obdate]', 
               `is_leaf_fresh`= '$_POST[is_leaf_fresh]',
               `freshleaf_count`='$_POST[freshleaf_count]',
               `is_leaf_mature`= '$_POST[is_leaf_mature]',
               `matureleaf_count`='$_POST[matureleaf_count]',
               `is_flower_bud`= '$_POST[is_flower_bud]', 
               `bud_count`='$_POST[bud_count]',
               `is_fruit_unripe`= '$_POST[is_fruit_unripe]',
               `fruit_unripe_count`='$_POST[fruit_unripe_count]',
               `is_fruit_ripe`= '$_POST[is_fruit_ripe]', 
               `fruit_ripe_count`='$_POST[fruit_ripe_count]',
              `is_flower_open`= '$_POST[is_flower_open]', 
              `open_flower_count`= '$_POST[open_flower_count]',
				`leaf_caterpillar`='$_POST[leaf_caterpillar]',
				`flower_butterfly`='$_POST[flower_butterfly]',
				`flower_bee`='$_POST[flower_bee]',
				`fruit_bird`='$_POST[fruit_bird]',
				`fruit_monkey`='$_POST[fruit_monkey]',			  
              `animal_desc`= '".addslashes($_POST[animal_desc])."',
              `temperature_max`= '$_POST[temperature_max]', 
              `temperature_min`= '$_POST[temperature_min]', 
              `rainfall_mm`= '$_POST[rainfall_mm]',  
              `humidity_mm`= '$_POST[humidity_mm]',
			  `user_id`='$_SESSION[user_id]'
               WHERE observation_id= '$_POST[observation_id]'";   
//echo "sql1";  
mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()); 
$sql = mysql_query("UPDATE user_tree_table SET `last_observation_date`=GREATEST('$_POST[obdate]',`last_observation_date`) WHERE user_tree_id='$_POST[usertreeid]';");

mysql_close($link); 
?>