<a href = "javascript:void(0)" onclick ="document.getElementById('lightOne<?echo $j;?>').style.display='none';document.getElementById('fadeOne').style.display='none'"><img src="images/closeOne.png" alt="close" name="<?echo $j?>" id="addobsclose"/></a>
<div class="addDashBosrdcontainer">
 
<div class="addDashBosrdcontainer_left">
		<div class="addDashBosrdcontainer_left_top">
		<? $query_tree="SELECT tree_nickname, species_primary_common_name,species_scientific_name,species_master.species_id, members_assigned, trees.tree_Id as tid, user_tree_id FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]' AND trees.tree_Id='$treeIDAr[$j]') ON species_master.species_id = trees.species_id ";
				list($tree_nickname,$user_tree_id)=mysql_fetch_row(mysql_query("SELECT tree_nickname,user_tree_id from user_tree_table where tree_Id = $treeIDAr[$j]"));
				list($species_primary_common_name,$species_scientific_name)=mysql_fetch_row(mysql_query($query_tree));?>
				<h3><?echo ucfirst(strtolower($tree_nickname)); ?></h3>
				<h2><?echo ucfirst(strtolower($species_scientific_name)); ?></h2>
		</div>  
		<div class="addcalendar">
			 <p>Observed On</p>
			 <blockquote><input type="text"  name ="obdate<?echo $j?>" id="obdate<?echo $j?>"  readonly="true"/></blockquote>
		</div>
		 <input type="hidden" name="usertreeid<?echo $j?>" id="usertreeid<?echo $j?>" value="<?echo $user_tree_id; ?>"  />
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
				<td class="addleavesSection_arrow"><p>Fresh</p>&nbsp;&nbsp;<img src="images/leaf_fresh_many.png" /></td>
				<td class="addnone">
					<input name="l1<?echo $j?>" id="l1<?echo $j?>" type="radio"  value="0"   onclick="toggleRadio(0,1)" >
					<blockquote>
					<img src="images/add_icon_none.png" alt="" />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="l1<?echo $j?>" id="l1<?echo $j?>" value="1" onclick="toggleRadio(1,1)" type="radio">
					<blockquote>
					<img src="images/add_icon_leaf_fresh_few.png" alt="" />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="l1<?echo $j?>" id="l1<?echo $j?>"value="2" onclick="toggleRadio(2,1)" type="radio">
					<blockquote>
					<img src="images/add_icon_leaf_fresh_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="l1<?echo $j?>" id="l1<?echo $j?>"value="-1"  onclick="toggleRadio(x,1)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="addleavesSection_arrow"><p>Mature</p> <img src="images/leaf_fresh_many.png" /></td>
				<td class="addnone">
					<input name="l2<?echo $j?>" id="l2<?echo $j?>"  value="0"  onclick="toggleRadio(0,2)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="l2<?echo $j?>"  id="l2<?echo $j?>" value="1" onclick="toggleRadio(1,2)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_leaf_mature_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					 <input name="l2<?echo $j?>"   id="l2<?echo $j?>" value="2" onclick="toggleRadio(2,2)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_leaf_mature_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="l2<?echo $j?>"  id="l2<?echo $j?>" value="-1" onclick="toggleRadio(x,2)" type="radio">
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
				<td class="addflowersSection_arrow"><p>Bud</p>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/flower_bud_many.png"/></td>
				<td class="addnone">
					<input name="f1<?echo $j?>"  id="f1<?echo $j?>"  value="0"  onclick="toggleRadio(0,3)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="f1<?echo $j?>" id="f1<?echo $j?>" value="1" onclick="toggleRadio(1,3)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_flower_bud_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="f1<?echo $j?>" id="f1<?echo $j?>" value="2" onclick="toggleRadio(2,3)" type="radio">
					<blockquote>
					<img alt="" src="images/add_icon_flower_bud_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="f1<?echo $j?>" id="f1<?echo $j?>" value="-1" onclick="toggleRadio(x,3)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
					</td>
			</tr>
				<tr><td height="10"></td></tr>
			<tr>
				<td class="addflowersSection_arrow"><p>Open</p>&nbsp;&nbsp;&nbsp;<img src="images/flower_open_many.png"/></td>
				<td class="addnone">
					<input name="f2<?echo $j?>"  id="f2<?echo $j?>"  value="0"  onclick="toggleRadio(0,4)" type="radio"> 
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="f2<?echo $j?>"  id="f2<?echo $j?>" value="1" onclick="toggleRadio(1,4)" type="radio"> 
					<blockquote>
					<img alt="" src="images/add_icon_flower_open_few.png">
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="f2<?echo $j?>"  id="f2<?echo $j?>" value="2" onclick="toggleRadio(2,4)" type="radio"> 
					<blockquote>
					<img alt="" src="images/add_icon_flower_open_many.png">
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="f2<?echo $j?>" id="f2<?echo $j?>" value="-1" onclick="toggleRadio(x,4)" type="radio"> 
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
				<td class="addfruitsSection_arrow"><p>Unripe</p><img src="images/fruit_unripe_many.png"/></td>
				<td class="addnone">
					<input name="fr1<?echo $j?>" id="fr1<?echo $j?>"  value="0"  onclick="toggleRadio(0,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="fr1<?echo $j?>"  id="fr1<?echo $j?>" value="1" onclick="toggleRadio(1,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_unripe_few.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="fr1<?echo $j?>"  id="fr1<?echo $j?>" value="2" onclick="toggleRadio(2,5)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_unripe_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="fr1<?echo $j?>"  id="fr1<?echo $j?>" value="-1" onclick="toggleRadio(x,5)" type="radio">
					<blockquote>
					<img src="images/add_dontknow.png" alt=""  />
					</blockquote>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="addfruitsSection_arrow"><p>Ripe</p>&nbsp;&nbsp;<img src="images/fruit_ripe_many.png"/></td>
				<td class="addnone">
					<input name="fr2<?echo $j?>" id="fr2<?echo $j?>"  value="0"  onclick="toggleRadio(0,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_none.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addfew">
					<input name="fr2<?echo $j?>" id="fr2<?echo $j?>" value="1" onclick="toggleRadio(1,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_ripe_few.png" alt=""  />
					</blockquote>  
				</td>
				<td class="addmany">
					<input name="fr2<?echo $j?>" id="fr2<?echo $j?>" value="2" onclick="toggleRadio(2,6)" type="radio">
					<blockquote>
					<img src="images/add_icon_fruit_ripe_many.png" alt=""  />
					</blockquote>
				</td>
				<td class="adddont_know">
					<input name="fr2<?echo $j?>" id="fr2<?echo $j?>" value="-1" onclick="toggleRadio(x,6)" type="radio">
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
	<div class="addadditionalBox">
		<h4>Additional Observations <br /><span> I Saw...</span></h4>
		<table class="addAdditional_Observations " width="100%" border="0" cellspacing="0" cellpadding="10">
			<tr>
			<td style="width:20px;"><input name="leaf_caterpillar<?echo $j?>" id="leaf_caterpillar<?echo $j?>" type="checkbox" value="" title="Caterpillar eating leaves." /></td>
			<td style="width:61px;text-align:center;"><img src="images/insectOne.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">caterpillars</span><br />eating the leaves</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="flower_bee<?echo $j?>" id="flower_bee<?echo $j?>" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/bee.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">bees</span><br />on the flowers</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="flower_butterfly<?echo $j?>" id="flower_butterfly<?echo $j?>" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/butterfly.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">butterflies</span><br />on the flowers</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="fruit_bird<?echo $j?>" id="fruit_bird<?echo $j?>" type="checkbox" value="" /></td>
			<td style="width:61px;text-align:center;"><img src="images/bird.png" alt="" /></td>
			<td><span style="color:#aa0000;font-weight:bold;">birds</span><br />feeding on fruit</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td style="width:20px;"><input name="fruit_monkey<?echo $j?>" id="fruit_monkey<?echo $j?>" type="checkbox" value="" /></td>
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
	<!--<div class="right_button"><a href="#">Test-delete 1</a></div>-->'
	<span id="addexits" class="addexits" style="display:none;"> Observation with this date already exits. </span>
	<span id="addsucess" class="addsucess" style="display:none;"> Observation added sucessfully. </span>
	<div class="right_side_button">
		<div class="button_area_ok"><a href="#" onClick="Add_obs_submit(<?echo $j?>)">OK</a></div>
		<div class="button_area_cancel"><a onclick="document.getElementById('lightOne<?echo $j;?>').style.display='none';document.getElementById('fadeOne').style.display='none'" href="javascript:void(0)">CANCEL</a></div>
	</div><!-- end of button_area-->
	
<div id="fadeOne" class="black_overlayOne">
</div>
</div>
           
             