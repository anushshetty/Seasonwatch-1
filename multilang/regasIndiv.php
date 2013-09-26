<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a href = "javascript:void(0)" onclick = "document.getElementById('lightregIndivstep2').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep2();"><img src="images/close.png" alt="close" id="step2cls"/></a>
   <div class="registerLightBox">
   <form name="regstep2" id ="regstep2"  method="post" action=""  onSubmit="return validate_regIndivstep();">
    <h2><?=$Lang->GetString("register_menu")?></h2>
     <div id="indvmsg"  class="regconfmessage"  ><?=$Lang->GetString("registerasindiv_text")?></div>
        <div id="regmsg"  class="regconfmessage"></div>
        <div id="regerrmsg"   align="center" style="font-weight:bold; color:#F00; font-size:14px;"></div>
        <div id="stepIndverrormsg"  align="center" style="font-weight:bold; color:#F00; font-size:14px;"></div>
        <br>
        <input id="Indivnameclear" type="text" name="Indivnameclear" value="User Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>
        <input id="Indivnametext" type="text" name="Indivnametext" value="" autocomplete="off"   onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/>
        <input id="Indivmailidclear" type="text" name="Indivmailidclear" value="Email Address" autocomplete="off" />
        <input id="Indivmailidtext" type="text" name="Indivmailidtext" value="" autocomplete="off"  /> 
        <input id="Indivfullnameclear" type="text" name="Indivfullnameclear" value="Full Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>
         <input id="Indivfullnametext" type="text" name="Indivfullnametext" value="" autocomplete="off"  />
        <input id="Indivmobnoclear" type="text" name="Indivmobnoclear" value="Mobile no" autocomplete="off"   title="Please enter number keys only."/>
        <input id="Indivmobnotext" type="text" name="Indivmobnotext" value="" autocomplete="off"  onKeyPress="return numbersonly(this, event)" title="Please enter number keys only." />
        <div class="clearBoth"></div>
        <br>
        <input id="Indivpasswordclear" type="text" name="Indivpasswordclear" value="Password" autocomplete="off"  />
        <input id="Indivpassword" type="password" name="Indivpassword" value="" autocomplete="off"  />
        <input id="Indivcnfrmpasswordclear" type="text" name="Indivcnfrmpasswordclear" value="Confirm password" autocomplete="off"  />
        <input id="Indivcnfrmpassword" type="password" name="Indivcnfrmpassword" value="" autocomplete="off"  />
        <a href="#" class="next" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('lightregIndivstep2').style.display='none';clearerrmsg()" id="prebutton"  ><?=$Lang->GetString("previous_but")?></a>
        <input name="INDIVREG" id="INDIVREG" type="submit" value="<?=$Lang->GetString("register_menu")?>" class="submitreg"   />
        <a href="#" id="step2Indvcancel" onclick = "document.getElementById('lightregIndivstep2').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('lightReg').style.display='none';"><?=$Lang->GetString("cancel_but")?></a>
         <div class="clearBoth"></div> 
        <br>
     
         <div ><p ><?=$Lang->GetString("queries_text")?> - sw@seasonwatch.in </p> </div> 
        <div class="clearBoth"></div>  
    </form>
</div>