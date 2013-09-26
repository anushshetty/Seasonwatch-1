<div class='realtime'><div class='realtime_header'>top contributors<br>
<small>
<?php 
$userID = $_GET['user'];
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
	$sql = "SELECT species_master.species_primary_common_name,
	species_master.species_id,
	users.full_name,
	users.user_id, 
	user_tree_table.tree_nickname, 
	trees.date_of_addition,
        user_tree_table.tree_id,
        user_tree_table.user_tree_id, 
	COUNT(*) as num  
	from species_master 
	INNER JOIN (user_tree_table,trees,users) 
	ON species_master.species_id=trees.species_id 
	AND trees.tree_id=user_tree_table.tree_id 
	AND users.user_id=user_tree_table.user_id 
	AND Date  BETWEEN '$start_date_sql' 
	AND '$end_date_sql' 
	group by  user_tree_table.user_id 
	order by num desc limit 5";
     	 
 $result2=mysql_query($sql);
 while($data2 = mysql_fetch_assoc($result2)) { 

$result=mysql_query("select count(user_tree_id) as tree_count from user_tree_table WHERE user_id = $data2[user_id];");
	$data = mysql_fetch_assoc($result);
	$total_count=$data[tree_count];
      ?>
<ul class="chartlist">
      <li>
        <a href="user_profiles.php?<? echo "user=".$data2[user_id] . '&' . "treeid=".$data2[tree_id]; ?>"><? echo $data2['full_name']; ?></a>
        <span class="count"><? echo $total_count; ?></span>
        <span class="index" style="width: <? echo $result; ?>%">(<? echo $result; ?>)</span>
      </li>
  </ul>
<?
}
?>
       </div> 
</div>
