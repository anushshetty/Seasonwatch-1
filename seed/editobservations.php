<?php
//This page is called from profileTree.php in AJAX mode.
//On clicking Edit Observations on profileTree.php, it loads a form with from and to dates.
//On choosing dates and submitting, it throws up the list of observations from listobservations.php
//Within this list are emebedded Edit links for each observation. Clicking that triggers this page.

//Input is observation_id which is used to load the observation values on to the form.
//Once the user does the changes as needed and submits, 
//this page calls the javascript function edit_obs_submit on page profileTree.php to submit to DB.

	session_start();
	include_once("includes/dbc.php");
	
	$obsdetails = mysql_query("SELECT * FROM user_tree_observations WHERE observation_id='$_POST[observation_id]'"); 
	$usr_obs_detail = mysql_fetch_array($obsdetails);
?>
	<form name="edit_obs" id="edit_obs" method="POST" action="">
	<div class="treeModalLeft">
		<?php
		list($user_tree_id)=mysql_fetch_row(mysql_query("SELECT user_tree_id FROM user_tree_table
							WHERE user_id='$_SESSION[user_id]' AND tree_id='$tree_id'"));
		?>


		<input type="hidden" name="usertreeid" id="usertreeid" value="<?echo $user_tree_id; ?>" />
		<input type="hidden" name="observationid" id="observationid" value="<?echo $_POST[observation_id]; ?>" />
		<!--<input type="hidden" name="obdate" id="obdate" value="<?echo date("Y-m-d"); ?>" />-->
		<h1><? echo $_SESSION['school_code_sms'].$_POST[tree_code_sms]; ?>
		<span><? echo $_POST[tree_nickname]; ?></span></h1>
		<small>
        	Observed on
			<br/>
			(yyyy-mm-dd)
            <!--<select id="loc" name="loc" class="styled1"><option>27.10.2010</option><option>28.10.2010</option></select>-->
			<div><input type="text" name="obdate1" id="obdate1" value="<? echo $usr_obs_detail[date]; ?>" title="Enter the date in yyyy-mm-dd format"/></div>
        </small>
		
    	<ul class="treePartHeader">
    		<li class="first">LEAVES</li>
            <li class="second">none</li>
            <li class="third">few</li>
            <li class="fourth">many</li>
            <li class="fifth">don't know</li>    	
        </ul>
    	<ul class="treeLeaves">
        	<li class="first">Fresh</li>
            <li class="second"><input name="el1" <? if ($usr_obs_detail[freshleaf_count]=='0' ) echo "checked=checked"; ?> value="0" onclick="etoggleRadio(0,1)" type="radio"> </li>
            <li class="third"><input name="el1" <? if ($usr_obs_detail[freshleaf_count]=='1' ) echo "checked=checked"; ?> value="1" onclick="etoggleRadio(1,1)" type="radio"> <img src="images/l_02.png" alt="Few Fresh Leaves " title="Few Fresh Leaves" class="imgAlignVertical" ></li>
            <li class="fourth"><input name="el1" <? if ($usr_obs_detail[freshleaf_count]=='2' ) echo "checked=checked"; ?> value="2" onclick="etoggleRadio(2,1)" type="radio"> <img src="images/l_03.png" alt="Many Fresh Leaves " title="Many Fresh Leaves" class="imgAlignVertical" ></li>
            <li class="fifth"><input name="el1" <? if ($usr_obs_detail[freshleaf_count]=='-1' ) echo "checked=checked"; ?> value="-1" onclick="etoggleRadio('x',1)" type="radio"></li>			
        </ul>
		<!--<label class="treeLeaveslabel1" id="elbl1"><? if ($usr_obs_detail[freshleaf_count]=='-1' ) {echo "x";} else {echo $usr_obs_detail[freshleaf_count];} ?></label>-->
        <ul class="treeLeaves">
    		<li class="first">Mature</li>
            <li class="second"><input name="el2" <? if ($usr_obs_detail[matureleaf_count]=='0' ) echo "checked=checked"; ?> value="0" onclick="etoggleRadio(0,2)" type="radio"> </li>
            <li class="third"><input name="el2" <? if ($usr_obs_detail[matureleaf_count]=='1' ) echo "checked=checked"; ?> value="1" onclick="etoggleRadio(1,2)" type="radio"> <img src="images/ml_02.png" alt=" " class="imgAlignVertical" title="Few Mature Leaves" ></li>
            <li class="fourth"><input name="el2" <? if ($usr_obs_detail[matureleaf_count]=='2' ) echo "checked=checked"; ?> value="2" onclick="etoggleRadio(2,2)" type="radio"> <img src="images/ml_03.png" alt=" " class="imgAlignVertical" title="Few Mature Leaves"></li>
            <li class="fifth"><input name="el2" <? if ($usr_obs_detail[matureleaf_count]=='-1' ) echo "checked=checked"; ?> value="-1" onclick="etoggleRadio('x',2)" type="radio"></li>    	
        </ul>
		<!--<label class="treeLeaveslabel2" id="elbl2"><? if ($usr_obs_detail[matureleaf_count]=='-1' ) {echo "x";} else {echo $usr_obs_detail[matureleaf_count];} ?></label>-->
        
        
        <ul class="treePartHeader">
    		<li class="first">FLOWERS</li>
            <li class="second">none</li>
            <li class="third">few</li>
            <li class="fourth">many</li>
            <li class="fifth">don't know</li>    	
        </ul>
    	<ul class="treeFlowers">
    		<li class="first">Bud</li>
            <li class="second"><input name="ef1" <? if ($usr_obs_detail[bud_count]=='0' ) echo "checked=checked"; ?> value="0" onclick="etoggleRadio(0,3)" type="radio"> </li>
            <li class="third"><input name="ef1" <? if ($usr_obs_detail[bud_count]=='1' ) echo "checked=checked"; ?> value="1" onclick="etoggleRadio(1,3)" type="radio"> <img src="images/bu_02.png" alt="Few Buds. " class="imgAlignVertical" title="Few Buds."></li>
            <li class="fourth"><input name="ef1" <? if ($usr_obs_detail[bud_count]=='2' ) echo "checked=checked"; ?> value="2" onclick="etoggleRadio(2,3)" type="radio"> <img src="images/bu_03.png" alt="Many Buds. " class="imgAlignVertical" title="Many Buds." ></li>
            <li class="fifth"><input name="ef1" <? if ($usr_obs_detail[bud_count]=='-1' ) echo "checked=checked"; ?> value="-1" onclick="etoggleRadio('x',3)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFlowerlabel1" id="elbl3"><? if ($usr_obs_detail[bud_count]=='-1' ) {echo "x";} else {echo $usr_obs_detail[bud_count];} ?></label>	-->
        <ul class="treeFlowers">
    		<li class="first">Open</li>
            <li class="second"><input name="ef2" <? if ($usr_obs_detail[open_flower_count]=='0' ) echo "checked=checked"; ?> value="0" onclick="etoggleRadio(0,4)" type="radio"> </li>
            <li class="third"><input name="ef2" <? if ($usr_obs_detail[open_flower_count]=='1' ) echo "checked=checked"; ?> value="1" onclick="etoggleRadio(1,4)" type="radio"> <img src="images/f_02.png" alt="Few Buds Open. " class="imgAlignVertical" title="Few Buds Open." ></li>
            <li class="fourth"><input name="ef2" <? if ($usr_obs_detail[open_flower_count]=='2' ) echo "checked=checked"; ?> value="2" onclick="etoggleRadio(2,4)" type="radio"> <img src="images/f_03.png" alt="Many Buds Open. " class="imgAlignVertical" title="Many Buds Open."></li>
            <li class="fifth"><input name="ef2" <? if ($usr_obs_detail[open_flower_count]=='-1' ) echo "checked=checked"; ?> value="-1" onclick="etoggleRadio('x',4)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFlowerlabel2" id="elbl4"><? if ($usr_obs_detail[open_flower_count]=='-1' ) {echo "x";} else {echo $usr_obs_detail[open_flower_count];} ?></label>-->
        
        
        <ul class="treePartHeader">
    		<li class="first">FRUITS</li>
            <li class="second">none</li>
            <li class="third">few</li>
            <li class="fourth">many</li>
            <li class="fifth">don't know</li>    	
        </ul>
    	<ul class="treeFruits">
    		<li class="first">Unripe</li>
            <li class="second"><input name="efr1" <? if ($usr_obs_detail[fruit_unripe_count]=='0' ) echo "checked=checked"; ?> value="0" onclick="etoggleRadio(0,5)" type="radio"> </li>
            <li class="third"><input name="efr1" <? if ($usr_obs_detail[fruit_unripe_count]=='1' ) echo "checked=checked"; ?> value="1" onclick="etoggleRadio(1,5)" type="radio"> <img src="images/un_fr_02.png" alt="Few Unripe Fruits." class="imgAlignVertical" title="Few Unripe Fruits." ></li>
            <li class="fourth"><input name="efr1" <? if ($usr_obs_detail[fruit_unripe_count]=='2' ) echo "checked=checked"; ?> value="2" onclick="etoggleRadio(2,5)" type="radio"> <img src="images/un_fr_03.png" alt="Many Unripe Fruits. " class="imgAlignVertical" title="Many Unripe Fruits." ></li>
            <li class="fifth"><input name="efr1" <? if ($usr_obs_detail[fruit_unripe_count]=='-1' ) echo "checked=checked"; ?> value="-1" onclick="etoggleRadio('x',5)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFruitlabel1" id="elbl5"><? if ($usr_obs_detail[fruit_unripe_count]=='-1' ) {echo "x";} else {echo $usr_obs_detail[fruit_unripe_count];} ?></label>-->
        <ul class="treeFruits">
    		<li class="first">Ripe</li>
            <li class="second"><input name="efr2" <? if ($usr_obs_detail[fruit_ripe_count]=='0' ) echo "checked=checked"; ?> value="0" onclick="etoggleRadio(0,6)" type="radio"> </li>
            <li class="third"><input name="efr2" <? if ($usr_obs_detail[fruit_ripe_count]=='1' ) echo "checked=checked"; ?> value="1" onclick="etoggleRadio(1,6)" type="radio"> <img src="images/fr_02.png" alt="Few Ripe Fruits." class="imgAlignVertical" title="Few Ripe Fruits." ></li>
            <li class="fourth"><input name="efr2" <? if ($usr_obs_detail[fruit_ripe_count]=='2' ) echo "checked=checked"; ?> value="2" onclick="etoggleRadio(2,6)" type="radio"> <img src="images/fr_02.png" alt="Many Ripe Fruits. " class="imgAlignVertical" title="Many Ripe Fruits." ></li>
            <li class="fifth"><input name="efr2" <? if ($usr_obs_detail[fruit_ripe_count]=='-1' ) echo "checked=checked"; ?> value="-1" onclick="etoggleRadio('x',6)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFruitlabel2" id="elbl6"><? if ($usr_obs_detail[fruit_ripe_count]=='-1' ) {echo "x";} else {echo $usr_obs_detail[fruit_ripe_count];} ?></label>-->
    </div>

    <div class="treeModalRight">
    	
        <h1>Insects/Birds/Animals</h1>
        
        <span>Did you see these eating the leaves?</span>
        <dl>
        	<dt><input name="eleaf_caterpillar" id="eleaf_caterpillar" type="checkbox" value="" <? if ($usr_obs_detail[leaf_caterpillar]=='1' ) echo "checked"; ?> /></dt>
            <dd><img src="images/imgCaterpilar.jpg" alt=" " width="62" height="51" /></dd>
        </dl>
        
        <span>Were these pollinating the flowers?</span>
        <dl>
        	<dt><input name="eflower_butterfly" id="eflower_butterfly" type="checkbox" value="" <? if ($usr_obs_detail[flower_butterfly]=='1' ) echo "checked"; ?> /></dt>
            <dd><img src="images/imgButterly.jpg" alt=" " width="62" height="56" /></dd>
        </dl>
        <dl>
        	<dt><input name="eflower_bee" id="eflower_bee" type="checkbox" value="" <? if ($usr_obs_detail[flower_bee]=='1' ) echo "checked"; ?> /></dt>
            <dd><img src="images/imgAnt.jpg" alt=" " width="60" height="56" /></dd>
        </dl>
        
        <span>Were they eating the fruit?</span>
        <dl>
        	<dt><input name="efruit_monkey" id="efruit_monkey" type="checkbox" value="" <? if ($usr_obs_detail[fruit_monkey]=='1' ) echo "checked"; ?> /></dt>
            <dd><img src="images/imgMonkey.jpg" alt=" " width="56" height="65" /></dd>
        </dl>
        <dl>
        	<dt><input name="efruit_bird" id="efruit_bird" type="checkbox" value="" <? if ($usr_obs_detail[fruit_bird]=='1' ) echo "checked"; ?> /></dt>
            <dd><img src="images/imgBird.jpg" alt=" " width="47" height="57" /></dd>
        </dl>
        
        
    </div>
	
    <p>
		<input name="" type="submit" value="OK" class="submit3" onClick="edit_obs_submit(); return false;"/>  <input name="" class="close" value="CANCEL" type="button" 
		onClick="$('#mask').hide();$('.window').hide();">
		<span class="error3" style="display:none"> Observation NOT added. Please Re-enter all data and try again.</span>
		<span class="success3" style="display:none">Added successfully.</span>
    </p>
	</form>