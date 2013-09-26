<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="clearBoth"></div>
<div id="<?echo $treeIDAr[$i],$th_picname?>" class="container_2_bottom_area">
<div class="container_2_bottom_area_left">
<?php 

// Get TreeInformatin

 $q1="SELECT tree_location_id,tree_nickname, location_type,  
                    is_fertilised, is_watered, distance_from_water, degree_of_slope, aspect, species_id
                    FROM trees, user_tree_table 
                    WHERE 
                    trees.tree_Id=user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]'
                    AND trees.tree_Id='".$tob[$i]->Tree_id."'";
 $measdetails ="SELECT  tree_height, tree_girth, tree_damage, 
                    other_notes
                    FROM tree_measurement
                    WHERE tree_measurement.user_id='$_SESSION[userid]'
                    AND tree_measurement.tree_Id='".$tob[$i]->Tree_id."'";
                    $tree_measuredetails=$dbc->readtabledata($measdetails);
                    $one_tree_measuredetail = mysql_fetch_array($tree_measuredetails);
                    //echo $measdetails;
      
 //echo $usertree;
list($tree_location_id,$tree_nickname, $location_type, $is_fertilised, $is_watered, $distance_from_water, $degree_of_slope, $aspect, $species_id) =mysql_fetch_row(mysql_query($q1));
$edittreeid= $tob[$i]->Tree_id;
list($tree_height, $tree_girth, $tree_damage, $other_notes) =mysql_fetch_row(mysql_query($measdetails));
if($tree_location_id >'0')
{
   //get the treelocation information 
    $treelocationdetailsquery ="SELECT lm.state_id,lm.city,lm.latitude,lm.longitude,lm.location_name from location_master as lm where lm.tree_location_id='$tree_location_id'";
    list($state_id, $city, $longitude, $latitude, $location_name) =mysql_fetch_row(mysql_query($treelocationdetailsquery));
    if ($state_id>'0')
     {
         //get statename
         $statename="select state from seswatch_states where state_id='$state_id'";
         list($state)=mysql_fetch_row(mysql_query($statename));
         
     }
}

?>
    
   

    <table cellpadding="0" cellspacing="0"  width="80%">
   <? $th_picname = $tob[$i]->species_image;?>
 
<tr>
    <td ><b>Species name</b> <br/> <?echo $tob[$i]->Species_common_name; ?></td>
    <td ><b>Nearest water</b> <br/> 
    <?
     if (($distance_from_water == "" )||($distance_from_water == "0" ))
         echo "-";
     else
         echo $distance_from_water;?>
    </td>
    
    <td  ><b>Damage</b> <br/>
        <?if ($tree_damage==0) 
        { echo "None";} 
        elseif ($tree_damage==1) 
        {echo "Some damage";} 
        else {echo "Don't know";}?>
    </td>
    <?if($tree_location_id >'0'){?>
    <td><b>&nbsp;Tree location name</b> <br/>&nbsp;
        <?if ($location_name=="")
        { echo "-"; }
        else{echo $location_name;}?>
    </td>
    
    <td><b>&nbsp;City</b> <br/>&nbsp;  <?if ($city=="")
        { echo "-"; }
        else{echo $city;}?></td>
    <?}?>
</tr>

<tr>
<td><b>Height (in m)</b> <br/> 
    <?
     if (($tree_height == "" )||($tree_height == "0" ))
         echo "-";
     else
         echo $tree_height;?>
       </td>
<td><b>Slope (in deg)</b> <br/>
      <?
     if (($degree_of_slope == "" )||($degree_of_slope == "0" ))
         echo "-";
     else
         echo $degree_of_slope;?></td>
<td> <b>Fertilized</b> <br/>
    <?
     if ($is_fertilised == 0 )
         echo "No";
     elseif($is_fertilised == 1)
         echo "Yes";
     elseif($is_fertilised==-1)
         echo "Don't Know";?>
</td>
<?if($tree_location_id >'0'){?>
<td><b>&nbsp;Latitude</b> <br/> &nbsp; <?if (($latitude=="")||($latitude=="0.0000000"))
        { echo "-"; }
        else{echo $latitude;}?></td>
<td><b>&nbsp;State</b> <br/> &nbsp;<?if ($state_id>'0'){echo $state;}else {echo "-";} ?></td>
    <?}?>
</tr>

<tr>
<td><b>Girth (in cm)</b> <br/>  <?
     if (($tree_girth == "" )||($tree_girth=="0"))
         echo "-";
     else
         echo $tree_girth;?> </td>
<td><b>Aspect</b> <br/> 
     <? if ($aspect == "" )
         echo "-";
     else
         echo $aspect;?></td>
<td><b>Watered</b><br/>
<?
     if ($is_watered == 0 )
         echo "No";
     elseif($is_watered==1)
         echo "Yes";
     elseif ($is_fertilised==-1)
         echo "Don't Know"?></td>
<?if($tree_location_id >'0'){?>
<td><b>&nbsp;Longitude</b> <br/>&nbsp;<?if (($longitude=="")||($longitude=="0.0000000"))
        { echo "-"; }
        else{echo $longitude;}?></td>
<td><b>&nbsp;Location type</b> <br/> &nbsp;<?if (($location_type=="")||($location_type=="undefined"))
        { echo "-"; }
        else{echo $location_type;}?></td>
<?}?>
</tr>

<tr>
    <td></td>
    <td></td>
</tr>
 
</table>
     
    </div>
<div class="container_2_bottom_area_right">
    <? //echo $tob[$i]->species_image;
//echo $tob[$i]->species_imagel;
$th_picname = str_replace("_th.png",".jpg",$th_picname);
                                      
if (file_exists($th_picname)) {?>
    <img src="<? echo $th_picname; ?>" alt="" width="200" height="181" /><br />
    <?
    } else {?>
    <img src="images/noimage.jpg" width="100" height="100"/><br />
    <?
    }?>

</div>
   
<!--<div align="right"><!--<a href = "javascript:void(0)" onclick = "document.getElementById('lightSix').style.display='none';document.getElementById('fadeOne').style.display='block';">SELECT TREE</a></div>-->
<!--<a href = "javascript:void(0)" onclick = "document.getElementById('lightSeven<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);"><img src="images/edit_tree.png" alt=""  title="Edit Tree." /></a>-->
   <!-- <a href="indivedittreeinfo.php?treeid=<? echo $tob[$i]->Tree_id; ?>&image=<?echo $tob[$i]->species_image;?>&speciesid=<?echo $tob[$i]->species_id?>"><img src="images/edit_tree.png" alt=""  title="Edit Tree." /></a>
</div>-->
<!--<div class="close"><a href="close" title="Close Tree Information."><img src="images/collapse.png"></a></div>-->
<div class="clearBoth"></div>
</div>


     