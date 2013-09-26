<? 
   session_start();
   $page_title="SeasonWatch";
   include("../includes/dbc.php");
   include("main_includes.php");
   //include("../functions.php");
   
?>

<body>
<div class='body_main'>
<div class='container first_image'>
<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<div>
<h3>Welcome Admin!</h3>

<?php
include("admin_header.php");
?>

</table>
<div>
<hr/>
</div>

<div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>Latest Updates</a></li>
    </ul>
</div>
                                  
<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td>
<table>


	<tr> 
<!--	<td class="cms" style="border-right: 1px solid rgb(217, 92, 21); ">
	<h3>New Seasonwatchers</h3>

<p>
		SeasonWatch is a citizen volunteer network that monitors plant phenology (timing of seasonal plant activity) across India. Observations collected by this network will help understand what influences the timing of flowering, fruiting and leaf-flush, and how this timing may be changing as the climate changes.
                </p>

		</td>
		<td class="cms"  style= "border-right: 1px solid rgb(217, 92, 21);padding-left:15px; ">
		<h3>SeasonWatch Visitors</h3>
		<p>
		SeasonWatch is a citizen volunteer network that monitors plant phenology (timing of seasonal plant activity) across India. Observations collected by this network will help understand what influences the timing of flowering, fruiting and leaf-flush, and how this timing may be changing as the climate changes.
                </p>
		</td>
		<td style="padding-left:15px;">
	<h3>Latest updates</h3>-->

			<table>
			<tr>
                               <!-- <td>>>><? include("get_latest_reports.php"); ?></td>-->
							   <td><? include("get_latest_observationcontributors.php"); ?></td>
                                <td><? include("get_latest_contributors.php"); ?></td>
				<td><? include("get_latest_species.php"); ?></td>
			</tr>
			</table>
		</td>
	</tr>

</table>
<hr/>
</td>
</tr>

<tr>
<td>
 <h2> <a href="get_userlastobservationdate.php">Users Not updated observation.</a>  </h2>
<h3> Latest Observations </h3>
<hr/>

<table>
<tr>
<?php include("get_latest_observations.php");?>		
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

<?php mysql_close($link);?>

</body>
</html>
