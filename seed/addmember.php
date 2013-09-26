<?php
session_start();
include 'includes/dbc.php';
if ($_POST[pwd])
{
	$sql="INSERT INTO users (full_name, user_name, pwd, date, user_category, group_id, group_role, group_class, user_email)
				VALUES 
				(
				'$_POST[full_name]', '$_POST[user_name]', 
				md5($_POST[pwd]), now(), '$_POST[user_category]', $_SESSION[group_id], '$_POST[group_role]', '$_POST[group_class]',
				'$_SESSION[group_id].$_POST[user_name].".rand()."@seasonwatch.in')";
} else {
	$sql="INSERT INTO users (full_name, user_name, date, user_category, group_id, group_role, group_class, user_email)
				VALUES 
				(
				'$_POST[full_name]', '$_POST[user_name]', 
				now(), '$_POST[user_category]', $_SESSION[group_id], '$_POST[group_role]', '$_POST[group_class]',
				'$_SESSION[group_id].$_POST[user_name].".rand()."@seasonwatch.in')";
}
	mysql_query($sql);
	//echo $sql;
	list($user_id)=mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID() FROM users"));
	$members=explode(", ",$_POST[trees_assigned]);
	$i=0;
	while($members[$i])
	{
		mysql_query("UPDATE user_tree_table SET
				members_assigned=concat(members_assigned,left(', ',char_length(members_assigned)),'$user_id')
				WHERE user_tree_id='$members[$i]';
				");
		$i++;
	}
mysql_close($link);
?>