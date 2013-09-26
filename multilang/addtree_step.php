<? 
   //include("includes/dbc.php");
   include("google_maps_api.php");
   $lat = 22.97;
   $lng = 77.56;
   /*$species_id = $_POST['species_id'];
   if(!$species_id) { header("Location: addtree.php"); }
   $species_name = stripslashes($_POST['species_name']);
   $species_img_path_name = $_POST['species_img_path_name'];
   $species_img_file_name = $_POST['species_img_file_name']; */
?>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<!-- script type="text/javascript" src="js/jquery-1.3.2.min.js"></script-->
<script>
     
     function zoomVal(){
        var zoom_get = $('#zoom').val();
        if(zoom_get < 15 ) {
            jAlert("Current zoom level is " + zoom_get + ".  The min accepted zoom level is 15. Please zoom in more to select the location.");
            return false;

        }

     }

     $(document).ready(function() {
           $('#zoominfo').hide();
   	   $("#addNewLocation").validate({
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
 .addloc_input { list-style:none; width:940px;padding:4px; border:1px solid #cccccc; font-size:14px;} 
 .addloc_input li { list-style:none; width:28%; float:left; display:block; padding:1%; margin:1%; margin-top:0px; height:30px; font-size:13px; }
 .addloc_input input { width:80%; padding:4px; border:1px solid #cccccc; font-size:14px;}
 .addloc_input select {  padding:1px; 
margin-left:-70px;
 	color:#666666;
	font-size:14px;
	width:150px !important;	
	border:1px solid #cccccc;
	outline:none;
	float:left;}
 .search { margin:10px; }

</style>

<body onload="initialize()" style="">
   <div class='container main_body' style="margin-left:10px;margin-right:20px;">
        <? //include("addtree_bc.php"); 
        ?>
        <h3 style="color:#336600;">WHERE IS YOUR TREE?</h3>
        <div id='zoominfo' class='notice'></div>
        <div class='section search'>        
	     <form action="#" onsubmit="showLocation(); return false;"> 
               
                 <span style='font-size:14px'>SEARCH FOR AN ADDRESS</span>:
                 <input type="text" name="q" value="" class="address_input" style="width:620px;">
	         <input class="a_submit" type="submit" name="find" value="SEARCH" style='padding:5px' onClick="javascript:showLocation(); return false;" /> 
                
             </form>                          	          
         </div>
         <div class='section'>
             <form id="addNewLocation" name="editres" onsubmit="AddLocation(); return false;">
                  <ul  class="map">       		
		     <li><div id="map" style="margin-left:10px;margin-bottom:10px;"></div></li>
                  </ul>
                      
                 
                  <ul class="addloc_input">
                      
		      <li>NEW LOCATION NAME<em>*</em><br><input type="text"  id="loc_name" name="loc_name"></li>
		      <!--<li>LOCATION TYPE<em>*</em><br>
                      <select id="location_type" name="location_type">
                               <option value="">-- Choose --</option>
                               <option id="Garden/Park" value="Garden/Park">Garden/Park</option>
                               <option id="Avenue" value="Roadside">Roadside</option>
                               <option id="Forest" value="Forest">Forest</option>
                               <option id="Campus" value="Campus">Campus</option>
                               <option id="Marsh" value="Marsh">Marsh</option>
                               <option id="Grassland" value="Grassland">Grassland</option>
                               <option id="Plantation" value="Plantation">Plantation</option>
                               <option id="Farmland" value="Farmland">Farmland</option>
                               <option id="Other" value="Other">Other</option>
                        </select>
                      </li>-->
                           
                      
                      <li>CITY<em>*</em><br><input type=text id="city"  name="city" value=""></li>
                     <li>STATE<em>*</em><br>
			 <select name=state id="state">
			    <option value="">Select a State</option>
                            <?php
                            $state_id="";
				$result = mysql_query("SELECT state_id, state FROM seswatch_states ORDER BY state");
        		        if($result){
                                   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                      if($row['state'] != 'Not In India') {
                                         print "<option value=".$row{'state_id'};
                                         if ($row{'state_id'} == $state_id) {
                                            print " selected ";
					 }
                                            print ">".$row{'state'}."</option>\n";
        			      } else {
                                           $other_id = $row['state_id'];
                                           $other = $row['state'];
                                       }
                                    }
				 }
?>
                         </select>
			
		      </li>
                      <li>LATITUDE<em>*</em><br><input type=text id="lat"  name="lat" value=""></li>
	       	      <li>LONGITUDE<em>*</em><br><input type=text id="lng"   name="lng" value=""></li>
                     
                      
                       
                      
                    <!--  <li>LOCATION TYPE<em>*</em><br>
                           <select id="location_type" name="location_type">
                               <option value="">-- Choose --</option>
                               <option name="Garden/Park" value="Garden/Park">Garden/Park</option>
                               <option name="Avenue" value="Roadside">Roadside</option>
                               <option name="Forest" value="Forest">Forest</option>
                               <option name="Campus" value="Campus">Campus</option>
                               <option name="Marsh" value="Marsh">Marsh</option>
                               <option name="Grassland" value="Grassland">Grassland</option>
                               <option name="Plantation" value="Plantation">Plantation</option>
                               <option name="Farmland" value="Farmland">Farmland</option>
                               <option name="Other" value="Other">Other</option>
                           </select>
                      </li>-->
	       	     
		     
		      
                      
                                <input type="hidden" name="species_id" value="<? echo $species_id; ?>">
                                <input type="hidden" name="species_name" value="<? echo $species_name; ?>">
                                <input type="hidden" name="species_img_path_name" value="<? echo $species_img_path_name; ?>">
                                <input type="hidden" name="species_img_file_name" value="<? echo $species_img_file_name; ?>">
               			<input type="hidden" id="country"   name="country" value="India">
	       			<input type="hidden" name="zoom" id="zoom" value="1">
				<input type="hidden" name="step" value="3">
				<!--<input style="width:200px;padding:5px" type="submit" onclick="return zoomVal();" name="add_location" value="ADD LOCATION">-->
				<li></li>
			</ul>
                  
    
	
	              		     </form>
    
           </div>
         
</div>


<script type="text/javascript">
    var map;
    var geocoder;
    var address;

    function initialize() {
      map = new GMap2(document.getElementById("map"),{size:new GSize(900,300)});
      map.setCenter(new GLatLng(<? echo $lat; ?>,<? echo $lng; ?>), 4);
      map.setUIToDefault();
      map.enableDoubleClickZoom();
        geocoder = new GClientGeocoder();
      	GEvent.addListener(map, "click", getAddress);
        GEvent.addListener(map, "zoomend", changeZoom);      
    }


    function changeZoom(from_zoom,to_zoom) {
       
        $('#zoom').val(map.getZoom());
        var zoom_get = $('#zoom').val();
        $('#zoominfo').show();
        $('#zoominfo').html("Current zoom level is " + zoom_get + ".  Please zoom in to a minimum level of 15. To try and spot your tree from the sky, switch to satellite mode!");

    }

    
    function getAddress(overlay, latlng) {
	map.clearOverlays();
      	if (latlng) {
          address = latlng;
	  geocoder.getLocations(latlng, function(addresses) {
          if(addresses.Status.code != 200) {
            alert("reverse geocoder failed to find an address for " + latlng.toUrlValue());
          } else {
            address = addresses.Placemark[0];
            point = new GLatLng(latlng.y, latlng.x);
            $('#lng').val(latlng.x);
            $('#lat').val(latlng.y);
	    var final_address = address.address;
            marker = new GMarker(point);
            map.addOverlay(marker);
            var current_zoom = $('#zoom').val();
            if(current_zoom > 9 ) {
               var zoom_val_set = current_zoom;
            } else {
               var zoom_val_set = 9;
            }
            map.setCenter(new GLatLng(latlng.y, latlng.x), zoom_val_set);
            if(final_address) { setLocationValues(final_address); }  
         }
        });
       }
    }

    function addAddressToMap(response) {
      map.clearOverlays();
      if (!response || response.Status.code != 200) {
        alert("Sorry, we were unable to geocode that address");
      } else {
        place = response.Placemark[0];
        point = new GLatLng(place.Point.coordinates[1],
                            place.Point.coordinates[0]);
        
        marker = new GMarker(point);
        map.addOverlay(marker);
        var current_zoom = $('#zoom').val();
        if(current_zoom > 9 ) {
           var zoom_val_set = current_zoom;
        } else {
               var zoom_val_set = 9;
        }
        map.setCenter(new GLatLng(place.Point.coordinates[1],place.Point.coordinates[0]), zoom_val_set);
        $('#lng').val(place.Point.coordinates[0]);
	$('#lat').val(place.Point.coordinates[1]);

        var final_address = place.address;

         if(final_address) {        
            setLocationValues(final_address);
            
          }
      
      }
     
    }

    function showLocation() {
            var address = $('.address_input').val();
            geocoder.getLocations(address,addAddressToMap);
            
    }
    
    function AddLocation() {
        var locname = $("#loc_name").val();
        var loctype = $("#location_type").val(); 
        var locstate =  $("#state").val();
        var loccity =$("#city").val();
        var loclat =$("#lat").val();
        var loclong =$("#lng").val();
      
    }
 
    function setLocationValues(final_address) {
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
       state_name = state_name.trim();      
       $("#state").val(state_name) 
      

       if( a1[arcount - 4] ) {
          if( a1[arcount-4] != 'undefined') {
              document.getElementById('loc_name').value = a1[arcount - 4];
           } else {
             document.getElementById('loc_name').value = '';
           }  

	   if(a1[arcount-3] != '') {
             if(a1[arcount-3] != 'undefined' ) {
               document.getElementById('city').value = a1[arcount - 3];
             }
            }
        } else {
	   document.getElementById('loc_name').value = a1[arcount - 3];
	}

        if( a1[arcount - 5] ) {
            document.getElementById('loc_name').value = a1[arcount - 5] + ', ' + document.getElementById('loc_name').value;
        }

        if( a1[arcount - 6] ) {
            document.getElementById('loc_name').value = a1[arcount - 6] + ', ' + document.getElementById('loc_name').value;
        }

        var zoom_get = map.getZoom();
        document.getElementById('zoom').value = map.getZoom();
      }
</script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

</body>

