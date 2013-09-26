<?php
session_start();
   $page_title=": add species page :";
   include("main_includes.php");
   //include("../includes/dbc.php");
   //include("trackspecies.php");
   //$GLOBALS["message"]="";


?>
<html>
<head>
<meta content="alert, confirm, prompt, demo" name="keywords"/>
<title>Add Species Page</title>
<!--Script for redirecting to main page within FRAME-->
<script type="text/javascript">
function redirectout()
{
	//top.location.replace( "listspecies.php" );
	window.location = "listspecies.php"
}
</script>
</head>

<body>

<div class='container first_image'>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>

<tr>
<td><h2>Please use the form below to enter new species data.</h2></td>
</tr>

<tr>
<td>
<form action="trackspecies.php" name="adminfrm1" method="post">

<table width=600>
</tr>
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 


<tr>
<td align=right>Primary Common Name</td>
<td><input type="text" name="species_primary_common_name" style="width:200px;">
</td>
</tr>

<tr>
<td align=right>Scientific Name:</td>
<td>
<input type="text" name="species_scientific_name" style="width:200px;">
</td>
</tr>

<tr>
<td align=right>Family:</td>
<td><input type="text" name="family" style="width:200px;"></td>
</tr>


<tr>
<td align=right>Vegetation Type:</td>
<td>
<select id="vegetation_type" name="vegetation_type"  style="width:200px;">
<option name="Choose" value="0">-- Choose --</option>
<option name="Deciduous" value="Deciduous">Deciduous</option>
<option name="Evergreen" value="Evergreen">Evergreen</option>
<option name="Near Deciduous" value="Near Deciduous">Near Deciduous</option>
<option name="Near Evergreen" value="Near Evergreen">Near Evergreen</option>
</select>
</td>
</tr>

<tr>
<td align=right>Status in India:</td>
<td>
<select id="status_in_india" name="status_in_india"  style="width:200px;">
<option name="Choose" value="0">-- Choose --</option>
<option name="Indigenous" value="Indigenous">Indigenous</option>
<option name="Exotic" value="Exotic">Exotic</option>
<option name="Invasive" value="Invasive">Invasive</option>
<option name="Naturalized" value="Naturalized">Naturalized</option>
</select>

</td>
</tr> 

<tr>
<td align=right>Habitat Type:</td>
<td><input type="text" name="habitat_type" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Distribution in India:</td>
<td><input type="text" name="distribution_in_india" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Leaf shape Category:</td>
<td>
<input type="text" name="leaf_shape_category" style="width:200px;">
</td>
</tr>


<tr>
<td align=right>Size Description:</td>
<td><textarea id='sizedesc' name="size_description" cols="40" rows="5" class="emptyonclick" >
Enter your comments here
</textarea><br> </td>
</tr>

<tr>
<td align=right>Flower Description:</td>
<td><textarea name="flower_description" cols="40" rows="5"  >
Enter your comments here
</textarea><br> </td> 
</tr>

<tr>
<td align=right>Bark Description:</td>
<td><textarea name="bark_description" cols="40" rows="5" >
Enter your comments here
</textarea><br> </td> 
</tr>

<tr>
<td align=right>Fruit Description:</td>
<td><textarea name="fruit_description" cols="40" rows="5" >
Enter your comments here
</textarea><br> </td> 
</tr>

<tr>
<td align=right>Leaf Type:</td>
<td><input type="text" name="leaf_type" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Flowering Time:</td>
<td><input type="text" name="flowering_time" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Fruiting Time:</td>
<td><input type="text" name="fruiting_time" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Time of leaf Flush:</td>
<td><input type="text" name="time_of_leaf_flush" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Similar Species:</td>
<td><input type="text" name="similar_species" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Known Pollinators:</td>
<td><input type="text" name="known_pollinators" style="width:200px;"></td>
</tr>

<tr>
<td align=right>known Seed Dispersers:</td>
<td><input type="text" name="known_seed_dispersers" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Uses by humans:</td>
<td><input type="text" name="uses_by_humans"style="width:200px;"></td>
</tr>

<tr>
<td align=right>List of references:</td>
<td><input type="text" name="list_of_references" style="width:200px;"></td>
</tr>

<tr>
<td align=right>Spine Thorn Description:</td>
<td><textarea name="spine_thorn_description" cols="40" rows="5">
Enter your comments here
</textarea><br> </td>
</tr>

<tr>
<td align=right>Special Notes on the Species:</td>
<td><textarea name="special_notes_on_the_species" cols="40" rows="5" >
Enter your comments here
</textarea><br> </td>
</tr>
<!--onclick="this.value='';"-->
<tr>
<td align=right>Special notes on phenology:</td>
<td><textarea name="special_notes_on_phenology" cols="40" rows="5">
Enter your comments here
</textarea><br> </td>
</tr>



<tr>
<td colspan=2 align=center style="padding-left:20px">
<br>
<input type="submit"  name="Submit" id="Submit" value="Submit" class=buttonstyle> 
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

