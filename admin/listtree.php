<? 
   session_start();
   $page_title="::: SeasonWatch :::";
   include("main_includes.php");
   include("../includes/dbc.php");

if(!isset($_SESSION['user_admin'])) {
header("Location: index.php");
exit();
}


if($_GET['id']!= "")
{ 
$treeID=($_GET['id']);  
//echo $species_id;
$sql1 = "DELETE FROM trees 
         WHERE tree_id= '$treeID'";  
echo "<div class='notice'>You have to be logged in to access this page</div>";
mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()); 
} 
?>
 
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<!--<title>SeasonWatch</title>
<link type="text/css" rel="stylesheet" href="../js/thickbox/thickbox.css"></link>
<script language="javascript" src="../js/thickbox/thickbox.js"></script>
<link rel="stylesheet" href="../blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="../blueprint/print.css" type="text/css" media="print">
<link rel="stylesheet" href="../blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" href="../css/styles_new.css" type="text/css">
<link type="text/css" rel="stylesheet" href="../js/thickbox/thickbox.css"></link>
<script language="javascript" src="../js/thickbox/thickbox.js"></script>

alerts script
<script src="js/jquery.js" type="text/javascript"></script>
<script src="/js/alerts/jquery.ui.draggable.js" type="text/javascript"></script>
Core files 
<script src="/js/alerts/jquery.alerts.js" type="text/javascript"></script>
<link href="/js/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />-->

<?php
include ("main_includes.php");
?>

<script type="text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete?")) { 
 	url = 'listtree.php?id=' + delUrl; 
	window.location.href = url;
	return true;
  }
 else {
	return false;	
 }
}

function filteration(speciesid, tree_location_id) {
//alert(species_id);
  //if (val > 0 ) {
 //document.getElementById("species").selectedindex = species_id;
 //document.getElementById("species").options(species_id).selected = true;
 //document.getElementById("species").value = species_id;
	//var e = document.getElementById("location");
	//alert(e);
	//var location_type = e.options[e.selectedIndex].value;
	
	//var species = document.getElementById("species");
	//var species_id = species.options[e.selectedIndex].value;
	/*speciesid = val;
	}
	else {
	location_type = val;
	}*/
	if(speciesid == "0") {	
		speciesid = document.getElementById("species").value;
	}
	if(tree_location_id == "0") {	
		tree_location_id = document.getElementById("location").value;
	}

	url = 'listtree.php?species_id='+speciesid+'&tree_location_id='+tree_location_id; 
	window.location = url;
} 


</script>


<script type="text/javascript">
        $(function() { 

             $("#table1")
                .tablesorter({  headers: { 
                   5: { sorter: false }, 6: { sorter: false }, 7 : { sorter: false }, 8: { sorter: false } },widthFixed: true, widgets: ['zebra']})
                   .tablesorterPager({container: $("#pager"), positionFixed: false});

              $("#table2")
                .tablesorter({widthFixed: true, widgets: ['zebra']})
                .tablesorterPager({container: $("#pager2"), positionFixed: false});
                     
        });
    </script> 

</head>

<body>

<div class='body_main'>
<div class='container first_image'>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<div>
<h3>Tree Management</h3>
<?php
include("admin_header.php");
?>
</table>
<div>
<hr/>
</div>
<!--<tr>
<td align=right>Species name:</td>
<td > -->
<?php	
//$species_id = 0;
//$location_type = "";


//$species_id = $_REQUEST['species_id'];
//$location_type = $_REQUEST['location'];

?>

<select name="species" id="species" style="width:200px;" 
onChange='filteration(this.value,0)'>
        <option value="">--Filter By Species Name--</option>
        <?php
		$specieslist = "SELECT distinct SM.species_id, SM.species_primary_common_name FROM species_master as SM 
		INNER JOIN trees as T ON T.species_id = SM.species_id ORDER BY SM.species_primary_common_name";
		$result = mysql_query($specieslist);
            while($row=mysql_fetch_array($result)){
                $species_id = $row[species_id];
                $species_primary_common_name = $row[species_primary_common_name];
			
        ?>

        <option <?php if($species_id == $_REQUEST['species_id'] ){ ?> selected="selected" <?php }?> value='<?php echo $species_id; ?>' > <?php echo $species_primary_common_name; ?>
        </option>
        <?php } ?>
    </select>

</td>
</tr> 

<!--<tr>
<td align=right>Location Type:</td>
<td > -->

<select name='location' id="location" style="width:200px;" onChange='filteration(0,this.value)'>
        <option value="">--Filter By Location Type--</option>
        <?php
            $locationlist = "SELECT distinct tree_location_id, location_name FROM location_master where location_name != '0' AND location_name != ''";
			$result = mysql_query($locationlist);
            while($row=mysql_fetch_array($result)){
				$tree_location_id = $row[tree_location_id];
                $location_name = $row[location_name];		
        ?>

        <option <?php if($tree_location_id == $_REQUEST['tree_location_id'] ){ ?> selected="selected" <?php }?> value='<?php echo $tree_location_id; ?>' >
        <?php echo $location_name; ?>
        </option>
        <?php } ?>
    </select>
</td>
</tr>  <br/><br/>

<table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style='width:100px' align="left">S No.</th>
                                <th style='width:200px' align="left">Tree ID</th>           
                                <th style='width:280px' align="left">Tree Name</th>
                                <th style='width:280px' align="left">Species Name</th>                        
				<th style='width:220px' align="left">location</th>
<th style='width:150px' align="left" >Edit</th>
<th style='width:150px' align="left">Delete</th>
  </tr>
                </thead>
<tbody>


<?php 
$count=0;
if($_REQUEST['species_id'] > 0 || $_REQUEST['tree_location_id'] > 0)
{
$resultFltr = "";
$species_id = $_REQUEST['species_id'];
$tree_location_id = $_REQUEST['tree_location_id'];

if((int)$species_id > 0)
	$resultFltr .= " AND (SM.species_id = $species_id) ";
if((int)$tree_location_id > 0)
	$resultFltr .= " AND (T.tree_location_id = $tree_location_id) ";

$result = mysql_query("SELECT T.tree_Id,T.tree_desc,SM.species_primary_common_name,LM.location_name FROM trees AS T
							LEFT JOIN species_master AS SM ON SM.species_id=T.species_id
							LEFT JOIN location_master AS LM ON LM.tree_location_id=T.tree_location_id 
							where 1=1 $resultFltr");
}
else
{
//$species_id = 0;
$result = mysql_query("SELECT T.tree_Id,T.tree_desc,SM.species_primary_common_name,LM.location_name FROM trees AS T
							LEFT JOIN species_master AS SM ON SM.species_id=T.species_id
							LEFT JOIN location_master AS LM ON LM.tree_location_id=T.tree_location_id");
}
//$result = mysql_query("SELECT T.tree_Id,T.tree_desc,SM.species_primary_common_name,LM.location_name FROM trees AS T LEFT JOIN species_master AS SM ON SM.species_id=T.species_id 						LEFT JOIN location_master AS LM ON 		 LM.tree_location_id=T.tree_location_id where SM.species_id = '0' OR SM.species_id = $species_id"); 
while ($row_settings = mysql_fetch_array($result)) 
{
print "<tr>"; 
$count++; 
print "<td style='text-align:left'>" . $count . "</a></td>";
//print $row_settings['species_id'];
print "<td>".$row_settings['tree_Id']."</td>";
print "<td>".$row_settings['tree_desc']."</td>";
print "<td>".$row_settings['species_primary_common_name']. "</td>";
print "<td style='width:220px'>".$row_settings['location_name']."</td>";
$edittreeLink = "<a class=thickbox href=\"addedittree.php?treeid=".$row_settings['tree_Id']."&TB_iframe=true&height=500&width=700\">Edit</a>";
print "<td>$edittreeLink</td>"; 

$var=$row_settings['tree_Id'];
//<input type="hidden" name="tree" value="<?=$var; />
$deletetreeLink = "<a  href='listtree.php' onclick='return confirmDelete($var);'>Delete</a>";
//$deletetreeLink = "<a  href='listtree.php?id=$var' onclick=confirmDelete();>Delete</a>";
print "<td>$deletetreeLink</td>";
print "</tr>";  
}  
echo "</tbody></table>";
?>
<div id="pager" class="column span-7" style="" >
                        <form name="" action="" method="post">
                                <table >
                                <tr>
                                        <td><img src='images/icons/first.png' class='first'/></td>
                                        <td><img src='images/prev.png' class='prev'/></td>
                                        <td><input type='text' size='8' class='pagedisplay'/></td>
                                        <td><img src='images/next.png' class='next'/></td>
                                        <td><img src='images/last.png' class='last'/></td>
                                        <td>
                                                <select class='pagesize'>
                                                        <option selected='selected'  value='10'>10</option>
                                                        <option value='20'>20</option>
                                                        <option value='30'>30</option>
                                                        <option  value='40'>40</option>
                                                </select>
                                        </td>
                                </tr>
                                </table>
                        </form>
                </div>


<td>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;

<a class=thickbox href="addedittree.php?TB_iframe=true&height=500&width=700" title="add tree page">
<img alt="" src="./images/addspecies.png">Add new tree</a>
&nbsp;
</td>
<!--<p align="center">
<input name="doRefresh" type="button" id="doRefresh" value="Refresh All" onClick="location.reload();">
<input type=reset  value="Back"  class=buttonstyle onclick="javascript:window.location.href='admin.php';">
</p>-->   

</div>
</div>
</div>


<?php 
   include("footer.php");
?>
</body>
</html>
 
