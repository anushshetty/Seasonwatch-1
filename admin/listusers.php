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

$fromdate_raw = mktime(0, 0, 0, date("m")-12, date("d"), date("y"));
$userfilter = 0;
$fromdate = date("m/d/Y", $fromdate_raw);
$todate = date('m/d/Y');

if(isset($_REQUEST['userfilter'])){
	$userfilter = $_REQUEST['userfilter'];
	$fromdate = $_REQUEST['fromdatepicker'];
	$todate = $_REQUEST['todatepicker'];
}


if (!isset($_GET['page']) )
{ $start=0; } else
{ $start = ($_GET['page'] - 1) * $page_limit; }

$rs_all = mysql_query("select count(*) as total_all from users where approved='1' and banned='0'") or die(mysql_error());
$rs_active = mysql_query("select count(*) as total_active from users where approved='1' and banned='0'") or die(mysql_error());
$rs_pending = mysql_query("select * from users where approved='0' and banned='0' limit $start,$page_limit") or die(mysql_error());
$rs_total_pending = mysql_query("select count(*) as tot from users where approved='0' and banned='0'");						   
list($total_pending) = mysql_fetch_row($rs_total_pending);
$rs_recent = mysql_query("select * from users where approved='1' and banned='0' order by user_id desc limit 25") or die(mysql_error());
list($all) = mysql_fetch_row($rs_all);
list($active) = mysql_fetch_row($rs_active);
$nos_pending = mysql_num_rows($rs_pending);
?>

<!--delete code from user-->
<?php 
if($_GET['id']!= "")
{ 
$userid=($_GET['id']);  
$sql1 = "DELETE FROM users
               WHERE user_id= '$userid'";  
echo "<div class='notice'>Successfully Deleted</div>";
mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error());  
}


?>

<html>
<head>
<?php
include("main_includes.php");
?>

<script type="text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete?")) { 
 	url = 'listusers.php?id=' + delUrl; 
	window.location.href = url;
	return true;
  }
 else {
	return false;	
 }
}

function filteration(userid) {
	if(userid == "0") {	
		userid = document.getElementById("userfilter").value;
	}

	url = 'listusers.php?user_id='+userid; 
	window.location = url;
} 


</script>
<script>
	$(function() {
		$( "#fromdatepicker, #todatepicker" ).datepicker();
	});
	/*$(function() {
		$( "#todatepicker" ).datepicker();
		//var curdate = $( "#todatepicker" ).datepicker("getDate");
		//alert(curdate);
		//$( "#todatepicker" ).datepicker("setDate", curdate);
	});*/
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
	<link type="text/css" href="../../themes/base/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="../../jquery-1.3.2.js"></script>
	<script type="text/javascript" src="../../ui/ui.core.js"></script>
	<script type="text/javascript" src="../../ui/ui.datepicker.js"></script>
	<link type="text/css" href="../demos.css" rel="stylesheet" />
</head>
<body>
<div class='body_main'>
<div class='container first_image'>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<div>
<h3>User Management</h3>

<?php
include("admin_header.php");
?>
</tbody>
</table>
<div>
<hr/>
</div>
<?
	
?>
<form action="listusers.php" name="listFilter" id="listFilter" method="post" style="margin:0;">
<table style="width: 630px;">
	<tr>
		<td>
			<select id="userfilter" name="userfilter" style="width:208px;" onChange="filteration(this.value)">
			<option value="0">All users</option>
			<option value="1" <?php if($userfilter == '1') { ?> selected="selected" <? } ?>>Users have not added any tree</option>
			<option value="2" <?php if($userfilter == '2') { ?> selected="selected" <? } ?>>Users have not reported observation on tree</option>
			</select>
		</td>
		<td>
			From: <input type="text"  name="fromdatepicker" id="fromdatepicker" value="<?=$fromdate;?>">
		</td>
		<td>
			To: <input type="text"  name="todatepicker" id="todatepicker" value="<?=$todate;?>" >
		</td>
		<td>
			<input type="submit" name="btnFilter" id="btnFilte" value="Filter" />
		</td>
	</tr>
</table>
</form> 

<table id="table1" class="tablesorter">
	<thead>
		<tr>
			<th style='width:80px'>User ID</th>
			<th style='width:120px'>Join Date</th>           
			<th style='width:120px'>User Name</th>
			<th style='width:100px'>Email</th>                        
			<th style='width:200px'>Location</th>
			<th style='width:150px'>Edit</th>
			<th style='width:150px'>Delete</th>
			<th style='width:150px'></th>
		</tr>
	</thead>
	<tbody>    
		 
	<?php  
	if($userfilter == '1')
	{ 
		$rs_pending = mysql_query("SELECT DISTINCT * FROM users WHERE user_id NOT IN (SELECT distinct user_id FROM user_tree_table) and date between '$fromdate' and '$todate' and  banned='0' order by user_id desc limit $start,$page_limit") or die(mysql_error());
	}
	else if ($userfilter == '2')
	{		
		$rs_pending = mysql_query("SELECT DISTINCT * FROM users u INNER JOIN user_tree_table utt ON utt.user_id = u.user_id inner JOIN user_tree_observations uto ON uto.user_id != utt.user_id WHERE u.date between '$fromdate' and '$todate' and banned='0' order by u.user_id desc limit $start,$page_limit") or die(mysql_error());
	}
	else
	{
		$rs_pending = mysql_query("select * from users where date between '$fromdate' and '$todate' and banned='0' order by user_id desc") or die(mysql_error());
		
	}

	//$nos_pending = mysql_num_rows($rs_pending);
	while ($prows = mysql_fetch_array($rs_pending)) {?>
		<tr> 
			<td>#<? echo $prows['user_id']?></td>
			<td><? echo $prows['date']?></td>
			<td><? echo $prows['full_name']?></td>
			<td><? echo $prows['user_email']?></td>
			<td>
				<?php  
				$query=mysql_query("SELECT state FROM seswatch_states WHERE state_id='$prows[state_id]'");

				while($query1 = mysql_fetch_array($query))
				{
				echo $query1['state'];
				}
				?>
			</td>
			<td>
				<?php
				$edituserlink = "<a class=thickbox href=\"editusers.php?userid=".$prows['user_id']."&TB_iframe=true&height=500&width=700\">Edit</a>";
				echo $edituserlink;?>
			</td>
			<td>
				<?php
				$var=$prows['user_id'];
				//$deleteuserlink="<a class=thickbox href=\"deleteusers.php?userid=".$prows['user_id']."\">Delete</a>";
				$deleteuserlink = "<a  href='listusers.php' onclick='return confirmDelete($var);'>Delete</a>";
				echo $deleteuserlink;?>
			</td>
			<td>
				<?php
				//$loginuserlink="<a target=\"_blank\" href=\"inspectlogin.php?userid=".$prows['user_id']."\">Login</a>";
				//echo $loginuserlink;?>
			</td>
		</tr>

			 <!-- <td> <span id="papprove<? echo $prows['user_id']; ?>">
				<? if(!$prows['approved']) { echo "Pending"; } else {echo "yes"; }?>
				</span>
			  </td>
			  <td><span id="pban<? echo $prows['user_id']; ?>">
				<? if(!$prows['banned']) { echo "no"; } else {echo "yes"; }?>
				</span> 
			  </td>
			  <td> 
				<a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "approve", user_id: "<? echo $prows['user_id']; ?>" } ,function(data){ $("#papprove<? echo $prows['user_id']; ?>").html(data); });'>Approve</a> 
			   | <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "ban", user_id: "<? echo $prows['user_id']; ?>" } ,function(data){ $("#pban<? echo $prows['user_id']; ?>").html(data); });'>Ban</a> 
			   | <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "unban", user_id: "<? echo $prows['user_id']; ?>" } ,function(data){ $("#pban<? echo $prows['user_id']; ?>").html(data); });'>Unban</a>
				</td>
			</tr>-->
			
	<? } ?>
	</tbody>
</table>

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
<div>
<a class=thickbox href="addusers.php/" title="add user page">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img alt="" src="./images/addusers.png" />&nbsp;&nbsp;Add new user</a>
</div>
          
</div>


	 <!-- <p>  <?php
	  // generate paging here
	  if ($total_pending > $page_limit)
	  {
	   $total_pages = ceil($total_pending/$page_limit);
	   echo "<h4><font color=\"#CC0000\">Pages: </font>";
	  $i = 0;
		while ($i < $total_pages) 
		{
				$page_no = $i+1;
				echo "<a href=\"listusers.php?page=$page_no\">$page_no</a> ";
				$i++;
		}
	  echo "</h4>";
	  }?>
      </p>
     <p align="center">
        <input name="doRefresh" type="button" id="doRefresh" value="Refresh All" onClick="location.reload();">

        <input type=reset  value="Back"  class=buttonstyle onclick="javascript:window.location.href='admin.php';">
      </p>  --> 

  
    
      <!--<h3>Recent Registrations</h3>
      <p>This shows to <strong>25 latest approved</strong> registrations and their 
        banned status.</p>
      <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#e5ecf9">  
          <td width="4%"><strong>ID</strong></td>
          <td> <strong>Date</strong></td>
          <td><strong>User Name</strong></td>
          <td width="29%"><strong>Email</strong></td>
          <td width="10%"><strong>Approved</strong></td>
          <td width="8%"> <strong>Banned</strong></td>
          <td width="19%">&nbsp;</td>
        </tr>
        <tr>  
          <td>&nbsp;</td>
          <td width="12%">&nbsp;</td>
          <td width="18%">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php  while ($rrows = mysql_fetch_array($rs_recent)) {?>
    <tr> 
          <td>#<?php  echo $rrows['user_id']?></td> 
          <td><?php  echo $rrows['date']?></td> 
          <td><?php  echo $rrows['user_name']?></td> 
          <td><?php  echo $rrows['user_email']?></td>
          <td> <span id="approve<? echo $rrows['user_id']; ?>">
            <? if(!$rrows['approved']) { echo "Pending"; } else {echo "yes"; }?>
			</span>
          </td> 
          <td><span id="ban<? echo $rrows['user_id']; ?>">
            <? if(!$rrows['banned']) { echo "no"; } else {echo "yes"; }?>
			</span> 
          </td>
          <td> 
		    <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "approve", user_id: "<? echo $rrows['user_id']; ?>" } ,function(data){ $("#approve<? echo $rrows['user_id']; ?>").html(data); });'>Approve</a> 
           | <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "ban", user_id: "<? echo $rrows['user_id']; ?>" } ,function(data){ $("#ban<? echo $rrows['user_id']; ?>").html(data); });'>Ban</a> 
		   | <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "unban", user_id: "<? echo $rrows['user_id']; ?>" } ,function(data){ $("#ban<? echo $rrows['user_id']; ?>").html(data); });'>Unban</a>
			</td>
        </tr>
        <? } ?> 
     <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr> 
        <tr>  
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>  
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
        </tr> 
      </table>-->
      
</div>
</div>
</div>

<?php 
    mysql_close($link);
   include("footer.php");
?>
</body>
</html>


