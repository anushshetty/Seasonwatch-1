<?php
session_start();
   $page_title=":: Add Tree ::";
   include("main_includes.php");
   include("../includes/dbc.php");
   include("../procedure.php");
   //include("trackspecies.php");
   //$GLOBALS["message"]="";

$tree_id = $_REQUEST['treeid'];

if ($tree_id >0)
{
	$sql="select * from trees where tree_id='$tree_id'";
	$rs=mysql_query($sql);
    $row=mysql_fetch_array($rs);

	$tree_name = $row[tree_desc];
	$species = $row[species_id];
	$location = $row[tree_location_id];
	$is_fertilised = $row[is_fertilised];
	$is_watered= $row[is_watered];
	$location_type= $row[location_type];
	$degree_of_slope= $row[degree_of_slope];
	$distance_from_water= $row[distance_from_water];
	$aspect= $row[aspect];
}

if($_REQUEST['act']=='add')
{
	$tree_name = $_REQUEST['tree_name'];
	$species = $_REQUEST['species'];
	$location = $_REQUEST['location'];
	$is_fertilised = $_REQUEST['is_fertilised'];
	$is_watered= $_REQUEST['is_watered'];
	$location_type= $_REQUEST['location_type'];
	$degree_of_slope= $_REQUEST['degree_of_slope'];
	$distance_from_water= $_REQUEST['distance_from_water'];
	$aspect= $_REQUEST['aspect'];

  //echo $event_name;
  //echo $EventId;
  //echo ;
  //$tree_id = $_REQUEST['treeid']; 
  
  $ret=addedit_tree($tree_id,$tree_name,$species,$location,$is_fertilised,$is_watered,$is_watered,$location_type,$degree_of_slope,$distance_from_water,$aspect);

  if($ret=='0')
  {
	 $tree_name= "";
	 $species= "";
	 $location= "";
	 $is_fertilised= "";
	 $is_watered= "";
	 $is_watered= "";
	 $location_type= "";
	 $degree_of_slope= "";
	 $distance_from_water= "";
	 $aspect= "";
  }
}

?>
<html>
<head>
<meta content="alert, confirm, prompt, demo" name="keywords"/>
<title>Add Tree Page</title>
<!--Script for redirecting to main page within FRAME-->
<script type="text/javascript">
function redirectout()
{
	top.location.replace( "listtree.php" );
	//window.location = "listtree.php"
}
</script>
</head>

<body>

<div class='container first_image'>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>

<tr>
<td><h2>Please use the form below to <?php if($tree_id > 0) { ?> update tree data. <? } else
{ ?> enter new tree data. <?}?></h2></td>
</tr>

<tr>
<td>
<form action="addedittree.php?act=add" name="addedittree" method="post">


<table width=600>
</tr>
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 
<!--
<input type="hidden" name="tree_id" value="
$tree_id;?>

" /> -->

<tr>
<td align=right>Tree name</td>
<td><input type="text" name="tree_name" value="<?=$tree_name;?>" style="width:200px;">
</td>
</tr>

<!--<tr>
<td align=right>Tree Description:</td>
<td><textarea name="tree_description" cols="22" rows="5"  >
</textarea><br> </td>
</tr> -->

<tr>
<td align=right>Species name:</td>
<td >
<select name='species' style="width:200px;">
        <option value="">--Choose--</option>
        <?php
		$specieslist = "SELECT * FROM species_master ORDER BY species_primary_common_name";
		$result = mysql_query($specieslist);
            while($row=mysql_fetch_array($result)){
                $species_id = $row[species_id];
                $species_primary_common_name = $row[species_primary_common_name];
			
        ?>

        <option <?php if($species==$species_id){ ?> selected="selected" <?php }?> value='<?php echo $species_id; ?>' >
        <?php echo $species_primary_common_name; ?>
        </option>
        <?php } ?>
    </select>

</td>
</tr> 

<tr>
<td align=right>Tree location:</td>
<td >

<select name='location' style="width:200px;">
        <option value="">--Choose--</option>
        <?php
            $locationlist = "SELECT * FROM location_master ORDER BY location_name";
			$result = mysql_query($locationlist);
            while($row=mysql_fetch_array($result)){
                $tree_location_id = $row[tree_location_id];
                $location_name = $row[location_name];
			
        ?>

        <option <?php if($location==$tree_location_id){ ?> selected="selected" <?php }?> value='<?php echo $tree_location_id; ?>' >
        <?php echo $location_name; ?>
        </option>
        <?php } ?>
    </select>
</td>
</tr>

<tr>
<td align=right>Fertilised?</td>
<td>
<Input type = 'Radio' Name ='is_fertilised' value= '1' <?php if($is_fertilised == '1') { ?> checked="checked" <? } ?> checked="checked">Yes
<Input type = 'Radio' Name ='is_fertilised' value= '0' <?php if($is_fertilised == '0') { ?> checked="checked" <? } ?> >No <br> 
</td>
</tr>

<tr>
<td align=right>Watered?</td>
<td>
<Input type = 'Radio' Name ='is_watered' value= '1' <?php if($is_watered == '1') { ?> checked="checked" <? } ?> checked="checked">Yes
<Input type = 'Radio' Name ='is_watered' value= '0' <?php if($is_watered == '0') { ?> checked="checked" <? } ?> >No <br> 
</td>
</tr>

<tr>
<td align=right>Location type:</td>
<td>
<select id="location_type" name="location_type" value="<?=$location_type;?>" style="width:200px;">
<option name="Choose" value="0">-- Choose --</option>
<option name="Garden/Park" value="Garden/Park" <?php if($location_type == 'Garden/Park') { ?> selected="selected" <? } ?>>Garden/Park</option>
<option name="Avenue" value="Avenue" <?php if($location_type == 'Avenue') { ?> selected="selected" <? } ?>>Avenue</option>
<option name="Forest" value="Forest" <?php if($location_type == 'Forest') { ?> selected="selected" <? } ?>>Forest</option>
<option name="Campus" value="Campus"  <?php if($location_type == 'Campus') { ?> selected="selected" <? } ?>>Campus</option>
<option name="Marsh" value="Marsh" <?php if($location_type == 'Marsh') { ?> selected="selected" <? } ?>>Marsh</option>
<option name="Grassland" value="Grassland" <?php if($location_type == 'Grassland') { ?> selected="selected" <? } ?>>Grassland</option>
<option name="Plantation" value="Plantation"  <?php if($location_type == 'Plantation') { ?> selected="selected" <? } ?>>Plantation</option>
<option name="Farmland" value="Farmland" <?php if($location_type == 'Farmland') { ?> selected="selected" <? } ?>>Farmland</option>
<option name="Others" value="Others" <?php if($location_type == 'Others') { ?> selected="selected" <? } ?>>Others</option>
</select>
</td>
</tr> 


<tr>
<td align=right>Degree of slope(°):</td>
<td>
<input type="text" name="degree_of_slope" value="<?=$degree_of_slope;?>" style="width:200px;">
</td>
</tr>

<tr>
<td align=right>Distance from water(m):</td>
<td>
<input type="text" name="distance_from_water" value="<?=$distance_from_water;?>" style="width:200px;">
</td>
</tr>


<tr>
<td align=right>Aspect:</td>
<td>
<select id="aspect" name="aspect" value="<?=$aspect;?>"  style="width:200px;">
<option name="Choose" value="0">-- Choose --</option>
<option name="North" value="North" <?php if($aspect == 'North') { ?> selected="selected" <? } ?>>North</option>
<option name="North-East" value="North-East" <?php if($aspect == 'North-East') { ?> selected="selected" <? } ?>>North-East</option>
<option name="East" value="East" <?php if($aspect == 'East') { ?> selected="selected" <? } ?>>East</option>
<option name="South-East" value="South-East" <?php if($aspect == 'South-East') { ?> selected="selected" <? } ?>>South-East</option>
<option name="South" value="South" <?php if($aspect == 'South') { ?> selected="selected" <? } ?>>South</option>
<option name="South-West" value="South-West" <?php if($aspect == 'South-West') { ?> selected="selected" <? } ?>>South-West</option>
<option name="West" value="West" <?php if($aspect == 'West') { ?> selected="selected" <? } ?>>West</option>
<option name="North-West" value="North-West" <?php if($aspect == 'North-West') { ?> selected="selected" <? } ?>>North-West</option>
</select>
</td>
</tr>

<tr>
<td colspan=2 align=center>
<br>
<input type="submit"  name="Submit" id="Submit" value="Submit" class=buttonstyle onClick="redirectout();"> 
&nbsp;&nbsp;
<input type=reset  value="Clear"  class=buttonstyle>
&nbsp;&nbsp;
<input type=reset  value="Cancel"  class=buttonstyle onClick="redirectout();">
<br>
</td>
</tr>
</table>
</table>
</form>
</div>
<div class="container bottom">
</div>
<?php 
   include("footer.php");
?>
</body>
</html>

