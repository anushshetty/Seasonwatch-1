<?php 
/*Initial Development :- This page will be displayed once user clicks on details link.*/
 error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
session_start();    
include_once("includes/dbcon.php"); 
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SeasonWatch</title>

    <link href="css/global.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/popup.js"> </script>
    <link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
    <script type="text/javascript" src="js/custom-form-elements1.js"></script>
    <script type="text/javascript" src="js/initiate.js"></script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-5355447-9']);
        _gaq.push(['_trackPageview']);
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
        'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
        })();
    </script>  
    <style type="text/css"> 
       ul#display-inline-block-example,
	ul#display-inline-block-example li {
		/* Setting a common base */
		margin: 0;
		padding: 0;
	}

	ul#display-inline-block-example {
		/*width: 300px;
		//border: 1px solid #000;*/
	}

	ul#display-inline-block-example li {
		display: inline-block;
		width: 25%;
		//min-height: 170px;
		//border:solid 1px #333;		
		vertical-align: middle;
		margin-bottom:15px;
		text-align:center;
		font-size:14px;
		<strong>/* For IE 7 */
		zoom: 1;
		*display: inline;</strong>
	}
	
        ul#display-inline-block-example li img {
	       //vertical-align:middle;
	       //vertical-align: 50%;
	       text-align:center;
	       border: solid 4px #ddd;
	       margin-left:25px;
	       margin-right:30px;
	}
</style>
</head>
<body>
    <?php include ("includes/header.php"); ?> <!--  start header_place_holder  -->
     <!--  end header_place_holder  -->
     
   
      
       <div class="body_content"> <!--  start body_content  -->
        <!--  start body_top  -->
    	<div class="body_top">
        <!--  start main  -->
        	<div class="main">
               	<h3 class="Rhythm_TEXT">SeasonWatch Species</h3>
                 <div class="container"> 
                   <div class='section'>
    	<ul class='gal_pics' id='display-inline-block-example'>
        <?
              $query = "SELECT m.species_id, m.species_primary_common_name, m.species_scientific_name, m.family, i.path_name, i.file_name FROM species_master as m,species_images as i WHERE m.species_id=i.species_id  group by species_id order by m.species_scientific_name";
            $query_result = mysql_query($query);   

            while($data = mysql_fetch_assoc($query_result)) {
                print "<li>";
                $species_pic1 = $data['path_name'].$data['file_name'];
                echo "<a href='" . $species_pic1 . "' rel='shadowbox[Spgallery]'";
                ?>  title="<? echo $data['species_primary_common_name']; ?>"> <?
                print "<img src='" . $data['path_name'] . $data['file_name'] . "' style='max-width:150px'><br>";
                print $data['species_primary_common_name'] . "<br><i>" . $data['species_scientific_name'] . "</i></a></li>";

            }
	?>
	</ul>
    </div> 	
                        
                </div>  
                  
            </div><!--  end main  -->
         </div><!--  end body_top  -->
    </div>
 
    <!--  end body_content  -->
   
    <!--  start footer  -->
    <?php include ("includes/footer.php"); ?>
    <!--  end footer  -->
    
</body>
</html>

