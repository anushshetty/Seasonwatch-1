<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Species locations</title>

<link rel="stylesheet" href="/resources/demos/style.css" />
<script src="http://maps.google.com/maps/api/js?sensor=false" 
        type="text/javascript"></script>
<script>
 $(document).ready(function(){
  //  Preloading calculate height 
var screen_ht = $(window).height();
var preloader_ht = 10;
var padding =(screen_ht/2)-preloader_ht;

$("#preloader").css("padding-top",padding+"px");

// loading animation using script

	function anim(){ $("#preloader_image").animate({left:'-1400px'}, 8000,
	function(){ $("#preloader_image").animate({left:'0px'}, 5000 ); if(rotate==1){ anim();}  } );
	}

	anim();
 });
 rotate = 1;
function hide_preloader() { //DOM
rotate = 0;
$("#preloader").fadeOut(1000);
}
 function showtree(showtreeid)
 {
    // alert(showtreeid);
     //window.location="infotestmaps.php?species='+showtreeid+'";
     url = 'index.php?id=' + showtreeid; 
	window.location.href = url;
 }
</script>
</head> 
<!--<body onload="hide_preloader();">-->
   <body>
     
 <?
include '../../includes/dbcon.php';


if (empty($_GET['id']))
{   $spid=0;}
if (!isset($_GET['id']) )
{ $spid=0; 
} else
{ $spid =$_GET['id'];};
?>
    <h4>select species:
    <select name="treename" id="treename" onchange="showtree(this.value);">
     <option value="">All Species</option>
    <?php
        $result = mysql_query("SELECT species_search_names as species_label,species_id FROM species_master ORDER BY species_label");
        if($result){
           while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){

                print "<option value=".$row{'species_id'};
                if (($spid == $row{'species_id'}))
                    print " selected ";
                print ">".$row{'species_label'}."</option>\n";
               }
         }
    ?>
    </select>
    </h4>
<? 
if ($spid >0)
{
$spidtrees ="SELECT u.user_name, user_tree_table.last_observation_date,user_tree_table.tree_nickname,u.group_id, u.user_id, trees.species_id, sm.species_primary_common_name, trees.tree_id, trees.tree_location_id, lm.city, lm.longitude, lm.latitude, lm.location_name
FROM  `trees` , user_tree_table, location_master AS lm, species_master AS sm, users AS u
WHERE trees.tree_id = user_tree_table.tree_id
AND trees.tree_location_id !=0
AND trees.deleted !=1
AND lm.tree_location_id = trees.tree_location_id
AND sm.species_id = trees.species_id
AND u.user_id = user_tree_table.user_id
AND trees.species_id =  '$spid' and u.user_id!='140' and u.user_id!='10'";}
else
{  //$spid=0; 
$spidtrees = "SELECT u.user_name,u.group_id,user_tree_table.last_observation_date,u.user_id,user_tree_table.tree_nickname,trees.species_id,sm.species_primary_common_name,trees.tree_id,trees.tree_location_id,lm.city,lm.longitude,lm.latitude
,lm.location_name FROM `trees`,user_tree_table,
location_master as lm,species_master as sm,users as u
 where trees.tree_id=
user_tree_table.tree_id and trees.tree_location_id!=0 and trees.deleted !=1 and lm.tree_location_id=trees.tree_location_id and 
sm.species_id=trees.species_id and u.user_id= user_tree_table.user_id and u.user_id!='140' and u.user_id!='10'";
 //echo $spidtrees;  
} 

//$resd = $dbc1->readtabledata($spidtrees);
$resd =mysql_query($spidtrees);
//$norows=mysql_num_rows($resd);
//echo $norows;
// loop through each row returned and format the response for jQuery
$data = array();
$json_object = array();
$lat_locations = array();
$icunt=0;
if ( $resd && mysql_num_rows($resd) )
{
	while( $row = mysql_fetch_array($resd) )
	{ $icunt++;
             //echo     $row['tree_nickname']."-".$row['species_id'];
             //echo "<br>";
        $data[] = array($row['tree_nickname'] ,$row['species_primary_common_name'],$row['city'],$row['location_name'],
            $row['latitude'],$row['longitude'],$row['user_name'],$row['last_observation_date']);
        $lat_locations[]= array($row['tree_nickname'],$row['latitude'],$row['longitude']);
           
	}
}
file_put_contents('latlong.json', json_encode($data));
$infoloc= json_encode($data);?>


  <div id="map" style="width:600px;height:400px;"></div>
<!--<div id="preloader">Page loading please wait...
<div><img src="../../images/hrloading.gif" id="preloader_image" ></div>
</div> --><!-- #preloader --> 
  <script type="text/javascript">
    var locations =<?=$infoloc;?>; 

    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: new google.maps.LatLng(22.00,77.00),
    mapTypeId: google.maps.MapTypeId.ROADMAP
    });
     var image = {
    url: 'rs_red.png',
    // This marker is 20 pixels wide by 32 pixels tall.
    size: new google.maps.Size(20, 32),
    // The origin for this image is 0,0.
    origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,32.
    anchor: new google.maps.Point(0, 32)
  };
  var shadow = {
    url: 'rs_red.png',
    // The shadow image is larger in the horizontal dimension
    // while the position and offset are the same as for the main image.
    size: new google.maps.Size(37, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
  // Shapes define the clickable region of the icon.
  // The type defines an HTML &lt;area&gt; element 'poly' which
  // traces out a polygon as a series of X,Y points. The final
  // coordinate closes the poly by connecting to the first
  // coordinate.
  var shape = {
      coord: [1, 1, 1, 20, 18, 20, 18 , 1],
      type: 'poly'
  };

    var infowindow = new google.maps.InfoWindow();
    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][4], locations[i][5]),
        map: map,
        shadow: shadow,
        icon: image,
        shape: shape,
        title: locations[i][0]
      });
        var name = locations[i][0], species = locations[i][1], city = locations[i][2],locationname=locations[i][3],username= locations[i][6],
               lastobdate=locations[i][7];
       var contentString = "";
        contentString = '<div style="margin-top:-5% !important;">'+
        '<h4>'+name+'</h4>'+
        'Species -'+species+'</br>'+'Last observed date -'+lastobdate+'</br>'+'User name -'+username+'</br>'+'City -'+city+'</br>'
         '</div>';
     //var content = <div><h3>' + name + '</h3>' ;
      google.maps.event.addListener(marker, 'click', (function(marker, contentString) {
        return function() {
          infowindow.setContent(contentString);
          infowindow.open(map, marker);
        }
      })(marker, contentString));
    }
  </script>
  </body>
</html>
