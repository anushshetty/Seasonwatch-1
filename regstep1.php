<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep1();"><img src="images/close.png" alt="close" id="step1cls" /></a>
    <div class="registerLightBox">
       
       <form name="regstep1">
            <h2>Register</h2>
 	    <div id="step1errormsg"   style="margin-top:10px; margin-left:55px;font-weight:normal; color:#F00; font-size:16px;width:320px;"></div>
  		

            <ul>
                <li><input type="radio"  id ="selopt"  name="selopt" value="1"> Register me as an Individual</li></br>
                <li><input type="radio" id ="selopt" name="selopt"  value="2"> Register as a school </li>
            </ul>
            </br>
            <input type="hidden"  id="selsite" value="">
            <div><p class="regmessage" >If your school is part of Mathrubhumi-SEED,
            please use your SEED username and 12345 as password to login.</p></div>
            <a href="#" id="step1next" class="next"  name="step1next" onClick="step1();" >NEXT</a>
            <a href="#" id="step1cancel" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep1();">Cancel</a>
        </form>
    </div>
