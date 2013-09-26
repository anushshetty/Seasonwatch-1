<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once("includes/dbcon.php");
$user_id= $_GET['userid'];

//echo $user_id;
//echo "<br>";
$start_date=date("Y-m-d");
$end_date = date("Y-m-d",strtotime("+1 years"));

$begin = new DateTime( $start_date );
	$end = new DateTime(date("Y-m-d",strtotime("+1 day", strtotime($end_date))));
	while($begin < $end) {
		$period[] = $begin->format('Y-m-d');
		$begin->modify('+1 day');
               // echo $begin;
	}
        
       // echo $start_date;
        $end   = date("Y-m-d",strtotime("+1 day", strtotime($end_date)));
        //echo $end;
        
        //$year = date('Y');

//$firstDayOfJan = date("Y-m-d", strtotime("first day of January {$year}"));
//echo $firstDayOfJan;
   function getMondays($year) {
  $newyear = $year;
  $week = 0;
  $day = 0;
  $mo = 1;
  $mondays = array();
  $i = 1;
  while ($week != 1) {
   $day++;
   $week = date("w", mktime(0, 0, 0, $mo,$day, $year));
  }
  array_push($mondays,date("r", mktime(0, 0, 0, $mo,$day, $year)));
  while ($newyear == $year) {
   $test =  strtotime(date("r", mktime(0, 0, 0, $mo,$day, $year)) . "+" . $i . " week");
   $i++;
   if ($year == date("Y",$test)) {
     array_push($mondays,date("r", $test));
   }
   $newyear = date("Y",$test);
  }
  return $mondays;
}
echo '<pre>';
//print_r(getMondays('2013'));
echo '</pre>';   
/*--------------------*/


?>
<script>
     function filteration(userid)
    {
        
         //var dataString = "usertreeid="+$("#usertreeid"+ID).attr('value');
       // alert(userid);
	url = 'weeklyreport.php?userid='+userid; 
        // url = 'participants.php?state_id='+state_id+'&user-category='+usercat;
	window.location = url;
    }
    </script>
    Select User: <select name=userid id="userid" onChange="filteration(this.value)">
			    <option value="">Select a user</option>
<?php
				$result = mysql_query("select * from users where approved='1' and banned='0' and group_role != 'member' order by user_email asc");
                                 $num_members = mysql_num_rows($result);
                                
        		        if($result){
                                   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                      if($row['user_id'] >'0') {
                                         print "<option value=".$row{'user_id'};
                                         if ($row{'user_id'} == $user_id) {
                                            print " selected ";
					 }
                                            print ">".$row{'user_email'}."</option>\n";
        			      } else {
                                           $user_id = $row['user_id'];
                                          $user_email = $row['user_email'];
                                       }
                                    }
				 }
?>
                         </select>
    
    




    
<? //echo $num_members;
if (!empty($user_id)){
$sql1="SELECT date from  users WHERE user_id ='$user_id'";
$rs_total_pending=mysql_query($sql1);
list($dateadd) = mysql_fetch_row($rs_total_pending);
$joindate=date("Y-m-d", strtotime($dateadd));
$start = strtotime($dateadd);
$joindate = strtotime($joindate); 
$dateofjoin=date('Y-m-d', $joindate);?>
    <br>
    <table id="table1" class="tablesorter"  border="2">
	<thead>
		<tr>
			<th style='width:20px'>week no</th>           
			<th style='width:80px'>Week start</th>
			<th style='width:80px'>Week end</th>                        
			<th style='width:80px'>Observation date</th>
		</tr>
	</thead>
	<tbody>   <?
//echo "Date of Join".$dateofjoin;
//echo "<br>";
$lendingdate=strtotime('+1 year', $joindate);
 /*$lendingdate=date("Y-m-d");

 $lendingdate   = strtotime($lendingdate); */

$end   = $lendingdate; 
$lendingdate= date('Y-m-d', $lendingdate);
echo "date of ending".$lendingdate;
//echo "<br>";
$Allmondaysofyear = array(); 
//loop thru start date to end date 
 for($start=strtotime('next monday', $start);$start <= $end; $start=strtotime('next monday', $start)){ 
      array_push($Allmondaysofyear,date("Y-m-d", $start));
   }
 //print_r($Allmondaysofyear);

//Check obsertvation found for those weeks.
 for($i = 0, $j = count($Allmondaysofyear); $i < $j ; $i++) {?>
            <tr> 
    <td  style='width:20px'> <? echo $i;?></td>
    <? $k =$i+1;
     $fromdate = $Allmondaysofyear[$i];
     if ($k==count($Allmondaysofyear))
     { 
       $todate=$Allmondaysofyear[$i];
       $todate=strtotime('next monday', $todate);
       $todate= date('Y-m-d', $todate);
       echo $todate;
     }
     else
     {
     $todate=$Allmondaysofyear[$k];}
     ?>
    <td  style='width:80px'> <? echo $fromdate;?></td>
    <td style='width:80px'> <? echo $todate;?></td>  
    <? //echo "  start".$Allmondaysofyear[$i];
     //echo "  end".$Allmondaysofyear[$k];
     //get observation for that date .
    $quest1="select date from user_tree_observations where user_id='$user_id' and deleted=0 and date >='$fromdate'  AND date <= '$todate'"; 
     	$rs_pending = mysql_query($quest1) or die(mysql_error());
                //echo $quest1;
                //echo "<br>";
    list($utodat) = mysql_fetch_row($rs_pending);
    
    if (empty($utodat))
    {?>
        <td style='width:80px'> -</td>
   <?}
    else
    {?>
        
         <td style='width:80px'> <?echo $utodat;;?></td>  
  <?  }?>
     </tr>

<?}

}

 
?>
        </tbody>
    </table>

