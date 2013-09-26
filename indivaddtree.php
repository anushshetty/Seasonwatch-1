<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php
/*
 *Initial Development:- this page will be displayed when user clicks on Add tree from seedDashboard page.
 * This will display all the trees and its information . on selection of the species it will be moved to 
 * The information about the tree wiil be dislayed.
 * Add location 
 * Add details.
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
           //$("#autotag").val(ui.item.label);
           
            
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
              // alert("image not fond");
               document.getElementById("theImg").src="images/noimage.jpg";
		//document.getElementById("theImg").src="";
            }
            else
            {
                document.getElementById('TBOX').className='tree_box';
                var pos =  res_text.indexOf('=');
                var imagesource= res_text.substring(0, res_text.indexOf('='));
                var allspeciesinfo=res_text.substring(res_text.indexOf('=')+1,res_text.length);
                var sciencename= allspeciesinfo.substring(0,allspeciesinfo.indexOf('|'));
                var notes = allspeciesinfo.substring(allspeciesinfo.indexOf('|')+1,allspeciesinfo.length );
                res_text=imagesource;
                document.getElementById('theImg').style.display='block';
                if (res_text.length <"3")
                 {document.getElementById("theImg").src="images/noimage.jpg";}
                 else
                {document.getElementById("theImg").src=imagesource;}
                document.getElementById('selspeciesmsg').style.display='none';
                document.getElementById('specienotes').style.display='block';
                document.getElementById('speciescname').style.display='block';
                document.getElementById('pickmsg').style.display='block'; 
                $("#speciescname").text(sciencename);
                $("#specienotes").text(notes);
                var msgaddtree="Is this the tree you want to add?"
                $("#pickmsg").text(msgaddtree);
            }
        } 
      return true;
      }
    xmlhttp.open("GET","getimage_lat.php?q="+str,true);
    xmlhttp.send();
    }

	
    
});
</script>

<form id="addtree" method="post" action="tracktreesadd.php" onsubmit="AddTreeInfo();">  
    <a href = "javascript:void(0)" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none';clearindivaddtree();"><img src="images/closeone.png" alt="close" id="addtreeclose"/></a>
    
     
    <div class="DashBosrdcontainer_add_tree_lightbox">
    <div class="container_nav">
    <h2>Add a Tree </h2>
    <div class="nav_bg">
        <ul class="nav">
            <li ><a href="javascript:void(0)" onclick="EnableChoosetree()" class="cur" id="treesel">Choose Species<div class=""></div></a></li>
            <li ><a href="javascript:void(0)"  onclick="EnableLocation()" id="addlocation">Add Location<div class=""></div></a></li>
            <li ><a href="javascript:void(0)" onclick="EnableDetails()"  class="last" id="adddetails">Add Details</a></li>
         </ul>
     </div>
        
        <script type="text/javascript">
      
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
                document.getElementById('pickmsg').style.display='none'; 

               document.getElementById('addtreecancel').style.display='none';
                 $("#pickmsg").text('');
                
        }
        function EnableLocation()
        {
            var selTree = $("#autotag").val();
            var selspeciesid = $("#selspecies_id").val();
            //alert(selTree)
            if (selTree=='' | (selspeciesid ==''))
            {
            alert("Please choose a tree species first");
            $('.nav li a').removeClass('cur');
            document.getElementById('treesel').className='cur';
            document.getElementById('addlocation').className='';
            document.getElementById('adddetails').className='';
            document.getElementById('TBOX').style.display='block';
            document.getElementById('autotag').style.display='block';
            document.getElementById('boxDO').style.display='none';
            document.getElementById('mapBox').style.display='none';
            document.getElementById('pick').style.display='block';
            document.getElementById('pickmsg').style.display='none'; 
            $("#pickmsg").text('');
            //document.getElementById('pickone').style.display='block';
            document.getElementById('button_area_ok').style.display='none';
            document.getElementById('button_area_loc').style.display='none';
            document.getElementById('button_area_details').style.display='none';
                     
            document.getElementById('button_loc_prev').style.display='none';
            document.getElementById('button_area_next').style.display='none';
            document.getElementById('button_details_prev').style.display='none';
            document.getElementById('button_loc_next').style.display='block';
           document.getElementById('addtreecancel').style.display='none';
            
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
                document.getElementById('pickmsg').style.display='none'; 
                $("#pickmsg").text('');
                //  document.getElementById('pickone').style.display='none';
                document.getElementById('button_area_ok').style.display='none'; 
                document.getElementById('button_area_loc').style.display='none'; 
                document.getElementById('button_area_details').style.display='none';
                document.getElementById('button_loc_prev').style.display='block';
                document.getElementById('button_area_next').style.display='block';
                document.getElementById('button_details_prev').style.display='none';
                document.getElementById('button_loc_next').style.display='none';
                document.getElementById('addtreecancel').style.display='none';
                 
 	    }
        }
         function EnableDetails()
        {
             //var selTree = $("#selspecies_id").val();
             var selTree = $("#autotag").val();
             var selspeciesid = $("#selspecies_id").val();
             if (selTree=='' | (selspeciesid ==''))
            
             {  
            	 alert("Please choose a tree species first");
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
		 if (loclat=='')
                 {
                     alert("Please complete the location information from 'Add Location' before Adding the details.");
                     EnableLocation();
                     return false;
                     
                 }            	

                if (loclat!='')
                 {
                	if (locstate==''|loccity=='' |locname=='' |loctype=='')
                    {
                       
 			alert("Please complete the location information from 'Add Location' before adding the details.");
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
                  document.getElementById('loctype').value=loctype;    
                   
                $('.nav li a').removeClass('cur');
                document.getElementById('addlocation').className='';
                document.getElementById('treesel').className='';
                document.getElementById('adddetails').className='cur';
                document.getElementById('TBOX').style.display='none';
                document.getElementById('autotag').style.display='none';
                document.getElementById('boxDO').style.display='block';
                document.getElementById('mapBox').style.display='none';
                document.getElementById('pick').style.display='none';
                document.getElementById('boxDO').style.border='none';
                document.getElementById('button_area_ok').style.display='block';
                document.getElementById('button_area_details').style.display='none';
                document.getElementById('button_area_loc').style.display='none'; 
                document.getElementById('button_details_prev').style.display='block';
                document.getElementById('button_loc_prev').style.display='none';
                document.getElementById('button_area_next').style.display='none';
                document.getElementById('button_loc_next').style.display='none'; 
                document.getElementById('pickmsg').style.display='none'; 

                document.getElementById('addtreecancel').style.display='block';
                 $("#pickmsg").text('');
 		
                    	   
              }

        }

     </script>
    </div>
  
    <h3 id="pick">Type the Name of the Species you want to add : Eg: Jackfruit<br />
    <input type="text" name="autotag" id="autotag" value=""  onfocus="if(this.value=='')this.value='';"  class="cmnameField"/>
    </h3>
   
    <input type="hidden" id="selspecies_id" value="" />
    <div class="clearBoth"></div>
        <!-- start Tree_box-->
        <div id="TBOX" class="tree_box1" >
              <div id="pickmsg" style="	text-align:Left;border-top:solid 1px transparent;display:none;background-color:#ededed;border-bottom:1px solid #aaaaaa;"></div>
            <div style="float:left" > <!--This is the first division of left-->
            <div id="firstpane" > <!--Code for menu starts here-->
                <ul class="addtreeList">
               <!-- <img id='theImg' src='images/white.gif' style='max-width:300px;max-height:400px'  />-->
                <img id='theImg'  style='max-width:300px;max-height:400px'  />
                </ul>
                <div class="genaddTreeContainerHolder1">
               <div id="selspeciesmsg"></div>
                <h2> <i><div id="speciescname"> </div></i></h2>
                <br>
                <p> <div id="specienotes"> </div></p>
                </div><!-- end of genaddTreeContainerHolder1-->
            </div><!-- end of firstpane-->
            </div><!-- end of first division-->
        </div>  <!-- end tree_box -->  
    </div><!--end of DashBosrdcontainer_add_tree_lightbox-->
<div class="clearBoth"></div>
<div style="border:0px solid #000;display:none;" id="mapBox">
    <?include("addtree_step.php"); ?>  
</div>

<div class="clearBoth"></div>
   
<div id="boxDO" style="border:0px solid #000; display:none;">
   <div class="DashBosrdcontainer_add_tree_lightbox">
      <div class="leftBox_ONE">
             Fields marked with * are compulsory <br/>
 		<?php
                    $sql = $dbc->readtabledata("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[userid]'");
                    echo "<select name='nicknames' id='nicknames' style='visibility:hidden;'>";
                    while($row=mysql_fetch_array($sql))
                    {
                    echo "<option>".$row['tree_nickname']."</option>";
                    }
                    echo "</select>";
                    ?>
            <p>
                <label>Species name </label>
                <?php $sql=$dbc->readtabledata("SELECT species_primary_common_name FROM species_master where species_id=")?>
            <input name="" type="text" value="" id="selspecies_name" readonly="readonly" title="select the species type from choose tree." style="color:#888;background-color:#DADADA;"/></p>
            <input type="hidden" id="selspecies_id" name="selspecies_id" value="" /> 
            <p><label>Latitude</label><input type=text id="loclat"  name="loclat" value="" DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <p><label>Longitude</label><input type=text id="loclon"  name="loclon" value="" DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <p><label>City</label><input type=text id="loccity"  name="loccity" value="" DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <p><label>Location name</label><input type=text id="locname"  name="locname" value="" DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <P><label>Location type</label><input type=text id="loctype" name="loctype" value="" DISABLED style="color:#888;background-color:#DADADA;"/></input></P>
           <p>
           
            <label title="Please give all your trees a unique nickname. This will help you distinguish your individual trees">Nickname*</label><input name="" type="text" value="" id="tree_nickname" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees" />
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
            <input id="tree_height" name="tree_height" type="text"  title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured)."/>
            </p>
            <p>
            <label title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler.">
	     Girth (in cm)</label><input id="tree_girth" name="tree_girth" type="text" title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4 m or 4.5 ft from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler." />
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
 
            <input type='hidden' name='cmd' value='add_tree'/>
        <br />
    </div>

    <div class="Right_BOX">
    <p></p>
    <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Nearest water source (in m)</label>
             <input id="distance_from_water"  name="distance_from_water" type="text" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
            <p>
            <label title="If your plant is on a hill, please try and note the digree of the hill slope.">Slope (in deg)</label>
             <input id="degree_of_slope" name="degree_of_slope" type="text" title="If your plant is on a hill, please try and note the degree of the hill slope."/>
            </p>
    <p>           
            
         <label  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">Damaged</label>&nbsp;
         <input name="tree_damage" type="radio" value="0"  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/>&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input name="tree_damage" type="radio" value="1" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/> Yes
            </p>
             <p>
            <label  title="Many trees in parks, gardens and campuses are regularly fertilized. This affects the phenology of the tree and therefore must be noted.">
		Fertilised</label>&nbsp;&nbsp;<input name="is_fertilised" type="radio" value="0"  title="Many trees in parks, gardens and campuses are regularly fertilized? this affects the phenology of the tree and therefore must be noted."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="is_fertilised"   id="is_fertilised" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted."/> Yes
            </p>
             <p>
            <label title="Many trees in parks, gardens and campuses are regularly watered. This affects the phenology of the tree and therefore must be noted.">
		Watered</label>&nbsp;
                <input name="is_watered" id="is_watered" type="radio" value="0"  title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="is_watered" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> Yes
            </p>
            <p>
            <label title="" style="padding-top:75px;width:110px">
		Notes about this tree</label>&nbsp;
    <textarea class="text_box_textarea" style="width:190px;height:150px" id="other_notes" onfocus="if(this.value=='eg, any peculiarities, perhaps something about its history, etc')this.value='';">eg, any peculiarities, perhaps something about its history, etc</textarea><br/>
    <? if ($_SESSION['usercategory']!='individual'){?>
    <label title="" style="padding-top:75px;width:110px">
		Assign to students</label>&nbsp;
    
    <textarea class="text_box_textarea_one" style="width:190px;height:150px" id="studentname" onfocus="if(this.value=='eg. John,Bala,Seetha')this.value='';" >eg. John,Bala,Seetha</textarea><?}?>
    </p>
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
            <div class="button_area_cancel" style="display:none;" id="addtreecancel"><a href ="javascript:void(0)" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none';clearindivaddtree();" >CANCEL</a></div>
            </div>
            <div class="left_button" id="button_loc_prev" style="display:none;" >
                 <a href="#" OnClick="EnableChoosetree()">Back</a>
            </div>
            <div class="left_button"  id="button_details_prev"  style="display:none;">
                 <a href="#" OnClick="EnableLocation()">Back</a>
            </div>
        
        
        </div>
        </div>
        
        </form>



                                

                                    
                                 
       
                                  
           
     
    
<!--</div>-->
<!--MODAL Ends-->
<!-- On submitting the above dialog box, the one below is loaded for bringing up Stage 2 of Add Tree.-->
