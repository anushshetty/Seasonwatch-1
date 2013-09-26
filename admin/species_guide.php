<? 
   session_start();
   $page_title="SeasonWatch";
    include ("../includes/dbc.php");
    include("main_includes.php");

if(!isset($_SESSION['user_admin'])) {
header("Location: index.php");
exit();
}

//echo $_GET['speciesid'];
	if($_POST['speciesid2'])
$speciesname=$_POST['speciesid2'];
	elseif ($_GET['speciesid']) 
$speciesname=$_GET['speciesid'];
//echo $speciesname;	
?> 
<body>

<div class="body_main">
<div class='container first_image'>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<div>
<h3>Species guide</h3>

<?php
include("admin_header.php");
?>

</table>
<div>
<hr/>
</div>


<div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>species guide</a></li>
    </ul>
</div>


<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tr>
<colgroup>
<col style="width: 50px;"/>
<col style="width: 50px;"/>
</colgroup>
<tr>
<td valign="top">
<table>
<?php 
$result = mysql_query("SELECT * FROM species_master WHERE species_id='$speciesname'");

while ($row_settings = mysql_fetch_array($result)) 
{
print "<tr><td>Tree Name: " .$row_settings['species_primary_common_name']."</td></tr>";
print "<tr><td>Scientific Name:<i> ".$row_settings['species_scientific_name']. "</i></td></tr>";
print "<tr><td>Family: ".$row_settings['family']."</td></tr>";
}
?>
</table>
<br/><br/><br/><br/>
</td>
<td>
<table>
<?php 
$result2 = mysql_query("SELECT * FROM species_alternate_name INNER JOIN language_master ON species_alternate_name.language_id = language_master.language_id AND species_alternate_name.species_id='$speciesname'");
$count=0;
while($row_settings2 = mysql_fetch_array($result2))
{
if (!$count){ print "<tr><td><br/>Alternative Names</td></tr>";$count++;}
	print "<tr><td>".$row_settings2['Language_name'].": " .$row_settings2['alternative_name']."</td></tr>";

}
?>
</table>
</td>
</tr>
</table>

<?php
$result3 = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='$speciesname'");
$image_names = mysql_fetch_array($result3);
$species_pic1 = "../".$image_names['path_name'].'/'.$image_names['file_name'];
$image_names = mysql_fetch_array($result3);
$species_pic2 = "../" .$image_names['path_name'].'/'.$image_names['file_name'];
//if (file_exists($filename)) {
//    echo "The file $filename exists";
?>
<table>
<tr>
<td>
<?php print"<img src ='".$species_pic1."'width='300px' />"; ?>
</td>
<td>
<?php print"<img src ='".$species_pic2."'width='300px' />"; ?>
</td>
</tr>
</table>
</div>
</div>

</body>
</html>
