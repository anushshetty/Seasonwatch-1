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
<td class="cms" style="solid rgb(217, 92, 21); width: 50%;">
<table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style='width:80px'>S No.</th>
                                <th style='width:220px'>Species Name</th>           
                                <th style='width:240px'>Tree Nickname</th>
                                <th style='width:200px'>User Name</th>                        
				<th style='width:100px'>User ID</th>
<th style='width:100px'>City</th>
<th style='width:100px'>State</th>
<th style='width:200px'>Last Observation date</th>
  </tr>
                </thead>
<tbody>


<?php 
$count=0;
$last_months_date = date("Y-m-d",mktime(0, 0, 0, date("m")-3, date("d"),   date("Y")));
//echo $last_months_date;
$count_new_trees = mysql_query("SELECT count(tree_id) FROM trees WHERE date_of_addition > '" . $last_months_date . "'");
$row_new_trees = mysql_fetch_array($count_new_trees);
$count_new_observations = mysql_query("SELECT count(observation_id) FROM user_tree_observations WHERE date > '" . $last_months_date . "'");
$row_new_observations = mysql_fetch_array($count_new_observations);
$new_species = mysql_query("SELECT species_master.species_primary_common_name, species_master.species_id,  location_master.city, users.full_name,users.user_id, seswatch_states.state,user_tree_table.tree_nickname,
user_tree_observations.date 
FROM trees 
INNER JOIN (species_master,location_master, user_tree_table, users, user_tree_observations, seswatch_states) 
ON trees.species_id = species_master.species_id 
AND trees.tree_location_id=location_master.tree_location_id 
AND user_tree_table.tree_id=trees.tree_id 
AND 
user_tree_table.user_id=users.user_id  and users.user_id!=140
AND 
location_master.state_id = seswatch_states.state_id
AND
user_tree_observations.user_tree_id=user_tree_table.user_tree_id
AND
trees.date_of_addition > '" . $last_months_date .  "'  order by user_tree_observations.date desc
;");

while ($row_new_species = mysql_fetch_array($new_species)) 
{
$species_id = $row_new_species['species_id'];
$user_id = $row_new_species['user_id'];
print "<tr>"; 
$count++; 
print "<td style='width:56px'>".$count."</td>";
//print $row_settings['species_id'];
echo "<td>".$row_new_species['species_primary_common_name'] . "</td><td>".$row_new_species['tree_nickname']."</td><td><a href=\"user_profile.php?user=".$user_id."\">". $row_new_species['full_name']."</td><td>".$row_new_species['user_id']."</td><td>".$row_new_species['city']."</td><td>".$row_new_species['state']."</td><td>".$row_new_species['date']."</td>"; 

/* $edittreeLink = "<a class=thickbox href=\"editspecies.php?speciesid=".$row_new_species['species_id']."&TB_iframe=true&height=500&width=700\">Edit</a>";
print "<td>$edittreeLink</td>"; 

$var=$row_new_species['species_id'];
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
