<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<!DOCTYPE html>
<html>
<head>
<style>
table
{
border-collapse:collapse;
}
table, td, th
{
border:1px solid black;
text-align: left;
width:80%;
}
</style>
</head>
<body>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    
   
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
$sql1="SELECT distinct user_groups.group_name,user_groups.group_id, users.full_name, users.user_name,users.user_id
					FROM `users`,`user_tree_table`,user_groups 
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='school-seed' AND 
					user_groups.coord_id=users.user_id";


$result = mysql_query($sql1);
 $schoolcunt=0;
 $treecount=0;
 $schooltreecount=0;
 $runcunt=0;
 $treeperschool=0;
 ?>
<table>
    <tr>
        <th>No</th>
     <th>school Name</th>
    <th>Treeno</th>
   
    <th>Tree name</th>
    <th>user_tree_id</th>
     <th>tree_id</th>
    <th>location_id</th>
    </tr>
    
<?
            while($row=mysql_fetch_array($result))
             {  
            
             //$schooltreecount =$treecount;?>
    <tr>
    <?
               
				$schoolname = $row['group_name'];
                                $coordname = $row['full_name'];
                                $coordid= $row['user_id'];?>
                               
                                <?                             
                                $Query="SELECT distinct m.tree_nickname ,m.user_tree_id,m.tree_id,m.members_assigned,m.date_of_addition,ug.coord_id FROM user_tree_table as m, 
                                user_tree_observations AS ut,user_groups AS ug WHERE ut.user_tree_id =m.user_tree_id and m.user_id='$row[user_id]' and ug.group_id ='$row[group_id]'";
                                //echo $Query;
                                $sql_treeNo=mysql_query($Query);
                                
                                // $preschooltreecount=$treecount;
                             //   echo $schoolcunt;
                              //  echo "<br>";
                                
                                $trrcnt= mysql_num_rows($sql_treeNo);
                                if ($trrcnt >0){$schoolcunt++;?>
                               <td width="5px;"> <?echo $schoolcunt?></td>
                                <td><?echo $schoolname?></td>
                                <? }$treecount=0;
                                while ($treerow=mysql_fetch_array($sql_treeNo))
                                {  
                                    $treeperschool++;
                                    $treecount++;?>
                                     <!--  <tr>-->
    <?
                                    
                                    //echo  "&nbsp;&nbsp; &nbsp;".$treecount."-".$schoolname."-".$coordname."-".$treerow['tree_nickname']."-".$treerow['user_tree_id'];
                                    $getloc ="Select tree_Id,tree_location_id from trees where tree_id='$treerow[tree_id]'";
                                    $getlocrow=mysql_query($getloc);
                                    list($tree_Id,$tree_location_id) = mysql_fetch_row($getlocrow);
                                   // echo $tree_Id."--". $tree_location_id;
                                   //$freshtree= $treecount;
                                    //$schoolcunt= $treecount;
                                    $treeperschool=$treecount;
                                    ?>
                                           
                                          <tr> 
                                           <td></td>
                                            <td></td>
       <td><?echo $treeperschool?></td>
    <td><?echo $treerow['tree_nickname']?></td>
    <td><?echo $treerow['user_tree_id']?></td>
     <td><?echo $treerow['tree_id']?></td>
     <td> <?echo $tree_location_id?></td>
                                           </tr>
</tr>
                                           <?
                                    //echo "<br>";
                                }
                                //echo $freshtree;
                                //echo "<br>";
                              //  $schooltreecount = $preschooltreecount+$freshtree;
                                //$schooltreecount = $treecount;
                               // $schooltreecount2 = $schooltreecount1+$treecount;
                               // echo $schooltreecount;
                               // echo $schooltreecount2;
                                //echo $schooltreecount;
                                 /* $Query="select * from users where group_id= '$row[group_id]' and group_role='coord'";
                                   $sql_treeNo=mysql_query($Query);
                                while ($treerow=mysql_fetch_array($sql_treeNo))
                                {echo  $treerow['user_id'];
                                     $treein= "Select * from user_tree_table where user_id='$treerow[user_id]'";
                                     $sql_treein=mysql_query($treein);
                                while ($treelist=mysql_fetch_array($sql_treein))
                                {
                                    echo $treelist['tree_nickname'];
                                    echo "<br>";
                                }
                                    
                                    echo "<br>";
                                }*/
                               //echo "<br>"; 
                               
            }
?>
</table>
</body>
</html>
