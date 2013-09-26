<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a href = "javascript:void(0)" onclick = "document.getElementById('lightregIndivstep2').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';clearIndivreg();"><img src="images/close.png" alt="close" id="step2cls"/></a>
   <div class="registerLightBox">
   <form name="regstep2" id ="regstep2"  method="post" action="logincheck.php"  onSubmit="return validate_regIndivstep();">
    <h2>Register</h2>
    <input type="hidden" name="path" id="id_path" value="<?php echo $_SERVER['SCRIPT_NAME'] ?>";/>
     <div id="indvmsg"  class="regconfmessage"  >Register as Individual</div>
        <div id="regmsg"  class="regconfmessage"></div>
        <div id="regerrmsg"   class="reginidverrmsg"></div>
        <div id="stepIndverrormsg"  class="reginidverrmsg"><h2></h2></div>
         <!--/* Not used for individual or school or school-gsp*/-->
        <!--<input id="Indivnameclear" type="text" name="Indivnameclear" value="User Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>-->
        <input id="Indivnametext" type="hidden" name="Indivnametext"  id="Indivnametext" value="" autocomplete="off"   onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/>
        <input id="Indivmailidclear" type="text" name="Indivmailidclear" value="Email Address" autocomplete="off" />
        <input id="Indivmailidtext" type="text" name="Indivmailidtext" value="" autocomplete="off"  onchange="Indivmailidcopyusername()"/> 
        <input id="Indivfullnameclear" type="text" name="Indivfullnameclear" value="Full Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>
         <input id="Indivfullnametext" type="text" name="Indivfullnametext" value="" autocomplete="off"  />
        <input id="Indivmobnoclear" type="text" name="Indivmobnoclear" value="Mobile number (optional)" autocomplete="off"   title="Please enter number keys only."/>
        <input id="Indivmobnotext" type="text" name="Indivmobnotext" value="" autocomplete="off"  onKeyPress="return numbersonly(this, event)" title="Please enter number keys only." />
        <div class="clearBoth"></div>
        <br>
        
        <input id="Indivpasswordclear" type="text" name="Indivpasswordclear" value="Password" autocomplete="off"  />
        <input id="Indivpassword" type="password" name="Indivpassword" value="" autocomplete="off"  />
        <input id="Indivcnfrmpasswordclear" type="text" name="Indivcnfrmpasswordclear" value="Confirm password" autocomplete="off"  />
        <input id="Indivcnfrmpassword" type="password" name="Indivcnfrmpassword" value="" autocomplete="off"  />
        <br>
         <div class="clearBoth"></div>
        <a href="#" class="next" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('lightregIndivstep2').style.display='none';clearerrmsg()" id="prebutton"  >PREVIOUS</a>
         &nbsp;&nbsp;<input name="INDIVREG" id="INDIVREG" type="submit" value="REGISTER" class="submitreg" onmouseover="" style="cursor: pointer;"   />
        <a href="#" id="step2Indvcancel" onclick = "document.getElementById('lightregIndivstep2').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('lightReg').style.display='none';clearIndivreg()">Cancel</a>
         <div class="clearBoth"></div> 
        <div ><p >Queries - sw@seasonwatch.in </p> </div> 
        <div class="clearBoth"></div>  
    </form>
</div>