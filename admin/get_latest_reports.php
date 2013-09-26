<div class='realtime'><div class='realtime_header'>recent reports<br>
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
	<? 
	$result=mysql_query("select count(observation_id) as obs_count from user_tree_observations;");
	$data = mysql_fetch_assoc($result);
	$total_count=$data[obs_count];
	$sql = "SELECT species_master.species_primary_common_name,species_master.species_id, users.full_name,user_tree_table.tree_nickname, trees.date_of_addition, COUNT(*) as num  from species_master INNER JOIN (user_tree_table,trees,users) ON species_master.species_id=trees.species_id AND trees.tree_id=user_tree_table.tree_id AND users.user_id=user_tree_table.user_id AND Date  BETWEEN '$start_date_sql' AND '$end_date_sql' group by  species_master.species_id order by num desc limit 5";
     	 $result2=mysql_query($sql);
  	 while($data2 = mysql_fetch_assoc($result2)) { 
    	 	     $percent_num = ( $data2['num'] / $total_count ) * 100;
    		     $percent_num = number_format($percent_num,0);
   ?>
<!-- <ul class = "chartlist">
      <li>
        <a href="species_guide.php?speciesid=<? echo $data2['species_id']; ?>"><? echo $data2['species_primary_common_name']; ?></a>
        <span class="count"><? echo $data2['num']; ?></span>
        <span class="index" style="width: <? echo $percent_num; ?>%">(<? echo $percent_num; ?>)</span>
      </li>
  </ul>  
-->
<?
}
?>
       </div> 
</div>
