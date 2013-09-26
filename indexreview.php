<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
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
    
     if(isset($_GET['logoff']))
 {
 	$_SESSION = array();
 	session_destroy();
 
 	header("Location: index.php");
 	exit;
 }
    
    
       
    


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

 
 
 if(isset($_GET['logoff']))
 {
 	$_SESSION = array();
 	session_destroy();
 
 	header("Location: index.php");
 	exit;
 }
 
 if(isset($_SESSION['msg']['login-err'])){
 	unset($_SESSION['msg']['login-err']);
 	session_destroy();
 		echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                          document.getElementById('light').style.display='block';
		                  	document.getElementById('fade').style.display='block';
		                  	document.getElementById('login_name').value='".rawurldecode($_GET['user'])."';
		                  	document.getElementById('logmsg').innerHTML ='Invalid Email/Password. Please retry.';
    	    				});
    	    				//window.location.reload();
                           </script>";
 }
 
 if(isset($_SESSION['msg']['indivreg-err'])){

 	$res_text= $_SESSION['msg']['indivreg-err'];
 	//unset($_SESSION['msg']['indivreg-err']);
 	$pos = strpos($res_text, "success");
 	if ($pos === false) {
 	$indivdt=explode(",",rawurldecode($_GET['userdata']));
 	//print_r($json);
 	
 	echo "<script type='text/javascript'>
            
            $(document).ready(function(){
           // document.getElementById('Indivnametext').value = '$indivdt[0]';
              document.getElementById('Indivmailidtext').value = '$indivdt[1]';
              document.getElementById('Indivfullnametext').value = '$indivdt[2]';
              document.getElementById('Indivmobnotext').value = '$indivdt[3]';
             
              document.getElementById('lightregIndivstep2').style.display='block';
              document.getElementById('fade').style.display='block';
              document.getElementById('stepIndverrormsg').innerHTML ='This email address is already registered with SeasonWatch.Please change the email address and try Register';
              
             //hide
              $('#Indivnameclear').hide();
              $('#Indivmailidclear').hide();
              $('#Indivfullnameclear').hide();
              if('$indivdt[3]' != ''){
               $('#Indivmobnoclear').hide();
               $('#Indivmobnotext').show();}
               else{
               $('#Indivmobnoclear').show();
               $('#Indivmobnotext').hide();
               }
            
              //show
              $('#Indivpasswordclear').show();
              $('#Indivcnfrmpasswordclear').show();
              $('#Indivnametext').show();
              $('#Indivmailidtext').show();
              $('#Indivfullnametext').show();
              
                          
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
 		
 		$schooldt=explode(",",rawurldecode($_GET['schooldata']));
 		echo "<script type='text/javascript'>
 		      $(document).ready(function(){
              document.getElementById('lightregstep2').style.display='block';
              document.getElementById('fade').style.display='block';
              document.getElementById('step2errormsg').innerHTML ='This email address is already registered with SeasonWatch.Please change the email address and try Register';
              //hide
              $('#passwordclear').show();
              $('#cnfrmpasswordclear').show();
              $('#nameclear').hide();
              $('#mailidclear').hide();
              $('#fullnameclear').hide();
              
              if('$schooldt[3]'!=''){
              $('#mobnoclear').hide();
              $('#mobnotext').show();
              }
              else{
              
              $('#mobnoclear').show();
              $('#mobnotext').hide();
              }
            
              //show
              $('#password').hide();
              $('#cnfrmpassword').hide();
              $('#nametext').show();
              $('#mailidtext').show();
              $('#fullnametext').show();
             
              
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
      //echo "Forgotpwd";
       $forgotmail=Login::sanitize($_POST["forgot_email"]);
       //echo $forgotmail;
       $newforgotmailobject = new UserInfo();
       $forgotpwdcheck =$newforgotmailobject->forgotpwd($dbc,$forgotmail);
       //echo $forgotpwdcheck ;	
       if ((int)$forgotpwdcheck=="Sorry ! Please check your Email ID")//"-1")
       {
       	$_SESSION['msg']['forgot-err'] = $forgotpwdcheck;
             echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                          document.getElementById('lightone').style.display='block';
		                  	document.getElementById('fade').style.display='block';
                                        //formsg
                                        //document.getElementById('formsg').innerHTML='Sorry!Please enter a valid email address';
                                      });
    	    				//window.location.reload();
                           </script>";
           
       }
   else{
       	echo "<script type='text/javascript'>
    	    				$(document).ready(function(){
                          document.getElementById('lightone').style.display='block';
		                  	document.getElementById('fade').style.display='block';
                                        //formsg
                                        document.getElementById('formsg').innerHTML='New password has been sent to your email ID. Please check your Email ID's inbox & spam.';
                                      });
    	    				//window.location.reload();
                           </script>";
       	
       
       }
       unset($_POST['SEND']);
 //	header("Location: index.php");
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
                <li><span class="tree"><a href="charts/map/index.php"><?echo Login::NoTrees();?></a></span><p>Trees</p></li>
                <li><span class="observation"><?echo Login::NoOfObservation();?></span><p>Observations</p></li>
                <!--<li><span class="observation"><?echo number_format(Login::NoOfObservation());?></span><p>Observations</p></li>-->
                <li><span class="participant"><a href="participantlist.php"><?echo Login::NoParticipants();?></a></span><p>Participants</p></li>
                <li><span class="school"><a href="schoollist.php"><? echo Login::NoSchools();?></span><p class="schools"><a href="">Schools</p></li>
                         
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
                <?php if(!isset($_SESSION['log_status'])){?>
                <li ><a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('fade').style.display='block'" >Register</a></li>
                <!--<li><a href="register.php" <?php if (basename($_SERVER['PHP_SELF'])=='register.php') {?> class="active" <?php } ?>title="Register ">Register</a></li>-->
                <?php 
                }
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
                            <li><a href ="dashboard.php" title="My Dashboard">Dashboard</a></li>
                                    <li><a href ="memprofile.php"    title="Profile">Profile</a></li>
                                    
                                
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
<div id="lightpwdsucessmsg" class="white_contentOne2">
<?include 'forgotpwdsucessmsg.php'?>
</div>     

                    

                        <div id="fade" class="black_overlay"></div>
                    </div> <!--  end menu  -->
                    
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
                            Sliderman.effect({name: 'demo01', cols: 10, rows: 5, delay: 5, fade: true, order: 'straight_stairs'});
                            var demoSlider = Sliderman.slider({container: 'SliderName', width: 940, height: 505, effects:'demo01',
                            display: {
                            pause: true, // slider pauses on mouseover
                            autoplay: 3000, // 3 seconds slideshow
                            always_show_loading: 200, // testing loading mode
                            description: { opacity: 0.5, height: 100, position: 'bottom'}, // image description box settings
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
                                            <div id="img_slider1">
                                            <img src="images/Devil'sTree_Alstonia_scholaris.gif" alt="Css Template Preview" />
                                            <div class="Slider2NameDescription"><span>Devil's Tree <br/> <i>Alstonia scholaris</i></span></div>
                                             <img src="images/jackfruit.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Jackfruit <br/> <i>Artocarpus heterophyllus</i></span></div>
                                             <img src="images/RedSilkCotton_Bombax_ceiba.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Red Slik Cotton <br/><i>Bombax ceiba</i></span></div>
                                             <img src="images/Siris_Albizia_lebbek.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Siris <br/> <i>Albizia lebbeck</i></span></div>
                                             <img src="images/Gulmohar_Delonix_regia.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Gulmohar <br/> <i>Delonix regia</i></span></div>
                                             <img src="images/Neem_Azadirachta_indica.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Neem <br/> <i>Azadirachta indica</i></span></div>
                                             <img src="images/Pongam_Pongamia_pinnata.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Pongam <br/> <i>Pongamia pinnata</i></span></div>
                                             <img src="images/IndianCoralTree_Erythrina_indica.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Indian Coral <br/> <i>Erythrina indica</i></span></div>
                                             <img src="images/Purple_Bauhinia_Bauhinia_purpurea.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Purple Bauhinia <br/> <i>Bauhinia purpurea</i></span></div>
                                             <img src="images/Banyan_Ficus_benghalensis.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Banyan <br/> <i>Ficus benghalensis</i></span></div>
                                             <img src="images/Mango_Mangifera_indica.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Mango<br/> <i>Mangifera indica</i></span></div>
                                             <img src="images/Amla_Phyllanthus_emblica.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Amla <br/><i>Phyllanthus emblica</i></span></div>
                                             <img src="images/Jarul_Lagerstroemia_speciosa.gif" alt="Css Template Preview" />
                                             <div class="Slider2NameDescription"><span>Jarul<br/> <i>Lagerstroemia speciosa</i></span></div>
                                                                                      
                                            </div>
                                            
                                            <div id="SliderNameNavigation1"></div>
                                            
                                            <script type="text/javascript">
                            //the first four images.                    
                            // we created new effect and called it 'demo01'. We use this name later.
                            Sliderman.effect({name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs'});
                            var demoSlider = Sliderman.slider({container: 'img_slider1', width: 260, height: 330, effects:'demo01',
                            display: {
                            pause: true, // slider pauses on mouseover
                            autoplay: 3000, // 3 seconds slideshow
                            always_show_loading: 200, // testing loading mode
                            description: { background: 'rgb(237, 237, 237)', opacity: 0.1, height: 50, position: 'bottom'}, // image description box settings
                            //loading: {background: '#000000', opacity: 0.2, image: 'images/loading.gif'}, // loading box settings
                            buttons: {opacity: 1, prev: {className: 'Slider2NamePrev', label: ''}, next: {className: 'Slider2NameNext', label: ''}}, // Next/Prev buttons settings
                            //navigation: {container: 'SliderNameNavigation1', label: '&nbsp;'} // navigation (pages) settings
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
            <div id="25focallist" class="white_contentOneSp">
            <?include 'focalspecieslist.php'?>
            </div> 
            <div id="allspecieslist" class="white_contentOneSp">
            <?include 'allspecieslist.php'?>
            </div> 
            <div class="body_top1"><!--  start main  -->
                <div class="main">
                    <h3 class="Rhythm_TEXT"><a name="selecttree">Select</a></h3>
                    <div class="container"> 
                        <div class="left_BOX">
                            <p class="leftSection_TEXT">
                            The tree species that we are monitoring in SeasonWatch have 
                            been chosen because they are widely distributed 
                            across our country. 
				You can select from a list of <a href = "javascript:void(0)" 
                                onclick = "document.getElementById('25focallist').style.display='block';
                                    document.getElementById('fade').style.display='block';window.scrollTo(0, 0);" ><span class="red">
                                        25 focal species</span></a>, but are also
				welcome to check out the<a href = "javascript:void(0)" 
                                onclick = "document.getElementById('allspecieslist').style.display='block';
                                    document.getElementById('fade').style.display='block';window.scrollTop(0,0)" ><span class="red"> entire list of species</span></a> being monitored.
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
