<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php 
/* Initial development:- Loads when user logged in .
 * loads the profile page & dashboard pages according to the school category
 */
	    //include_once("includes/Login.php");
        ?>
<!-- script>
<script type="text/javascript" src="js/loginfunction.js"></script-->
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
 /*if(isset($_SESSION['userid']) &&  !(isset($_SESSION['rememberMe'])))
 {
 	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
 	// and you have not checked the rememberMe checkbox:
 
 	$_SESSION = array();
 	//session_destroy();
 
 	// Destroy the session
 }*/
 
 
 if(isset($_GET['logoff']))
 {
 	$_SESSION = array();
 	session_destroy();
 
 	header("Location: details.php");
 	exit;
 }
 

 
 if(isset($_SESSION['msg']['login-err'])){
 	unset($_SESSION['msg']['login-err']);
 	session_destroy();
 		echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                          document.getElementById('light').style.display='block';
		                  	document.getElementById('fade').style.display='block';
		                  	document.getElementById('login_name').value='".$_GET['user']."';
		                  	document.getElementById('logmsg').innerHTML ='Invalid Email/password. Please retry.';
    	    				});
    	    				//window.location.reload();
                           </script>";
 }
 
 if(isset($_SESSION['msg']['indivreg-err'])){

 	$res_text= $_SESSION['msg']['indivreg-err'];
 	unset($_SESSION['msg']['indivreg-err']);
 	$pos = strpos($res_text, "success");
 	if ($pos === false) {
 	$indivdt=explode(",",$_GET['userdata']);
 	//print_r($json);
 	
 	echo "<script type='text/javascript'>
            
            $(document).ready(function(){
           // document.getElementById('Indivnametext').value = '$indivdt[0]';
              document.getElementById('Indivmailidtext').value = '$indivdt[1]';
              document.getElementById('Indivfullnametext').value = '$indivdt[2]';
              document.getElementById('Indivmobnotext').value = '$indivdt[3]';
             
              document.getElementById('lightregIndivstep2').style.display='block';
              document.getElementById('fade').style.display='block';
              document.getElementById('stepIndverrormsg').innerHTML ='This email address is already registered with SeasonWatch. Please change the email address and try Register';
              
             //hide
              $('#Indivnameclear').hide();
              $('#Indivmailidclear').hide();
              $('#Indivfullnameclear').hide();
               $('#Indivmobnoclear').hide();
            
              //show
              $('#Indivpasswordclear').show();
              $('#Indivcnfrmpasswordclear').show();
              $('#Indivnametext').show();
              $('#Indivmailidtext').show();
              $('#Indivfullnametext').show();
              $('#Indivmobnotext').show();
                          
            });
            </script>";
 	}
 	else{
 		
 		echo "<script type='text/javascript'>
             		$(document).ready(function(){
                                        document.getElementById('lightRegconf').style.display='block';
		                  	document.getElementById('fade').style.display='block';
                                        //setTimeout(document.getElementById('lightRegconf').style.display='none', 2000);
                                       
    	    				});
    	    				//window.location.reload();
                           </script>";
 	} 		
 
 }
 
 if(isset($_SESSION['msg']['schoolreg-err'])){

 	$res_text= $_SESSION['msg']['schoolreg-err'];
 	unset($_SESSION['msg']['schoolreg-err']);
 	$pos = strpos($res_text, "success");
 	if ($pos === false) {
 		
 		$schooldt=explode(",",$_GET['schooldata']);
 		echo "<script type='text/javascript'>
 		      $(document).ready(function(){
              document.getElementById('lightregstep2').style.display='block';
              document.getElementById('fade').style.display='block';
              document.getElementById('step2errormsg').innerHTML ='This email address is already registered with SeasonWatch. Please change the email address and try Register';
              //hide
              $('#passwordclear').show();
              $('#cnfrmpasswordclear').show();
              $('#nameclear').hide();
              $('#mailidclear').hide();
              $('#fullnameclear').hide();
              $('#mobnoclear').hide();
            
              //show
              $('#password').hide();
              $('#cnfrmpassword').hide();
              $('#nametext').show();
              $('#mailidtext').show();
              $('#fullnametext').show();
              $('#mobnotext').show();
              
              //document.getElementById('nametext').value = '$schooldt[0]';
              document.getElementById('mailidtext').value = '$schooldt[1]';
              document.getElementById('fullnametext').value = '$schooldt[2]';
              document.getElementById('mobnotext').value = '$schooldt[3]';
             // document.getElementById('schnametext').value = '$schooldt[5]';
              //document.getElementById('schaddtext').value = '$schooldt[6]';
              //document.getElementById('schcitytext').value = '$schooldt[7]';
              //document.getElementById('schphtext').value = '$schooldt[8]';
              var cat = '$schooldt[9]';
               if (cat=='school-gsp')
                    {
                    document.getElementById('gsp').checked=true;
                    }
              
            });
            </script>";
 	}else
        {
            echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                            document.getElementById('lightRegconf').style.display='block';
		                  	document.getElementById('fade').style.display='block';
                         	});
    	    				</script>";
              
        }
 }
 
 
 
 
   //if(isset($_POST['FORGOTPWD']))
        if(isset($_POST['SEND']))
  {
     
       $forgotmail=Login::sanitize($_POST["forgot_email"]);
     
       $newforgotmailobject = new UserInfo();
       $forgotpwdcheck =$newforgotmailobject->forgotpwd($dbc,$forgotmail);
     
       if ((int)$forgotpwdcheck=="Sorry ! Please check your Email ID");//"-1")
       {
       	$_SESSION['msg']['forgot-err'] = $forgotpwdcheck;
         unset ($_POST['SEND']);
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
  
 
 ?>
<div class="header_place_holder">
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
            </div>
            <div class="menu"> <!--  start menu  -->
             
               <ul>
                    <li><a href="index.php"<?php if (basename($_SERVER['PHP_SELF'])=='index.php') {?> class="active" <?php } ?>  title="Home">Home</a></li>
                    <li><a href="details.php"<?php if (basename($_SERVER['PHP_SELF'])=='details.php') {?> class="active" <?php } ?>  title="Details" >Details</a></li>
					<? if (isset($_SESSION['log_status']) == 'Y') {?>
                 <?}else{?>
                     <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('fade').style.display='block';window.scrollTo(0, 0);">Register</a></li>
					 <?}?>
                    <!--<li><a href="register.php" <?php if (basename($_SERVER['PHP_SELF'])=='register.php') {?> class="active" <?php } ?> title="Register">Register</a></li>-->
                    <?php 
                            if (isset($_SESSION['log_status']) == 'Y'){
                    ?>
                      
			<?$pattern="..";
                             $displayname="";
                            if  (strlen($_SESSION['fullname']) > 7)
                                 //echo $_SESSION['fullname'];
                                $displayname=  rtrim(substr($_SESSION['fullname'], 0, 7)) . $pattern; 
                            else 
                                $displayname= $_SESSION['fullname'];
                            ?>
                    <div class="clear"></div>
                     <div class="container">
                        <div class="dashboardSection">
                                <p>Welcome <?php echo ucfirst($displayname) ?>
                                    
                                <ul>
                                
                                <li><a href ="dashboard.php"<?php if (basename($_SERVER['PHP_SELF'])=='dashboard.php') {?> class="active" <?php } ?> title="My Dashboard">Dashboard</a></li>
                                <li><a href ="memprofile.php"<?php if (basename($_SERVER['PHP_SELF'])=='memprofile.php') {?> class="active" <?php } ?>  title="Profile">Profile</a></li>
                                <li><a href="logout.php" title="Logout">Logout</a></li>
                                </ul>  </p>
                            </div>
                        </div>
                        <?php      
                            } else {		
                        ?>                      
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
	     <div id="lightpwdsucessmsg" class="white_contentOne2">
		<?include 'forgotpwdsucessmsg.php'?>
		</div> 
                        
                    <div id="fade" class="black_overlay"></div>
                </div><!--  end menu  --><!--  start banner  --><!--  end banner  -->
            </div><!--  end header  -->
        </div><!--  end main  -->
    <div class="clearBoth"></div>
</div>
