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
   	$zoom_fac1= 15;
   	$locname1="";
   	$loccity1 ="";
   	$state_id1="";
   	$dataloctionno1=0;
   }
   else
   {
   	$locid1= $tree_loca1['tree_location_id'];
   	$lat1        = $tree_loca1['latitude'];
   	$lng1        = $tree_loca1['longitude'];
   	$zoom_fac1   = $tree_loca1['zoom_factor'];
   	$locname1    = $tree_loca1['location_name'];
   	$loccity1    = $tree_loca1['city'];
   	$state_id1   = $tree_loca1['state_id'];
   }
      
   
   
?>
<!-- link href="css/global.css" rel="stylesheet" type="text/css" /-->
<!-- script type="text/javascript" src="js/jquery/jquery-1.3.2.min.js"></script-->
<script>
     
     function zoomVal<?echo $j?>(){
    	 map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
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
 .editloc_input { list-style:none; width:900px;padding:4px; border:1px solid #cccccc; font-size:14px; height:150px;} 
 .editloc_input li { list-style:none; width:28%; float:left; display:block; padding:1%; margin:1%; margin-top:15px; height:60px; font-size:13px; }
 .editloc_input input { width:80%; padding:4px; border:1px solid #cccccc; font-size:14px;}
 .editloc_input select { width:80%; padding:4px; 
 	color:#666666;
	font-size:14px;
	width:80% /*210px !important;*/	
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
        <h3 style="color:#336600;">WHERE IS YOUR TREE?</h3>
        <div id='zoominfo<?echo $j?>' class='notice'></div>
        <div class='section search'>        
	     <form action="#" onsubmit="showLocation<?echo $j?>(); return false;"> 
               
                 <span style='font-size:14px'>SEARCH FOR AN ADDRESS</span>:
                 <input type="text" name="q<?echo $j?>" id="q<?echo $j?>" value="<?echo $locname1?>" class="address_input" style="width:620px;">
	         <input class="a_submit" type="submit" name="find" value="SEARCH" style='padding:5px' onClick="javascript:showLocation<?echo $j?>(); return false;" /> 
                
             </form>                          	          
         </div>
         <div class='section'>
             <form id="edLocation<?echo $j?>" name="editres" onsubmit="editLocation<?echo $j?>(); return false;">
                  <ul  class="map">       		
		     <li><div id="map<?echo $j?>" style="margin-left:10px;margin-bottom:10px;"></div></li>
                  </ul>
                      
                 
                  <ul class="editloc_input">

               <!-- li>LOCATIONID<br--><input type="hidden" name="locationid<?echo $j?>"  id ="locationid<?echo $j?>" value="<?echo $locid1;?> "  DISABLED/>
		      <li>NEW LOCATION NAME<em>*</em><br><input type="text"  id="loc_name<?echo $j?>" name="loc_name<?echo $j?>" value="<?echo $locname1?>"></li>
		      <li>LOCATION TYPE<em>*</em><br>
                       <?
                       $Dont_know="";$Garden="";$Avenue="";$Forest="";$Campus="";$Marsh="";$Grassland="";$Plantation="";$Other="";$Farmland="";
                       switch (htmlspecialchars($location_type1))
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
                                <option id="Choose" value="Choose">-- Choose --</option>
				<option id="Garden" value="Garden/Park"<? echo $Garden; ?>>Garden/Park</option>
				<option id="Avenue" value="Avenue" <? echo $Avenue; ?>>Avenue</option>
				<option id="Forest" value="Forest" <? echo $Forest; ?>>Forest</option>
				<option id="Campus" value="Campus" <? echo $Campus; ?>>Campus</option>
				<option id="Marsh" value="Marsh"<? echo $Marsh; ?> >Marsh</option>
				<option id="Grassland" value="Grassland"<? echo $Grassland; ?>>Grassland</option>
				<option id="Plantation" value="Plantation"<? echo $Plantation; ?>>Plantation</option>
				<option id="Farmland" value="Farmland" <? echo $Farmland; ?>>Farmland</option>
				<option id="Other" value="Other"<? echo $Other; ?>>Other</option>
                            </select>
                      </li>
                           
                      
                      <li>CITY<em>*</em><br><input type=text id="city<?echo $j?>"  name="city<?echo $j?>" value="<?echo $loccity1?>"><br></li>
                     <li>STATE<em>*</em><br>
			 <select name="state<?echo $j?>" id="state<?echo $j?>">
			    <option value="">Select a State</option>
          <?php
				$result = $dbc->readtabledata("SELECT state_id, state FROM seswatch_states ORDER BY state");
        		        if($result){
                                   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                      if($row['state'] != 'Not In India') {
                                         //print "<option value=".$row['state_id'];
                                         print "<option value=".$row['state'];
                                         if ($row['state_id'] ==(int)$state_id1) {
                                            print " selected ";
					 }
                                            print ">'".$row['state']."'</option>\n";
        			      } else {
                                           $other_id = $row['state_id'];
                                           $other = $row['state'];
                                       }
                                    }
				 }
?>
                         
                         </select>
			
		      </li>
                      <li>LATITUDE<em>*</em><br><input type=text id="lat<?echo $j?>"  name="lat<?echo $j?>" value="<?echo $lat1;?>"></li>
	       	      <li>LONGITUDE<em>*</em><br><input type=text id="lng<?echo $j?>"   name="lng<?echo $j?>" value="<?echo $lng1;?>"></li>
                      <li></li>
                      
                       
                   		      
                      <li style="width:90%; ">
                                
               			<input type="hidden" id="country<?echo $j?>"   name="country<?echo $j?>" value="India">
	       			<input type="hidden" name="zoom<?echo $j?>" id="zoom<?echo $j?>" value="1">
				<input type="hidden" name="step<?echo $j?>" value="3">
				<!--<input style="width:200px;padding:5px" type="submit" onclick="return zoomVal();" name="add_location" value="ADD LOCATION">-->
				</li>
			</ul>
                  
    
	
	              		     </form>
    
           </div>
         
</div>


<script type="text/javascript">
    var map;
    var geocoder;
    var address;

   // map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});

    function initialize1<?echo $j?>() {
      map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
      map.setCenter(new GLatLng(<? echo $lat1; ?>,<? echo $lng1; ?>), 4);
      map.setUIToDefault();
      map.enableDoubleClickZoom();
        geocoder = new GClientGeocoder();
      	GEvent.addListener(map, "click", getAddress<?echo $j?>);
        GEvent.addListener(map, "zoomend", changeZoom<?echo $j?>);
        GEvent.addListener(map, 'moveend', getZm<?php echo $j?>);
           
    }


    function changeZoom<?echo $j?>(from_zoom,to_zoom) {
    	map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
        $('#zoom<?echo $j?>').val(map.getZoom());
        var zoom_get = $('#zoom<?echo $j?>').val();
        $('#zoominfo<?echo $j?>').show();
        if(zoom_get < 15){
        $('#zoominfo<?echo $j?>').html("Current zoom level is " + zoom_get + ".  Please zoom in to a minimum level of 15. To try and spot your tree from the sky, switch to satellite mode!");
        }
    }

    function getZm<?php echo $j;?>() {

    	map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
    	  var center = map.getCenter();
    	  var zoom = map.getZoom();

    	  return zoom;

    	  };

    
    function getAddress<?echo $j?>(overlay, latlng) {
        
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
            //var current_zoom = $('#zoom<?echo $j?>').val();
            
            //map.setCenter(new GLatLng(latlng.y, latlng.x), zoom_val_set);
         map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});

       //var current_zoom = map.getZoom;
         
         if(current_zoom > 9 ) {
            var zoom_val_set = current_zoom;
         } else {
            var zoom_val_set = 9;
         }
         

         map.setCenter(point,zoom_val_set);
            if(final_address) 
                { setLocationValues<?echo $j?>(final_address); }  
         }

          //alert("current_zoom(getaddress)="+current_zoom+","+map.getZoom());
        });
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
               var zoom_val_set = 9;
        }

        map = new GMap2(document.getElementById("map<?echo $j?>"),{size:new GSize(900,300)});
        map.setCenter(new GLatLng(place.Point.coordinates[1],place.Point.coordinates[0]), zoom_val_set);
        $('#lng<?echo $j?>').val(place.Point.coordinates[0]);
	$('#lat<?echo $j?>').val(place.Point.coordinates[1]);

        var final_address = place.address;

        //alert("final address="+final_address);
        
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
       //state_name = state_name.trim();      
       //$("#state<?echo $j?>").val(state_name); 
       
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
            document.getElementById('loc_name1<?echo $j?>').value = a1[arcount - 6] + ', ' + document.getElementById('loc_name<?echo $j?>').value;
        }

        //var zoom_get = map.getZoom();
        document.getElementById('zoom<?echo $j?>').value = map.getZoom();
        
      }
</script>
<!-- script type="text/javascript" src="js/jquery.validate.js"></script-->


