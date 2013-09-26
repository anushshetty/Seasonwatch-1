<?php
session_start();
include 'includes/dbc.php';

/*
list($username_unique)=mysql_fetch_row(mysql_query("SELECT count(*) as c FROM users 
										WHERE group_id='$_SESSION[group_id]' AND user_name='$_POST[user_name]'"));

if ($username_unique>1)
{
	echo "Username not unique";
}
else*/
if ($_POST[pwd])
{
	mysql_query("UPDATE users SET
				full_name='$_POST[full_name]',
				user_name='$_POST[user_name]',
				pwd=md5($_POST[pwd]),
				group_class='$_POST[group_class]'
				WHERE user_id='$_POST[user_id]';
				");
	if ($_SESSION['user_id']==$_POST[user_id]) {$_SESSION['pwd_change_required']=0;}
//	echo "updated including pwd";
}	
else
{
	mysql_query("UPDATE users SET
				full_name='$_POST[full_name]',
				user_name='$_POST[user_name]',
				group_class='$_POST[group_class]'
				WHERE user_id='$_POST[user_id]';
				");
//	echo "updated NOT including pwd";				
}
	mysql_query("UPDATE user_tree_table SET
				members_assigned=REPLACE(members_assigned, '$_POST[user_id], ', '')
				");
	mysql_query("UPDATE user_tree_table SET
				members_assigned=REPLACE(members_assigned, ', $_POST[user_id]', '')
				");
	mysql_query("UPDATE user_tree_table SET
				members_assigned=REPLACE(members_assigned, '$_POST[user_id]', '')
				");				
	$members=explode(", ",$_POST[trees_assigned]);
	$i=0;
	while($members[$i])
	{
		mysql_query("UPDATE user_tree_table SET
				members_assigned=concat(members_assigned,left(', ',char_length(members_assigned)),'$_POST[user_id]')
				WHERE user_tree_id='$members[$i]';
				");
		$i++;
	}
	
mysql_close($link);
?>