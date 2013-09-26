<?php
include 'includes/dbc.php';
$q = strtolower($_GET["q"]);
if (!$q) return;


$sql = "SELECT distinct user_groups.group_id, group_name
FROM users
INNER JOIN user_groups ON users.group_id = user_groups.group_id AND
users.user_category = 'school-seed' WHERE group_name LIKE '%$q%'";
$rsd = mysql_query($sql);

while($rs = mysql_fetch_array($rsd)) {
   $group_id = $rs['group_id'];
	$group_name = $rs['group_name'];
echo "$group_name|$group_id\n";
}
?>
