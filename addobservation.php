<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<script type="text/javascript">
<!--

//-->
function resetobs<?php echo $i?>(){
	$("#obdate<?echo $i;?>").val('');
	
	$("#obdate<?echo $i;?>").datepicker('hide'); 
	//$(".addcalendar").datepicker('hide'); 	
	
	document.getElementById('sucessinfo<?echo $i?>').style.display='none';
	document.getElementById('dateerrormsg<?echo $i?>').style.display='none';
	$('input:radio[name=l1<?echo $i?>]')[0].checked=false;
	$('input:radio[name=l1<?echo $i?>]')[1].checked=false;
	$('input:radio[name=l2<?echo $i?>]')[0].checked=false;
	$('input:radio[name=l2<?echo $i?>]')[1].checked=false;
	$('input:radio[name=f1<?echo $i?>]')[0].checked=false;
	$('input:radio[name=f1<?echo $i?>]')[1].checked=false;
	$('input:radio[name=f2<?echo $i?>]')[0].checked=false;
	$('input:radio[name=f2<?echo $i?>]')[1].checked=false;
	$('input:radio[name=fr1<?echo $i?>]')[0].checked=false;
	$('input:radio[name=fr1<?echo $i?>]')[1].checked=false;
	$('input:radio[name=fr2<?echo $i?>]')[0].checked=false;
	$('input:radio[name=fr2<?echo $i?>]')[1].checked=false;

	}
</script>  

    
         <form name="add_obs" id="add_obs<?echo $i;?>" method="POST" action="" onSubmit="return Add_obs_submit(<?echo $i?>);">
  <a href = "javascript:void(0)" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='none';document.getElementById('fadeOne').style.display='none';resetobs<?php echo $i?>();"><img src="images/closeone.png" alt="close" /></a>  
    <div class="addDashBosrdcontainer">
        <div class="addDashBosrdcontainer_left">
            <div class="addDashBosrdcontainer_left_top">
            <?
            $TreeInfoobj = new Tree;
            $treeInfo= $TreeInfoobj->viewTreeinfo($dbc, $treeIDAr[$i]);
           
                       
            if(isset($_SESSION['msg']['addobserr']))
            {
            	$res_text=$_SESSION['msg']['addobserr'];
            	$string_array = explode(",",$res_text);
            	$errmsg=$string_array[0];
            	echo '<div class="err">'.$errmsg.'</div>';
            	unset($_SESSION['msg']['addobserr']);
            	
            }
            
                        
                       
            ?>
            <br>
             <h2>Add observation: <?echo   htmlspecialchars($treeInfo[0]); ?></h2>
             <!-- h5><?echo htmlspecialchars($treeInfo[1]); ?></h5-->
            </div>
            <input type="hidden" name="treeno" id="treeno" value="<?echo $i; ?>"  />
		<div class="addcalendar" style="margin-top:5px">
        		 <p>Observed On</p>
			 <p><blockquote><input type="text"  name ="obdate<?echo $i;?>" id="obdate<?echo $i;?>" onchange="checkdateexists(<?php echo $i;?>,<?php echo $treeInfo[6];?>)" readonly="true"/></blockquote></p>
		</div>
             
             <input type="hidden" name="usertreeid<?echo $i?>" id="usertreeid<?echo $i?>" value="<?echo $treeInfo[6];?>" />
              <span id="dateerrormsg<?echo $i?>" align="center" style="font-weight:normal; color:#F00; font-size:14px;display:none">  </span>
              <span id="sucessinfo<?echo $i?>" class="addsucess" style="display:none;"> Observation added sucessfully. </span>
            <div class="addleavesSection">
               <table width="452" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="addleavesSection_boxOne">LEAVES</td>
				<td class="addleavesSection_boxTwo">none</td>
				<td class="addleavesSection_boxThree">&nbsp;few</td>
				<td class="addleavesSection_boxFour">many</td>
				<td class="addleavesSection_boxFive">don't know</td>
			</tr>
			<tr>
				<td class="addleavesSection_arrow"><p>Fresh</p>&nbsp;&nbsp;<img src="images/one_leaf_fresh_many.png" /></td>
				<td class="addnone">
					<input name="l1<?echo $i;?>" id="l1<?echo $i;?>" type="radio"  value="0"   onclick="" >
					<blockquote>
					<img src="images/add_icon_none.png" alt="" />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="l1<?echo $i;?>" id="l1<?echo $i;?>" value="1" onclick="" type="radio">
					<blockquote>
					<img src="images/add_icon_leaf_fresh_few.png" alt="" />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="l1<?echo $i;?>" id="l1<?echo $i;?>"value="2" onclick="" type="radio">
					<blockquote>
					<img src="images/add_icon_leaf_fresh_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="l1<?echo $i;?>" id="l1<?echo $i;?>"value="-1"  onclick="" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="addleavesSection_arrow"><p>Mature</p> <img src="images/one_leaf_mature_many.png" /></td>
				<td class="addnone">
					<input name="l2<?echo $i;?>" id="l2<?echo $i;?>"  value="0"  onclick="toggleRadio(0,2)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="l2<?echo $i;?>"  id="l2<?echo $i;?>" value="1" onclick="toggleRadio(1,2)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_leaf_mature_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					 <input name="l2<?echo $i;?>"   id="l2<?echo $i;?>" value="2" onclick="toggleRadio(2,2)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_leaf_mature_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="l2<?echo $i;?>"  id="l2<?echo $i;?>" value="-1" onclick="toggleRadio(x,2)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
		</table>
            </div>
            <!-- leaf section ended-->
            <div class="addflowersSection">
		<table width="452" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td class="addleavesSection_boxOne">FLOWERS</td>
				<td class="addleavesSection_boxTwo">none</td>
				<td class="addleavesSection_boxThree">few</td>
				<td class="addleavesSection_boxFour">many</td>
				<td class="addleavesSection_boxFive">don't know</td>
				</tr>
			<tr>
				<td class="addflowersSection_arrow"><p>Bud</p>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/one_flower_bud_many.png"/></td>
                                <td class="addnone">
					<input name="f1<?echo $i;?>" id="f1<?echo $i;?>"  value="0"  onclick="toggleRadio(0,3)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="f1<?echo $i;?>" id="f1<?echo $i;?>" value="1" onclick="toggleRadio(1,3)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_flower_bud_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="f1<?echo $i;?>" id="f1<?echo $i;?>" value="2" onclick="toggleRadio(2,3)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_flower_bud_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="f1<?echo $i;?>" id="f1<?echo $i;?>" value="-1" onclick="toggleRadio(x,3)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
					</td>
			</tr>
				<tr><td height="10"></td></tr>
			<tr>
				<td class="addflowersSection_arrow"><p>Open</p>&nbsp;&nbsp;&nbsp;<img src="images/one_flower_open_many.png"/></td>
				<td class="addnone">
					<input name="f2<?echo $i;?>"  id="f2<?echo $i;?>"  value="0"  onclick="toggleRadio(0,4)" type="radio"> 
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="f2<?echo $i;?>"  id="f2<?echo $i;?>" value="1" onclick="toggleRadio(1,4)" type="radio"> 
					<blockquote>
					<img alt="" src="images/add_icon_flower_open_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="f2<?echo $i;?>"  id="f2<?echo $i;?>" value="2" onclick="toggleRadio(2,4)" type="radio"> 
					<blockquote>
					<img alt="" src="images/add_icon_flower_open_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="f2<?echo $i;?>" id="f2<?echo $i;?>" value="-1" onclick="toggleRadio(x,4)" type="radio"> 
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
		</table>
		<div class="clearBoth"></div>
	</div>
            	<!-- end of flowersection-->
	<div class="addfruitsSection">
		<table width="452" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td class="addleavesSection_boxOne">FRUITS</td>
			<td class="addleavesSection_boxTwo"> none</td>
			<td class="addleavesSection_boxThree">  few</td>
			<td class="addleavesSection_boxFour">  many</td>
			<td class="addleavesSection_boxFive">don't know</td>
			</tr>
			<tr>
				<td class="addfruitsSection_arrow"><p>Unripe</p><img src="images/one_fruit_unripe_many.png"/></td>
				<td class="addnone">
					<input name="fr1<?echo $i;?>" id="fr1<?echo $i;?>"  value="0"  onclick="toggleRadio(0,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="fr1<?echo $i;?>"  id="fr1<?echo $i;?>" value="1" onclick="toggleRadio(1,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_unripe_few.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="fr1<?echo $i;?>"  id="fr1<?echo $i;?>" value="2" onclick="toggleRadio(2,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_unripe_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="fr1<?echo $i;?>"  id="fr1<?echo $i;?>" value="-1" onclick="toggleRadio(x,5)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="addfruitsSection_arrow"><p>Ripe</p>&nbsp;&nbsp;<img src="images/one_fruit_ripe_many.png"/></td>
				<td class="addnone">
					<input name="fr2<?echo $i;?>" id="fr2<?echo $i;?>"  value="0"  onclick="toggleRadio(0,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="fr2<?echo $i;?>" id="fr2<?echo $i;?>" value="1" onclick="toggleRadio(1,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_ripe_few.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="fr2<?echo $i;?>" id="fr2<?echo $i;?>" value="2" onclick="toggleRadio(2,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_ripe_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="fr2<?echo $i;?>" id="fr2<?echo $i;?>" value="-1" onclick="toggleRadio(x,6)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
		</table>
		<div class="clearBoth"></div>
	</div>
        </div>
         <div class="addDashBosrdcontainer_right">
            <?$browsertype= Login::getBrowser(); 
              
             if ($browsertype['name'] == "Google Chrome") { ?> <div class="chormeaddadditionalBox"><?
 } 

    elseif ($browsertype['name'] == "Mozilla Firefox") { ?>
<div class="addadditionalBox">
   <? }else if ($browsertype['name'] == "Internet Explorer")  {?><div class="ieaddadditionalBox">

            <? } else{?><div class="chormeaddadditionalBox"><?} ?>
                <h4>Additional Observations <br /><span> I Saw...</span></h4>
                <table class="addAdditional_Observations" width="100%" border="0" cellspacing="0" cellpadding="10">
			<tr>
			<td style="width:20px;"><input name="leaf_caterpillar<?echo $i;?>" id="leaf_caterpillar<?echo $i;?>" type="checkbox" value="" title="Caterpillar eating leaves." /></td>
			<td style="width:61px;text-align:center;margin-top:10px"><img src="images/insectOne.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">caterpillars</span><br />eating the leaves</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="flower_bee<?echo $i;?>" id="flower_bee<?echo $i;?>" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/bee.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">bees</span><br />on the flowers</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="flower_butterfly<?echo $i;?>" id="flower_butterfly<?echo $i;?>" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/butterfly.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">butterflies</span><br />on the flowers</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="fruit_bird<?echo $i;?>" id="fruit_bird<?echo $i;?>" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/bird.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">birds</span><br />feeding on fruit</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="fruit_monkey<?echo $i;?>" id="fruit_monkey<?echo $i;?>" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/squirrel.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">Squirrels</span><br />feeding on fruit</td>
			<td>&nbsp;</td>
			</tr>
			<tr><td style="width:20px;"></td>
			</tr>
		</table>
            </div>
        </div>
    </div>
  <div class="clearBoth"></div>   
  <div class="addtestbutton_area">
       <!-- Buttons-->
      <? $pattern="..";
     if ($i==0)
      {?>
      <!-- div class="right_button"><a href="#" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='none';document.getElementById('lightOne<?echo $i+1;?>').style.display='block';document.getElementById('fadeOne').style.display='block'" title="Next Tree">NEXT TREE</a></div-->
        <?         
      }
       else if($i==($_SESSION['NoTrees']-1))
      { //show only previous button?>
      <!-- div class="left_button"><a href="#" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='none';document.getElementById('lightOne<?echo $lastcount-1?>').style.display='block';document.getElementById('fadeOne').style.display='block'" title="">PREVIOUS TREE</a></div-->
      <?}
      else
      {//show both next & previous button ?>
          <!-- div class="left_button"><a href="#" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='none';document.getElementById('lightOne<?echo $i+1;?>').style.display='block';document.getElementById('fadeOne').style.display='block'" title="<?echo $i+1;?>">PREVIOUS TREE</a></div>
          <div class="left_button"><a href="#" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='none';document.getElementById('lightOne<?echo $i-1;?>').style.display='block';document.getElementById('fadeOne').style.display='block'" title="<?echo $i-1;?>">NEXT TREE</a></div-->
     <?}?>
      <div class="right_side_button">
          <!-- div class="button_area_ok" name="OBS" type="submit"><a href="#" onClick="Add_obs_submit(<?echo $i?>)">OK</a></div-->
          <!-- div class="button_area_ok" type="submit">OK</a></div-->
           <input name="SAVE" id="OBS<?php echo $i;?>" type="submit" value="SAVE" class="addbutton_area_ok" style="cursor:pointer;margin-left:10px;margin-right:5px;width:85px;">
           	<div class="button_area_cancel"><a onclick="document.getElementById('lightOne<?echo $i;?>').style.display='none';document.getElementById('fadeOne').style.display='none';resetobs<?php echo $i?>();" href="javascript:void(0)">CANCEL</a></div>
	</div>
   </div>
   
  </form>      