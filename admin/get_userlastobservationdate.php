<?php 
   session_start();
   $page_title="SeasonWatch";
   include("../includes/dbc.php");
   include("main_includes.php");
   //include("../functions.php");

?>

</head>
<body>
<div class="body_main"> 
<div class='container first_image'>

<?php
include("admin_header.php");
?>
</table>
<div>
<hr/>
</div>

</td>

</tr>
</table>
<div  style='font-size:16px;text-align:center;font-weight: bold;' >List of user who has not updated the observation from last 4 weeks or a month.</div>
<br>
<?php 
$sql="SELECT distinct ut.tree_id, ut.tree_nickname,ut.user_tree_id, us.user_id,us.user_email FROM 
    users as us,user_tree_table as ut, trees as t,user_tree_observations as uto where  
    t.tree_Id=ut.tree_id and t.deleted='0' and ut.user_id != 140 and uto.user_tree_id=ut.user_tree_id and us.user_id=ut.user_id";
//echo $sql; 
echo "<br>";
$trees = mysql_query($sql);
   $num_trees = mysql_num_rows($trees);
   //echo $num_trees;?>
<table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style='width:100px' align="left">S No.</th>
                                <th style='width:200px' align="left">User ID</th>           
                                <th style='width:280px' align="left">User_email</th>
                                <th style='width:280px' align="left">Tree_nickname</th>                        
				<th style='width:220px' align="left">Last observation date</th>
                                <th style='width:150px' align="left" >Observation Pending from</th>
                               
<th style='width:150px' align="left">Email</th>
  </tr>
                </thead>
<tbody>

   
  
  <?$count=0;
  while ($prows = mysql_fetch_array($trees)) 
   { $count++; ?>
<tr> 
    <td><?echo $count;?></td>
        <td >#<? echo $prows['user_id']?></td>
        <td><? echo $prows['user_email']?></td>
        <td ><? echo $prows['tree_nickname']?></td>
        <?//get latest observation date 
        $q2="SELECT  MAX(date) AS lastobservationdate FROM `user_tree_observations` where user_tree_id=$prows[user_tree_id]";
        $tree_lastob = mysql_query($q2);
        $data=mysql_fetch_assoc($tree_lastob);
        $num_obs = $data['lastobservationdate'];
        $obdate= $num_obs;
        $today=date("Y-m-d");
        // $obdatetimestamp=strtotime($obdate);
        //echo $obdatetimestamp;
        $date_diff=strtotime($today) - strtotime($obdate);
        $diffd= ($date_diff/(60 * 60 * 24))." days"; //( 60 * 60 * 24) // seconds into days
        $sendemail ="";
        if ($diffd >30)
             $sendemail ="send email";
        
        ?>
        <td > <? echo $obdate;?> </td>
        <td > <? echo $diffd;?> </td>
        <?
$subject = "Gentle remainder to add observations";




?>
        <td><?if ($diffd >30){?> <a href="mailto:<?echo $prows['user_email'];?>?subject=<?echo $subject;?>
&cc=sw@seasonwatch.in
">Send email</a><?}?> </td>
</tr>
      <?
   }
   
//List all the active user 

?>

 </table>




</div> 
</div>
<?php mysql_close($link);?>
</body>
</html>
