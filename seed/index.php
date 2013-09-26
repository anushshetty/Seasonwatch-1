<?php
/*
This is the default page loaded. It displays from info and allows the user to login.
Once a user has successfully logged in, the session is loaded with details like
user_id, user_name etc and then the user is redirected to home.php	
*/
	include_once("includes/dbc.php");
	session_start();

	if ($_GET['action']=='logout')
	{
		$_SESSION['user_id']= '';  
	}
	if ($_POST['submit'])
	{
		//if	($_POST['school_name']!="" && $_POST['username']!="" && $_POST['pwd']!="")
		if	($_POST['username']!="" && $_POST['pwd']!="")
		{
			$username = mysql_real_escape_string($_POST['username']);
			//$schoolname = mysql_real_escape_string($_POST['school_name']);
			$md5pass = md5(mysql_real_escape_string($_POST['pwd']));


			/*$sql = "SELECT `user_id`,`full_name`,`user_category`,`users`.`group_id`,`group_role`  FROM users, user_groups WHERE 
					   users.group_id=user_groups.group_id AND user_name='$username' AND group_name='$schoolname'
						AND `pwd` = '$md5pass'
						"; */
			$sql = "SELECT `user_id`,`full_name`,`user_category`,`users`.`group_id`,`group_role`,`user_name`,`pwd`   FROM users, user_groups WHERE 
					   users.group_id=user_groups.group_id AND user_name='$username' AND `pwd` = '$md5pass'
						"; 
						
			$result = mysql_query($sql) or die (mysql_error()); 
			$num = mysql_num_rows($result);
			  // Match row found with more than 1 results  - the user is authenticated. 
				if ( $num > 0 ) { 
				
				list($user_id,$full_name,$user_category,$group_id,$group_role, $user_name, $pwd) = mysql_fetch_row($result);
				
				//if(!$approved) {
				//$msg = "Account not activated. Please check your email for activation code";
				//header("Location: login.php?msg=$msg");
				// exit();
				// }
			 
				 // this sets session and logs user in  
				   
				   session_start(); 
				   // this sets variables in the session 
					$_SESSION['user_id']= $user_id;  
					$_SESSION['user_name'] = $user_name;
					$_SESSION['full_name'] = $full_name;
					if ($pwd==md5("12345")) {$_SESSION['pwd_change_required']=1;} else { $_SESSION['pwd_change_required']=0;};
					
					//set a cookie witout expiry until 60 days
					
				   if(isset($_POST['remember'])){
							  setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*60, "/");
							  setcookie("full_name", $_SESSION['full_name'], time()+60*60*24*60, "/");
							   }
					
						if ($user_category=='school-seed') {
							$sql = "SELECT `group_name`,`school_code_sms`  FROM user_groups WHERE 
									`group_id` = '$group_id'
									"; 
							$result2 = mysql_query($sql) or die (mysql_error()); 
							list($group_name,$school_code_sms) = mysql_fetch_row($result2);
							$_SESSION['school_name'] = $group_name;
							$_SESSION['school_code_sms'] = $school_code_sms;
							$_SESSION['group_id'] = $group_id;
							$_SESSION['group_role'] = $group_role;
							$sql3 = "SELECT `user_name`  FROM users WHERE 
									`group_id` = '$group_id' AND `group_role`='coord'
									"; 
							$result3 = mysql_query($sql3) or die (mysql_error()); 
							list($coord_user_name) = mysql_fetch_row($result3);
							$_SESSION['coord_user_name'] = $coord_user_name;
							
							header("Location: home.php");
						}
					}
					else
					{
					$msg = urlencode("		Invalid username or password. Please re-enter.");
					header("Location: index.php?msg=$msg");
					}
		
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>Seed</TITLE>
<META content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="css/css.css">

<!--[if lte IE 6]>
	<script type="text/javascript" src="js/supersleight-min.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript" src="js/initiate.js"></script>
<script src="js/ac/jquery.autocomplete.js" type="text/javascript"></script>
<!--<script src="../beta/js/jquery/ac/jquery.js" type="text/javascript"></script>
<script src="../beta/js/jquery/ac/jquery.bgiframe.min.js" type="text/javascript"></script>-->
<!--<script type="text/javascript">
//alert(typeof autocomplete);
$().ready(function() {
	$("#school_name").autocomplete("school_rpc.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});

	 $("#school_name").result(function(event, data, formatted) {
    $("#school_name").text(data[1]);
	$("#school_name").val(data[0]);
      });
   	});
</script>-->

<!--for emptyonclick-->
<script type="text/javascript" src="js/jquery.emptyonclick.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.emptyonclick').emptyonclick();
});
</script>

<script type="text/javascript">
function validatebox(firstform)
{
/*if((document.school_search_form.school_name.value == "Type your school name")||(document.school_search_form.school_name.value == ""))
{
alert("Please type your school name");
document.school_search_form.school_name.focus();
return false;
}*/
if(document.school_search_form.username.value == "")
{
alert("Please type your user name");
document.school_search_form.username.focus();
return false;
}
if(document.school_search_form.pwd.value == "")
{
alert("Please type your password");
document.school_search_form.pwd.focus();
return false;
}
return true;
}
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

</HEAD>
<BODY><!-- Main Holder Starts -->
<DIV id=mainHolder> <!-- header starts -->
<DIV id=homeHeader><A 
href="home.php"><IMG 
class=logo title=Seed alt=Seed src="images/logo.png" width=150 
height=98></A> 

<?php
$end_date=date('Y-m-d');
$m= date("m"); // Month value
$de= date("d")-7; //today's date
$y= date("Y"); // Year value
$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
$num_updates = mysql_query("SELECT count(observation_id) as num_obs  FROM user_tree_observations 
							WHERE date>='".$start_date . "' AND date<='" . $end_date . "';");
$row_num_updates = mysql_fetch_array($num_updates);
$num_trees = mysql_query("SELECT count(tree_Id) as num_trees  FROM trees;");
$row_num_trees = mysql_fetch_array($num_trees);
$_SESSION['num_obs']=$row_num_updates['num_obs'];
$_SESSION['num_trees']=$row_num_trees['num_trees'];
?>

<SPAN><? echo $row_num_updates['num_obs']; ?> updates this week / <? echo $row_num_trees['num_trees']; ?> trees</SPAN> <IMG 
class=season title="Season Watch" alt="Season Watch" 
src="images/seasonWatch.jpg" width=202 height=89> </DIV><!-- header ends --><!-- content holder starts -->
<DIV id=mainContentHolder class=login>

<form name="school_search_form" action="index.php" method="POST" autocomplete="off" onSubmit="return validatebox();">
<DIV>
<!--<div class="message"><p>Dear SEED Coordinator: Thank you for visiting. <br/>You can use this website from 26/11 onwards.</p></div>-->
<!--<DL>
  <DT>School</DT>
  <DD><INPUT class=txtInput type=text name="school_name" id="school_name" class="emptyonclick" autocomplete="off" 
  value="Type your school name" onClick="document.school_search_form.school_name.value='';"></DD></DL>-->
<DL>
  <DT>Username</DT>
  <DD><INPUT class=txtInput type=text name="username" id="username"></DD></DL>
<DL>
  <DT>Password</DT>
  <DD><INPUT class=txtInput type=password name="pwd" id="pwd"><br/>
  <font size=-2>Forgotten your password?<br/>Please email your SEED userid to the email id below</font></DD></DL>
<DL>
  <DT>

  <font color="red"><? echo $_GET['msg']; ?></font>

</DT>
  <DD><INPUT class=loginButton value=LOGIN type=submit name="submit"></DD></DL>

<p>
    <a href="#dialog4" name="modal"><strong>Learn</strong> more about <em><strong>SeasonWatch</strong></em></a>
</p>  
<div class="message"><P>Username is same as your Mathrubhumi SEED user id. Password is: 12345
<br /><br />SeasonWatch contact details:<br/>
<img src=images/sw-id.jpg>
</P>
</DIV>
<div class="message">
    <h3>&nbsp; Downloads</h3>
       <h4>&nbsp; Presentations:</h4>
        &nbsp;1.Audio-Visual Presentation <a href="../downloads/SWSEEDPresentation.zip" >(download. 29.9 MB)</a>
       <br>
        <h4>&nbsp; HandBooks:</h4>
        &nbsp;1.SeasonWatch Handbook(Eng)<a href="../downloads/SW_HandBook.pdf" target=_blank>(download 17.0 MB)</a></br>
	&nbsp;2.SeasonWatch Handbook(Mal)<a href="../downloads/Handbook_Malayalam.pdf" target=_blank>(download 14.0 MB)</a></br>
        &nbsp;3.Observation & Reporting Format<a href="../downloads/SeasonWatchObservationsFormat13-14.xls" target=_blank>(download 19.0 KB)</a> </br>
 </div>
</DIV>

</form>

<BLOCKQUOTE>
  <H1>Seasonwatch</H1>
  <P >This is the website of the SEED chapter of SeasonWatch,
brought to Kerala schools in partnership with Mathrubhumi SEED</P>
	<P><img src="images/Amaltas_Hyderabad_W_IMG_7137.jpg" align="right" title="Photograph by J. M. Garg"/>Every year, trees across Kerala (and across India) signal the changing seasons by their flowering and fruiting.</P>
	<P>As the months tick by, wave after wave of trees of different kinds produce tender leaves that gradually mature; delicate buds slowly open into flowers whose colour and fragrance attract butterflies and bees; and small unripe fruit eventually ripen into a delicious meal for birds, squirrels and monkeys – and humans too!</P>
	<P>In partnership with the <a href="http://www.mbiseed.com" target=_blank>Mathrubhumi SEED programme</a>, SeasonWatch asks SEED schools to monitor the changing seasons by monitoring the leafing, flowering and fruiting of trees.</P>
	<P>If you are the SEED coordinator for your school, you can log in here to register the trees your children are monitoring and to upload observations of leaves, flowers and fruits.</P>
	<P>If you are not visiting this page as a SEED coordinator, please go to the <a href="http://www.seasonwatch.in/">main SeasonWatch website</a>.</P>
</P>
</BLOCKQUOTE>
  </DIV><!-- content holder ends -->
    <div class="footer">
    <p><a href="http://ncbs.res.in"><img src="images/ncbs-logo.bmp" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="http://www.wiproeducation.com"><img src="images/WCC_Logo.png" /></a></p>
  </div>
  </DIV><!-- Main Holder Ends -->
  
  
 
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
  
  </BODY></HTML>

<?php
?>