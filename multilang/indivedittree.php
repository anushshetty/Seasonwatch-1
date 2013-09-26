<?php
/*
 *Initial Development:- this page will be displayed when user clicks on Add tree from seedDashboard page.
 * This will display all the trees and its information . on selection of the species it will be moved to 
 * seedaddtreeMay18.php. All the tree information will be read from seedtrees.xml file.

 * status : no problem Working fine.
 * and open the template in the editor.
 */

?>
<script>

$(function() {
	
    $( "#autotag" ).autocomplete({source: 'suggesttrees.php',
        selectFirst: 'true',

        select: function(event, ui) {
            event.preventDefault();
            $("#autotag").val(ui.item.label);
             $("#selspecies_id").val(ui.item.value);
             $("#selspecies_name").val(ui.item.label);
             showImg(ui.item.value); 
                                            
        },
        focus: function(event, ui) {
            event.preventDefault();
           $("#autotag").val(ui.item.label);
           
            
        },
        change: function(event,ui) {
        	event.preventDefault();
            $("#autotag").val(ui.item.label);
             $("#selspecies_id").val(ui.item.value);
             $("#selspecies_name").val(ui.item.label);
             showImg(ui.item.value);    
        }
      
    });
    


    function showImg(str)
    {
    	
    if (str=="")
      {
      document.getElementById("theImg").src="images/white.gif";
      return;
      } 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
              var res_text = xmlhttp.responseText;
         
          if (res_text.length <"3")
              {
                  //alert("omage not fond");
                  document.getElementById("theImg").src="images/noimage.jpg";
              }
              else
                  {
    	  document.getElementById("theImg").src=xmlhttp.responseText;
                  }
    	  //document.getElementById("theImg").src=xmlhttp.responseText;
    	  
        } 
      return true;
      }
    xmlhttp.open("GET","getimage.php?q="+str,true);
    xmlhttp.send();
    }

    
});
</script>

<?
$tob = unserialize($_SESSION['tob']);
$i=$_SESSION['tno'];
$edit=$_SESSION['edit'];
 //echo $usertree;
list($tree_location_id,$tree_nickname, $location_type, $is_fertilised, $is_watered, $distance_from_water, $degree_of_slope, $aspect, $species_id) =mysql_fetch_row(mysql_query($q1));
$edittreeid= $tob[$i]->Tree_id;
list($tree_height, $tree_girth, $tree_damage, $other_notes) =mysql_fetch_row(mysql_query($measdetails));
                
 
                
                
              ?>


<form id="addtree" method="post" action="tracktreesadd.php" onsubmit="AddTreeInfo();">  
    <a href = "javascript:void(0)" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none'"><img src="images/closeone.png" alt="close" id="treeclose"/></a>
    
     
    <div class="DashBosrdcontainer_add_tree_lightbox">
    <div class="container_nav">
     <?php if($edit){?>
    <h2>Edit Tree <?echo ucfirst(strtolower(htmlspecialchars($tob[$i]->Tree_nickname))).":".htmlspecialchars($tob[$i]->Species_common_name); ?></h2>
    <?php }else{?>
    <h2>Add a Tree </h2>
    <?php }?>
    
    
    	<div class="nav_bg">
        <ul class="nav">
        <li ><a href="javascript:void(0)" onclick="EnableChoosetree()" class="cur" id="treesel">Choose a Tree<div class=""></div></a></li>
         <li ><a href="javascript:void(0)"  onclick="EnableLocation()" id="addlocation">Add Location<div class=""></div></a></li>
          <li ><a href="javascript:void(0)" onclick="EnableDetails()"  class="last" id="adddetails">Add Details</a></li>
         <!-- <li><a onclick="document.getElementById('TBOX').style.display='block';document.getElementById('tags').style.display='block';document.getElementById('boxDO').style.display='none';document.getElementById('mapBox').style.display='none';document.getElementById('pick').style.display='block';document.getElementById('pickone').style.display='block';document.getElementById('button_area_ok').style.display='none';document.getElementById('button_area_loc').style.display='block'; document.getElementById('button_area_details').style.display='none';" href="javascript:void(0)" class="cur" id="treesel">Choose a Tree<div class=""></div></a></li>-->
        <!--<li><a onclick="document.getElementById('TBOX').style.display='none';document.getElementById('tags').style.display='block';document.getElementById('boxDO').style.display='none';document.getElementById('mapBox').style.display='block';document.getElementById('pick').style.display='block';document.getElementById('pickone').style.display='block';document.getElementById('button_area_ok').style.display='none';document.getElementById('button_area_details').style.display='block';document.getElementById('button_area_loc').style.display='none';" href="javascript:void(0)" id="addlocation">Add Location<div class=""></div></a></li>-->
        
       <!-- <li><a onclick="document.getElementById('TBOX').style.display='none';document.getElementById('tags').style.display='none';document.getElementById('boxDO').style.display='block';document.getElementById('mapBox').style.display='none';document.getElementById('pick').style.display='none';document.getElementById('pickone').style.display='none';document.getElementById('boxDO').style.border='none';document.getElementById('button_area_ok').style.display='block';document.getElementById('button_area_details').style.display='none'; document.getElementById('button_area_loc').style.display='none';" href="javascript:void(0)" class="last" id="adddetails">Add Details</a></li>-->
        </ul>
		</div>
        
        <script type="text/javascript">
        /*$(".nav li a").click(function (){
         $('.nav li a').removeClass('cur');
            $(this).addClass('cur');
          });*/ 
        function EnableChoosetree()
        {
        	$('.nav li a').removeClass('cur'); 
        	document.getElementById('treesel').className='cur';
            document.getElementById('addlocation').className='';
            document.getElementById('adddetails').className='';
              document.getElementById('TBOX').style.display='block';
              document.getElementById('autotag').style.display='block';
              document.getElementById('boxDO').style.display='none';
              document.getElementById('mapBox').style.display='none';
              document.getElementById('pick').style.display='block';
              //document.getElementById('pickone').style.display='block';
              document.getElementById('button_area_ok').style.display='none';
              document.getElementById('button_area_loc').style.display='none'; 
              document.getElementById('button_area_details').style.display='none';

              document.getElementById('button_loc_prev').style.display='none';
              document.getElementById('button_area_next').style.display='none';
              document.getElementById('button_details_prev').style.display='none';
              document.getElementById('button_loc_next').style.display='block';
              
                   
             
             
        }
        function EnableLocation()
        {
            
           
            //var selTree = $("#selspecies_id").val();
            var selTree = $("#autotag").val();
            if (selTree=='')
            {
            alert("Please select the Tree species from choose Tree.");
            $('.nav li a').removeClass('cur');
            document.getElementById('treesel').className='cur';
            document.getElementById('addlocation').className='';
            document.getElementById('adddetails').className='';
            document.getElementById('TBOX').style.display='block';
            document.getElementById('autotag').style.display='block';
            document.getElementById('boxDO').style.display='none';
            document.getElementById('mapBox').style.display='none';
            document.getElementById('pick').style.display='block';
            //document.getElementById('pickone').style.display='block';
            document.getElementById('button_area_ok').style.display='none';
            document.getElementById('button_area_loc').style.display='none';
            document.getElementById('button_area_details').style.display='none';
                       
         document.getElementById('button_loc_prev').style.display='none';
       document.getElementById('button_area_next').style.display='none';
       document.getElementById('button_details_prev').style.display='none';
       document.getElementById('button_loc_next').style.display='block';
            return false;
             
            }
            else
            {
            	$('.nav li a').removeClass('cur');  
            	document.getElementById('addlocation').className='cur';
            	 document.getElementById('treesel').className='';
                 document.getElementById('adddetails').className='';             
              document.getElementById('TBOX').style.display='none';
              document.getElementById('autotag').style.display='none';
              document.getElementById('boxDO').style.display='none';
              document.getElementById('mapBox').style.display='block';
              document.getElementById('pick').style.display='none';
            //  document.getElementById('pickone').style.display='none';
              document.getElementById('button_area_ok').style.display='none'; 
              document.getElementById('button_area_loc').style.display='none'; 
              document.getElementById('button_area_details').style.display='none';
              document.getElementById('button_loc_prev').style.display='block';
              document.getElementById('button_area_next').style.display='block';
              document.getElementById('button_details_prev').style.display='none';
              document.getElementById('button_loc_next').style.display='none';
              
            }
        }
         function EnableDetails()
        {
             //var selTree = $("#selspecies_id").val();
             var selTree = $("#autotag").val();
             if (selTree=='')
             {  
            	 alert("Please select the Tree species from choose Tree.");
                 EnableChoosetree();
                 return false;
             }
            else
            {

         	   //	AddLocation();
                var locname = $("#loc_name").val();
                var loctype = $("#location_type").val(); 
                var locstate =  $("#state").val();
                var loccity =$("#city").val();
                var loclat =$("#lat").val();
                var loclong =$("#lng").val();
            
                if (loclat!='')
                 {
                     if (locstate=='')
                     {
                         alert("Please select the state.");
                         return false;
                     }
                     var zoom_get = $('#zoom').val();
                     
                    if(zoom_get < 15 ) 
                    {
                        alert("Current zoom level is " + zoom_get + ".  The min accepted zoom level is 15. Please zoom in more to select the location.");
                        return false;
                    }
                 }
                 
                               
                 document.getElementById('loclat').value=loclat;
                 document.getElementById('loclon').value=loclong;
                 document.getElementById('loccity').value=loccity;
                 document.getElementById('locname').value=locname;    
                   
                        $('.nav li a').removeClass('cur');
                        document.getElementById('addlocation').className='';
                        document.getElementById('treesel').className='';
                        document.getElementById('adddetails').className='cur';
                        document.getElementById('TBOX').style.display='none';
                        document.getElementById('autotag').style.display='none';
                        document.getElementById('boxDO').style.display='block';
                        document.getElementById('mapBox').style.display='none';
                        document.getElementById('pick').style.display='none';
              //          document.getElementById('pickone').style.display='none';
                        document.getElementById('boxDO').style.border='none';
                        document.getElementById('button_area_ok').style.display='block';
                        document.getElementById('button_area_details').style.display='none';
                        document.getElementById('button_area_loc').style.display='none'; 
                        document.getElementById('button_details_prev').style.display='block';
                        document.getElementById('button_loc_prev').style.display='none';
                        document.getElementById('button_area_next').style.display='none';
                        document.getElementById('button_loc_next').style.display='none'; 
                    	   
              }

        }

         function showtree(str)
         {

			//alert("params="+str);
			var n=str.split(",");
        	  $("#selspecies_id").val(n[0]);
             $("#selspecies_name").val(n[1]);
             showImg(n[0]); 
             
         }
		</script>
    </div>
  
    <h3 id="pick">Name of tree:<br />
    <input type="text" name="autotag" id="autotag" value=<?php if($edit){ echo $tob[$i]->Species_common_name;}else {echo "Type the name of the tree you want to add. Eg: Neem"; }?> onfocus="if(this.value=='Type the name of the tree you want to add. Eg: Neem')this.value='';"  class="cmnameField"/>
    <!-- select name="treename" id="treename" onchange="showtree(this.value);">
                            
			    <option value="">Select a Tree</option>
<?php
			$dbc=Dbconn::getdblink();
				$result = $dbc->readtabledata("SELECT species_primary_common_name as species_label,species_id FROM species_master ORDER BY species_primary_common_name");
				//echo $result;
        		      
?>
                         </select-->
    </h3>
    <input type="hidden" id="selspecies_id" value="" />
    <!-- h5 id="pickone">Or pick the leaf type from below:</h5>-->
    <div class="clearBoth"></div>
<!-- start Tree_box-->
    <div id="TBOX" class="tree_box">
        <div style="float:left" > <!--This is the first division of left-->
        <div id="firstpane" class="firstpane"> <!--Code for menu starts here-->
        <ul class="addtreeList">
        <?php if($edit){
        	$th_picname=$tob[$i]->species_image;
         if (!file_exists($th_picname)) { ?>
        <img id='theImg' src='images/white.gif' style='max-width:450px;max-height:450px'  />
        <?php }else {?>
        <img id='theImg' src="<?php echo $tob[$i]->species_image;?>" style='max-width:450px;max-height:450px'  />
        <?php }
        } else{?>
        <img id='theImg' src='images/white.gif' style='max-width:450px;max-height:450px'  />
        	<? }?>
        
        
        
        </ul>      
        </div>
        </div>
        <div class="addTreeContainer" id="tree_particulars" style="display: block;float:right">
        <h3></h3>
        </div>
    </div>
 </div>
        <!-- end tree_box -->                        	
 <div class="clearBoth"></div>

<div style="border:0px solid #000;display:none;" id="mapBox">
    <?include("addtree_step.php"); ?>  
</div>

<div class="clearBoth"></div>
   
<div id="boxDO" style="border:0px solid #000; display:none;">
   <div class="DashBosrdcontainer_add_tree_lightbox">
      <div class="leftBox_ONE">
             Fields marked with * are compulsory. <br />
            <p>
                <label>Species Type* </label>
                <?php $sql=$dbc->readtabledata("SELECT species_primary_common_name FROM species_master where species_id=")?>
            <input name="selspecies_name" type="text" id="selspecies_name" readonly="readonly" title="select the species type from choose tree." value=<?php if($edit){ echo $tob[$i]->Species_common_name;}else {echo "";}?>/></p>
            <input type="hidden" id="selspecies_id" name="selspecies_id" value=<?php if($edit){ echo $tob[$i]->Species_id;}else {echo "";} ?>/> 
            <p><label>Latitude</label><input type=text id="loclat"  name="loclat" value="" DISABLED style="background-color:#fff;"></input></p>
            <p><label>Longitude</label><input type=text id="loclon"  name="loclon" value="" DISABLED></input></p>
            <p><label>City</label><input type=text id="loccity"  name="loccity" value="" DISABLED></input></p>
            <p><label>Location name</label><input type=text id="locname"  name="locname" value="" DISABLED></input></p>
            <!-- P><label>Location type</label><input type=text id="loctype" name="loctype" value="" DISABLED></input></P-->
           <p>
           
            <label title="Please give all your trees a unique nickname. This will help you distinguish your individual trees">Nickname*</label>
            <input name="" type="text" value=<?php if($edit){ echo $tob[$i]->Species_common_name;}else {echo "";}?> id="tree_nickname" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees" />
            </p>
            <?php
                    /*$sql = $dbc->readtabledata("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[userid]'");
                    //echo "<select name='nicknames' id='nicknames' style='visibility:hidden;'>";
                    while($row=mysql_fetch_array($sql))
                    {
                    echo "<option>".$row['tree_nickname']."</option>";
                    }
                    echo "</select>";*/
                    ?>
           
                       <p>
            
            </p>
            <p>
            <label title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured).">Height (in m)</label>
            <input id="tree_height" name="tree_height" type="text"  title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured)." value=<?php if($edit){ echo $tob[$i]->height;}else {echo "";}?>/>
            </p>
            <p>
            <label title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler.">
	     Girth (in cm)</label><input id="tree_girth" name="tree_girth" type="text" title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4 m or 4.5 ft from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler." value=<?php if($edit){ echo $tob[$i]->girth;}else {echo "";}?>/>
            </p>
            
            <p>
            <label title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">Aspect</label>
             <select id="aspect" name="aspect" title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">
                                <option value="">Choose one</option>
				<option id="North" value="North">North</option>
				<option id="NorthEast" value="NorthEast">North-East</option>
				<option id="East" value="East">East</option>
				<option id="SouthEast" value="SouthEast">South-East</option>
				<option id="South" value="South">South</option>
				<option id="SouthWest" value="SouthWest">South-West</option>
				<option id="West" value="West">West</option>
				<option id="NorthWest" value="NorthWest">North-West</option>
			
                            </select>
          
            </p>
 
            <input type='hidden' name='cmd' value=<?php if($edit){ echo "edit_tree";}else {echo "add_tree";}?>>
        <br />
    </div>

    <div class="Right_BOX">
    <p></p>
    <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Nearest water source(in m)</label>
             <input id="distance_from_water"  name="distance_from_water" type="text" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc." value=<?php if($edit){ echo $tob[$i]->distance_from_water;}else {echo "";}?>/>
            </p>
            <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Slope</label>
             <input id="degree_of_slope" name="degree_of_slope" type="text" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
    <p>           
            
         <label  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">Damaged</label>&nbsp;<input name="tree_damage" type="radio" value="0" checked="checked" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="tree_damage" type="radio" value="1" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/> Yes
            </p>
             <p>
            <label  title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted.">
		Fertilised</label>&nbsp;<input name="is_fertilised" type="radio" value="0" checked="checked" title="Many trees in parks, gardens and campuses are regularly fertilized? this affects the phenology of the tree and therefore must be noted."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="is_fertilised"   id="is_fertilised" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted."/> Yes
            </p>
             <p>
            <label title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted.">
		Watered</label>&nbsp;<input name="is_watered" id=="is_watered" type="radio" value="0" checked="checked" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_watered" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> Yes
            </p><p>
    Notes</p>
    <textarea class="text_box_textarea" id="other_notes" name="other_notes"></textarea><br/>
    <? if ($_SESSION['usercategory']!='individual'){?>
    Assign to students
    <textarea class="text_box_textarea_one" id="studentname" name="studentname" >eg. John,Bala,Seetha</textarea><?}?>
    </div>
    </div>
    <div class="clearBoth"></div>
        
        </div>

<div  class="button_area_indiv">
        <div class="button_area" >
        <div class="right_side_button">
        <div class="button_area_ok" type="submit" id="button_area_ok" style="display:none;">
                 <a href="#" onClick="AddTreeInfo()">Add Tree</a>
            </div>
            <div class="right_button"  id="button_area_loc"style="display:none;" >
                 <a href="#" OnClick="EnableLocation()">Location</a>
            </div>
            <div class="right_button"  id="button_area_details" style="display:none;" >
                 <a href="#" OnClick="EnableDetails()">Details</a>
            </div>
            <div class="right_button"  id="button_loc_next" >
                 <a href="#" OnClick="EnableLocation()">Next</a>
            </div>
                <div class="right_button"  id="button_area_next" style="display:none;" >
                 <a href="#" OnClick="EnableDetails()">Next</a>
            </div>
            </div>
            <div class="left_button" id="button_loc_prev" style="display:none;" >
                 <a href="#" OnClick="EnableChoosetree()">Back</a>
            </div>
            <div class="left_button"  id="button_details_prev"  style="display:none;">
                 <a href="#" OnClick="EnableLocation()">Back</a>
            </div>
        <div class="button_area_cancel"><a href ="javascript:void(0)" style="display:none;" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none'" id="addtreecancel">CANCEL</a></div>
        
        </div>
        </div>
        
        </form>



                                

                                    
                                 
       
                                  
           
     
    
<!--</div>-->
<!--MODAL Ends-->
<!-- On submitting the above dialog box, the one below is loaded for bringing up Stage 2 of Add Tree.-->
