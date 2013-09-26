<? 
   session_start();
   $page_title="SeasonWatch";
   include("../includes/dbc.php");
   include("main_includes.php");
   //include("../functions.php");
   
?>
</head>

<body>
<div class='container first_image'>
<table>
<tr>
<td><b><h3>Welcome to Admin Panel</h3></b></td>
</tr>
</table>
<div>
<hr>
</div>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td>
<a href="admin.php" title="species_page">
<img alt="" src="./images/cpanel.png">Home</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>


<td>
<a href="listspecies.php" title="species_page">
<img alt="" src="./images/address_f2.png">Species Management</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>

<td>
<a href="listusers.php" title="species_page">
<img alt="" src="./images/icon-48-user.png">User Management</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>


<td>
<a href="data.php" title="species_page">
<img alt="" src="./images/addedit.png">Quick data filter</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>


<td>
<a href="admin_logout.php" title="species_page">
<img alt="" src="./images/logout.png">Logout</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>

<table>
<tr>
<!--<td>
<b>All Registered Users</b>
</td>-->
</tr>
</table>
<div>
<hr/>
</div>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td>
<table>
<tr>
<?php include("get_latest_observations.php");?>		
</tr>
</table>
</td>
</tr>

<tr>
<td colspan="1">
<hr/>
</td>
</tr>
<tr>
	<td>
	<table>
	<tr>
		<td class="cms" style="border-right: 1px solid rgb(217, 92, 21); ">
		<h3>New Seasonwatchers</h3>
		<p>
		<span style="">
		<?php
			 $page_id=28;
			 $page=mw_get_page($page_id);
		?>
			 <? echo nl2br($page[1]); ?>
		</td>
		<td class="cms"  style="border-right: 1px solid rgb(217, 92, 21);padding-left:15px; ">
		<h3>SeasonWatch Visitors</h3>
		<p>
		<span class="ver12blkht">
		<?php
			 $page_id=26;
			 $page=mw_get_page($page_id);
		?>
			 <? echo nl2br($page[1]); ?>
		</span>
		</p>
		</td>
		<td style="padding-left:15px;">
		<h3>Latest updates</h3>
			<table>
			<tr>
				<td><? include("get_latest_species.php"); ?></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	</td>
</tr>
</tbody>
</table>


<!-- <script type="text/javascript">
$(document).ready(function() {
 $('#map').show();
 $('#list').show();
 $('#map-show-hide').click(function() {
 $('#map').toggle();
 $('#list').toggle();
 });
 $('.error_top').corner(); 
 $('.first_image').corner('bottom');
 //$('#rememberme').toggle();
});  
</script> -->

     
</div>
</div>
</div>
</body>
</html>
