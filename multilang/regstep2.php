<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a href = "javascript:void(0)" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep2();"><img src="images/close.png" alt="close" id="step2cls"/></a>
   <div class="registerLightBox">
   <form name="regstep2" id ="regstep2"   >
     <h2><?=$Lang->GetString("register_menu")?></h2>
        <p id="myText">&nbsp;<?=$Lang->GetString("registerasschool_text")?> </p> 
        <div id="regmsg"  class="regconfmessage"></div>
        <div id="regerrmsg"   align="center" style="font-weight:bold; color:#F00; font-size:14px;"></div>
        <div id="step2errormsg"  align="center" style="font-weight:normal; color:#F00; font-size:14px;"></div>
        <br>
        <input id="nameclear" type="text" name="nameclear" value="User Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>
        <input id="nametext" type="text" name="nametext" value="" autocomplete="off"   onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/>
        <!--<input id="name-text" type="text" name="name" value="" autocomplete="off"/>-->
        <input id="mailidclear" type="text" name="mailidclear" value="Email Address" autocomplete="off" />
        <input id="mailidtext" type="text" name="mailid-text" value="" autocomplete="off"  /> 
        <input id="fullnameclear" type="text" name="fullnameclear" value="Full Name" autocomplete="off"  title="Please enter alphanumeric keys only."/>
         <input id="fullnametext" type="text" name="fullnametext" value="" autocomplete="off"  />
        <input id="mobnoclear" type="text" name="mobnoclear" value="Mobile no" autocomplete="off"   title="Please enter number keys only."/>
        <input id="mobnotext" type="text" name="mobnotext" value="" autocomplete="off"  onKeyPress="return numbersonly(this, event)" title="Please enter number keys only." />
        <div class="clearBoth"></div>
        <br>
        <!--<input type="text" name="mailid" id="mailid" value="Email Address" class="login_NAME" onfocus="if(this.value=='MailID')this.value='';" onblur="if(this.value=='')this.value='MailID';" />-->
        <input id="passwordclear" type="text" name="passwordclear" value="Password" autocomplete="off"  />
        <input id="password" type="password" name="password" value="" autocomplete="off"  />
        <input id="cnfrmpasswordclear" type="text" name="cnfrmpasswordclear" value="Confirm password" autocomplete="off"  />
        <input id="cnfrmpassword" type="password" name="cnfrmpassword" value="" autocomplete="off"  />
        <div class="clearBoth"></div>
        <input type="checkbox" name="gsp"  id="gsp"/><label style="padding:0px 20px;" id="gsplabel"><?=$Lang->GetString("gsplabel_text")?></label>
        <div class="clearBoth"></div>
        <a href="#" class="next" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('lightregstep2').style.display='none';clearerrmsg()" id="prebutton"><?=$Lang->GetString("previous_but")?></a>
        <a href="#" class="next" onclick = "RegisterAsSchool()" id="regnextbut" ><?=$Lang->GetString("next_but")?></a>
        <a href="#" id="step2cancelbut" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('lightReg').style.display='none';Clearregstep2();"><?=$Lang->GetString("cancel_but")?></a>
        <!--<a href="#"  id="closebut" style="display: none" onclick = "document.getElementById('lightregstep2').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';window.location.reload(true);">Close</a>-->
        <div class="clearBoth"></div> 
        <br>
        <div ><p ><?=$Lang->GetString("queries_text")?> - sw@seasonwatch.in </p> </div> 
        <div class="clearBoth"></div>  
    </form>
</div>