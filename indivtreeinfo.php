<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * This page display all the treeinformation
 * 
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
        <div class="treeinfo">
            <!--<h2 align="center">Tree Information</h2>-->
            <table>
                <tr>
                    <td width="175px;"><b>Species name</b></td><td>&nbsp;:&nbsp;<?echo $tob[$i]->Species_common_name; ?></td>
                </tr>
                <tr>
                    <td width="175px;"><b>Height (in m)</b></td><td>&nbsp;:&nbsp;<?
                       if (($tree_height == "" )||($tree_height == "0" ))
                           echo "-";
                       else
                           echo $tree_height;?></td>
                </tr>
                <tr>
                   <td width="175px;"><b>Girth (in cm)</b></td><td>&nbsp;:&nbsp;<?
                   if (($tree_girth == "" )||($tree_girth=="0"))
                   echo "-";
                   else
                   echo $tree_girth;?></td>
                </tr>
                <tr>
                   <td width="175px;"><b>Slope (in deg)</b></td><td>&nbsp;:&nbsp;<?
                   if (($degree_of_slope == "" )||($degree_of_slope == "0" ))
                   echo "-";
                   else
                   echo $degree_of_slope;?></td>
                </tr>
                <tr>
                    <td width="175px;"><b>Aspect</b></td><td>&nbsp;:&nbsp;<? if ($aspect == "" )
                       echo"-";
                    else
                       echo $aspect;?></td>
                </tr>
                <tr>
                    <td width="175px;"><b>Nearest water source (in m)</b></td><td>&nbsp;:&nbsp;<?if (($distance_from_water == "" )||($distance_from_water == "0" ))
                    echo "-";
                    else
                    echo $distance_from_water;?></td>
                </tr>
                <tr>
                    <td width="175px;"><b>Damage</b></td><td>&nbsp;:&nbsp;<?if ($tree_damage==0) 
                    { echo "No";} 
                    elseif ($tree_damage==1) 
                    {echo "Some damage";} 
                    else {echo "Don't know";}?></td>
                </tr>
                 <tr>
                    <td width="175px;"><b>Fertilized</b></td><td>&nbsp;:&nbsp;<?
                    if ($is_fertilised == 0 )
                    echo "No";
                    elseif($is_fertilised == 1)
                    echo "Yes";
                    elseif($is_fertilised==-1)
                    echo "Don't Know";?></td>
                </tr>
                 <tr>
                    <td width="175px;"><b>Watered</b></td><td>&nbsp;:&nbsp;<?if ($is_watered == 0 )
                    echo "No";
                    elseif($is_watered==1)
                    echo "Yes";
                    elseif ($is_watered==-1)
                    echo "Don't Know"?></td>
                    </tr>
            </table>
         </div>
         <?if($tree_location_id >'0'){?>
          <div class="locationinfo">
              <!-- <h2 align="center">Location Information</h2>-->
              <table>
                <tr>
                    <td width="150px;"><b>Tree location name</b></td><td>:&nbsp<?if ($location_name=="")
                    { echo "-"; }
                    else{echo $location_name;}?></td>
                  </tr>
                  <tr>
                     <td width="150px;"> <b>Latitude</b></td><td>:&nbsp;<?if(($latitude=="")||($latitude=="0.0000000"))
            { echo "-"; }
            else{echo $latitude;}?></td>
                  </tr>
                  <tr>
                       <td width="150px;"><b>Longitude</b></td><td>:&nbsp;<?if (($longitude=="")||($longitude=="0.0000000"))
            { echo "-"; }
            else{echo $longitude;}?>
                  </tr>
                  <tr>
                      <td width="150px;"><b>Location type</b> </td><td>:&nbsp;<?if (($location_type=="")||($location_type=="undefined"))
            { echo "-"; }
            else{echo $location_type;}?></td>
                  </tr>
                  <tr>
                    <td width="150px;"><b>City </b></td><td>:&nbsp;<?if ($city=="")
            { echo "-"; }
            else{echo $city;}?></tr>
                  <tr>

        <td width="150px;"><b>State</b> </td><td>:&nbsp;<?if ($state_id>'0'){echo $state;}else {echo "-";} ?>
        </tr>
              </table>

           </div>
         <?}?>
    </div>
    <div class="container_2_bottom_area_right">
        <? //echo $tob[$i]->species_image;
        $th_picname = $tob[$i]->species_image;
        $th_picname = str_replace("_th.png",".jpg",$th_picname);
        if (file_exists($th_picname)) {?>
        <img src="<? echo $th_picname; ?>" alt="" width="200" height="181" /><br />
        <?
        } else {?>
        <img src="images/noimage.jpg" width="100" height="100"/><br />
        <?
        }?>
    </div>
<div class="clearBoth"></div>
</div>


     