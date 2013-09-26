<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<? 
   //include("includes/dbc.php");
   //include("google_maps_api.php");
  
   $selectedtreeid1=$treeIDAr[$j];
     
   $q2="SELECT location_master.tree_location_id as tree_location_id,state_id,city,longitude,latitude,location_name,zoom_factor from location_master,trees,
   user_tree_table where trees.tree_Id=user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]'
   AND trees.tree_Id='$selectedtreeid1' and location_master.tree_location_id= trees.tree_location_id" ;
   $loc_tree_details1=$dbc->readtabledata($q2);
   
   $tree_loca1 = mysql_fetch_array($loc_tree_details1);
   if (empty($tree_loca1['tree_location_id']))
   {
   	$locid1= 0;
   	$lat1 = 22.97;
   	$lng1 = 77.56;
   	$zoom_fac1= 4;
   	$locname1="";
   	$loccity1 ="";
   	$state_id1="";
   	$dataloctionno1=0;
   	$location_type1="Choose";
   }
   else
   {
   	$locid1= $tree_loca1['tree_location_id'];
   	$lat1        = $tree_loca1['latitude'];
   	$lng1        = $tree_loca1['longitude'];
   	//$zoom_fac1   = $tree_loca1['zoom_factor'];
   	$zoom_fac1= 15;
   	$locname1    = $tree_loca1['location_name'];
   	$loccity1    = $tree_loca1['city'];
   	$state_id1   = $tree_loca1['state_id'];
   	
   	$q3="select location_type from trees where tree_location_id='$locid1' WHERE tree_id = '$selectedtreeid1'";
   	$location_typedet1 =$dbc->readtabledata($q3);
   	if($location_typedet1){
	$location_type1=mysql_fetch_row($location_typedet1);}
   }
      
   
   
?>
<!-- link href="css/global.css" rel="stylesheet" type="text/css" /-->
<!-- script type="text/javascript" src="js/jquery/jquery-1.3.2.min.js"></script-->
<script>
     
     function zoomVal<?echo $j?>(){
    	 //map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});

    	 //map.setCenter(new GLatLng(<? echo $lat1; ?>,<? echo $lng1; ?>), 4);
         //map.setUIToDefault();
         //map.enableDoubleClickZoom();
           //geocoder = new GClientGeocoder();
         	//GEvent.addListener(map, "click", getAddress<?echo $j?>);
           //GEvent.addListener(map, "zoomend", changeZoom<?echo $j?>);
           //GEvent.addListener(map, 'moveend', getZm<?php echo $j?>);
           var zoom_get =map.getZoom(); //$('#zoom<?echo $j?>').val();
        if(zoom_get < 15 ) {
            jAlert("Current zoom level is " + zoom_get + ".  The min accepted zoom level is 15. Please zoom in more to select the location.");
            return false;

        }

     }

     $(document).ready(function() {
         
           $('#zoominfo<?echo $j?>').hide();
   	   $("#editLocation<?echo $j?>").validate({
    	     rules: {
       	       loc_name: { required: true },
       	       lat: { required: true },
       	       lng: { required:true },
       	       state: { required: true},
       	       city: { required: true },
	       location_type: { required: true }
             },
   	     messages: {
       	       loc_name: { required: "<div class='error'>please enter a name for the location</div>" },
       	       lat: { required: "<div class='error'>please enter a latitude</div>" },
       	       lng: { required: "<div class='error'>please enter a longitude</div>" },
               state: { required: "<div class='error'>please enter a state</div>" },
       	       city: { required: "<div class='error'>please enter a city</div>" },
	       location_type: { required: "<div class='error'>please select the type of location</div>" }
             }
             
          });
  
	  jQuery.validator.addMethod("latlng", function(value, element) { 
             return this.optional(element) || /-?\d+\.\d+/.test(value);
          }, "please enter a valid value");
      });

     $(document.getElementById('mydiv')).ready(function() {
    	   	// do stuff when clicked
    	 initialize1<?php echo $j?>();
    	 	});

	 	function resetlocvalues<?echo $j?>(){

	 		$("#q<?echo $j?>").val('<?php echo $locname1;?>');
            $("#loc_name<?echo $j?>").val('<?php echo $locname1;?>');
            $("#city<?echo $j?>").val('<?php echo $loccity1;?>'); 
            //$("#state<?echo $j?>").val('<?php echo $state_id1;?>');
            $("#lat<?echo $j?>").val('<?php echo $lat1;?>');
            $("#lng<?echo $j?>").val('<?php echo $lng1?>');
            $("#location_type<?echo $j?>").val('<?php echo $location_type1;?>');
            document.getElementById('zoominfo<?echo $j?>').style.display='none'; 
            $("#zoom<?echo $j?>").val(<?php echo $zoom_fac1;?>);
<?php 
            $quer="SELECT state FROM seswatch_states where state_id='".$state_id1."'";
            $result = $dbc->readtabledata($quer);
	        if($result){
		        $state_name=mysql_fetch_row($result);
		        
	        }
	        else $state_name="";?>
	        var state_name='<?php echo $state_name[0];?>';
	        if(state_name != ''){
            var sel = document.getElementById('state<?echo $j?>');
             for(var i, j = 0; i = sel.options[j]; j++) {
                var val=i.text;
                if(val == state_name) {
                    sel.selectedIndex = j;
                    
                    break;
                }
             }//for
	        }//if
	        else{
	        	var sel = document.getElementById('state<?echo $j?>');
	        	sel.selectedIndex = 0;

	        }
	        initialize1<?php echo $j?>();              
 	 	}
</script>
<style>
.error { color: red; font-size:10px; }
.address_input { width:400px; 
        padding:5px;
	color:#666666;
	font-size:14px;
	border:1px solid #cccccc;
	outline:none;}

.cont-left { width:70%; margin-left:auto; margin-right:auto; list-style:none}
 .map, .map li { list-style:none; }
 .editloc_input { list-style:none; width:100%;padding:4px; font-size:16px;} 
 .editloc_input li { list-style:none; width:28%; float:left; display:block; padding:1%; margin:1%; margin-top:15px; margin-bottom:15px;height:60px; font-size:16px; }
 .editloc_input input { width:80%; padding:4px; border:1px solid #cccccc; font-size:16px;}
 .editloc_input select { width:80%; padding:4px; 
 	color:#666666;
	font-size:14px;
	width:210px !important;
	border:1px solid #cccccc;
	outline:none;
	float:center;
	margin-left:0px;}
 .search { margin:10px; }

</style>

<!-- body  style=""-->
   <div class='container main_body' id='mydiv' style="margin-left:10px;margin-right:20px;">
        <? //include("addtree_bc.php"); 
        ?>
        <!-- script type="javascript">initialize1<?echo $j?>();
    </script-->
         <div class='section search' style="margin-left:0px;">        
	     <form action="#" onsubmit="showLocation<?echo $j?>(); return false;"> 
               
                 <span style='margin-left:5px;font-size:16px; font-family: DroidSansRegular;'>Use the search box to find your location or zoom and click directly on the map</span>
                 <input type="text" name="q<?echo $j?>" id="q<?echo $j?>" value="<?echo $locname1?>" class="address_input" style="width:620px;">
	         <input class="a_submit" type="submit" name="find" value="SEARCH" style='padding:5px' onClick="javascript:showLocation<?echo $j?>(); return false;" /> 
                
             </form>                          	          
         </div><p>
        
         <div id='zoominfo<?echo $j?>' class='notice'></div>
         <div class='section'>
             <form id="edLocation<?echo $j?>" name="editres" onsubmit="editLocation<?echo $j?>(); return false;">
                <p>  <ul  class="map">       		
		     <li><div id="map<?echo $j?>" style="margin-left:10px;margin-bottom:10px;"></div></li>
                  </ul>
                   
                  <ul class="editloc_input"> 

                 </p><br /><p></p>
                 <p>  <span style='font-size:16px; margin-left:10px;font-family:DroidSansRegular;'>Verify Tree location info below and click 'Next' to proceed</span></p>
               <!-- li>LOCATIONID<br--><input type="hidden" name="locationid<?echo $j?>"  id ="locationid<?echo $j?>" value="<?echo $locid1;?> "  DISABLED/>
		      <li>Location name<em>*</em><br><input type="text"  id="loc_name<?echo $j?>" name="loc_name<?echo $j?>" value="<?echo $locname1?>"></li>
		      <li>City<em>*</em><br><input type=text id="city<?echo $j?>"  name="city<?echo $j?>" value="<?echo $loccity1?>"><br></li>
		      <li>Location type<em>*</em><br>
                       <?
                       $Dont_know="";$Garden="";$Avenue="";$Roadside="";$Forest="";$Campus="";$Marsh="";$Grassland="";$Plantation="";$Other="";$Farmland="";
                       switch ($location_type1)
			{
			case "Choose":
                            
			 $Dont_know="selected";
			break;
			case "Garden/Park":
                            
			 $Garden="selected";
			break;
			case "Avenue":
			 $Avenue="selected";
			break;
			case "Roadside":
			 $Roadside="selected";
                            
			break;
			case "Forest":
			 $Forest="selected";
			break;
			case "Campus":
			$Campus="selected";
			break;
			case "Marsh":
			$Marsh="selected";
			break;
			case "Grassland":
			$Grassland="selected";
			break;
			case "Plantation":
			$Plantation="selected";
			break;
                        case "Farmland":
                        $Farmland="selected";
                        break;
                        case "Other":
                        $Other="selected";
                        break;
			}?>
                            <select id="location_type<?echo $j?>" name="location_type<?echo $j?>">
                                <option id="Choose" value="" <?php  echo $Dont_know;?>>-- Choose --</option>
				<option id="Garden" value="Garden/Park"<? echo $Garden; ?>>Garden/Park</option>
				<option id="Avenue" value="Avenue" <? echo $Avenue; ?>>Avenue</option>
				<option id="Roadside" value="Roadside" <?echo $Roadside;?>>Roadside</option>
				<option id="Forest" value="Forest" <? echo $Forest; ?>>Forest</option>
				<option id="Campus" value="Campus" <? echo $Campus; ?>>Campus</option>
				<option id="Marsh" value="Marsh"<? echo $Marsh; ?> >Marsh</option>
				<option id="Grassland" value="Grassland"<? echo $Grassland; ?>>Grassland</option>
				<option id="Plantation" value="Plantation"<? echo $Plantation; ?>>Plantation</option>
				<option id="Farmland" value="Farmland" <? echo $Farmland; ?>>Farmland</option>
				<option id="Other" value="Other"<? echo $Other; ?>>Other</option>
                            </select>
                      </li>
                           
                     <li>Latitude<em>*</em><br><input type=text id="lat<?echo $j?>"  name="lat<?echo $j?>" value="<?echo $lat1;?>" DISABLED style="color:#888;background-color:#DADADA;"></li>
	       	     <li>Longitude<em>*</em><br><input type=text id="lng<?echo $j?>"   name="lng<?echo $j?>" value="<?echo $lng1;?>" DISABLED style="color:#888;background-color:#DADADA;"></li>
                     <li>State<em>*</em><br>
			 <select name="state<?echo $j?>" id="state<?echo $j?>">
			    <option value="">Select a State</option>
          <?php
				$result = $dbc->readtabledata("SELECT state_id, state FROM seswatch_states ORDER BY state");
        		        if($result){
                                   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                   	//echo "state_id=".$state_id1."row[stateid]=".$row['state_id'];
                                      if($row['state'] != 'Not In India') {
                                         //print "<option value=".$row['state_id'];
                                         print "<option value='".$row['state_id'];
                                         if ($row['state_id'] ==(int)$state_id1) {
                                            print "' selected >".$row['state']."</option>\n";
					 					  }else{
                                            print "'>".$row['state']."</option>\n";}
                                            
        			      } else {
                                           $other_id = $row['state_id'];
                                           $other = $row['state'];
                                       }
                                    }
				 }
?>
                         
                         </select>
			
		      </li>
                        
                      <li></li>
                       
                   		      
                     <!--<li style="width:90%; ">-->
                                
               			<input type="hidden" id="country<?echo $j?>"   name="country<?echo $j?>" value="India"/>
	       			<input type="hidden" name="zoom<?echo $j?>" id="zoom<?echo $j?>" value="<?php echo $zoom_fac1?>"/>
				<input type="hidden" name="step<?echo $j?>" value="3">
				<!--<input style="width:200px;padding:5px" type="submit" onclick="return zoomVal();" name="add_location" value="ADD LOCATION">-->
				<!--</li>-->
				
			</ul>
			</p>
        <br>          
    
	
	              		     </form>
	              		     
    
           </div>
      <div><br></div>   
</div>


<script type="text/javascript">
    var map;
    var geocoder;
    var address;
    
   function initialize1<?echo $j?>() {
      map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
      //map2 = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
      //map.setCenter(new GLatLng(<? echo $lat1; ?>,<? echo $lng1; ?>), 15);
      
      map.setCenter(new GLatLng(<? echo $lat1; ?>,<? echo $lng1; ?>), <?php echo $zoom_fac1;?>);
      //map.removeMapType("G_HYBRID_MAP");
      
       //map.addControl("GLargeMapControl");

       /*var mapControl = new GMapTypeControl();
      map.addControl(mapControl);
      map.addMapType("G_PHYSICAL_MAP");
      map.addMapType("G_SATELLITE_MAP");*/
       

        map.setUIToDefault();
        map.enableDoubleClickZoom();
        geocoder = new GClientGeocoder();
      	GEvent.addListener(map, "click", getAddress<?echo $j?>);
        GEvent.addListener(map, "zoomend", changeZoom<?echo $j?>);
        GEvent.addListener(map, 'moveend', getZm<?php echo $j?>);
      	//GEvent.addListener(map,'moveend', function () { var z=this.getZoom();$('#zoom<?echo $j?>').val(z); });
      	           
    }


    function changeZoom<?echo $j?>(from_zoom,to_zoom) {
    	//alert(map.getZoom());
        $('#zoom<?echo $j?>').val(this.getZoom());
        var zoom_get = $('#zoom<?echo $j?>').val();
        $('#zoominfo<?echo $j?>').show();
        if(zoom_get < 15){
        $('#zoominfo<?echo $j?>').html("Current zoom level is " + zoom_get + ".  Please zoom in to a minimum level of 15. To try and spot your tree from the sky, switch to satellite mode!");
        }
    }

    function getZm<?php echo $j;?>() {

    	var zoom_get=this.getZoom();$('#zoom<?echo $j?>').val(zoom_get);
    	$('#zoominfo<?echo $j?>').show();
        if(zoom_get < 15){
        $('#zoominfo<?echo $j?>').html("Current zoom level is " + zoom_get + ".  Please zoom in to a minimum level of 15. To try and spot your tree from the sky, switch to satellite mode!");
        }
        else{
      	  $('#zoominfo<?echo $j?>').html("Current zoom level is " + zoom_get);
        }

    	  };

    
    function getAddress<?echo $j?>(overlay, latlng) {

    	map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
    	var zoom_val_set;
	map.clearOverlays();
      	if (latlng) {
          address = latlng;
	  geocoder.getLocations(latlng, function(addresses) {
          if(addresses.Status.code != 200) {
            alert("reverse geocoder failed to find an address for " + latlng.toUrlValue());
          } else {
            address = addresses.Placemark[0];
            point = new GLatLng(latlng.y, latlng.x);
            $('#lng<?echo $j?>').val(latlng.x);
            $('#lat<?echo $j?>').val(latlng.y);
	    var final_address = address.address;
            marker = new GMarker(point);
            map.addOverlay(marker);
            var current_zoom =$('#zoom<?echo $j?>').val();
            //alert(current_zoom);
            if(current_zoom > 9 ) {
                zoom_val_set = (parseInt(current_zoom))+1;
             } else {
                zoom_val_set = 9;
             }
            
            //map.setCenter(new GLatLng(latlng.y, latlng.x), zoom_val_set);
                     
         map.setCenter(point,zoom_val_set);
         //map.addMapType( G_SATELLITE_MAP);
        map.setUIToDefault();
         map.enableDoubleClickZoom();
           geocoder = new GClientGeocoder();
         	GEvent.addListener(map, "click", getAddress<?echo $j?>);
           GEvent.addListener(map, "zoomend", changeZoom<?echo $j?>);
          GEvent.addListener(map, 'moveend', getZm<?php echo $j?>);
          //GEvent.addListener(map,'moveend', function () { var z=this.getZoom();$('#zoom<?echo $j?>').val(z); });

          if(final_address) 
                { setLocationValues<?echo $j?>(final_address); }  
         }

                             
       });
      	}

      	var zoom_get=this.getZoom();$('#zoom<?echo $j?>').val(zoom_get);
    	$('#zoominfo<?echo $j?>').show();
        if(zoom_get < 15){
        $('#zoominfo<?echo $j?>').html("Current zoom level is " + zoom_get + ".  Please zoom in to a minimum level of 15. To try and spot your tree from the sky, switch to satellite mode!");
        }
        else{
      	  $('#zoominfo<?echo $j?>').html("Current zoom level is " + zoom_get);
        }

      	 
    }

    function addAddressToMap<?echo $j?>(response) {
      map.clearOverlays();
      if (!response || response.Status.code != 200) {
        alert("Sorry, we were unable to geocode that address");
      } else {
        place = response.Placemark[0];
        point = new GLatLng(place.Point.coordinates[1],
                            place.Point.coordinates[0]);
        
        marker = new GMarker(point);
        map.addOverlay(marker);
        
        var current_zoom = $('#zoom<?echo $j?>').val();

        //alert("current_zoom(addaddresstomap)="+current_zoom); 
        
        if(current_zoom > 9 ) {
           var zoom_val_set = current_zoom;
        } else {
               var zoom_val_set = 15;
        }

        map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
        map.setCenter(new GLatLng(place.Point.coordinates[1],place.Point.coordinates[0]), 15);//zoom_val_set);
        //map.addMapType( G_SATELLITE_MAP);
        map.setUIToDefault();
        map.enableDoubleClickZoom();
          geocoder = new GClientGeocoder();
        	GEvent.addListener(map, "click", getAddress<?echo $j?>);
          GEvent.addListener(map, "zoomend", changeZoom<?echo $j?>);
          GEvent.addListener(map, 'moveend', getZm<?php echo $j?>);
          //GEvent.addListener(map,'moveend', function () { var z=this.getZoom();$('#zoom<?echo $j?>').val(z);  });
        
        $('#lng<?echo $j?>').val(place.Point.coordinates[0]);
	$('#lat<?echo $j?>').val(place.Point.coordinates[1]);

        var final_address = place.address;

      
         if(final_address) {        
            setLocationValues<?echo $j?>(final_address);
            
          }
      
      }
     
    }

    function showLocation<?echo $j?>() {
        
        //    var address = $('.address_input').val();
        var address=$("#q<?echo $j?>").val();
            geocoder.getLocations(address,addAddressToMap<?echo $j?>);
            
    }
    
    function AddLocation<?echo $j?>() {
        var locname = $("#loc_name<?echo $j?>").val();
        var loctype = $("#location_type<?echo $j?>").val(); 
        var locstate =  $("#state<?echo $j?>").val();
        var loccity =$("#city<?echo $j?>").val();
        var loclat =$("#lat<?echo $j?>").val();
        var loclong =$("#lng<?echo $j?>").val();
      
    }
 
    function setLocationValues<?echo $j?>(final_address) {
       var a1 = final_address;

       a1 = a1.split(',');
       var arcount = a1.length;
       var country_name  = a1[arcount - 1];
       var country_name =  country_name.split(' ').join('');
       if( country_name != 'India') { 
       	   //jAlert("Please choose a location only from India");
	   //$('#lng').val('');
	   //$('#lat').val('');
           //return false;
       }
       var state_name= a1[arcount - 2];
       state_name = state_name.substring(0, state_name.length - 7);
       state_name = state_name.trim();      
       $("#state<?echo $j?>").val(state_name); 
       
       //alert(state_name);
       
       var sel = document.getElementById('state<?echo $j?>');
    for(var i, j = 0; i = sel.options[j]; j++) {
        var val=i.text;
        if(val == state_name) {
            sel.selectedIndex = j;
            
            break;
        }
    }
               
        if( a1[arcount - 4] ) {
          if( a1[arcount-4] != 'undefined') {
              document.getElementById('loc_name<?echo $j?>').value = a1[arcount - 4];
           } else {
             document.getElementById('loc_name<?echo $j?>').value = '';
           }  

	   if(a1[arcount-3] != '') {
             if(a1[arcount-3] != 'undefined' ) {
               document.getElementById('city<?echo $j?>').value = a1[arcount - 3];
             }
            }
        } else {
	   document.getElementById('loc_name<?echo $j?>').value = a1[arcount - 3];
	}

        if( a1[arcount - 5] ) {
            document.getElementById('loc_name<?echo $j?>').value = a1[arcount - 5] + ', ' + document.getElementById('loc_name<?echo $j?>').value;
        }

        if( a1[arcount - 6] ) {
            document.getElementById('loc_name<?echo $j?>').value = a1[arcount - 6] + ', ' + document.getElementById('loc_name<?echo $j?>').value;
        }

        //var zoom_get = map.getZoom();
       //document.getElementById('zoom<?echo $j?>').value = this.getZoom();
        
      }
</script>
<!-- script type="text/javascript" src="js/jquery.validate.js"></script-->


