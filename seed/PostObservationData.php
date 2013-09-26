<?php
	include_once("includes/dbc.php");
	
	if ($_POST[tree_id]=="" || $_POST[school_id]=="") 
	{
		echo $_POST[tree_id]."xx".$_POST[school_id];
		die ("tree_id or school_id is empty.");
	}
	
	$sql1="SELECT user_tree_id,user_id FROM user_tree_table WHERE tree_code_sms='$_POST[tree_id]' AND 
	user_id in (SELECT coord_id FROM `user_groups` WHERE school_code_sms='$_POST[school_id]');";
	$result1 = mysql_query($sql1) or die (mysql_error()); 
	list($user_tree_id,$user_id)=mysql_fetch_row($result1);
	
	$date=$_POST[observation_date];
	$is_leaf_fresh=  ($_POST[freshleaf_count]=='0')?0: (($_POST[freshleaf_count]=='x')?2:1);
	$is_leaf_mature=($_POST[matureleaf_count]=='0')?0:(($_POST[matureleaf_count]=='x')?2:1);
	$is_flower_bud=($_POST[flowerbud_count]=='0')?0:(($_POST[flowerbud_count]=='x')?2:1);
	$is_flower_open=($_POST[openflower_count]=='0')?0:(($_POST[openflower_count]=='x')?2:1);
	$is_fruit_unripe=($_POST[unripefruit_count]=='0')?0:(($_POST[unripefruit_count]=='x')?2:1);
	$is_fruit_ripe=($_POST[ripefruit_count]=='0')?0:(($_POST[ripefruit_count]=='x')?2:1);
	$freshleaf_count=($_POST[freshleaf_count]=='1')?'Few':(($_POST[freshleaf_count]=='2')?'Many':'');
	$matureleaf_count=($_POST[matureleaf_count]=='1')?'Few':(($_POST[matureleaf_count]=='2')?'Many':'');
	$bud_count=($_POST[flowerbud_count]=='1')?'Few':(($_POST[flowerbud_count]=='2')?'Many':'');
	$open_flower_count=($_POST[openflower_count]=='1')?'Few':(($_POST[openflower_count]=='2')?'Many':'');
	$fruit_unripe_count=($_POST[unripefruit_count]=='1')?'Few':(($_POST[unripefruit_count]=='2')?'Many':'');
	$fruit_ripe_count=($_POST[ripefruit_count]=='1')?'Few':(($_POST[ripefruit_count]=='2')?'Many':'');
	
	$sql2 = "INSERT INTO `user_tree_observations` (`date`, `is_leaf_fresh`, `is_leaf_mature`, `is_flower_bud`, `is_flower_open`,
	`is_fruit_unripe`, `is_fruit_ripe`, `freshleaf_count`, `matureleaf_count`, `bud_count`, `open_flower_count`, 
	`fruit_unripe_count`, `fruit_ripe_count`, `user_tree_id`, `user_id`) VALUES
	('$date',
	$is_leaf_fresh,
	$is_leaf_mature,
	$is_flower_bud,
	$is_flower_open,
	$is_fruit_unripe,
	$is_fruit_ripe,
	'$freshleaf_count',
	'$matureleaf_count',
	'$bud_count',
	'$open_flower_count',
	'$fruit_unripe_count',
	'$fruit_ripe_count',
	$user_tree_id,$user_id);"; 
	$result2 = mysql_query($sql2) or die (mysql_error()); 
	echo "all is well";
?>