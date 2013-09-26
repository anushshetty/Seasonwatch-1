<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seed Report</title>

<!-- paste this code into your webpage -->
<link href="css/listexpander.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/listexpander.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seed Report</title>

<!-- paste this code into your webpage -->
<link href="listexpander/listexpander.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="listexpander/listexpander.js"></script>
<style>
 .Coord { color:#0000FF;margin-bottom:10px;font-size:14px;text-transform:uppercase;font-weight:bold; }
 
body{
	background:#ffffff;
	font:80% Arial, Helvetica, sans-serif; 
	color:#555;
	line-height:150%;
        width:90%;
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
	
	line-height:80px;	
}
#container{
	
	background:#fff;
	
        width:100%;
}
#content{margin:0 20px;}
p{	
       width:100%;
}
#TopSchools
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;

}
#TopSchools td, #TopSchools th 
{
font-size:13px;
border:1px solid #98bf21;
text-align:left;
white-space:pre-line;
}
#TopSchools th 
{
font-size:13px;
text-align:left;
background-color:#A7C942;
color:#ffffff;
white-space:pre-line;

}
#TopSchools tr.alt td 
{
color:#000000;
background-color:#EAF2D3;

}

</style>

</head>
    <?php
    include_once("includes/dbc.php");
	//session_start();
        $start_date="2011/06/01";

	$sql1=mysql_query("SELECT distinct user_groups.group_name,user_groups.group_id,users.full_name,users.user_id,users.educational_district,users.user_name
					FROM `users`,`user_tree_table`,user_groups 
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='school-seed' AND 
					user_groups.coord_id=users.user_id");
    $FileString;
    $data= array(); //to store all the data 
    $TotalTreeWeekPerTree=0;
    $SchoolCnt=0;
    while ($sql1_row=mysql_fetch_array($sql1))
    {
        $SchoolCnt++;
        $PrevTotalTreeWeekperTree=0;
        $TotalTreeWeekPerTree=0;
        $TreeGroupID= $sql1_row['group_id'];
        $UserID=$sql1_row['user_id'];

        // to get the Coordinator name
        $TreeCoordQuery="select full_name from users where user_id='$UserID'";
        $CoordnameResult = mysql_query($TreeCoordQuery);
        $Coordnamerow=mysql_fetch_object($CoordnameResult);
        $Coordname=$Coordnamerow->full_name ;

        //Get the information of the school by calculating the no of trees.
        $Query="SELECT distinct m.tree_nickname ,m.user_tree_id,m.tree_id,m.members_assigned,m.last_observation_date,ug.coord_id FROM user_tree_table as m, 
        user_tree_observations AS ut,user_groups AS ug WHERE ut.user_tree_id =m.user_tree_id and m.user_id=$UserID and ug.group_id =$TreeGroupID";
        //echo $Query;
        //echo "<br/>";
        
        $sql_treeNo=mysql_query($Query);
        $School_TreeCnt=mysql_num_rows($sql_treeNo);// No of tree by school
        if ($School_TreeCnt<>0)
        {    
            $SCName =ucfirst($sql1_row['group_name']); 
            $FileString=$sql1_row['group_name']." |".$sql1_row['educational_district']."|".$School_TreeCnt."|".$Coordname."|";
            while ($sql_treeNo_row=mysql_fetch_array($sql_treeNo))
            {
            $TreeName=$sql_treeNo_row['tree_nickname'];
            $TreeID=$sql_treeNo_row['user_tree_id'];
           
            $TreeStartdate=$sql_treeNo_row['last_observation_date'];
            $TreeMem= $sql_treeNo_row['members_assigned']; //getting user_id for the members of the tree.
          
            $OnlyTreeID=$sql_treeNo_row['tree_id'];
            $TreeCoordId=$sql_treeNo_row['coord_id'];
            
            //tree specis common name
            $specNameQuery="select sm.species_primary_common_name from species_master as sm,trees as t where sm.species_id =t.species_id and  t.tree_id=$OnlyTreeID";
            
            $specNameResult = mysql_query($specNameQuery);
            $SpecName=mysql_fetch_object($specNameResult);
    
            //get the coord name
            $TreeCoordQu="select full_name from users where user_id='$TreeCoordId'";
            $TreeCoordRow = mysql_query($TreeCoordQu);
            $TreeCoordrowinfo=mysql_fetch_object($TreeCoordRow);

            //check whether more than one members exists
            $NoofMemTree=substr_count($TreeMem, ','); 
             
            if ($NoofMemTree==0)
            {
               // echo $TreeMem;
                $school_members_Query="select full_name from users where user_id='$TreeMem' ";
                $school_members = mysql_query($school_members_Query);
                $rowinfo=mysql_fetch_object($school_members);
                $TreeMemName= strtolower($rowinfo->full_name);
                $TreeMemName = ucfirst($TreeMemName);

            }
            else
            {
                $TreeMemName=RetriveTreeMem($TreeMem);
                //call retrive members function 
            }
           
            
            $startdate=substr($TreeStartdate, 0,10);
            $rowcount=0;
            $Treeweek=0;
            $CurTreeWeek=0;
            $PrevTreeWeek=0;
            $TotalTreeWeek=0;

            //To Count the number of observation made by the tree
            $sql_Ob_tree="select observation_id,date,user_tree_id from user_tree_observations where  user_tree_id=$TreeID   
            ORDER BY  `user_tree_observations`.`date` ASC ";
             $result_tree1=mysql_query($sql_Ob_tree);
            $TreeObCount=mysql_numrows($result_tree1); 

            for($x=0;$x<$TreeObCount;$x++)
            {
               
                if ($x==0)
                $PrevTreeWeek=0;
                $ObDate = mysql_result($result_tree1,$x,"date");
                if ($x==0)
                {
                    $FirstObDate=$ObDate; //to get the first observation date 
                               
                }

                //Splitting year ,month ,date
                $StrYear = substr($ObDate, 0,4);
                $StrRem = substr($ObDate, 5,strlen($ObDate));
                $Strmonth = substr($StrRem, 0,2);
                $StrDate = substr($StrRem, 3,strlen($StrRem));

                //extracting the day name of a $ObDate
                $today = new DateTime($ObDate);
                // Display full day name
                $wekday=$today->format('l') . PHP_EOL; // lowercase L
               
                //get the weeknumber from the observation date
                $weekNumber= date("W", mktime(0,0,0,$Strmonth,$StrDate,$StrYear)); //get the weekNumber
                $CurTreeWeek=$weekNumber;
              
                    if ($PrevTreeWeek<>$CurTreeWeek)
                    {
                    $Treeweek=$Treeweek+1;
                    $PrevTreeWeek = $CurTreeWeek;
                    }
  
               }
                    $TotalTreeWeek=$TotalTreeWeek+$Treeweek;
                    $PrevTotalTreeWeekperTree= $PrevTotalTreeWeekperTree+$TotalTreeWeek;

                    // $FileString=$FileString." ".$TreeCoordrowinfo->full_name."|".$TreeMemName."|".$TreeName."|".$SpecName->species_primary_common_name."|".$startdate."|".$TotalTreeWeek."]";  
                    $FileString=$FileString." ".$TreeID."|".$TreeMemName."|".$TreeName."|".$SpecName->species_primary_common_name."|".$FirstObDate."|".$startdate."|".$TotalTreeWeek."]";                     

                 }
                    $FileString=$FileString."{".$PrevTotalTreeWeekperTree."}";
                    $data[] = array('Info' => $FileString, 'TotalWeekMon' => $PrevTotalTreeWeekperTree);
                }
                     
                
                
                
                
                foreach ($data as $key => $row) {
                    $Info[$key]  = $row['Info'];
                    $TotalWeekMon[$key] = $row['TotalWeekMon'];
                }
                // Sort the data with volume descending, edition ascending
                // Add $data as the last parameter, to sort by the common key
                if (is_array($TotalWeekMon))
                {
                     array_multisort($TotalWeekMon, SORT_DESC, $data);
                }
              
                }   
                mysql_close($link);
               ?>
    
    <div id="container">
	<h1>SEED-SEASONWATCH USER REPORT</h1>
	<div id="content">
            <ul class="listexpander">
                <?php 
                $Cnt=0;
                foreach($data as &$ma) 
                 {  
                    $SchoolInfo =$ma["Info"];
                    $Cnt++;
                    list($schName,$remstr)=GetSchoolInfoString($SchoolInfo);
                    list($schEdDi,$remstr)=GetSchoolInfoString($remstr);
                    list($schTreeNo,$remstr)=GetSchoolInfoString($remstr);
                    list($Coord,$remstr)=GetSchoolInfoString($remstr);
                   
                    $subHeading = $Coord."".$schTreeNo."".$Coord."";
                    
                    //parsing to get the total number of observation 
                    $findme   = '{';
                    $pos = strpos($remstr, $findme);
                    //echo $pos;
                    $retstr= substr($remstr,$pos+1,strlen($remstr));
                     //echo $retstr;
                    $findme   = '}';
                    $endpos = strpos($retstr, $findme);
                    $NoOfObser= substr($retstr,0,$endpos);
                   // echo $NoOfObser;
                   
                    ?>
                    
                
			<li> <? echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". $schName. "&nbsp;&nbsp;&nbsp-" .$schEdDi.",&nbsp;&nbsp;&nbsp  No of Observation &nbsp;<i>" .$NoOfObser."</i>"  ?>
				<ul>
                                    <li><?echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coordinator-&nbsp;&nbsp;".$Coord.",&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No of Trees- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$schTreeNo."</i></b>"	?>
                                            <ul><li>
		                   
                    <?php 
                    echo "<table border=1 id=TopSchools>";
                    echo "<tr><th>User Tree ID</th>";
                    echo "<th >Student Name</th>";
                    echo "<th>Tree NickName</th>";
                    echo "<th>Tree Species</th>";
                    echo "<th>First observation date</th>";
                    echo "<th>Last observation date</th>";
                    echo "<th>No.of weeks monitored</th></tr>";
                    $remstr=GetRowInfoString($remstr);
                    echo "<th></th><th></th> <th></th><th></th><th></th> <th></th><th>Total no. of weeks monitored = ";
                    //get the total no of observations
                   // echo $remstr;
                    $findme   = '}';
                    $pos = strpos($remstr, $findme);
                    //echo $pos;
                    
                    $retstr= substr($remstr,1,$pos-1);
                    echo $retstr;
                   // $str= substr($remstr, $pos+1,strlen($remstr));
                    //echo $retstr;
                    echo "</b></th>";
                     echo "</table>";
                     echo "<br/>";?>
                        </li>
                    </ul>
                    </li>
                    </ul>
                    </li>
					 
                    
                <?php  }?>
                                      
               			
					
		</ul>
        </div>
                 
   <?php  function GetSchoolInfoString($str)
    { 
    //Njangattoor AUPS, Njangattari P.O, 679311| 1|Ottapalam|[ M. Thahir, - ,pala near the well,Devil's Tree,2011-06-29,1]{1} 
    // echo $str;
        $findme   = '|';
        $pos = strpos($str, $findme);
        $retstr= substr($str,0,$pos);
        $str= substr($str, $pos+1,strlen($str));
        return array($retstr, $str);
    } 
    function RetriveTreeMem($MAssignedTreeMem)
{
//Count commas
//$MAssignedTreeMem=$sAssignedTreeMem;
$NoofMemTree=substr_count($MAssignedTreeMem, ','); 

if ($NoofMemTree==0)
{
   
}
else
{
    $TotalMemname;
    //echo "No of members is more than one";
    for ($mem=0;$mem<$NoofMemTree+1;$mem++)
    {
        if ($mem==0)
            $PrevTreeMem=0;
        //check if comma exits
       
        $ComExits=substr_count($MAssignedTreeMem, ',');
        //echo $ComExits;
        if ($ComExits==0)
        {
            $TreeUserID=$MAssignedTreeMem;
            
            
        }
        else
            {

           $TreePos= strpos($MAssignedTreeMem,",");
            // echo $TreePos;
            $TreeUserID=substr($MAssignedTreeMem, 0,$TreePos);
            //echo $fMem;
            $MAssignedTreeMem =substr($MAssignedTreeMem, $TreePos+1,strlen($MAssignedTreeMem)); 
        }
        //echo $TreeUserID;
        //$TreeMemName=$TreeMemName.",";
        $prevTreemem;
        if( $TreeMemName!="")
        { $prevTreemem=$prevTreemem.",".$TreeMemName;}
 
        $school_members_Query="select full_name from users where user_id='$TreeUserID'";
        $school_members = mysql_query($school_members_Query);
        $rowinfo=mysql_fetch_object($school_members);
        $TreeMemName = ucfirst(strtolower($rowinfo->full_name));
        $TotalMemname=$prevTreemem .",".$TreeMemName;
       
    }
     //echo $TotalMemname;
}
 return($TotalMemname);
}          
    function GetRowInfoString($str)
    { 
    //Njangattoor AUPS, Njangattari P.O, 679311| 1|Ottapalam|[ M. Thahir, - ,pala near the well,Devil's Tree,2011-06-29,1]{1} 
    // echo $str;
        $Cout=substr_count($str, "]");
       // echo $Cout;
        for ($i=0;$i<$Cout;$i++)
        {
            $findme   = ']';
            $pos = strpos($str, $findme);
            $remstr= substr($str,0,$pos);
            
            //echo $pos_rem;

             //Get Coordinatorname
            list($UserTreeID,$remstr)=GetSchoolInfoString($remstr);
            echo "<tr><td align=left>".strtoupper($UserTreeID)."</td>";
            //echo $remstr;
            list($StudentName,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".$StudentName."</td>";
            list($TreeNickName,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".ucfirst(strtolower($TreeNickName))."</td>";
            list($TreeSpecies,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".$TreeSpecies."</td>";
            list($Startdate,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".$Startdate."</td>";
            list($FirstObserDate,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".$FirstObserDate."</td>";
            echo "<td>".$remstr."</td>";
            echo "</tr>";
            $str= substr($str, $pos+1,strlen($str));
            //echo $PartofRemstr;
            $pos_rem = strpos($str, $findme);

        
        }
        return ($str);
       
    } 
 	
?>
  
</div>
</html>
