<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep1();"><img src="images/close.png" alt="close" id="step1cls" /></a>
    <div class="registerLightBox">
       
       <form name="regstep1">
            <h2><?=$Lang->GetString("register_menu")?></h2>
 	    <div id="step1errormsg"  align="center" style="font-weight:normal; color:#F00; font-size:14px;"></div>
            <ul>
                <li><input type="radio"  id ="selopt"  name="selopt" value="1"> <?=$Lang->GetString("registerasindiv_text")?></li></br>
                <li><input type="radio" id ="selopt" name="selopt"  value="2"> <?=$Lang->GetString("registerasschool_text")?></li>
            </ul>
            </br>
            <input type="hidden"  id="selsite" value="">
            <div><p class="regmessage" ><?=$Lang->GetString("seed_text1")?> <?=$Lang->GetString("seed_text2")?>
            </p></div>
            <a href="#" id="step1next" class="next"  name="step1next" onClick="step1();" ><?=$Lang->GetString("next_but")?></a>
            <a href="#" id="step1cancel" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';Clearregstep1();"><?=$Lang->GetString("cancel_but")?></a>
        </form>
    </div>
