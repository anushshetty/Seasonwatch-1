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
$speciesID=($_GET['id']);  
echo $species_id;
$sql1 = "DELETE FROM species_master 
         WHERE species_id= '$speciesID'";  
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

<script type = "text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete?")) { 
 	url = 'listspecies.php?id=' + delUrl; 
	window.location.href = url;
	return true;
  }
 else {
	return false;	
 }
}

/*function confirmDelete(	) {
  if (confirm("Are you sure you want to delete?")) {
 //alert(delUrl);
url = 'listspecies.php';
// window.document.location = url;
  window.location = url;
  }
}*/
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
<h3>Species Management</h3>
<?php
include("admin_header.php");
?>
</table>
<div>
<hr/>
</div>

<table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style='width:100px' align="left">S No.</th>
                                <th style='width:200px' align="left">Species ID</th>           
                                <th style='width:280px' align="left">Species Primary Name</th>
                                <th style='width:280px' align="left">Species Scientific Name</th>                        
				<th style='width:220px' align="left">Family</th>
<th style='width:150px' align="left" >Edit</th>
<!--<th style='width:150px' align="left">Delete</th>-->
  </tr>
                </thead>
<tbody>


<?php 
$count=0;
$result = mysql_query("SELECT species_id,species_primary_common_name, species_scientific_name,family FROM species_master");
while ($row_settings = mysql_fetch_array($result)) 
{
print "<tr>"; 
$count++; 
 print "<td style='text-align:left'><a href='species_guide.php?speciesid=".$row_settings{'species_id'}."'>" . $count . "</a></td>";
//print $row_settings['species_id'];
print "<td>".$row_settings['species_id']."</td>";
print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td>".$row_settings['species_scientific_name']. "</td>";
print "<td style='width:220px'>".$row_settings['family']."</td>";
$edittreeLink = "<a class=thickbox href=\"editspecies.php?speciesid=".$row_settings['species_id']."&TB_iframe=true&height=500&width=700\">Edit</a>";
print "<td>$edittreeLink</td>"; 

$var=$row_settings['species_id'];
$deletetreeLink = "<a  href='listspecies.php' onclick='return confirmDelete($var);'>Delete</a>";
//$deletetreeLink = "<a  href='listspecies.php?id=$var' onclick=confirmDelete();>Delete</a>";
//print "<td>$deletetreeLink</td>";
print "</tr>";  
}  
echo "</tbody></table>";
?>
<div id="pager" class="column span-7" style="" >
                        <form name="" action="" method="post">
                                <table >
                                <tr>
                                        <td><img src='pager/icons/first.png' class='first'/></td>
                                        <td><img src='pager/icons/prev.png' class='prev'/></td>
                                        <td><input type='text' size='8' class='pagedisplay'/></td>
                                        <td><img src='pager/icons/next.png' class='next'/></td>
                                        <td><img src='pager/icons/last.png' class='last'/></td>
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

<a class=thickbox href="addspecies.php?TB_iframe=true&height=500&width=700" title="add species page">
<img alt="" src="./images/addspecies.png">Add new species</a>
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
 
