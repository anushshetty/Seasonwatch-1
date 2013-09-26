<?php
/*
This is the central page of the SeasonWatch-SEED website.
It 
	displays trees and members and 
	allows Add Tree and Add Members and
	has links to go the individual Tree pages
It is automatically loaded after a succesful login from the index.php page.
*/
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
	session_start();

//If the user is not logged in, redirect to index.php got login.
	if ($_SESSION['user_id']=='')
	{
		header("Location: index.php");
	}
	include_once("includes/dbc.php");
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

<!-- Load Jackfruit tree's id as the default tree into the hidden variable species_id.
This is done because the user may see the first selected tree as Jackfruit and 
click on Add Tree straight away. In which case JackFruit's id should be already loaded-->
<script type="text/javascript">
$().ready(function() {

document.getElementById('species_id').value='1161';

//alert("here");
/*	$("#tree_name").autocomplete("tree_rpc.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});

	 $("#tree_name").result(function(event, data, formatted) {
    $("#tree_name").text(data[0]);
	//$("#tree_name").val(data[0]);
	
      });*/
   	});
</script>

<!--
These are the functions that are needed for Add Tree.
-->
<script> 
	function toggleRowState(obj,state,rowNumber)
	{
		if(state == 'over')
		{
			obj.className= 'treeRowHover';
			document.getElementById('names'+rowNumber).style.display='none';
			document.getElementById('links'+rowNumber).style.display='';
		}
		else
		{
			obj.className= 'treeRow';
			document.getElementById('names'+rowNumber).style.display='';
			document.getElementById('links'+rowNumber).style.display='none';
		}
	}
	
	function showSubMenu(subId,subLengh)
	{
		for(i=1;i<=subLengh;i++)
		{
			document.getElementById('sub'+i).style.display='none';
			document.getElementById('li'+i).className='';
		}
		document.getElementById('li'+subId).className='selected';
		document.getElementById('sub'+subId).style.display='';
		showTreeInfo(subId,1,5,8);
	}
 
 	function showTreeInfo(subId1,subId2,subLengh1,subLengh2)
	{
		//alert("here"+subId1+subId2+subLengh1+subLengh2);
		for(i=1;i<=subLengh1;i++)
		{
			for(j=1;j<=subLengh2;j++)
			{
				
				document.getElementById('tree_'+i+'_'+j).style.visibility = 'hidden';
				if(i==subId1)
				{
					document.getElementById('sub'+i).getElementsByTagName("li")[j-1].getElementsByTagName("a")[0].className='';
				}
				//document.getElementById('li'+i).className='';
				//alert(i+"+"+j);
			}
		}
		//alert("out of for");
		//document.getElementById('li'+subId).className='selected';
		document.getElementById('tree_'+subId1+'_'+subId2).style.visibility = 'visible';
		document.getElementById('sub'+subId1).getElementsByTagName("li")[subId2-1].getElementsByTagName("a")[0].className='selected';
		document.getElementById('species_id').value=document.getElementById('sub'+subId1).getElementsByTagName("li")[subId2-1].value;
		//alert(document.getElementById('sub'+subId1).getElementsByTagName("li")[subId2-1].getElementsByTagName("a")[0].innerHTML);
		//alert(document.getElementById('tree_1_2').style.visibility);
	}
	
	function showContent(contentID,contentLength)
	{
		for(i=1;i<=contentLength;i++)
		{
			document.getElementById('content'+i).style.display='none';
			document.getElementById('subLnk'+i).className='';
		}
		document.getElementById('subLnk'+contentID).className='selected';
		document.getElementById('content'+contentID).style.display='';
	}

	function showNext(id)
	{
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set height and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(1000);
	}
	

</script>




<script type="text/javascript" src="js/jquery.min.js">
</script>

<!--
On submitting the form for Add Tree this code is executed.
It validates the data in the form and then submits the values
to tracktrees.php for adding the new tree.
-->
<script type="text/javascript" >
$(function() {
$(".submit1").click(function() {

var height;
height = document.getElementById("tree_height").value;
var girth;
girth = document.getElementById("tree_girth").value;
var distance;
distance = document.getElementById("distance_from_water").value;
var slope;
slope = document.getElementById("degree_of_slope").value;
var nick_name;
nick_name = document.getElementById("tree_nickname").value;


if (height != '' )
{
//alert("The value is "+height);
var numericExpression = /^\d+(\.\d{1,2})?$/;
	if(height.match(numericExpression) && (height>0 && height<=50)){
//	return true;
}
else{
		alert("tree height value should be Numeric & between 1 to 50");
		document.getElementById("tree_height").focus();
		return false;
}
} 

if(girth != '' )
{
//alert("Hello");
//alert("The value of girth is "+girth);
var numericnew= /^\d+(\.\d{1,2})?$/;
	if(girth.match(numericnew) && (girth>4 && girth<=10000)){
	//return true;
}
else{
		alert("tree girth value should be Numeric & between 5 to 10000");
		document.getElementById("tree_girth").focus();
		return false;
}
} 

if(distance != '' )
{
var numericdistance= /^[0-9]+$/;
	if(distance.match(numericdistance)){
	//return true;
}
else{
		alert("Distance value should be Numeric");
		document.getElementById("distance_from_water").focus();
		return false;
}
} 

if(slope != '' )
{
var numericslope= /^[0-9]+$/;
	if(distance.match(numericslope) && (slope>=0 && slope<=90))
{
}
else
{
alert("Slope value should be Numeric & between 0 to 90");
document.getElementById("degree_of_slope").focus();
return false;
}
} 

//alert("in validate2xx"+"xx"+nick_name+"yy");
for (i=0; i <= document.getElementById('nicknames').length - 1;i++)
{
if(nick_name == document.getElementById('nicknames')[i].text )
{
	alert("Nickname should be unique. Please change the nick name.");
	document.getElementById("tree_nickname").focus();
	return false;
}
}

if(nick_name == '' )
{
	alert("Please enter a nickname");
	document.getElementById("tree_nickname").focus();
	return false;
}

if($('#tree_code_sms').attr('value')=='')
{
	alert("Please choose the tree sequence number");
	document.getElementById("tree_code_sms").focus();
	return false;
}

	//var dataString = $("form").serialize();
	var dataString = "tree_nickname="+$('#tree_nickname').attr('value');
	dataString += "&location_type="+$('#location_type').attr('value');
	dataString += "&tree_height="+$('#tree_height').attr('value');
	dataString += "&tree_girth="+$('#tree_girth').attr('value');
	
	temp=$('input:radio[name=tree_damage]:checked').val();
	if (temp == undefined ) { temp='-1'; }
	dataString += "&tree_damage="+temp;
	
	temp=$('input:radio[name=is_fertilised]:checked').val();
	if (temp == undefined ) { temp='-1'; }
	dataString += "&is_fertilised="+temp;
	
	temp=$('input:radio[name=is_watered]:checked').val();
	if (temp == undefined ) { temp='-1'; }	
	dataString += "&is_watered="+temp;
	
	dataString += "&distance_from_water="+$('#distance_from_water').attr('value');
	dataString += "&degree_of_slope="+$('#degree_of_slope').attr('value');
	dataString += "&aspect="+$('#aspect').attr('value');
	dataString += "&other_notes="+$('#other_notes').attr('value');
	dataString += "&user_id=<?php echo $_SESSION['user_id']?>";
	dataString += "&species_id="+document.getElementById('species_id').value;
	dataString += "&tree_code_sms="+$('#tree_code_sms').attr('value');
	dataString += "&members_assigned=";
	j=0;
	for (i=0;i<=document.getElementById('member_num').value;i++)
	{
		if (document.getElementById('members_assigned'+i).checked)
		{
			if (j==0)
			{
				dataString += document.getElementById('members_assigned'+i).value;
			}
			else
			{
				dataString += ", "+document.getElementById('members_assigned'+i).value;			
			}
			j++;			
		}
	}
	if (j == 0)
	{
		alert("Please assign at least one user.");
		document.getElementById("members_assigned0").focus();
		return false;
	}	
	//alert(dataString);
	$.ajax({
	type: "POST",
	url: "tracktrees.php",
	data: dataString,
	success: function(data){
	//$('.success1').html(data);
	$('.success1').fadeIn(200).show();
	$('.error1').fadeOut(200).hide();
	window.setTimeout("$('#dialog_add_tree').fadeOut(1000);$('#mask').fadeOut(500);window.location.reload(true);", 2000);
	}
	});

return false;
});
});
</script>

<!--
On submitting the form for Add Member this code is executed.
It validates the data in the form and then submits the values
to addmember.php for adding the new member.
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
		if(document.getElementById("pwd").value == '' )
		{
			alert("Please enter a password for this user.");
			document.getElementById("pwd").focus();
			return false;
		}
		else if(document.getElementById("pwd").value != document.getElementById("pwd2").value )
		{
			alert("Re-entered password doesn't match. Please enter both again.");
			document.getElementById("pwd").value='';
			document.getElementById("pwd2").value='';
			document.getElementById("pwd").focus();
			return false;
		}
		alert("Please Note: Login username for this student will be\n<?php echo $_SESSION[coord_user_name]; ?>."+$('#user_name').attr('value')+"\n\n(student username format is: <coordinator id>.<student id>)");
		$('.success2').html("User <?php echo $_SESSION[coord_user_name]; ?>."+$('#user_name').attr('value')+" added");
		dataString += "&user_name=<?php echo $_SESSION[coord_user_name]; ?>."+$('#user_name').attr('value');		
	}
	else {
		dataString += "&user_name=";			
	}

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
	//alert(dataString);
	$.ajax({
	type: "POST",
	url: "addmember.php",
	data: dataString,
	success: function(data){
	//$('.success2').html(data);
	$('.success2').fadeIn(200).show();
	$('.error2').fadeOut(200).hide();
	window.setTimeout("$('#dialog_add_member').fadeOut(1000);$('#mask').fadeOut(500);window.location.reload(true);", 2000);
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
    	<a href="home.php"><img src="images/logo.png" alt="Seed" title="Seed" width="150" height="98" class="logo" /></a>
        <span><? echo $_SESSION['num_obs']; ?> updates this week / <? echo $_SESSION['num_trees']; ?> trees</span>		
        <img src="images/seasonWatch.jpg" alt="Season Watch" title="Season Watch" width="202" height="89" class="season" />
    </div>
    <!-- header ends -->
    
    <!-- content holder starts -->
    <div id="mainContentHolder" class="home">
    	
            <!-- User status starts -->
            <dl class="userStatus">
                <dt><? echo $_SESSION['school_name']; ?></dt>
                <dd>Welcome <? echo $_SESSION['full_name']; ?> | <a href="index.php?action=logout">LOGOUT</a></dd>
            </dl>
            <dl class="supportLinks">
                <dt>&nbsp;</dt>
                <dd><a href="#dialog3" name="modal">Download</a> | <a href="#dialog4" name="modal">Learn</a></dd>
            </dl>
			<dl class="userStatus">
			<?php 
			if ($_SESSION['pwd_change_required']==1) {
			?>
			<div class="message">
				<p><img src="images/exclamation.png" width="16" height="16" alt="Important" />Urgent notice: <a href=profileMember.php?user_id=<? echo $_SESSION['user_id']; ?>>Click here to change your password.</a></p>
			</div>
			<?php
			}
			?>
			</dl>
            <!-- User status ends -->
            
            
            <!-- Left block starts -->
            <div class="leftBlock">
                
                <!-- header starts -->
                <div class="leftHeader">
                	<h1>Our Trees <span class="msg">click on tree name  to &quot;Add Observations&quot;</span></h1>
                    <span><a href="#dialog_id_tree" title="" name="modal">ADD A TREE</a></span>
                </div>
                <!-- header ends -->
                
                <div class="clearBoth">&nbsp;</div>
                
				<?php
				//Select all trees for this user and display it as rows on the left side.
				$group_trees = mysql_query("SELECT tree_nickname, species_master.species_id, members_assigned, trees.tree_Id as tid, user_tree_id 
					FROM species_master 
					INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[user_id]') 
					ON species_master.species_id = trees.species_id ORDER BY species_master.species_id ASC");
			
				$i=0;
				while ($group_trees_row = mysql_fetch_array($group_trees)) 
				{
				
				//below query is to convert the members_assigned user_id to full_name
				$members_assigned_names='';
				
				if ($group_trees_row['members_assigned'])
					list($members_assigned_names)=mysql_fetch_row(mysql_query("SELECT group_concat(full_name separator ',') from users where user_id in ('$group_trees_row[members_assigned]')"));
				
				$i++;
				list($tree_code_sms)=mysql_fetch_row(mysql_query("SELECT tree_code_sms FROM user_tree_table WHERE tree_id='$group_trees_row[tid]' AND user_id='$_SESSION[user_id]'"));
				?>				
				
                <!--<div class="treeRow" onmouseover="toggleRowState(this,'over',<? echo $i; ?>)" onmouseout="toggleRowState(this,'out',<? echo $i; ?>)">-->
				<div class="treeRow">
                	<blockquote>
                    	<span><? echo $_SESSION['school_code_sms'].$tree_code_sms; ?><br /><a href="profileTree.php?tree_id=<?php echo $group_trees_row['tid']; ?>"><? echo $group_trees_row['tree_nickname']; ?></a></span>
						
						<?php
						$result = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='$group_trees_row[species_id]'");
						$image_names = mysql_fetch_array($result);
						if ($image_names !='')
						{
							$species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
							$th_picname=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
						?>
                        <img src="../<? echo $th_picname; ?>" alt=" "/>
						<?
						}
						?>
                    </blockquote>
                    <!--<small><img src="images/graphHome1.png" alt=" " width="303" height="59" /></small>-->
                    <p>
                    	<label id="names<? echo $i; ?>"><? echo $members_assigned_names; ?></label>
                        <span id="links<? echo $i; ?>" style="display:none;"><a href="#">EDIT</a><br /><a href="#">LOG</a></span>
                    </p>
                </div>
                
				<?php
				}
				?>
                
            </div>
            <!-- Left block ends -->
            
            
            <!-- Right block starts -->
            <div class="rightBlock">
                
                <!-- header starts -->
                <div class="rightHeader">
                	<h1>Students</h1>
					<?php
						if ($_SESSION['group_role']=='coord')
						{
					?>
							<span><a href="#dialog_add_member" name="modal">ADD STUDENT</a></span>
					<?php
						}
					?>
                </div>
                <!-- header ends -->
                
				
				<?php
				//Select all Members for this School group and display them as rows on the right side.
				$school_members = mysql_query("SELECT full_name, users.group_id, group_name, group_role, user_id FROM users INNER JOIN user_groups ON users.group_id=user_groups.group_id AND  users.group_id='$_SESSION[group_id]' ORDER BY user_id;");
				while ($row_settings = mysql_fetch_array($school_members)) 
				{				
				?>
				
                <dl class="memberList">
                	<dt><a href="profileMember.php?user_id=<? echo $row_settings['user_id']; ?>"><? echo $row_settings['full_name']; ?></a></dt><dd><? if ($row_settings['group_role']=='coord') echo "Coordinator"; else echo "&nbsp;";?></dd>
                </dl>
				
				<?php
				}
				?>
                
            </div>
            <!-- Right block ends -->
            
        
    </div>
    <!-- content holder ends -->
  <div class="footer">
    <p>
	<a href="http://ncbs.res.in"><img src="images/ncbs-logo.bmp" /></a>
	<a href="http://www.wiproeducation.com"><img src="images/WCC_Logo.png" /></a>
	<span>Design: <a href="http://www.bardo.in/" target="_blank">Bardo</a></span></p>
  </div>
        
</div>
<!-- Main Holder Ends -->
 
<!--MODAL Starts-->
<!-- 
This shows the dialog box for Add Tree.
There are two stages. First is where all the trees are shown categorised by leaf type.
The second stage shows a form with all Tree details like height, nickname etc to be entered for the new tree.
This part shows the first stage. It has 3 columns.
Column 1: the code for this is within the ul=mainSelection which basically shows icons for different leaf-types.
Column 2: the code for these are within div id=sub1, sub2 etc. This shows the tree names falling within each leaf-type.
Column 3: the code is within div id=tree_1_1, tree_1_2 etc. This shows the details (pic, info) for one tree.
-->
<div id="dialog_id_tree" class="window selectTreeModal">
 
	<h1>Select your tree</h1>
    
<!--    <div class="selectTreeInputBox"><INPUT class=txtInput type=text name="tree_name" id="tree_name" autocomplete="off" value="Type a tree name here" 
	onClick="document.getElementById('tree_name').value='';"></div>-->
    <div style="height:50px"></div>
    <!-- selection box starts -->
    <div class="selectionBox">
    	
        <blockquote id="content1">
       	<div id="tree_1_1" style="position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Artocarpus_heterophyllus.jpg" alt="Artocarpus heterophyllus" title="Jackfruit" width="178" height="218" /></dt>
                <dd>
                	<strong>Artocarpus heterophyllus</strong>
                    <em>M: Plavu, E: Jackfruit, Ta: Pilapalam, H: Katthal</em>
                    <span>
                    	This is a large tree that has the largest fruit in the world. It is native to the Western Ghats but is now cultivated inmany others parts of the country.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Dark green<br/>
                    15-25 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    Tiny
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    Ovoid<br />
                    Gigantic
                </dd>
            </dl>
			</div>
			<div id="tree_1_2" style="visibility: hidden;position:absolute;">
			<dl class="desc">
            	<dt><img src="images/Mimusops_elengi.jpg" alt="Mimusops elengi" title="Bulletwood" width="178" height="218" /></dt>
                <dd>
                	<strong>Mimusops elengi</strong>
                    <em>M: Elengi, E: Bulletwood, Ta: Magizham, H: Maulsari</em>
                    <span>
                    	The scientific name of this tree comes from its Malayalam name. The wood is extremely hard, the fruits are edible and oil is extracted from the seeds.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    5-15 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    White<br/>
                    1-2 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Orange-red<br/>
                    --<br />
                    ~3 cm
                </dd>
            </dl>
			</div>
			<div id="tree_1_3" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Neolamarckia_cadamba.jpg" alt="Neolamarchika cadamba" title="Katampu" width="178" height="218" /></dt>
                <dd>
                	<strong>Neolamarckia cadamba</strong>
                    <em>M: Katampu, E: Wild Chinchona, Ta: Vellaikatampu, H: Kadamb</em>
                    <span>
                    	The flowers of this tree are delicately scented, and are used in decoration and prayer. The fruits are eaten by birds, monkeys and bats.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    Up to 30 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Yellow-orange<br/>
                    Tiny
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Yellow<br/>
                    Round<br />
                    --
                </dd>
            </dl>

			</div>
			<div id="tree_1_4" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Syzygium_cumini.jpg" alt="Syzygium cumini" title="Njaval" width="178" height="218" /></dt>
                <dd>
                	<strong>Syzygium cumini</strong>
                    <em>M: Njaval E: Black plum, Ta: Neredam, H: Jamun</em>
                    <span>
                    	The delicious fruits of this tree stain your mouth black. The leaves, bark and seeds are used in traditional medicine; and the wood is used extensively in construction.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Reddish-brown<br/>
                    Green<br/>
                    7-15 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    White<br/>
                    Tiny
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Purple-black<br/>
                    Round<br />
                    1-5 cm
                </dd>
            </dl>


			</div>
			<div id="tree_1_5" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Ficus_racemosa.jpg" alt="Ficus racemosa" title="Atti" width="178" height="218" /></dt>
                <dd>
                	<strong>Ficus racemosa</strong>
                    <em>M: Atti, E: Country fig, Ta: Atti, H: Gular</em>
                    <span>
                    	This is a large fig tree, whose fruits are eaten by many birds and mammals. The bark is often pock-marked with dark "craters". The flowers are inside the fruits, as in all figs, and so cannot be seen from the outside.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    9-13 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    --<br/>
                    --
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Reddish<br/>
                    Round<br />
                    2-3 cm
                </dd>
            </dl>
			</div>
			<div id="tree_1_6" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Holoptelea_integrifolia.jpg" alt="Holoptelea integrifolia" title="Aaval" width="178" height="218" /></dt>
                <dd>
                	<strong>Holoptelea integrifolia</strong>
                    <em>M: Aaval, E: Indian Elm, Ta: Aya, H: Kanju</em>
                    <span>
                    	This is a very large tree, found across India. The wood is soft and light.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    8-15 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Greenish-brown<br/>
                    Tiny, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Brown<br/>
                    Flat, papery<br />
                    2 cm
                </dd>
            </dl>

			</div>
			<div id="tree_1_7" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Lagerstroemia_speciosa.jpg" alt="Lagerstroemia speciosa" title="Manimaruthu" width="178" height="218" /></dt>
                <dd>
                	<strong>Lagerstroemia speciosa</strong>
                    <em>M: Manimaruthu, E: Queen's flower, Pride of India, Ta: Kadali, H: Jarul</em>
                    <span>
			This is a very beautiful flowering tree with pink rose-like wrinkled flowers in large clusters. Maharashtra has honoured this tree by making its flower the state flower. 
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Pink<br/>
                    Green<br/>
                    Up to 26 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Pink<br/>
                    7cm, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Black<br/>
                    Round<br />
                    2 cm
                </dd>
            </dl>

			</div>
			<div id="tree_1_8" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Phyllanthus_emblica.jpg" alt="Phyllanthus emblica" title="Nelli" width="178" height="218" /></dt>
                <dd>
                	<strong>Phyllanthus emblica</strong>
                    <em>M: Nelli, E: Indian Gooseberry, Ta: Nelli, H: Amla</em>
                    <span>
                    	This tree grows wild in forests. The fruit has large quantities of vitamin C, and is famously sour in taste.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    8-12 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Pink/greenish<br/>
                    Small
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Yellow-green<br/>
                    Round<br />
                    2-4 cm
                </dd>
            </dl>

			</div>
			<div id="tree_2_1" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Ficus_religiosa.jpg" alt="Ficus religiosa" title="Arayal" width="178" height="218" /></dt>
                <dd>
                	<strong>Ficus religiosa</strong>
                    <em>M: Arayal, E: Bodhi tree, Ta: Ashvatham/Aracu, H: Pipal</em>
                    <span>
                    	This is a well-known tree across India. It is said that Gautama Buddha became enlightened meditating under one of these trees in Bodh Gaya in Bihar. It is a fig tree, and like all figs, you cannot see the flowers because they are inside the fruits.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Pinkish-green<br/>
                    Green<br/>
                    14 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    --<br/>
                    --
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Purple-black<br/>
                    Round<br />
                    1-1.5 cm
                </dd>
            </dl>
			</div>
			<div id="tree_2_2" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Mangifera_indica.jpg" alt="Mangifera indica" title="Maavu" width="178" height="218" /></dt>
                <dd>
                	<strong>Mangifera indica</strong>
                    <em>M: Maavu, E: Mango, Ta: Maanga, H: Aam</em>
                    <span>
                    	Who doesn't know the mango tree, famed in folk stories and for the flavour of its delectable fruit? There are many hundreds of varieties of mango in India.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Pink/purple<br/>
                    Deep green<br/>
                    --
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Yellowish-green<br/>
                    Tiny, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Yellow or red<br/>
                    Mango-shaped!<br />
                    --
                </dd>
            </dl>
			</div>
			<div id="tree_2_3" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Gmelina_arborea.jpg" alt="Gmelina arborea" title="Kumbil" width="178" height="218" /></dt>
                <dd>
                	<strong>Gmelina arborea</strong>
                    <em>M: Kumbil, E: Kashmir teak, Ta: Kumadi, H: Gamar</em>
                    <span>
                    	This tree is best known for its wood which is sometimes called "white teak".
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    10-38 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Yellow & brown<br/>
                    3-4 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Dark green<br/>
                    Yellow<br/>
                    --<br />
                    Up to 2.5 cm
                </dd>
            </dl>
			</div>
			<div id="tree_2_4" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Macaranga_peltata.jpg" alt="Macaranga peltata" title="Vatta/Uppila" width="178" height="218" /></dt>
                <dd>
                	<strong>Macaranga peltata</strong>
                    <em>M: Vatta/Uppila, E: Macaranga, Ta: Vattakkanni, H: Chandada</em>
                    <span>
                    	An easy way to identify the Chandada is to notice that the leaf stalks are attached on the underside of the leaf and not to the base of the leaf as in most other trees.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    12-21 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Yellowish-white<br/>
                    5-6 mm, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Yellowish<br/>
                    Round<br />
                    4-5 mm
                </dd>
            </dl>
			</div>
			<div id="tree_2_5" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Alstonia_scholaris.jpg" alt="Alstonia scholaris" title="Paala" width="178" height="218" /></dt>
                <dd>
                	<strong>Alstonia scholaris</strong>
                    <em>M: Paala/Ezhilampaala, E: Devil's tree, Ta: Mukumpalai, H: Saptaparni / Shaitan ka jhad</em>
                    <span>
                    	The name "scholaris" has come because in olden times the slates that chidren used were made from the soft wood of this tree. And the name "Devil's tree" in English and "shaitan ka jhad" in Hindi have probably come because this tree is shunned by animals because of its poisonous nature.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    Up to 24 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Greenish-white<br/>
                    Small, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    --<br/>
                    Long, thin<br />
                    Up to 40 cm
                </dd>
            </dl>
			</div>
			<div id="tree_2_6" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Madhuca_longifolia.jpg" alt="Madhuca longifolia" title="Ilippa" width="178" height="218" /></dt>
                <dd>
                	<strong>Madhuca longifolia</strong>
                    <em>M: Ilippa, E: Butter tree, Ta: Illupei, H: Mahua</em>
                    <span>
                    	In many parts of India this is considered to be a very valuable tree because it gives nutritious food for millions of poor people. The flowers are eaten raw and in a season a large tree can give 300 kg of flowers. The seeds give â??mahua butterâ?? that is used in cooking.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Pink<br/>
                    Dark green<br/>
                    13-25 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Creamy white<br/>
                    3-5 cm, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Orange<br/>
                    --<br />
                    2-5 cm
                </dd>
            </dl>
			</div>
			<div id="tree_2_7" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Tectona_grandis.jpg" alt="Tectona grandis" title="Thekku" width="178" height="218" /></dt>
                <dd>
                	<strong>Tectona grandis</strong>
                    <em>M: Thekku, E: Teak, Ta: Tekkumaram, H: Sagwan</em>
                    <span>
                    	The large tree is world famous for its beautiful, strong, durable wood.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    Very large
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    White<br/>
                    Tiny, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Greenish<br/>
                    Round, papery<br />
                    1-3 cm
                </dd>
            </dl>
			</div>
			<div id="tree_2_8" style="visibility: hidden;position:absolute;">
			2,8
			</div>
			<div id="tree_3_1" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Bauhinia_purpurea.jpg" alt="Bauhinia purpurea" title="Mandaram" width="178" height="218" /></dt>
                <dd>
                	<strong>Bauhinia purpurea</strong>
                    <em>M: Mandaram, E: Purple bauhinia, Ta: Nilattiruvatti, H: Kaniar</em>
                    <span>
                    	There are many types of Bauhinias and their leaves and flowers look similar. It is relatively easy to tell the Purple bauhinia apart because the petals in its flower do not overlap. The pods of this tree burst open with a loud sound and the seeds get scattered up to 6 m away. The outer covers of the pods become spiral shaped after the seeds are thrown out.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    15 cm, camel's hoof
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Pink/violet<br/>
                    5-8 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Brown<br/>
                    Long flat pod<br />
                    Up to 30 cm
                </dd>
            </dl>
			</div>
			<div id="tree_3_2" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Erythrina_indica.jpg" alt="Erythrina indica" title="Mullumurikku" width="178" height="218" /></dt>
                <dd>
                	<strong>Erythrina indica</strong>
                    <em>M: Mullumurikku, E: Indian coral tree, Ta: Mullumurukku, H: Pangra</em>
                    <span>
                    	A beautiful ornamental tree that is planted in gardens and parks, the flowers of this tree are bright red and striking. A variety of birds are visitors to the coral tree when it is in flower. The flowers appear when the tree is completely bare of leaves.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    ~20cm, trifoliate
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Brilliant red<br/>
                    4-5 cm, clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Black<br/>
                    Long, cylindrical<br />
                    Up to 30 cm
                </dd>
            </dl>
			</div>
			<div id="tree_3_3" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Aegle_marmelos.jpg" alt="Aegle marmelos" title="Koovalam" width="178" height="218" /></dt>
                <dd>
                	<strong>Aegle marmelos</strong>
                    <em>M: Koovalam, E: Wood apple, Ta: Vilvan, H: Bael</em>
                    <span>
                    	This is a very useful tree for various reasons. The tree is sacred to Hindus and the leaves are used in Shiva temples. Various parts of the tree are used for their tonic and antibiotic properties to cure a large range of ailments. The sweet pulp of the fruit is drunk as a refreshing sherbet. The leaves are used as fodder and the wood was used to create agricultural implements. 
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    Trifoliate
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green/white<br/>
                    Clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Yellow<br/>
                    Round, woody<br />
                    12-14 cm
                </dd>
            </dl>
			</div>
			<div id="tree_3_4" style="visibility: hidden;position:absolute;">
			3,4
			</div>
			<div id="tree_3_5" style="visibility: hidden;position:absolute;">
			3,5
			</div>
			<div id="tree_3_6" style="visibility: hidden;position:absolute;">
			3,6
			</div>
			<div id="tree_3_7" style="visibility: hidden;position:absolute;">
			3,7
			</div>
			<div id="tree_3_8" style="visibility: hidden;position:absolute;">
			3,8
			</div>
			<div id="tree_4_1" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Cassia_fistula.jpg" alt="Cassia fistula" title="Kanikonna" width="178" height="218" /></dt>
                <dd>
                	<strong>Cassia fistula</strong>
                    <em>M: Kanikonna, E: Indian laburnum, Ta: Konnei, H: Amaltas</em>
                    <span>
                    	This is the State flower of Kerala.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Brownish<br/>
                    Green<br/>
                    Up to 45 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Bright yellow<br/>
                    Clusters up to 60 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Brown-black<br/>
                    Long pipes<br />
                    Up to 60 cm
                </dd>
            </dl>
			</div>
			<div id="tree_4_2" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Pongamia_pinnata.jpg" alt="Pongamia pinnata" title="Ungu" width="178" height="218" /></dt>
                <dd>
                	<strong>Pongamia pinnata</strong>
                    <em>M: Ungu, E: Indian beech, Ta: Ponga, H: Karanj</em>
                    <span>
                    	The seeds, root, bark, leaves and flowers all have various uses in traditional medicine so this is a valuable tree. A reddish oil extracted from the seeds called karanj oil is used to light lamps or as a lubricant for engines.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Bright green<br/>
                    Dark green<br/>
                    ~20 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    White/pinkish<br/>
                    Clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Yellow or greyish brown<br/>
                    Flattened oval, woody<br />
                    ~5 cm
                </dd>
            </dl>
			</div>
			<div id="tree_4_3" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Saraca_asoca.jpg" alt="Saraca asoca" title="Ashokam" width="178" height="218" /></dt>
                <dd>
                	<strong>Saraca asoca</strong>
                    <em>M: Ashokam, E: True Ashok, Ta: Ashokam, H: Ashoka</em>
                    <span>
                    	 This evergreen tree is rated by some as one of India's most beautiful trees, with the orange-red flowers in bunches among the dense, dark leaves. It is said that Buddha was born under an Ashoka tree, so this tree is sacred to the Buddhists. Hindus also have many sacred associations with this tree.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Pinkish<br/>
                    Green<br/>
                    --
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Orange-red<br/>
                    Clustered
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Reddish<br/>
                    Black<br/>
                    Curved pod<br />
                    Up to 25 cm
                </dd>
            </dl>
			</div>
			<div id="tree_4_4" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Tamarindus_indica.jpg" alt="Tamarindus indica" title="Puli" width="178" height="218" /></dt>
                <dd>
                	<strong>Tamarindus indica</strong>
                    <em>M: Puli, E: Tamarind, Ta: Puli, H: Imli</em>
                    <span>
                    	This large tree with very small but dense leaves is believed to have come to India from East Africa many centuries ago. 
                        Today it is cultivated all over the warm parts of our country and appears like a local Indian tree.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Light green<br/>
                    Dark green<br/>
                    7-15 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Light pink<br/>
                    Pale yellow<br/>
                    ~15 mm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Brown<br/>
                    Flat & curved<br />
                    Up to 20 cm
                </dd>
            </dl>

			</div>
			<div id="tree_4_5" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Delonix_regia.jpg" alt="Delonix regia" title="Gulmohur" width="178" height="218" /></dt>
                <dd>
                	<strong>Delonix regia</strong>
                    <em>M: Gulmohur, E: Flame tree, Ta: Gulmohur, H: Gulmohur</em>
                    <span>
                    	This common tree of roadsides and avenues, with its beautiful flowers, is grown all over India, but is a native of the forests of Madagascar.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Dark green<br/>
                    --
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Bright red<br/>
                    Up to 12 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Brown/black<br/>
                    Flat long pods<br />
                    Up to 60 cm
                </dd>
            </dl>
			</div>
			<div id="tree_4_6" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Samanea_saman.jpg" alt="Samanea saman" title="Rain tree" width="178" height="218" /></dt>
                <dd>
                	<strong>Samanea saman</strong>
                    <em>M: Rain tree, E: Rain tree, Ta: Rain tree, H: Vilayati siris</em>
                    <span>
                    	The Rain Tree is a native of Central America and the West Indies, but it is widely cultivated throughout the tropics. It was introduced into India from Jamaica.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Light green<br/>
                    Dark green<br/>
                    --
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Pinkish red<br/>
                    --
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    --<br/>
                    Fleshy pod<br />
                    --
                </dd>
            </dl>
			</div>
			<div id="tree_4_7" style="visibility: hidden;position:absolute;">
			4,7
			</div>
			<div id="tree_4_8" style="visibility: hidden;position:absolute;">
			4,8
			</div>
			<div id="tree_5_1" style="visibility: hidden;position:absolute;">
            <dl class="desc">
            	<dt><img src="images/Bombax_ceiba.jpg" alt="Bombax ceiba" title="Mulilavu" width="178" height="218" /></dt>
                <dd>
                	<strong>Bombax ceiba</strong>
                    <em>M: Mulilavu, E: Red Silk Cotton, Ta: Mulilavu, H: Semul</em>
                    <span>
                    	This tree has branches coming out in all directions and has many levels at which these branches come out like the ribs of many umbrellas one on top of the other. The large flowers are pollinated by birds, and after they fall on the forest floor, are eaten with relish by wild animals. The woody fruit bursts open to release hundreds of seeds attached to sliky fibres, that are wafted away in the wind.
                    </span>
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Leaf</strong><br/>
                    Fresh<br/>
                    Mature<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Green<br/>
                    Up to 25 cm
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Flower</strong><br/>
                    Bud<br/>
                    Open<br/>
                    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	--<br/>
                    Red<br/>
                    Large
                </dd>
            </dl>
            
            <dl class="prop">
            	<dt>
                	<strong>Fruit</strong><br/>
                    Unripe<br/>
                    Ripe<br/>
                    Shape<br/>
		    Size
                </dt>
                <dd>
                	&nbsp;<br/>
                	Green<br/>
                    Brown<br/>
                    Woody capsule<br />
                    Up to 18 cm
                </dd>
            </dl>

			</div>
			<div id="tree_5_2" style="visibility: hidden;position:absolute;">
			5,2
			</div>
			<div id="tree_5_3" style="visibility: hidden;position:absolute;">
			5,3
			</div>
			<div id="tree_5_4" style="visibility: hidden;position:absolute;">
			5,4
			</div>
			<div id="tree_5_5" style="visibility: hidden;position:absolute;">
			5,5
			</div>
			<div id="tree_5_6" style="visibility: hidden;position:absolute;">
			5,6
			</div>
			<div id="tree_5_7" style="visibility: hidden;position:absolute;">
			5,7
			</div>
			<div id="tree_5_8" style="visibility: hidden;position:absolute;">
			5,8
			</div>
        </blockquote>
        
        <ul id="sub1" class="subSelection">
        	<li value="1161"><a href="#" id="sub_1_1" onclick="showTreeInfo(1,1,5,8)"  class="selected">PLAVU</a></li>
            <li value="1054"><a href="#"  id="sub_1_2" onclick="showTreeInfo(1,2,5,8)">ELENGI</a></li>
            <li value="1058"><a href="#" id="sub_1_3" onclick="showTreeInfo(1,3,5,8)">KATAMPU</a></li>
            <li value="1079"><a href="#" id="sub_1_4" onclick="showTreeInfo(1,4,5,8)">NJAVAL</a></li>
            <li value="1036"><a href="#" id="sub_1_5" onclick="showTreeInfo(1,5,5,8)">ATTI</a></li>
            <li value="1041"><a href="#" id="sub_1_6" onclick="showTreeInfo(1,6,5,8)">AAVAL</a></li>
            <li value="1045"><a href="#" id="sub_1_7" onclick="showTreeInfo(1,7,5,8)">MANIMARUTHU</a></li>
            <li value="1063"><a href="#" id="sub_1_8" onclick="showTreeInfo(1,8,5,8)">NELLI</a></li>
        </ul>
        
        <ul id="sub2" class="subSelection" style="display:none;">
        	<li value="1037"><a href="#" id="sub_2_1" onclick="showTreeInfo(2,1,5,8)">ARAYAL</a></li>
            <li value="1090"><a href="#" id="sub_2_2" onclick="showTreeInfo(2,2,5,8)">MAAVU</a></li>
            <li value="1040"><a href="#" id="sub_2_3" onclick="showTreeInfo(2,3,5,8)">KUMBIL</a></li>
            <li value="1047"><a href="#" id="sub_2_4" onclick="showTreeInfo(2,4,5,8)">VATTA/UPPILA</a></li>
            <li value="1008"><a href="#" id="sub_2_5" onclick="showTreeInfo(2,5,5,8)">PAALA</a></li>
            <li value="1048"><a href="#" id="sub_2_6" onclick="showTreeInfo(2,6,5,8)">ILIPPA</a></li>
            <li value="1082"><a href="#" id="sub_2_7" onclick="showTreeInfo(2,7,5,8)">THEKKU</a></li>
			<li><a href="#" id="sub_2_8"></a></li>
        </ul>
        
		<ul id="sub3" class="subSelection" style="display:none;">
        	<li value="1012"><a href="#"  id="sub_3_1" onclick="showTreeInfo(3,1,5,8)" class="selected">MANDARAM</a></li>
            <li value="1034"><a href="#"  id="sub_3_2" onclick="showTreeInfo(3,2,5,8)">MULLUMURIKKU</a></li>
            <li value="1002"><a href="#"  id="sub_3_3" onclick="showTreeInfo(3,3,5,8)">KOOVALAM</a></li>
			<li><a href="#" id="sub_3_4"></a></li>
			<li><a href="#" id="sub_3_5"></a></li>
			<li><a href="#" id="sub_3_6"></a></li>
			<li><a href="#" id="sub_3_7"></a></li>
			<li><a href="#" id="sub_3_8"></a></li>
        </ul>
		
		<ul id="sub4" class="subSelection" style="display:none;">
        	<li value="1020"><a href="#" id="sub_4_1" onclick="showTreeInfo(4,1,5,8)" class="selected">KANIKONNA</a></li>
            <li value="1066"><a href="#" id="sub_4_2" onclick="showTreeInfo(4,2,5,8)">UNGU</a></li>
            <li value="1074"><a href="#" id="sub_4_3" onclick="showTreeInfo(4,3,5,8)">ASHOKAM</a></li>
            <li value="1081"><a href="#" id="sub_4_4" onclick="showTreeInfo(4,4,5,8)">PULI</a></li>
            <li value="1030"><a href="#" id="sub_4_5" onclick="showTreeInfo(4,5,5,8)">GULMOHUR</a></li>
            <li value="1162"><a href="#" id="sub_4_6" onclick="showTreeInfo(4,6,5,8)">RAIN TREE</a></li>
			<li><a href="#" id="sub_4_7"></a></li>
			<li><a href="#" id="sub_4_8"></a></li>
        </ul>
		
		<ul id="sub5" class="subSelection" style="display:none;">
        	<li value="1015"><a href="#" id="sub_5_1" onclick="showTreeInfo(5,1,5,8)" class="selected">MULILAVU</a></li>
			<li><a href="#" id="sub_5_2"></a></li>
			<li><a href="#" id="sub_5_3"></a></li>
			<li><a href="#" id="sub_5_4"></a></li>
			<li><a href="#" id="sub_5_5"></a></li>
			<li><a href="#" id="sub_5_6"></a></li>
			<li><a href="#" id="sub_5_7"></a></li>
			<li><a href="#" id="sub_5_8"></a></li>
        </ul>
		<input type="hidden" id="species_id" value="">
        <ul class="mainSelection">
        	<li><a href="javascript:void(0)" id="li1" class="selected"	onclick="showSubMenu(1,5);" onmouseover="simmid.src='images/Simple-middle-selected.png'" onmouseout="simmid.src='images/Simple-middle.png'"><img src="images/Simple-middle.png" alt=" " name="simmid" width="103" height="73" /></a></li>
            <li><a href="javascript:void(0)" id="li2" 					onclick="showSubMenu(2,5);" onmouseover="simba.src='images/Simple-base-apex-selected.png'" onmouseout="simba.src='images/Simple-base-apex.png'"><img src="images/Simple-base-apex.png" alt=" " name="simba" width="103" height="73" /></a></li>
            <li><a href="javascript:void(0)" id="li3" 					onclick="showSubMenu(3,5);" onmouseover="comp23.src='images/Compound-2or3leaflets-selected.png'" onmouseout="comp23.src='images/Compound-2or3leaflets.png'"><img src="images/Compound-2or3leaflets.png" alt=" " name="comp23" width="103" height="73" /></a></li>
            <li><a href="javascript:void(0)" id="li4" 					onclick="showSubMenu(4,5);" onmouseover="comppinn.src='images/Compound-pinnate-selected.png'" onmouseout="comppinn.src='images/Compound-pinnate.png'"><img src="images/Compound-pinnate.png" alt=" " name="comppinn" width="103" height="73" /></a></li>
            <li><a href="javascript:void(0)" id="li5" 					onclick="showSubMenu(5,5);" onmouseover="comppalm.src='images/Compound-palmate-selected.png'" onmouseout="comppalm.src='images/Compound-palmate.png'"><img src="images/Compound-palmate.png" alt=" " name="comppalm" width="103" height="73" /></a></li>
        </ul>       
    </div>
    <!-- selection box ends -->
    
    <p>
    	<input name="" type="button" value="Add Tree" onClick="$('#dialog_id_tree').hide();showNext('#dialog_add_tree');" />
		<input name="" type="button" class="close" value="CANCEL" />
    </p>
</div>
<!--MODAL Ends-->
<!-- On submitting the above dialog box, the one below is loaded for bringing up Stage 2 of Add Tree.-->
 
<!--MODAL Starts-->
<!--
This dialog box displays a form to capture all details of the new tree like nickname, height etc.
-->

<!-- Make sure that this and id=dialog_add_tree in profileTree.php are always in sync-->
<div id="dialog_add_tree" class="window addTreeModal">
 
    <h1>Enter Tree Details</h1>
		&nbsp;&nbsp;&nbsp;&nbsp;Fields marked with <font color="red">*</font> are compulsory.	
			<?php
			$sql = mysql_query("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[user_id]'");
			echo "<select name='nicknames' id='nicknames' style='visibility:hidden;'>";
			while($row=mysql_fetch_array($sql))
			{
			echo "<option>".$row['tree_nickname']."</option>";
			}
			echo "</select>";
			?>
	
	<form name="add_tree" id="add_tree" method="POST" action="">
	<input type="hidden" id="species_id" value="<? echo $species_id; ?>" />
    <blockquote class="border">

	    <dl>
        	<dt>Nickname<font color="#CC0000">*</font></dt>
            <dd><div><input id="tree_nickname" type="text"/></div>
			<a href="#" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees (e.g. “Home_Neem” from “Street_Neem”) later at the time of adding observations.">(?)</a>
			</dd>
        </dl>
<?php
$tree_code_sms_data=mysql_query("SELECT tree_code_sms FROM user_tree_table WHERE user_id='$_SESSION[user_id]'");
$tree_code_sms_values= array(
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0
);
while(list($tree_code_sms_val)=mysql_fetch_row($tree_code_sms_data))
{
	$tree_code_sms_values[intval($tree_code_sms_val)-1]=1;
}
//print_r($tree_code_sms_values);
?>
	    <dl>
        	<dt>Tree Sequence No.<font color="#CC0000">*</font></dt>
            <dd><div>
			<select id="tree_code_sms"/>
			<option id="Choose" value="">-- Choose --</option>
			<?php
				$i=1;
				while($i<=300) {
				if(!$tree_code_sms_values[$i-1])
				{
					if ($i<10)
					{
						$tree_code_sms="00".strval($i);
					}
					else if ($i<100)
					{
						$tree_code_sms="0".strval($i);
					}
					else
					{
						$tree_code_sms=strval($i);
					}
					echo "<option id=".$tree_code_sms." value=".$tree_code_sms.">" . $tree_code_sms . "</option>";
				}
				$i +=1;
				}
			?>
			</select>
			</div>
			<a href="#" title="Please give all your trees a unique sequence number  (e.g. 001, 002). This will help you identify the tree later while using SMS etc.">(?)</a>
			</dd>
        </dl>		
        <dl>
        	<dt>Location type</dt>
            <dd><div><select id="location_type">
				<option id="Choose" value="Choose">-- Choose --</option>
				<option id="Garden/Park" value="Garden/Park">Garden/Park</option>
				<option id="Avenue" value="Avenue">Avenue</option>
				<option id="Forest" value="Forest">Forest</option>
				<option id="Campus" value="Campus">Campus</option>
				<option id="Marsh" value="Marsh">Marsh</option>
				<option id="Grassland" value="Grassland">Grassland</option>
				<option id="Plantation" value="Plantation">Plantation</option>
				<option id="Farmland" value="Farmland">Farmland</option>
				<option id="Other" value="Other">Other</option>
			</select></div></dd>
        </dl>
        <dl>
        	<dt>Height (in m)</dt>
            <dd><div><input id="tree_height" type="text" /></div>
			<a href="#" title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured).">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Girth (in cm)</dt>
            <dd><div><input id="tree_girth" type="text" /></div>
			<a href="#" title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler.">(?)</a>
			</dd>
        </dl>
        
        
        <dl class="extraTopPadding">
        	<dt>Damaged?</dt>
            <dd>
				<input type="radio" class="radio" name="tree_damage" value="1" /> Yes
				&nbsp;
				<input type="radio" class="radio" name="tree_damage" value="0" /> No
				<a href="#" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Fertilized?</dt>
            <dd>
				<input type="radio" class="radio" name="is_fertilised" value="1" /> Yes
				&nbsp;
				<input type="radio" class="radio" name="is_fertilised" value="0" /> No
				<a href="#" title="Many trees in parks, gardens and campuses are regularly fertilized – this affects the phenology of the tree and therefore must be noted.">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Watered?</dt>
            <dd>
				<input type="radio" class="radio" name="is_watered" value="1" /> Yes
				&nbsp;
				<input type="radio" class="radio" name="is_watered" value="0" /> No
				<a href="#" title="Many trees in parks, gardens and campuses are regularly watered – this affects the phenology of the tree and therefore must be noted.">(?)</a>
			</dd>
        </dl>
        
        
        <dl class="extraTopPadding">
        	<dt>Distance from Water (m)</dt>
            <dd><div><input type="text" id="distance_from_water" id="distance_from_water" style="width:200px;"></div>
			<a href="#" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Degree of slope(°)</dt>
            <dd><div><input type="text" id="degree_of_slope" id="degree_of_slope" style="width:200px;"></div>
			<a href="#" title="If your plant is on a hill, try to note the incline of the slope in degree by visual estimation (e.g. slope of 20°). ">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Aspect</dt>
            <dd><div><select id="aspect" id="aspect">
				<option value="">Choose one</option>
				<option id="North" value="North">North</option>
				<option id="NorthEast" value="NorthEast">North-East</option>
				<option id="East" value="East">East</option>
				<option id="SouthEast" value="SouthEast">South-East</option>
				<option id="South" value="South">South</option>
				<option id="SouthWest" value="SouthWest">South-West</option>
				<option id="West" value="West">West</option>
				<option id="NorthWest" value="NorthWest">North-West</option>
				</select></div>
			<a href="#" title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">(?)</a>
			</dd>
        </dl>
        
    </blockquote>
    <blockquote>
    	<strong>Other notes (description of tree, location, etc)</strong>
        <p><textarea id="other_notes" cols="" rows=""></textarea></p>
		<div style="width:325px; height:150px; overflow:auto;">
		<table>
		<th colspan=6>
		Assign students<font color="red">*</font>
		</th>
			<?php
				$school_members = mysql_query("SELECT full_name, users.group_id, group_name, group_role, user_id FROM users INNER JOIN user_groups ON users.group_id=user_groups.group_id AND  users.group_id='$_SESSION[group_id]' ORDER BY user_id;");
				$i=0;
				while ($row_settings = mysql_fetch_array($school_members)) 
				{				
					if ($i % 3 == 0) { 
						echo "<tr>";
					}
			?>
				
					<td width="8%"><input type="checkbox" align="RIGHT" name="members_assigned<? echo $i; ?>" id="members_assigned<? echo $i; ?>" value="<? echo $row_settings['user_id']; ?>"/>
					</td>
					<td width="25%"><a href="#"><? echo $row_settings['full_name']; ?></a></td>					
			<?php
					$i++;
					if ($i % 3 == 0) { 
						echo "</tr>";
					}
				}
			?>
			<input type="hidden" id="member_num" value="<? echo $i-1; ?>" />
		</table>
		</div>
    </blockquote>
    
    <span>
    	<input name="" type="submit" value="OK" class="submit1" /> 
		<!--<input name="" type="Submit" value="OK" onClick="$('#dialog_add_tree').hide();showNext('#dialog2');" />-->
		<input name="" type="button" class="close" value="CANCEL" />
		<span class="success1" style="display:none">Your tree has been added successfully.</span>
		<span class="error1" style="display:none"> Tree not added. Please Re-enter all data and try again.</span>
    </span>
	</form>
	
    <div class="tooltip" id="tooltip" style="display:none;">
    	<img src="images/tooltipBgTop.jpg" alt=" " width="254" height="7" class="floatLeft" />
        <small>
        	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy
        </small>
        <img src="images/tooltipBgBottom.jpg" alt=" " width="254" height="7" class="floatLeft" />
    </div>
    
</div>
<!--MODAL Ends-->
 
<!--MODAL Starts-->
<!--
This dialog box displays a form to capture details required to add a new member.
-->


<!-- Make sure that this and id=dialog_add_member in profileMember.php are always in sync-->
<div id="dialog_add_member" class="window addMemberModal">
 
    <h1>Add New Student</h1>
	&nbsp;&nbsp;&nbsp;&nbsp;Fields marked with <font color="red">*</font> are compulsory.	
	<?php
			$sql = mysql_query("SELECT user_name FROM users 
										WHERE group_id='$_SESSION[group_id]'");
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
			
	<form name="add_member" id="add_member" method="POST" action="">
    <blockquote class="border">
    	
        <dl>
        	<dt>Student name<font color="#CC0000">*</font></dt>
            <dd><div><input id="full_name" type="text" /></div>
			</dd>
        </dl>
        <dl>
        	<dt>Class (eg: 9B)</dt>
            <dd><div><input id="group_class" type="text" /></div>
			</dd>
        </dl>		
        <dl>
        	<dt>Username</dt>
            <dd><div><input id="user_name" type="text" /></div>
			</dd>
        </dl>
        <dl>
        	<dt>Password</dt>
            <dd><div><input id="pwd" type="password" /></div>
			</dd>
        </dl>	
        <dl>
        	<dt>Re-enter Password</dt>
            <dd><div><input id="pwd2" type="password" /></div>
			</dd>
        </dl>			
		<?php
		$i=0;
		if (mysql_num_rows($group_trees))
		{
		?>
		<div style="width:325px; height:150px; overflow:auto;">	
		<table >
		<th colspan=6>
		Assign trees
		</th>
			<?php
				//$trees = mysql_query("SELECT full_name, users.group_id, group_name, group_role FROM users INNER JOIN user_groups ON users.group_id=user_groups.group_id AND  users.group_id='$_SESSION[group_id]' ORDER BY user_id;");

				mysql_data_seek($group_trees, 0);
				while ($group_trees_row = mysql_fetch_array($group_trees)) 
				{				
					if ($i % 3 == 0) { 
						echo "<tr>";
					}
			?>
				
					<td width="8%"><input type="checkbox" name="trees_assigned<? echo $i; ?>" 
					id="trees_assigned<? echo $i; ?>" value="<? echo $group_trees_row['user_tree_id']; ?>"/></td>
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
		<span class="success2" style="display:none">User added</span>
		<span class="error2" style="display:none"> User not added. Please try again.</span>
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
    	<li><strong>Part 1</strong> - plavu, elenji, katampu, njaval, atti (English, Microsoft Excel file, 1.1 MB) - <a href="downloads/SeedSWTreeDetails1.xlsx">download</a></li>
        <li><strong>Part 2</strong> - aaval, manimaruthu, nelli, arayal, maavu (English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails2.xlsx">download</a></li>
        <li><strong>Part 3</strong> - kumbil, vatta, paala, ilippa, thekku (English, Microsoft Excel file, 1.5 MB) - <a href="downloads/SeedSWTreeDetails3.xlsx">download</a></li>
        <li><strong>Part 4</strong> - mandaram, mullumurikku, koovalam, kanikonna, ungu (English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails4.xlsx">download</a></li>
        <li><strong>Part 5</strong> - ashokam, puli, gulmohur, mazhamaram, mullilavu (English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails5.xlsx">download</a></li>
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