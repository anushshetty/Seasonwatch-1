<?php
    session_start();
   $page_title=":: User Manager Main Page ::";
    //include("main_includes.php");
    include_once("../includes/dbc.php");

if(!isset($_SESSION['user_admin'])) {
header("Location: index.php");
exit();
}

$page_limit = 15; 

if (!isset($_GET['page']) )
{ $start=0; } else
{ $start = ($_GET['page'] - 1) * $page_limit; }

$rs_all = mysql_query("select count(*) as total_all from users") or die(mysql_error());
$rs_active = mysql_query("select count(*) as total_active from users where approved='1'") or die(mysql_error());
$rs_pending = mysql_query("select * from users where approved='0' limit $start,$page_limit") or die(mysql_error());
$rs_total_pending = mysql_query("select count(*) as tot from users where approved='0'");						   
list($total_pending) = mysql_fetch_row($rs_total_pending);
$rs_recent = mysql_query("select * from users where approved='1' order by date desc limit 25") or die(mysql_error());
list($all) = mysql_fetch_row($rs_all);
list($active) = mysql_fetch_row($rs_active);
$nos_pending = mysql_num_rows($rs_pending);
?>



<html>
<head>

<?php
include("main_includes.php");
?>

<script type = "text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
 //alert(delUrl);
 	url = 'listusers.php?id='+delUrl; 
 	//alert(url);
   window.document.location = url;
  }
else
{
url = 'listusers.php';
 window.document.location = url;
}
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

<?php
$species_name = $_GET['speciesid'];
$sql= mysql_query("SELECT species_id, species_primary_common_name From species_master where species_id = $_GET[speciesid];");
while ($sql1 = mysql_fetch_array($sql))
{
$species_name = $sql1['species_primary_common_name'];
$speciesID = $sql1['species_id'];
}
?>
<div>
<h4>Users monitoring 
<span style="font: bold 20px times">
<a href="species_guide.php?speciesid=<? echo $speciesID ; ?>">
<? 
echo $species_name;
?>
</a>
</span>
</h4>
<?php
include("admin_header.php");
?>
</tbody>
</table>
<div>
<hr/>
</div>

 <!--
<div class='container' style="width:930px;margin-left:auto;margin-right:auto;border-top:solid 1px #d95c15" id='tab-set'>
 <ul class='tabs'>
  <li style='margin-left:0'><a href='#text2' class='selected'>tabular</a></li>
   </ul>
<div id='text2'>
-->
     <table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style="width:50px">&nbsp;No</th>
                                <th style="width:200px">&nbsp;User Name</th>           
                                <th style="width:200px">Address</th>
                                <th style="width:200px">City</th>
                                <th style="width:100px">Join Date</th>                        
			</tr>
                </thead>
                <tbody>
     <?
	$i=1;

$speciesID = $_GET['speciesid'];
//echo $speciesID;
	
           $result = mysql_query("select users.full_name,users.user_id, address, city, district, date from users  inner join (user_tree_table, trees, species_master) where user_tree_table.tree_id=trees.tree_id AND trees.species_id=species_master.species_id AND users.user_id=user_tree_table.user_id
AND trees.species_id = '$speciesID' ");
	   while ($row = mysql_fetch_array($result)) {
	             print "<tr>";
                        print "<td style='text-align:center'><a href='user_profile.php?user=".$row{'user_id'}."'>" . $i . "</a></td>";
	                print "<td>".$row{'full_name'}."</td>";
     			print "<td>".$row{'address'}."</td>"; 
                        print "<td>".$row{'city'}."</td>"; 
		        print "<td>".$row{'date'}."</td>";
                        print "</tr>";
                        $i++;
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

       </div>

</div>

<?php 
    mysql_close($link);
   include("footer.php");
?>
</body>
</html>


