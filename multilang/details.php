<?php 
/*Initial Development :- This page will be displayed once user clicks on details link.*/
	ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    session_start();
    //include_once("includes/dbcon.php");
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    
   
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SeasonWatch</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<!-- script type="text/javascript" src="js/jquery-1.7.2.min.js"></script-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/googletrack.js"></script>
<script type="text/javascript" src="js/loginfunction.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  // Code using $ as usual goes here.
  //The DOM is now loaded and can be manipulated.
});
</script>
</head>
<?php 
 if(isset($_SESSION['userid']) &&  !(isset($_SESSION['rememberMe'])))
 {
 	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
 	// and you have not checked the rememberMe checkbox:
 
 	$_SESSION = array();
 	//session_destroy();
 
 	// Destroy the session
 }
 
 
 if(isset($_GET['logoff']))
 {
 	$_SESSION = array();
 	session_destroy();
 
 	header("Location: index.php");
 	exit;
 }
 
 
 if(isset($_POST['LOGIN']))
 {
 
 	$username=Login::sanitize($_REQUEST['login_name']);
 	$password= md5(Login::sanitize($_REQUEST['login_pass']));
 	$rememberme=0;
 	if(isset($_REQUEST['remember'])) $rememberme=1;
 	$no_md5_password = Login::sanitize($_REQUEST['login_pass']);
 
 	$res_text=checkLogin($username, $password,$no_md5_password, $rememberme);
 	//echo $res_text;
 	$pos = strpos($res_text, "success");
 	if ($pos === false) {
 		//echo "The string '$findme' was not found in the string '$mystring'";
 
 		$_SESSION['msg']['login-err'] = $res_text;
 		echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                          document.getElementById('light').style.display='block';
		                  	document.getElementById('fade').style.display='block';
    	    				});
    	    				//window.location.reload();
                           </script>";
 		 
 	} else {
 
 		$string_array = explode(",",$res_text);
 		$category=$string_array[1];
 		//echo "category=".$category;
 		 		
 		header("Location: dashboard.php");
 	}
 	 
 }
 
 if(isset($_POST['INDIVREG']))
 {
 	$newusername=Login::sanitize($_POST["Indivnametext"]);
 	$newusermail=Login::sanitize($_POST["Indivmailidtext"]);
 	$newuserfullname=Login::sanitize($_POST["Indivfullnametext"]);
 	$newusermobno=Login::sanitize($_POST["Indivmobnotext"]);
 	$newuserpwd=md5(Login::sanitize($_POST["Indivpassword"]));
 	$newusercat="individual";
 	$newuserobject = new UserInfo();
 	$usercheck="";
 	$usercheck =$newuserobject->userexits($dbc,$newusermail);
 	if ((int)$usercheck == "1")
 	{
 		$usercheck="0";
 		echo "<script type='text/javascript'>
 		$(document).ready(function(){
 		document.getElementById('lightregIndivstep2').style.display='block';
 		document.getElementById('fade').style.display='block';
 		document.getElementById('stepIndverrormsg').innerHTML ='User with emailId already exists';
 		//hide
 		$('#Indivpasswordclear').hide();
 		$('#Indivcnfrmpasswordclear').hide();
 		$('#Indivnameclear').hide();
 		$('#Indivmailidclear').hide();
 		$('#Indivfullnameclear').hide();
 		$('#Indivmobnoclear').hide();
 		if ($newusermobno=='')
 		{ $('#Indivmobnoclear').show();
 		$('#Indivmobnotext').hide();}
 		else
 		{ $('#Indivmobnotext').show();
 		$('#Indivmobnoclear').hide(); }
 		//show
 		$('#Indivpassword').show();
 		$('#Indivcnfrmpassword').show();
 		$('#Indivnametext').show();
 		$('#Indivmailidtext').show();
 		$('#Indivfullnametext').show();
 		document.getElementById('Indivnametext').value = '$_POST[Indivnametext]';
 		document.getElementById('Indivmailidtext').value = '$_POST[Indivmailidtext]';
 		document.getElementById('Indivfullnametext').value = '$_POST[Indivfullnametext]';
 		document.getElementById('Indivmobnotext').value = '$_POST[Indivmobnotext]';
 
 	});
 	</script>";
 	 
 	}
 	else
 	{
 	$resultIndivadd="";
 	$resultIndivadd= $newuserobject->addIndivuser($dbc,$newusername,$newuserfullname,$newusermail,$newusermobno,$newuserpwd);
 	if ((int)$resultIndivadd=="1")
 	{
 	echo "<script type='text/javascript'>
 	$(document).ready(function(){
 	document.getElementById('lightRegconf').style.display='block';
 	document.getElementById('fade').style.display='block';
 		//setTimeout(document.getElementById('lightRegconf').style.display='none', 2000);
 		 
 		});
 		//window.location.reload();
 		</script>";
 		$resultIndivadd="";
 		}
 
 		}
 
 		}
 		if(isset($_POST['SCHOOLREG']))
 		{
 				$schooldata=array();
 			$newusermail=Login::sanitize($_POST["schcordmailid"]);
		$schooldata[0] = Login::sanitize($_POST["schcordname"]);
		$schooldata[1] = Login::sanitize($_POST["schcordmailid"]);
		$schooldata[2] = Login::sanitize($_POST["schcordfullname"]);
		$schooldata[3] = Login::sanitize($_POST["schcordmob"]);
		$schooldata[4] = md5(Login::sanitize($_POST["schcordpwd"]));
		$schooldata[5] = Login::sanitize($_POST["schcat"]);
		$schooldata[6] = Login::sanitize($_POST["schnametext"]);
		$schooldata[7] = Login::sanitize($_POST["schaddtext"]);
 			$schooldata[8] = Login::sanitize($_POST["schcitytext"]);
 		$schooldata[9] = Login::sanitize($_POST["schstatetext"]);
 		$schooldata[10]= Login::sanitize($_POST["schphtext"]);
		$cat =$_POST["schcat"];
 		$newschoolobject = new UserInfo();
		$schoolcheck="";
 		$schoolcheck =$newschoolobject->userexits($dbc,$newusermail);
 		if ((int)$schoolcheck == "1")
        {
 			$schoolcheck="0";
 			echo "<script type='text/javascript'>
 			$(document).ready(function(){
 					document.getElementById('lightregstep2').style.display='block';
 					document.getElementById('fade').style.display='block';
 					document.getElementById('step2errormsg').innerHTML ='User with emailId already exists';
 					//hide
 					$('#passwordclear').hide();
 			$('#cnfrmpasswordclear').hide();
 			$('#nameclear').hide();
 			$('#mailidclear').hide();
 			$('#fullnameclear').hide();
 			if ($schooldata[3]=='')
 			{ $('#mobnoclear').show();
 			$('#mobnotext').hide();}
 			else
 			{ $('#mobnotext').show();
 			$('#mobnoclear').hide(); }
 			if ($schooldata[6]=='')
 			{ $('#schnameclear').show();
 			$('#schnametext').hide();}
 			else
 			{ $('#schnametext').show();
 			$('#schnameclear').hide();}
 			if ($schooldata[7]=='')
 			{ $('#schaddclear').show();
 			$('#schaddtext').hide();}
 			else
 			{ $('#schaddtext').show();
 			$('#schaddclear').hide();}
 			if ($schooldata[8]=='')
 			{ $('#schcityclear').show();
 			$('#schcitytext').hide();}
 			else
 			{ $('#schcitytext').show();
 			$('#schcityclear').hide();}
 			if ($schooldata[10]=='')
 			{ $('#schphclear').show();
 			$('#schphtext').hide();}
 			else
 			{ $('#schphtext').show();
 			$('#schphclear').hide()}
 			//show
 			$('#password').show();
 			$('#cnfrmpassword').show();
 			$('#nametext').show();
 			$('#mailidtext').show();
 			$('#fullnametext').show();
 			if ($schooldata[3]=='')
 			{ $('#mobnotext').hide();}
 			else
 			{ $('#mobnotext').show(); }
 			 
 			document.getElementById('nametext').value = '$_POST[schcordname]';
 			document.getElementById('mailidtext').value = '$_POST[schcordmailid]';
 			document.getElementById('fullnametext').value = '$_POST[schcordfullname]';
 			document.getElementById('mobnotext').value = '$_POST[schcordmob]';
 					document.getElementById('schnametext').value = '$_POST[schnametext]';
 					document.getElementById('schaddtext').value = '$_POST[schaddtext]';
 					document.getElementById('schcitytext').value = '$_POST[schcitytext]';
 					document.getElementById('schphtext').value = '$_POST[schphtext]';
 					document.getElementById('schstatetext').value = '$_POST[schstatetext]';
 					if ($cat=='school-gsp')
 					{
 					document.getElementById('gsp').checked=true;
 			}
 
 			});
 			</script>";
 			unset($schooldata);
 			}
 			else
 			{
 			$resultIndivadd="";
 			$resultIndivadd= $newschoolobject->addSchooluser($dbc,$schooldata);
 			if ((int)$resultIndivadd=="1")
 			{
 			echo "<script type='text/javascript'>
 			$(document).ready(function(){
 			document.getElementById('lightRegconf').style.display='block';
 			document.getElementById('fade').style.display='block';
 			});
 			</script>";
 			$resultIndivadd="";
 			}
 
 			}
 			if(isset($_POST['FORGOTPWD']))
 			{
 			echo "Forgotpwd";
 			$forgotmail=Login::sanitize($_POST["forgot_email"]);
 			echo $forgotmail;
 			$newforgotmailobject = new UserInfo();
 			$forgotpwdcheck =$newforgotmailobject->forgotpwd($dbc,$forgotmail);
 			echo $forgotpwdcheck ;
 			if ((int)$forgotpwdcheck=="-1")
 			{
 			echo "<script type='text/javascript'>
 			$(document).ready(function(){
 			document.getElementById('lightone').style.display='block';
 			document.getElementById('fade').style.display='block';
 			formsg
 			document.getElementById('formsg').innerHTML='Sorry ! Please check your Email ID';
 			});
 			//window.location.reload();
 			</script>";
 			 
 			}
 			}
 		}
 ?>
    
<body>
    <?php include ("includes/header.php"); ?> <!--  start header_place_holder  -->
    <? $Lang = lang_setting();
    ?>
     <!--  end header_place_holder  -->
          <div class="body_content"> <!--  start body_content  -->
            <!--  start body_top  -->
    	<div class="body_top">
        <!--  start main  -->
        	<div class="main">
               	<h3 class="Rhythm_TEXT"><a name="seasonwatch"><?=$Lang->GetString("whyseasonwatch_text")?></a></h3>
                 <div class="container"> 
                 	<div class="left_BOX">
                 		<p class="leftSection_TEXT">
                                  All of us have observed how the annual temperature and rainfall patterns in the country are 
                                  changing rapidly. Along with the seasons, the flowering and fruiting patterns of common trees 
                                  like the Mango and Amaltas also appear to be changing every year. But these are just impressions 
                                  and are not based on solid information from across the country.</p>
                                 <p class="leftSection_TEXT">With SeasonWatch we hope to fill this gap in with what we know. 
                                     By systematically recording the changing patterns of plant life, and understanding how climate 
                                     affects their lifecycle, we can work together with Nature to conserve her bounty.</p> 
                        </div>
                    	<div class="Right_SECTION_TEXT"><img src="images/imagefive.png" alt="image" /></div>
                        
                </div>  
                    <div class="Right_SECTION_TEXT">
                    <p> Also, the seasonal cycles can be fascinating to observe, as well as reveal a whole new world of micro-cycles within them!
                    Here is an example of a chain of ecological interactions that depends on the seasonal resources trees provide:
                    <ul>
                    <li><b>Caterpillars</b> and <b>monkeys</b> eat fresh leaves.</li>
                    <li><b>Bees</b> and <b>butterflies</b> flit over the flowers for nectar, and pollinate the flowers while they do so.</li>
                    <li><b>Birds,</b> squirrels, bats and people eat the fruit.</li>
                    </ul>
                    </p> 
                    </div>
            </div><!--  end main  -->
         </div><!--  end body_top  -->
        <div class="clearBoth"></div> <!--  start body_top1  -->
        <div class="body_top1"><!--  start main  -->
          	<div class="main">
                 <div class="container"> 
                    <div class="left_BOX">
                        <p>
                            <img src="images/imagegroup.jpg" alt="image" />
                        </p>  
                    </div>
                   
                    <div class="Right_SECTION">
                        <h3 class="Rhythm_TEXT_details_right "><a name="seastree"><?=$Lang->GetString("monitoredtrees_text")?></a></h3>
                        <div class="Right_SECTION_TEXT">
                            <p >
                            Some of the trees being monitored under SeasonWatch are Jackfruit (Kathal),
                            Indian Blackberry (Jamun), Pride of India (Jarul), Indian Gooseberry (Amla),
                            Mango (Aam), Banyan (Bargad), Devil’s Tree (Saptaparni), Purple Bauhinia (Kaniar),
                            Indian Coral Tree (Pangra), Flame of the Forest (Dhak/Palash), Indian Laburnum (Amaltas), 
                            Pongam Tree/Indian Beech (Karanj), Tamarind (Imli), Margosa (Neem), Flame Tree (Gulmohur),
                            Red Silk Cotton Tree (Semul).</p>
                            <p >Can you recognize all these beautiful trees of India? This is not the complete list but 
                            after you register, you can learn how to recognize and relate to all these SeasonWatch trees.</p> 
                            </p>
                        </div>
                    </div>
                </div> 
            </div><!--  end main  -->
        </div> <!--  end body_top1  -->
        <div class="clearBoth"></div>
        	<div class="clearBoth"></div>
        	<div class="body_top1"><!--  start body_top2  --><!-- who's involved-->
                    <div class="main">  <!--  start main  -->          	
                    <h3 class="Rhythm_TEXT"><a name="Involve"><?=$Lang->GetString("whosinvovled_text")?></a></h3>
                    <div class="container">                    
                        <div class="left_BOX">
                            <p class="leftSection_TEXT">
                            SeasonWatch is part of the Citizen Science program at 
				the National Centre for Biological Sciences (NCBS), the biological 
				wing of the Tata Institute of Fundamental Research (TIFR). Nature 
				Conservation Foundation (NCF) an NGO that does pioneering work in 
				conservation biology in various ecosystems across India provides valuable 
				expertise and support to the program. SeasonWatch is funded by Wipro 
				Applying Thought in Schools (WATIS), the division of Wipro that works 
				extensively with many NGOs across India on educational reforms in schools.</p>  
                        </div>
                        <div class="Right_SECTION">                      
                            <p class="Right_PARAGRAPH">
                            
                            </p>
                        </div>
                    </div>    
                    </div> <!--  end main  -->
                </div>
        <!--  end body_top2  -->
        <div class="clearBoth"></div> 
     	<div class="body_top1">
        	<div class="main">
            	       <div class="container"> 
                 	<div class="left_BOX">
                	 </div>
                      <div class="Right_SECTION">
			   <h3 class="Rhythm_TEXT_details_right"><a name="Results"><?=$Lang->GetString("exploreresults_text")?></a></h3>
                        <div class="Right_SECTION_TEXT">
                            <p>
                                All the observations that are part of the SeasonWatch 
                                database become interesting when you can play around with them. 
                                This means that you can ask interesting questions and studying 
                                the SeasonWatch observations data can discover your own answers. 
                                (remember that this is an open-source project and ALL participants
                                get full access to ALL data). 
                                Once the observations start flowing in, combining them with other
                                information available in the public domain, you can possibly get 
                                answers to questions like:</p>
                                <ul >
                                <li >How does the flowering time of Neem change across India?</li>
                                <li >Is fruiting of Tamarind different in different 
                                parts of the country depending on rainfall in 
                                the previous year?</li>
                                <li>Is year-to-year 
                                variation in flowering and fruiting time of Mango 
                                related to winter temperatures?</li>
                                </ul>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="body_top2">
         	<div class="main"> <a name="faq"><!--  start main  -->       	
                    <h3 class="Rhythm_TEXT"><?=$Lang->GetString("faq_text")?></h3></a>
                     <div class="container">                    
                            <div class="left_BOX">
                                    <p>
                                        <ul class="leftSection_TEXT"> 
                                            <li><h4>Q.&nbsp;Can I participate?</h4></li>
                                            <li><b>A.</b>&nbsp;Anyone interested 
                                                in trees and the changing climate can 
                                                register and participate. You can 
                                                register as an individual or as a school.
                                                More details are available when you register. 
                                            </li>
                                        </ul>
                                        <ul class="leftSection_TEXT">   
                                            <li><h4>Q.&nbsp;When can I start?</h4></li>
                                            <li><b>A.</b>&nbsp;There are no time
                                                limitations or starting dates. You can 
                                                start participating any time. How about 
                                                today?
                                            <li>
                                        </ul>
                                        <br/>
                                      </p>  
                            </div>
                            <div class="Right_SECTION">                      
                                    <p>
                                        <ul class="Right_SECTION_TEXT">
                                            <li><h4> Q.&nbsp;How much time do I have to spend 
                                                    monitoring each tree?</h4></li>
                                            <li><b>A.</b>&nbsp;About five minutes 
                                                per tree to look at it 
                                                closely. This needs to be done only 
                                                once a week so it takes only a little
                                                time to connect with your tree and 
                                                observe it for any changes.
                                            </li>
                                        </ul>
                                       
                                        <ul class="Right_SECTION_TEXT">
                                            <li><h4> Q.&nbsp;What if I have more questions?</h4></li>
                                            <li><b>A.</b>&nbsp;Drop an email to sw@seasonwatch.in and we will be 
							very happy to answer all your queries. You can also download the SeasonWatch handbook (17 Mb pdf) that 
							has the step-by-step procedure on how to participate by clicking <a href="downloads/SW_HandBook.pdf" target=_blank><span class="redColor">here</span></a>.
                                            </li>
                                        </ul>
                                   </p>
                            </div>
                    </div>    
            </div> <!--  end main  -->
          </div>
        <div class="clearBoth"></div>
   </div>
    <!--  end body_content  -->
     <div class="clearBoth"></div>
    <!--  start footer  -->
    <?php include ("includes/footer.php"); ?>
    <!--  end footer  -->
    <div class="clearBoth"></div>
</body>
</html>
