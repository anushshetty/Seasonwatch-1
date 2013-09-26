<?php 
/*
Initial Development :- This is the default page loaded. It displays from info and allows the user to login.
Once a user has successfully logged in, the session is loaded with details like
user_id, user_name etc and then the user is redirected to dash.php	
*/
//echo "helo";
    ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
   session_start();
    //include_once("includes/dbcon.php");
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
       
    /*$browsertype= Login::getBrowser();
    if ($browsertype['name'] == "Google Chrome") { //echo"Chrome";
    } 

    elseif ($browsertype['name'] == "Mozilla Firefox") { //echo"Fierfox";

    }
    else
    {
    include 'browsernotsupport.html';
    exit;
    }
      */


     if(isset($_GET['cmd']))
    {
    $cmd = $_GET['cmd'];
    }  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SeasonWatch</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/loginfunction.js"></script>
<script type="text/javascript" src="js/sliderscrpt.js"></script>
<script type="text/javascript" src="js/sliderman.1.3.7.js"></script>
<script type="text/javascript" src="js/easySlider1.7.js"></script>
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
	echo $username;
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
            	//$_SESSION['msg']['register-err'] = $resultIndivadd;
                 echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                            document.getElementById('lightRegconf').style.display='block';
		                  	document.getElementById('fade').style.display='block';
                         	});
    	    				</script>";
                 $resultIndivadd="";
            }
            
        }
   //if(isset($_POST['FORGOTPWD']))
        if(isset($_POST['SEND']))
  {
      echo "Forgotpwd";
       $forgotmail=Login::sanitize($_POST["forgot_email"]);
       echo $forgotmail;
       $newforgotmailobject = new UserInfo();
       $forgotpwdcheck =$newforgotmailobject->forgotpwd($dbc,$forgotmail);
       echo $forgotpwdcheck ;	
       if ((int)$forgotpwdcheck=="Sorry ! Please check your Email ID");//"-1")
       {
       	$_SESSION['msg']['forgot-err'] = $forgotpwdcheck;
             echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                          document.getElementById('lightone').style.display='block';
		                  	document.getElementById('fade').style.display='block';
                                        //formsg
                                        //document.getElementById('formsg').innerHTML='Sorry ! Please check your Email ID';
                                      });
    	    				//window.location.reload();
                           </script>";
           
       }
  }
 }
 ?>
<body>
<div id="translation"></div>
<div id="article">
<div class="header_place_holder">  <!--  start header_place_holder  -->
    <div class="main"><!--  start main  -->
        <div class="header"><!--  start header  -->
        <div class="logo"><img src="images/seasonwatchlogo.png" alt="" width="180" height="82" /></div>
        <div class="top_right">
            <ul>
                <li><span class="tree"><?echo Login::NoTrees();?></span><p>Trees</p></li>
                <li><span class="observation"><?echo Login::NoOfObservation();?></span><p>Observations</p></li>
                <!--<li><span class="observation"><?echo number_format(Login::NoOfObservation());?></span><p>Observations</p></li>-->
                <li><span class="participant"><?echo Login::NoParticipants();?></span><p>Participants</p></li>
                <li><span class="school"><? echo Login::NoSchools();?></span><p class="schools">Schools</p></li>
                         
            </ul>
          <? if(isset($_GET['cmd']))
	{if($cmd =="confirm")
                {?>
            <div class="top_right">Your email address has been confimed.</div>
                <?}}?> 
        </div>
        <div class="menu"><!--  start menu  -->
            <ul>
                <li><a href="index.php"<?php if (basename($_SERVER['PHP_SELF'])=='index.php') {?> class="active" <?php } ?> title="Home ">Home</a></li>
                <li><a href="details.php" <?php if (basename($_SERVER['PHP_SELF'])=='details.php') {?> class="active" <?php } ?> title="Details ">Details</a></li>
                <li ><a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('fade').style.display='block'" >Register</a></li>
                <!--<li><a href="register.php" <?php if (basename($_SERVER['PHP_SELF'])=='register.php') {?> class="active" <?php } ?>title="Register ">Register</a></li>-->
                <?php 
                if (isset($_SESSION['log_status']) == 'Y')
                {?>
                    <div class="clear"></div>
                    <div class="container">
                        <div class="dashboardSection">
                            <!-- To display the login name if the length is more than 7 characters then display name with ...-->
                                <?$pattern="..";
                                $displayname="";
                                if  (strlen($_SESSION['fullname']) > 7)
                                $displayname=  rtrim(substr($_SESSION['fullname'], 0, 7)) . $pattern; 
                                else 
                                $displayname= $_SESSION['fullname'];
                                ?>
                            <p>Welcome <?php echo ucfirst($displayname) ?>
                            <ul>
                                <?php  switch ($_SESSION['usercategory']) 
                                {
                                    case "":?>
                                    <li><a href ="indivdash.php" <?php if (basename($_SERVER['PHP_SELF'])=='indivdash.php') {?> class="active" <?php } ?> title="My Dashboard">Dashboard</a></li>
                                    <li><a href ="memprofile.php"<?php if (basename($_SERVER['PHP_SELF'])=='memprofile.php') {?> class="active" <?php } ?>  title="Profile">Profile</a></li>
                                    <?
                                    break;
                                    case "individual":?>
                                    <li><a href ="indivdash.php" <?php if (basename($_SERVER['PHP_SELF'])=='indivdash.php') {?> class="active" <?php } ?> title="My Dashboard">Dashboard</a></li>
                                    <li><a href ="memprofile.php"<?php if (basename($_SERVER['PHP_SELF'])=='memprofile.php') {?> class="active" <?php } ?>  title="Profile">Profile</a></li>
                                    <?
                                    break;
                                    case "school-gsp":?>
                                    <li><a href ="gspdash.php" <?php if (basename($_SERVER['PHP_SELF'])=='gspdash.php') {?> class="active" <?php } ?> title="My Dashboard">Dashboard</a></li>
                                    <li><a href ="memprofile.php"<?php if (basename($_SERVER['PHP_SELF'])=='memprofile.php') {?> class="active" <?php } ?>  title="Profile">Profile</a></li>
                                    <? break;
                                    case "school-seed":?>
                                    <li><a href ="seeddash.php"<?php if (basename($_SERVER['PHP_SELF'])=='seeddash.php') {?> class="active" <?php } ?>  title="My Dashboard">Dashboard</a></li>
                                    <li><a href ="memprofile.php"<?php if (basename($_SERVER['PHP_SELF'])=='memprofile.php') {?> class="active" <?php } ?>  title="Profile">Profile</a></li>
                                    <? 
                                    break; 
                                    case "school":?>
                                    <li><a href ="schooldash.php" <?php if (basename($_SERVER['PHP_SELF'])=='schooldash.php') {?> class="active" <?php } ?> title="My Dashboard">Dashboard</a></li>
                                    <li><a href ="memprofile.php"<?php if (basename($_SERVER['PHP_SELF'])=='memprofile.php') {?> class="active" <?php } ?>  title="Profile">Profile</a></li>
                                    <?
                                    break;
                                } ?>
                                <li><a href="logout.php" title="Logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>                            	                               	                    
                    <?php } 
                    else 
                    { ?>                      
                        <li class="floatRight noMargin"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Login</a></li>
                <?php } ?>                   
                </ul>
    <!-- Login screen-->
    <div id="light" class="white_content">
       <?  include 'userlogin.php';?>
    </div> <!-- end of login screen-->
<!-- forgot password-->
<div id="lightone" class="white_content">
   <?include 'forgotpwd.php'?>
</div>
<!-- for Register page step1-->
<div id="lightReg" class="white_contentOne2">
   <?include 'regstep1.php'?>
</div>
<!-- for Register page step2-->
<div id="lightregstep2" class="white_contentOne2">
   <?include 'regstep2.php'?>
</div>
                                    
                      <!-- for Register page step3-->
                      <div id="lightregstep3" class="white_contentOne2">
                            <?include 'regstep3.php'?>
                        </div>
               

<div id="lightRegconf" class="white_contentOne2">
   <?include 'regconf.php'?>
</div>
 <div id="lightregIndivstep2" class="white_contentOne2">
   <?include 'regasIndiv.php'?>
</div>      

                        <div id="fade" class="black_overlay"></div>
                    </div> <!--  end menu  -->
                    
                    <!-- script type="text/javascript">
//$(document).ready(function(){
        var loginerr=<?php //if(isset($_SESSION['msg']['login-err'])){ echo $_SESSION['msg']['login-err'];} else {echo "";}
            //echo $_SESSION['msg']['login-err'];?>;
        if(loginerr != ""){
		document.getElementById('light').style.display='block';
		document.getElementById('fade').style.display='block';
        }
			
//});
    </script-->	
                 <div class="clearBoth"></div>
                <!--  start banner  -->
                        <div class="banner">
                            <div class="container">             
                            <div id="SliderName">
                                <img src="images/panel.png" alt="img"  />
                                <img src="images/page_1_img2.png" alt="img"  />
                                <img src="images/page_1_img3.png"  alt="img" />
                                <img src="images/page_1_img4.png" alt="img"  />
                            </div>
                            <div class="c"></div>
                            <div id="SliderNameNavigation"></div>
                            <div class="c"></div>                
                            <script type="text/javascript">
                            //the first four images.                    
                            // we created new effect and called it 'demo01'. We use this name later.
                            Sliderman.effect({name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs'});
                            var demoSlider = Sliderman.slider({container: 'SliderName', width: 940, height: 505, effects:'demo01',
                            display: {
                            pause: true, // slider pauses on mouseover
                            autoplay: 3000, // 3 seconds slideshow
                            always_show_loading: 200, // testing loading mode
                            description: { opacity: 0.5, height: 50, position: 'bottom'}, // image description box settings
                            //loading: {background: '#000000', opacity: 0.2, image: 'images/loading.gif'}, // loading box settings
                            buttons: {opacity: 1, prev: {className: 'SliderNamePrev', label: ''}, next: {className: 'SliderNameNext', label: ''}}, // Next/Prev buttons settings
                            navigation: {container: 'SliderNameNavigation', label: '&nbsp;'} // navigation (pages) settings
                            }});

                            </script>                
                            <div class="c"></div>                
                            </div>
                        </div>
        		<!--  end banner  -->
                        <div class="banner_bottom_text">
                            <p>Have you noticed how the summers are becoming hotter 
                            and the monsoons more unpredictable? Have you wondered 
                            how changes in our seasons might affect the world around us?</p>
                            <p>SeasonWatch is an India-wide program that studies the 
                            changing seasons by monitoring the seasonal cycles of 
                            flowering, fruiting and leaf-flush of common trees. 
                            Anybody - children and adults, interested in trees and 
                            in the rapidly changing climate can participate. It's very easy!
                           </p>
                            <p>Just <a href="#selecttree"><span class="redColor">SELECT</span></a> a tree 
                                near you and <a href="#monitor"><span class="redColor">MONITOR</span></a> it every week.
                                 <a href="#upload"><span class="redColor">UPLOAD </span></a> this information through your account 
                                on this website to add to the  data collected by 
                                volunteers all across the country. Interested? 
                                Read the <a href="details.php"><span class="redColor">DETAILS</span></a> of the project 
                                and<a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('fade').style.display='block';window.scrollTo(0, 0);" > <span class="redColor">REGISTER</span></a>  to
                                join our brigade of nature observers!
                                </p>
                            
                        </div>
            </div><!--  end header  -->
      	</div>
        <!--  end main  -->
        <div class="clearBoth"></div>
    </div><!--  end header_place_holder  -->
    <!--  start body_content  -->
    <div class="body_content">
            <!--  start body_top  -->
            <div class="body_top">
                    <!--  start main  -->
                    <div class="main">
                        <div class="body_holder_top">
                            <div class="body_top_left">
                                    <h2>Some trees we track</h2>
                                    <div id="container">
                                        <div id="content">
                                            
                                            <!-- div id="img_slider">
                                                <ul>
                                                    <li><a href="#"><img src="images/Devil'sTree_Alstonia_scholaris.png" alt="Css Template Preview" /></a>
                                                    <span>Devil's Tree <br/> <i>Alstonia scholaris</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/jackfruit.png" alt="Css Template Preview" /></a>
                                                    <span>Jackfruit <br/> <i>Artocarpus heterophyllus</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/RedSilkCotton_Bombax_ceiba.png" alt="Css Template Preview" /></a>
                                                    <span>Red Slik Cotton <br/><i>Bombax ceiba</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Siris_Albizia_lebbek.png" alt="Css Template Preview" /></a>
                                                    <span>Siris <br/> <i>Albizia lebbeck</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Gulmohar_Delonix_regia.png" alt="Css Template Preview" /></a>
                                                    <span>Gulmohar <br/> <i>Delonix regia</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Neem_Azadirachta_indica.png" alt="Css Template Preview" /></a>
                                                    <span>Neem <br/> <i>Azadirachta indica</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Pongam_Pongamia_pinnata.png" alt="Css Template Preview" /></a>
                                                    <span>Pongam <br/> <i>Pongamia pinnata</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/IndianCoralTree_Erythrina_indica.png" alt="Css Template Preview" /></a>
                                                    <span>Indian Coral <br/> <i>Erythrina indica</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Purple_Bauhinia_Bauhinia_purpurea.png" alt="Css Template Preview" /></a>
                                                    <span>Purple Bauhinia <br/> <i>Bauhinia purpurea</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Banyan_Ficus_benghalensis.png" alt="Css Template Preview" /></a>
                                                    <span>Banyan <br/> <i>Ficus benghalensis</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Mango_Mangifera_indica.png" alt="Css Template Preview" /></a>
                                                    <span>Mango<br/> <i>Mangifera indica</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Amla_Phyllanthus_emblica.png" alt="Css Template Preview" /></a>
                                                    <span>Amla <br/><i>Phyllanthus emblica</i></span>
                                                    </li>
                                                    <li><a href="#"><img src="images/Jarul_Lagerstroemia_speciosa.png" alt="Css Template Preview" /></a>
                                                    <span>Jarul<br/> <i>Lagerstroemia speciosa</i></span>
                                                    </li>
                                                </ul>
                                            
                                           </div-->
                                           
                                            <div id="img_slider1">
                                            <img src="images/Devil'sTree_Alstonia_scholaris.png" alt="Css Template Preview" />
                                            <div class="SliderNameDescription"><span>Devil's Tree <br/> <i>Alstonia scholaris</i></span></div>
                                             <img src="images/jackfruit.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Jackfruit <br/> <i>Artocarpus heterophyllus</i></span></div>
                                             <img src="images/RedSilkCotton_Bombax_ceiba.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Red Slik Cotton <br/><i>Bombax ceiba</i></span></div>
                                             <img src="images/Siris_Albizia_lebbek.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Siris <br/> <i>Albizia lebbeck</i></span></div>
                                             <img src="images/Gulmohar_Delonix_regia.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Gulmohar <br/> <i>Delonix regia</i></span></div>
                                             <img src="images/Neem_Azadirachta_indica.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Neem <br/> <i>Azadirachta indica</i></span></div>
                                             <img src="images/Pongam_Pongamia_pinnata.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Pongam <br/> <i>Pongamia pinnata</i></span></div>
                                             <img src="images/IndianCoralTree_Erythrina_indica.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Indian Coral <br/> <i>Erythrina indica</i></span></div>
                                             <img src="images/Purple_Bauhinia_Bauhinia_purpurea.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Purple Bauhinia <br/> <i>Bauhinia purpurea</i></span></div>
                                             <img src="images/Banyan_Ficus_benghalensis.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Banyan <br/> <i>Ficus benghalensis</i></span></div>
                                             <img src="images/Mango_Mangifera_indica.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Mango<br/> <i>Mangifera indica</i></span></div>
                                             <img src="images/Amla_Phyllanthus_emblica.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Amla <br/><i>Phyllanthus emblica</i></span></div>
                                             <img src="images/Jarul_Lagerstroemia_speciosa.png" alt="Css Template Preview" />
                                             <div class="SliderNameDescription"><span>Jarul<br/> <i>Lagerstroemia speciosa</i></span></div>
                                                                                      
                                            </div>
                                            
                                            <div id="SliderNameNavigation1"></div>
                                            
                                            <script type="text/javascript">
                            //the first four images.                    
                            // we created new effect and called it 'demo01'. We use this name later.
                            Sliderman.effect({name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs'});
                            var demoSlider = Sliderman.slider({container: 'img_slider1', width: 260, height: 250, effects:'demo01',
                            display: {
                            pause: true, // slider pauses on mouseover
                            autoplay: 3000, // 3 seconds slideshow
                            always_show_loading: 200, // testing loading mode
                            description: { opacity: 0.5, height: 50, position: 'bottom'}, // image description box settings
                            //loading: {background: '#000000', opacity: 0.2, image: 'images/loading.gif'}, // loading box settings
                            buttons: {opacity: 1, prev: {className: 'Slider2NamePrev', label: ''}, next: {className: 'Slider2NameNext', label: ''}}, // Next/Prev buttons settings
                            navigation: {container: 'Slider2NameNavigation', label: '&nbsp;'} // navigation (pages) settings
                            }});

                            </script> 
                            <div class="c"></div>
                                           
                                        </div>
                                    </div>
                               </div>
                            <div class="graph_section">
                            <h2>Popular Trees</h2>
                            <blockquote><img src="images/prop.png" width="300" alt="graphImage" /></blockquote>
                            </div>
                            <div class="graphBar">
                            <h2>Results</h2>
                            <blockquote><img src="images/phen1.png" width="300"alt="graphImage" style="padding:10px;"/></blockquote>
                                <div class="resultshead">Percentage of monitored trees 
                                    <br>with fresh leaves, flowers, and fruits
                                    <br>Jan - Dec 2012
                                 </div>
                            </div>

                           
                            <div class="c"></div>
                            <div id="Slider2NameNavigation"></div>
                            <div class="c"></div>                
                            <script type="text/javascript">
                            //the first four images.                    
                            // we created new effect and called it 'demo01'. We use this name later.
                            Sliderman.effect({name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs'});
                            var demoSlider = Sliderman.slider({container: 'SliderName2',  effects:'demo01',
                            display: {
                            pause: true, // slider pauses on mouseover
                            autoplay: 3000, // 3 seconds slideshow*/
                            always_show_loading: 200, // testing loading mode
                            description: { opacity: 0.5, height: 50, position: 'bottom'}, // image description box settings
                            loading: {background: '#000000', opacity: 0.2, image: 'images/loading.gif'}, // loading box settings
                            buttons: {opacity: 1, prev: {className: 'Slider2NamePrev', label: ''}, next: {className: 'Slider2NameNext', label: ''}}, // Next/Prev buttons settings
                            //navigation: {container: 'Slider2NameNavigation', label: '&nbsp;'} // navigation (pages) settings*/
                            }});

                            </script>                
                            <div class="c"></div>                
                            </div>
                            <div class="clearBoth"></div>
                            <!--<blockquote><img src="images/graphBar.jpg" alt="graphbar" /></blockquote>-->
                            </div>
                           
                        </div>
                <!-- /div--> <!--  end main  -->
            </div><!--  end body_top  -->
            <div class="clearBoth"></div><!--  start body_bottom  -->
            <div class="clearBoth"></div><!--  start body_top1  -->
            <div class="body_top1"><!--  start main  -->
                <div class="main">
                    <h3 class="Rhythm_TEXT"><a name="selecttree">Select</a></h3>
                    <div class="container"> 
                        <div class="left_BOX">
                            <p class="leftSection_TEXT">
                            The tree species that we are monitoring in SeasonWatch have 
                            been chosen because they are widely distributed 
                            across our country. 
				You can select from a list of 25 focal species, but are also
				welcome to check out the entire list of species being monitored.
				Take a walk outside and look at the 
                            trees in your neighbourhood and choose healthy, 
                            mature trees from the SeasonWatch list.
                            You will have no trouble identifying the Neem or the Mango 
                            but may face some trouble with, say, the Red Silk Cotton or 
                            the Indian Coral Tree. When you register you get access to 
                            detailed material that can help you identify all the SeasonWatch trees. 
                            </p>  
                        </div>
                        <div class="Right_SECTION">
                            <p class="Right_PARAGRAPH">
                            <img src="images/choose.png" alt="image" style="padding:0px 90px;"/><!-- need to update in main site-->
                            </p>
                        </div>
                    </div>    
                </div> <!--  end main  -->
            </div> <!--  end body_top1  -->
            <div class="clearBoth"></div>
            <div class="clearBoth"></div>
            <div class="body_top1"><!--  start body_top1  -->
                <div class="main"><!--  start main  -->
                    <h3 class="Rhythm_TEXT"><a name="monitor">Monitor</a></h3>
                    <div class="container"> 
                            <div class="left_BOX">
                                <p class="leftSection_TEXT">
                                    Once you have identified and chosen your trees the next step is to 
                                    monitor them once a week. This is the central activity of SeasonWatch
                                    and is a simple 5-minute job for each of your trees. You look for the following tree parts- 
					 leaves <span class="leaf">[fresh and mature]</span>, flowers <span class="flower">[buds and open flowers]</span>, 
					and fruit <span class="fruit"> [unripe and ripe]</span>.
					 And you note 
                                    down whether each of these are 'none' or 'few' or 'many'. So, for a 
                                    mango tree you are monitoring you may find that in a particular week 
                                    there were few fresh leaves, many mature leaves, no buds, many flowers,
                                    no unripe fruit and no ripe fruits. It's easy!
                                </p>  
                            </div>
                            <div class="Right_SECTION">
                                <p class="Right_PARAGRAPH">
                                <img src="images/monitor.png"  alt="image" />
                                </p>
                            </div>
                     </div>    
                </div><!--  end main  -->
            </div><!--  end body_top1  -->
            <div class="clearBoth"></div>
            <div class="clearBoth"></div>
             <!--  start body_top1  -->
            <div class="body_top2"> <!--  start main  -->
                <div class="main">
                    <h3 class="Rhythm_TEXT"><a name="upload">Upload</a></h3>
                    <div class="container"> 
                        <div class="left_BOX">
                        <p class="leftSection_TEXT">
                        Monitoring your trees may be easy but when thousands of people upload their 
                        observations into a central database through this website, 
                        the results become exciting. 
                        You begin to see how your five-minute-per-week observations
                        contribute to the understanding of the larger seasonal 
                        variations that are happening across the country.
						Also, SeasonWatch is based on a philosophy of open sharing
                        and all participants have complete access to the knowledge that they help to co-create 
                        here. <a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('fade').style.display='block';window.scrollTo(0, 0);" ><span class="red">REGISTER</span></a>  and become a SeasonWatcher!
                        </p>  
                        </div>
                        <div class="Right_SECTION">
                            <p class="Right_PARAGRAPH">
                            <img src="images/upload.png" alt="image"  style="padding:0px 90px;"/><!-- need to update in main site-->
                            </p>
                        </div>
                    </div>    
                </div><!--  end main  -->
            </div> <!--  end body_top1  -->
            <div class="clearBoth"></div>
     <!--  end body_content  -->
    <div class="clearBoth"></div>
    <!--  start footer  -->
     <?php include ("includes/footer.php"); ?> <!--  end footer  -->
  
  </body>
</html>
