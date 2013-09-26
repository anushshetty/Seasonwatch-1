<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 <a href = "javascript:void(0)" onclick = "document.getElementById('lightone').style.display='none';document.getElementById('fadeone').style.display='none';document.getElementById('forgot_email').value='Email Address';"><img src="images/close.png" alt="close" id="forgotpwdcls" /></a>
 <form name="forgotpwd" id ="forgotpwd" method="post" action="" onSubmit="forgot_check();">
    <p class="date_time"><?php $today=date("d-m-Y");$weekday= date("l"); print("$today,$weekday");?></p>
    <h3 class="forgotlog">Forgot Password</h3>
    <div class="forgotpwdmsg" >Please enter your email address. The new password will be mailed to you.</div>
    <p class="pwd">
    <input value="Email Address"  name="forgot_email" id="forgot_email" type="text" class="password_FIELD" onfocus="if(this.value=='Email Address')this.value='';" onblur="if(this.value=='')this.value='Email Address';"  />
    <!--<input name="" type="submit" value="SEND" class="lightbox_LOGIN" onClick="forgot_check();" style="cursor:pointer;" />-->
     <input name="FORGOTPWD" id="FORGOTPWD" type="submit" value="SEND" class="lightbox_LOGIN"  />
    </p>
    </form>