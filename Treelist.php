<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?
   ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    session_start();
    
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    $page_title="Tree List";
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
                <div class="mytree"> <h2> <?echo $page_title;?>  </h2></div>
              </div>
        </div>
    </div> <!-- end div of body_top which includes Add tree heading--> 
     
     <?
    $query= "Select * from Species_master ORDER BY  `species_master`.`species_primary_common_name` ASC ";
    $result4 = $dbc->readtabledata($query);
    if(!$result4)
    {die("query no executed:".mysql_errno());}
    $data=array();
    $i=0;
    while($row=mysql_fetch_assoc($result4))
    {        
        $q="SELECT distinct ut.tree_id, ut.tree_nickname,ut.user_tree_id FROM  user_tree_table as ut,
            trees as t,user_tree_observations as uto where  t.tree_Id=ut.tree_id and t.deleted='0' and ut.user_id != 140 and uto.user_tree_id=ut.user_tree_id and
        t.species_id='$row[species_id]'";
        $result = $dbc->readtabledata($q);
        $num_trees = mysql_num_rows($result);
        if ($num_trees>0)     
        {$data[] = array('Species' => $row['species_primary_common_name'], 'Treeno' => $num_trees);}
    }
foreach ($data as $key => $row)
    {
$Species[$key]  = $row['Species'];
$Treeno[$key] = $row['Treeno'];
    }
   
array_multisort($Treeno, SORT_DESC, $data);
   ?>
<table>
    <tr>
        <td style='width:100px;color:#000;'><h5> sl.no</h5> </td>
        <td style='width:500px;'>
           <h5> Species Name</h5>
        </td>
         <td style='width:300px;'>
           <h5>No of Trees with obervation</h5>
        </td>
    </tr>
    <?$i=0;
    foreach($data as &$ma) 
    {
        $i++; ?>
        <tr>
           <td><?echo $i;?></td>
           <td><?echo $ma['Species'];?></td>
           <td><?echo $ma['Treeno'];?></td>
        </tr>
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
    