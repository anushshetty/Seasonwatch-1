<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 <a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='none';document.getElementById('lightregstep2').style.display='none';document.getElementById('lightregstep3').style.display='none';document.getElementById('fade').style.display='none';Clearregstep3();"><img src="images/close.png" alt="close" id="step3cls"/></a>
                            <div class="registerLightBox">
                            <form name="regstep3" id="regstep3" method="POST" >
                            <h2><?=$Lang->GetString("register_menu")?></h2>
                            <p id="selschool">&nbsp; </p> 
                            <p id="schinfo"><?=$Lang->GetString("registerfillinfo_text")?></p>
                            <div id="schoolregmsg" class="regconfmessage" ></div>
                            <div id="schoolerrregmsg" style="font-weight:bold; color:#F00; font-size:14px;margin:0px 0 20px 20px; padding:0px 0px 0px 20px;" ></div>
                            <input id="schnameclear" type="text"name="schnameclear" value="Name" autocomplete="off"  />
                            <input id="schnametext" type="text" name="schnametext" value="" autocomplete="off" />
                            <input id="schaddclear" type="text" name="schaddclear" value="Address" autocomplete="off"  />
                            <input id="schaddtext" type="text" name="schaddtext" value="" autocomplete="off" />
                            <input id="schcityclear" type="text" name="schcityclear" value="City" autocomplete="off"  />
                            <input id="schcitytext" type="text" name="schcitytext" value="" autocomplete="off"  onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/>
                            <input id="schphclear" type="text" name="schphclear" value="Phone Number" autocomplete="off"  />
                            <input id="schphtext" type="text" name="schphtext" value="" autocomplete="off"  />
                            <select class="sellist" value="" id="schstatetext"  name="schstatetext" >
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
                            <input type="hidden" id="schcordname"  name="schcordname" value=""/>
                            <input type="hidden" id="schcordfullname" name="schcordfullname" value=""/>
                            <input type="hidden" id="schcordmailid" name="schcordmailid" value=""/>
                            <input type="hidden" id="schcordpwd" name="schcordpwd" value=""/>
                            <input type="hidden" id="schcordmob" name="schcordmob" value=""/>
                             <input type="hidden" id="schcat" name="schcat" value=""/>
                            
                            <!--<a href="#" class="next" onclick = "return SchoolRegister()" id="step3pregbutton" >REGISTER</a>-->
                            
                            <a href="#" class="next" onclick = "document.getElementById('lightregstep3').style.display='none';document.getElementById('lightregstep2').style.display='block';" id="step3regbutton" ><?=$Lang->GetString("previous_but")?></a>
                            <input name="SCHOOLREG" id="SCHOOLREG" type="submit" value="<?=$Lang->GetString("register_menu")?>" class="submitreg" style="cursor:pointer;"  />
                            <a href="#" id="step3cancel" ><?=$Lang->GetString("cancel_but")?></a>
                            
                            <div class="clearBoth"></div>
                            <br>
                            <div ><p ><?=$Lang->GetString("queries_text")?> - sw@seasonwatch.in </p> </div>  
                            <div class="clearBoth"></div>  
                             </form>
                            </div>
