<?php
	include_once("includes/dbc.php");
	session_start();
        $start_date="2011/06/01";

	$sql1=mysql_query("SELECT distinct user_groups.group_name,user_groups.group_id,users.full_name,users.user_id,users.educational_district,users.user_name
					FROM `users`,`user_tree_table`,user_groups 
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='school-seed' AND 
					user_groups.coord_id=users.user_id");
?>

<style type="text/css">
    .title { font-size:20px; text-transform:uppercase;text-align:center; }
    .page-sub-title { color:#336600;margin-bottom:10px;font-size:14px;text-transform:uppercase;font-weight:bold; }
   #TopSchools
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:90%;

border-collapse:collapse;
}
#TopSchools td, #TopSchools th 
{

font-size:13px;
border:1px solid #98bf21;
padding:3px 7px 2px 7px;
}
#TopSchools th 
{
    font-size:13px;

text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#A7C942;
color:#ffffff;
text-transform:uppercase;
}
#TopSchools tr.alt td 
{
color:#000000;
background-color:#EAF2D3;
}
</style>
<script language="javascript"> 
function toggle(toggleText, displayText) {
	var ele = document.getElementById(toggleText);
	var text = document.getElementById(displayText);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "display list";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide list";
	}
} 
</script>

<div class="title">Seed-SeasonWatch User Report</div>
   <br/> 
    <br/>
     <br/>
      
    
<?php
//write the information in a file.
     $filename = 'Report.txt';
 $fp = fopen($filename, "a+");
 //$filename = '/path/to/foo.txt';
 $FileString;
 $data= array();
 if (file_exists($filename)) {
   // echo "The file $filename exists";
    //unlink($filename);
} else {
   // echo "The file $filename does not exist";
}
 //$write = fputs($fp, $string);
// fclose($fp);
	$TotalTreeWeekPerTree=0;
        $SchoolCnt=0;
	while ($sql1_row=mysql_fetch_array($sql1))
	{?> 
            
	<?php
        $SchoolCnt++;
        $PrevTotalTreeWeekperTree=0;
        $TotalTreeWeekPerTree=0;
        
       
                $TreeGroupID= $sql1_row['group_id'];
                
               // echo "<br/>";
                $UserID=$sql1_row['user_id'];
                //echo $UserID;
               //echo $TreeGroupID;
                   //echo "<td>" . $sql1_row['group_id'] . "</td>";
                //Get the information of the school by calculating the no of trees.
                $Query="SELECT distinct m.tree_nickname ,m.user_tree_id,m.tree_id,m.members_assigned,m.date_of_addition,ug.coord_id FROM user_tree_table as m, 
                user_tree_observations AS ut,user_groups AS ug WHERE ut.user_tree_id =m.user_tree_id and m.user_id=$UserID and ug.group_id =$TreeGroupID";
                //echo $Query;
                
                $sql_treeNo=mysql_query($Query);
                //$sql_treeNo=mysql_query($Query,$link) or die("Insertion failed:" .mysql_error());
                
                 //echo "No of Tree :";
                 $School_TreeCnt=mysql_num_rows($sql_treeNo);
                //echo mysql_num_rows($sql_treeNo); 
                if ($School_TreeCnt<>0)
                {    
                   
                    //echo ucfirst($SchoolCnt);
                    //echo ".<i>School Name:-</i> ";
                    $SCName =ucfirst($sql1_row['group_name']); 
                    //echo "<b>".$SCName."</b>"; //school_name
                    
                    //echo "Count:- "+ mysql_num_rows($sql_treeNo); 
                    //echo $Query;
                    //echo"&nbsp;&nbsp;&nbsp;";
                   // echo "<i>No of Tree:-</i>";
                   // echo "<b>".$School_TreeCnt."</b>";        

                   // echo"&nbsp;&nbsp;&nbsp;";
                   // echo "<i>Educational District :- </i>";
                   // echo "<b>".$sql1_row['educational_district']. "</b>"; //school_name
                        //$FileString ="$sql1_row['group_name']."',' .$School_TreeCnt.$sql1_row['educational_district'];
                       //$FileString=$SchoolCnt."|".$sql1_row['group_name']." |".$School_TreeCnt."|".$sql1_row['educational_district']."[";
                    $FileString=$sql1_row['group_name']." |".$School_TreeCnt."|".$sql1_row['educational_district']."|";
                               
                       //echo $FileString;
                       // $write = fputs($fp, $FileString);
                    //echo "<br/>"
                    //echo "<table border=1 id=TopSchools>";
                    //echo "<tr><th><b>Coordinator Name</b></th>";
                    //echo "<th><b>Student Name</b></th>";
                    //echo "<th><b>Tree NickName</b></th>";
                   // echo "<th><b>Tree Species</b></th>";
                   // echo "<th><b>Start date</b></th>";
                    //echo "<th ><b>No. of weeks monitored</b></th></tr>";
                while ($sql_treeNo_row=mysql_fetch_array($sql_treeNo))
                {
                    $TreeName=$sql_treeNo_row['tree_nickname'];
                    $TreeID=$sql_treeNo_row['user_tree_id'];
                    //echo $TreeID;
                    $TreeStartdate=$sql_treeNo_row['date_of_addition'];
                    $TreeMem= $sql_treeNo_row['members_assigned']; //getting user_id for the members of the tree.
                    $OnlyTreeID=$sql_treeNo_row['tree_id'];
                    $TreeCoordId=$sql_treeNo_row['coord_id'];
                    //tree specis common name
                    $specNameQuery="select sm.species_primary_common_name from species_master as sm,trees as t where sm.species_id =t.species_id and  t.tree_id=$OnlyTreeID";
                    //echo $specName;
                    $specNameResult = mysql_query($specNameQuery);
                    $SpecName=mysql_fetch_object($specNameResult);
                        //echo "<li>";
                         
                     //Check members of the group_id     
                    //echo "---";
                   //echo $TreeMem;
                    //echo "<br/>";
                    //echo "<tr><td>";
                    //get the coord name
                    $TreeCoordQu="select full_name from users where user_id='$TreeCoordId'";
                    $TreeCoordRow = mysql_query($TreeCoordQu);
                        $TreeCoordrowinfo=mysql_fetch_object($TreeCoordRow);
                        //echo "  $TreeCoordrowinfo->full_name </td> ";
                    //check whether more than one members exists
                    $NoofMemTree=substr_count($TreeMem, ','); 
                    //echo $NoofMemTree;
                   
                    // echo "<br/>";
                      //echo "members name:- ";
                     // echo  "<td>";
                    if ($NoofMemTree==0)
                        
                    {
                        $school_members_Query="select full_name from users where user_id='$TreeMem' ";
                        $school_members = mysql_query($school_members_Query);
                        $rowinfo=mysql_fetch_object($school_members);
                        $TreeMemName= "  - ";
                       // echo "  - ";
                         
                    }
                    else
                    {
                        
                        for ($mem=0;$mem<$NoofMemTree+1;$mem++)
                        {
                            $TreePos= strpos($TreeMem,",");
                            if ($TreePos==FALSE)
                            {
                                 $TreeUserID=$TreeMem;
                            }
                            else
                            {
                                $TreeUserID= substr($TreeMem,0,$TreePos);
                               // echo $TreeUserID;
                                $remTreeMem =substr($TreeMem, $TreePos+1,strlen($TreeMem)); 
                                //echo $remTreeMem;
                                $TreeMem=$remTreeMem;
                            }
                            $school_members_Query="select full_name from users where user_id='$TreeUserID'";
                            $school_members = mysql_query($school_members_Query);
                            $rowinfo=mysql_fetch_object($school_members);
                             // echo "<br/>";
                            //$names[$i]',$Per[$i]
                            //echo $rowinfo->full_name; //Tree member name
                            $TreeMemName = $rowinfo->full_name;
                            $TreeMemName= $TreeMemName . " ," ;
                            
                            
                        }
                       // echo $TreeMemName;
                       // echo  "</td>";
                       //echo "<tr><td>" . $TreeMemName . "</td>";
                    }
                    
                    
                   //echo "Species Common name:-";
                         //echo $SpecName->species_primary_common_name;
                
               
                ?> 
                <?php //echo "<br/>";
                // echo "<td>" . $TreeName . "</td>";
                ///echo "TreeName:-"; 
                //echo $TreeName; 
               // echo "<td>" . $SpecName->species_primary_common_name . "</td>";
               // $startdate=date("Y/m/d",$TreeStartdate);
                $startdate=substr($TreeStartdate, 0,10);
                //echo $startdate;
              //  echo "<td>" . $startdate . "</td>";
                    $rowcount=0;
                    $Treeweek=0;
                    $CurTreeWeek=0;
                    $PrevTreeWeek=0;
                    $TotalTreeWeek=0;
                   
                    $sql_Ob_tree="select observation_id,date,user_tree_id from user_tree_observations where  user_tree_id=$TreeID   
                    ORDER BY  `user_tree_observations`.`date` DESC ";
                //echo $sql_Ob_tree;
                   $result_tree1=mysql_query($sql_Ob_tree);
                   $TreeObCount=mysql_numrows($result_tree1); 
                   //echo $TreeObCount;
                     for($x=0;$x<$TreeObCount;$x++)
                    {
                        if ($x==0)
                    $PrevTreeWeek=0;
               
               
                //echo "<br/>";
                $ObDate = mysql_result($result_tree1,$x,"date");
                //echo $ObDate;
                // 2011-10-05
                //Splitting year ,month ,date
                $StrYear = substr($ObDate, 0,4);
                $StrRem = substr($ObDate, 5,strlen($ObDate));
                $Strmonth = substr($StrRem, 0,2);
                $StrDate = substr($StrRem, 3,strlen($StrRem));

                //extracting the day name of a $ObDate
                $today = new DateTime($ObDate);
                // Display full day name
                $wekday=$today->format('l') . PHP_EOL; // lowercase L
                //echo $wekday;
                //get the weeknumber from the observation date
                $weekNumber= date("W", mktime(0,0,0,$Strmonth,$StrDate,$StrYear)); //get the weekNumber
               // echo ":-";
                //echo $weekNumber;
               // echo "<br/>";
                //$PrevTreeWeek = $weekNumber;
                $CurTreeWeek=$weekNumber;
                //echo $CurTreeWeek;
                    if ($PrevTreeWeek<>$CurTreeWeek)
                    {
                        $Treeweek=$Treeweek+1;
                        $PrevTreeWeek = $CurTreeWeek;
                    }
  
                    }
                   // echo "<br/>";
                    // echo "No. of weeks monitored:-";
               
                    $TotalTreeWeek=$TotalTreeWeek+$Treeweek;
                  //  echo "<td>" . $TotalTreeWeek . "</td></tr>";
                    $PrevTotalTreeWeekperTree= $PrevTotalTreeWeekperTree+$TotalTreeWeek;
                    
                    $FileString=$FileString." ".$TreeCoordrowinfo->full_name."|".$TreeMemName."|".$TreeName."|".$SpecName->species_primary_common_name."|".$startdate."|".$TotalTreeWeek."]";  
                    //echo $FileString;
                    //$rowcount++;
                    
                 }
                  
                
               // echo "<td colspan=6 align=right> ";
               // echo " &nbsp;&nbsp;&nbsp;<b>Total no. of weeks monitored:-";
               // echo $PrevTotalTreeWeekperTree;
                $FileString=$FileString."{".$PrevTotalTreeWeekperTree."}";
                $data[] = array('Info' => $FileString, 'TotalWeekMon' => $PrevTotalTreeWeekperTree);
                
                 
                
                }
                ?> 
               
                <?Php //echo "<br/>";
                
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
               // 
                }   
                mysql_close($link);
                //print_r($data);
                $SchoolInfo;
                 foreach($data as &$ma) 
                 { 
                    //SchoolInfo= 97|Njangattoor AUPS, Njangattari P.O, 679311| 1|Ottapalam[ M. Thahir, - ,pala near the well,Devil's Tree,2011-06-29,1]{1} 
                     $SchoolInfo =$ma["Info"];
                    list($schName,$remstr)=GetSchoolInfoString($SchoolInfo);
                    
                    //get the school name
                    echo "<div class=page-sub-title >School Name :"  ;
                    echo "<i>".$schName."</i>";
                
                    list($schTreeNo,$remstr)=GetSchoolInfoString($remstr);
                    echo "&nbsp;&nbsp;&nbsp;No of Trees : ";
                    echo "<i>".$schTreeNo."</i>";
                    
                    echo "&nbsp;&nbsp;&nbsp;Education District:- ";
                    
                    list($schEdDi,$remstr)=GetSchoolInfoString($remstr);
                    
                    echo "<i>".$schEdDi."</i>";
                    //echo $remstr;
                    echo "</div>";
                    echo "<table border=1 id=TopSchools>";
                    echo "<tr><th><b>Coordinator Name</b></th>";
                    echo "<th><b>Student Name</b></th>";
                    echo "<th><b>Tree NickName</b></th>";
                    echo "<th><b>Tree Species</b></th>";
                    echo "<th><b>Start date</b></th>";
                    echo "<th><b>No. of weeks monitored</b></th></tr>";
                    $remstr=GetRowInfoString($remstr);
                    echo "<td colspan=6 align=right><b>Total no. of weeks monitored = ";
                    //get the total no of observations
                   // echo $remstr;
                    $findme   = '}';
                    $pos = strpos($remstr, $findme);
                    //echo $pos;
                    
                    $retstr= substr($remstr,1,$pos-1);
                    echo $retstr;
                   // $str= substr($remstr, $pos+1,strlen($remstr));
                    //echo $retstr;
                    echo "</b></td>";
                     echo "</table>";
                     echo "<br/>";
                    
                 }
    function GetSchoolInfoString($str)
    { 
    //Njangattoor AUPS, Njangattari P.O, 679311| 1|Ottapalam|[ M. Thahir, - ,pala near the well,Devil's Tree,2011-06-29,1]{1} 
    // echo $str;
        $findme   = '|';
        $pos = strpos($str, $findme);
        $retstr= substr($str,0,$pos);
        $str= substr($str, $pos+1,strlen($str));
        return array($retstr, $str);
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
            list($CoordName,$remstr)=GetSchoolInfoString($remstr);
            echo "<tr><td>".strtoupper($CoordName)."</td>";
            //echo $remstr;
            list($StudentName,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".$StudentName."</td>";
            list($TreeNickName,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".ucfirst(strtolower($TreeNickName))."</td>";
            list($TreeSpecies,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".$TreeSpecies."</td>";
            list($Startdate,$remstr)=GetSchoolInfoString($remstr);
            echo "<td>".$Startdate."</td>";
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
</div>
</div>
<br/><br/>
