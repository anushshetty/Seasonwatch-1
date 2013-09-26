<?php 
/* This page will be involved when user clicks on Edit observation link of the add observation form.
 * This will display all the information of the observations found for respective tree.User can change the 
 * observations.
*/
    ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    include 'includes/main_includes.php';
    include_once("includes/Tree.php");
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    $page_limit = 4; 
   
$msg="";
?>

<a href = "javascript:void(0)" onclick = "window.location.reload(true);"><img src="images/closeone.png" alt="close" align="right"/></a>
    <div class="DashBosrdcontainer_edit_opbservations_lightbox">
            <?if (isset($_POST['treeid']))
            {$treeid     = $_POST['treeid'];
            
            }
          if (isset($_POST['save']) )
          {
              //update observation 
             $treeid     = $_POST['treeid'];
            for($i=0;$i<=3;$i++)
            {
             //check for data editing
             $editedrow="editrow".$i;
             $gotedited=($_POST[$editedrow]); 
             if ($gotedited==1)
             {
             
            //ObserID
            $obID="ObserID".$i;
            $obserID=($_POST[$obID]); 
            //get the date 
            //echo $obserID;
            $eobdate="eobdate".$i;
            $alteobdate=($_POST[$eobdate]);  
            //echo $date;
            //get the radio button values
            $freshleave="efreshleave".$i;
            $freshleavedata= ($_POST[$freshleave]); 
            //echo $freshleavedata;
            if ($freshleavedata==0){$is_leaf_fresh=0;$freshleaf_count=0;}
            elseif($freshleavedata==1){$is_leaf_fresh=1;$freshleaf_count=1;}
            elseif($freshleavedata==2){$is_leaf_fresh=1;$freshleaf_count=2;}
            elseif($freshleavedata==-1){$is_leaf_fresh=-1;$freshleaf_count=-1;}
           // echo $is_leaf_fresh;
            //echo $freshleaf_count;
            //matureleaves
            $matureleave="ematureleave".$i;
            $matureleavedata= ($_POST[$matureleave]); 
            //echo $matureleave;
            if ($matureleavedata==0){$is_leaf_mature=0;$matureleaf_count=0;}
            elseif($matureleavedata==1){$is_leaf_mature=1;$matureleaf_count=1;}
            elseif($matureleavedata==2){$is_leaf_mature=1;$matureleaf_count=2;}
            elseif($matureleavedata==-1){$is_leaf_mature=-1;$matureleaf_count=-1;}
            //closedbuds
            $closebud="cbud".$i;
            $closebuddata= ($_POST[$closebud]); 
            //echo $closebud;
            if ($closebuddata==0){$is_flower_bud=0;$bud_count=0;}
            elseif($closebuddata==1){$is_flower_bud=1;$bud_count=1;}
            elseif($closebuddata==2){$is_flower_bud=1;$bud_count=2;}
            elseif($closebuddata==-1){$is_flower_bud=-1;$bud_count=-1;}
            //openbuds
            $openbuds="obud".$i;
            $openbudsdata= ($_POST[$openbuds]); 
            //echo $openbuds;
            if ($openbudsdata==0){$is_flower_open=0;$open_flower_count=0;}
            elseif($openbudsdata==1){$is_flower_open=1;$open_flower_count=1;}
            elseif($openbudsdata==2){$is_flower_open=1;$open_flower_count=2;}
            elseif($openbudsdata==-1){$is_flower_open=-1;$open_flower_count=-1;}
            //unripe
            $unripe="unripe".$i;
            $unripedata= ($_POST[$unripe]); 
            //echo $unripe;
            if ($unripedata==0){$is_fruit_unripe=0;$fruit_unripe_count=0;}
            elseif($unripedata==1){$is_fruit_unripe=1;$fruit_unripe_count=1;}
            elseif($unripedata==2){$is_fruit_unripe=1;$fruit_unripe_count=2;}
            elseif($unripedata==-1){$is_fruit_unripe=-1;$fruit_unripe_count=-1;}
            //ripe
            $ripe="ripe".$i;
            $ripedata= ($_POST[$ripe]); 
            //echo $ripe;
            if ($ripedata==0){$is_fruit_ripe=0;$fruit_ripe_count=0;}
            elseif($ripedata==1){$is_fruit_ripe=1;$fruit_ripe_count=1;}
            elseif($ripedata==2){$is_fruit_ripe=1;$fruit_ripe_count=2;}
            elseif($ripedata==-1){$is_fruit_ripe=-1;$fruit_ripe_count=-1;}
            //
            //get the caterpillardata
           $caterpillar="leaf_caterpillar".$i;
           $cat=($_POST[$caterpillar]);  
           //echo $cat;
           $but="flower_butterfly".$i;
           $flower_butterfly=($_POST[$but]); 
           //echo $flower_butterfly;
           $bee="flower_bee".$i;
           $flowerbee=($_POST[$bee]);
           //echo $flowerbee;
           $monkey="fruit_monkey".$i;
           $fruitmonkey=($_POST[$monkey]);
           //echo $fruitmonkey;
           $bird="fruit_bird".$i;
           $fruitbird=($_POST[$bird]); 
          // echo $fruitbird;
           //echo "</br>";
           //get the radio button value 
            $sql1 = "UPDATE user_tree_observations SET  
            `date`='$alteobdate', 
            `is_leaf_fresh`= '$is_leaf_fresh',
            `freshleaf_count`='$freshleaf_count',
            `is_leaf_mature`= '$is_leaf_mature',
            `matureleaf_count`='$matureleaf_count',
            `is_flower_bud`= '$is_flower_bud', 
            `bud_count`='$bud_count',
            `is_fruit_unripe`= '$is_fruit_unripe',
            `fruit_unripe_count`='$fruit_unripe_count',
            `is_fruit_ripe`= '$is_fruit_ripe', 
            `fruit_ripe_count`='$fruit_ripe_count',
            `is_flower_open`= '$is_flower_open', 
            `open_flower_count`= '$open_flower_count',
            `leaf_caterpillar`='$cat',
            `flower_butterfly`='$flower_butterfly',
            `flower_bee`='$flowerbee',
            `fruit_bird`='$fruitbird',
            `fruit_monkey`='$fruitmonkey',
            `user_id`='$_SESSION[userid]'
              WHERE observation_id= '$obserID'";  
             mysql_query($sql1);
             $msg="Observation edited sucessfully.";
             $sql = mysql_query("UPDATE user_tree_table SET `last_observation_date`=GREATEST('$alteobdate',`last_observation_date`) WHERE user_tree_id='$treeid'");
             
             }
            }
          }
         
            if (!isset($_POST['page']) )
{//ASSUMING page no starts with 1
  $start=0; 
  $refreshstatus=0;
  $scrn_index=1;
  $scrn_begin=0;
  $scrn_end=0;
  $last_data=0;
  $page="1";
  $TreeInfoobj = new Tree;
  $treeInfo= $TreeInfoobj->viewTreeinfo($dbc, $treeid);
  $query2="SELECT *  FROM  `user_tree_observations` WHERE  `user_tree_id` = '$treeInfo[6]' and user_id='$_SESSION[userid]' and deleted='0' ORDER BY  `user_tree_observations`.`date` DESC ";
 
  $rs_total_pending = mysql_query($query2);
  $usertreeid= $treeInfo[6];
  $noObservations = mysql_num_rows($rs_total_pending); 
  $treename=$treeInfo[0];
$FileString;
$data= array(); //to store all the data 
$i=1;
$query2="SELECT *  FROM  `user_tree_observations` WHERE  `user_tree_id` = '$treeInfo[6]' and user_id='$_SESSION[userid]' and deleted='0' ORDER BY  `user_tree_observations`.`date` DESC limit $start,$page_limit";

  $rs_total_pending = mysql_query($query2);
//to store all observation data & retirve it according to scr_begin & scr_end
while ($sql1_row=mysql_fetch_array($rs_total_pending))
{
     $FileString=$sql1_row['observation_id']." |".$sql1_row['date']."|".$sql1_row['freshleaf_count']."|".$sql1_row['matureleaf_count']."|"
        .$sql1_row['bud_count']." |".$sql1_row['open_flower_count']."|".$sql1_row['fruit_unripe_count']."|".$sql1_row['fruit_ripe_count']."|"
        .$sql1_row['leaf_caterpillar']."|".$sql1_row['flower_butterfly']."|".$sql1_row['flower_bee']."|".$sql1_row['fruit_monkey']."|"
        .$sql1_row['fruit_bird']."|";
    $FileString=$FileString.",";
    $data[$i]=$FileString;
    $i++;
}
  $total_pages = ceil($noObservations/$page_limit);
  $scrn_end = $page_limit;
 
}
else
{ 
    $start = ($_POST['page'] - 1) * $page_limit; 
    $page     = $_POST['page'];
    
    $treename = $_POST['treename'];
    $noObservations = $_POST['noObservations'];
    $usertreeid = $_POST['usertreeid'];
    $total_pages= $_POST['total_pages'];
    $scrn_begin = $start;
    $scrn_end   =  $page_limit;
  
  $query2="SELECT *  FROM  `user_tree_observations` WHERE  `user_tree_id` = '$usertreeid' and user_id='$_SESSION[userid]' and deleted='0' ORDER BY  `user_tree_observations`.`date` DESC limit $start,$page_limit ";

  $rs_total_pending = mysql_query($query2);
  $i=1;
//to store all observation data & retirve it according to scr_begin & scr_end
while ($sql1_row=mysql_fetch_array($rs_total_pending))
{
     $FileString=$sql1_row['observation_id']." |".$sql1_row['date']."|".$sql1_row['freshleaf_count']."|".$sql1_row['matureleaf_count']."|"
        .$sql1_row['bud_count']." |".$sql1_row['open_flower_count']."|".$sql1_row['fruit_unripe_count']."|".$sql1_row['fruit_ripe_count']."|"
        .$sql1_row['leaf_caterpillar']."|".$sql1_row['flower_butterfly']."|".$sql1_row['flower_bee']."|".$sql1_row['fruit_monkey']."|"
        .$sql1_row['fruit_bird']."|";
    $FileString=$FileString.",";
    $data[$i]=$FileString;
    $i++;
}
}
?>
        <input type="hidden" id="treename" value="<?echo $treename?>">
        <h3>Edit Past Observations of <?echo htmlspecialchars($treename)?></h3>
        <form name="EditObservation" id="EditObservation" method="POST" action="" >
            <span class="edit_success"> <? echo $msg;?></span>
        <div class="opbservations_main_table">
             <div class="observations_datetable">
                 <input type="hidden" name="editstatus" value="0" id="editstatus"/>
                      
                       <div class="observations_datetable">
                            <table cellpadding="0" cellspacing="0"  >
                                <tr>
                                    <td width="160" height="13" align="left">Observed on</td>
                                    <? $z=0;
                                    foreach ($data as &$value){
                                        $ObID=GetOBID($value);
                                       $ObDate=GetdateFromString($value);
                                    ?>
                                     <input type="hidden"  name="ObserID<?echo $z?>" id="ObserID<?echo $z?>" value="<?echo $ObID?>" />
                                     <td width="150" height="13" align="left"><input type="text"  class="editobdateField" name="eobdate<?echo $z;?>" id="eobdate<?echo $z?>" value="<?echo $ObDate;?>"  title="Please enter observation date in yyyy-mm-dd format."  onchange="Changeddate(<?echo $z?>,<?echo $usertreeid?>);"   /></td>
                                    <?$z++;}?>
                                </tr>
                            </table>
                       </div>
                 
             </div>
        <div class="opbservations_table">
            <!-- table to display the observation date from scr_begin to ecr_end-->
                 
                <!-- start table_row_holder -->
                <div class="table_row_holder">
                    <div class="opbservations_table_box">
                        <h2>LEAVES</h2>
                        <p>Fresh</p>
                        <p>Mature</p>
                    </div>
                </div>
                  <? //for fresh leaves
                  $y=0;
                foreach ($data as &$value){
                     $str=$value;
                     $freshleaves=intval(GetFromString($str,2));
                    ?>
                <div class="opbservations_table_box_2">
                     <table cellpadding="0" cellspacing="0" border="0" width="110">
                                <tr>
                                    <td width="22" height="13" align="center">
                                        <img src="images/ed_icon_none.png" alt="" title="None" />
                                    </td>
                                    <td width="22" align="center">
                                       <img src="images/ed_icon_leaf_mature_few.png" title="Few" />
                                    </td>
                                    <td width="22" align="center">
                                       <img src="images/ed_icon_leaf_mature_many.png" title="Many" />
                                    </td>
                                    <td width="22" align="center">
 						<img src="images/ed_icon_dontknow.png"  title="Don't Know"/>
					</td>
                                </tr>
                                 <tr>
                                    <td width="22" align="center">
                                    <input id="efreshleave<?echo $y;?>" name="efreshleave<?echo $y;?>"  type="radio" <? if ($freshleaves=="0" ) echo "checked=checked"; ?> value="0"  onclick="dataedited(<?echo $y?>)"/></div>
                                    </td>
                                    <td width="22" align="center"><input id="efreshleave<?echo $y;?>" name="efreshleave<?echo $y;?>"   type="radio" <? if ($freshleaves=="1" ) echo "checked=checked"; ?> value="1" onclick="dataedited(<?echo $y?>)" /></td>
                                    <td width="22" align="center"><input id="efreshleave<?echo $y;?>" name="efreshleave<?echo $y;?>"  type="radio" <? if ($freshleaves=="2" ) echo "checked=checked"; ?>  value="2" onclick="dataedited(<?echo $y?>)"/></td>
                                    <td width="22" align="center"><input id="efreshleave<?echo $y;?>" name="efreshleave<?echo $y;?>"   type="radio"  <? if ($freshleaves=="-1" ) echo "checked=checked"; ?> value="-1" onclick="dataedited(<?echo $y?>)" /></td>
                                </tr>
                               <tr><td height="20">&nbsp;</td></tr>
                                <tr>
                                    <?$matureleaves=intval(GetFromString($str,3));?>
                                    <td width="22" align="center"><input id="ematureleave<?echo $y;?>" name="ematureleave<?echo $y;?>"   type="radio" <? if ($matureleaves=='0' ) echo "checked=checked"; ?> value="0"  onclick="dataedited(<?echo $y?>)"/></td>
                                    <td width="22" align="center"><input id="ematureleave<?echo $y;?>" name="ematureleave<?echo $y;?>"   type="radio"  <? if ($matureleaves=='1' ) echo "checked=checked"; ?> value="1"  onclick="dataedited(<?echo $y?>)"/></td>
                                    <td width="22" align="center"><input id="ematureleave<?echo $y;?>" name="ematureleave<?echo $y;?>"   type="radio" <? if ($matureleaves=='2' ) echo "checked=checked"; ?>  value="2"  onclick="dataedited(<?echo $y?>)"/></td>
                                    <td width="22" align="center"><input id="ematureleave<?echo $y;?>" name="ematureleave<?echo $y;?>"  type="radio"  <? if ($matureleaves=='-1' ) echo "checked=checked"; ?> value="-1"  onclick="dataedited(<?echo $y?>)"/></td>
                                </tr>

                      </table>
                </div>
                <? $y++;}?>
                <div class="clearBoth"></div>
                <!-- end table_row_holder -->
                <!-- start table_row_holder -->
                <div class="table_row_holder">
                <div class="opbservations_table_box">
                    <h2>FLOWERS</h2>
                    <p>Bud</p>
                    <p>Open</p>
                 </div>
                     <? //for flowers
                     $x=0;
                 foreach ($data as &$value){?>
                <div class="opbservations_table_box_2">
                     <table cellpadding="0" cellspacing="0" border="0" width="110">
                       <tr>
                            <td width="22" height="13" align="center">
                                <img src="images/ed_icon_none.png" alt="" title="None"/>
                            </td>
                            <td width="22" align="center">
					<img src="images/ed_icon_flower_open_few.png" alt=""  title="Few"/>
                               
                            </td>
                            <td width="22" align="center">
                                 <img src="images/ed_icon_flower_open_many.png" alt=""  title="Many"/>
                            </td>
                            <td width="22" align="center">
 					<img src="images/ed_icon_dontknow.png" alt=""  title="Don't Know"/>
				</td>
                        </tr>
                        <tr>
                            <?$str=$value;
                            // echo $str ;
                              $closebuds=intval(GetFromString($str,4));
                              
                              //echo $closebuds;?>
                              
                            <td width="22" align="center"><input id="cbud<?echo $x;?>" name="cbud<?echo $x;?>" name="flower<?echo $x;?>" type="radio" <? if ($closebuds=='0' ) echo "checked=checked"; ?>  value="0" onclick="dataedited()" /></td>
                            <td width="22" align="center"><input id="cbud<?echo $x;?>" name="cbud<?echo $x;?>" type="radio" <? if ($closebuds=='1' ) echo "checked=checked"; ?> value="1" onclick="dataedited()" /></td>
                            <td width="22" align="center"><input id="cbud<?echo $x;?>" name="cbud<?echo $x;?>" type="radio" <? if ($closebuds=='2' ) echo "checked=checked"; ?> value="2" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="cbud<?echo $x;?>" name="cbud<?echo $x;?>" type="radio" <? if ($closebuds=='-1' ) echo "checked=checked"; ?> value="-1" onclick="dataedited()"/></td>
                        </tr>
                        <tr><td height="20">&nbsp;</td></tr>
                        <tr>
                            <?$openbuds=intval(GetFromString($str,5));?>
                            <td width="22" align="center"><input id="obud<?echo $x;?>" name="obud<?echo $x;?>" type="radio" <? if ($openbuds=='0' ) echo "checked=checked"; ?> value="0" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="obud<?echo $x;?>" name="obud<?echo $x;?>" type="radio" <? if ($openbuds=='1' ) echo "checked=checked"; ?> value="1" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="obud<?echo $x;?>" name="obud<?echo $x;?>" type="radio" <? if ($openbuds=='2' ) echo "checked=checked"; ?> value="2" onclick="dataedited()" /></td>
                            <td width="22" align="center"><input id="obud<?echo $x;?>" name="obud<?echo $x;?>" type="radio" <? if ($openbuds=='-1' ) echo "checked=checked"; ?> value="-1" onclick="dataedited()"/></td>
                        </tr>
                    
                    </table>
                
                </div>
                
                <?$x++;}?>
                </div>
                <div class="clearBoth"></div>
                  <!-- end table_row_holder -->
                <!-- start table_row_holder -->
                <div class="table_row_holder">
                    <div class="opbservations_table_box">
                        <h2>FRUITS</h2>
                        <p>Unripe</p>
                        <p>Ripe</p>
                     </div>
                    <?//for fruits
                    $x=0;
                     foreach ($data as &$value){?>
                    <div class="opbservations_table_box_2">
                
                    <table cellpadding="0" cellspacing="0" border="0" width="110">
                    
                        <tr>
                            <td width="22" height="13" align="center">
                                <img src="images/ed_icon_none.png" alt=""  title="None" />
                            </td>
                            <td width="22" align="center">
                                <img src="images/ed_icon_fruit_ripe_few.png"  title="Few"/>
                            </td>
                            <td width="22" align="center">
                               <img src="images/ed_icon_fruit_ripe_many.png"  title="Many" />
                            </td>
                            <td width="22" align="center">
				<img src="images/ed_icon_dontknow.png" alt=""  title="Don't Know"/>
				</td>
                        </tr>
                        
                        <tr>
                            <?$str=$value;
                              $unripe=intval(GetFromString($str,6));
                              ?>
                            <td width="22" align="center"><input id="unripe<?echo $x;?>" name="unripe<?echo $x;?>" type="radio" <? if ($unripe=='0' ) echo "checked=checked"; ?> value="0" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="unripe<?echo $x;?>" name="unripe<?echo $x;?>" type="radio" <? if ($unripe=='1' ) echo "checked=checked"; ?> value="1" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="unripe<?echo $x;?>" name="unripe<?echo $x;?>" type="radio"<? if ($unripe=='2' ) echo "checked=checked"; ?> value="2" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="unripe<?echo $x;?>" name="unripe<?echo $x;?>" type="radio"<? if ($unripe=='-1' ) echo "checked=checked"; ?> value="-1" onclick="dataedited()"/></td>
                        </tr>
                        <tr><td height="20">&nbsp;</td></tr>
                        <tr>
                            <? $ripe=intval(GetFromString($str,7));?>
                            <td width="22" align="center"><input id="ripe<?echo $x;?>" name="ripe<?echo $x;?>" type="radio" <? if ($ripe=='0' ) echo "checked=checked"; ?> value="0" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="ripe<?echo $x;?>" name="ripe<?echo $x;?>" type="radio" <? if ($ripe=='1' ) echo "checked=checked"; ?> value="1" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="ripe<?echo $x;?>" name="ripe<?echo $x;?>" type="radio" <? if ($ripe=='2' ) echo "checked=checked"; ?> value="2" onclick="dataedited()"/></td>
                            <td width="22" align="center"><input id="ripe<?echo $x;?>" name="ripe<?echo $x;?>" type="radio" <? if ($ripe=='-1' ) echo "checked=checked"; ?> value="-1" onclick="dataedited()"/></td>
                        </tr>
                    
                    </table>
                
                </div>
                <?$x++;}?>
                <div class="clearBoth"></div>
            
            
            <!-- end table_row_holder -->
           
            <div class="table_row_holder">
            
                <div class="opbservations_table_box_B">
                    <h2>INSECTS/BIRDS</h2>
               
                </div>
                <?//for fruits
                $x=0;
                    foreach ($data as &$value){?>
                    <div class="opbservations_table_box_2 animalChkBox">
                
                    <table cellpadding="0" cellspacing="0" border="0" width="151">
                    
                        <tr>
                            <td width="22" height="13" align="center">
                                <img src="images/insectOne.png" alt=""  />
                            </td>
							 <td width="22" align="center">
                               <img src="images/bee.png" alt=""  width="22" />
                            </td>
                            <td width="22" align="center">
                               <img src="images/butterfly.png" alt="" width="22" />
                            </td>
                           
                            
                            <td width="22" align="center">
                                <img src="images/bird.png" alt="" width="30" />
                            </td>
							<td width="22" align="center">
                                <img src="images/squirrel.png" alt="" />
                            </td>
                        </tr>
                        
                        <tr>
                            <?$str=$value;
                              $cat=intval(GetFromString($str,8));
                              
                              //echo $cat;?>
                            <td width="22" align="center"> <input id="cat<?echo $x;?>" name="cat<?echo $x;?>"  type="checkbox" value="" <? if ($cat=='1' ) echo "checked"; ?> onclick="dataedited()"/></td>
                              <?$bee=intval(GetFromString($str,10));//echo $bee;?>
                            <td width="22" align="center"><input id="bee<?echo $x;?>" name="bee<?echo $x;?>" type="checkbox"  value="" <? if ($bee=='1' ) echo "checked"; ?> onclick="dataedited()"/></td>
                              <? $but=intval(GetFromString($str,9)); //echo $but;?>
                            <td width="22" align="center"><input id="but<?echo $x;?>" name="but<?echo $x;?>" type="checkbox"  value="" <? if ($but=='1' ) echo "checked"; ?> onclick="dataedited()"/></td>
                          
							    <?$bird=intval(GetFromString($str,12));//echo $bird;?>
                            <td width="22" align="center"><input id="bird<?echo $x;?>" name="bird<?echo $x;?>" type="checkbox"  value="" <? if ($bird=='1' ) echo "checked"; ?>  onclick="dataedited()"/></td>
							<?$monkey=intval(GetFromString($str,11));//echo $monkey;?>
                            <td width="22" align="center"><input id="monkey<?echo $x;?>" name="monkey<?echo $x;?>" type="checkbox"  value="" <? if ($monkey=='1' ) echo "checked"; ?> onclick="dataedited()"/></td>
                          
                        </tr>
                        <tr><td height="20">&nbsp;</td></tr>
                        
                    </table>
                
                </div>
                <?$x++;}?>
                
                </div>
             <div class="clearBoth"></div>
                </div>
             </div>
          
            <input type="hidden" id="page" value="<?echo $page;?>"/>
            <input type="hidden" id="etreeid"    value="<?echo $treeid;?>"/>
            <input type="hidden" id="edatano"    value="<?echo $_POST[datano];?>"/>
            <input type="hidden" id="noObservations"   value="<?echo $noObservations;?>"/>
            <input type="hidden" id="usertreeid"   value="<?echo $usertreeid;?>"/>
            <input type="hidden" id="total_pages"   value="<?echo $total_pages;?>"/>
            <input type="hidden" id="noObservations"   value="<?echo $noObservations;?>"/>
            <input type="hidden" id="editrow0"      name="editrow0" value=""/>
            <input type="hidden" id="editrow1"     name="editrow1" value=""/>
            <input type="hidden" id="editrow2"     name="editrow2" value=""/>
            <input type="hidden" id="editrow3"  name="editrow3"   value=""/>
               
               
                <input type="hidden" id="editstaus"   value=""/> 

                       <?if (((int)$page==1) &&((int)$noObservations>4))
                        {
                                                     
                            //display only next observation button?>
                             <!--<div class="next_month"><a href="#"  onclick="NextObserv(<?echo $_POST[tree_id];?>)">Next Observations</a></div>-->
                             <div class="next_month"><a href="#"  onclick="NextObservations(<?echo $page+1;?>)">Next Observations</a></div>
                        <?}
                        elseif (((int)$page>1)&& ((int)$page!=$total_pages))
                        {
                         //display next & prev?>
                            <div class="previous_month"><a href="#" onclick="NextObservations(<?echo $page-1;?>)">Previous Observations</a></div>
                            <div class="next_month"><a href="#"  onclick="NextObservations(<?echo $page+1;?>)">Next Observations</a></div>

                        <?    }
                        elseif (((int)$page==$total_pages) &&((int)$page!=1))
                        {
                        //only previous?>
                        <div class="previous_month"><a href="#" onclick="NextObservations(<?echo $page-1;?>)">Previous Observations</a></div>
                       <? }?>

            
           
            
      </div>
      
    <!-- end DashBosrdcontainer_edit_opbservations_lightbox -->
      
    <div class="editmsg">
        <span class="edit_success" style="display:none" >Observation edited successfully.</span>
        <span class="edit_error"  align="left" style="display:none"> Observation not edited Please Re-enter all data and try again.</span>
        
    </div>
    <div class="button_area">
        <div class="right_side_button">
            <div class="button_area_ok"><a href="#" onclick="UpdateObservation(<?echo  $page?>)">OK</a></div>
            <div class="button_area_cancel"><a href ="javascript:void(0)" onclick ="window.parent.location.reload();">CANCEL</a></div>
        </div>
     
    </div>     
      
</form>
       </div>
   <? //get Observation ID
   
     function GetOBID($str)
    { 
        //str = 37021 |2012-01-02|0|0|0|0||0|0|0||0|0;
        $findme   = '|';
        $pos1 = strpos($str, $findme);
        $remstr= substr($str,0,$pos1);
        return ($remstr);
    }
         ////get the date from the filestring
     function GetdateFromString($str)
    { 
        //str = 37021 |2012-01-02|0|0|0|0||0|0|0||0|0;
        $findme   = '|';
        $pos1 = strpos($str, $findme);
        $obID= substr($str,0,$pos1);
        $remstr= substr($str,$pos1+1,strlen($str));
        $pos2 = strpos($remstr, $findme);
        $remstr= substr($str,$pos1+1,$pos2);
        //echo $obID;
        return ($remstr);
        
    }
    function GetFromString($str,$endpos)
    { 
        //str = 37021 |2012-01-02|0|0|0|0||0|0|0||0|0;
        $findme   = '|';
        //echo $str;
        //echo "<br/>";
        $remstr =$str;
        for($i=1;$i<=$endpos;$i++)
        {
        $pos1 = strpos($remstr, $findme);
        $remstr= substr($remstr,$pos1+1,strlen($str));
        }   
        $pos = strpos($remstr, $findme);
        $remstr= substr($remstr,0,$pos);
        return ($remstr);
        
    }
  ?>