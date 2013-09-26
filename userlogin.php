<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * /
*/
    ?>

<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('login_name').value='Email / Username';document.getElementById('login_pass').value='Password';$('input:checkbox').attr('checked', false);"><img src="images/close.png" alt="close" id="logincls"/></a>
<form name="loginform" method="post" id="loginform" action="logincheck.php" onSubmit="return validate_idpwd();">
<p class="date_time"><?php $today=date("d-m-Y");$weekday= date("l"); print("$today, $weekday");?></p>
<input type="hidden" name="path" id="id_path" value="<?php echo $_SERVER['SCRIPT_NAME'] ?>";/>
<h3 class="log">Login</h3>
<div id="logmsg" align="center"  class="loginerror" style="font-weight:normal; color:#F00; font-size:16px;width:320px;" ></div>
<input type="text" name="login_name" id="login_name"  class="login_NAME"  value="<? if(isset($_COOKIE['loginname'])) { echo $_COOKIE['loginname'];} else {echo "Email / Username"; }?>"onfocus="if(this.value=='Email / Username')this.value='';" onblur="if(this.value=='')this.value='Email / Username';"  />
<!--<div id="logmsg" align="center" style="font-weight:normal; color:#F00; font-size:14px;" ></div>
<input type="text" name="login_name" id="login_name"  class="login_NAME" value="User Name or Email address" onfocus="if(this.value=='User Name or Email address')this.value='';" onblur="if(this.value=='')this.value='User Name or Email address';"  />-->
<p class="pwd">
<input   name="login_pass" id="login_pass" type="password" class="password_FIELD" value="Password" onfocus="if(this.value=='Password')this.value='';" onblur="if(this.value=='')this.value='Password';"  />
<input name="LOGIN" id="loginbut" type="submit" value="LOGIN" class="lightbox_LOGIN" style="cursor:pointer;"  />
</p>
<p>
<input type="checkbox" name="remember"  id="remember" value="0"/><label class="label_NAME" >Remember me on this computer</label>
<a class="forget_password" href="javascript:void(0)" onclick = "document.getElementById('lightone').style.display='block';document.getElementById('fade').style.display='block';">Forgot your password?</a>
</p>
</form>
  