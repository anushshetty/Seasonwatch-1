<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * /
 if(isset($_POST['login_name']))
 {$username = mysql_real_escape_string($_POST['login_name']);
echo $username;
 }*/
 
 //session_start();
//echo  $Lang->GetLanguage();
    ?>

<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('login_name').value='User Name';document.getElementById('login_pass').value='Password';$('input:checkbox').attr('checked', false);"><img src="images/close.png" alt="close" id="logincls"/></a>
<form name="loginform" method="post" id="loginform" action="" onSubmit="return validate_idpwd();">
<p class="date_time"><?php $today=date("d-m-Y");$weekday= date("l"); print("$today, $weekday");?> </p>
<h3 class="log"><?=$Lang->GetString("login_menu")?></h3>
<?php
						
						if(isset($_SESSION['msg']['login-err']))
						{
							echo '<div class="loginerror">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
							session_destroy();
						}
					?>
<div id="logmsg" align="center" style="font-weight:normal; color:#F00; font-size:14px;" ></div>
<input type="text" name="login_name" id="login_name"  class="login_NAME" value="User Name" onfocus="if(this.value=='User Name')this.value='';" onblur="if(this.value=='')this.value='User Name';"  />
<p class="pwd">
<input   name="login_pass" id="login_pass" type="password" class="password_FIELD" value="<? if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];} else {echo "Password"; }?>"onfocus="if(this.value=='Password')this.value='';" onblur="if(this.value=='')this.value='Password';"  />
<input name="LOGIN" id="loginbut" type="submit" value="<?=$Lang->GetString("login_but")?>" class="lightbox_LOGIN" style="cursor:pointer;"  />
</p>
<p>
     
<input type="checkbox" name="remember"  id="remember" /><label class="label_NAME" ><?=$Lang->GetString("rememberme_text")?></label>
<a class="forget_password" href="javascript:void(0)" onclick = "document.getElementById('lightone').style.display='block';document.getElementById('fade').style.display='block';"><?=$Lang->GetString("forgotpwd_text")?></a>
</p>
</form>
  