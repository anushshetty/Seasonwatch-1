<?php

/*
 * Initial Development :- This page will be loaded when user clicks on Add observation link/
 * 
 * 
 */
//

?>

<!-- script src="js/jquery-1.7.1.min.js" type="text/javascript"></script> <!-- added for calendar arrows- ->
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script><!-- added for calendar arrows- ->
 <link rel="stylesheet" type="text/css" href="CSS/smoothness/jquery-ui-1.8.17.custom.css" /-->
<script>
$(document).ready(function()
    {
        // alert($(this).attr('id'));
        var dString = "Jan, 1, 2010";
        var d1 = new Date(dString);
        var d2 = new Date();// today's date. 
        var noofDays=DateDiff(d1, d2); //Calculates difference 
         $("#obdate").datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
         document.getElementById("dateerrormsg").display="none";
        document.getElementById(" msg").display="none";
    });
    // Function to calcualte difference between two dates.
    function DateDiff(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
        return parseInt((t2-t1)/(24*3600*1000));
    }
    function validate_addobser()
    {
        var dataString = "obdate="+$('#obdate').attr('value');
        dataString += "&treeid="+$('#treeid').attr('value');
        //alert(dataString);
        if (dataString=="")
        {
            document.getElementById("dateerrormsg").value="please ";
            document.getElementById("obdate").focus();
            return false;
        }
        var freshleave = $('input:radio[name=l1]:checked').val();
        if (freshleave == undefined ) 
        {  
            alert("Please select the Leaves Fresh option.");
            return false;
        }
        if ($('input:radio[name=l1]:checked').val()==0)
        {
        dataString += "&is_leaf_fresh=0&freshleaf_count=0";
        } else if ($('input:radio[name=l1]:checked').val()==1) {
        dataString += "&is_leaf_fresh=1&freshleaf_count=1";
        } else if ($('input:radio[name=l1]:checked').val()==2) {
        dataString += "&is_leaf_fresh=1&freshleaf_count=2";
        } else if ($('input:radio[name=l1]:checked').val()==-1) {
        dataString += "&is_leaf_fresh=-1&freshleaf_count=-1";
        }
         alert(dataString);
        var matureleave = $('input:radio[name=l2]:checked').val();
        if (matureleave == undefined ) 
        {  
            alert("Please select the Leaves Mature option.");
            return false;
        }
    if ($('input:radio[name=l2]:checked').val()==0)
    {
    dataString += "&is_leaf_mature=0&matureleaf_count=0";
    } else if (matureleave==1) {
    dataString += "&is_leaf_mature=1&matureleaf_count=1";
    } else if (matureleave==2) {
    dataString += "&is_leaf_mature=1&matureleaf_count=2";
    } else if (matureleave==-1) {
    dataString += "&is_leaf_mature=-1&matureleaf_count=-1";
    }
       alert(dataString);  
        var flowerBud = $('input:radio[name=f1]:checked').val();
        if (flowerBud == undefined ) 
        {  
            alert("Please select the Flower Bud option.");
            return false;
        }
        if ($('input:radio[name=f1]:checked').val()==0)
        {
        dataString += "&is_flower_bud=0&bud_count=0";
        } else if ($('input:radio[name=f1]:checked').val()==1) {
        dataString += "&is_flower_bud=1&bud_count=1";
        } else if ($('input:radio[name=f1]:checked').val()==2) {
        dataString += "&is_flower_bud=1&bud_count=2";
        } else if ($('input:radio[name=f1]:checked').val()==-1) {
        dataString += "&is_flower_bud=-1&bud_count=-1";
        }
         alert(dataString);
        var floweropen = $('input:radio[name=f2]:checked').val();
        if (floweropen == undefined ) 
        {  
            alert("Please select the Leaves Mature option.");
            return false;
        }
        if ($('input:radio[name=f2]:checked').val()==0)
        {
        dataString += "&is_flower_open=0&open_flower_count=0";
        } else if ($('input:radio[name=f2]:checked').val()==1) {
       dataString += "&is_flower_open=1&open_flower_count=1";
        } else if ($('input:radio[name=f2]:checked').val()==2) {
      dataString += "&is_flower_open=1&open_flower_count=2";
        } else if ($('input:radio[name=f2]:checked').val()==-1) {
       dataString += "&is_flower_open=-1&open_flower_count=-1";
        }
         alert(dataString);
        var fruitsunripe = $('input:radio[name=fr1]:checked').val();
        if (fruitsunripe == undefined ) 
        {  
            alert("Please select the Fruits Unriped option.");
            return false;
        }
        if ($('input:radio[name=fr1]:checked').val()==0)
        {
        dataString += "&is_fruit_unripe=0&fruit_unripe_count=0";
        } else if ($('input:radio[name=fr1]:checked').val()==1) {
        dataString += "&is_fruit_unripe=1&fruit_unripe_count=1";
        } else if ($('input:radio[name=fr1]:checked').val()==2) {
       dataString += "&is_fruit_unripe=1&fruit_unripe_count=2";
        } else if ($('input:radio[name=fr1]:checked').val()==-1) {
        dataString += "&is_fruit_unripe=-1&fruit_unripe_count=-1";
        }
         alert(dataString);
        var fruitsripe = $('input:radio[name=fr2]:checked').val();
        if (fruitsripe == undefined ) 
        {  
            alert("Please select the Fruits Unriped option.");
            return false;
        }
        if ($('input:radio[name=fr2]:checked').val()==0)
        {
        dataString += "&is_fruit_ripe=0&fruit_ripe_count=0";
        } else if ($('input:radio[name=fr2]:checked').val()==1) {
       dataString += "&is_fruit_ripe=1&fruit_ripe_count=1";
        } else if ($('input:radio[name=fr2]:checked').val()==2) {
        dataString += "&is_fruit_ripe=1&fruit_ripe_count=2";
        } else if ($('input:radio[name=fr2]:checked').val()==-1) {
       dataString += "&is_fruit_ripe=-1&fruit_ripe_count=-1";
        }
         alert(dataString);
        if(document.getElementById('leaf_caterpillar').checked)
{
	dataString += "&leaf_caterpillar=1";
}
else {
	dataString += "&leaf_caterpillar=";
}
if(document.getElementById('flower_butterfly').checked)
{
	dataString += "&flower_butterfly=1";
}
else {
	dataString += "&flower_butterfly=";
}
if(document.getElementById('flower_bee').checked)
{
	dataString += "&flower_bee=1";
}
else {
	dataString += "&flower_bee=";
}
if(document.getElementById('fruit_bird').checked)
{
	dataString += "&fruit_bird=1";
}
else {
	dataString += "&fruit_bird=";
}
if(document.getElementById('fruit_monkey').checked)
{
	dataString += "&fruit_monkey=1";
}
else {
	dataString += "&fruit_monkey=";
}

        
        //alert(dataString);
        $.ajax({
type: "POST",
url: "updatenewobservation.php",
data: dataString,
success: function(data){ 
    alert(data);
    if (data =='date exits')
    {
       $('#msg').val('date exist');
         $('.sucess').fadeIn(200).hide();
        $('.errormsg').fadeOut(200).show();
        //window.setTimeout("$('#dialog_add_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.error1').css('display','none');window.location.reload(true);", 2000);
        return false;

    }
    else
        {
         document.getElementById('lightseven').style.display='none';
         document.getElementById('fadeOne').style.display='none';   
        //$('.success').html(data);
        //$('.sucess').fadeIn(200).show();
        //$('.errormsg').fadeOut(200).hide();
        //window.setTimeout("$('#dialog_add_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.success1').css('display','none');window.location.reload(true);", 2000);
        }
   return true;    
}
});
return false;
       
    }
     </script>
<a href = "javascript:void(0)" onclick = "document.getElementById('lightseven').style.display='none';document.getElementById('fadeOne').style.display='none';"><img src="images/closeone.png" alt="close" /></a>
  <? $browsertype= Login::getBrowser();
  //echo $browsertype['name'];
  
  ?>
<?  if (isset($_POST['obdate']))
{
$obdate     = $_POST['obdate'];
echo $obdate;}?>
<form name="add_obs" id="add_obs" method="POST" action="" onSubmit="return validate_addobser();">
<div class="addDashBosrdcontainer">
 <div class="addDashBosrdcontainer_left">
		<div class="addDashBosrdcontainer_left_top">
                   <?$treeid="2151";
                           // echo $treeid;?>
		<?  $TreeInfoobj = new Tree;
                $treeInfo= $TreeInfoobj->viewTreeinfo($dbc, $treeid);
                echo $treeInfo[6];
               
                 ?>
                <h2><?echo   htmlspecialchars($treeInfo[0]) ?></h2>
                <h4><?echo htmlspecialchars($treeInfo[1]); ?></h4>
		</div> 
     
               <!-- id="errormsg"  align="center" style="font-weight:normal; color:#F00; font-size:14px;"></div>-->
		<div class="addcalendar">
                    
			 <p>Observed On</p>
			 <blockquote><input type="text"  name ="obdate" id="obdate"  readonly="true"/></blockquote>
		</div>
               <span id="msg" style="text-align:center;"> this exists</span>
               <input type="hidden" id="treeid" name="treeid" value="<? echo $treeInfo[6];?>"/>
	<span id="dateerrormsg" style="text-align:center;">  </span>	                 
	<div class="addleavesSection">
		<table width="452" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="addleavesSection_boxOne">LEAVES</td>
				<td class="addleavesSection_boxTwo">none</td>
				<td class="addleavesSection_boxThree">few</td>
				<td class="addleavesSection_boxFour">many</td>
				<td class="addleavesSection_boxFive">don't know</td>
			</tr>
			<tr>
				<td class="addleavesSection_arrow"><p>Fresh</p>&nbsp;&nbsp;<img src="images/one_leaf_fresh_many.png" /></td>
				<td class="addnone">
					<input name="l1" id="l1" type="radio"  value="0"   onclick="toggleRadio(0,1)" >
					<blockquote>
					<img src="images/add_icon_none.png" alt="" />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="l1" id="l1" value="1" onclick="toggleRadio(1,1)" type="radio">
					<blockquote>
					<img src="images/add_icon_leaf_fresh_few.png" alt="" />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="l1" id="l1"value="2" onclick="toggleRadio(2,1)" type="radio">
					<blockquote>
					<img src="images/add_icon_leaf_fresh_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="l1" id="l1"value="-1"  onclick="toggleRadio(x,1)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="addleavesSection_arrow"><p>Mature</p> <img src="images/one_leaf_fresh_many.png" /></td>
				<td class="addnone">
					<input name="l2" id="l2"  value="0"  onclick="toggleRadio(0,2)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="l2"  id="l2" value="1" onclick="toggleRadio(1,2)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_leaf_mature_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					 <input name="l2"   id="l2" value="2" onclick="toggleRadio(2,2)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_leaf_mature_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="l2"  id="l2" value="-1" onclick="toggleRadio(x,2)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
		</table>
		<div class="clearBoth"></div>
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
					<input name="f1" id="f1"  value="0"  onclick="toggleRadio(0,3)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="f1" id="f1" value="1" onclick="toggleRadio(1,3)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_flower_bud_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="f1" id="f1" value="2" onclick="toggleRadio(2,3)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_flower_bud_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="f1" id="f1" value="-1" onclick="toggleRadio(x,3)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
					</td>
			</tr>
				<tr><td height="10"></td></tr>
			<tr>
				<td class="addflowersSection_arrow"><p>Open</p>&nbsp;&nbsp;&nbsp;<img src="images/one_flower_open_many.png"/></td>
				<td class="addnone">
					<input name="f2"  id="f2"  value="0"  onclick="toggleRadio(0,4)" type="radio"> 
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="f2"  id="f2" value="1" onclick="toggleRadio(1,4)" type="radio"> 
					<blockquote>
					<img alt="" src="images/add_icon_flower_open_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="f2"  id="f2" value="2" onclick="toggleRadio(2,4)" type="radio"> 
					<blockquote>
					<img alt="" src="images/add_icon_flower_open_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="f2" id="f2" value="-1" onclick="toggleRadio(x,4)" type="radio"> 
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
			<td class="addleavesSection_boxTwo">none</td>
			<td class="addleavesSection_boxThree">few</td>
			<td class="addleavesSection_boxFour">many</td>
			<td class="addleavesSection_boxFive">don't know</td>
			</tr>
			<tr>
				<td class="addfruitsSection_arrow"><p>Unripe</p><img src="images/one_fruit_unripe_many.png"/></td>
				<td class="addnone">
					<input name="fr1" id="fr1"  value="0"  onclick="toggleRadio(0,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="fr1"  id="fr1" value="1" onclick="toggleRadio(1,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_unripe_few.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="fr1"  id="fr1" value="2" onclick="toggleRadio(2,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_unripe_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="fr1"  id="fr1" value="-1" onclick="toggleRadio(x,5)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="addfruitsSection_arrow"><p>Ripe</p>&nbsp;&nbsp;<img src="images/one_fruit_ripe_many.png"/></td>
				<td class="addnone">
					<input name="fr2" id="fr2"  value="0"  onclick="toggleRadio(0,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="fr2" id="fr2 value="1" onclick="toggleRadio(1,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_ripe_few.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="fr2" id="fr2" value="2" onclick="toggleRadio(2,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_ripe_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="fr2" id="fr2" value="-1" onclick="toggleRadio(x,6)" type="radio">
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
<? 
if ($browsertype['name'] == "Google Chrome") {?>
<div class="chormeaddadditionalBox">
<? } else {?>
	<div class="addadditionalBox">
	<?}?>
		<h4>Additional Observations <br /><span> I Saw...</span></h4>
		<table class="addAdditional_Observations " width="100%" border="0" cellspacing="0" cellpadding="10">
			<tr>
			<td style="width:20px;"><input name="leaf_caterpillar" id="leaf_caterpillar" type="checkbox" value="" title="Caterpillar eating leaves." /></td>
			<td style="width:61px;text-align:center;"><img src="images/insectOne.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">caterpillars</span><br />eating the leaves</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="flower_bee" id="flower_bee" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/bee.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">bees</span><br />on the flowers</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="flower_butterfly" id="flower_butterfly" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/butterfly.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">butterflies</span><br />on the flowers</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="fruit_bird" id="fruit_bird" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/bird.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">birds</span><br />feeding on fruit</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="fruit_monkey" id="fruit_monkey" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/squirrel.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">Squirrels</span><br />feeding on fruit</td>
			<td>&nbsp;</td>
			</tr>
			<tr><td style="width:20px;"></td>
			</tr>
		</table>

	</div> <!-- end of additional box-->
</div><!--addDashBosrdcontainer_right-->
 <div class="clearBoth"></div>     
</div>
<div class="clearBoth"></div>
<div class="button_area">
		<? $lastcount=count($treeIDAr);
		$lastcount=$lastcount-1;
		$pattern="..";
		if ($j==0){ 
		$next=$j+1;
		list($tree_nickname)=mysql_fetch_row(mysql_query("SELECT tree_nickname from user_tree_table where tree_Id = $treeIDAr[$next]"));
		if  (strlen($tree_nickname) > 8)
		$tree_nickname_1=  rtrim(substr($tree_nickname, 0, 8)) . $pattern;
		else
		$tree_nickname_1=$tree_nickname;
		?> 
		<div class="right_button"><a href="#" onclick = "document.getElementById('lightOne<?echo $j;?>').style.display='none';document.getElementById('lightOne<?echo $j+1;?>').style.display='block';document.getElementById('fadeOne').style.display='block'" title="<?echo $tree_nickname?>">NEXT</a></div>
		<? }
		else if(($j!=0)&&($j!=$lastcount))
		{
		//display the previous button
		$prev=$j-1;
		list($tree_nickname1)=mysql_fetch_row(mysql_query("SELECT tree_nickname from user_tree_table where tree_Id = $treeIDAr[$prev]"));
		if  (strlen($tree_nickname1) > 8)
		$tree_nickname_2=  rtrim(substr($tree_nickname1, 0, 8)) . $pattern;
		else
		$tree_nickname_2=$tree_nickname1;
		?>
		<? //display previous button ?>
		<div class="left_button"><a href="#" onclick = "document.getElementById('lightOne<?echo $j;?>').style.display='none';document.getElementById('lightOne<?echo $prev;?>').style.display='block';document.getElementById('fadeOne').style.display='block'" title="<?echo $tree_nickname1?>">PREVIOUS</a></div>
		<? //display next button
		$next=$j+1;
		list($tree_nickname2)=mysql_fetch_row(mysql_query("SELECT tree_nickname from user_tree_table where tree_Id = $treeIDAr[$next]"));
		
		
		?>
		<div class="right_button"><a href="#" title="<?echo $tree_nickname2?>"  onclick = "document.getElementById('lightOne<?echo $j;?>').style.display='none';document.getElementById('lightOne<?echo $next?>').style.display='block';document.getElementById('fadeOne').style.display='block'">NEXT</a></div>
		<? } 
		else if($j==$lastcount)
		{ 
		//display prev button
		$prev=$j-1;
		list($tree_nickname3)=mysql_fetch_row(mysql_query("SELECT tree_nickname from user_tree_table where tree_Id = $treeIDAr[$prev]"));
		?>
		<div class="left_button"><a href="#" title="<?echo $tree_nickname3?>"  onclick = "document.getElementById('lightOne<?echo $j;?>').style.display='none';document.getElementById('lightOne<?echo $prev;?>').style.display='block';document.getElementById('fadeOne').style.display='block'">PREVIOUS</a></div>
		<?
		}?>                                    
	
	<span id="errormsg" style="text-align:center;display:none;"> Observation with this date already exits. </span>
	<span id="sucess" style="text-align:left;display:none;"> Observation added sucessfully. </span>
	<div class="right_side_button">
		<!--<div class="button_area_ok"><a href="#" onClick="Add_obs_submit(<?echo $j?>)">OK</a></div>-->
            <input name="LOGIN" id="loginbut" type="submit" value="LOGIN" class="lightbox_LOGIN" style="cursor:pointer;"  />    
            <!--<div class="button_area_ok"><a href="#" onclick="document.forms[0].submit();return false;">OK</a></div>-->
		<div class="button_area_cancel"><a onclick="document.getElementById('lightOne<?echo $j;?>').style.display='none';document.getElementById('fadeOne').style.display='none'" href="javascript:void(0)">CANCEL</a></div>
	</div><!-- end of button_area-->
	
<div id="fadeOne" class="black_overlayOne">
</div>
</div>
</form>
           
                                		