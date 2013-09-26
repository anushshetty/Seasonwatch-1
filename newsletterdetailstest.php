<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *  This page is get the content for the newsletter 
 */
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    session_start();
    //include_once("includes/dbcon.php");
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    
    $page_title=":: News letter Main Page ::";
    $fromdate_raw = mktime(0, 0, 0, date("m")-1, date("d"), date("y"));
    $fromdate = date("Y-m-d", $fromdate_raw);
     $todate = date("Y-m-d");
     $listuser =array();
//$json_object = array();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SeasonWatch :<?echo $page_title?></title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
 
<script type="text/javascript">
$(document).ready(function() {
  // Code using $ as usual goes here.
  //The DOM is now loaded and can be manipulated.
var dString = "Jan, 1, 2010";
var d1 = new Date(dString);
var d2 = new Date();
var noofDays=DateDiff(d1, d2);
$( "#fromdatepicker" ).datepicker({showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});  
$( "#todatepicker" ).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd',showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true});  
  
}
);
    function DateDiff(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
         return parseInt((t2-t1)/(24*3600*1000));
    }
    function clearall()
    {
        $('input:checkbox').removeAttr('checked');
       
    }
</script>

</head>

<body>
        <div class="header_place_holder">
        <div class="main"><!--  start main  -->
             <div class="header"><!--  start header  -->
                <div class="logo"><img src="images/seasonwatchlogo.png" alt="" width="180" height="82" /></div>
                <div class="top_right">
                    <ul>
                     <li><span class="tree"><?echo Login::NoTrees();?></span><p>Trees</p></li>
                    <li><span class="observation"><?echo Login::NoOfObservation();?></span><p>Observations</p></li>
                    <!--<li><span class="observation"><?echo number_format(Login::NoOfObservation());?></span><p>Observations</p></li>-->
                    <li><span class="participant"><?echo Login::NoParticipants();?></span><p>Participants</p></li>
                    <li><span class="school"><? echo Login::NoSchools();?></span><p class="schools">Schools</p></li>
                    </ul>
                </div>

                </div><!--  end header  -->
            </div><!--  end main  -->
        <div class="clearBoth"></div>
    </div> 
    <div class="wrapper">
        <div class="body_content_2">
         <div class="body_top">
        <div class="main">
            <div class="container">
                <div class="mytree"> <h2> Seasonwatch Newsletter Report </h2></div>
              </div>
        </div>
    </div> <!-- end div of body_top which includes Add tree heading-->  
     <div class="clearBoth"></div>
<?if(isset($_POST['fromdatepicker'])){ $fromdate = $_POST['fromdatepicker'];  }
if(isset($_POST['todatepicker'])){  $todate = $_POST['todatepicker'];}
if(isset($_POST['Fivestates'])){  $top5states =$_POST['Fivestates']; }else {$top5states="";}  
if(isset($_POST['newuser'])){  $newuser=$_POST['newuser'];  }else{$newuser="";}
if(isset($_POST['Fivetrees'])){ $top5trees = $_POST['Fivetrees'];}else{$top5trees="";}
if(isset($_POST['Noofobservation'])){ $noofob = $_POST['Noofobservation'];}else{$noofob="";}
if(isset($_POST['notrees'])){ $nooftrees = $_POST['notrees']; }else{$nooftrees="";}
if(isset($_POST['Totobservation'])){  $totobservation=$_POST['Totobservation']; }else{$totobservation="";}
if(isset($_POST['Reguser'])){  $registerduser=$_POST['Reguser']; }else{$registerduser="";}
if(isset($_POST['IndReguser'])){  $Indregisterduser=$_POST['IndReguser']; }else{$Indregisterduser="";}
if(isset($_POST['seedReguser'])){  $seedregisterduser=$_POST['seedReguser']; }else{$seedregisterduser="";}
if(isset($_POST['schReguser'])){  $schregisterduser=$_POST['schReguser']; }else{$schregisterduser="";}
if(isset($_POST['gspReguser'])){  $gspregisterduser=$_POST['gspReguser']; }else{$gspregisterduser="";}
if(isset($_POST['Seedtreeuser'])){  $seedtreeuser=$_POST['Seedtreeuser']; }else{$seedtreeuser="";}
if(isset($_POST['Schoolusers'])){  $SWSchoolusers=$_POST['Schoolusers']; }else{$SWSchoolusers="";}
if(isset($_POST['SwIndiuser'])){  $SwIndiuser=$_POST['SwIndiuser']; }else{$SwIndiuser="";}
if(isset($_POST['Swgspuser'])){  $Swgspuser=$_POST['Swgspuser']; }else{$Swgspuser="";}
?>
     <div>
    <form action="newsletterdetailstest.php" name="listFilter" id="listFilter" method="post" style="margin:0;">
           <table>
         <tr>
             <td>
            From
         </td>
          <td >
               <input type="text"  name="fromdatepicker" id="fromdatepicker"  class="datebox" value="<?=$fromdate;?>">
         </td>
         <td style="width:20px;"></td>
             <td>
            To
         </td>
          <td style=" padding:10px;">
               <input type="text"  name="todatepicker" id="todatepicker" class="datebox" value="<?=$todate;?>" >
         </td>
         </tr>
         <tr>
              <td>
            New User with atleast one tree with one observation
         </td>
         <td style=" padding:10px;">
             <?//echo $newuser;?>
              <input name="newuser" id="newuser" type="checkbox" <? if ($newuser=='1' ) echo "checked=checked"; ?>  value="1" />
         </td>
             
         </tr>
         <tr>
              <td>
            Top 5 trees reported
         </td>
          <td style=" padding:10px;">
              <input name="Fivetrees" id="Fivetrees" type="checkbox" <? if ($top5trees=='1' ) echo "checked=checked"; ?> value="1" />
         </td>
             
         </tr>
         <tr>
              <td>
            No of Observations
         </td>
         <td style=" padding:10px;">
              <input name="Noofobservation" id="Noofobservation" type="checkbox" <? if ($noofob=='1' ) echo "checked=checked"; ?> value="1" />
         </td>
             
         </tr>
         <tr>
              <td>
            No of trees observed 
         </td>
          <td style=" padding:10px;">
              <input name="notrees" id="notrees" type="checkbox"<? if ($nooftrees=='1' ) echo "checked=checked"; ?> value="1" />
         </td>
             
         </tr>
         <tr>
              <td>
            Total number of observation 
         </td>
          <td style=" padding:10px;">
             <input name="Totobservation" id="Totobservation" type="checkbox" <? if ($totobservation=='1' ) echo "checked=checked"; ?>value="1" />
         </td>
             
         </tr>
        <tr>
        <td>
         All Registered User  
        </td>
        <td style=" padding:10px;">
        <input name="Reguser" id="Reguser" type="checkbox" <? if ($registerduser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>

        </tr>
         <td>
         All Indiviual User(with atleast One tree and one observation)
        </td>
        <td style=" padding:10px;">
        <input name="IndReguser" id="IndReguser" type="checkbox" <? if ($Indregisterduser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>
         

        </tr>
        
                    <tr>
        <td>
         All Seed User  (with atleast One tree and one observation)
        </td>
        <td style=" padding:10px;">
        <input name="seedReguser" id="seedReguser" type="checkbox" <? if ($seedregisterduser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>

        </tr>
                    <tr>
        <td>
         All school User  (with atleast One tree and one observation)
        </td>
        <td style=" padding:10px;">
        <input name="schReguser" id="schReguser" type="checkbox" <? if ($schregisterduser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>

        </tr>
                    <tr>
        <td>
         All gsp User(with atleast One tree and one observation)
        </td>
        <td style=" padding:10px;">
        <input name="gspReguser" id="gspReguser" type="checkbox" <? if ($gspregisterduser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>
         
        </tr>
                           <tr>
        <td>
         Seed user with atleast one tree User  
        </td>
        <td style=" padding:10px;">
        <input name="Seedtreeuser" id="Seedtreeuser" type="checkbox" <? if ($seedtreeuser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>

        </tr>
                                 <tr>
        <td>
         Reg school User with or without tree  
        </td>
        <td style=" padding:10px;">
        <input name="Schoolusers" id="Schoolusers" type="checkbox" <? if ($SWSchoolusers=='1' ) echo "checked=checked"; ?>value="1" />
        </td>
        </tr>
         <tr>
        <td>
         Reg Individual User with or without tree  
        </td>
        <td style=" padding:10px;">
        <input name="SwIndiuser" id="SwIndiuser" type="checkbox" <? if ($SwIndiuser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>

        </tr>
                                        <tr>
        <td>
         Reg gsp User with or without tree  
        </td>
        <td style=" padding:10px;">
        <input name="Swgspuser" id="Swgspuser" type="checkbox" <? if ($Swgspuser=='1' ) echo "checked=checked"; ?>value="1" />
        </td>

        </tr>
     </table>
    <div class="right_side_button">
      <input type="submit" name="SAVE" id="SAVE" value="SAVE" class="addbutton_area_ok"/>
      <div class="button_area_cancel"><a onclick="clearall()">CANCEL</a></div>
    </div>
    </form>
    </div>
     <div class="clearBoth"></div>
     <hr>
         <div>
             <? //report
                if(isset($_POST['Totobservation']))
                {
                   $totnoob= "select count(*) as num from user_tree_observations where deleted='0' and user_id != 140 ";
                   $result4 = $dbc->readtabledata($totnoob);
                   $data=mysql_fetch_assoc($result4);
                   $tot_num_obs = $data['num'];
                   echo "Total Number of observations till" .$todate." = ".$tot_num_obs;
                   echo "<br>";
                }
                echo "<br>";
                if(isset($_POST['Noofobservation']))
                {
                  $noofobservation="select count(*) as numofob from user_tree_observations where deleted='0' and user_id != 140 and date between '$fromdate' and '$todate'";
                  $result4 = $dbc->readtabledata($noofobservation);
                  $data=mysql_fetch_assoc($result4);
                  $num_obs = $data['numofob'];
                  echo " Number of observations from ".$fromdate." to ".$todate." = ".$num_obs;
                  echo "<br>";
                }
                    
                // Number of tree observed according last_observation date 
                if(isset($_POST['notrees']))
                {
                  $nooftreeobserved="select t.tree_id,utt.user_tree_id from trees as t,user_tree_table as utt where utt.last_observation_date between  '$fromdate' and '$todate'  and utt.tree_id=t.tree_id";
                  $result4 = $dbc->readtabledata($nooftreeobserved);
                  $tree_no=mysql_num_rows($result4);
                  echo " Number of tree observed from".$fromdate." to ".$todate." = ".$tree_no;
                  echo "<br>";
                }
                //for New user with atleast one tree with one observation
                 if(isset($_POST['newuser']))
                 { ?>
                    <div>New Users Information from <?echo $fromdate?> to <?echo $todate?></div>
                    <table style="padding-left:5px;border:1px solid #000;">
                    <tr style="padding-left:5px;border:1px solid #000;">
                        <td style="padding:5px;">New Users</td>
                        <td style="width:15px;"></td>
                        <td style="padding: 5px;border:1px solid #000;"><?echo JustNewuser($fromdate,$todate)?></td>
                    </tr>
                     <?echo NewuserwithTreeObservation($fromdate,$todate);?> 
                     </table>
                     <br>
                    <?
                 }
               function JustNewuser($fromdate,$todate)
               {
                    $newusersql="select distinct users.user_id from users where date_of_addition  between '$fromdate'AND  '$todate'";
                    $dbc=Dbconn::getdblink();
                    $newusers = $dbc->readtabledata($newusersql);
                    $num_newusers = mysql_num_rows($newusers);
                    return ($num_newusers);
               }
               
               function NewuserwithTree($fromdate,$todate)
               {
                   $sql="select distinct users.user_id from users where date_of_addition  between '$fromdate'AND  '$todate'";
                   $userwithtree=0;
                   $dbc=Dbconn::getdblink();
                   $userswithtree = $dbc->readtabledata($sql);
                   $num_userswithtree = mysql_num_rows($userswithtree);
                   while ($row_settings = mysql_fetch_array($userswithtree)) 
		    { 
                        $treechk="select * from user_tree_table,users where user_tree_table.user_id=users.user_id and users.user_id='$row_settings[user_id]' and user_tree_table.date_of_addition  BETWEEN  '$fromdate'AND  '$todate'";
                        $userswithtreeck = $dbc->readtabledata($treechk);
                        $num_userswithtreen = mysql_num_rows($userswithtreeck);
                        if($num_userswithtreen >0)
                        {
                            $userwithtree++;
                         }
                    }
                    return ($userwithtree);
                
               }
               function NewuserwithTreeObservation($fromdate,$todate)
               {   
                    $sql="select distinct users.user_id,users.user_category,users.user_email,users.group_id,users.full_name from users where date_of_addition  between '$fromdate'AND  '$todate'";
                    $dbc=Dbconn::getdblink();
                    $userswithtree = $dbc->readtabledata($sql);
                    $i=0;
                     //echo "<br>";
                     $userwithtreeob=0;
                     $userwithtreebutob=0;
                     $userwithtree=0;
                     $userwithouttree=0;
                     $num_userswithtree = mysql_num_rows($userswithtree);
                  ?> <?
                     while ($row_settings = mysql_fetch_array($userswithtree)) 
		    {    $i++;
                        //Check whether tree exists
                       $userlog=0;
                      // echo "user:-".$i;
                        $treechk="select * from user_tree_table,users where user_tree_table.user_id=users.user_id and users.user_id='$row_settings[user_id]' and user_tree_table.date_of_addition  BETWEEN  '$fromdate'AND  '$todate'";
                        //echo $treechk;
                        $userswithtreeck = $dbc->readtabledata($treechk);
                        $num_userswithtreen = mysql_num_rows($userswithtreeck);
                    
                        if($num_userswithtreen >0)
                        {
                            $userwithtree++;
                         
                        }
                        else {
                                $userwithouttree++;
                        }
                        $treecunt=0;
                        while ($row_tree = mysql_fetch_array($userswithtreeck)) 
                        {//get treename
                          $treecunt++;
                              $treeObchk="select * from user_tree_observations where  user_tree_id='$row_tree[user_tree_id]' and user_id='$row_settings[user_id]' and date BETWEEN  '$fromdate'AND  '$todate'";
                                $userswithtreeObck = $dbc->readtabledata($treeObchk);
                               $num_userswithtreeObck = mysql_num_rows($userswithtreeObck);
                               if ($num_userswithtreeObck >0)
                               {
                                   if ($userlog=='0')
                                   {
                                    $userwithtreeob++;?>
                                    <?
                                    if( $row_settings['group_id']>0)
                                    {
                                        //get school name 
                                        $schoolinfo="select group_name from user_groups where group_id=' $row_settings[group_id]'
                                            and coord_id='$row_settings[user_id]'";
                                         $schoolname = $dbc->readtabledata($schoolinfo);
                                         list($group_name) = mysql_fetch_row($schoolname);
                                    }
                                    else{
                                        $group_name = $row_settings['full_name'];
                                    }?>
                             <div width="50%"> <? echo  $userwithtreeob." . " .$row_settings['user_email']."    ::    ".$row_settings['user_category']."    ::    ".$group_name;?> </div>
                                  
                                    
                                   <? 
                                    $userlog=1;
                                   
                                   }
                                    else
                                    {
                                        $userwithtreebutob++;
                                        $userlog=2;
                                     
                                    }
                               }
                              
                        } 
                        
                      }
                      
                     
                      ?>
             
             <tr style="border-bottom:1px solid #000;">
                 <td style="padding:5px;">
                     New Users with Tree and observation
                 </td>
                 <td style="width:15px;"></td>
                 <td  style="padding:5px;border:1px solid #000;">
                     <? echo $userwithtreeob;?>
                 </td>
             </tr>
             <tr  style="border:1px solid #000; ">
                 <td style="padding:5px;">
                     New Users with Tree
                 </td>
                 <td style="width:15px;"></td>
                 <td  style="padding:5px;border:1px solid #000;">
                     <? echo $userwithtree;?>
                 </td>
             </tr>
             <tr  style="border:1px solid #000;">
                 <td style="padding:5px;">
                     New Users without Tree
                 </td>
                 <td style="width:15px;"></td>
                 <td  style="padding:5px;border:1px solid #000;">
                     <? echo $userwithouttree;?>
                 </td>
             </tr>
                  
                     
                   
               <?}
               
             
                if(isset($_POST['Fivetrees']))
               
               {
                  $nooftreeobserved="select t.tree_id,utt.user_tree_id from trees as t,user_tree_table as utt where utt.last_observation_date between  '$fromdate' and '$todate'  and utt.tree_id=t.tree_id";
                  $dbc=Dbconn::getdblink();
                  $result4 = $dbc->readtabledata($nooftreeobserved);
                  $tree_no=mysql_num_rows($result4);
                  //echo " Number of tree observed =".$tree_no;
                  for($i=0;$i<$tree_no;$i++)
                  {
                    $data=mysql_fetch_array($result4);
                    $observpertree="select count(observation_id) as obpertree,us.user_email,utt.user_id,us.state_id,utt.tree_nickname,tree.tree_location_id,tree.species_id,sm.species_search_names from
                    species_master as sm,trees as tree,user_tree_observations as uto,user_tree_table as utt,users as us where uto.user_tree_id='$data[user_tree_id]'and uto.date between  '$fromdate' and '$todate' 
                    and utt.user_tree_id=uto.user_tree_id and tree.tree_id=utt.tree_id and sm.species_id=tree.species_id and us.user_id=utt.user_id";
                    $obresult = $dbc->readtabledata($observpertree);
                    $obper=mysql_fetch_assoc($obresult);
                    $Treedata[$i] = array('TreeID' => $data['user_tree_id'], 'Treeob' => $obper['obpertree'],'TreeName' =>$obper['tree_nickname'],
                             'TreeSpeciesid' =>$obper['species_id'],'TreeSpecies' =>$obper['species_search_names'],'TreeUser'=>$obper['user_email']);
                  }
                  foreach ($Treedata as $key => $row) 
                    {
                        $TreeID[$key]  = $row['TreeID'];
                        $Treeob[$key] = $row['Treeob'];
                        $Treename[$key]= $row['TreeName'];
                        $TreeSpecies[$key]= $row['TreeSpecies'];
                        $TreeSpeciesid[$key]= $row['TreeSpeciesid'];
                        $TreeUser[$key]=$row['TreeUser'];
                   }
                   if (is_array($Treeob))
                   {
                    array_multisort($Treeob, SORT_DESC, $Treedata);
                   }
                   
                   echo "Top 5 Trees observed from ".$fromdate." to ".$todate." are ";
                   echo "<br>";
                   $j=1;
                   ?>
                    <table style="padding:2px;align:center;border:1px solid #000;">
                    <?for($i=0;$i<=4;$i++)
                      { ?>
                       <tr style="padding:2px;align:center;border:1px solid #000;">
                           <td style="width:20px;border:1px solid #000;padding:5px; " ><?echo $j?></td>
                            <td style="border:1px solid #000;padding:5px; "><?echo $Treedata[$i]['TreeName']?> </td>
                      
                       <td style="border:1px solid #000;padding:5px; "><?echo $Treedata[$i]['TreeSpecies']?> </td>
                       </tr>
                          <?
                          $j++;
                         
                      }?>
                   </table>
                       <br><?
               }
             ?>
                           
               <? if(isset($_POST['Reguser']))
                 {$data = array();
                  $data= GetUserData("all");
                  $Userlist=array();
                    $Userlist=GetUserData ("all");
                    $filename="allregistereduser.csv";
                    writecsvfile($filename,$Userlist);
                     if (file_exists($filename))
                    { //check indivuserwithtreeob.csv?>
                     All Registersd User with tree <a href=" <?echo $filename?>" style="color:red">download file <?echo $filename?> </a>
                     <br> <? }
                 }
                    
                 function GetAllReguser($todate)
                 {
                    $AllRegusersql="select distinct users.user_id,users.user_category,users.user_email,users.group_id,users.full_name,
                        users.state_id,users.date_of_addition,users.date,users.group_id from users where user_id!='140' and date_of_addition  <='$todate'";
                    //echo $AllRegusersql;
                    $dbc=Dbconn::getdblink();
                    $AllRegUsers = $dbc->readtabledata($AllRegusersql);
                    return ($AllRegUsers);
                    echo "<br>";
                }
                
                 function GetAllReguserwithcat($todate,$category)
                 {
                    $AllRegusersql="select distinct users.user_id,users.user_category,users.user_email,users.group_id,users.full_name,
                        users.state_id,users.date_of_addition,users.date,users.group_id from users where user_id!='140'
                        and users.user_category='$category' and date_of_addition  <='$todate'";
                    //echo $AllRegusersql;
                    $dbc=Dbconn::getdblink();
                    $AllRegUsers = $dbc->readtabledata($AllRegusersql);
                    return ($AllRegUsers);
                    echo "<br>";
                }
                function DoesGetUserhastree($user_id)
                {
                    $UserhasTreesql= "select  *  from  user_tree_table as utt,trees as t  where user_id='$user_id' and t.tree_Id=utt.tree_Id and deleted = 0   ";
                    $dbc=Dbconn::getdblink();
                    $Usertrees = $dbc->readtabledata($UserhasTreesql);
                    $tree_no=mysql_num_rows($Usertrees);
                    return ($tree_no);
                }
                
                function GetTreeswithObservationNo($user_id)
                {   $i=0;  
                    $userInformation=array();
                     $UserhasTreesql= "select  *  from  user_tree_table as utt,trees as t  where  user_id='$user_id' and t.tree_Id=utt.tree_Id and deleted = 0 ";
                    $dbc=Dbconn::getdblink();
                    $Usertrees = $dbc->readtabledata($UserhasTreesql);
                     
                    while ($regusertree_row = mysql_fetch_array($Usertrees))
                    {
                        //get the last observation date,treename,treespecies and no of observations.
                       
                        //get the nunber of observation for this tree_id
                        $Usertreewithobsql="select * from user_tree_observations where user_id='$user_id'
                            and user_tree_id='$regusertree_row[user_tree_id]' and deleted='0'";
                       // echo $Usertreewithobsql;
                        $Treewithob = $dbc->readtabledata($Usertreewithobsql);
                        $TreewithObno=mysql_num_rows($Treewithob);
                        //echo " ObservationNo :- ".$TreewithObno;
                        
                        if ($TreewithObno >0)
                        {
                           
                            //get species name
                           // echo "species_id:=".$regusertree_row['species_id'];
                            $UsertreespeciesSql="select species_primary_common_name from  species_master where species_id='$regusertree_row[species_id]'";
                            $usertreespecies = $dbc->readtabledata($UsertreespeciesSql);
                            list($species_primary_common_name)= mysql_fetch_row($usertreespecies);
                            $userInfosql ="Select  users.user_id,users.user_category,users.user_email,users.group_id,users.full_name,
                                    users.state_id,users.date_of_addition,users.date,users.group_id
                                    from users where user_id='$user_id'";
                            $userInfo = $dbc->readtabledata($userInfosql);
                            list($user_id,$user_category,$user_email,$group_id,$full_name,$state_id,$date_of_addition)= mysql_fetch_row($userInfo);
                            if($group_id >0)
                            {
                                $schoolinfo="select group_name from user_groups where group_id=' $group_id'
                                and coord_id='$user_id'";
                                $schoolname = $dbc->readtabledata($schoolinfo);
                                list($group_name) = mysql_fetch_row($schoolname);
                            }
                            else
                            {
                                $group_name="-";
                            }
                            
                            
                             $info=$user_id.",".$user_category.",".$user_email.","
                            .$group_id.",".$group_name.",".$full_name.",".$state_id.",".$date_of_addition.
                             ",".$species_primary_common_name.",".$regusertree_row['tree_nickname'].
                             ",".$regusertree_row['user_tree_id'].",".$regusertree_row['last_observation_date'].",".$TreewithObno.":";
                            // echo $info;
                             
                       $userInformation[$i]=$info;
                          $i++;
                       
                            
                        }
                       
                    }
                     
                }
                  //seed user with atleast one tree
                if(isset($_POST['Seedtreeuser']))
                {
                    $Userlist=array();
                    $Userlist=GetUserData ("school-seed");
                    $filename="seeduserswithtree.csv";
                    writecsvfile($filename,$Userlist);
                     if (file_exists($filename))
                    { //check indivuserwithtreeob.csv?>
                     Seed User with tree <a href=" <?echo $filename?>" style="color:red">download file <?echo $filename?> </a>
                     <br> <? }
                  }
                
                if(isset($_POST['Schoolusers']))
                { 
                    $filename="Schoolusers.csv";
                    $category ="school";
                    $Userlist=array();
                    $Userlist=GetUserData ("school");
                    writecsvfile($filename,$Userlist);
                    if (file_exists($filename))
                    { ?>
                    Reg <?echo $category?> User with or without tree <a href=" <?echo $filename?>" style="color:red">download file <?echo $filename?> </a>
                    <br><? }
                 }
                 if(isset($_POST['Swgspuser']))
                { 
                    $Userlist=array();
                    $filename="gspusers.csv";
                    $category ="school-gsp";
                    $Userlist=GetUserData ("school-gsp");
                    writecsvfile($filename,$Userlist);
                    if (file_exists($filename))
                    {?>
                    Reg <?echo $category?> User with or without tree <a href=" <?echo $filename?>" style="color:red">download file <?echo $filename?> </a>
                    <br>
                    <? }
                }
                if(isset($_POST['SwIndiuser']))
                { 
                    $filename="indivusers.csv";
                    $Userlist=array();
                    $Userlist=GetUserData ("individual");
                    $category ="individual";
                    writecsvfile($filename,$Userlist);
                    if (file_exists($filename))
                    {?>
                    Reg <?echo $category?> User with or without tree <a href=" <?echo $filename?>" style="color:red">download file <?echo $filename?> </a>
                    <br>
                    <? }
                 }
               
                if(isset($_POST['seedReguser']))
                { 
                    $Seeduser=array();
                    $Seeduser=Getuser("school-seed");
                    $alluser=array();
                     $user_id="user_id";
                    $user_category="user_category";
                    $user_email="user_email";
                     $group_id="group_id";
                    $group_name="group_name";
                    $full_name="full_name";
                    $state_id="state_name";
                    $date_of_addition="Registerd date";
                    $species_primary_common_name="species_primary_common_name";
                    
                    $tree_nickname="tree_nickname";
                    $user_tree_id="user_tree_id";
                    $tree_added_date="tree_added_date";
                    $last_observation_date="last_observation_date";
                    $NoOfTreesob="NoOfTreesob";
                    $alluser[0]= $user_id.",".$user_category.",".$user_email.","
                                        .$group_id.",".$group_name.",".$full_name.
                                          ",".$state_id.",".$date_of_addition.","
                                          .$species_primary_common_name.",".$tree_nickname.",".$user_tree_id.",".$tree_added_date.",".$last_observation_date.",".$NoOfTreesob;
                    
                    $alluser = array_merge((array)$alluser,(array)$Seeduser );
                    unset($Seeduser);
                    
                    $filename="seeduserwithtreeob.csv";
                    writecsvfile($filename,$alluser);
                     if (file_exists("seeduserwithtreeob.csv"))
                    { //check indivuserwithtreeob.csv
                        ?>
                          
                             All Seed User(with atleast One tree and one observation) file created <a href="seeduserwithtreeob.csv" style="color:red">download file seeduserwithtreeob.csv. </a>
                          </br>

                   <? }
                    
                    
                }
                 if(isset($_POST['schReguser']))
                { 
                    
                     $user_id="user_id";
                    $user_category="user_category";
                    $user_email="user_email";
                     $group_id="group_id";
                    $group_name="group_name";
                    $full_name="full_name";
                    $state_id="state_name";
                    $date_of_addition="Registerd date";
                    $species_primary_common_name="species_primary_common_name";
                    
                    $tree_nickname="tree_nickname";
                    $user_tree_id="user_tree_id";
                    $tree_added_date="tree_added_date";
                    $last_observation_date="last_observation_date";
                    $NoOfTreesob="NoOfTreesob";
                    $alluser[0]= $user_id.",".$user_category.",".$user_email.","
                                        .$group_id.",".$group_name.",".$full_name.
                                          ",".$state_id.",".$date_of_addition.","
                                          .$species_primary_common_name.",".$tree_nickname.",".$user_tree_id.",".$tree_added_date.",".$last_observation_date.",".$NoOfTreesob;
                    
                    $School=array();
                    $School=Getuser("school");
                    $alluser = array_merge((array)$alluser,(array)$School);
                    
                    $filename="schooluserwithtreeob.csv";
                    writecsvfile($filename,$alluser);
                    unset($School);
                    if (file_exists("schooluserwithtreeob.csv"))
                    { //check indivuserwithtreeob.csv
                        ?>
                          
                             All school User(with atleast One tree and one observation) file created <a href="schooluserwithtreeob.csv" style="color:red">download file schooluserwithtreeob.csv. </a>
                          </br>

                   <? }
                    
                }
                if(isset($_POST['gspReguser']))
                { 
                    $user_id="user_id";
                    $user_category="user_category";
                    $user_email="user_email";
                    $group_id="group_id";
                    $group_name="group_name";
                    $full_name="full_name";
                    $state_id="state_name";
                    $date_of_addition="Registerd date";
                    $species_primary_common_name="species_primary_common_name";
                    
                    $tree_nickname="tree_nickname";
                    $user_tree_id="user_tree_id";
                    $tree_added_date="tree_added_date";
                    $last_observation_date="last_observation_date";
                    $NoOfTreesob="NoOfTreesob";
                    $alluser[0]= $user_id.",".$user_category.",".$user_email.","
                                        .$group_id.",".$group_name.",".$full_name.
                                          ",".$state_id.",".$date_of_addition.","
                                          .$species_primary_common_name.",".$tree_nickname.",".$user_tree_id.",".$tree_added_date.",".$last_observation_date.",".$NoOfTreesob;
                    
                    $gspSchool=array();
                    $gspSchool=Getuser("school-gsp");
                    $alluser = array_merge((array)$alluser,(array)$gspSchool);
                   $filename="gspuserwithtreeob.csv";
                    writecsvfile($filename,$alluser);
                    unset($gspSchool);
                    if (file_exists("gspuserwithtreeob.csv"))
                    { //check indivuserwithtreeob.csv
                        ?>
                          
                             All gsp User(with atleast One tree and one observation) file created <a href="gspuserwithtreeob.csv" style="color:red">download file gspuserwithtreeob.csv. </a>
                          </br>

                   <? }
                    
                }
                if(isset($_POST['IndReguser']))
                { 
                     $user_id="user_id";
                    $user_category="user_category";
                    $user_email="user_email";
                     $group_id="group_id";
                    $group_name="group_name";
                    $full_name="full_name";
                    $state_id="state_name";
                    $date_of_addition="Registerd date";
                    $species_primary_common_name="species_primary_common_name";
                    
                    $tree_nickname="tree_nickname";
                    $user_tree_id="user_tree_id";
                    $tree_added_date="tree_added_date";
                    $last_observation_date="last_observation_date";
                    $NoOfTreesob="NoOfTreesob";
                    $alluser[0]= $user_id.",".$user_category.",".$user_email.","
                                        .$group_id.",".$group_name.",".$full_name.
                                          ",".$state_id.",".$date_of_addition.","
                                          .$species_primary_common_name.",".$tree_nickname.",".$user_tree_id.",".$tree_added_date.",".$last_observation_date.",".$NoOfTreesob;
                    
                    $indiv=array();
                    $indiv=Getuser("individual");
                    $alluser = array_merge((array)$alluser,(array)$indiv);
                    $filename="indivuserwithtreeob.csv";
                    writecsvfile($filename,$alluser);
                    unset($indiv);
                    //echo file_exists("indivuserwithtreeob.csv");
                    if (file_exists("indivuserwithtreeob.csv"))
                    { //check indivuserwithtreeob.csv
                        ?>
                             
                              All Indiviual User(with atleast One tree and one observation) file created <a href="indivuserwithtreeob.csv" style="color:red">download file "indivuserwithtreeob.csv" </a>
                              </br>

                   <? }
                    
                    
                }
                
/*a. Name of person
b. Name of school (if applicable, else blank)
c. Type of participant (School-SEED, School-GSP, School-Other, Individual)
d. State
e. Email address
f. Date of registration with SW. In the case of SEED schools this would be the date the first tree was added.
g. Number of trees registered
h. Number of observations (of all this user's trees combined)
i. Date of most recent observation of any of this user's trees (or blank if no observations)*/               
    function GetUserData($category)
    {
       
    $Userlist=array();
    if (($category == "school-gsp")||($category == "school"))
    {
    $indusersql="SELECT DISTINCT users.user_id,users.user_category,users.user_email,users.group_id,users.full_name,
    users.state_id,users.date_of_addition FROM users 
    WHERE  approved='1' and user_category ='$category'and group_role ='coord'";
    }
    else if ($category=="school-seed")
    {
    $indusersql="SELECT distinct users.user_id,users.user_category,users.user_email,users.state_id,users.date_of_addition ,user_groups.group_id,user_groups.group_name, users.mobile,users.full_name, users.user_name
    FROM `users`,`user_tree_table`,user_groups
    WHERE users.user_id=user_tree_table.user_id AND
    users.user_category='school-seed' AND
    user_groups.coord_id=users.user_id and group_role ='coord'";
    }
    else if ($category=="individual")
    {
    $indusersql="SELECT DISTINCT users.user_id,users.user_category,users.user_email,users.group_id,users.full_name,
    users.state_id,users.date_of_addition FROM users 
    WHERE  approved='1' and user_category !=  'school'
    AND user_category !=  'school-seed' AND user_category !=  'school-gsp' and user_id != 140";   
    }
    else if ($category=="all")
    {
    $indusersql="SELECT DISTINCT users.user_id,users.user_category,users.user_email,users.group_id,users.full_name,
    users.state_id,users.date_of_addition FROM users 
    WHERE user_id != 140";    
    }
    $dbc=Dbconn::getdblink();
    $induser = $dbc->readtabledata($indusersql);
    $userno =0;
    $treeno=0;
    $cntob=0;
    $com=",";
    if ($category == "school-seed")
    {
        //echo $firsttreeaddeddate;
        $Sw ="Tree addded Date";
    }
    else {
           $firsttreeaddeddate="-";
          $Sw ="registration Date";
    }
    $Userlist[0]= "person $com school $com participant $com State $com emailid $com $Sw $com No Trees  $com No of Observations $com Last observation date";
    // get the list of tree by user
    while ($induser_row = mysql_fetch_array($induser))
    {
         $treeno=0;
    $cntob=0;
        if($induser_row['group_id'] >0)
        {
            $schoolinfo="select group_name from user_groups where group_id='$induser_row[group_id]' and coord_id='$induser_row[user_id]'";
            $schoolname = $dbc->readtabledata($schoolinfo);
            list($group_name) = mysql_fetch_row($schoolname);
            $groupname= str_replace(',', '-',$group_name);
        }
        else
        {
            $groupname="-";
        }
        $statenamesql= "select state from seswatch_states where state_id='$induser_row[state_id]'";
        $statename = $dbc->readtabledata($statenamesql);
        list($state) = mysql_fetch_row($statename);
        $IndUsertreesql="select utt.tree_nickname,utt.user_tree_id,utt.tree_id,utt.date_of_addition,utt.last_observation_date,t.species_id
        from trees as t ,user_tree_table as utt where t.deleted = 0 and 
        utt.user_id='$induser_row[user_id]' and t.tree_Id= utt.tree_id
        and utt.user_id!=140 ORDER BY  `utt`.`date_of_addition` ASC ";
      
        $indusertrees = $dbc->readtabledata($IndUsertreesql);
        $NoOfTrees=mysql_num_rows($indusertrees);
        $treeno= $treeno+$NoOfTrees;
        //observations for that tree
        $i=0;
      
        while ($indusertrees_row = mysql_fetch_array($indusertrees))
        {
            if ($i==0){ $firsttreeaddeddate = $indusertrees_row['date_of_addition'];}

            $Indusertreeobsql="select * from user_tree_observations where user_id ='$induser_row[user_id]' and
            user_tree_id='$indusertrees_row[user_tree_id]' and deleted=0";
            $Indusertreeob = $dbc->readtabledata($Indusertreeobsql);
            $NoOfTreesob=mysql_num_rows($Indusertreeob);
            $cntob=$cntob+$NoOfTreesob;
            if ($NoOfTreesob >0)
            {
                $LatestTreeobsql="select  utt.last_observation_date,utt.tree_nickname,utt.user_tree_id,utt.tree_id,utt.date_of_addition,t.species_id
                from trees as t ,user_tree_table as utt where t.deleted = 0 and 
                utt.user_id='$induser_row[user_id]' and t.tree_Id= utt.tree_id
                and utt.user_id!=140 ORDER BY  `utt`.`last_observation_date` DESC limit 1" ;
                $LatestTreeob = $dbc->readtabledata($LatestTreeobsql);
                list($latestobdate) = mysql_fetch_row($LatestTreeob);
                
            }
            $i++;
        }
        if ($induser_row['user_category'] == "school-seed")
        {
            //echo $firsttreeaddeddate;
           // $Sw ="Tree addded Date";
        }
        else {
               $firsttreeaddeddate="-";
               $firsttreeaddeddate= $induser_row['date_of_addition'];
              // $Sw ="registration Date";
        }
        $fullname = str_replace(',', '-',$induser_row['full_name']); 
          if (($category=="school-seed") && ($treeno>0 ))
          {
         $info= $fullname.$com.$groupname.$com.$induser_row['user_category'].$com
                 .$state.$com.$induser_row['user_email'].$com.$firsttreeaddeddate.$com
                 .$treeno.$com.$cntob.$com.$latestobdate;
            $Userlist[]=$info;
          }
          else 
          {
               $info= $fullname.$com.$groupname.$com.$induser_row['user_category'].$com
                 .$state.$com.$induser_row['user_email'].$com.$firsttreeaddeddate.$com
                 .$treeno.$com.$cntob.$com.$latestobdate;
               $Userlist[]=$info;
          }
    }
    return ($Userlist);
    }
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
               
                             
         </div>
     </div>
        
        
    </div>
   
    
</body>