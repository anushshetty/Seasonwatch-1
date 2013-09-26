<? 
   session_start();
   $page_title="SeasonWatch";
   include("../includes/dbc.php");
   include("main_includes.php");
   //include("../functions.php");
   
$fromdate=date("Y-m-d");
$todate = date("Y-m-d",strtotime("+1 years"));

	if(!isset($_REQUEST['$fromdatepicker'])){
	$fromdate = $_REQUEST['fromdatepicker'];
      	$todate = $_REQUEST['todatepicker'];
        }
?>
<link href="listexpander/listexpander.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="listexpander/listexpander.js"></script>
<style>

 




body{
	margin:0;
	padding:0;
	background:#f1f1f1;
	font:70% Arial, Helvetica, sans-serif; 
	color:#555;
	line-height:150%;
	text-align:left;
}
a{
	text-decoration:none;
	color:#057fac;
}
a:hover{
	text-decoration:none;
	color:#999;
}
h1{
	font-size:140%;
	margin:0 20px;
	line-height:80px;	
}
#container{
	margin:0 auto;
	width:680px;
	background:#fff;
	padding-bottom:20px;
}
#content{margin:0 20px;}
p{	
	margin:0 auto;
	width:680px;
	padding:1em 0;
}

</style>



<script>
	$(function() {
		$( "#fromdatepicker, #todatepicker" ).datepicker();
	});
	/*$(function() {
		$( "#todatepicker" ).datepicker();
		//var curdate = $( "#todatepicker" ).datepicker("getDate");
		//alert(curdate);
		//$( "#todatepicker" ).datepicker("setDate", curdate);
	});*/
</script>
<body>
<div class='body_main'>
<div class='container first_image'>
    <table style="width: 930px; margin-left: auto; margin-right: auto;">
    <tbody>
    <div>
    <h3>Welcome Admin!</h3>
     <?php
    include("admin_header.php");
    ?>
    </table>
<div>
<hr/>
</div>
    <form action="admin1.php" name="listFilter" id="listFilter" method="post" style="margin:0;">
        <table style="width: 930px; margin-left: auto; margin-right: auto; align:left;font-size:15px;">
        <tr style=font-size:20px;> Select the dates </tr>
        <td>
        From: <input type="text"  name="fromdatepicker" id="fromdatepicker" value="<?=$fromdate;?>">
        </td>
        <td>
        To: <input type="text"  name="todatepicker" id="todatepicker" value="<?=$todate;?>" >
        </td>
        <td>
        <input type="submit" name="btnFilter" id="btnFilte" value="Filter" />
        </td>
        </table>
<hr/>

    
<h3>Top contributors  from  <?echo $fromdate;?> to <?echo $todate;?></h3>  

<table style="width: 930px; margin-left: auto; margin-right: auto; align:left;font-size:15px;border:1">
    <tr>
        <td> Sl.no</td>
        <td> UserID</td>
        <td> UserEmail</td>
        <td> Date of Join</td>
        <td> No of trees</td>
        <td> No of observation expected</td>
        <td> No of observations</td>
    </tr>

<?
    $fromdate = $_REQUEST['fromdatepicker'];
    $todate = $_REQUEST['todatepicker'];
    $fromdate=strtotime($fromdate);
    $fromdate= date('Y-m-d', $fromdate);
    //echo $fromdate;
    $todate=strtotime($todate);
    //$todate= date('Y-m-d', $todate);
    $todate= date('Y-m-d', $todate);
    //echo $todate;
    //echo $fromdate;
    //echo $todate;
    /*$fromdate=strtotime($fromdate);
    $fromdate= date('Y-m-d', $fromdate);
    echo $fromdate;
    $todate=strtotime($todate);
    //$todate= date('Y-m-d', $todate);
    $todate= date('Y-m-d', $todate);
    echo $todate;*/
    //echo $todate;
    //echo "<br>";
   //Get all user from date to date 
    $alluser="select * from users where date between '$fromdate' and '$todate' and group_role!='member' order by user_id desc";
    //echo $alluser;
    $rsalluser = mysql_query($alluser);
    $cntrows = mysql_num_rows($rsalluser);
    //echo $cntrows;
   // echo "<br>";
    $cnt=0;
    while ($userrows = mysql_fetch_array($rsalluser))
    { $datejoin= $userrows['date'];
    $cnt=$cnt+1;
   // echo $datejoin;?>
    <tr>
    <td><? echo $cnt;?></td>  
    <td><? echo $userrows['user_id'];?></td>
    <td><? echo $userrows['user_email'];?></td>
    <td><? echo $datejoin;?></td>
     
    
   <? // echo "<br>";
  // echo $userrows['user_id'];
   // echo $userrows['user_email'];
    $totobservexpected=0;
$totalobserved=0;
    $retstr=Getalltreesbyuser($userrows['user_id'],$datejoin);
    
    $findme   = ',';
    $pos = strpos($retstr, $findme);
    $treeno= substr($retstr,0,$pos);
    $obexpected= substr($retstr, $pos+1,strlen($retstr));
    //echo $obexpected;
    $remstr=$obexpected;
    $pos = strpos($remstr, $findme);
    $expected= substr($remstr,0,$pos);
    //echo $expected;
    $obdone= substr($remstr, $pos+1,strlen($remstr));
   // echo $obdone;
//echo  $treeno;
//echo $obexpected;
// $obdone=
    // echo $remstr;
  //  echo $retstr;
   ?>
    <td><?echo  $treeno;?></td>
    <td><?echo $expected;?></td>
    <td><?echo $obdone;?></td>
   <!-- </tr>--><?
    }




function Getalltreesbyuser($userid,$userjoindate)
{
 //echo  $userid;
    $alltreebyuser="select * from user_tree_table where user_id='$userid'";
    $alltrees= mysql_query($alltreebyuser);
    //echo "<br>";
    $cnttrees = mysql_num_rows($alltrees);
    //echo $userjoindate;
    //echo "treecount:- " .$cnttrees;?>
        <!--<td><? //echo $cnttrees;?></td>-->

    <?if( $cnttrees >0)
    {?>
    <!--<table style="width: 930px; margin-left: auto; margin-right: auto; align:left;font-size:15px;border:1">
        <tr>
        <td>tree nickname</td>
        <td>Expected no of observation</td>
        <td>user observed </td>
        </tr>-->
        <?while ($treerows=mysql_fetch_array($alltrees))
        {  ?>
        <!--<tr>
        <td><?echo $treerows['tree_nickname']?></td>-->
        <?
        //echo "<br>";
        //$gettreefromtreetab= "select date_of_addition from trees where tree_id='$treerows[tree_id]'";
        //$gettrees= mysql_query($gettreefromtreetab);
        // list($dateadd) = mysql_fetch_row($gettrees);
        //echo $dateadd;

        //echo " &nbsp;:- ".$treerows['tree_nickname']."::user_tree_id=".$treerows['user_tree_id']."treeaddeddate :-".$treerows['date_of_addition'];
        //$treeaddeddate=date("Y-m-d", strtotime($treerows['$dateadd']));
        //echo  $treeaddeddate;
         //$TreeMemName=RetriveTreeMem($TreeMem);
       $test= Retrivetreeobservations($userjoindate,$treerows['user_tree_id'],$userid);
      // echo $test;
        $findme   = ',';
        $pos = strpos($test, $findme);
        $remstr= substr($test,0,$pos);
       
        $obdone= substr($test, $pos+1,strlen($test));
       // echo $remstr;
       $totobservexpected= $totobservexpected+$remstr;
       $totalobserved=$totalobserved+$obdone;
      
       //$TreeMemName=Getobservationoftree($userjoindate,$treerows['user_tree_id'],$userid) ;
       
      //  echo $TreeMemName;?>
   
       
        <!--</tr>-->
        <? }?>
    <!--</table> -->
    <?}
    $retstr=$cnttrees.",".$totobservexpected.",".$totalobserved;
    // echo $totobservexpected;
    // echo "<br>";
     
       //echo $retstr;
       return($retstr);
    
    
}

function Retrivetreeobservations($treeaddeddate,$usertreeeid,$userid)
{
    $Allmondaysoftree = array(); 
    $lendingdate=date("Y-m-d");
    $end   = strtotime($lendingdate); 
    $start   = strtotime($treeaddeddate); 
    array_push($Allmondaysoftree,date("Y-m-d", $start));
    
    //loop thru start date to end date 
    for($start=strtotime('next monday', $start);$start <= $end; $start=strtotime('next monday', $start)){ 
    array_push($Allmondaysoftree,date("Y-m-d", $start));
    }
     $observedweekcunt=0;
    //Check whether observation exits fo rthat week
    for($i = 0, $j = count($Allmondaysoftree); $i < $j ; $i++)
    {
        $fromdate = $Allmondaysoftree[$i];  
        $k =$i+1;
        if ($i==$j)
        {
          $todate= date('Y-m-d', strtotime('next monday'));  
        }
 else {
          $todate=$Allmondaysoftree[$k];   
}
        //$todate=$Allmondaysoftree[$k];
        $quest1="select date from user_tree_observations where user_id='$userid' and user_tree_id='$usertreeeid' and deleted=0 and date >'$fromdate'  AND date<='$todate'"; 
        $rs_pending = mysql_query($quest1) or die(mysql_error());
        list($utodat) = mysql_fetch_row($rs_pending);
        if (!(empty($utodat)))
        { $observedweekcunt=$observedweekcunt+1; }
    }
    $expectweekob=count($Allmondaysoftree);
    $observedweek=$observedweekcunt;
    $resob= $expectweekob.",".$observedweek;
    //echo $resob;
    return($resob);
}

function Getobservationoftree($treeaddeddate,$usertreeeid,$userid) 
{
//   $treeaddeddate= "2012-08-18";
  // $usertreeeid="3613";
   //$userid="10230";
    //get all monday from the treeaddddate
    $Allmondaysoftree = array(); 
    $lendingdate=date("Y-m-d");
    //echo $treeaddeddate;
    $end   = strtotime($lendingdate); 
     $start   = strtotime($treeaddeddate); 
    array_push($Allmondaysoftree,date("Y-m-d", $start));
    
    //loop thru start date to end date 
    for($start=strtotime('next monday', $start);$start <= $end; $start=strtotime('next monday', $start)){ 
    array_push($Allmondaysoftree,date("Y-m-d", $start));
    }
   
   //print_r($Allmondaysoftree);
    //number of observation expected fopr the tree
    //echo count($Allmondaysoftree);
    //echo "<br>";
    $observedweekcunt=0;
    //Check whether observation exits fo rthat week
    //echo "<br>";
    for($i = 0, $j = count($Allmondaysoftree); $i < $j ; $i++) {
     $fromdate = $Allmondaysoftree[$i];  
     $k =$i+1;
     $todate=$Allmondaysoftree[$k];
     //echo $todate;
    
            $quest1="select date from user_tree_observations where user_id='$userid' and user_tree_id='$usertreeeid' and deleted=0 and date >'$fromdate'  AND date<='$todate'"; 
           echo $quest1;
            echo "<br>";
            $rs_pending = mysql_query($quest1) or die(mysql_error());
             list($utodat) = mysql_fetch_row($rs_pending);
              if (empty($utodat))
             {
                 echo "-";
                 
             }
             else {
                 $observedweekcunt=$observedweekcunt+1;
            }
            echo $utodat;
             echo "<br>";
    }
    $expectweekob=count($Allmondaysoftree);
    $observedweek=$observedweekcunt;
    //echo count($Allmondaysoftree);
   // echo "expected observation week-:".count($Allmondaysoftree)."observed week:-".$observedweekcunt;
     $resob= $expectweekob.",".$observedweek;
     echo $resob;?>
    <!--<td><?//echo count($Allmondaysoftree)?></td>
    <td><?//echo $observedweekcunt?></td>--?
    
     
    <?
     return ($resob);
    
}
?>




<!--<h3> Top species  from  <?echo $fromdate;?> to <?echo $todate;?></h3>  
<h3> Latest Observations  from  <?echo $fromdate;?> to <?echo $todate;?></h3>
</hr> -->
    

<!--/table><!-- user table-->
     


</div>
</div>
<?php mysql_close($link);?>
</form>
</body>
</html>
