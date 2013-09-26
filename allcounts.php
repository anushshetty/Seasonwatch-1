<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
//include_once("includes/dbc.php");
session_start();
echo "Seed user:- ";
echo "<br>";
  $allseedq = "SELECT count(distinct(user_id)) as num  from users where user_category='school-seed'";
 
 // $result4=mysql_query($allseedq);
  $result4=$dbc->readtabledata($allseedq);
$data=mysql_fetch_assoc($result4);
$allseeduser = $data['num'];
  //$allseeduser=mysql_num_rows($allseedq); // all seed user 
  //echo "allseeduser".$allseeduser; echo "<br>";
  
  $allseedappro = "SELECT count(distinct(user_id)) as num  from users where user_category='school-seed' and approved=1";
  //$allseedapprore=mysql_query($allseedappro);
 // $allseeduserapproved=mysql_num_rows($allseedapprore); // all seed user 
  // $result4=mysql_query($allseedappro);
    $result4=$dbc->readtabledata($allseedappro);
$data=mysql_fetch_assoc($result4);
$allseeduserapproved = $data['num'];
  

$quest1="SELECT distinct user_groups.group_name, users.full_name, users.user_name,users.user_id
                                FROM `users`,`user_tree_table`,user_groups 
                                WHERE users.user_id=user_tree_table.user_id AND 
                                users.user_category='school-seed' AND 
                                user_groups.coord_id=users.user_id";
//$sql1=mysql_query($quest1);
 $sql1=$dbc->readtabledata($quest1);
//$seeduserwithtree=$dbc1->readtabledata($sql1);
$seeduserwithtree= mysql_num_rows($sql1);
 
echo "<br>";?>
<table border="1">
<?php
echo "<tr><td><b>slno</b></td>";
echo "<td width=30><b>School name</b></td>";
echo "<td><b>Coordinator Name</b></td>";
echo "<td><b>SEED user id</b></td>";
echo "<td><b>user_id</b></td>";
echo "<td><b>No of observation</b></td>";
echo "<td><b>usercount</td><tr>";
$cnt=0;
$treewithob=0;
while ($sql1_row=mysql_fetch_array($sql1))
{
echo "<tr><td>" .$cnt . "</td>";	
echo "<td>" . $sql1_row['group_name'] . "</td>";
echo "<td>" . $sql1_row['full_name'] . "</td>";
echo "<td>" . $sql1_row['user_name'] . "</td>";
echo "<td>" . $sql1_row['user_id'] . "</td>";
$sqlto="SELECT count(*)as num  FROM `user_tree_observations` WHERE user_id='$sql1_row[user_id]'";
//$result4=mysql_query($sqlto);
 $result4=$dbc->readtabledata($sqlto);
$data=mysql_fetch_assoc($result4);
$num_obs = $data['num'];
//echo "User with one tree ".mysql_num_rows($sql11);
echo "<td>" . $data['num']. "</td>";
if ($num_obs>0)
{
     echo "<td>" . $treewithob . "</td></tr>";
     $treewithob++;
}
else { echo "<td></td></tr>";}

$cnt++;
$seeduserwithob=$treewithob;
}
?>
</table>
<? echo " Seed User with one tree ".$seeduserwithtree; ?>
<br>
<? echo " Seed User with one tree with one observation ".$seeduserwithob; ?>
<br>

<b>GSP USERS</b>
<? //$allgsp = " SELECT distinct(user_id) from users where user_category='school-gsp'";
$allgsp = "SELECT * FROM `users` WHERE `user_category`='school-gsp' ";
 // $allgspuserre=mysql_query($allgsp);
  $allgspuserre=$dbc->readtabledata($allgsp);
  $allgspuser=mysql_num_rows($allgspuserre); // all gsp user 
  //echo $allgspuser;
  $allgspappro = " SELECT count(distinct(user_id)) as num from users where user_category='school-gsp' and approved='1'";
 // $allgspapprore=mysql_query($allgspappro);
  //$result4=mysql_query($allgspappro);
  $result4=$dbc->readtabledata($allgspappro);
        $data=mysql_fetch_assoc($result4);
        $allgspuserapproved = $data['num'];
        //echo $allgspuserapproved;

  
?>

<table border="1">
<?php
 //Gsp  
echo "<tr><td><b>slno</b></td>";
echo "<td><b>School name</b></td>";
echo "<td><b>Coordinator Name</b></td>";
echo "<td><b>GSP user id</b></td>";
echo "<td><b>user_id</b></td>";
echo "<td><b>No of observation</b></td>";
echo "<td><b>usercount</td><tr>";
?>
  <?///gsp 
  $gspsql="SELECT distinct user_groups.group_name, users.full_name, users.user_name,users.user_id
                                            FROM `users`,`user_tree_table`,user_groups 
                                            WHERE  users.user_id=user_tree_table.user_id AND 
                                            users.user_category='school-gsp' AND users.approved='1' AND
                                            user_groups.coord_id=users.user_id" ;

  //$gspsqlresult=mysql_query($gspsql);
   $gspsqlresult=$dbc->readtabledata($gspsql);
 
  $gspuser=mysql_num_rows($gspsqlresult); //gsp user with atleast one tree
  $cnt=0;
  $treewithob=0;
  while ($sql1_row=mysql_fetch_array($gspsqlresult))
        {  $gspuserid=$sql1_row['user_id'];
            echo "<tr><td>" .$cnt . "</td>";	
            echo "<td>" . $sql1_row['group_name'] . "</td>";
            echo "<td>" . $sql1_row['full_name'] . "</td>";
            echo "<td>" . $sql1_row['user_name'] . "</td>";
            echo "<td>" . $sql1_row['user_id'] . "</td>";
            $gsptreeob= "select count(*)as num  from user_tree_observations where user_id='$gspuserid'";
           //$gsptreereob=mysql_query($gsptreeob);
            $gsptreereob=$dbc->readtabledata($gsptreeob);
            $data=mysql_fetch_assoc($gsptreereob);
            $gspusertreeobservation = $data['num'];
             echo "<td>" . $gspusertreeobservation . "</td>";
            if ($gspusertreeobservation>0)
            {
                echo "<td>" . $treewithob . "</td></tr>";
                $treewithob++;
            }
            else {
            echo "<td></td><tr>";
            }
            $cnt++;
            $gspuserwithob=$treewithob;
        }?>
</table>
 <?echo "GSPUser with one tree".$gspuser;?>
 <?echo "GSPUser with one tree with atleast one observation".$gspuserwithob;?>
<br>
<b>School users</b> 
<br>
<? $allschool = " SELECT count(distinct(user_id)) as num from users where user_category='school'";
  //$$allschoolre==mysql_query($allschool);
  //$result4=mysql_query($allschool);
    $result4=$dbc->readtabledata($allschool);
        $data=mysql_fetch_assoc($result4);
        $allschooluser = $data['num'];
  //$allschooluser=mysql_num_rows($$allschoolre); // all school user 
  $allschoolappro = "SELECT count(distinct(user_id)) as num from users where user_category='school' and approved=1";
 // $allschoolapprore=mysql_query($allschoolappro);
  //$result4=mysql_query($allschoolappro);
   $result4=$dbc->readtabledata($allschoolappro);
        $data=mysql_fetch_assoc($result4);
        $allschooluserapproved = $data['num'];
  //$allschooluserapproved=mysql_num_rows($allschoolapprore); // all school user ?>
 <? $quest1="SELECT distinct user_groups.group_name, users.full_name, users.user_name,users.user_id
                                            FROM `users`,`user_tree_table`,user_groups 
                                            WHERE users.user_id=user_tree_table.user_id AND 
                                            users.user_category='school' AND users.approved='1'  AND 
                                            user_groups.coord_id=users.user_id";
            //$sql1=mysql_query($quest1);
            $sql1=$dbc->readtabledata($quest1);
            //echo "User with one tree ".mysql_num_rows($sql1);
            $schoolusertree=mysql_num_rows($sql1);
            echo "<br>";?>
<table border="1">
<?php
echo "<tr><td><b>slno</b></td>";
echo "<td width=30><b>School name</b></td>";
echo "<td><b>Coordinator Name</b></td>";
echo "<td><b>school user id</b></td>";
echo "<td><b>user_id</b></td>";
echo "<td><b>No of observation</b></td>";
echo "<td><b>usercount</td><tr>";

    $cnt=0;
    $schooltreewithob=0;
while ($sql1_row=mysql_fetch_array($sql1))
{
        echo "<tr><td>" .$cnt . "</td>";	
        echo "<td>" . $sql1_row['group_name'] . "</td>";
        echo "<td>" . $sql1_row['full_name'] . "</td>";
        echo "<td>" . $sql1_row['user_name'] . "</td>";
         echo "<td>" . $sql1_row['user_id'] . "</td>";
        $sqlto="SELECT count(*)as num  FROM `user_tree_observations` WHERE user_id='$sql1_row[user_id]'";
        $result4=mysql_query($sqlto);
        $data=mysql_fetch_assoc($result4);
        $num_obs = $data['num'];
        //echo "User with one tree ".mysql_num_rows($sql11);
        echo "<td>" . $data['num']. "</td>";
        if ($num_obs>0)
        {
             echo "<td>" . $schooltreewithob . "</td></tr>";
             $schooltreewithob++;
             
        }
        else { echo "<td>" - "</td></tr>";}
        $schooluserwithob=$schooltreewithob;
        $cnt++;
        }
?>
</table>
<?echo "schoolUser with one tree ".$schoolusertree;?>
<br>
<?echo "schoolUser with one tree with atleast one observation".$schooluserwithob;?>
<br>
<br>


    
    
User with atleast one tree and with one observation.
<table border="1">
   <? 
     echo "<td><b>seedno</b></td>";
    echo "<td><b>gspno</b></td>";
    echo "<td><b>schoolno</b></td>";
     echo "<td><b>total</td><tr>";
    
                echo "<td>" . $seeduserwithob . "</td>";
		echo "<td>" . $gspuserwithob . "</td>";
		echo "<td>" . $schooluserwithob . "</td>";
                $total = $seeduserwithob +$gspuserwithob+$schooluserwithob;
                 echo "<td>" . $total . "</td>";?>
    
</table>

User with atleast one tree .
<table border="1">
   <? 
     echo "<td><b>seedno</b></td>";
    echo "<td><b>gspno</b></td>";
    echo "<td><b>schoolno</b></td>";
     echo "<td><b>total</td><tr>";
    
                echo "<td>" . $seeduserwithtree . "</td>";
		echo "<td>" . $gspuser . "</td>";
		echo "<td>" . $schoolusertree . "</td>";
                $total = $seeduserwithtree +$gspuser+$schoolusertree;
                 echo "<td>" . $total . "</td>";?>
    
</table>


<?// Indiviual user''''
$allindiv = " SELECT count(distinct(user_id)) as num from users where (user_category='Individual' OR user_category='')";
//$allindivre=mysql_query($allindiv);
 $allindivre=$dbc->readtabledata($allindiv);
$data=mysql_fetch_assoc($allindivre);
$allindivuser = $data['num'];
echo $allindivuser;
$allindivappro = " SELECT count(distinct(user_id)) as num from users where (user_category='Individual' OR user_category='')and approved=1";
//$allindivapprore=mysql_query($allindivappro);
 $allindivapprore=$dbc->readtabledata($allindivappro);
$data=mysql_fetch_assoc($allindivapprore);
$allindivuserapproved = $data['num'];
  //$allindivuserapproved=mysql_num_rows($allindivapprore); // all individual user
// $sql="SELECT distinct users.user_id FROM users,user_tree_observations where approved='1' and NOT user_category ='school' and NOT user_category ='school-seed' 
        //and NOT user_category ='school-gsp' and user_tree_observations.user_id=users.user_id";
 
 $Indivuser="SELECT distinct  users.full_name, users.user_name,users.user_id
                                FROM `users`,`user_tree_table`
                                WHERE users.user_id=user_tree_table.user_id AND users.approved='1' AND
                               ( users.user_category='Individual' OR users.user_category='' ) ";
 
 //$sql1=mysql_query($Indivuser);
 $sql1=$dbc->readtabledata($Indivuser);
$Indivuserwithtree= mysql_num_rows($sql1);
?>
<table border="1">
<?php
echo "<tr><td><b>slno</b></td>";
echo "<td>full name</td>";
echo "<td><b>User Name</b></td>";
echo "<td><b>user_id</b></td>";
echo "<td><b>No of observation</b></td>";
echo "<td><b>usercount</td><tr>";
 $cnt=0;
 $indivtreewithob=0;
while ($sql1_row=mysql_fetch_array($sql1))
{
        echo "<tr><td>" .$cnt . "</td>";	
         echo "<td>" . $sql1_row['full_name'] . "</td>";
        echo "<td>" . $sql1_row['user_name'] . "</td>";
         echo "<td>" . $sql1_row['user_id'] . "</td>";
        $sqlto="SELECT count(*)as num  FROM `user_tree_observations` WHERE user_id='$sql1_row[user_id]'";
        //$result4=mysql_query($sqlto);
        $result4=$dbc->readtabledata($sqlto);
        $data=mysql_fetch_assoc($result4);
        $num_obs = $data['num'];
        //echo "User with one tree ".mysql_num_rows($sql11);
        echo "<td>" . $data['num']. "</td>";
        if ($num_obs>0)
        {
             echo "<td>" . $indivtreewithob . "</td></tr>";
             $indivtreewithob++;
             
        }
        else { echo "<td>" - "</td></tr>";}
        $Indivuserwithob=$indivtreewithob;
        $cnt++;
        }
?>
</table>

<?echo  "Individual user with atleast one tree :".$Indivuserwithtree;
echo  "Individual user with atleast one tree with one observation :".$Indivuserwithob;?>
<table border="1"> 
    <tr>
        <td> Topic </td>
        <td> Seed </td>
        <td> Gsp </td>
        <td> School </td>
        <td> Total School </td>
        <td> Individual </td>
    </tr> 
    <tr>
       <td>  All User </td>
        <td> <?echo  $allseeduser; ?></td>
        <td> <?echo  $allgspuser; ?> </td>
        <td> <?echo  $allschooluser; ?> </td>
        <td> <? echo ($allseeduser+$allgspuser+$allschooluser); ?> </td>
        <td> <?echo  $allindivuser; ?> </td> 
    </tr>
    <tr>
       <td>  All Approved User </td>
        <td> <?echo  $allseeduserapproved; ?></td>
        <td> <?echo  $allgspuserapproved; ?> </td>
        <td> <?echo  $allschooluserapproved; ?> </td>
        <td> <? echo ($allseeduserapproved+$allgspuserapproved+$allschooluserapproved); ?> </td>
        <td> <?echo  $allindivuserapproved; ?> </td> 
    </tr>
    <tr>
        <td> Approved User with atleast one tree </td>
        <<td> <?echo  $seeduserwithtree; ?></td>
        <td> <?echo  $gspuser; ?> </td>
        <td> <?echo  $schoolusertree; ?> </td>
        <td> <? echo ($seeduserwithtree+$gspuser+$schoolusertree); ?> </td>
        <td> <?echo  $Indivuserwithtree; ?> </td> 
    </tr>
    <tr>
        <td> Approved User with atleast one tree with atleast one observation </td>
        <td> <?echo  $seeduserwithob; ?></td>
        <td> <?echo  $gspuserwithob; ?> </td>
        <td> <?echo  $schooluserwithob; ?> </td>
        <td> <? echo ($seeduserwithob+$gspuserwithob+$schooluserwithob); ?> </td>
        <td> <?echo  $Indivuserwithob; ?> </td> 
    </tr>
</table>