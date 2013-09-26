<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//get all tree location id  with lat long and species type
include '../../includes/dbcon.php';

$q="t";

if(isset($_GET['term'])){
$q = $_GET['term'];
#echo "$q";
}

//$dbc1=Dbconn::getdblink();
//$dbc1->Connecttodb();
$sql = "SELECT T.tree_Id,UT.tree_nickname,SM.species_primary_common_name,LM.location_name,LM.city,LM.longitude,LM.latitude,UT.tree_nickname FROM trees AS T LEFT JOIN species_master AS SM ON SM.species_id=T.species_id LEFT JOIN location_master AS LM ON LM.tree_location_id=T.tree_location_id
LEFT JOIN user_tree_table as UT ON T.tree_id=UT.tree_id ";
      // echo $sql;
//$resd = $dbc1->readtabledata($sql);
$resd =mysql_query($sql);
// loop through each row returned and format the response for jQuery
$data = array();
$json_object = array();
$lat_locations = array();
if ( $resd && mysql_num_rows($resd) )
{
	while( $row = mysql_fetch_array($resd) )
	{
           //echo $row[tree_nickname];
		/*$data[] = array(
                'treename' => $row['tree_nickname'] ,
               'species_primary_common_name' => $row['species_primary_common_name'],
                'city' => $row['city'],
               'location_name' => $row['location_name'],
               'lon' => $row['longitude'],
               'lat' => $row['latitude']
                        
		);*/
            
        $data[] = array($row['tree_nickname'] ,$row['species_primary_common_name'],$row['city'],$row['location_name']);
        $lat_locations[]= array($row['latitude'],$row['longitude']);
               /* 'treename' => $row['tree_nickname'] ,
               'species_primary_common_name' => $row['species_primary_common_name'],
                'city' => $row['city'],
               'location_name' => $row['location_name'],
               'lon' => $row['longitude'],
               'lat' => $row['latitude']
                        
		);*/
	}
}
 
// jQuery wants JSON data
//echo json_encode($lat_locations);
file_put_contents('infoloc.json', json_encode($data));
file_put_contents('latlong.json', json_encode($lat_locations));
$myData1 = json_encode($lat_locations);
$infoloc= json_encode($data);?>


<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
      	width:700px;
        height: 500px;
      }
     
   .labels {
     color: white;
     background-color: red;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     text-align: center;
     width: 10px;     
     white-space: nowrap;
   }
 

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAy9fxyP7JUe9jVSjCuJuZ8MfAozvev89E&sensor=false"></script>
    <script type="text/javascript" src="./js/map.js"></script>
    <script>

function initialize() {
    
var myLatLng = new google.maps.LatLng(10.854886,76.26709);
  var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(22.00,77.00),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  //var image = 'tree.png';
  

  var image = {
    url: 'tree.png',
    // This marker is 20 pixels wide by 32 pixels tall.
    size: new google.maps.Size(20, 32),
    // size: new google.maps.Size(10, 12),
    // The origin for this image is 0,0.
    origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,6.
    anchor: new google.maps.Point(0, 32)
  };

//var locations=[[10.854886,76.26709],[11.854886,76.26709]];
var content=["First","secons"];

var locations = <?=$myData1;?>;

/* var infowindows = [];
 for(i=0;i<locations.length;i++)
 {
     var beachMarker = new google.maps.Marker({
      position:new google.maps.LatLng(locations[i][0],locations[i][1]),
      map: map
     });
     var infowindow = new google.maps.InfoWindow({
    content: contentString
    });
    
 } */
markers = Array();
    infoWindows = Array();

    for(i=0;i<locations.length;i++)
    {
        var location = new google.maps.LatLng(locations[i][0],locations[i][1]);
        var marker = new google.maps.Marker({
            position : location,
            map : map,
            animation : google.maps.Animation.DROP,
            infoWindowIndex : i //<---Thats the extra attribute
        });
        var content = "<h3>" + content[i] + "<h3>" ;
        var infoWindow = new google.maps.InfoWindow({
            content : content
        });

        google.maps.event.addListener(marker, 'click', 
            function(event)
            {
                map.panTo(event.latLng);
                map.setZoom(5);
                infoWindows[this.infoWindowIndex].open(map, this);
            }
        );

        infoWindows.push(infoWindow);
        markers.push(marker);
    }

var contentString = '<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<h2 id="firstHeading" class="firstHeading">Uluru</h2>'+
    '<div id="bodyContent">'+
    '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>,' +
    'sandstone rock formation in the southern part of the '+
    'Aboriginal people of the area. It has many , '+
    'rock caves and ancient paintings. Uluru is listed as a World '+
    'Heritage Site.</p>'+
    
    '</div>'+
    '</div>';

/*var contentstr=[[text,simple],[text1,simple1]];
 for(i=0;i<locations.length;i++)
 {
    var infowindow = new google.maps.InfoWindow({
    content: contentstr([i,0],[i,1])
    }); 
 }*/



}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>