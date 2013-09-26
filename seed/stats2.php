<?include_once("includes/dbc.php");
	session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us">
<head>
    <title>SeasonWatch-Seed Statistics</title>
	<link rel="stylesheet" href="css/jq.css" type="text/css" media="print, projection, screen" />
	<script type="text/javascript" src="js/jquery-latest.js"></script>
	
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css" id="" media="print, projection, screen" />
<script type="text/javascript" id="js">$(document).ready(function() {
	// call the tablesorter plugin
	$("table").tablesorter({
		// sort on the first column and third column, order asc
		sortList: [[0,0],[2,0]]
	});
}); </script>
</head>
<body>
    <h1 style="margin:15px;font-size:20px;">Seed-SeasonWatch User Statistics</h1>
    <!--<table border="1" width="100%">
        <tr>
<td>school name</td>
<td>coord name</td>
<td>tree name</td>
<td>tree id</td>
<td>Last Observation id</td>
<td>observation id</td>
<td>observation date</td>
<td>date_of_addition</td>
<td>deleted</td>
</tr>-->
    
    <?
    $data=array();
    $com=",";
    
    $schoolname="school name";
    $coordname="coord name";
    $treename="tree name";
    $treeid="tree id";
    $LastObservationid="Last Observation id";
    $observationid="observation id";
    $observationdate="observation date";
    $date_of_addition="date_of_addition";
    $deleted="deleted";
    $data[0]= $schoolname.$com.$coordname.$com.$treename.$com
                       .$treeid.$com.$LastObservationid.$com.$observationid.
                         $com.$observationdate.$com.$deleted.$com.
                         $date_of_addition;

   //cars=array("Volvo","BMW","Toyota");
   $schoolcord=array('1940','2700','7252','7330','557','4172');
  // print_r($schoolcord);
   // echo "<br>";
   //get all the tree by this school
   for($i=0;$i<count($schoolcord);$i++)
   {
       $Querys="SELECT group_name FROM  user_groups WHERE  `coord_id` ='$schoolcord[$i]' ";
              // echo $Querys;
                $sql_sch=mysql_query($Querys);
                list($group_name)=mysql_fetch_row($sql_sch);?>
        
       <?  $Querycord="SELECT full_name FROM  users WHERE  `user_id` ='$schoolcord[$i]' ";
               //echo $Query;
                $sql_coord=mysql_query($Querycord);
                list($coord_name)=mysql_fetch_row($sql_coord);?>
        
   <?
       $Query= "select * from user_tree_table where user_id='$schoolcord[$i]'";
        $sql_treeNo=mysql_query($Query);
        while ($sqltree_row=mysql_fetch_array($sql_treeNo))
	{?>
        
        <?
            $Query1= "select observation_id,date,deleted,date_of_addition from user_tree_observations where user_id='$schoolcord[$i]'
                and user_tree_id='$sqltree_row[user_tree_id]'";
            $sql_treeob=mysql_query($Query1);
            $loop=0;
            while ($sqltree_obrow=mysql_fetch_array($sql_treeob))
            {
                //echo "observation_id:-"."&nbsp;".$sqltree_obrow['observation_id']."&nbsp;";
               ?>
         <tr>
             <?if ($loop==0)
             {
              $group_name= str_replace(',', '.', $group_name);
              $scname=$group_name;
              $coordname=$coord_name;
              $treename=$sqltree_row['tree_nickname'];
              $usertreeid=$sqltree_row['user_tree_id'];
                      $lastobdate=$sqltree_row['last_observation_date'];?>
             <!--<td><?echo $group_name;?></td>
              <td><?echo $coord_name;?></td>
              <TD><?echo $sqltree_row['tree_nickname'];?></td> 
         <TD><?echo $sqltree_row['user_tree_id'];?></td> 
         <TD><?echo $sqltree_row['last_observation_date'];?></td>-->
             <? }else {$scname="-";
              $coordname="-";
              $treename="-";
              $usertreeid="-";
                      $lastobdate="-";?>
         <!-- <td><?echo "-";?></td>
              <td><?echo "-";?></td>
             <td><?echo "-";?></td> 
        <td><?echo "-";?></td>
        <td><?echo "-";?></td> -->
         <?}?>
              <!--  <td><?echo $sqltree_obrow['observation_id'];?></td>
                <td><?echo $sqltree_obrow['date'];?></td>
                <td><?echo $sqltree_obrow['deleted'];?></td>
                <td><?echo $sqltree_obrow['date_of_addition'];?></td>
         </tr>-->
               <?// echo "date:-"."&nbsp;".$sqltree_obrow['date']."&nbsp;";
               // echo "deleted:-"."&nbsp;".$sqltree_obrow['deleted']."&nbsp;";
                //echo "date_of_addition:-"."&nbsp;".$sqltree_obrow['date_of_addition']."&nbsp;";
              //echo "<br>";
           // $data[]=  $scname  
               $info= $scname.$com.$coordname.$com.$treename.$com
                 .$usertreeid.$com.$lastobdate.$com.$sqltree_obrow['observation_id'].$com
                 .$sqltree_obrow['date'].$com.$sqltree_obrow['deleted'].$com.$sqltree_obrow['date_of_addition'];
               $loop++;
             $data[] = $info;
            }
            
        }
        
   }
   $filename="forseeddate.csv";
       writecsvfile($filename,$data);
    ?><?
    function writecsvfile($filename,$data)
{
    $file = fopen($filename,"w");
    foreach ($data as $line)
    {
    fputcsv($file,explode(',',$line));
    }
    fclose($file);
}
   ?>
</body>
</html>

