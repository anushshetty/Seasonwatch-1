<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a href = "javascript:void(0)" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep2();"><img src="images/close.png" alt="close" id="step2cls"/></a>
   <div class="registerLightBox">
   <form name="regstep2" id ="regstep2"   >
     <h2>Register</h2>
         <div id="myText"  class="regconfmessage" >&nbsp;Register as School</div>
       <!-- <p id="myText" class="regconfmessage"  >&nbsp;Regsiter as School </p> -->
        <div id="regmsg"  class="reginidverrmsg"></div>
        <div id="regerrmsg"   class="reginidverrmsg"></div>
        <div id="step2errormsg"   class="reginidverrmsg" ></div>
        <br>
        <!--/* Not used for individual or school or school-gsp*/-->
       <!-- <input id="nameclear" type="text" name="nameclear" value="User Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>-->
        <input id="nametext" type="hidden" name="nametext"  value="" autocomplete="off"   onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/>
       
        <input id="mailidclear" type="text" name="mailidclear" value="Email Address" autocomplete="off" />
        <input id="mailidtext" type="text" name="mailidtext" value="" autocomplete="off" onchange="mailidcopyusername()" /> 
        <input id="fullnameclear" type="text" name="fullnameclear" value="Full Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>
         <input id="fullnametext" type="text" name="fullnametext" value="" autocomplete="off"  />
        <input id="mobnoclear" type="text" name="mobnoclear" value="Mobile number (optional)" autocomplete="off"   title="Please enter number keys only."/>
        <input id="mobnotext" type="text" name="mobnotext" value="" autocomplete="off"  onKeyPress="return numbersonly(this, event)" title="Please enter number keys only." />
        <div class="clearBoth"></div>
        <br>
        <input id="passwordclear" type="text" name="passwordclear" value="Password" autocomplete="off"  />
        <input id="password" type="password" name="password" value="" autocomplete="off"  />
        <input id="cnfrmpasswordclear" type="text" name="cnfrmpasswordclear" value="Confirm password" autocomplete="off"  />
        <input id="cnfrmpassword" type="password" name="cnfrmpassword" value="" autocomplete="off"  />
        <div class="clearBoth"></div>
        <div ><input type="checkbox" style="padding-top:5px;" name="gsp" id="gsp"/>&nbsp;&nbsp;Green Schools Program</div>
        </br>
        <div class="clearBoth"></div>
        <a href="#" class="next" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('lightregstep2').style.display='none';clearerrmsg()" id="prebutton"  >PREVIOUS</a>
        <a href="#" class="next" onclick = "RegisterAsSchool()" id="regnextbut" >NEXT</a>
        <a href="#" id="step2cancelbut" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('lightReg').style.display='none';Clearregstep2();">Cancel</a>
        <div class="clearBoth"></div> 
        <div ><p >Queries - sw@seasonwatch.in </p> </div> 
        <div class="clearBoth"></div>  
    </form>
</div>