<?php
/*
This page is loaded when a member's name is clicked on home.php
It displays the user's details on the left and allows editing these and changing password.
On the right it displays the trees this user is assigned to.
*/
	session_start();
	if ($_SESSION['user_id']=='')
	{
		header("Location: index.php");
	}
	include_once("includes/dbc.php");
	$user_id=$_GET[user_id];	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seed</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<!--[if lte IE 6]>
	<script type="text/javascript" src="js/supersleight-min.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript" src="js/initiate.js"></script>
<script src="js/ac/jquery.autocomplete.js" type="text/javascript"></script>
<!--<script src="../beta/js/jquery/ac/jquery.js" type="text/javascript"></script>
<script src="../beta/js/jquery/ac/jquery.bgiframe.min.js" type="text/javascript"></script>-->

<!--
This code is executed on submitting the edit user form.
It does form validation and then passes on the values to
updatemember.php for updating user details.
-->
<script type="text/javascript" >
$(function() {
$(".submit2").click(function() {

	if(document.getElementById("full_name").value == '' )
	{
		alert("Please enter the Student's name");
		document.getElementById("full_name").focus();
		return false;
	}

	var dataString = "full_name="+$('#full_name').attr('value');
	
	if(document.getElementById("user_name").value != '')
	{	
		for (i=0; i <= document.getElementById('user_names').length - 1;i++)
		{
		if(document.getElementById("user_name").value == document.getElementById('user_names')[i].text )
		{
			alert("Username should be unique. Please change the username.");
			document.getElementById("user_name").focus();
			return false;
		}
		}
		if(document.getElementById("pwd").value != document.getElementById("pwd2").value )
		{
			alert("Re-entered password doesn't match. Please enter both again.");
			document.getElementById("pwd").value='';
			document.getElementById("pwd2").value='';
			document.getElementById("pwd").focus();
			return false;
		}
		<?php
		if (($_SESSION['group_role']=='coord' && $_SESSION['user_id']!=$user_id) || ($_SESSION['group_role']=='member' && $_SESSION['user_id']==$user_id))
		{
		?>	
			alert("Please Note: Login username for this student will be\n<?php echo $_SESSION[coord_user_name]; ?>."+$('#user_name').attr('value')+"\n\n(student username format is: <coordinator id>.<student id>)");
			$('.success2').html("User details edited. Username: <?php echo $_SESSION[coord_user_name]; ?>."+$('#user_name').attr('value'));
			dataString += "&user_name=<?php echo $_SESSION[coord_user_name]; ?>."+$('#user_name').attr('value');
		<?php
		} else {
		?>
			dataString += "&user_name="+$('#user_name').attr('value');
		<?php
		}
		?>
	}
	else {
		dataString += "&user_name=";			
	}	
	

	if ($('#pwd').attr('value'))
		dataString += "&pwd="+$('#pwd').attr('value');
	dataString += "&user_category=school-seed";
	dataString += "&group_role=member";
	dataString += "&group_class="+$('#group_class').attr('value');
	dataString += "&trees_assigned=";
	j=0;
	for (i=0;i<=document.getElementById('tree_num').value;i++)
	{
		if (document.getElementById('trees_assigned'+i).checked)
		{
			if (j==0)
			{
				dataString += document.getElementById('trees_assigned'+i).value;
			}
			else
			{
				dataString += ", "+document.getElementById('trees_assigned'+i).value;			
			}
			j++;			
		}
	}
	dataString += "&user_id=<? echo $user_id; ?>";
	//alert(dataString);
	$.ajax({
	type: "POST",
	url: "updatemember.php",
	data: dataString,
	success: function(data){
	//$('.success2').html(data);
	$('.success2').fadeIn(200).show();
	$('.error2').fadeOut(200).hide();
	window.setTimeout("$('#dialog_edit_member').fadeOut(1000);$('#mask').fadeOut(500);window.location.reload(true);", 2000);
	}
	});

return false;
});
});
</script>

<!-- Google Analytics code starts-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5355447-9']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();

</script>

<!-- Google Analytics code ends-->

</head>
 
<body>
 
<!-- Main Holder Starts -->
<div id="mainHolder">
 
	<!-- header starts -->
    <div id="homeHeader">
    	<a href="#"><img src="images/logo.png" alt="Seed" title="Seed" width="150" height="98" class="logo" /></a>
        <img src="images/seasonWatch.jpg" alt="Season Watch" title="Season Watch" width="202" height="89" class="season" />
    </div>
    <!-- header ends -->
    
    <!-- content holder starts -->
    <div id="mainContentHolder" class="profileTree">
    	
            <!-- User status starts -->
            <dl class="userStatus">
                <dt><? echo $_SESSION['school_name']; ?> | <a href="home.php">HOME</a></dt>
                <dd>Welcome <? echo $_SESSION['full_name']; ?> | <a href="index.php?action=logout">LOGOUT</a></dd>
            </dl>
            <!-- User status ends -->
            <dl class="supportLinks">
                <dt>&nbsp;</dt>
                <dd><a href="#dialog3" name="modal">Download</a> | <a href="#dialog4" name="modal">Learn</a></dd>
            </dl>
            
            <!-- Left block starts -->
            <div class="leftBlock">

				<?php
					$user_details = mysql_query("SELECT full_name, group_class, date, user_name from users where user_id='$user_id'");
					$user_details_row = mysql_fetch_array($user_details);
				?>
				
                <!-- header starts -->
                <div class="leftHeader">
                	<h1><? echo $user_details_row['full_name']; ?></h1>
					<?php
						if ($_SESSION['user_id']==$user_id || $_SESSION['group_role']=='coord')
						{
					?>
                    <span><a href="#dialog_edit_member" name="modal">EDIT DETAILS / CHANGE PASSWORD</a></span>
					<?php
						}
					?>
                </div>
                <!-- header ends -->
				
                <div class="profileTreeHolder">
                	
                        <div>
                            <dl>
                                <dt>Full Name</dt><dd><? echo $user_details_row['full_name']; ?></dd>
                            </dl>								
                            <dl>							
								<dt>Login username</dt><dd><? echo $user_details_row['user_name']; ?></dd>
                            </dl>
                            <dl>
                                <dt>Class</dt><dd><? echo $user_details_row['group_class']; ?></dd>
                                <dt>Member Since</dt><dd><? echo $user_details_row['date']; ?></dd>								
                            </dl>
                            <dl class="no">

                            </dl>
                        </div>
                </div>
                
            </div>
            <!-- Left block ends -->
            
            
            <!-- Right block starts -->
            <div class="rightBlock">
                
                <!-- header starts -->
                <div class="rightHeader">
                	<h1>Assigned trees</h1>
                </div>
                <!-- header ends -->
				
				<?php
					$trees_assigned_school = mysql_query("SELECT tree_nickname, members_assigned, tree_id, user_id, user_tree_id  
										FROM user_tree_table WHERE user_id='$_SESSION[user_id]'");
					while ($trees_assigned_school_row=mysql_fetch_array($trees_assigned_school)) 
					{
						list($tree_assigned) = mysql_fetch_row(mysql_query("SELECT count(*) as c FROM user_tree_table 
												where members_assigned like '%$user_id%' AND user_tree_id='$trees_assigned_school_row[user_tree_id]'"));
						if ($tree_assigned)
						{
				?>                
                
				<dl class="assignedMemberList">
                	<dt>
						<a href="#">
						<? echo $trees_assigned_school_row[tree_nickname] ;?>
						</a>
					</dt>
					<dd>
						<!--<input name="" type="image" src="images/icoTick.jpg" />
						<input name="" type="image" src="images/icoDactDelete.jpg" />-->
						<img name="" src="images/icoTick.jpg" />
						<img name="" src="images/icoDactDelete.jpg" />
					</dd>
                </dl>
				<? 
						} else {
				?>
                <dl class="assignedMemberList">    
                    <dt>
						<a href="#" class="dactive">
						<? echo $trees_assigned_school_row[tree_nickname] ;?>
						</a>
					</dt>
					<dd>
						<!--<input name="" type="image" src="images/icoDactAdd.jpg" />-->
						<img name="" src="images/icoDactAdd.jpg" />
					</dd>
                </dl>
                <?php
						}
					}
				?>
				
            </div>
            <!-- Right block ends -->
            
        
    </div>
    <!-- content holder ends -->
        
</div>
<!-- Main Holder Ends -->
 
 
<!--MODAL Starts-->
<!--
Dialog box to load form to edit member details/change password etc.
-->

<!-- Make sure that this and id=dialog_add_member in profileMember.php are always in sync-->
<div id="dialog_edit_member" class="window addMemberModal">
 
    <h1>Edit Member Details</h1>
		&nbsp;&nbsp;&nbsp;&nbsp;Fields marked with <font color="red">*</font> are compulsory.	
			<?php
			$sql = mysql_query("SELECT user_name FROM users 
										WHERE group_id='$_SESSION[group_id]' AND user_id<>'$user_id'");
			echo "<select name='user_names' id='user_names' style='visibility:hidden;'>";
			while($row=mysql_fetch_array($sql))
			{
			if (strpos($row['user_name'],"."))
			{
				echo "<option>".substr($row['user_name'],strpos($row['user_name'],".")+1)."</option>";
			}
			else {
				echo "<option>".$row['user_name']."</option>";
			}
			}
			echo "</select>";
			?>
	<form name="edit_member" id="edit_member" method="POST" action="">
    <blockquote class="border">
    	
        <dl>
        	<dt>Member name<font color="#CC0000">*</font></dt>
            <dd><div><input id="full_name" type="text" value="<? echo $user_details_row['full_name']; ?>"/></div>
			</dd>
        </dl>
        <dl>
        	<dt>Class (eg: 9B)</dt>
            <dd><div><input id="group_class" type="text" value="<? echo $user_details_row['group_class']; ?>" /></div>
			</dd>
        </dl>
		<?php
			if (strpos($user_details_row['user_name'],"."))
			{
				$user_name=substr($user_details_row['user_name'],strpos($user_details_row['user_name'],".")+1);
			}
			else {
				$user_name =$user_details_row['user_name'];
			}
		?>
        <dl>
        	<dt>Username</dt>
            <dd><div><input id="user_name" disabled style="background-color:#dddddd;" type="text" value="<? echo $user_name; ?>" /></div>
			</dd>
        </dl>
        <dl>
        	<dt>New Password</dt>
            <dd><div><input id="pwd" type="password" value="" /><font size=-2>(if empty old pwd will be retained)</font></div>
			</dd>
        </dl>		
        <dl>
        	<dt>Re-enter New Password</dt>
            <dd><div><input id="pwd2" type="password" value="" /></div>
			</dd>
        </dl>		
		<?php
		$i=0;
		if (mysql_num_rows($trees_assigned_school))
		{
		?>
		<div style="width:325px; height:150px; overflow:auto;">		
		<table>
		<th colspan=6>
		Assign trees
		</th>
			<?php
				//$trees = mysql_query("SELECT full_name, users.group_id, group_name, group_role FROM users INNER JOIN user_groups ON users.group_id=user_groups.group_id AND  users.group_id='$_SESSION[group_id]' ORDER BY user_id;");
				mysql_data_seek($trees_assigned_school, 0);
				while ($group_trees_row = mysql_fetch_array($trees_assigned_school)) 
				{		
					list($tree_assigned) = mysql_fetch_row(mysql_query("SELECT count(*) as c FROM user_tree_table 
											where members_assigned like '%$user_id%' AND user_tree_id='$group_trees_row[user_tree_id]'"));
					if ($i % 3 == 0) { 
						echo "<tr>";
					}
			?>
				
					<td width="8%"><input type="checkbox" name="trees_assigned<? echo $i; ?>" 
					id="trees_assigned<? echo $i; ?>" value="<? echo $group_trees_row['user_tree_id']; ?>" 
					<? if ($tree_assigned) echo "checked"; ?> /></td>
					<td width="25%"><a href="#"><? echo $group_trees_row['tree_nickname']; ?></a></td>					
			
			<?php
					$i++;
					if ($i % 3 == 0) { 
						echo "</tr>";
					}					
				}
			?>
		</table>		
		</div>
		<input type="hidden" id="tree_num" value="<? echo $i-1; ?>" />
		<?php
		} else {
		?>
		<input type="hidden" id="tree_num" value="-1" />
		<?php
		}
		?>		
    <span>
    	<input name="" type="submit" value="OK" class="submit2" /> 
		<!--<input name="" type="Submit" value="OK" onClick="$('#dialog_add_tree').hide();showNext('#dialog2');" />-->
		<input name="" type="button" class="close" value="CANCEL" />
		<span class="success2" style="display:none">User details edited</span>
		<span class="error2" style="display:none"> User details not edited. Please try again.</span>
    </span>
	</blockquote>
	</form>
	
</div>
<!--MODAL Ends-->


 
<!--MODAL Download Starts-->
<div id="dialog3" class="window download">

	<h1>Downloads</h1>
    
    <p>Tree guide book</p>
    <ul>
        <li>(English, pdf, 4.8 MB) - <a href="downloads/TreeGuideBook_English.pdf" target="_blank">download</a></li>
    </ul>
    
    <p>Tree identification book</p>
    <ul>
    	<li>(Bilingual- Malayalam/ English, pdf, 14 MB) - <a href="downloads/TreeIdentificationBook.pdf" target="_blank">download</a></li>
    </ul>
    
    <p>Tree observation sheets/ book</p>
    <ul>
    	<li>Blank data sheets (English, pdf, 0.2 MB) - <a href="downloads/TreeObservationsBlankSheets.pdf" target="_blank">download</a></li>
        <li>Guidelines/ instructions (English, pdf, 0.9 MB) - <a href="downloads/TreeObservationsInstructions.pdf" target="_blank">download</a></li>
    </ul>
    
    <p>SeasonWatch presentation</p>
    <ul>
    	<li>(English, Macromedia flash presentation, zip file, 29 MB) - <a href="downloads/SWSEEDPresentation.zip" target="_blank">download</a></li>
    </ul>
    
    <p>Tree details</p>
    <ul>
    	<li><strong>Part 1</strong> - plavu, elenji, katampu, njaval, atti (English, Microsoft Excel file, 1.1 MB) - <a href="downloads/SeedSWTreeDetails1.xls">download</a></li>
        <li><strong>Part 2</strong> - aaval, manimaruthu, nelli, arayal, maavu (English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails2.xls">download</a></li>
        <li><strong>Part 3</strong> - kumbil, vatta, paala, ilippa, thekku (English, Microsoft Excel file, 1.5 MB) - <a href="downloads/SeedSWTreeDetails3.xls">download</a></li>
        <li><strong>Part 4</strong> - mandaram, mullumurikku, koovalam, kanikonna, ungu (English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails4.xls">download</a></li>
        <li><strong>Part 5</strong> - ashokam, puli, gulmohur, mazhamaram, mullilavu (English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails5.xls">download</a></li>
    </ul>
    
    <span>
    	<input name="" type="button" class="close" value="CLOSE" />
    </span>
</div>
<!--MODAL Ends--> 
 
 
 
<!--MODAL learn Starts-->
<div id="dialog4" class="window learn">

	<h1>Learn</h1>
    
    <p>This is an <strong>audio presentation</strong>.<br />Please turn on your <strong>speakers</strong> or use your <strong>headphones</strong> to hear what is being said.</p>
    
	<span>
    	<input name="#dialog5" type="button" class="nowOpen" value="OK" style="width:52px;" />
    </span>
</div>
<!--MODAL Ends-->

<!--MODAL learn Starts-->
<div id="dialog5" class="window learn">

	<h1>Learn</h1>
    
    <p>
    	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="780" height="390">
        <param name="movie" value="Main Menu.swf" />
        <param name="quality" value="high" />
        <embed src="Main Menu.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="780" height="390"></embed>
        </object>
    </p>
    
	<span>
    	<input name="" type="button" class="close" value="CLOSE" />
    </span>
</div>
<!--MODAL Ends-->
 
 
<!-- Mask to cover the whole screen -->
<div id="mask"></div>
 
</body>
</html> 

<?php

?>