<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php
/*
 *Initial Development:- this page will be displayed when user clicks on Add tree from seedDashboard page.
 * This will display all the trees and its information . on selection of the species it will be moved to 
 * seedaddtreeMay18.php. All the tree information will be read from seedtrees.xml file.

 * status : no problem Working fine.
 * and open the template in the editor.
 */

$sql = "SELECT species_primary_common_name as species_label,species_id as species_value FROM species_master";
$resd = $dbc->readtabledata($sql);

//echo $sql;
// loop through each row returned and format the response for jQuery
$autofilldata = array("1234","1234");
if ( $resd && mysql_num_rows($resd) )
{
	while( $row = mysql_fetch_array($resd, MYSQL_ASSOC) )
	{
		$autofilldata[] = array(
				'label' => $row['species_label'] ,
				'value' => $row['species_value']
		);
	}
}

$j=$i;


?>
<script>

$(function() {

	
	//var dt=new Array;
	//dt= <?php foreach ($autofilldata as $t){echo json_encode($t);}?>;
	//alert(dt);
    $( "#autotag<?echo $j?>" ).autocomplete({source: 'suggesttrees.php',
        selectFirst: 'true',

        select: function(event, ui) {
            event.preventDefault();
            $("#autotag<?echo $j?>").val(ui.item.label);
             $("#selspecies_id<?echo $j?>").val(ui.item.value);
             $("#selspecies_name<?echo $j?>").val(ui.item.label);
             showImg1(ui.item.value); 
                                            
        },
        focus: function(event, ui) {
            event.preventDefault();
           $("#autotag<?echo $j?>").val(ui.item.label);
           
            
        },
        change: function(event,ui) {
        	event.preventDefault();
            $("#autotag<?echo $j?>").val(ui.item.label);
             $("#selspecies_id<?echo $j?>").val(ui.item.value);
             $("#selspecies_name<?echo $j?>").val(ui.item.label);
             showImg1(ui.item.value);    
        }
      
    });
    


    function showImg1(str)
    {
    	
    if (str=="")
      {
      document.getElementById("theImg1").src="images/white.gif";
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
               //alert("image not fond");
               document.getElementById("theImg1<?echo $j?>").src="images/noimage.jpg";
            }
            else
            {
            	var pos =  res_text.indexOf('=');
                var imagesource= res_text.substring(0, res_text.indexOf('='));
                var allspeciesinfo=res_text.substring(res_text.indexOf('=')+1,res_text.length);
                var sciencename= allspeciesinfo.substring(0,allspeciesinfo.indexOf('|'));
                var notes = allspeciesinfo.substring(allspeciesinfo.indexOf('|')+1,allspeciesinfo.length );
                res_text=imagesource;
		
		document.getElementById('selspeciesmsg1<?echo $j?>').style.display='none';
                document.getElementById('specienotesmsg1<?echo $j?>').style.display='none';

 	        document.getElementById("theImg1<?echo $j?>").src=imagesource;
                document.getElementById('speciescname1<?echo $j?>').style.display='block';
                document.getElementById('specienotes1<?echo $j?>').style.display='block';
                
                $("#speciescname1<?echo $j?>").text(sciencename);
                $("#specienotes1<?echo $j?>").text(notes);
                // document.getElementById('treeconfirmyes<?echo $j?>').style.display='block';
                //document.getElementById('treeconfirmNot<?echo $j?>').style.display='block';
                //document.getElementById('specisNo<?echo $j?>').style.display='block';
                //document.getElementById('specisYes<?echo $j?>').style.display='block';
                 //alert(sciencename);
            }
            /*  var res_text = xmlhttp.responseText;
         
          if (res_text.length <"3")
              {
                  //alert("omage not fond");
                  document.getElementById("theImg1").src="images/noimage.jpg";
              }
              else
                  {
    	  //document.getElementById("theImg").src=xmlhttp.responseText;
            	  var data=xmlhttp.responseText;
            	  var n=data.split(":");
            	  document.getElementById("theImg1").src=n[0];
            	  
                 
                   
                  }
    	  //document.getElementById("theImg").src=xmlhttp.responseText;*/
    	  
        } 
      return true;
      }
    xmlhttp.open("GET","getimage_lat.php?q="+str,true);
    xmlhttp.send();
    }
	$('#specisYes<?echo $j?>').click(function(){
       
       
         EnableLocationed<?echo $j?>();
     
       
       
       
     });
     $('#specisNo<?echo $j?>').click(function(){
       
        
        $("#autotag<?echo $j?>").val("");
        document.getElementById("theImg1<?echo $j?>").src="images/white.gif";
        document.getElementById("speciescname1<?echo $j?>").value="";
        document.getElementById("specienotes1<?echo $j?>").value="";
       
        $("#speciescname1<?echo $j?>").val("");;
        $("#specienotes1<?echo $j?>").val("");
    
         document.getElementById("speciescname1<?echo $j?>").style.display='none';
        document.getElementById("specienotes1<?echo $j?>").style.display='none';
        
       
        //EnableChoosetreeed<?echo $j?>();
        
     });

    
});
</script>


<style type="text/css">

.nav li a{

width:120px;
text-align:center;
}


</style>

<?
$q1="SELECT tree_nickname, members_assigned,location_type, tree_height, tree_girth, tree_damage, 
                    is_fertilised, is_watered, distance_from_water, degree_of_slope, aspect, other_notes, species_id
                    FROM trees, tree_measurement, user_tree_table 
                    WHERE trees.tree_Id=tree_measurement.tree_Id AND tree_measurement.user_id='$_SESSION[userid]'
                    AND trees.tree_Id=user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]'
                    AND trees.tree_Id='$treeIDAr[$j]'";
                list($tree_nickname11, $members_assigned1,$location_type1, $tree_height1, $tree_girth1, $tree_damage1, $is_fertilised1, $is_watered1, $distance_from_water1, $degree_of_slope1, $aspect1, $other_notes1, $species_id1) =mysql_fetch_row(mysql_query($q1));
                //list($species_name1,$especies_id1)=mysql_fetch_row(mysql_query("SELECT species_primary_common_name, species_id from species_master where species_id in (SELECT species_id from trees WHERE tree_Id='$treeIDAr[$j]')")); 
                   list($species_name1,$especies_id1,$escname1,$esnotes)=mysql_fetch_row(mysql_query("SELECT species_primary_common_name, species_id,species_scientific_name,special_notes_on_the_species from species_master where species_id in (SELECT species_id from trees WHERE tree_Id='$treeIDAr[$j]')"));                
                
                $gettreename="select user_tree_id ,tree_nickname from user_tree_table where tree_id ='$treeIDAr[$j]'";
                list($user_tree_id1,$tree_nickname1)=mysql_fetch_row(mysql_query($gettreename));
                //$tree_nickname
                
                list($file_name1,$path_name1)= mysql_fetch_row(mysql_query("SELECT file_name,path_name FROM species_images where species_id='$especies_id1'"));
                $imagesource1 = $path_name1.$file_name1;
                
                
                
              ?>
    <a href = "javascript:void(0)" onclick = "document.getElementById('lightSix<?php echo $j?>').style.display='none';document.getElementById('fadeOne').style.display='none';resetall<?php echo $j?>();"><img src="images/closeone.png" alt="close" id="treeclose1"/></a> 
    <div class="DashBosrdcontainer_add_tree_lightbox">
    <form name="edit_tree" id="edit_tree<?echo $i;?>" method="POST" action="edittree.php?j=<?echo $i;?>" onSubmit="return EditTree(<?echo $j?>);">
    <div class="container_nav">
    <h2>Edit Tree <?echo ucfirst(strtolower(htmlspecialchars($tree_nickname11))); ?></h2>
    	<div class="nav_bg">
        <ul class="nav">
        <li ><a href="javascript:void(0)" onclick="EnableChoosetreeed<?echo $j?>()" class="cur" id="edtreesel<?echo $j?>">Edit Species<div class=""></div></a></li>
         <li ><a href="javascript:void(0)"  onclick="EnableLocationed<?echo $j?>()" id="edlocation<?echo $j?>">Edit Location<div class=""></div></a></li>
          <li ><a href="javascript:void(0)" onclick="EnableDetailsed<?echo $j?>()"  class="last" id="eddetails<?echo $j?>">Edit Details</a></li>
         <!-- <li><a onclick="document.getElementById('TBOX').style.display='block';document.getElementById('tags').style.display='block';document.getElementById('boxDO').style.display='none';document.getElementById('mapBox').style.display='none';document.getElementById('pick').style.display='block';document.getElementById('pickone').style.display='block';document.getElementById('button_area_ok').style.display='none';document.getElementById('button_area_loc').style.display='block'; document.getElementById('button_area_details').style.display='none';" href="javascript:void(0)" class="cur" id="treesel">Choose a Tree<div class=""></div></a></li>-->
        <!--<li><a onclick="document.getElementById('TBOX').style.display='none';document.getElementById('tags').style.display='block';document.getElementById('boxDO').style.display='none';document.getElementById('mapBox').style.display='block';document.getElementById('pick').style.display='block';document.getElementById('pickone').style.display='block';document.getElementById('button_area_ok').style.display='none';document.getElementById('button_area_details').style.display='block';document.getElementById('button_area_loc').style.display='none';" href="javascript:void(0)" id="addlocation">Add Location<div class=""></div></a></li>-->
        
       <!-- <li><a onclick="document.getElementById('TBOX').style.display='none';document.getElementById('tags').style.display='none';document.getElementById('boxDO').style.display='block';document.getElementById('mapBox').style.display='none';document.getElementById('pick').style.display='none';document.getElementById('pickone').style.display='none';document.getElementById('boxDO').style.border='none';document.getElementById('button_area_ok').style.display='block';document.getElementById('button_area_details').style.display='none'; document.getElementById('button_area_loc').style.display='none';" href="javascript:void(0)" class="last" id="adddetails">Add Details</a></li>-->
        </ul>
		</div>
        <!-- script type="text/javascript" src="js/jquery-1.7.2.min.js"></script-->
        <script type="text/javascript">
        /*$(".nav li a").click(function (){
         $('.nav li a').removeClass('cur');
            $(this).addClass('cur');
          });*/ 

          function resetall<?php echo $j;?>(){

              //reset tree species values
        	  $("#autotag<?echo $j?>").val("<?php echo $species_name1;?>");
        	  $("#seltreeid<?php echo $j;?>").val('<? echo $treeIDAr[$j]; ?>');

        	  imagesrc='<?echo $imagesource1;?>';
        	  //alert(imagesrc);
        	  <?if ($imagesource1==""){?>
        	  document.getElementById("theImg1<?echo $j?>").src='images/white.gif';
                  <?}else{?>
                  document.getElementById("theImg1<?echo $j?>").src='<?echo $imagesource1;?>';
             <?}?>

             document.getElementById("selspeciesmsg1<?echo $j?>").innerHTML='<?echo $escname1;?>';
             document.getElementById("speciescname1<?echo $j?>").innerHTML='';
             document.getElementById("specienotesmsg1<?echo $j?>").innerHTML="<?echo $esnotes;?>";
             document.getElementById("specienotes1<?echo $j?>").innerHTML='';

             document.getElementById("selspeciesmsg1<?echo $j?>").style.display='block';
             document.getElementById("speciescname1<?echo $j?>").style.display='block';
             document.getElementById("specienotesmsg1<?echo $j?>").style.display='block';
             document.getElementById("specienotes1<?echo $j?>").style.display='block';
             
             // reset tree details
             $("#selspecies_id<?echo $j?>").val('<? echo htmlspecialchars($species_id1); ?>' );
             $("#selspecies_name<?echo $j?>").val('<?php echo $species_name1;?>'); 
           	 $("#etree_nickname<?echo $j?>").val('<?echo htmlspecialchars($tree_nickname1)?>');
             $("#etree_height<?echo $j?>").val(' <? echo htmlspecialchars($tree_height1); ?>');
             $("#etree_girth<?echo $j?>").val(' <?echo htmlspecialchars($tree_girth1)?>');
             $("#edistance_from_water<?echo $j?>").val(' <?echo htmlspecialchars($distance_from_water1);?>');
             $("#edegree_of_slope<?echo $j?>").val(' <?echo htmlspecialchars($degree_of_slope1);?>');
             $("#eother_notes<?echo $j?>").val('<?php if($other_notes1 == 'undefined') echo '';else echo $other_notes1;?>');
             
             var aspect='<?php echo $aspect1;?>';
             
             var sel = document.getElementById('easpect<?echo $j?>');
             if(aspect==''){ sel.selectedIndex = 0;}
             else{
             for(var i, j = 0; i = sel.options[j]; j++) {
                var val=i.text;
                
                if(val == aspect) {
                    sel.selectedIndex = j;
                    
                    break;
                }//if
             }//for
             }//else
             //$(#easpect<?echo $j?>").val('<?php echo $aspect1;?>');
             var dam='<?echo $tree_damage1;?>';
             if(dam == '0'){
            	// $('input:radio[name=sex]')[0].checked = true;
                 
             $('input:radio[name=etree_damage<?echo $j?>]')[0].checked=true;
             $('input:radio[name=etree_damage<?echo $j?>]')[1].checked=false;
             }
             else if(dam == '-1'){
            	// $('input:radio[name=etree_damage<?echo $j?>]').checked=false;
            	 $('input:radio[name=etree_damage<?echo $j?>]')[0].checked=false;
                 $('input:radio[name=etree_damage<?echo $j?>]')[1].checked=false;
             }
             else{
            	 $('input:radio[name=etree_damage<?echo $j?>]')[0].checked=false;
                 $('input:radio[name=etree_damage<?echo $j?>]')[1].checked=true;
             }

             var fer='<?echo $is_fertilised1;?>';
             if(fer == '0'){
            	 $('input:radio[name=eis_fertilised<?echo $j?>]')[0].checked=true;
            	 $('input:radio[name=eis_fertilised<?echo $j?>]')[1].checked=false;
             }
             else if(fer == '-1'){
            	 $('input:radio[name=eis_fertilised<?echo $j?>]')[0].checked=false;
            	 $('input:radio[name=eis_fertilised<?echo $j?>]')[1].checked=false;
             }
             else{
            	 $('input:radio[name=eis_fertilised<?echo $j?>]')[0].checked=false;
            	 $('input:radio[name=eis_fertilised<?echo $j?>]')[1].checked=true;
             }

             var wat='<?echo $is_watered1;?>';
             if(wat == '0'){
                  $('input:radio[name=eis_watered<<?echo $j?>]')[0].checked=true;
        	      $('input:radio[name=eis_watered<<?echo $j?>]')[1].checked=false;
             }
             else if(wat == '-1'){
            	 $('input:radio[name=eis_watered<?echo $j?>]')[0].checked=false;
            	 $('input:radio[name=eis_watered<?echo $j?>]')[1].checked=false;
            	 
             }
             else{
            	 $('input:radio[name=eis_watered<?echo $j?>]')[0].checked=false;
            	 $('input:radio[name=eis_watered<?echo $j?>]')[1].checked=true;
             }
             
             
             //document.getElementById('eis_fertilised<?echo $j?>').value=<?echo  $is_fertilised1;?>;
             //document.getElementById('eis_watered<?echo $j?>').value=<?echo  $is_watered1;?>;
 
         	 resetlocvalues<?echo $j?>();

         	var locname = $("#loc_name<?echo $j?>").val();
            var loctype = $("#location_type<?echo $j?>").val(); 
            var locstate =  $("#state<?echo $j?>").val();
            var loccity =$("#city<?echo $j?>").val();
            var loclat =$("#lat<?echo $j?>").val();
            var loclong =$("#lng<?echo $j?>").val();
            var loctype=$("#location_type<?echo $j?>").val();
         	 
         	document.getElementById('locid<?echo $j?>').value=$("#locationid<?php echo $j?>").val();          
            document.getElementById('loclat<?echo $j?>').value=loclat;
            document.getElementById('loclon<?echo $j?>').value=loclong;
            document.getElementById('loccity<?echo $j?>').value=loccity;
            document.getElementById('locname<?echo $j?>').value=locname;
            document.getElementById('zoomval<?echo $j?>').value='15';
            document.getElementById('elocation_type<?echo $j?>').value=loctype;    

         	EnableChoosetreeed<?echo $j?>();

 
          }

          
        function EnableChoosetreeed<?echo $j?>()
        {
        	$('.nav li a').removeClass('cur'); 
        	document.getElementById('edtreesel<?echo $j?>').className='cur';
            document.getElementById('edlocation<?echo $j?>').className='';
            document.getElementById('eddetails<?echo $j?>').className='';
              document.getElementById('TBOX<?echo $j?>').style.display='block';
              document.getElementById('autotag<?echo $j?>').style.display='block';
              document.getElementById('boxDO<?echo $j?>').style.display='none';
              document.getElementById('mapBox<?echo $j?>').style.display='none';
              document.getElementById('pick<?echo $j?>').style.display='block';
              document.getElementById('edtreecancel<?echo $j?>').style.display='none';
              document.getElementById('button_area_ok<?echo $j?>').style.display='none';
              document.getElementById('button_area_loc<?echo $j?>').style.display='none'; 
              document.getElementById('button_area_details<?echo $j?>').style.display='none';

              document.getElementById('button_loc_prev<?echo $j?>').style.display='none';
              document.getElementById('button_area_next<?echo $j?>').style.display='none';
              document.getElementById('button_details_prev<?echo $j?>').style.display='none';
              document.getElementById('button_loc_next<?echo $j?>').style.display='block';
		
		 //document.getElementById('treeconfirmyes<?echo $j?>').style.display='none';
            //document.getElementById('treeconfirmNot<?echo $j?>').style.display='none';
           // document.getElementById('specisNo<?echo $j?>').style.display='none';
            //document.getElementById('specisYes<?echo $j?>').style.display='none';
              
                   
             
             
        }
        function EnableLocationed<?echo $j?>()
        {
            
           
            //var selTree = $("#selspecies_id").val();
            var selTree = $("#autotag<?echo $j?>").val();
            if (selTree=='')
            {
            alert("Please choose a tree species first");
            //alert("Please select the Tree species from choose Tree.");
                
            $('.nav li a').removeClass('cur');
            document.getElementById('edtreesel<?echo $j?>').className='cur';
            document.getElementById('edlocation<?echo $j?>').className='';
            document.getElementById('eddetails<?echo $j?>').className='';
            document.getElementById('TBOX<?echo $j?>').style.display='block';
            document.getElementById('autotag<?echo $j?>').style.display='block';
            document.getElementById('boxDO<?echo $j?>').style.display='none';
            document.getElementById('mapBox<?echo $j?>').style.display='none';
            document.getElementById('pick<?echo $j?>').style.display='block';
            document.getElementById('edtreecancel<?echo $j?>').style.display='none';
            document.getElementById('button_area_ok<?echo $j?>').style.display='none';
            document.getElementById('button_area_loc<?echo $j?>').style.display='none';
            document.getElementById('button_area_details<?echo $j?>').style.display='none';
                       
         document.getElementById('button_loc_prev<?echo $j?>').style.display='none';
       document.getElementById('button_area_next<?echo $j?>').style.display='none';
       document.getElementById('button_details_prev<?echo $j?>').style.display='none';
       document.getElementById('button_loc_next<?echo $j?>').style.display='block';


		 //document.getElementById('treeconfirmyes<?echo $j?>').style.display='none';
           // document.getElementById('treeconfirmNot<?echo $j?>').style.display='none';
            //document.getElementById('specisNo<?echo $j?>').style.display='none';
            //document.getElementById('specisYes<?echo $j?>').style.display='none';
            return false;
             
            }
            else
            {
            	$('.nav li a').removeClass('cur');  
            	document.getElementById('edlocation<?echo $j?>').className='cur';
            	 document.getElementById('edtreesel<?echo $j?>').className='';
                 document.getElementById('eddetails<?echo $j?>').className='';             
              document.getElementById('TBOX<?echo $j?>').style.display='none';
              document.getElementById('autotag<?echo $j?>').style.display='none';
              document.getElementById('boxDO<?echo $j?>').style.display='none';
              document.getElementById('mapBox<?echo $j?>').style.display='block';
              document.getElementById('pick<?echo $j?>').style.display='none';
              document.getElementById('edtreecancel<?echo $j?>').style.display='none';
              document.getElementById('button_area_ok<?echo $j?>').style.display='none'; 
              document.getElementById('button_area_loc<?echo $j?>').style.display='none'; 
              document.getElementById('button_area_details<?echo $j?>').style.display='none';
              document.getElementById('button_loc_prev<?echo $j?>').style.display='block';
              document.getElementById('button_area_next<?echo $j?>').style.display='block';
              document.getElementById('button_details_prev<?echo $j?>').style.display='none';
              document.getElementById('button_loc_next<?echo $j?>').style.display='none';
 		//document.getElementById('treeconfirmyes<?echo $j?>').style.display='none';
          //  document.getElementById('treeconfirmNot<?echo $j?>').style.display='none';
            //document.getElementById('specisNo<?echo $j?>').style.display='none';
           // document.getElementById('specisYes<?echo $j?>').style.display='none';
              
            }
        }
         function EnableDetailsed<?echo $j?>()
        {
             //var selTree = $("#selspecies_id").val();
             var selTree = $("#autotag<?echo $j?>").val();
             if (selTree=='')
             {  
            	 alert("Please choose a tree species first");
                 //alert("Please select the Tree species from choose Tree.");
                 EnableChoosetree<?echo $j?>();
                 return false;
             }
            else
            {

         	   //	AddLocation();
                var locname = $("#loc_name<?echo $j?>").val();
                var loctype = $("#location_type<?echo $j?>").val(); 
                var locstate =  $("#state<?echo $j?>").val();
                var loccity =$("#city<?echo $j?>").val();
                var loclat =$("#lat<?echo $j?>").val();
                var loclong =$("#lng<?echo $j?>").val();
                var loctype=$("#location_type<?echo $j?>").val();
            
                if (loclat!='')
                 {
                     if (locstate==''|loccity=='' |locname=='' |loctype=='')
                     {
                         alert("Please complete the location information from 'Edit Location' before editing the details.");
                         EnableLocationed<?echo $j?>();
                         return false;
                     }

                     //map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
                     var zoom_get = $('#zoom<?echo $j?>').val();
                     
                    if(zoom_get < 15 ) 
                    {
                        alert("Current zoom level is " + zoom_get + ".  The min accepted zoom level is 15. Please zoom in more to select the location.");
                        return false;
                    }
                 }
                 
                document.getElementById('locid<?echo $j?>').value=$("#locationid<?php echo $j?>").val();          
                 document.getElementById('loclat<?echo $j?>').value=loclat;
                 document.getElementById('loclon<?echo $j?>').value=loclong;
                 document.getElementById('loccity<?echo $j?>').value=loccity;
                 document.getElementById('locname<?echo $j?>').value=locname;
                 document.getElementById('zoomval<?echo $j?>').value=zoom_get;
                 document.getElementById('elocation_type<?echo $j?>').value=loctype;    
                   
                        $('.nav li a').removeClass('cur');
                        document.getElementById('edlocation<?echo $j?>').className='';
                        document.getElementById('edtreesel<?echo $j?>').className='';
                        document.getElementById('eddetails<?echo $j?>').className='cur';
                        document.getElementById('TBOX<?echo $j?>').style.display='none';
                        document.getElementById('autotag<?echo $j?>').style.display='none';
                        document.getElementById('boxDO<?echo $j?>').style.display='block';
                        document.getElementById('mapBox<?echo $j?>').style.display='none';
                        document.getElementById('pick<?echo $j?>').style.display='none';
                        document.getElementById('boxDO<?echo $j?>').style.border='none';
                        document.getElementById('button_area_ok<?echo $j?>').style.display='block';
                        document.getElementById('button_area_details<?echo $j?>').style.display='none';
                        document.getElementById('button_area_loc<?echo $j?>').style.display='none'; 
                        document.getElementById('button_details_prev<?echo $j?>').style.display='block';
                        document.getElementById('button_loc_prev<?echo $j?>').style.display='none';
                        document.getElementById('button_area_next<?echo $j?>').style.display='none';
                        document.getElementById('button_loc_next<?echo $j?>').style.display='none'; 
                        document.getElementById('edtreecancel<?echo $j?>').style.display='block';
 		//document.getElementById('treeconfirmyes<?echo $j?>').style.display='none';
         //   document.getElementById('treeconfirmNot<?echo $j?>').style.display='none';
           // document.getElementById('specisNo<?echo $j?>').style.display='none';
           // document.getElementById('specisYes<?echo $j?>').style.display='none'; 
                        
                    	   
              }

        }

        </script>
    </div>
    
    <h3 id="pick<?echo $j?>">Type the Tree Species name you are observing:<br />
    <input type="text" name="autotag<?echo $j?>" id="autotag<?echo $j?>" value="<?php echo $species_name1;?>" onfocus="if(this.value=='Type the name of the tree species you are observing. Eg: Neem')this.value='';"  class="cmnameField"/>
    <!-- select name="treename" id="treename" onchange="showtree(this.value);">
                            
			    <option value="">Select a Tree</option>
<?php
				//$result = mysql_query("SELECT species_primary_common_name as species_label,species_id FROM species_master ORDER BY species_primary_common_name");
        		      /*  if($result){
                                   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                     //echo $row{'species_id'};
                                         print "<option value=\"".$row{'species_id'}.",".$row{'species_label'}."\"";
                                              print ">".$row{'species_label'}."</option>\n";
        			               }
				 }*/
?>
                         </select-->
    </h3>
    <input type="hidden" id="seltreeid<?php echo $j;?>" value="<? echo $treeIDAr[$j]; ?>" />
    <!-- h5 id="pickone">Or pick the leaf type from below:</h5>-->
    <div class="clearBoth"></div>
<!-- start Tree_box-->
    <div id="TBOX<?echo $j?>" class="tree_box">
        <div style="float:left" > <!--This is the first division of left-->
        <div id="firstpane" class="firstpane"> <!--Code for menu starts here-->
        <ul class="addtreeList">
         <?if ($imagesource1==""){?>
                    <img id='theImg1<?echo $j?>' src='images/white.gif'   style='max-width:300px;max-height:400px'/>
                        <?}else{?>
                    <img id='theImg1<?echo $j?>'  src='<?echo $imagesource1;?>' style='max-width:300px;max-height:400px' />
                   <?}?>
        </ul> 
	 <div class="genaddTreeContainerHolder1">
                <h2> <i><div id="selspeciesmsg1<?echo $j?>"><?echo $escname1;?></div></i></h2>
                <h2> <i><div id="speciescname1<?echo $j?>"> </div></i></h2>
                <br>
                <p> <div id="specienotesmsg1<?echo $j?>"> <?echo $esnotes;?></div></p>
                <p> <div id="specienotes1<?echo $j?>"> </div></p>
                </div>     
        </div>
   <!--<div class="clearBoth"></div>
        <div id="treeconfirmyes<?echo $j?>"   style="float:right;display:none;padding-left:10px;padding-right:10px;"><input type="button"    class="msgbut" id="specisYes<?echo $j?>" Value="Yes, this is the one." onclick="specisYes()"></div>&nbsp;&nbsp;
        <div id="treeconfirmNot<?echo $j?>"  style="float:right;display:none;"><input type="button"  class="msgbut" id='specisNo<?echo $j?>' value="No, I will try again" onclick="specisNo()"></div>
        <div class="clearBoth"></div>
        <br>-->
        </div>
        
    </div>
 </div>
        <!-- end tree_box -->                        	
 <div class="clearBoth"></div>

<div style="border:0px solid #000;display:none;" id="mapBox<?echo $j?>">
    <?include("edittree_step.php"); ?>  
</div>

<div class="clearBoth"></div>
   
<div id="boxDO<?echo $j?>" style="border:0px solid #000; display:none;">
   <div class="DashBosrdcontainer_add_tree_lightbox">
      <div class="leftBox_ONE">
            <p> Fields marked with * are compulsory. <br /></p>
            <p>
                <label>Species Name </label>
  
                <?php
				//$result = mysql_query("SELECT species_primary_common_name as species_label,species_id FROM species_master ORDER BY species_primary_common_name");
        		      /*  if($result){
                                   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                     //echo $row{'species_id'};
                                         print "<option value=\"".$row{'species_id'}.",".$row{'species_label'}."\"";
                                              print ">".$row{'species_label'}."</option>\n";
        			               }
				 }*/
?>
            <input name="selspecies_name<?echo $j?>" type="text"  style="color:#888;background-color:#DADADA;" value="<?php echo $species_name1;?>" id="selspecies_name<?echo $j?>" readonly="readonly" title="select the species type from choose tree."/></p>
            <input type="hidden" id="selspecies_id<?echo $j?>" name="selspecies_id<?echo $j?>" value="<? echo htmlspecialchars($species_id1); ?>" /> 
            <p><label>Latitude</label><input type=text id="loclat<?echo $j?>"  name="loclat<?echo $j?>" value="" style="color:#888;background-color:#DADADA;" DISABLED /></p>
            <p><label>Longitude</label><input type=text id="loclon<?echo $j?>"  name="loclon<?echo $j?>" value="" DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <p><label>City</label><input type=text id="loccity<?echo $j?>"  name="loccity<?echo $j?>" value="" DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <p><label>Location name</label>
            <input type="text" id="locname<?echo $j?>"  name="locname<?echo $j?>" value="" DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <input type="hidden" id="zoomval<?php echo $j?>" name="zoomval<?php echo $j?>" value=""/>
            <input type="hidden" name="locid<?echo $j?>"  id ="locid<?echo $j?>" value="" />
           
            <?php
                    $sql = mysql_query("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[userid]'");
                   echo "<select name='nicknames' id='nicknames' style='display:none;visibility:hidden;'>";
                    while($row=mysql_fetch_array($sql))
                    {
                    echo "<option>".$row['tree_nickname']."</option>";
                    }
                    echo "</select>";
                    ?>
           
                       <p>
                    <label title="Please select the location type">Location Type</label>                             
                    <input name="elocation_type<?echo $j?>" type="text" id="elocation_type<?echo $j?>" value="" disabled title="select the location type from Addlocation." style="color:#888;background-color:#DADADA;"/>        
                     </p>
             <p>
            <label title="Please give all your trees a unique nickname. This will help you distinguish your individual trees">Nickname*</label>
            <input name="" type="text" value="<?echo htmlspecialchars($tree_nickname1)?>" id="etree_nickname<?echo $j?>" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees" />
            </p>
            <input type="hidden" name="chnickname<?echo $j?>"  id ="chnickname<?echo $j?>" value="0" />
            <p>
            <label title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured).">Height (in m)</label>
            <input id="etree_height<?echo $j?>" type="text" value="<? echo htmlspecialchars($tree_height1); ?>" title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured)."/>
            </p>
            <p>
            <label title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler.">
	     Girth (in cm)</label><input id="etree_girth<?echo $j?>" type="text" value="<?echo htmlspecialchars($tree_girth1)?>" title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4 m or 4.5 ft from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler." />
            </p>
            <p>
            <label title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">Aspect</label>
             <?php
             $Dont_know=$North=$NorthEast=$East=$SouthEast=$South=$SouthWest=$West=$NorthWest="";
			switch ($aspect1)
			{
			case "":
			$Dont_know="selected";
			break;
			case "North":
			$North="selected";
			break;
			case "NorthEast":
			$NorthEast="selected";
			break;
			case "East":
			$East="selected";
			break;
			case "SouthEast":
			$SouthEast="selected";
			break;
			case "South":
			$South="selected";
			break;
			case "SouthWest":
			$SouthWest="selected";
			break;
			case "West":
			$West="selected";
			break;
			case "NorthWest":
			$NorthWest="selected";
			break;
			}
			?>
             <select id="easpect<?echo $j?>" title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">
                                 <option name="Dont know" value="" <? echo $Dont_know; ?>>Choose one</option>
				<option id="North" value="North" <? echo $North; ?>>North</option>
				<option id="NorthEast" value="NorthEast" <? echo $NorthEast; ?>>North-East</option>
				<option id="East" value="East" <? echo $East; ?>>East</option>
				<option id="SouthEast" value="SouthEast" <? echo $SouthEast; ?>>South-East</option>
				<option id="South" value="South" <? echo $South; ?>>South</option>
				<option id="SouthWest" value="SouthWest" <? echo $SouthWest; ?>>South-West</option>
				<option id="West" value="West" <? echo $West; ?>>West</option>
				<option id="NorthWest" value="NorthWest" <? echo $NorthWest; ?>>North-West</option>
					
                            </select>
          
            </p>
 
            <input type='hidden' name='cmd' value='edit_tree'>
        <br />
    </div>

    <div class="Right_BOX">
    <p></p>
    <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Nearest surface water (in m)</label>
             <input id="edistance_from_water<?echo $j?>" type="text" value="<?echo htmlspecialchars($distance_from_water1);?>" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
            <p>
            <label title="If your plant is on a hill, please try and note the degree of the hill slope.">Slope (in deg)</label>
             <input id="edegree_of_slope<?echo $j?>" type="text" value="<?echo htmlspecialchars($degree_of_slope1);?>" title="If your plant is on a hill, please try and note the degree of the hill slope."/>
            </p>
    <p>           
            
         <label  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">Damaged</label>&nbsp;
         <!-- input name="tree_damage" type="radio" value="0" checked="checked" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
         <!-- input name="tree_damage" type="radio" value="1" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/> Yes-->
         <? if ($tree_damage1=='0'){ ?>
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="0" checked="checked" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="1" />Yes
                <?}elseif ($tree_damage1=='1'){?>
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="0" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="1" checked="checked"/>Yes
                <?}else{?>
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="0" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="1" />Yes
                <?}?>
            </p>
             <p>
            <label  title="Many trees in parks, gardens and campuses are regularly fertilized. This affects the phenology of the tree and therefore must be noted.">
		Fertilised</label>&nbsp;
		<!-- input name="is_fertilised" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted."/> Yes-->
		<? if ($is_fertilised1=='0'){ ?>
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="0" checked="checked" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="1" />Yes
                <?} elseif($is_fertilised1=='1'){?>
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="1" checked="checked" />Yes
                <?} else {?>
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="1" />Yes
                <?}?>
            </p>
             <p>
            <label title="Many trees in parks, gardens and campuses are regularly watered. This affects the phenology of the tree and therefore must be noted.">
		Watered</label>&nbsp;
		<!-- input name="is_watered" type="radio" value="0" checked="checked" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_watered" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> Yes-->
		<? if ($is_watered1=='0'){ ?>
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="0" checked="checked" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="1" />Yes
                <?} elseif($is_watered1=='1'){?>
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="1" checked="checked" />Yes
                <?} else {?>
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="1" />Yes
                <?}?>
            </p><p>
            <label title="" style="padding-top:5px;width:110px">
		Notes about this tree (eg, any peculiarities, perhaps something about its history, etc)</label>&nbsp;
    <textarea class="text_box_textarea" style="width:190px;height:150px" id="eother_notes<?echo $j?>"><?php if($other_notes1 == 'undefined'){ echo '';} else{echo $other_notes1;}?></textarea><br/>
    <? if ($_SESSION['usercategory']!='individual'){?>
    <label title="" style="padding-top:75px;width:110px">
		Assign to students</label>&nbsp;
    
    <textarea class="text_box_textarea_one" style="width:190px;height:150px" id="estudentname<?echo $j?>" >eg. John,Bala,Kabir,Seetha</textarea><?}?>
    </p>
    </div>
    </div>
    <div class="clearBoth"></div>
        
        </div>

<div  class="button_area_indiv">
        <div class="button_area" >
        <div class="right_side_button" style="margin-left:10px;margin-right:10px;">
        <div class="button_area_ok" id="button_area_ok<?echo $j?>" style="display:none;">
                 <a href="#" onClick="EditTree(<?php echo $j?>)">SAVE</a>
            </div>
           <!--  <input name="EditIndiv" id="EditIndiv" type="submit" value="Edit Tree" class="button_area_ok" style="cursor:pointer;"  /> -->
            <div class="right_button"  id="button_area_loc<?echo $j?>"style="display:none;" >
                 <a href="#" OnClick="EnableLocationed<?echo $j?>()">Location</a>
            </div>
            <div class="right_button"  id="button_area_details<?echo $j?>" style="display:none;" >
                 <a href="#" OnClick="EnableDetailsed<?echo $j?>()">Details</a>
            </div>
            <div class="right_button"  id="button_loc_next<?echo $j?>" >
                 <a href="#" OnClick="EnableLocationed<?echo $j?>()">Next</a>
            </div>
                <div class="right_button"  id="button_area_next<?echo $j?>" style="display:none;" >
                 <a href="#" OnClick="EnableDetailsed<?echo $j?>()">Next</a>
            </div>
            <div class="button_area_cancel"><a href ="javascript:void(0)" style="display:none;" onclick = "document.getElementById('lightSix<?php echo $j?>').style.display='none';document.getElementById('fadeOne').style.display='none';resetall<?php echo $j?>();" id="edtreecancel<?echo $j?>">CANCEL</a></div>
            </div>
            <div class="left_button" id="button_loc_prev<?echo $j?>" style="display:none;" >
                 <a href="#" OnClick="EnableChoosetreeed<?echo $j?>()">Back</a>
            </div>
            <div class="left_button"  id="button_details_prev<?echo $j?>"  style="display:none;">
                 <a href="#" OnClick="EnableLocationed<?echo $j?>()">Back</a>
            </div>
        
        </div>
        </div>



                                

                                    
                                 
       
                                  
           
     
    
<!--</div>-->
<!--MODAL Ends-->
<!-- On submitting the above dialog box, the one below is loaded for bringing up Stage 2 of Add Tree.-->
