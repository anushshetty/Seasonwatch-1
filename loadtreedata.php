<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>

<?php
session_start();
if (!isset($_SESSION['userid']))
{
	header("Location: index.php");
}
include 'includes/dbcon.php';
$dbc=Dbconn::getdblink();
$treeno=  $_SESSION['NoTrees'];

$start_row = isset($_REQUEST['start'])?$_REQUEST['start']:0;
		//$start_row = 10 * (int)$start_row;
		$start_row = 5 * (int)$start_row;
		$maxrows=$start_row + 5;
		if($maxrows > $treeno)
		$maxrows=$treeno;
		$i=$start_row; 
		echo "i=".$i." max=".$maxrows;
		while ($i<$maxrows) 
        {?>

<input type="hidden" id="species_id" value="<? echo $tob1[$i]->Species_id; ?>" />
                             
               <!--  start body_content  -->
                    <div class="body_top">
                        <div class="main">
                            <div class="container">
                            <!-- Get the list of trees from the database-->
                                    <div class="flowerleftbox">
                                        <!-- Tree Image & Tree Name-->
                                        <?
                                        $tob1 = unserialize($_SESSION['tob']);
                                        print_r($tob1);
                                        $temp=$tob[$i]; 
                                        $treeIDAr[$i]=$tob1[$i]->Tree_id;
                                       echo $temp->Tree_id;
                                        $th_picname=$tob1[$i]->species_image;
   					$species_pic1 = str_replace(".jpg",".png",$th_picname);
                                        $th_picname=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
                         		
                                        if (file_exists($th_picname)) {?>
                                         <blockquote><img src="<? echo $th_picname; ?>" alt="<?echo $th_picname?>" title=""/></blockquote>
                                         <?}
                                         else
                                         {?><blockquote><img src="images/noimage.jpg" width="60" height="60" alt="No Image" title="images/noimage.jpg"/></blockquote>
                                         <?}?>
                                    
                                    <div title="<?echo ucfirst(strtolower($tob1[$i]->Tree_nickname))?>" ><strong>
                                    <? $pattern="..";
                                    $alttreenickname="";
                                    if  (strlen($tob1[$i]->Tree_nickname) > 15)
                                    //echo $_SESSION['fullname'];
                                    $alttreenickname=  rtrim(substr($tob1[$i]->Tree_nickname, 0, 15)) . $pattern; 
                                    else 
                                    $alttreenickname=$tob1[$i]->Tree_nickname;
                                    echo ucfirst(strtolower(htmlspecialchars($alttreenickname)));?></strong></div>
                                    <div title="<?echo $tob1[$i]->Species_common_name;?>"><h5>
                                    <?$malayamname = $tob1[$i]->Species_common_name;
                                    if  (strlen($malayamname) > 15)
                                    { $altcmnname=  rtrim(substr($malayamname, 0, 15)) . $pattern;} 
                                    else 
                                    {$altcmnname=$malayamname;}
                                    echo ucfirst(strtolower(htmlspecialchars($altcmnname)));?></h5></div>
                                    <div title="<?echo ucfirst(strtolower($tob1[$i]->species_scientific_name));?>"><h5><i>
                                    <?echo ucfirst(strtolower(htmlspecialchars($tob1[$i]->species_scientific_name)));?>
                                    </i></h5></div>
                                    </div>
									<?$qObcnt="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                        user_tree_id ='".$tob1[$i]->user_tree_id."' and user_id='$_SESSION[userid]' and deleted='0'";
									echo $qObcnt." ";
                                    $observationscnt=$dbc->readtabledata($qObcnt);
                                    $totalnoofobservationscnt=mysql_num_rows($observationscnt);
                                    
                                    $obsdates=array();
                                    for($p=0;$p<$observationscnt;$p++){
                                    	$obsdates[$p]=$observationscnt['date'];
                                    }
                                    
                                    
                                    $last2month=date("Y-m-d", strtotime("-2 month") ) ;
                                    //$last3month=date("Y-m-d", strtotime("-3 month") ) ;
    								$today=date("Y-m-d");
    								$nxtmonday= date('Y-m-d', strtotime('next monday'));
    								//$start_date = $last2month; 
    								//$start_date = $last3month;
    								$start_date = date('Y-m-d',strtotime('last monday',strtotime($mondays[0])));
    								$end_date   = $nxtmonday; 
                                                                
                                                                //echo $end_date;
                                                               
                                    $qOb="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                        user_tree_id ='".$tob1[$i]->user_tree_id."' and user_id='$_SESSION[userid]' and deleted='0' and date > '".$start_date . "' AND date <= '". $end_date ."' ORDER BY date ASC";
                                       
                                        $observations=$dbc->readtabledata($qOb);
                                        $noofobsforlasttwomonths=mysql_num_rows($observations);
                                        
                                        $obsdatesreq=Array();
                                        while($r=mysql_fetch_array($observations)){
                                        	array_push($obsdatesreq,$r['date']);
                                        }
                                        
                                        if($noofobsforlasttwomonths>0){
                                        	mysql_data_seek($observations,0);}
                                    
                                       //echo $qOb." ".$noofobsforlasttwomonths;
                                    
                                    ?>
                                   <!-- start Graph Section-->
                                    <div class="middlebox">
                                       <? if ($noofobsforlasttwomonths>0){
                                            $n=0;$fetchnext=0;$p=0;
                                            $oneobservation=mysql_fetch_array($observations);
                                         for($m=0;$m<8;$m++){
                                         $observation[$m]=new Observation();
            if($n>=$noofobsforlasttwomonths){
             while($m<8){
              
             $observation[$m]->exists=0;
             $m++;} 
             break;
                 }
            
                 $end_dt = $mondays[$m];
                 if ($m==0)
                 {
                  $start_dt=date('Y-m-d',strtotime('last monday',strtotime($mondays[0])));
                 	//$start_dt=date('Y-m-d',strtotime('last monday',strtotime($last3month)));
                 }
                 else
                 {
                  $start_dt= $mondays[$m-1];
                 }
                 
               //echo " ".$oneobservation['date']." ".$start_dt." ".$end_dt;
             if($oneobservation['date'] >= $start_dt && $oneobservation['date'] < $end_dt)
            {            
             
            	while($p < ($noofobsforlasttwomonths-1) && $obsdatesreq[$p+1] >= $start_dt && $obsdatesreq[$p+1] < $end_dt){
            		//echo "curr date=".$obsdatesreq[$p]."next date".$obsdatesreq[$p+1];
            		$oneobservation=mysql_fetch_array($observations);$p++;
            	
            	}$p++;
            	
            	
             $observation[$m]->exists=1;
            $observation[$m]->observation_id=$oneobservation['observation_id'];
            $observation[$m]->date=$oneobservation['date'];
            $observation[$m]->freshleaf_count=$oneobservation['freshleaf_count'];
            $observation[$m]->matureleaf_count=$oneobservation['matureleaf_count'];
            $observation[$m]->bud_count=$oneobservation['bud_count'];
            $observation[$m]->open_flower_count=$oneobservation['open_flower_count'];
            $observation[$m]->fruit_ripe_count=$oneobservation['fruit_ripe_count'];
            $observation[$m]->fruit_unripe_count=$oneobservation['fruit_unripe_count'];
                           
            $oneobservation=mysql_fetch_array($observations);
             $n++;$fetchnext=1;
            }
            else{
             
            $observation[$m]->exists=0; 
            $fetchnext=0;
                                         }}?>
                                         
                                       
                                    <table width="673" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td>
                                    <table width="673" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #d1d1d1;">
                                    <tr>
                                    <td style="width:92px;height:51px;vertical-align:middle;text-align:center;color:#000080;font-size:18px;"><blockquote style="width:92px;">LEAVES</blockquote></td>
                                    <td style="height:51px;vertical-align:middle;padding:0px 15px; font-size:15px;  text-align:right;">
                                    <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td><blockquote style="width:60px;">Fresh</blockquote></td>
                                    </tr>
                                    <tr>
                                    <td><blockquote style="width:60px;">Mature</blockquote></td>
                                    </tr>
                                    </table>
                                    </td>
                                     <!-- Leaves-->
                                    <?for ($k =0; $k <8; $k++) 
                                    {
                                        if($observation[$k]->exists)
                                        {  
                                            ?>
                                            <td style="width:71px;height:51px;vertical-align:middle;">
                                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                <td>
                                                <? 
                                                  
                                                switch ($observation[$k]->freshleaf_count)
                                                {
                                                    case "0":
                                                    ?>
                                                    <img src="images/icon_none.png" title="None">
                                                    <? break;
                                                    case "1":?>
                                                    <img src="images/icon_fresh_few.png" title="Few">
                                                    <?break;
                                                    case "2":?>
                                                    <img src="images/icon_fresh_many.png" title="Many">
                                                    <?break;
                                                    case "-1":?>
                                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                                    <?break;
                                                }    ?>    
                                                </td>
                                                </tr>
                                                <tr>
                                                <td>
                                                <?   switch ($observation[$k]->matureleaf_count)
                                                {
                                                    case "0":
                                                    ?>
                                                    <img src="images/icon_none.png" title="None">
                                                    <? break;
                                                    case "1":?>
                                                    <img src="images/icon_mature_few.png" title="Few">
                                                    <?break;
                                                    case "2":?>
                                                    <img src="images/icon_mature_many.png" title="Many">
                                                    <?break;
                                                    case "-1":?>
                                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                                    <?break;
                                                } ?> 
                                                </td>
                                                </tr>
                                            </table>
                                            </td>
                                            <?}
                                           else
                                    
                                        {?>
                                            <td style="width:71px;height:51px;vertical-align:middle;">
                                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                            <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                            </tr>
                                            <tr>
                                            <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                            </tr>
                                            </table>
                                            </td>
                                        <?}
                                    }?>
                                    </tr>
                                    </table>
                            <!-- Flowers-->
                            <table width="673" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #d1d1d1;">
                            <tr>
                            <td style="width:92px;height:51px;vertical-align:middle;text-align:center;color:#000080;font-size:18px;"><blockquote style="width:92px;">FLOWERS</blockquote></td>
                            <td style="height:51px;vertical-align:middle;padding:0px 15px; font-size:15px;  text-align:right;">
                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                            <td><blockquote style="width:60px;">Bud</blockquote></td>
                            </tr>
                            <tr>
                            <td><blockquote style="width:60px;">Open</blockquote></td>
                            </tr>
                            </table>
                            </td>
                            <?for ($k =0; $k <count($mondays); $k++) 
                            {
                                                                
                                 if($observation[$k]->exists)
                                { 
                                ?>
                                <td style="width:71px;height:51px;vertical-align:middle;">
                                <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td>
                                <? 
                                  switch ($observation[$k]->bud_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_flower_bud_few.png" title="Few">
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_flower_bud_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know">
                                <?} ?>    
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <?   switch ($observation[$k]->open_flower_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_flower_open_few.png" title="Few"> 
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_flower_open_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                    <?break;
                                } ?> 
                                </td>
                                </tr>
                                </table>
                                </td>
                            <? }
                           else
                                {?>
                                    <td style="width:71px;height:51px;vertical-align:middle;">
                                    <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    </table>
                                    </td>
                                <?}
                            }?>
                            </tr>
                             </table> 
                            
                            <table width="673" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #d1d1d1;">
                            <tr>
                            <td style="width:92px;height:51px;vertical-align:middle;text-align:center;color:#000080;font-size:18px;"><blockquote style="width:92px;">FRUIT</blockquote></td>
                            <td style="height:51px;vertical-align:middle;padding:0px 15px; font-size:15px;  text-align:right;">
                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                            <td><blockquote style="width:60px;">Unripe</blockquote></td>
                            </tr>
                            <tr>
                            <td><blockquote style="width:60px;">Ripe</blockquote></td>
                            </tr>
                            </table>
                            </td>
                            <?for ($k =0; $k <8; $k++) 
                            {
                                                               
                                 if ($observation[$k]->exists)
                                {  
                                ?>
                                <td style="width:71px;height:51px;vertical-align:middle;">
                                <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td>
                                <?//unripe  
                                switch ($observation[$k]->fruit_unripe_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_fruit_unripe_few.png" title="Few">
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_fruit_unripe_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know">
                                    <?break;
                                }?>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <?
                                switch ($observation[$k]->fruit_ripe_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_fruit_ripe_few.png" title="Few">
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_fruit_ripe_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know">
                                    <?break;
                                    ?>                                  
                                <? }?>
                                </td>
                                </tr>
                                </table>
                                </td>
                                <?}
                               else
                                {?>
                                    <td style="width:71px;height:51px;vertical-align:middle;">
                                    <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    </table>
                                    </td>
                                <?}
                                
                                }?>
                            </tr>
                            </table>  
                            <!-- Date display-->
                            <table width="673" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                            <td style="height:51px;vertical-align:middle;text-align:center;color:#666666;font-size:14px;"><blockquote style="width:92px;">Week starting</blockquote></td>
                            <td style="height:51px;vertical-align:middle;padding:0px 15px;"><blockquote style="width:60px;">&nbsp;</blockquote></td>
                                <?for ($k =0; $k <8; $k++) 
                                {
                                $end_date = date('Y-m-d',strtotime($mondays[$k]));
                                if ($k==0)
                                {
                                	$lastmonday=strtotime('last monday', strtotime($end_date));
                                    $start_date=date('Y-m-d',$lastmonday);
                                
                                }
                                else
                                {
                                $start_date= date('Y-m-d',strtotime($mondays[$k-1])); 
                                }
								$monthdateformat = date('j-M',strtotime($mondays[$k]));
                               ?>
								<td style="width:71px;height:51px;vertical-align:middle;"><blockquote style="width:71px;text-align:center;color:#666666; font-size:13px;"><?echo $monthdateformat;?></blockquote></td>
								<?}?>   
                                </tr>
                                </table>
                                
                                </tr>
                                </table>
                                        <?}else{?>
                                        <div class="link">No observations exist for this tree. Please <a href = "javascript:void(0)" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);">Add Observation.</a></div>
                                        <?}?>
                                </div>       <!-- middlebox div close-->                          
                                    <!-- end Graph Section-->
                                    
                                     <div class="add_tree_icon">
                                        <ul>
                                               <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);"><img src="images/add_observation.png" alt=""  title="Add Observation." /></a></li>
<div id="lightOne<?echo $i;?>" class="white_contentOne"><? include ("addobservation.php"); ?></div>
                                                 
                                                
                                                <li class="popup"><a href="<?echo $treeIDAr[$i],$th_picname?>" title="Tree information" id="pop<?echo $i;?>"><img src="images/expand.png" alt=""/></a></li>
  <!--<li class="infoclose"><a href="" title="Close Tree Information."><img src="images/collapse.png"></a></li>-->
                                                <!-- li><a href = "javascript:void(0)" id = '<?php echo $tob1[$i]->Tree_id; ?>' onclick = "document.getElementById('tree_id').value=jQuery(this).attr('id');document.getElementById('lightSix').style.display='none';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);edit_tree_load('edittree',<?echo $treeIDAr[$i]?>,<?echo $i?>);"><img src="images/edit_tree.png" alt=""  width="15px" height="15px" title="Edittree." /></a></li-->
                                                <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightSix<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);"><img src="images/edit_tree.png" alt=""  width="15px" height="15px" title="Edittree." /></a></li>
                                                
                                                <div id="lightSix<?echo $i;?>" class="white_contentThree"><?php if($_SESSION['usercategory'] == 'individual') {include ("indivedittreetest.php");}  elseif ($_SESSION['usercategory'] =='school-seed')
        {
             include ("seededittree.php");
        }else {include ("generaledittreetest.php");} ?>
                                                </div>
                                                              <?if ($totalnoofobservationscnt>0){?>
                                                <li><a href="javascript:void(0)" title="Edit Observations" onclick="edit_observation(<?echo $i?>,<?echo $treeIDAr[$i]?>);"/><img src="images/pencil.png" alt="no"></img></a></li>  
                                                <?}?>
                                                
                                        </ul>
                                    </div>
                                <?php include ("indivtreeinfo.php"); ?>
                                    
                                </div> <!-- Div of container body-->
                        </div> <!-- Div of Main body -->
                    </div>  <!-- Div of Body top-->

 <?
                    $i++;
                 }		

?>