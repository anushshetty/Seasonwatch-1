<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *  This page is get the content for the newsletter 
 */

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
if(isset($_POST['Totobservation'])){  $totobservation=$_POST['Totobservation']; }else{$totobservation="";}?>
     <div>
    <form action="newsletterdetails.php" name="listFilter" id="listFilter" method="post" style="margin:0;">
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
        
     </table>
    <div class="right_side_button">
      <input type="submit" name="SAVE" id="SAVE" value="SAVE" class="addbutton_area_ok"/>
      <div class="button_area_cancel"><a onclick="document.getElementById('lightOne<?echo $i;?>').style.display='none';document.getElementById('fadeOne').style.display='none';resetobs<?php echo $i?>();" href="javascript:void(0)">CANCEL</a></div>
    </div>
    </form>
    </div>
     <div class="clearBoth"></div>
    
     <hr>
         <div>
             <? //report
             //total number of observation till date where deleted!="1"
             $Treedata=  array();
                if(isset($_POST['Totobservation']))
                {
                   $totnoob= "select count(*) as num from user_tree_observations where deleted='0' and user_id != 140 ";
                  // echo  $totnoob;
                   echo "<br>";
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
                   echo "<br>";   
                // Number of tree observed according last_observation date 
                if(isset($_POST['notrees']))
                {
                  $nooftreeobserved="select t.tree_id,utt.user_tree_id from trees as t,user_tree_table as utt where utt.last_observation_date between  '$fromdate' and '$todate'  and utt.tree_id=t.tree_id";
                  $result4 = $dbc->readtabledata($nooftreeobserved);
                  $tree_no=mysql_num_rows($result4);
                  echo " Number of tree observed from".$fromdate." to ".$todate." = ".$tree_no;
                  echo "<br>";
                  
                }
               
                 echo "<br>";   
                
  
              
               
               
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
                   // echo $sql;
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
                         // echo $treecunt.".".$row_tree['tree_nickname']." :--".$row_tree['user_tree_id'];
                          //check observation for each tree exists
                            $treeObchk="select * from user_tree_observations where  user_tree_id='$row_tree[user_tree_id]' and user_id='$row_settings[user_id]' and date BETWEEN  '$fromdate'AND  '$todate'";
                               // user_tree_table.user_id=users.user_id and users.user_id='$row_settings[user_id]' and user_tree_table.date_of_addition  BETWEEN  '$fromdate'AND  '$todate'";
                            //echo $treeObchk;
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
                        
                      }?>
             
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
                             
         </div>
     </div>
        
        
    </div>
   
    
</body>