<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php 
/* Initial development:- Loads when user logged in .
 * loads the profile page & dashboard pages according to the school category
 */
	    //include_once("includes/Login.php");
        ?>
<!-- script>
<script type="text/javascript" src="js/loginfunction.js"></script-->

 
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
                                <p title="<?echo $_SESSION['fullname']?>">Welcome <?php echo ucfirst($displayname) ?>
                                    
                                <ul>
                                <?php /* switch ($_SESSION['usercategory']) 
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
                                }*/
                                ?>
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
               
                        <div id="light" class="white_content">
                        <?  include 'userlogin.php';?>
                         </div>
                        <div id="lightone" class="white_content"><!-- forgot password-->
                            <a href = "javascript:void(0)" onclick = "document.getElementById('lightone').style.display='none';document.getElementById('fadeone').style.display='none';window.location.reload(true);"><img src="images/close.png" alt="close" /></a>
                            <p class="date_time"><?php echo date("F j, Y, g:i a"); ?></p>
                            <h3 class="log">Forgot Password</h3>
                            <div id="formsg" align="center" style="font-weight:bold; color:#F00; font-size:14px;"></div>
                            <p class="pwd">
                            <input value="Email Address"  name="forgot_email" id="forgot_email" type="text" class="password_FIELD" onfocus="if(this.value=='Email Address')this.value='';" onblur="if(this.value=='')this.value='Email Address';"  />
                            <input name="" type="submit" value="SEND" class="lightbox_LOGIN" onClick="forgot_check();" style="cursor:pointer;" />
                            </p>
                        </div>
                        <div id ="light1" class="white_content">  <!-- To change Password--> 
                            <a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none';window.location.reload(true);"><img src="images/close.png" alt="close" /></a>
                            <p class="date_time"><?php $log_time=getdate(date("U"));print(" $log_time[mday] $log_time[month] $log_time[year],$log_time[weekday]");?></p>
                            <h3 class="log">Change Password</h3>
                            <div id="logpwdmsg" align="center" style="font-weight:bold; color:#F00; font-size:14px;"></div>
                            <div ><label>&nbsp;&nbsp;&nbsp;&nbsp;Old Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input id="oldpwd" type="password" value=""  class="textField" /></label></div>
                            <br>
                            <div ><label>&nbsp;&nbsp;&nbsp;New Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input id="newpwd" name ="newpwd" type="password" value=""  class="textField" /></label></div>
                            <br>
                            <div ><label>&nbsp;&nbsp;&nbsp;Reconfirm Password&nbsp; 
                            <input id="newpwd1" name="newpwd1" type="password" value=""  class="textField" /></label></div>
                            <br>
                            <div align="center"><input type="submit" value="Ok" onClick="ChangePwd();"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Cancel"/></div>
                        </div>
                        <!-- for Register page step1-->
                        <div id="lightReg" class="white_contentOne2">
                            <a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep1();"><img src="images/close.png" alt="close" /></a>
                            <div class="registerLightBox">
                                <form name="regstep1">
                                <h2>Register</h2>
                                <ul>
                                    <li><input type="radio"  id ="selopt"  name="selopt" value="1"> Register me as an Individual</li><br>
                                    <li><input type="radio" id ="selopt" name="selopt"  value="2"> Register as a school </li>
                                <input type="hidden"  id="selsite" value=""/>
                                </ul>
                                <br>
                                <div><p class="regmessage" >If your school is part of Mathrubhumi-SEED,
                                please use your SEED username and 12345 as password to login.</p></div>
                                <a href="#" id="step1next" class="next" onclick = "checkproceed()">NEXT</a>
                                <a href="#" id="step1cancel" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep1();">Cancel</a>
                                </form>
                            </div>
                        </div>
                                     <!-- for Register page step2-->
                      <div id="lightregstep2" class="white_contentOne2">
                           <a href = "javascript:void(0)" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep2();"><img src="images/close.png" alt="close" /></a>
                           <div class="registerLightBox">
                            <form name="regstep2">
                                <h2>Register</h2>
                                <p id="myText">&nbsp; </p> 
                                 <div id="regmsg"  class="regconfmessage"></div>
                                <div id="regerrmsg"   align="center" style="font-weight:bold; color:#F00; font-size:14px;"></div>
                                <input id="name-clear" type="text" name="name" value="User Name" autocomplete="off"  title="Please enter alphanumeric key only."/>
                                <input id="name-text" type="text" name="name" value="" autocomplete="off" onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric key only." />
                                <input id="mailid-clear" type="text" name="mailid" value="Email Address" autocomplete="off" />
                                <input id="mailid-text" type="text" name="mailid" value="" autocomplete="off"  title="Please enter alphanumeric key only."/>
 				    <input id="fullname-clear" type="text" name="fullname-clear" value="Full Name" autocomplete="off"  title="Please enter alphanumeric key only."/>
                                <input id="fullname-text" type="text" name="fullname-text" value="" autocomplete="off" onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric key only." />
                                
                                <input id="mobno-clear" type="text" name="mobno" value="Mobile no" autocomplete="off"  title="Please enter number only."/>
                                <input id="mobno-text" type="text" name="mobno" value="" autocomplete="off"  onKeyPress="return numbersonly(this, event)" title="Please enter number only." />
                                <div class="clearBoth"></div>
                                <br>
                                <!--<input type="text" name="mailid" id="mailid" value="Email Address" class="login_NAME" onfocus="if(this.value=='MailID')this.value='';" onblur="if(this.value=='')this.value='MailID';" />-->
                                <input id="password-clear" type="text" name="password" value="Password" autocomplete="off"  />
                                <input id="password-password" type="password" name="password" value="" autocomplete="off"  />
                                <input id="cnfrmpassword-clear" type="text" name="cnfrmpassword" value="Confirm password" autocomplete="off"  />
                                <input id="cnfrmpassword-password" type="password" name="cnfrmpassword" value="" autocomplete="off"  />
                                <div class="clearBoth"></div>
                                <input type="checkbox" name="gsp"  id="gsp" style="display: none;"/><label style="display: none;padding:0px 20px;" id="gsplabel">Green Schools Program.</label>
                                <div class="clearBoth"></div>
                                <a href="#" class="next" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('lightregstep2').style.display='none';" id="prebutton" style="display: none;" >PREVIOUS</a>
                                <a href="#" class="next" onclick = "checkproceedstep2()" id="regbutton" style="display: none;">REGISTER</a>
                                <a href="#" class="next" onclick = "checkproceedstep2()" id="regnextbut" style="display: none;">NEXT</a>
                                <a href="#" id="cancelbut" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('lightReg').style.display='none';Clearregstep2();">Cancel</a>
                                <a href="#"  id="closebut" style="display: none" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep2();">Close</a>
                                <div class="clearBoth"></div> 
                                <br>
                                <div ><p >Queries - sw@seasonwatch.in </p> </div> 
                                <div class="clearBoth"></div>  
                            </form>
                        </div>
                      </div>
                      <!-- for Register page step3-->
                      <div id="lightregstep3" class="white_contentOne2">
                            <a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('lightregstep2').style.display='none';document.getElementById('lightregstep3').style.display='none';document.getElementById('fade').style.display='none';Clearregstep3();"><img src="images/close.png" alt="close" /></a>
                            <div class="registerLightBox">
                             <form name="regstep3">
                            <h2>Register</h2>
                            <p id="selschool">&nbsp; </p> 
                            <p id="schinfo">Please fill your school information here.However, you can also add this information on profile page later.</p>
				<div id="schoolregmsg" class="regconfmessage" ></div>
                            <div id="schoolerrregmsg" style="font-weight:bold; color:#F00; font-size:14px;" ></div>

                            
                            <input id="schname-clear" type="text" value="Name" autocomplete="off"  title="Please enter alphanumeric key only."/>
                            <input id="schname-text" type="text" name="schname" value="" autocomplete="off"  onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric key only."/>
                            <input id="schadd-clear" type="text" value="Address" autocomplete="off"  />
                            <input id="schadd-text" type="text" name="schadd" value="" autocomplete="off" />
                            <input id="schcity-clear" type="text" value="City" autocomplete="off"  title="Please enter alphanumeric key only."/>
                            <input id="schcity-text" type="text" name="schcity" value="" autocomplete="off"  onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric key only."/>
                            <input id="schph-clear" type="text" value="Phone Number" autocomplete="off"  title="Please enter number only."/>
                            <input id="schph-text" type="text" name="schph" value="" autocomplete="off"  onKeyPress="return numbersonly(this, event)" title="Please enter number only." />
                            <select class="sellist" value="" id="schstate-text"  name="schoolstate" >
                            <option  value="0" >Select State</option>
                            <option value="1" >Andaman and Nicobar Islands</option>
                            <option value="2">Andhra Pradesh</option>
                            <option value="3">Arunachal Pradesh</option>
                            <option value="4">Assam</option>
                            <option value="5">Bihar</option>
                            <option value="6">Chandigarh</option>
                            <option value="7">Chhattisgarh</option>
                            <option value="8">Dadra and Nagar Haveli</option>
                            <option value="9">Daman and Diu</option>
                            <option value="10">Delhi</option>
                            <option value="11">Goa</option>
                            <option value="12">Gujarat</option>
                            <option value="13">Haryana</option>
                            <option value="14">Himachal Pradesh</option>
                            <option value="15">Jammu and Kashmir</option>
                            <option value="16">Jharkhand</option>
                            <option value="17">Karnataka</option>
                            <option value="18">Kerala</option>
                            <option value="19">Lakshadweep</option>
                            <option value="20">Madhya Pradesh</option>
                            <option value="21">Maharashtra</option>
                            <option value="22">Manipur</option>
                            <option value="23">Meghalaya</option>
                            <option value="24">Mizoram</option>
                            <option value="25">Nagaland</option>
                            <option value="26">Orissa</option>
                            <option value="27">Pondicherry</option>
                            <option value="28">Punjab</option>
                            <option value="29">Rajasthan</option>
                            <option value="30">Sikkim</option>
                            <option value="31">Tamil Nadu</option>
                            <option value="32">Tripura</option>
                            <option value="33">Uttaranchal</option>
                            <option value="34">Uttar Pradesh</option>
                            <option value="35">West Bengal</option>
                            </select>
                            <div class="clearBoth"></div>
                            <a href="#" class="next" onclick = "checkproceedstep3()" id="step3pregbutton" >REGISTER</a>
                            <a href="#" class="next" onclick = "document.getElementById('lightregstep3').style.display='none';document.getElementById('lightregstep2').style.display='block';" id="step3regbutton" >PREVIOUS</a>
                            <a href="#" id="step3cancel" onclick = "document.getElementById('lightregstep3').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep3();">Cancel</a>
                            <a href="#"  id="step3closebut" style="display: none" onclick = "document.getElementById('lightregstep3').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep3();">Close</a>
                            <div class="clearBoth"></div>
                            <br>
                            <div ><p >Queries - sw@seasonwatch.in </p> </div> 
                            <div class="clearBoth"></div>  
                             </form>
                            </div>
                        </div>
                    <div id="fade" class="black_overlay"></div>
                </div><!--  end menu  --><!--  start banner  --><!--  end banner  -->
            </div><!--  end header  -->
        </div><!--  end main  -->
    <div class="clearBoth"></div>
</div>
