<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>

<?
   ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    session_start();
    //include_once("includes/dbcon.php");
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    $page_title ='participant Info';
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SeasonWatch :<?echo $page_title?></title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
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
                <div class="mytree"> <h2> Participant list </h2></div>
              </div>
        </div>
    </div> <!-- end div of body_top which includes Add tree heading--> 
     <div class="clearBoth"></div>
     <?
     $query="SELECT distinct users.user_id,users.full_name,users.city FROM users,user_tree_table where approved='1' and  user_category !='school' and  user_category !='school-seed' 
       and user_category !='school-gsp' and user_tree_table.user_id=users.user_id and users.user_id!=140";
   
     $result4 = $dbc->readtabledata($query);
            
if(!$result4)
{
	die("query no executed:".mysql_errno());

}

?>
<table>
         <tr>
             <td class="addleavesSection_boxOne"> <h5>sl no</h5> </td>
              <td style='width:500px;color:#333;'>
                     <h5>User name</h5>
             </td>
              <td style='width:200px;'>
                  <h5>City</h5>
             </td>
             
             <td style='width:150px;'>
                 <h5> No of trees</h5>
             </td>
             
             
            <!-- <td style='width:300px;'>No of observations</td>-->
         </tr>
<?
$i=0;
while($row=mysql_fetch_assoc($result4))
{?>
         
        <?$query2=" SELECT  COUNT( * ) AS num 
        FROM  user_tree_table,users
        where user_tree_table.user_id=users.user_id
        and users.user_id='$row[user_id]'";
        $result = $dbc->readtabledata($query2);
        $data=mysql_fetch_assoc($result);
        $tree_num = $data['num'];
       
        $query3=" SELECT  COUNT( * ) AS num 
        FROM  user_tree_observations,users
        where user_tree_observations.user_id=users.user_id
        and users.user_id='$row[user_id]' and deleted=0";
        $result1 = $dbc->readtabledata($query3);
        $data1=mysql_fetch_assoc($result1);
        $ob_num = $data1['num'];
        if ($ob_num >0)
        { $i++;?>
          <tr>
             <td><?echo $i;?></td>
        <td> <? if (!(empty($row['full_name'])))
        {echo $row['full_name'];
        } else
        {echo "-";}?></td>
         <td> <?if(!(empty($row['city']))) {echo $row['city'];}else {echo "-";}?></td>
        <td><?echo $tree_num?></td>
       <!-- <td><?echo $ob_num?></td>-->
         </tr>
            
       <? }?>
       
       
<?}?>
     </table>
     <br>
      <div class="clearBoth"></div>
        </div>
    </div>
     <div id="mask"></div>
    <!--  start footer  -->
    <?php include ("includes/footer.php"); ?>
    <!--  end footer  -->

</body>
</html>
    