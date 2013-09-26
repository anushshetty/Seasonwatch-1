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
 //echo $q1;
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
?>

     
<table cellpadding="0" cellspacing="0" border="0" width="500">
   <? $th_picname = $tob[$i]->species_image;?>
<tr>
    <td><b><?=$Lang->GetString("species_text")?></b> <br/> <?echo $tob[$i]->Species_common_name; ?></td>
    <td><b><?=$Lang->GetString("nearestwater_text")?></b> <br/> 
    <?
     if ($distance_from_water == "" )
         echo "-";
     else
         echo $distance_from_water;?>
    </td>
    <td><b><?=$Lang->GetString("damage_text")?></b> <br/>
        <?if ($tree_damage==0) 
        { echo "None";} 
        elseif ($tree_damage==1) 
        {echo "Some damage";} 
        else {echo "Don't know";}?>
    </td>
</tr>

<tr>
<td><b><?=$Lang->GetString("height_text")?></b> <br/> 
    <?
     if ($tree_height == "" )
         echo "-";
     else
         echo $tree_height;?>
       </td>
<td><b><?=$Lang->GetString("slope_text")?></b> <br/>
      <?
     if ($degree_of_slope == "" )
         echo "-";
     else
         echo $degree_of_slope;?></td>
<td> <b><?=$Lang->GetString("fertilized_text")?></b> <br/>
    <?
     if ($is_fertilised == 0 )
         echo "No";
     elseif($is_fertilised == 1)
         echo "Yes";
     elseif($is_fertilised==-1)
         echo "Don't Know";?>
</td>
</tr>

<tr>
<td><b><?=$Lang->GetString("girth_text")?></b> <br/>  <?
     if ($tree_girth == "" )
         echo "-";
     else
         echo $tree_girth;?> </td>
<td><b><?=$Lang->GetString("aspect_text")?></b> <br/> 
     <? if ($aspect == "" )
         echo "-";
     else
         echo $aspect;?></td>
<td><b><?=$Lang->GetString("watered_text")?></b><br/>
<?
     if ($is_watered == 0 )
         echo "No";
     elseif($is_watered==1)
         echo "Yes";
     elseif ($is_fertilised==-1)
         echo "Don't Know"?></td>
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
//$th_picname = str_replace("_th.png",".jpg",$th_picname);
                                      
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


     